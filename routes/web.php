<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;

// Auth
require __DIR__.'/web_auth.php';

// Shop routes
require __DIR__.'/web_shop.php';

// Media streaming routes for message attachments
Route::get('/media/attachments/{attachment}', [MediaController::class, 'show'])->name('media.attachment');
Route::get('/media/attachments/{attachment}/thumbnail', [MediaController::class, 'thumbnail'])->name('media.attachment.thumbnail');

// Admin routes
require __DIR__.'/web_admin.php';
