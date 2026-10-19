<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [\App\Http\Controllers\Api\Auth\AuthController::class, 'login']);
    Route::post('mfa/send-email', [\App\Http\Controllers\Api\Auth\AuthController::class, 'sendEmail']);
    Route::post('mfa/send-whatsapp', [\App\Http\Controllers\Api\Auth\AuthController::class, 'sendWhatsapp']);
    Route::post('verify-mfa', [\App\Http\Controllers\Api\Auth\AuthController::class, 'verifyMfa']);
    Route::post('forgot-password', [\App\Http\Controllers\Api\Auth\AuthController::class, 'forgotPassword']);
    Route::post('reset-password', [\App\Http\Controllers\Api\Auth\AuthController::class, 'resetPassword']);
});

Route::middleware(['auth:api', 'tenant'])->group(function () {
    // Dashboard
    Route::get('dashboard/sales-summary', [\App\Http\Controllers\Api\DashboardController::class, 'salesSummary']);
    Route::get('dashboard/cash-summary', [\App\Http\Controllers\Api\DashboardController::class, 'cashSummary']);
    Route::get('dashboard/tables-summary', [\App\Http\Controllers\Api\DashboardController::class, 'tablesSummary']);
    Route::get('dashboard/kitchen-summary', [\App\Http\Controllers\Api\DashboardController::class, 'kitchenSummary']);
    Route::get('dashboard/kitchen-orders', [\App\Http\Controllers\Api\DashboardController::class, 'kitchenOrders']);
    Route::get('dashboard/sales-by-hour', [\App\Http\Controllers\Api\DashboardController::class, 'salesByHour']);
    Route::get('dashboard/top-products', [\App\Http\Controllers\Api\DashboardController::class, 'topProducts']);
    Route::get('dashboard/critical-inventory', [\App\Http\Controllers\Api\DashboardController::class, 'criticalInventory']);
    Route::get('dashboard/recent-activity', [\App\Http\Controllers\Api\DashboardController::class, 'recentActivity']);
    Route::get('dashboard/alerts', [\App\Http\Controllers\Api\AlertController::class, 'index']);
    Route::get('alerts/types', [\App\Http\Controllers\Api\AlertController::class, 'types']);

    // Admin
    Route::get('modules/menu', [\App\Http\Controllers\Api\Admin\ModuleController::class, 'menu']);
    Route::get('modules/root', [\App\Http\Controllers\Api\Admin\ModuleController::class, 'root']);
    Route::get('branches/active', [\App\Http\Controllers\Api\Admin\BranchController::class, 'active']);
    Route::patch('branches/{branch}/status', [\App\Http\Controllers\Api\Admin\BranchController::class, 'toggleStatus']);
    Route::get('roles/active', [\App\Http\Controllers\Api\Admin\RoleController::class, 'active']);
    Route::patch('roles/{role}/status', [\App\Http\Controllers\Api\Admin\RoleController::class, 'toggleStatus']);
    Route::patch('users/{user}/status', [\App\Http\Controllers\Api\Admin\UserController::class, 'toggleStatus']);
    Route::patch('tenants/{tenant}/status', [\App\Http\Controllers\Api\Admin\TenantController::class, 'toggleStatus']);
    Route::get('cities', [\App\Http\Controllers\Api\Admin\CityController::class, 'index']);
    Route::get('administration/company', [\App\Http\Controllers\Api\Admin\CompanyController::class, 'show']);
    Route::put('administration/company', [\App\Http\Controllers\Api\Admin\CompanyController::class, 'update']);
    Route::post('administration/company/logo', [\App\Http\Controllers\Api\Admin\CompanyController::class, 'uploadLogo']);
    Route::delete('administration/company/logo', [\App\Http\Controllers\Api\Admin\CompanyController::class, 'deleteLogo']);
    Route::get('administration/fiscal-data', [\App\Http\Controllers\Api\Admin\CompanyController::class, 'fiscalData']);
    Route::put('administration/fiscal-data', [\App\Http\Controllers\Api\Admin\CompanyController::class, 'updateFiscalData']);
    Route::delete('administration/fiscal-data', [\App\Http\Controllers\Api\Admin\CompanyController::class, 'deleteFiscalData']);
    Route::get('role-permissions', [\App\Http\Controllers\Api\Admin\RolePermissionController::class, 'index']);
    Route::post('role-permissions', [\App\Http\Controllers\Api\Admin\RolePermissionController::class, 'store']);
    Route::put('role-permissions/{id}', [\App\Http\Controllers\Api\Admin\RolePermissionController::class, 'update']);
    Route::delete('role-permissions/{id}', [\App\Http\Controllers\Api\Admin\RolePermissionController::class, 'destroy']);
    Route::apiResource('tenants', \App\Http\Controllers\Api\Admin\TenantController::class);
    Route::apiResource('branches', \App\Http\Controllers\Api\Admin\BranchController::class);
    Route::apiResource('users', \App\Http\Controllers\Api\Admin\UserController::class);
    Route::apiResource('roles', \App\Http\Controllers\Api\Admin\RoleController::class);
    Route::patch('permissions/{permission}/status', [\App\Http\Controllers\Api\Admin\PermissionController::class, 'toggleStatus']);
    Route::apiResource('permissions', \App\Http\Controllers\Api\Admin\PermissionController::class);
    Route::apiResource('taxes', \App\Http\Controllers\Api\Admin\TaxController::class);
    Route::get('payment-methods/active', [\App\Http\Controllers\Api\Admin\PaymentMethodController::class, 'active']);
    Route::get('payment-methods/types', [\App\Http\Controllers\Api\Admin\PaymentMethodController::class, 'types']);
    Route::patch('payment-methods/{payment_method}/status', [\App\Http\Controllers\Api\Admin\PaymentMethodController::class, 'toggleStatus']);
    Route::get('payment-method-configs', [\App\Http\Controllers\Api\Admin\PaymentMethodConfigController::class, 'index']);
    Route::post('payment-method-configs', [\App\Http\Controllers\Api\Admin\PaymentMethodConfigController::class, 'store']);
    Route::put('payment-method-configs/{id}', [\App\Http\Controllers\Api\Admin\PaymentMethodConfigController::class, 'update']);
    Route::delete('payment-method-configs/{id}', [\App\Http\Controllers\Api\Admin\PaymentMethodConfigController::class, 'destroy']);
    Route::apiResource('payment-methods', \App\Http\Controllers\Api\Admin\PaymentMethodController::class);
    Route::apiResource('numbering-sequences', \App\Http\Controllers\Api\Admin\NumberingSequenceController::class);
    Route::get('currencies/types', [\App\Http\Controllers\Api\Admin\CurrencyController::class, 'types']);
    Route::patch('currencies/{currency}/status', [\App\Http\Controllers\Api\Admin\CurrencyController::class, 'toggleStatus']);
    Route::patch('currencies/{currency}/default', [\App\Http\Controllers\Api\Admin\CurrencyController::class, 'setDefault']);
    Route::apiResource('currencies', \App\Http\Controllers\Api\Admin\CurrencyController::class);
    Route::get('currency-rates', [\App\Http\Controllers\Api\Admin\CurrencyRateController::class, 'index']);
    Route::post('currency-rates', [\App\Http\Controllers\Api\Admin\CurrencyRateController::class, 'store']);
    Route::delete('currency-rates/{id}', [\App\Http\Controllers\Api\Admin\CurrencyRateController::class, 'destroy']);
    Route::apiResource('tenant-settings', \App\Http\Controllers\Api\Admin\TenantSettingController::class);

    // Products
    Route::get('product-types/active', [\App\Http\Controllers\Api\Products\ProductController::class, 'activeTypes']);
    Route::get('products/count', [\App\Http\Controllers\Api\Products\ProductController::class, 'count']);
    Route::get('products/template', [\App\Http\Controllers\Api\Products\ProductController::class, 'template']);
    Route::post('products/import', [\App\Http\Controllers\Api\Products\ProductController::class, 'import']);
    Route::post('products/bulk-import', [\App\Http\Controllers\Api\Products\ProductController::class, 'bulkImport']);
    Route::patch('product-types/{product_type}/status', [\App\Http\Controllers\Api\Products\ProductTypeController::class, 'toggleStatus']);
    Route::apiResource('product-types', \App\Http\Controllers\Api\Products\ProductTypeController::class);
    Route::get('categories/active', [\App\Http\Controllers\Api\Products\CategoryController::class, 'active']);
    Route::patch('categories/{category}/status', [\App\Http\Controllers\Api\Products\CategoryController::class, 'toggleStatus']);
    Route::get('products/active', [\App\Http\Controllers\Api\Products\ProductController::class, 'activeProducts']);
    Route::apiResource('products', \App\Http\Controllers\Api\Products\ProductController::class);
    Route::apiResource('categories', \App\Http\Controllers\Api\Products\CategoryController::class);
    Route::patch('product-variants/{product_variant}/status', [\App\Http\Controllers\Api\Products\ProductVariantController::class, 'toggleStatus']);
    Route::get('product-variants/template', [\App\Http\Controllers\Api\Products\ProductVariantController::class, 'template']);
    Route::post('product-variants/bulk-import', [\App\Http\Controllers\Api\Products\ProductVariantController::class, 'bulkImport']);
    Route::apiResource('product-variants', \App\Http\Controllers\Api\Products\ProductVariantController::class);
    Route::get('ingredients/active', [\App\Http\Controllers\Api\Products\IngredientController::class, 'active']);
    Route::patch('ingredients/{ingredient}/status', [\App\Http\Controllers\Api\Products\IngredientController::class, 'toggleStatus']);
    Route::apiResource('ingredients', \App\Http\Controllers\Api\Products\IngredientController::class);
    Route::patch('recipes/{recipe}/status', [\App\Http\Controllers\Api\Products\RecipeController::class, 'toggleStatus']);
    Route::apiResource('recipes', \App\Http\Controllers\Api\Products\RecipeController::class);
    Route::get('combos/active', [\App\Http\Controllers\Api\Products\ComboController::class, 'active']);
    Route::patch('combos/{combo}/status', [\App\Http\Controllers\Api\Products\ComboController::class, 'toggleStatus']);
    Route::apiResource('combos', \App\Http\Controllers\Api\Products\ComboController::class);
    Route::patch('modifiers/{modifier}/status', [\App\Http\Controllers\Api\Products\ModifierController::class, 'toggleStatus']);
    Route::apiResource('modifiers', \App\Http\Controllers\Api\Products\ModifierController::class);
    Route::patch('promotions/{promotion}/status', [\App\Http\Controllers\Api\Products\PromotionController::class, 'toggleStatus']);
    Route::apiResource('promotions', \App\Http\Controllers\Api\Products\PromotionController::class);
    Route::patch('price-lists/{price_list}/status', [\App\Http\Controllers\Api\Products\PriceListController::class, 'toggleStatus']);
    Route::apiResource('price-lists', \App\Http\Controllers\Api\Products\PriceListController::class);
    Route::get('price-list-items/entity-types', [\App\Http\Controllers\Api\Products\PriceListItemController::class, 'entityTypes']);
    Route::apiResource('price-list-items', \App\Http\Controllers\Api\Products\PriceListItemController::class);

    // Inventory
    Route::get('warehouses/active', [\App\Http\Controllers\Api\Inventory\WarehouseController::class, 'active']);
    Route::get('warehouses/active/{id}', [\App\Http\Controllers\Api\Inventory\WarehouseController::class, 'activeById']);
    Route::patch('warehouses/{warehouse}/status', [\App\Http\Controllers\Api\Inventory\WarehouseController::class, 'toggleStatus']);
    Route::apiResource('warehouses', \App\Http\Controllers\Api\Inventory\WarehouseController::class);
    Route::get('warehouse-types/active', [\App\Http\Controllers\Api\Inventory\WarehouseTypeController::class, 'active']);
    Route::get('warehouse-types/active/{id}', [\App\Http\Controllers\Api\Inventory\WarehouseTypeController::class, 'activeById']);
    Route::patch('warehouse-types/{warehouse_type}/status', [\App\Http\Controllers\Api\Inventory\WarehouseTypeController::class, 'toggleStatus']);
    Route::apiResource('warehouse-types', \App\Http\Controllers\Api\Inventory\WarehouseTypeController::class);
    Route::get('inventory/total-average-cost', [\App\Http\Controllers\Api\Inventory\InventoryController::class, 'totalAverageCost']);
    Route::patch('inventory/{inventory}/quantities', [\App\Http\Controllers\Api\Inventory\InventoryController::class, 'updateQuantities']);
    Route::apiResource('inventory', \App\Http\Controllers\Api\Inventory\InventoryController::class);
    Route::patch('inventory-movements/by-reference/{inventoryId}', [\App\Http\Controllers\Api\Inventory\InventoryMovementController::class, 'updateByReference']);
    Route::apiResource('inventory-movements', \App\Http\Controllers\Api\Inventory\InventoryMovementController::class);
    Route::apiResource('inventory-transfers', \App\Http\Controllers\Api\Inventory\InventoryTransferController::class);
    Route::get('inventory-adjustments/active-items', [\App\Http\Controllers\Api\Inventory\InventoryAdjustmentController::class, 'activeItems']);
    Route::apiResource('inventory-adjustments', \App\Http\Controllers\Api\Inventory\InventoryAdjustmentController::class);
    Route::apiResource('inventory-adjustment-items', \App\Http\Controllers\Api\Inventory\InventoryAdjustmentItemController::class);
    Route::get('inventory-lots/by-product/{productId}', [\App\Http\Controllers\Api\Inventory\InventoryLotController::class, 'byProduct']);
    Route::apiResource('inventory-lots', \App\Http\Controllers\Api\Inventory\InventoryLotController::class);

    // POS
    Route::get('restaurant-tables/active', [\App\Http\Controllers\Api\POS\RestaurantTableController::class, 'active']);
    Route::apiResource('restaurant-tables', \App\Http\Controllers\Api\POS\RestaurantTableController::class);
    Route::apiResource('orders', \App\Http\Controllers\Api\POS\OrderController::class);
    Route::apiResource('invoices', \App\Http\Controllers\Api\POS\InvoiceController::class);
    Route::apiResource('payments', \App\Http\Controllers\Api\POS\PaymentController::class);

    // Kitchen
    Route::apiResource('kitchen-orders', \App\Http\Controllers\Api\Kitchen\KitchenOrderController::class);

    // Cash
    Route::apiResource('cash-registers', \App\Http\Controllers\Api\Cash\CashRegisterController::class);
    Route::apiResource('cash-sessions', \App\Http\Controllers\Api\Cash\CashSessionController::class);
    Route::apiResource('cash-movements', \App\Http\Controllers\Api\Cash\CashMovementController::class);

    // Purchases
    Route::apiResource('suppliers', \App\Http\Controllers\Api\Purchases\SupplierController::class);
    Route::apiResource('purchase-orders', \App\Http\Controllers\Api\Purchases\PurchaseOrderController::class);
    Route::apiResource('purchase-receipts', \App\Http\Controllers\Api\Purchases\PurchaseReceiptController::class);

    // Customers
    Route::get('customers/active', [\App\Http\Controllers\Api\Customers\CustomerController::class, 'active']);
    Route::apiResource('customers', \App\Http\Controllers\Api\Customers\CustomerController::class);
    Route::apiResource('loyalty-accounts', \App\Http\Controllers\Api\Customers\LoyaltyAccountController::class);
    Route::apiResource('gift-cards', \App\Http\Controllers\Api\Customers\GiftCardController::class);

    // Staff
    Route::apiResource('employees', \App\Http\Controllers\Api\Staff\EmployeeController::class);
    Route::apiResource('positions', \App\Http\Controllers\Api\Staff\PositionController::class);
    Route::apiResource('shifts', \App\Http\Controllers\Api\Staff\ShiftController::class);

    // Music
    Route::apiResource('playlists', \App\Http\Controllers\Api\Music\PlaylistController::class);
    Route::apiResource('music-requests', \App\Http\Controllers\Api\Music\MusicRequestController::class);

    // Reservations
    Route::apiResource('reservations', \App\Http\Controllers\Api\Reservations\ReservationController::class);

    // Delivery
    Route::apiResource('delivery-orders', \App\Http\Controllers\Api\Delivery\DeliveryOrderController::class);
});
