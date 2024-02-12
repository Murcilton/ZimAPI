<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/{id}', [ProductController::class, 'show']);


Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::apiResources([
'desks' => \App\Http\Controllers\Api\DeskController::class,
]);

// Route::get('/products', function(){
// return Product::all();
// });
// Route::post('/products' , function(Request $request) {
//     return Product::create($request->all());
// // return Product::create([
// //     'name' => 'Product 1',
// //     'description' => 'This is Product 1',
// //     'price' => '99.99',
// // ]);
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});