<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Module;

class ModulesSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Module::truncate();
        Schema::enableForeignKeyConstraints();

        // Nivel 0: Módulos raíz
        $dashboard      = Module::create(['name' => 'Dashboard',              'slug' => 'dashboard',    'description' => 'Main panel with key metrics and summaries', 'parent_id' => null, 'sub_parent_id' => null, 'sub_identifier' => null, 'is_active' => true]);
        $admin          = Module::create(['name' => 'Administración',         'slug' => 'admin',        'description' => 'General system administration',             'parent_id' => null, 'sub_parent_id' => null, 'sub_identifier' => null, 'is_active' => true]);
        $products       = Module::create(['name' => 'Productos',              'slug' => 'products',     'description' => 'Product catalog management',                'parent_id' => null, 'sub_parent_id' => null, 'sub_identifier' => null, 'is_active' => true]);
        $inventory      = Module::create(['name' => 'Inventario',             'slug' => 'inventory',    'description' => 'Stock and inventory control',               'parent_id' => null, 'sub_parent_id' => null, 'sub_identifier' => null, 'is_active' => true]);
        $pos            = Module::create(['name' => 'Ventas (POS)',           'slug' => 'pos',          'description' => 'Point of sale system',                      'parent_id' => null, 'sub_parent_id' => null, 'sub_identifier' => null, 'is_active' => true]);
        $kitchen        = Module::create(['name' => 'Cocina (Kitchen Display)','slug' => 'kitchen',     'description' => 'Kitchen display system',                    'parent_id' => null, 'sub_parent_id' => null, 'sub_identifier' => null, 'is_active' => true]);
        $cashier        = Module::create(['name' => 'Caja',                   'slug' => 'cashier',      'description' => 'Cash register and closing management',      'parent_id' => null, 'sub_parent_id' => null, 'sub_identifier' => null, 'is_active' => true]);
        $purchases      = Module::create(['name' => 'Compras',                'slug' => 'purchases',    'description' => 'Purchase orders and supplier management',   'parent_id' => null, 'sub_parent_id' => null, 'sub_identifier' => null, 'is_active' => true]);
        $crm            = Module::create(['name' => 'Clientes (CRM)',         'slug' => 'crm',          'description' => 'Customer relationship management',          'parent_id' => null, 'sub_parent_id' => null, 'sub_identifier' => null, 'is_active' => true]);
        $staff          = Module::create(['name' => 'Personal',               'slug' => 'staff',        'description' => 'Staff and human resources management',      'parent_id' => null, 'sub_parent_id' => null, 'sub_identifier' => null, 'is_active' => true]);
        $music          = Module::create(['name' => 'Música',                 'slug' => 'music',        'description' => 'Background music management',               'parent_id' => null, 'sub_parent_id' => null, 'sub_identifier' => null, 'is_active' => true]);
        $reports        = Module::create(['name' => 'Reportes',               'slug' => 'reports',      'description' => 'Reports and analytics',                     'parent_id' => null, 'sub_parent_id' => null, 'sub_identifier' => null, 'is_active' => true]);
        $reservations   = Module::create(['name' => 'Reservas',               'slug' => 'reservations', 'description' => 'Table and space reservation management',    'parent_id' => null, 'sub_parent_id' => null, 'sub_identifier' => null, 'is_active' => true]);
        $delivery       = Module::create(['name' => 'Delivery',               'slug' => 'delivery',     'description' => 'Delivery order management',                 'parent_id' => null, 'sub_parent_id' => null, 'sub_identifier' => null, 'is_active' => true]);

        // Nivel 1: Hijos de Administración
        $empresa     = Module::create(['name' => 'Empresa',          'slug' => 'company',          'description' => 'Everything about the company',     'parent_id' => $admin->id, 'sub_parent_id' => 1, 'sub_identifier' => null, 'is_active' => true]);
        $sucursales  = Module::create(['name' => 'Sucursales',       'slug' => 'branches',         'description' => 'Branch management',                'parent_id' => $admin->id, 'sub_parent_id' => 2, 'sub_identifier' => null, 'is_active' => true]);
        $usuarios    = Module::create(['name' => 'Usuarios',         'slug' => 'users',            'description' => 'User management',                  'parent_id' => $admin->id, 'sub_parent_id' => 3, 'sub_identifier' => null, 'is_active' => true]);
        $roles       = Module::create(['name' => 'Roles',            'slug' => 'roles',            'description' => 'Role management',                  'parent_id' => $admin->id, 'sub_parent_id' => 4, 'sub_identifier' => null, 'is_active' => true]);
        $permisos    = Module::create(['name' => 'Permisos',         'slug' => 'permissions',      'description' => 'Permission management',            'parent_id' => $admin->id, 'sub_parent_id' => 5, 'sub_identifier' => null, 'is_active' => true]);
        $impuestos   = Module::create(['name' => 'Impuestos',        'slug' => 'taxes',            'description' => 'Tax management',                   'parent_id' => $admin->id, 'sub_parent_id' => 6, 'sub_identifier' => null, 'is_active' => true]);
        $tiposPago   = Module::create(['name' => 'Tipos de pago',    'slug' => 'payment-types',    'description' => 'Payment type management',          'parent_id' => $admin->id, 'sub_parent_id' => 7, 'sub_identifier' => null, 'is_active' => true]);
        $numeracion  = Module::create(['name' => 'Numeraciones',     'slug' => 'numbering',        'description' => 'Numbering sequences management',   'parent_id' => $admin->id, 'sub_parent_id' => 8, 'sub_identifier' => null, 'is_active' => true]);
        $monedas     = Module::create(['name' => 'Monedas',          'slug' => 'currencies',       'description' => 'Currency management',              'parent_id' => $admin->id, 'sub_parent_id' => 9, 'sub_identifier' => null, 'is_active' => true]);
        $configPos   = Module::create(['name' => 'Configuración POS','slug' => 'pos-config',       'description' => 'POS configuration',                'parent_id' => $admin->id, 'sub_parent_id' => 10,'sub_identifier' => null, 'is_active' => true]);

        // Nivel 2: Hijos de Empresa
        Module::create(['name' => 'Información general', 'slug' => 'general-information', 'description' => 'General information of company', 'parent_id' => $empresa->id, 'sub_parent_id' => 1, 'sub_identifier' => '1.1', 'is_active' => true]);
        Module::create(['name' => 'Configuración',       'slug' => 'configuration',      'description' => 'Company configuration',          'parent_id' => $empresa->id, 'sub_parent_id' => 2, 'sub_identifier' => '1.2', 'is_active' => true]);
        Module::create(['name' => 'Datos fiscales',      'slug' => 'fiscal-data',         'description' => 'Fiscal data of company',         'parent_id' => $empresa->id, 'sub_parent_id' => 3, 'sub_identifier' => '1.3', 'is_active' => true]);

        // Nivel 1: Hijos de Productos
        Module::create(['name' => 'Productos',         'slug' => 'products-list',    'description' => 'Product list',              'parent_id' => $products->id, 'sub_parent_id' => 1,  'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Categorías',        'slug' => 'categories',       'description' => 'Product categories',        'parent_id' => $products->id, 'sub_parent_id' => 2,  'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Variantes',         'slug' => 'variants',         'description' => 'Product variants',          'parent_id' => $products->id, 'sub_parent_id' => 3,  'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Ingredientes',      'slug' => 'ingredients',      'description' => 'Ingredients management',    'parent_id' => $products->id, 'sub_parent_id' => 4,  'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Recetas',           'slug' => 'recipes',          'description' => 'Recipe management',         'parent_id' => $products->id, 'sub_parent_id' => 5,  'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Combos',            'slug' => 'combos',           'description' => 'Combo management',          'parent_id' => $products->id, 'sub_parent_id' => 6,  'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Modificadores',     'slug' => 'modifiers',        'description' => 'Modifier management',       'parent_id' => $products->id, 'sub_parent_id' => 7,  'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Promociones',       'slug' => 'promotions',       'description' => 'Promotion management',      'parent_id' => $products->id, 'sub_parent_id' => 8,  'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Listas de precios', 'slug' => 'price-lists',      'description' => 'Price list management',     'parent_id' => $products->id, 'sub_parent_id' => 9,  'sub_identifier' => null, 'is_active' => true]);

        // Nivel 1: Hijos de Inventario
        Module::create(['name' => 'Bodegas',           'slug' => 'warehouses',       'description' => 'Warehouse management',      'parent_id' => $inventory->id, 'sub_parent_id' => 1,  'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Existencias',       'slug' => 'stock',            'description' => 'Stock management',          'parent_id' => $inventory->id, 'sub_parent_id' => 2,  'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Entradas',          'slug' => 'entries',          'description' => 'Inventory entries',         'parent_id' => $inventory->id, 'sub_parent_id' => 3,  'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Salidas',           'slug' => 'exits',            'description' => 'Inventory exits',           'parent_id' => $inventory->id, 'sub_parent_id' => 4,  'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Transferencias',    'slug' => 'transfers',        'description' => 'Inventory transfers',       'parent_id' => $inventory->id, 'sub_parent_id' => 5,  'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Ajustes',           'slug' => 'adjustments',      'description' => 'Inventory adjustments',     'parent_id' => $inventory->id, 'sub_parent_id' => 6,  'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Conteos físicos',   'slug' => 'physical-counts',  'description' => 'Physical inventory counts', 'parent_id' => $inventory->id, 'sub_parent_id' => 7,  'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Kardex',            'slug' => 'kardex',           'description' => 'Kardex report',             'parent_id' => $inventory->id, 'sub_parent_id' => 8,  'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Costeo promedio',   'slug' => 'average-cost',     'description' => 'Average cost management',   'parent_id' => $inventory->id, 'sub_parent_id' => 9,  'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Lotes',             'slug' => 'lots',             'description' => 'Lot management',            'parent_id' => $inventory->id, 'sub_parent_id' => 10, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Vencimientos',      'slug' => 'expirations',      'description' => 'Expiration management',     'parent_id' => $inventory->id, 'sub_parent_id' => 11, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Producción',        'slug' => 'production',       'description' => 'Production management',     'parent_id' => $inventory->id, 'sub_parent_id' => 12, 'sub_identifier' => null, 'is_active' => true]);

        // Nivel 1: Hijos de Ventas (POS)
        $mesas       = Module::create(['name' => 'Mesas',       'slug' => 'tables',      'description' => 'Table management',   'parent_id' => $pos->id, 'sub_parent_id' => 1, 'sub_identifier' => null, 'is_active' => true]);
        $pedidos     = Module::create(['name' => 'Pedidos',     'slug' => 'pos-orders',  'description' => 'Order management',   'parent_id' => $pos->id, 'sub_parent_id' => 2, 'sub_identifier' => null, 'is_active' => true]);
        $facturacion = Module::create(['name' => 'Facturación', 'slug' => 'pos-billing', 'description' => 'Billing management', 'parent_id' => $pos->id, 'sub_parent_id' => 3, 'sub_identifier' => null, 'is_active' => true]);
        $pagos       = Module::create(['name' => 'Pagos',       'slug' => 'pos-payments','description' => 'Payment management', 'parent_id' => $pos->id, 'sub_parent_id' => 4, 'sub_identifier' => null, 'is_active' => true]);

        // Nivel 2: Hijos de Mesas
        Module::create(['name' => 'Apertura',  'slug' => 'table-open',   'description' => 'Table opening',   'parent_id' => $mesas->id, 'sub_parent_id' => 1, 'sub_identifier' => '1.1', 'is_active' => true]);
        Module::create(['name' => 'Cambio',    'slug' => 'table-change', 'description' => 'Table change',    'parent_id' => $mesas->id, 'sub_parent_id' => 2, 'sub_identifier' => '1.2', 'is_active' => true]);
        Module::create(['name' => 'Unión',     'slug' => 'table-merge',  'description' => 'Table merge',     'parent_id' => $mesas->id, 'sub_parent_id' => 3, 'sub_identifier' => '1.3', 'is_active' => true]);
        Module::create(['name' => 'División',  'slug' => 'table-split',  'description' => 'Table split',     'parent_id' => $mesas->id, 'sub_parent_id' => 4, 'sub_identifier' => '1.4', 'is_active' => true]);
        Module::create(['name' => 'Estado',    'slug' => 'table-status', 'description' => 'Table status',    'parent_id' => $mesas->id, 'sub_parent_id' => 5, 'sub_identifier' => '1.5', 'is_active' => true]);

        // Nivel 2: Hijos de Pedidos
        Module::create(['name' => 'Productos',     'slug' => 'order-products',     'description' => 'Order products',     'parent_id' => $pedidos->id, 'sub_parent_id' => 1, 'sub_identifier' => '2.1', 'is_active' => true]);
        Module::create(['name' => 'Observaciones', 'slug' => 'order-observations', 'description' => 'Order observations', 'parent_id' => $pedidos->id, 'sub_parent_id' => 2, 'sub_identifier' => '2.2', 'is_active' => true]);
        Module::create(['name' => 'Modificadores', 'slug' => 'order-modifiers',    'description' => 'Order modifiers',    'parent_id' => $pedidos->id, 'sub_parent_id' => 3, 'sub_identifier' => '2.3', 'is_active' => true]);
        Module::create(['name' => 'Comandas',      'slug' => 'order-tickets',      'description' => 'Order tickets',      'parent_id' => $pedidos->id, 'sub_parent_id' => 4, 'sub_identifier' => '2.4', 'is_active' => true]);
        Module::create(['name' => 'Estados',       'slug' => 'order-statuses',     'description' => 'Order statuses',     'parent_id' => $pedidos->id, 'sub_parent_id' => 5, 'sub_identifier' => '2.5', 'is_active' => true]);
        Module::create(['name' => 'Historial',     'slug' => 'order-history',      'description' => 'Order history',      'parent_id' => $pedidos->id, 'sub_parent_id' => 6, 'sub_identifier' => '2.6', 'is_active' => true]);

        // Nivel 2: Hijos de Facturación POS
        Module::create(['name' => 'Descuentos',  'slug' => 'billing-discounts',   'description' => 'Billing discounts',   'parent_id' => $facturacion->id, 'sub_parent_id' => 1, 'sub_identifier' => '3.1', 'is_active' => true]);
        Module::create(['name' => 'Propinas',    'slug' => 'billing-tips',        'description' => 'Billing tips',        'parent_id' => $facturacion->id, 'sub_parent_id' => 2, 'sub_identifier' => '3.2', 'is_active' => true]);
        Module::create(['name' => 'Facturas',    'slug' => 'billing-invoices',    'description' => 'Billing invoices',    'parent_id' => $facturacion->id, 'sub_parent_id' => 3, 'sub_identifier' => '3.3', 'is_active' => true]);
        Module::create(['name' => 'Reimpresión', 'slug' => 'billing-reprint',     'description' => 'Invoice reprint',     'parent_id' => $facturacion->id, 'sub_parent_id' => 4, 'sub_identifier' => '3.4', 'is_active' => true]);
        Module::create(['name' => 'Anulaciones', 'slug' => 'billing-cancels',     'description' => 'Invoice cancellations','parent_id' => $facturacion->id, 'sub_parent_id' => 5, 'sub_identifier' => '3.5', 'is_active' => true]);

        // Nivel 2: Hijos de Pagos POS
        Module::create(['name' => 'Efectivo',      'slug' => 'payment-cash',     'description' => 'Cash payment',         'parent_id' => $pagos->id, 'sub_parent_id' => 1, 'sub_identifier' => '4.1', 'is_active' => true]);
        Module::create(['name' => 'Tarjeta',       'slug' => 'payment-card',     'description' => 'Card payment',         'parent_id' => $pagos->id, 'sub_parent_id' => 2, 'sub_identifier' => '4.2', 'is_active' => true]);
        Module::create(['name' => 'Transferencia', 'slug' => 'payment-transfer', 'description' => 'Transfer payment',     'parent_id' => $pagos->id, 'sub_parent_id' => 3, 'sub_identifier' => '4.3', 'is_active' => true]);
        Module::create(['name' => 'QR',            'slug' => 'payment-qr',       'description' => 'QR payment',           'parent_id' => $pagos->id, 'sub_parent_id' => 4, 'sub_identifier' => '4.4', 'is_active' => true]);
        Module::create(['name' => 'Mixto',         'slug' => 'payment-mixed',    'description' => 'Mixed payment',        'parent_id' => $pagos->id, 'sub_parent_id' => 5, 'sub_identifier' => '4.5', 'is_active' => true]);

        // Nivel 1: Hijos de Cocina
        Module::create(['name' => 'Pedidos pendientes', 'slug' => 'kitchen-pending',   'description' => 'Pending kitchen orders',    'parent_id' => $kitchen->id, 'sub_parent_id' => 1, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'En preparación',     'slug' => 'kitchen-preparing', 'description' => 'Orders in preparation',     'parent_id' => $kitchen->id, 'sub_parent_id' => 2, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Listos',             'slug' => 'kitchen-ready',     'description' => 'Ready orders',              'parent_id' => $kitchen->id, 'sub_parent_id' => 3, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Entregados',         'slug' => 'kitchen-delivered', 'description' => 'Delivered orders',          'parent_id' => $kitchen->id, 'sub_parent_id' => 4, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Tiempos',            'slug' => 'kitchen-times',     'description' => 'Kitchen preparation times', 'parent_id' => $kitchen->id, 'sub_parent_id' => 5, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Historial',          'slug' => 'kitchen-history',   'description' => 'Kitchen history',           'parent_id' => $kitchen->id, 'sub_parent_id' => 6, 'sub_identifier' => null, 'is_active' => true]);

        // Nivel 1: Hijos de Caja
        Module::create(['name' => 'Apertura',    'slug' => 'cash-open',        'description' => 'Cash register opening',   'parent_id' => $cashier->id, 'sub_parent_id' => 1, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Cierre',      'slug' => 'cash-close',       'description' => 'Cash register closing',   'parent_id' => $cashier->id, 'sub_parent_id' => 2, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Arqueo',      'slug' => 'cash-count',       'description' => 'Cash count',              'parent_id' => $cashier->id, 'sub_parent_id' => 3, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Retiros',     'slug' => 'cash-withdrawals', 'description' => 'Cash withdrawals',        'parent_id' => $cashier->id, 'sub_parent_id' => 4, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Ingresos',    'slug' => 'cash-income',      'description' => 'Cash income',             'parent_id' => $cashier->id, 'sub_parent_id' => 5, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Movimientos', 'slug' => 'cash-movements',   'description' => 'Cash movements',          'parent_id' => $cashier->id, 'sub_parent_id' => 6, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Diferencias', 'slug' => 'cash-differences', 'description' => 'Cash differences',        'parent_id' => $cashier->id, 'sub_parent_id' => 7, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Historial',   'slug' => 'cash-history',     'description' => 'Cash history',            'parent_id' => $cashier->id, 'sub_parent_id' => 8, 'sub_identifier' => null, 'is_active' => true]);

        // Nivel 1: Hijos de Compras
        Module::create(['name' => 'Proveedores',       'slug' => 'suppliers',         'description' => 'Supplier management',       'parent_id' => $purchases->id, 'sub_parent_id' => 1, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Cotizaciones',      'slug' => 'quotes',            'description' => 'Purchase quotes',           'parent_id' => $purchases->id, 'sub_parent_id' => 2, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Órdenes de compra', 'slug' => 'purchase-orders',   'description' => 'Purchase orders',           'parent_id' => $purchases->id, 'sub_parent_id' => 3, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Recepción',         'slug' => 'purchase-receipts', 'description' => 'Purchase receipts',         'parent_id' => $purchases->id, 'sub_parent_id' => 4, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Facturas',          'slug' => 'purchase-invoices', 'description' => 'Purchase invoices',         'parent_id' => $purchases->id, 'sub_parent_id' => 5, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Devoluciones',      'slug' => 'purchase-returns',  'description' => 'Purchase returns',          'parent_id' => $purchases->id, 'sub_parent_id' => 6, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Cuentas por pagar', 'slug' => 'accounts-payable',  'description' => 'Accounts payable',          'parent_id' => $purchases->id, 'sub_parent_id' => 7, 'sub_identifier' => null, 'is_active' => true]);

        // Nivel 1: Hijos de CRM
        Module::create(['name' => 'Clientes',          'slug' => 'customers',         'description' => 'Customer management',       'parent_id' => $crm->id, 'sub_parent_id' => 1, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Fidelización',      'slug' => 'loyalty',           'description' => 'Loyalty management',        'parent_id' => $crm->id, 'sub_parent_id' => 2, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Puntos',            'slug' => 'points',            'description' => 'Points management',         'parent_id' => $crm->id, 'sub_parent_id' => 3, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Bonos',             'slug' => 'bonuses',           'description' => 'Bonus management',          'parent_id' => $crm->id, 'sub_parent_id' => 4, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Gift Cards',        'slug' => 'gift-cards',        'description' => 'Gift card management',      'parent_id' => $crm->id, 'sub_parent_id' => 5, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Consumo promedio',  'slug' => 'avg-consumption',   'description' => 'Average consumption',       'parent_id' => $crm->id, 'sub_parent_id' => 6, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Historial',         'slug' => 'customer-history',  'description' => 'Customer history',          'parent_id' => $crm->id, 'sub_parent_id' => 7, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Preferencias',      'slug' => 'preferences',       'description' => 'Customer preferences',      'parent_id' => $crm->id, 'sub_parent_id' => 8, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Cumpleaños',        'slug' => 'birthdays',         'description' => 'Customer birthdays',        'parent_id' => $crm->id, 'sub_parent_id' => 9, 'sub_identifier' => null, 'is_active' => true]);

        // Nivel 1: Hijos de Personal
        Module::create(['name' => 'Empleados',   'slug' => 'employees',    'description' => 'Employee management',  'parent_id' => $staff->id, 'sub_parent_id' => 1, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Meseros',     'slug' => 'waiters',      'description' => 'Waiter management',    'parent_id' => $staff->id, 'sub_parent_id' => 2, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Cajeros',     'slug' => 'cashiers',     'description' => 'Cashier management',   'parent_id' => $staff->id, 'sub_parent_id' => 3, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Bartenders',  'slug' => 'bartenders',   'description' => 'Bartender management', 'parent_id' => $staff->id, 'sub_parent_id' => 4, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Cocineros',   'slug' => 'cooks',        'description' => 'Cook management',      'parent_id' => $staff->id, 'sub_parent_id' => 5, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Turnos',      'slug' => 'shifts',       'description' => 'Shift management',     'parent_id' => $staff->id, 'sub_parent_id' => 6, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Horarios',    'slug' => 'schedules',    'description' => 'Schedule management',  'parent_id' => $staff->id, 'sub_parent_id' => 7, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Comisiones',  'slug' => 'commissions',  'description' => 'Commission management','parent_id' => $staff->id, 'sub_parent_id' => 8, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Desempeño',   'slug' => 'performance',  'description' => 'Performance tracking', 'parent_id' => $staff->id, 'sub_parent_id' => 9, 'sub_identifier' => null, 'is_active' => true]);

        // Nivel 1: Hijos de Música
        Module::create(['name' => 'Playlist',      'slug' => 'playlists',       'description' => 'Playlist management',    'parent_id' => $music->id, 'sub_parent_id' => 1, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Solicitudes',   'slug' => 'music-requests',  'description' => 'Music requests',         'parent_id' => $music->id, 'sub_parent_id' => 2, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Programación',  'slug' => 'music-schedule',  'description' => 'Music schedule',         'parent_id' => $music->id, 'sub_parent_id' => 3, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Historial',     'slug' => 'music-history',   'description' => 'Music history',          'parent_id' => $music->id, 'sub_parent_id' => 4, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Votaciones',    'slug' => 'music-votes',     'description' => 'Music voting',           'parent_id' => $music->id, 'sub_parent_id' => 5, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Código QR',     'slug' => 'music-qr',        'description' => 'Music QR code',          'parent_id' => $music->id, 'sub_parent_id' => 6, 'sub_identifier' => null, 'is_active' => true]);

        // Nivel 1: Hijos de Reportes
        Module::create(['name' => 'Ventas',      'slug' => 'reports-sales',      'description' => 'Sales reports',      'parent_id' => $reports->id, 'sub_parent_id' => 1, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Inventario',  'slug' => 'reports-inventory',  'description' => 'Inventory reports',  'parent_id' => $reports->id, 'sub_parent_id' => 2, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Caja',        'slug' => 'reports-cash',       'description' => 'Cash reports',       'parent_id' => $reports->id, 'sub_parent_id' => 3, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Compras',     'slug' => 'reports-purchases',  'description' => 'Purchase reports',   'parent_id' => $reports->id, 'sub_parent_id' => 4, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Clientes',    'slug' => 'reports-customers',  'description' => 'Customer reports',   'parent_id' => $reports->id, 'sub_parent_id' => 5, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Personal',    'slug' => 'reports-staff',      'description' => 'Staff reports',      'parent_id' => $reports->id, 'sub_parent_id' => 6, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Productos',   'slug' => 'reports-products',   'description' => 'Product reports',    'parent_id' => $reports->id, 'sub_parent_id' => 7, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Utilidad',    'slug' => 'reports-profit',     'description' => 'Profit reports',     'parent_id' => $reports->id, 'sub_parent_id' => 8, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Indicadores', 'slug' => 'reports-kpi',        'description' => 'KPI indicators',     'parent_id' => $reports->id, 'sub_parent_id' => 9, 'sub_identifier' => null, 'is_active' => true]);

        // Nivel 1: Hijos de Reservas
        Module::create(['name' => 'Calendario',      'slug' => 'reservations-calendar', 'description' => 'Reservation calendar',   'parent_id' => $reservations->id, 'sub_parent_id' => 1, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Mesas',           'slug' => 'reservations-tables',   'description' => 'Reservation tables',     'parent_id' => $reservations->id, 'sub_parent_id' => 2, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Clientes',        'slug' => 'reservations-customers','description' => 'Reservation customers',  'parent_id' => $reservations->id, 'sub_parent_id' => 3, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Confirmaciones',  'slug' => 'reservations-confirm',  'description' => 'Reservation confirmations','parent_id' => $reservations->id, 'sub_parent_id' => 4, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Lista de espera', 'slug' => 'waitlist',              'description' => 'Waiting list',           'parent_id' => $reservations->id, 'sub_parent_id' => 5, 'sub_identifier' => null, 'is_active' => true]);

        // Nivel 1: Hijos de Delivery
        Module::create(['name' => 'Pedidos',      'slug' => 'delivery-orders',   'description' => 'Delivery orders',    'parent_id' => $delivery->id, 'sub_parent_id' => 1, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Repartidores', 'slug' => 'delivery-drivers',  'description' => 'Delivery drivers',   'parent_id' => $delivery->id, 'sub_parent_id' => 2, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Estado',       'slug' => 'delivery-status',   'description' => 'Delivery status',    'parent_id' => $delivery->id, 'sub_parent_id' => 3, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Rutas',        'slug' => 'delivery-routes',   'description' => 'Delivery routes',    'parent_id' => $delivery->id, 'sub_parent_id' => 4, 'sub_identifier' => null, 'is_active' => true]);
        Module::create(['name' => 'Historial',    'slug' => 'delivery-history',  'description' => 'Delivery history',   'parent_id' => $delivery->id, 'sub_parent_id' => 5, 'sub_identifier' => null, 'is_active' => true]);
    }
}
