<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\StoreRequest\StoreEmailVerificationCodeRequest;
use App\Http\Controllers\{
    UserController,
    CountryController,
    EmailVerificationCodeController,
    AuthorController,
    BrandController,
    CategoryController,
    FaqController,
    FounderController,
    GenreController,
    PaymentController,
    ProductController,
    ProductRelaiseController,
    RoleController,
    statusController,
    TarifeController,
};


Route::post('/login',[AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::post('/check-user-token', [AuthController::class, 'checkUserToken']);
Route::post('/update-your-self', [AuthController::class, 'updateYourself']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/email-verification', [EmailVerificationCodeController::class, 'sendEmailVerification']);
Route::post('/check-email-verification', [EmailVerificationCodeController::class, 'checkEmailVerification']);


Route::get('/email/verify/{id}/{hash}', function (StoreEmailVerificationCodeRequest $request) {
    $request->fulfill();
    return redirect('home');
})->middleware(['auth', 'signed'])->name('verification.verify');



Route::prefix('/admin')->group( function (){
    Route::apiResource('/user', UserController::class);
    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/products', ProductController::class);
    Route::apiResource('/brands', BrandController::class);
    Route::apiResource('/role', RoleController::class);
    Route::apiResource('/payment', PaymentController::class);
    Route::apiResource('/countries', CountryController::class);
    Route::apiResource('/product-relaises', ProductRelaiseController::class);
    Route::apiResource('/tarifes', TarifeController::class);
    Route::apiResource('/authors', AuthorController::class);
    Route::apiResource('/faqs', FaqController::class);
    Route::apiResource('/founders', FounderController::class);
    Route::apiResource('/genres', GenreController::class);
    Route::apiResource('/status', StatusController::class);

});


Route::get('token-status', function ()
{
    return "not authorized";
})->name('token-status');
