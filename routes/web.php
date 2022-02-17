<?php

use App\http\Controllers\ExportController;
use App\http\Livewire\Asignar;
use App\http\Livewire\Cashout;
use App\http\Livewire\Categories;
use App\http\Livewire\Coins;
use App\http\Livewire\Permisos;
use App\http\Livewire\Pos;
use App\http\Livewire\Products;
use App\http\Livewire\Reports;
use App\http\Livewire\Roles;
use App\http\Livewire\Users;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

// Protege la ruta validando q el usuario este registrado
Route::middleware(['auth'])->group(function(){
    Route::get('categories', Categories::class)->name('categorias');
    Route::get('products', Products::class)->name('productos');
    Route::get('coins', Coins::class)->name('coins')->middleware('role:Administrador'); //protegiendo solo una ruta
    Route::get('/', Pos::class)->name('pos');

    //protege las de los usuario que no tiene el rol
    Route::group(['middleware' => ['role:Administrador']], function(){
        Route::get('roles', Roles::class)->name('roles');
        Route::get('permisos', Permisos::class)->name('permisos');
        Route::get('asignar', Asignar::class)->name('asignar');
    });
    Route::get('users', Users::class)->name('users');
    Route::get('cashout', Cashout::class)->name('cashout');
    Route::get('reports', reports::class)->name('reports');

    // Reportes PDF
    Route::get('report/pdf/{user}/{type}/{f1}/{f2}', [ExportController::class, 'reportPDF']);
    Route::get('report/pdf/{user}/{type}', [ExportController::class, 'reportPDF']);

    //reporte Excel
    Route::get('report/excel/{user}/{type}/{f1}/{f2}', [ExportController::class, 'reporteExcel']);
    Route::get('report/excel/{user}/{type}', [ExportController::class, 'reporteExcel']);
});
