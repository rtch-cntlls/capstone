<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\{
    ShopController,
    CartController,
    WishlistController,
    MybookingController,
    AccountController,
    CheckoutController,
    OrderController,
    PaymentController,
    MyGarageController,
    ShopServicesController,
    FooterController,
    ContactController,
    LoginClientController,
    RegisterController,
    ReviewController
};

// START PAGE
Route::get('/', [ShopController::class, 'index'])->name('shop');


// FRONT STORE
Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('product');
    Route::get('/api/products/filter', [ShopController::class, 'Products']);
    Route::get('/product/{product_id}', [ShopController::class, 'showDetails'])->name('details');
    // Reviews
    Route::get('/product/{product_id}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');
});

// CUSTOMER CART
Route::prefix('cart')->name('cart.')->group(function() {   
    Route::get('/', [CartController::class, 'show'])->name('index');
    Route::post('/add', [CartController::class, 'addToCart'])->name('add');
    Route::post('/delete', [CartController::class, 'removeFromCart'])->name('delete');
    Route::post('/toggle', [CartController::class, 'toggleSelection'])->name('toggleSelection');
    Route::post('/checkout-selected', [CartController::class, 'checkoutSelected'])->name('checkoutSelected'); 
});


//CUSTOMER WISHLIST
Route::prefix('wishlist')->name('wishlist.')->group(function() {
    Route::get('/', [WishlistController::class, 'index'])->name('index');
    Route::post('/', [WishlistController::class, 'addToWishlist'])->name('add');
    Route::post('/remove', [WishlistController::class, 'removeFromWishlist'])->name('remove'); 
});

//CUSTOMER BOOKING
Route::prefix('mybooking')->name('mybooking.')->group(function() {
    Route::get('/', [MybookingController::class, 'index'])->name('index');
    Route::post('/{booking_id}/cancel', [MybookingController::class, 'cancel'])->name('booking.cancel');
});

// CONTACT
Route::prefix('contact')->name('contact.')->group(function(){
    Route::get('/', [ContactController::class, 'index'])->name('index');
});

// CUSTOMER ACCOUNT
Route::prefix('account')->name('account.')->group(function() {
    Route::get('/', [AccountController::class, 'show'])->name('show');
    Route::get('/settings', [AccountController::class, 'privacy'])->name('settings');
    Route::post('/settings', [AccountController::class, 'deleteAccount'])->name('delete');
    Route::post('address', [AccountController::class, 'storeAddress'])->name('address.store');
    Route::post('profile', [AccountController::class, 'updateProfile'])->name('profile.update');
});

// CHAT 
Route::prefix('message')->name('message.')->middleware('auth')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::post('/', [ShopController::class, 'store'])->name('store');
    Route::get('/poll', [ShopController::class, 'poll'])->name('poll');
});

// ORDER
Route::prefix('order')->name('order.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/{order_id}', [OrderController::class, 'show'])->name('show');
    Route::post('/{order}/cancel', [OrderController::class, 'cancel'])->name('cancel');
});

//CHECKOUT
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/buy-now', [CheckoutController::class, 'buyNow'])->name('buyNow');
    Route::get('/checkout_form', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/placeorder', [CheckoutController::class, 'placeorder'])->name('placeOrder');
    Route::get('/checkout/cancel', [CheckoutController::class, 'cancelCheckout'])->name('cancel');
});

// PAYMENT ROUTES
Route::prefix('payment')->name('payment.')->group(function () {
    Route::post('/gcash-proof', [PaymentController::class, 'submitGcashProof'])->name('gcashProof.submit');
});


// GARAGE
Route::prefix('garage')->name('garage.')->group(function () {
    Route::get('/', [MyGarageController::class, 'index'])->name('index');
    Route::post('/', [MyGarageController::class, 'store'])->name('store');
    Route::get('/{motorcycle}', [MyGarageController::class, 'show'])->name('show');
    Route::get('/{motorcycle}/schedule', [MyGarageController::class, 'schedule'])->name('schedule');
    Route::get('/{motorcycle}/maintenance', [MyGarageController::class, 'maintenance'])->name('maintenance');
    Route::get('/{motorcycle}/export-pdf', [MyGarageController::class, 'exportPdf'])->name('export.pdf');
});

// SHOP SERVICES
Route::prefix('shop-services')->name('shop-services.')->group(function () {
    Route::get('/', [ShopServicesController::class, 'index'])->name('index');
    Route::get('/create/{service}', [ShopServicesController::class, 'CreateBooking'])->name('CreateBooking');
    Route::post('/store/{service}', [ShopServicesController::class, 'StoreBooking'])->name('StoreBooking');
});

// FOOTER
Route::prefix('footer')->name('footer.')->group(function () {
    Route::get('/help-center', [FooterController::class, 'helpCenter'])->name('helpCenter');
    Route::get('/get-started', [FooterController::class, 'getStart'])->name('getStart');
    Route::get('/term & condition', [FooterController::class, 'termsAndCondition'])->name('termsAndCondition');
    Route::get('/privacy policy', [FooterController::class, 'privacy'])->name('privacy');
    Route::get('/about-us', [FooterController::class, 'aboutUs'])->name('aboutUs');
});