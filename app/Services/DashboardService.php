<?php

namespace App\Services;

use App\Enums\InvoiceStatus;
use App\Enums\KitchenOrderStatus;
use App\Models\CashSession;
use App\Models\Invoice;
use App\Models\KitchenOrder;
use App\Models\RestaurantTable;
use Illuminate\Support\Carbon;

class DashboardService
{
    public function getSalesSummary(): array
    {
        $today     = Carbon::today();
        $yesterday = Carbon::yesterday();

        $todaySales     = Invoice::whereDate('issued_at', $today)->sum('total');
        $yesterdaySales = Invoice::whereDate('issued_at', $yesterday)->sum('total');

        $trendPercentage = 0;
        $trend           = 'neutral';

        if ($yesterdaySales > 0) {
            $trendPercentage = round((($todaySales - $yesterdaySales) / $yesterdaySales) * 100, 2);
        } elseif ($todaySales > 0) {
            $trendPercentage = 100;
        }

        if ($todaySales > $yesterdaySales) {
            $trend = 'up';
        } elseif ($todaySales < $yesterdaySales) {
            $trend = 'down';
        }

        return [
            'today_sales'      => round($todaySales, 2),
            'yesterday_sales'  => round($yesterdaySales, 2),
            'trend_percentage' => $trendPercentage,
            'trend'            => $trend,
        ];
    }

    public function getCashSummary(): ?array
    {
        $session = CashSession::where('status', 'open')
            ->with('cashRegister:id,name')
            ->latest('opened_at')
            ->first();

        if (! $session) {
            return null;
        }

        $income      = $session->movements()->where('type', 'income')->sum('amount');
        $withdrawals = $session->movements()->where('type', 'withdrawal')->sum('amount');
        $current     = $session->opening_amount + $income - $withdrawals;

        return [
            'session_id'     => $session->id,
            'cash_register'  => $session->cashRegister->name,
            'opened_at'      => $session->opened_at,
            'opening_amount' => round($session->opening_amount, 2),
            'current_amount' => round($current, 2),
            'status'         => $session->status,
        ];
    }

    public function getTablesSummary(int $tenantId, int $branchId): array
    {
        $total    = RestaurantTable::where('tenant_id', $tenantId)->where('branch_id', $branchId)->where('is_active', true)->count();
        $occupied = RestaurantTable::where('tenant_id', $tenantId)->where('branch_id', $branchId)->where('is_active', true)->where('status', 'occupied')->count();
        $occupied = min($occupied, $total);

        return [
            'occupied' => $occupied,
            'total'    => $total,
        ];
    }

    public function getKitchenSummary(int $tenantId, int $branchId): array
    {
        $orders = KitchenOrder::where('tenant_id', $tenantId)
            ->where('branch_id', $branchId)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->get()
            ->keyBy('status');

        $byStatus = collect(KitchenOrderStatus::cases())->map(fn($case) => [
            'status' => $case->label(),
            'count'  => $orders->get($case->value)?->count ?? 0,
        ])->values();

        return [
            'total'     => $byStatus->sum('count'),
            'by_status' => $byStatus,
        ];
    }

    public function getKitchenOrders(int $tenantId, int $branchId): array
    {
        $orders = KitchenOrder::where('tenant_id', $tenantId)
            ->where('branch_id', $branchId)
            ->whereNot('status', KitchenOrderStatus::DELIVERED->value)
            ->with([
                'order.table:id,name',
                'order.items.product:id,name',
            ])
            ->orderBy('priority', 'desc')
            ->orderBy('received_at', 'asc')
            ->get();

        return $orders->map(function ($ko) {
            return [
                'kitchen_order_id' => $ko->id,
                'order_number'     => $ko->order->order_number,
                'table'            => $ko->order->table?->name ?? 'Sin mesa',
                'status'           => $ko->status->label(),
                'elapsed_minutes'  => $ko->received_at ? (int) $ko->received_at->diffInMinutes(now()) : 0,
                'items'            => $ko->order->items->map(fn($item) => [
                    'product'  => $item->product->name,
                    'quantity' => (float) $item->quantity,
                    'notes'    => $item->notes,
                ])->values(),
            ];
        })->toArray();
    }

    public function getTopProducts(int $tenantId, int $branchId, string $date, int $limit): array
    {
        $rows = \DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('invoices', 'invoices.order_id', '=', 'orders.id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->where('invoices.tenant_id', $tenantId)
            ->where('invoices.branch_id', $branchId)
            ->where('invoices.status', InvoiceStatus::PAID->value)
            ->whereDate('invoices.issued_at', $date)
            ->selectRaw('order_items.product_id, products.name as product, SUM(order_items.quantity) as quantity, SUM(order_items.subtotal) as total_sales')
            ->groupBy('order_items.product_id', 'products.name')
            ->orderByRaw('SUM(order_items.quantity) DESC')
            ->limit($limit)
            ->get();

        return [
            'date' => $date,
            'data' => $rows->map(fn($r) => [
                'product_id'  => $r->product_id,
                'product'     => $r->product,
                'quantity'    => (float) $r->quantity,
                'total_sales' => round((float) $r->total_sales, 2),
            ])->values()->toArray(),
        ];
    }

    public function getRecentActivity(int $tenantId, int $branchId, ?int $limit = null): array
    {
        $query = \DB::table('audit_logs')
            ->leftJoin('users', 'users.id', '=', 'audit_logs.user_id')
            ->where('audit_logs.tenant_id', $tenantId)
            ->where('audit_logs.branch_id', $branchId)
            ->select(
                'audit_logs.id',
                'audit_logs.action',
                'audit_logs.entity_type',
                'audit_logs.entity_id',
                'audit_logs.ip_address',
                'audit_logs.created_at',
                \DB::raw("CONCAT(users.first_name, ' ', users.last_name) as user")
            )
            ->orderBy('audit_logs.created_at', 'desc');

        $total = $query->count();
        $rows  = $limit ? $query->limit($limit)->get() : $query->get();

        return [
            'total' => $total,
            'data'  => $rows->map(fn($r) => [
                'id'          => $r->id,
                'action'      => $r->action,
                'entity_type' => $r->entity_type,
                'entity_id'   => $r->entity_id,
                'user'        => $r->user ?? 'Sistema',
                'ip_address'  => $r->ip_address,
                'elapsed'     => Carbon::parse($r->created_at)->diffForHumans(),
                'created_at'  => $r->created_at,
            ])->values()->toArray(),
        ];
    }

    public function getCriticalInventory(int $tenantId, int $branchId): array
    {
        $rows = \DB::table('inventory')
            ->join('warehouses', 'warehouses.id', '=', 'inventory.warehouse_id')
            ->join('products', 'products.id', '=', 'inventory.product_id')
            ->where('warehouses.tenant_id', $tenantId)
            ->where('warehouses.branch_id', $branchId)
            ->where('warehouses.is_active', true)
            ->whereRaw('inventory.quantity <= inventory.min_stock')
            ->select(
                'inventory.product_id',
                'products.name as product',
                'inventory.quantity',
                'inventory.min_stock',
                'warehouses.name as warehouse'
            )
            ->orderBy('inventory.quantity', 'asc')
            ->get();

        $data = $rows->map(fn($r) => [
            'product_id'  => $r->product_id,
            'product'     => $r->product,
            'quantity'    => (float) $r->quantity,
            'min_stock'   => (float) $r->min_stock,
            'warehouse'   => $r->warehouse,
            'is_critical' => (float) $r->quantity < (float) $r->min_stock,
        ])->values()->toArray();

        return [
            'total' => count($data),
            'data'  => $data,
        ];
    }

    public function getSalesByHour(int $tenantId, int $branchId): array
    {
        $rows = Invoice::where('tenant_id', $tenantId)
            ->where('branch_id', $branchId)
            ->where('status', InvoiceStatus::PAID->value)
            ->whereDate('issued_at', Carbon::today())
            ->selectRaw('HOUR(issued_at) as hour, SUM(total) as total')
            ->groupByRaw('HOUR(issued_at)')
            ->pluck('total', 'hour');

        return collect(range(0, 23))->map(fn($h) => [
            'hour'  => $h,
            'total' => round((float) ($rows[$h] ?? 0), 2),
        ])->values()->toArray();
    }
}
