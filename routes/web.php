<?php


use App\Http\Controllers\DenunciaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DenunciaController as AdminDenunciaController;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Rutas de administracion y administracion de denuncias
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);

    Route::resource('denuncias', AdminDenunciaController::class)->names([
        'index' => 'admin.denuncias.index',
        'create' => 'admin.denuncias.create',
        'store' => 'admin.denuncias.store',
        'show' => 'admin.denuncias.show',
        'edit' => 'admin.denuncias.edit',
        'update' => 'admin.denuncias.update',
        'destroy' => 'admin.denuncias.destroy',
    ]);
});


//RUTAS DE DENUNCIAS, utilizamos un resource para crear las rutas CRUD.
Route::middleware(['auth', 'role:admin|funcionario'])->group(function () {
    Route::resource('denuncias', DenunciaController::class);
});

//Mensajes de estado y chat de denuncias.
Route::resource('mensajes', MensajeController::class)->only(['store']);


//RUTAS DEL PROFILE y AUTH
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
