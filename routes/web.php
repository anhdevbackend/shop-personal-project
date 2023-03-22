<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AccountController;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\userMainController;
use App\Http\Controllers\User\userOrderController;
use App\Http\Controllers\User\userAccountController;
use App\Http\Controllers\User\userProductController;

// If we go Login Page && Register page from login stated
// Route::middleware(['admin'])->group(function () {
    Route::redirect('/','loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
// });

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        if(Auth::user()->role == 'admin'){
            return redirect()->route('category#listPage');
        }else{
            return redirect()->route('main#homePage');
        }
    })->name('dashboard');

    // Admin Panel
    Route::middleware(['admin'])->group(function () {

        // Account Controller
        Route::prefix('account')->group(function () {
            // Account
            Route::get('profilePage',[AccountController::class,'profilePage'])->name('account#profilePage');
            Route::get('profileEditPage',[AccountController::class,'profileEditPage'])->name('account#profileEditPage');
            Route::post('profileEdit',[AccountController::class,'profileEdit'])->name('account#profileEdit');
            // Password
            Route::get('changePasswordPage',[AccountController::class,'changePasswordPage'])->name('account#changePasswordPage');
            Route::post('changePassword',[AccountController::class,'changePassword'])->name('account#changePassword');
            // Admin List
            Route::get('adminListPage',[AccountController::class,'adminListPage'])->name('account#adminListPage');
            Route::get('adminRoleChangePage,{id}',[AccountController::class,'adminRoleChangePage'])->name('account#adminRoleChangePage');
            Route::post('adminRoleChange',[AccountController::class,'adminRoleChange'])->name('account#adminRoleChange');
            Route::get('adminDelete,{id}',[AccountController::class,'adminDelete'])->name('account#adminDelete');
            // User List
            Route::get('userListPage',[AccountController::class,'userListPage'])->name('account#userListPage');
            Route::get('userRoleChangePage,{id}',[AccountController::class,'userRoleChangePage'])->name('account#userRoleChangePage');
            Route::post('userRoleChange',[AccountController::class,'userRoleChange'])->name('account#userRoleChange');
            Route::get('userDelete,{id}',[AccountController::class,'userDelete'])->name('account#userDelete');

        });

        // Category Controller
        Route::prefix('category')->group(function () {
            Route::get('listPage',[CategoryController::class,'listPage'])->name('category#listPage');
            Route::get('createPage',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::get('editPage,{id}',[CategoryController::class,'editPage'])->name('category#editPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::post('update',[CategoryController::class,'update'])->name('category#update');
            Route::get('delete,{id}',[CategoryController::class,'delete'])->name('category#delete');
        });

        // Products Controller
        Route::prefix('products')->group(function () {
            Route::get('productsListPage',[ProductController::class,'productsListPage'])->name('products#productsListPage');
            Route::get('productsCreatePage',[ProductController::class,'productsCreatePage'])->name('products#productsCreatePage');
            Route::post('productsCreate',[ProductController::class,'productsCreate'])->name('products#productsCreate');
            Route::get('productsViewPage,{id}',[ProductController::class,'productsViewPage'])->name('products#productsViewPage');
            Route::get('productsEditPage,{id}',[ProductController::class,'productsEditPage'])->name('products#productsEditPage');
            Route::post('productsUpdate',[ProductController::class,'productsUpdate'])->name('products#productsUpdate');
            Route::get('delete,{id}',[ProductController::class,'delete'])->name('products#delete');
        });

        // Order Controller
        Route::prefix('order')->group(function () {
            // Order List Page
            Route::get('userOrderListPage',[OrderController::class,'userOrderListPage'])->name('order#userOrderListPage');
            // OrderList Details and Manage Page
            Route::get('userOrderListDetails_ManagePage,{Id},{OrderCode}',[OrderController::class,'userOrderListDetails_ManagePage'])->name('order#userOrderListDetails_ManagePage');
            // Manage Order Status
            Route::post('manageOrderStatus',[OrderController::class,'manageOrderStatus'])->name('order#manageOrderStatus');
            //Filter User Order Status
            Route::get('filterUserOrderStatus',[OrderController::class,'filterUserOrderStatus'])->name('order#filterUserOrderStatus');
        });

        // Contact Controller
        Route::prefix('feedbacks')->group(function () {
            Route::get('userFeedbackListPage',[ContactController::class,'userFeedbackListPage'])->name('feedbacks#userFeedbackListPage');
            Route::get('userFeedbackDelete,{id}',[ContactController::class,'userFeedbackDelete'])->name('feedbacks#userFeedbackDelete');
        });
    });

    // User Panel
    Route::middleware(['user'])->group(function () {

        // userMain Controller
        Route::prefix('main')->group(function () {
            Route::get('homePage',[userMainController::class,'homePage'])->name('main#homePage');
            Route::get('contactPage',[userMainController::class,'contactPage'])->name('main#contactPage');
            Route::post('userContact',[userMainController::class,'userContact'])->name('main#userContact');
            // Add to cart
            Route::get('addToCart,{id}',[userMainController::class,'addToCart'])->name('main#addToCart');
        });

        // Order Controller
        Route::prefix('order')->group(function () {
            Route::get('OrderHistoryPage',[userOrderController::class,'OrderHistoryPage'])->name('order#OrderHistoryPage');
            Route::get('OrderProductHistoryListPage,{OrderCode}',[userOrderController::class,'OrderProductHistoryListPage'])->name('order#OrderProductHistoryListPage');
        });

        // userAccount Controller
        Route::prefix('account')->group(function () {
            // Account
            Route::get('userProfilePage',[userAccountController::class,'userProfilePage'])->name('account#userProfilePage');
            Route::get('userProfileEditPage',[userAccountController::class,'userProfileEditPage'])->name('account#userProfileEditPage');
            Route::post('userProfileEdit',[userAccountController::class,'userProfileEdit'])->name('account#userProfileEdit');
            // Password
            Route::get('userChangePasswordPage',[userAccountController::class,'userChangePasswordPage'])->name('account#userChangePasswordPage');
            Route::post('userChangePassword',[userAccountController::class,'userChangePassword'])->name('account#userChangePassword');
        });

        // userProduct Controller
        Route::prefix('products')->group(function () {
            // Product
            Route::get('userProductsViewPage,{id}',[userProductController::class,'userProductsViewPage'])->name('products#userProductsViewPage');
            //Product Reviews
            Route::post('productReviews',[userProductController::class,'productReviews'])->name('products#productReviews');
            // Cart
            Route::get('userProductsCartListPage',[userProductController::class,'userProductsCartListPage'])->name('products#userProductsCartListPage');
            Route::get('userProductsCartDataClear,{id}',[userProductController::class,'userProductsCartDataClear'])->name('products#userProductsCartDataClear');
        });

        // Ajax Controller
        Route::prefix('ajax')->group(function () {
            // Filter Category
            Route::get('filterCategory',[AjaxController::class,'filterCategory'])->name('ajax#filterCategory');
            // Product Sorting
            Route::get('productsSortingList',[AjaxController::class,'productsSortingList'])->name('ajax#productsSortingList');
            // Add to cart
            Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            // Proceed to Order
            Route::get('proceedToOrder',[AjaxController::class,'proceedToOrder'])->name('ajax#proceedToOrder');
            // Product View Count
            Route::get('productViewCount',[AjaxController::class,'productViewCount'])->name('ajax#productViewCount');
        });

    });

});

