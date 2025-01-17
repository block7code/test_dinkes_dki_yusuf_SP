<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 
use App\Http\Controllers\API\DinkesJakartaController;

Route::get('tester', [DinkesJakartaController::class, 'Tester']);
Route::get('mergedata', [DinkesJakartaController::class, 'MergeDataRumahSakit']);