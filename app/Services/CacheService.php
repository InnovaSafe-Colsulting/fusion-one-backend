<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CacheService
{
    const TTL_LONG  = 3600;  // 1 hora — datos casi estáticos
    const TTL_SHORT = 300;   // 5 minutos — datos semi-dinámicos

    // --- Keys ---
    public static function productsKey(int $tenantId, array $filters = []): string
    {
        $hash = empty($filters) ? 'all' : md5(serialize($filters));
        return "products.tenant.{$tenantId}.{$hash}";
    }

    public static function categoriesKey(int $tenantId): string
    {
        return "categories.tenant.{$tenantId}";
    }

    public static function categoriesActiveKey(int $tenantId): string
    {
        return "categories.active.tenant.{$tenantId}";
    }

    public static function productTypesKey(int $tenantId): string
    {
        return "product_types.tenant.{$tenantId}";
    }

    public static function currenciesKey(): string
    {
        return "currencies.all";
    }

    public static function currenciesTypesKey(): string
    {
        return "currencies.types";
    }

    public static function paymentMethodsActiveKey(int $tenantId): string
    {
        return "payment_methods.active.tenant.{$tenantId}";
    }

    public static function modulesMenuKey(int $tenantId): string
    {
        return "modules.menu.tenant.{$tenantId}";
    }

    // --- Cache helper with fallback ---
    public static function remember(string $key, int $ttl, callable $callback): mixed
    {
        try {
            return Cache::remember($key, $ttl, $callback);
        } catch (\Throwable) {
            return $callback();
        }
    }

    public static function forget(string $key): void
    {
        try {
            Cache::forget($key);
        } catch (\Throwable) {
            // Redis unavailable, skip
        }
    }

    // --- Flush helpers ---
    public static function flushProducts(int $tenantId): void
    {
        self::forget(self::productsKey($tenantId));
        self::forget("products.tenant.{$tenantId}.*");
    }

    public static function flushCategories(int $tenantId): void
    {
        self::forget(self::categoriesKey($tenantId));
        self::forget(self::categoriesActiveKey($tenantId));
    }

    public static function flushProductTypes(int $tenantId): void
    {
        self::forget(self::productTypesKey($tenantId));
    }

    public static function flushCurrencies(): void
    {
        self::forget(self::currenciesKey());
        self::forget(self::currenciesTypesKey());
    }

    public static function flushPaymentMethods(int $tenantId): void
    {
        self::forget(self::paymentMethodsActiveKey($tenantId));
    }

    public static function flushModulesMenu(int $tenantId): void
    {
        self::forget(self::modulesMenuKey($tenantId));
    }
}
