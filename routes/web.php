<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

route::get('/',[HomeController::class,'home']);

route::get('/dashboard',[HomeController::class,'login_home'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('home.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


/* ==== Home === */
route::get('admin/dashboard',[HomeController::class,'index'])->middleware(['auth', 'admin']);

/* === ADMIN === */
route::get('view_category',[AdminController::class,'view_category'])->middleware(['auth', 'admin']);
/* === Add Category */
route::post('add_category',[AdminController::class,'add_category'])->middleware(['auth', 'admin']);
/* === Delete Category */
route::get('delete_category/{id}',[AdminController::class,'delete_category'])->middleware(['auth', 'admin']);
/* === Http edit Category */
route::get('edit_category/{id}',[AdminController::class,'edit_category'])->middleware(['auth', 'admin']);
/* === Update Category */
route::post('update_category/{id}',[AdminController::class,'update_category'])->middleware(['auth', 'admin']);
/* === Http add product */
route::get('add_product',[AdminController::class,'add_product'])->middleware(['auth', 'admin']);
/* === Upload product */
route::post('upload_product',[AdminController::class,'upload_product'])->middleware(['auth', 'admin']);
/* === Http view product */
route::get('view_product',[AdminController::class,'view_product'])->middleware(['auth', 'admin']);
/* === Delete Product */
route::get('delete_product/{id}',[AdminController::class,'delete_product'])->middleware(['auth', 'admin']);
/* === Http edit product */
route::get('edit_product/{id}',[AdminController::class,'edit_product'])->middleware(['auth', 'admin']);
/* === Update product */
route::post('update_product/{id}',[AdminController::class,'update_product'])->middleware(['auth', 'admin']);
/* === Search product */
route::get('product_search',[AdminController::class,'product_search'])->middleware(['auth', 'admin']);

/* === Http add product */
route::get('add_user',[AdminController::class,'addUser'])->middleware(['auth', 'admin']);
/* === Upload product */
route::post('upload_user',[AdminController::class,'uploadUser'])->middleware(['auth', 'admin']);
/* === Http view product */
route::get('view_user',[AdminController::class,'viewUser'])->middleware(['auth', 'admin']);
/* === Delete Product */
route::get('delete_user/{id}',[AdminController::class,'delete_user'])->middleware(['auth', 'admin']);
/* === Http edit product */
route::get('edit_user/{id}',[AdminController::class,'edit_user'])->middleware(['auth', 'admin']);
/* === Update product */
route::post('update_user/{id}',[AdminController::class,'update_user'])->middleware(['auth', 'admin']);
/* === Search product */
route::get('user_search',[AdminController::class,'user_search'])->middleware(['auth', 'admin']);

/* ====== Home ====== */
/* === Details product */
route::get('detail_product/{id}',[HomeController::class,'detail_product']);
/* === Add product in cart */
route::get('add_cart/{id}',[HomeController::class,'add_cart'])->middleware(['auth', 'verified']);
/* === show product in cart */
route::get('mycart',[HomeController::class,'mycart'])->middleware(['auth', 'verified']);
/* === confirm order */
route::post('comfirm_order',[HomeController::class,'comfirm_order'])->middleware(['auth', 'verified']);


