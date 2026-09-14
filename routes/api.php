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
    // Admin
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
    Route::get('modules/menu', [\App\Http\Controllers\Api\Admin\ModuleController::class, 'menu']);
    Route::get('branches/active', [\App\Http\Controllers\Api\Admin\BranchController::class, 'active']);
    Route::get('administration/company', [\App\Http\Controllers\Api\Admin\CompanyController::class, 'show']);
    Route::get('cities', [\App\Http\Controllers\Api\Admin\CityController::class, 'index']);
    Route::put('administration/company', [\App\Http\Controllers\Api\Admin\CompanyController::class, 'update']);
    Route::post('administration/company/logo', [\App\Http\Controllers\Api\Admin\CompanyController::class, 'uploadLogo']);
    Route::delete('administration/company/logo', [\App\Http\Controllers\Api\Admin\CompanyController::class, 'deleteLogo']);
    Route::get('administration/fiscal-data', [\App\Http\Controllers\Api\Admin\CompanyController::class, 'fiscalData']);
    Route::put('administration/fiscal-data', [\App\Http\Controllers\Api\Admin\CompanyController::class, 'updateFiscalData']);
    Route::delete('administration/fiscal-data', [\App\Http\Controllers\Api\Admin\CompanyController::class, 'deleteFiscalData']);
    Route::apiResource('tenants', \App\Http\Controllers\Api\Admin\TenantController::class);
    Route::apiResource('branches', \App\Http\Controllers\Api\Admin\BranchController::class);
    Route::apiResource('users', \App\Http\Controllers\Api\Admin\UserController::class);
    Route::apiResource('roles', \App\Http\Controllers\Api\Admin\RoleController::class);
    Route::apiResource('permissions', \App\Http\Controllers\Api\Admin\PermissionController::class);
    Route::apiResource('taxes', \App\Http\Controllers\Api\Admin\TaxController::class);
    Route::apiResource('payment-methods', \App\Http\Controllers\Api\Admin\PaymentMethodController::class);
    Route::apiResource('numbering-sequences', \App\Http\Controllers\Api\Admin\NumberingSequenceController::class);
    Route::apiResource('currencies', \App\Http\Controllers\Api\Admin\CurrencyController::class);
    Route::apiResource('tenant-settings', \App\Http\Controllers\Api\Admin\TenantSettingController::class);

    // Products
    Route::apiResource('products', \App\Http\Controllers\Api\Products\ProductController::class);
    Route::apiResource('categories', \App\Http\Controllers\Api\Products\CategoryController::class);
    Route::apiResource('product-variants', \App\Http\Controllers\Api\Products\ProductVariantController::class);
    Route::apiResource('ingredients', \App\Http\Controllers\Api\Products\IngredientController::class);
    Route::apiResource('recipes', \App\Http\Controllers\Api\Products\RecipeController::class);
    Route::apiResource('combos', \App\Http\Controllers\Api\Products\ComboController::class);
    Route::apiResource('modifiers', \App\Http\Controllers\Api\Products\ModifierController::class);
    Route::apiResource('promotions', \App\Http\Controllers\Api\Products\PromotionController::class);
    Route::apiResource('price-lists', \App\Http\Controllers\Api\Products\PriceListController::class);

    // Inventory
    Route::apiResource('warehouses', \App\Http\Controllers\Api\Inventory\WarehouseController::class);
    Route::apiResource('inventory', \App\Http\Controllers\Api\Inventory\InventoryController::class);
    Route::apiResource('inventory-movements', \App\Http\Controllers\Api\Inventory\InventoryMovementController::class);
    Route::apiResource('inventory-transfers', \App\Http\Controllers\Api\Inventory\InventoryTransferController::class);
    Route::apiResource('inventory-adjustments', \App\Http\Controllers\Api\Inventory\InventoryAdjustmentController::class);
    Route::apiResource('inventory-lots', \App\Http\Controllers\Api\Inventory\InventoryLotController::class);

    // POS
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
