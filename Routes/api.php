<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Oem\BrpRise\Http\Controllers\TrialBalanceApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/brprise', function (Request $request) {
    return $request->user();
});

Route::post('/star/services/FinancialMetrics/Process', [TrialBalanceApiController::class, 'store'])
    ->middleware('auth.trial_balance_api');
