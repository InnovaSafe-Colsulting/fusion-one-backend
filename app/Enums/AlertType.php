<?php

namespace App\Enums;

enum AlertType: string
{
    case CRITICAL_INVENTORY       = 'critical_inventory';
    case EXPIRING_ORDERS          = 'expiring_orders';
    case CASH_NEAR_CLOSE          = 'cash_near_close';
    case OUT_OF_STOCK             = 'out_of_stock';
    case UNATTENDED_TABLE         = 'unattended_table';
    case DELAYED_KITCHEN_ORDER    = 'delayed_kitchen_order';
    case CASH_SESSION_NOT_OPENED  = 'cash_session_not_opened';
    case PENDING_INVOICE          = 'pending_invoice';
    case EMPLOYEE_WITHOUT_SHIFT   = 'employee_without_shift';
    case UPCOMING_RESERVATION     = 'upcoming_reservation';
    case DELAYED_DELIVERY         = 'delayed_delivery';
    case PRODUCT_NEAR_EXPIRY      = 'product_near_expiry';
    case PENDING_PURCHASE_ORDER   = 'pending_purchase_order';
    case EXCESSIVE_DISCOUNT       = 'excessive_discount';
    case FAILED_LOGIN_ATTEMPT     = 'failed_login_attempt';

    public function label(): string
    {
        return match($this) {
            self::CRITICAL_INVENTORY      => 'Inventario crítico',
            self::EXPIRING_ORDERS         => 'Órdenes por vencer',
            self::CASH_NEAR_CLOSE         => 'Caja próxima a cierre',
            self::OUT_OF_STOCK            => 'Producto sin stock',
            self::UNATTENDED_TABLE        => 'Mesa sin atender',
            self::DELAYED_KITCHEN_ORDER   => 'Orden de cocina demorada',
            self::CASH_SESSION_NOT_OPENED => 'Sesión de caja sin abrir',
            self::PENDING_INVOICE         => 'Factura pendiente de pago',
            self::EMPLOYEE_WITHOUT_SHIFT  => 'Empleado sin turno asignado',
            self::UPCOMING_RESERVATION    => 'Reserva próxima',
            self::DELAYED_DELIVERY        => 'Delivery demorado',
            self::PRODUCT_NEAR_EXPIRY     => 'Producto próximo a vencer',
            self::PENDING_PURCHASE_ORDER  => 'Orden de compra pendiente',
            self::EXCESSIVE_DISCOUNT      => 'Descuento excesivo aplicado',
            self::FAILED_LOGIN_ATTEMPT    => 'Intento de acceso fallido',
        };
    }

    public function severity(): string
    {
        return match($this) {
            self::CRITICAL_INVENTORY,
            self::OUT_OF_STOCK,
            self::FAILED_LOGIN_ATTEMPT     => 'critical',

            self::EXPIRING_ORDERS,
            self::CASH_NEAR_CLOSE,
            self::UNATTENDED_TABLE,
            self::DELAYED_KITCHEN_ORDER,
            self::CASH_SESSION_NOT_OPENED,
            self::PENDING_INVOICE,
            self::DELAYED_DELIVERY,
            self::EXCESSIVE_DISCOUNT       => 'warning',

            self::EMPLOYEE_WITHOUT_SHIFT,
            self::UPCOMING_RESERVATION,
            self::PRODUCT_NEAR_EXPIRY,
            self::PENDING_PURCHASE_ORDER   => 'info',
        };
    }
}
