<?php

namespace App\Providers;

use App\Context\TenantContext;
use Illuminate\Support\ServiceProvider;

// Auth
use App\Repositories\Interfaces\Auth\AuthRepositoryInterface;
use App\Repositories\Eloquent\Auth\AuthRepository;

// Admin
use App\Repositories\Interfaces\Admin\TenantRepositoryInterface;
use App\Repositories\Interfaces\Admin\BranchRepositoryInterface;
use App\Repositories\Interfaces\Admin\UserRepositoryInterface;
use App\Repositories\Interfaces\Admin\RoleRepositoryInterface;
use App\Repositories\Interfaces\Admin\PermissionRepositoryInterface;
use App\Repositories\Interfaces\Admin\RolePermissionRepositoryInterface;
use App\Repositories\Interfaces\Admin\TaxRepositoryInterface;
use App\Repositories\Interfaces\Admin\PaymentMethodRepositoryInterface;
use App\Repositories\Interfaces\Admin\PaymentMethodConfigRepositoryInterface;
use App\Repositories\Interfaces\Admin\NumberingSequenceRepositoryInterface;
use App\Repositories\Interfaces\Admin\CurrencyRepositoryInterface;
use App\Repositories\Interfaces\Admin\CurrencyRateRepositoryInterface;
use App\Repositories\Interfaces\Admin\TenantSettingRepositoryInterface;
use App\Repositories\Eloquent\Admin\TenantRepository;
use App\Repositories\Eloquent\Admin\BranchRepository;
use App\Repositories\Eloquent\Admin\UserRepository;
use App\Repositories\Eloquent\Admin\RoleRepository;
use App\Repositories\Eloquent\Admin\PermissionRepository;
use App\Repositories\Eloquent\Admin\RolePermissionRepository;
use App\Repositories\Eloquent\Admin\TaxRepository;
use App\Repositories\Eloquent\Admin\PaymentMethodRepository;
use App\Repositories\Eloquent\Admin\PaymentMethodConfigRepository;
use App\Repositories\Eloquent\Admin\NumberingSequenceRepository;
use App\Repositories\Eloquent\Admin\CurrencyRepository;
use App\Repositories\Eloquent\Admin\CurrencyRateRepository;
use App\Repositories\Eloquent\Admin\TenantSettingRepository;

// Products
use App\Repositories\Interfaces\Products\ProductRepositoryInterface;
use App\Repositories\Interfaces\Products\ProductTypeRepositoryInterface;
use App\Repositories\Interfaces\Products\CategoryRepositoryInterface;
use App\Repositories\Interfaces\Products\ProductVariantRepositoryInterface;
use App\Repositories\Interfaces\Products\IngredientRepositoryInterface;
use App\Repositories\Interfaces\Products\RecipeRepositoryInterface;
use App\Repositories\Interfaces\Products\ComboRepositoryInterface;
use App\Repositories\Interfaces\Products\ModifierRepositoryInterface;
use App\Repositories\Interfaces\Products\PromotionRepositoryInterface;
use App\Repositories\Interfaces\Products\PriceListRepositoryInterface;
use App\Repositories\Interfaces\Products\PriceListItemRepositoryInterface;
use App\Repositories\Eloquent\Products\ProductRepository;
use App\Repositories\Eloquent\Products\ProductTypeRepository;
use App\Repositories\Eloquent\Products\CategoryRepository;
use App\Repositories\Eloquent\Products\ProductVariantRepository;
use App\Repositories\Eloquent\Products\IngredientRepository;
use App\Repositories\Eloquent\Products\RecipeRepository;
use App\Repositories\Eloquent\Products\ComboRepository;
use App\Repositories\Eloquent\Products\ModifierRepository;
use App\Repositories\Eloquent\Products\PromotionRepository;
use App\Repositories\Eloquent\Products\PriceListRepository;
use App\Repositories\Eloquent\Products\PriceListItemRepository;

// Inventory
use App\Repositories\Interfaces\Inventory\WarehouseRepositoryInterface;
use App\Repositories\Interfaces\Inventory\WarehouseTypeRepositoryInterface;
use App\Repositories\Interfaces\Inventory\InventoryRepositoryInterface;
use App\Repositories\Interfaces\Inventory\InventoryMovementRepositoryInterface;
use App\Repositories\Interfaces\Inventory\InventoryTransferRepositoryInterface;
use App\Repositories\Interfaces\Inventory\InventoryAdjustmentRepositoryInterface;
use App\Repositories\Interfaces\Inventory\InventoryAdjustmentItemRepositoryInterface;
use App\Repositories\Interfaces\Inventory\InventoryLotRepositoryInterface;
use App\Repositories\Eloquent\Inventory\WarehouseRepository;
use App\Repositories\Eloquent\Inventory\WarehouseTypeRepository;
use App\Repositories\Eloquent\Inventory\InventoryRepository;
use App\Repositories\Eloquent\Inventory\InventoryMovementRepository;
use App\Repositories\Eloquent\Inventory\InventoryTransferRepository;
use App\Repositories\Eloquent\Inventory\InventoryAdjustmentRepository;
use App\Repositories\Eloquent\Inventory\InventoryAdjustmentItemRepository;
use App\Repositories\Eloquent\Inventory\InventoryLotRepository;

// POS
use App\Repositories\Interfaces\POS\RestaurantTableRepositoryInterface;
use App\Repositories\Interfaces\POS\OrderRepositoryInterface;
use App\Repositories\Interfaces\POS\InvoiceRepositoryInterface;
use App\Repositories\Interfaces\POS\PaymentRepositoryInterface;
use App\Repositories\Eloquent\POS\RestaurantTableRepository;
use App\Repositories\Eloquent\POS\OrderRepository;
use App\Repositories\Eloquent\POS\InvoiceRepository;
use App\Repositories\Eloquent\POS\PaymentRepository;

// Kitchen
use App\Repositories\Interfaces\Kitchen\KitchenOrderRepositoryInterface;
use App\Repositories\Eloquent\Kitchen\KitchenOrderRepository;

// Cash
use App\Repositories\Interfaces\Cash\CashRegisterRepositoryInterface;
use App\Repositories\Interfaces\Cash\CashSessionRepositoryInterface;
use App\Repositories\Interfaces\Cash\CashMovementRepositoryInterface;
use App\Repositories\Eloquent\Cash\CashRegisterRepository;
use App\Repositories\Eloquent\Cash\CashSessionRepository;
use App\Repositories\Eloquent\Cash\CashMovementRepository;

// Purchases
use App\Repositories\Interfaces\Purchases\SupplierRepositoryInterface;
use App\Repositories\Interfaces\Purchases\PurchaseOrderRepositoryInterface;
use App\Repositories\Interfaces\Purchases\PurchaseReceiptRepositoryInterface;
use App\Repositories\Eloquent\Purchases\SupplierRepository;
use App\Repositories\Eloquent\Purchases\PurchaseOrderRepository;
use App\Repositories\Eloquent\Purchases\PurchaseReceiptRepository;

// Customers
use App\Repositories\Interfaces\Customers\CustomerRepositoryInterface;
use App\Repositories\Interfaces\Customers\LoyaltyAccountRepositoryInterface;
use App\Repositories\Interfaces\Customers\GiftCardRepositoryInterface;
use App\Repositories\Eloquent\Customers\CustomerRepository;
use App\Repositories\Eloquent\Customers\LoyaltyAccountRepository;
use App\Repositories\Eloquent\Customers\GiftCardRepository;

// Staff
use App\Repositories\Interfaces\Staff\EmployeeRepositoryInterface;
use App\Repositories\Interfaces\Staff\PositionRepositoryInterface;
use App\Repositories\Interfaces\Staff\ShiftRepositoryInterface;
use App\Repositories\Eloquent\Staff\EmployeeRepository;
use App\Repositories\Eloquent\Staff\PositionRepository;
use App\Repositories\Eloquent\Staff\ShiftRepository;

// Music
use App\Repositories\Interfaces\Music\PlaylistRepositoryInterface;
use App\Repositories\Interfaces\Music\MusicRequestRepositoryInterface;
use App\Repositories\Eloquent\Music\PlaylistRepository;
use App\Repositories\Eloquent\Music\MusicRequestRepository;

// Reservations
use App\Repositories\Interfaces\Reservations\ReservationRepositoryInterface;
use App\Repositories\Eloquent\Reservations\ReservationRepository;

// Delivery
use App\Repositories\Interfaces\Delivery\DeliveryOrderRepositoryInterface;
use App\Repositories\Eloquent\Delivery\DeliveryOrderRepository;

// Dashboard
use App\Repositories\Interfaces\Dashboard\DashboardRepositoryInterface;
use App\Repositories\Eloquent\Dashboard\DashboardRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TenantContext::class);

        $bindings = [
            // Auth
            AuthRepositoryInterface::class              => AuthRepository::class,
            // Admin
            TenantRepositoryInterface::class            => TenantRepository::class,
            BranchRepositoryInterface::class            => BranchRepository::class,
            UserRepositoryInterface::class              => UserRepository::class,
            RoleRepositoryInterface::class              => RoleRepository::class,
            PermissionRepositoryInterface::class        => PermissionRepository::class,
            RolePermissionRepositoryInterface::class    => RolePermissionRepository::class,
            TaxRepositoryInterface::class               => TaxRepository::class,
            PaymentMethodRepositoryInterface::class        => PaymentMethodRepository::class,
            PaymentMethodConfigRepositoryInterface::class   => PaymentMethodConfigRepository::class,
            NumberingSequenceRepositoryInterface::class => NumberingSequenceRepository::class,
            CurrencyRepositoryInterface::class          => CurrencyRepository::class,
            CurrencyRateRepositoryInterface::class      => CurrencyRateRepository::class,
            TenantSettingRepositoryInterface::class     => TenantSettingRepository::class,
            // Products
            ProductRepositoryInterface::class           => ProductRepository::class,
            ProductTypeRepositoryInterface::class       => ProductTypeRepository::class,
            CategoryRepositoryInterface::class          => CategoryRepository::class,
            ProductVariantRepositoryInterface::class    => ProductVariantRepository::class,
            IngredientRepositoryInterface::class        => IngredientRepository::class,
            RecipeRepositoryInterface::class            => RecipeRepository::class,
            ComboRepositoryInterface::class             => ComboRepository::class,
            ModifierRepositoryInterface::class          => ModifierRepository::class,
            PromotionRepositoryInterface::class         => PromotionRepository::class,
            PriceListRepositoryInterface::class         => PriceListRepository::class,
            PriceListItemRepositoryInterface::class      => PriceListItemRepository::class,
            // Inventory
            WarehouseRepositoryInterface::class         => WarehouseRepository::class,
            WarehouseTypeRepositoryInterface::class      => WarehouseTypeRepository::class,
            InventoryRepositoryInterface::class         => InventoryRepository::class,
            InventoryMovementRepositoryInterface::class => InventoryMovementRepository::class,
            InventoryTransferRepositoryInterface::class => InventoryTransferRepository::class,
            InventoryAdjustmentRepositoryInterface::class => InventoryAdjustmentRepository::class,
            InventoryAdjustmentItemRepositoryInterface::class => InventoryAdjustmentItemRepository::class,
            InventoryLotRepositoryInterface::class      => InventoryLotRepository::class,
            // POS
            RestaurantTableRepositoryInterface::class   => RestaurantTableRepository::class,
            OrderRepositoryInterface::class             => OrderRepository::class,
            InvoiceRepositoryInterface::class           => InvoiceRepository::class,
            PaymentRepositoryInterface::class           => PaymentRepository::class,
            // Kitchen
            KitchenOrderRepositoryInterface::class      => KitchenOrderRepository::class,
            // Cash
            CashRegisterRepositoryInterface::class      => CashRegisterRepository::class,
            CashSessionRepositoryInterface::class       => CashSessionRepository::class,
            CashMovementRepositoryInterface::class      => CashMovementRepository::class,
            // Purchases
            SupplierRepositoryInterface::class          => SupplierRepository::class,
            PurchaseOrderRepositoryInterface::class     => PurchaseOrderRepository::class,
            PurchaseReceiptRepositoryInterface::class   => PurchaseReceiptRepository::class,
            // Customers
            CustomerRepositoryInterface::class          => CustomerRepository::class,
            LoyaltyAccountRepositoryInterface::class    => LoyaltyAccountRepository::class,
            GiftCardRepositoryInterface::class          => GiftCardRepository::class,
            // Staff
            EmployeeRepositoryInterface::class          => EmployeeRepository::class,
            PositionRepositoryInterface::class          => PositionRepository::class,
            ShiftRepositoryInterface::class             => ShiftRepository::class,
            // Music
            PlaylistRepositoryInterface::class          => PlaylistRepository::class,
            MusicRequestRepositoryInterface::class      => MusicRequestRepository::class,
            // Reservations
            ReservationRepositoryInterface::class       => ReservationRepository::class,
            // Delivery
            DeliveryOrderRepositoryInterface::class     => DeliveryOrderRepository::class,
            // Dashboard
            DashboardRepositoryInterface::class         => DashboardRepository::class,
        ];

        foreach ($bindings as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}

