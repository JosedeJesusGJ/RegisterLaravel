<?php

use App\Http\Controllers\CargoController;
use App\Http\Controllers\EmpleadosController;
use App\Models\Cargo;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/empleados', function () {
//     return view('dashboard.index');
// });

//Muestra los empleados
Route::get('/empleados', [EmpleadosController::class, 'index'])->name('empleados');

//Inserta el empleado
Route::post('/empleados', [EmpleadosController::class, 'store'])->name('insert-empleado');

//Muestra los datos del empleado para editar
Route::get('/empleados/{id}', [EmpleadosController::class, 'show'])->name('show-empleado');

//Actualiza los datos del empleado
Route::patch('/empleados/{id}', [EmpleadosController::class, 'update'])->name('update-empleado');

//Elimina el empleado
Route::delete('/empleados/{id}', [EmpleadosController::class, 'destroy'])->name('destroy-empleado');


Route::resource('cargo', CargoController::class);
