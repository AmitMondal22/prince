<?php

use App\Http\Controllers\customer\api_controller\Assets;
use App\Http\Controllers\customer\api_controller\Customer;
use App\Http\Controllers\customer\api_controller\CustomerApiAuth;
use App\Http\Controllers\customer\api_controller\Label10Action;
use App\Http\Controllers\customer\api_controller\Label1Action;
use App\Http\Controllers\customer\api_controller\Label2Action;
use App\Http\Controllers\customer\api_controller\Label3Action;
use App\Http\Controllers\customer\api_controller\Label4Action;
use App\Http\Controllers\customer\api_controller\Label5Action;
use App\Http\Controllers\customer\api_controller\Label6Action;
use App\Http\Controllers\customer\api_controller\Label7Action;
use App\Http\Controllers\customer\api_controller\Label8Action;
use App\Http\Controllers\customer\api_controller\Label9Action;
use App\Http\Controllers\customer\api_controller\Sels;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('assets')->group(function () {
        Route::prefix('unit')->group(function () {
            Route::post('/add', [Assets::class, 'unit_add']);
            Route::post('/edit', [Assets::class, 'unit_edit']);
            Route::post('/delete', [Assets::class, 'delete_unit']);
            Route::get('/list', [Assets::class, 'list_unit']);
        });
        Route::prefix('product')->group(function () {
            Route::post('/add', [Assets::class, 'product_add']);
            Route::post('/edit', [Assets::class, 'product_edit']);
            Route::post('/delete', [Assets::class, 'delete_product']);
            Route::get('/list', [Assets::class, 'list_product_mastar']);
        });
    });
});

Route::middleware(['auth:sanctum', 'user-access:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::post('/customer/add', [Customer::class, 'add']);
        Route::get('/customer/list', [Customer::class, 'listCustomer']);
        Route::post('/customer/edit', [Customer::class, 'editCustomer']);
        Route::post('/sels/add', [Sels::class, 'addSels']);
    });
});


Route::middleware(['auth:sanctum', 'user-access:user1'])->group(function () {
    Route::prefix('l1')->group(function () {
        Route::post('/add', [Label1Action::class, 'add']);
        Route::post('/edit', [Label1Action::class, 'edit']);
        Route::get('/list', [Label1Action::class, 'list_l1']);
    });
});
Route::middleware(['auth:sanctum', 'user-access:user2'])->group(function () {

    Route::prefix('l2')->group(function () {
        Route::post('/add', [Label2Action::class, 'add']);
        Route::post('/edit', [Label2Action::class, 'edit']);
        Route::get('/list', [Label2Action::class, 'list_l2']);
        // Route::post('/list', [Label2Action::class, 'list_l1']);
    });
});




Route::middleware(['auth:sanctum', 'user-access:user3'])->group(function () {
    Route::prefix('l3')->group(function () {
        Route::post('/add', [Label3Action::class, 'add']);
        Route::post('/edit', [Label3Action::class, 'edit']);
        Route::get('/list', [Label3Action::class, 'list_l3']);
        // Route::post('/list', [Label2Action::class, 'list_l1']);
    });
});
Route::middleware(['auth:sanctum', 'user-access:user4'])->group(function () {
    Route::prefix('l4')->group(function () {
        Route::post('/add', [Label4Action::class, 'add']);
        Route::post('/edit', [Label4Action::class, 'edit']);
        Route::get('/list', [Label4Action::class, 'list_l4']);
        // Route::post('/list', [Label2Action::class, 'list_l1']);
    });
});

Route::middleware(['auth:sanctum', 'user-access:user5'])->group(function () {
    Route::prefix('l5')->group(function () {
        Route::post('/add', [Label5Action::class, 'add']);
        Route::post('/edit', [Label5Action::class, 'edit']);
        Route::get('/list', [Label5Action::class, 'list_l5']);
        // Route::post('/list', [Label2Action::class, 'list_l1']);
    });
});

Route::middleware(['auth:sanctum', 'user-access:user6'])->group(function () {
    Route::prefix('l6')->group(function () {
        Route::post('/add', [Label6Action::class, 'add']);
        Route::post('/edit', [Label6Action::class, 'edit']);
        Route::get('/list', [Label6Action::class, 'list_l6']);
    });
});

Route::middleware(['auth:sanctum', 'user-access:user7'])->group(function () {
    Route::prefix('l7')->group(function () {
        Route::post('/add', [Label7Action::class, 'add']);
        Route::post('/edit', [Label7Action::class, 'edit']);
        Route::get('/list', [Label7Action::class, 'list_l7']);
    });
});

Route::middleware(['auth:sanctum', 'user-access:user8'])->group(function () {
    Route::prefix('l8')->group(function () {
        Route::post('/add', [Label8Action::class, 'add']);
        Route::post('/edit', [Label8Action::class, 'edit']);
        Route::get('/list', [Label8Action::class, 'list_l8']);
    });
});

Route::middleware(['auth:sanctum', 'user-access:user9'])->group(function () {
    Route::prefix('l9')->group(function () {
        Route::post('/add', [Label9Action::class, 'add']);
        Route::post('/edit', [Label9Action::class, 'edit']);
        Route::get('/list', [Label9Action::class, 'list_l9']);
    });
});

Route::middleware(['auth:sanctum', 'user-access:user10'])->group(function () {
    Route::prefix('l10')->group(function () {
        Route::post('/add', [Label10Action::class, 'add']);
        Route::post('/edit', [Label10Action::class, 'edit']);
        Route::get('/list', [Label10Action::class, 'list_l10']);
    });
});



Route::prefix('auth')->group(function () {
    Route::match(['get', 'post'], '/register', [CustomerApiAuth::class, 'register']);
    /* The line `Route::post('/login',[CustomerApiAuth::class,'login']);` is defining a route for the
    POST method with the URL path '/login'. When a POST request is made to this route, it will call
    the 'login' method of the 'CustomerApiAuth' class. */
    Route::post('/login', [CustomerApiAuth::class, 'login']);
    Route::prefix('customer')->group(function () {
    });
});


Route::prefix('user')->group(function () {
    Route::match(['get', 'post'], '/register', [CustomerApiAuth::class, 'register']);
    Route::post('/login', [CustomerApiAuth::class, 'login']);
});


Route::prefix("test")->group(function () {
    Route::get('/test', [CustomerApiAuth::class, 'test']);
});


Route::get('/', [CustomerApiAuth::class, 'test']);
