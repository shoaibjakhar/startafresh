<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\CreditorOfficeController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','role:Super Admin|Admin|Agent'])->group(function () {

    Route::middleware(['role:Super Admin|Admin'])->group(function () {
        Route::resource('permissions', App\Http\Controllers\PermissionController::class);
        Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

        Route::resource('roles', App\Http\Controllers\RoleController::class);
        Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);

        Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
        Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);
    });
    Route::get('creditor_offices', [App\Http\Controllers\CreditorOfficeController::class, 'index']);
    Route::get('creditor_offices/create', [App\Http\Controllers\CreditorOfficeController::class, 'create']);
    Route::post('creditor_offices', [App\Http\Controllers\CreditorOfficeController::class, 'store']);

    Route::get('clients', [App\Http\Controllers\ClientController::class, 'index']);
    Route::get('clients/create', [App\Http\Controllers\ClientController::class, 'create']);
    Route::post('clients', [App\Http\Controllers\ClientController::class, 'store']);
    Route::get('clients/{userId}/edit', [App\Http\Controllers\ClientController::class, 'edit']);
    Route::put('clients', [App\Http\Controllers\ClientController::class, 'update']);
    Route::get('clients/{user}/show', [App\Http\Controllers\ClientController::class, 'show']);
    Route::get('clients/{userId}/delete', [App\Http\Controllers\ClientController::class, 'destroy']);

    Route::get('income', [App\Http\Controllers\IncomeController::class, 'index']);
    Route::post('income', [App\Http\Controllers\IncomeController::class, 'store']);
    Route::put('income/', [App\Http\Controllers\IncomeController::class, 'update']);
    Route::get('income/{user}/create', [App\Http\Controllers\IncomeController::class, 'create']);
    Route::get('income/{user}/edit', [App\Http\Controllers\IncomeController::class, 'edit']);
    Route::get('income/{user}/show', [App\Http\Controllers\IncomeController::class, 'show']);
    Route::get('income/{clientIncomeId}/delete', [App\Http\Controllers\IncomeController::class, 'destroy']);

    Route::get('expenditure', [App\Http\Controllers\ExpenditureController::class, 'index']);
    Route::get('expenditure/{user}/create', [App\Http\Controllers\ExpenditureController::class, 'create']);
    Route::post('expenditure/', [App\Http\Controllers\ExpenditureController::class, 'store']);
    Route::get('expenditure/{user}/edit', [App\Http\Controllers\ExpenditureController::class, 'edit']);
    Route::put('expenditure/', [App\Http\Controllers\ExpenditureController::class, 'update']);
    Route::get('expenditure/{user}/show', [App\Http\Controllers\ExpenditureController::class, 'show']);
    Route::get('expenditure/{clientExpenditureId}/delete', [App\Http\Controllers\ExpenditureController::class, 'destroy']);

    Route::get('debt/{user}/create', [App\Http\Controllers\DebtController::class, 'create']);
    Route::post('debt', [App\Http\Controllers\DebtController::class, 'store']);
    Route::get('debt/{user}/show', [App\Http\Controllers\DebtController::class, 'show']);
});

// Route::post('income/addIncome', [App\Http\Controllers\ClientController::class, 'addIncome']);


Route::middleware('auth')->group(function () {

    Route::get('applications', [App\Http\Controllers\ApplicationController::class, 'index']);
    Route::get('applications/create', [App\Http\Controllers\ApplicationController::class, 'create']);
    Route::post('applications', [App\Http\Controllers\ApplicationController::class, 'store']);
    Route::get('applications/{applicationId}/edit', [App\Http\Controllers\ApplicationController::class, 'edit']);
    Route::get('mdiAndPaymentsCalcualtions/{application}', [App\Http\Controllers\ApplicationController::class, 'mdiAndPaymentsCalcualtions']);
    
    Route::get('paymentsFromClient/{application}', [App\Http\Controllers\ApplicationController::class, 'paymentsFromClient']);    
    Route::get('addClientPayment/{application}', [App\Http\Controllers\ApplicationController::class, 'addClientPayment']);
    Route::post('saveClientPayment', [App\Http\Controllers\ApplicationController::class, 'saveClientPayment']);
    
    Route::get('paymentsToCreditors/{application}', [App\Http\Controllers\ApplicationController::class, 'paymentsToCreditors']);

    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
