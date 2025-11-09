<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    LoginController,
    DashboardController,
    InventoryController,
    ProductController,
    POSController,
    SalesController,
    CustomerController,
    SettingsController,
    AnnouncementController,
    PromoController,
    OrderManagementController,
    ServicesManagementController,
    BookingController,
    ServiceLogController,
    MessagesController,
    OverviewController,
    SalesReportController,
    ServiceReportController
};
use App\Http\Controllers\Admin\ReviewAdminController;
use App\Http\Controllers\Auth\LogoutController;


Route::prefix('admin')->name('admin.')->group(function () {
    // Login & Logout
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/', [LoginController::class, 'login'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // Forgot & Reset Password
    Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('forgot-password.form');
    Route::post('/forgot-password', [LoginController::class, 'sendResetLink'])->name('forgot-password.send');
    Route::get('/reset-password/{token}', [LoginController::class, 'showResetPasswordForm'])->name('reset-password.form');
    Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('reset-password.update');
});


Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {

    // DASHBOARD
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });

    // INVENTORY MANAGEMENT
    Route::prefix('inventory')->name('inventory.')->group(function () {
        Route::get('/', [InventoryController::class, 'index'])->name('index');
        Route::get('{id}/show', [InventoryController::class, 'show'])->name('show');
        Route::get('export-all', [InventoryController::class, 'exportAllPDF'])->name('export.all');
        Route::get('/{id}/pdf', [InventoryController::class, 'exportPDF'])->name('pdf');
        Route::post('/{id}/add-stock', [InventoryController::class, 'create'])->name('addStock');
        Route::post('/{id}/edit', [InventoryController::class, 'update'])->name('edit');
        Route::get('/export/csv', [InventoryController::class, 'exportAllCSV'])->name('export.csv');
    });

    // PRODUCT MANAGEMENT
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::post('/{id}/update-pricing', [ProductController::class, 'updatePricing'])->name('updatePricing');
        Route::get('/{id}/show', [ProductController::class, 'show'])->name('show');
        Route::post('/{id}/status', [ProductController::class, 'status'])->name('status');
        Route::post('/{id}/discount', [ProductController::class, 'discount'])->name('discount');
        Route::get('/export/pdf', [ProductController::class, 'exportPdf'])->name('export.pdf');
        Route::get('/export/csv', [ProductController::class, 'exportCsv'])->name('export.csv');
    });

    // POS (Point of Sale)
    Route::prefix('pos')->name('pos.')->group(function () {
        Route::get('/', [POSController::class, 'index'])->name('index');
        Route::post('/cart/add/{product}', [POSController::class, 'addToCart'])->name('cart.add');
        Route::post('/cart/remove/{product}', [POSController::class, 'removeFromCart'])->name('cart.remove');
        Route::post('/checkout', [POSController::class, 'checkout'])->name('checkout');
    });

    // SALES
    Route::prefix('sales')->name('sales.')->group(function () {
        Route::get('/', [SalesController::class, 'index'])->name('index');
        Route::get('/{id}', [SalesController::class, 'show'])->name('show');
        Route::get('/export/pdf', [SalesController::class, 'exportPdf'])->name('export.pdf');
        Route::get('/export/csv', [SalesController::class, 'exportCsv'])->name('export.csv');
    });

    // CUSTOMERS
    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/{id}/show', [CustomerController::class, 'show'])->name('show');
    });

    // ORDERS
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderManagementController::class, 'index'])->name('index');
        Route::get('/{order}', [OrderManagementController::class, 'show'])->name('show');
        Route::post('/{order}/update', [OrderManagementController::class, 'updateStatus'])->name('update');
        Route::get('/{order}/pdf', [OrderManagementController::class, 'exportPdf'])->name('pdf');
    });

    // REVIEWS
    Route::prefix('reviews')->name('reviews.')->group(function () {
        Route::post('/{review}/reply', [ReviewAdminController::class, 'reply'])->name('reply');
    });

    // SERVICES
    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', [ServicesManagementController::class, 'index'])->name('index');
        Route::post('/create', [ServicesManagementController::class, 'store'])->name('store');
        Route::get('/{id}', [ServicesManagementController::class, 'show'])->name('show');
        Route::post('/{id}/update', [ServicesManagementController::class, 'update'])->name('update');
        Route::post('/{id}/status', [ServicesManagementController::class, 'toggleStatus'])->name('status');
        Route::get('/export/pdf', [ServicesManagementController::class, 'exportPdf'])->name('export.pdf');
        Route::get('/export/csv', [ServicesManagementController::class, 'exportCsv'])->name('export.csv');
    });

    // BOOKINGS
    Route::prefix('bookings')->name('bookings.')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('index');
        Route::post('/{id}/status', [BookingController::class, 'updateStatus'])->name('update');
        Route::get('/export/pdf', [BookingController::class, 'exportPdf'])->name('export.pdf');
        Route::get('/export/csv', [BookingController::class, 'exportCsv'])->name('export.csv');
    });

    // SERVICES Log
    Route::prefix('service-logs')->name('service-logs.')->group(function () {
        Route::get('/', [ServiceLogController::class, 'index'])->name('index');
        Route::get('/create', [ServiceLogController::class, 'create'])->name('create');
        Route::post('/store', [ServiceLogController::class, 'store'])->name('store');
    });

    // PROMOS
    Route::prefix('promo')->name('promo.')->group(function () {
        Route::get('/', [PromoController::class, 'index'])->name('index');
        Route::get('/create', [PromoController::class, 'create'])->name('create');
        Route::post('/store', [PromoController::class, 'store'])->name('store');
    });

    // MESSAGES
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/{user_id?}', [MessagesController::class, 'index'])->name('index');
        Route::post('/send/{user}', [MessagesController::class, 'send'])->name('send');
        Route::get('/poll/{user}', [MessagesController::class, 'poll'])->name('poll');
    });
    
    // SETTINGS
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('index');
        Route::post('/{id}/order', [SettingsController::class, 'updateOrderSettings'])->name('order');
        Route::post('/{id}/store', [SettingsController::class, 'updateStoreDetails'])->name('store');
        Route::post('/{id}/admin', [SettingsController::class, 'updateAdminAccount'])->name('admin');
        Route::post('/{id}/password', [SettingsController::class, 'changePassword'])->name('password');
    });

    // ANALYTICS
    Route::prefix('overview')->name('overview.')->group(function () {
        Route::get('/', [OverviewController::class, 'index'])->name('index');
    });
    Route::prefix('sale-report')->name('sale-report.')->group(function () {
        Route::get('/', [SalesReportController::class, 'index'])->name('index');
        Route::get('/export/csv', [SalesReportController::class, 'exportCsv'])->name('export.csv');
        Route::get('/export/pdf', [SalesReportController::class, 'exportPdf'])->name('export.pdf');
    });
    Route::prefix('service-report')->name('service-report.')->group(function () {
        Route::get('/', [ServiceReportController::class, 'index'])->name('index');
        Route::get('/export/pdf', [ServiceReportController::class, 'exportPdf'])->name('export.pdf');
        Route::get('/export/csv', [ServiceReportController::class, 'exportCsv'])->name('export.csv');
    });
});
