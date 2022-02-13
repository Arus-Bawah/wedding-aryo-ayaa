<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\TemplateController;
use App\Models\InvitationModel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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

Route::get('/', [MainController::class, 'Index']);
Route::get('/invitation/{slug}', [MainController::class, 'Invitation']);
Route::post('/save-invitation', [MainController::class, 'saveInvitation']);
Route::get('/comment', [MainController::class, 'getComment']);
Route::post('/comment/save', [MainController::class, 'saveComment']);
Route::post('/comment/update/{id}', [MainController::class, 'updateComment']);


Route::get('/personal-invitation', function () {
    Session::put('invitation_id', null);
    Session::put('name', null);
    Session::put('location', null);
    Session::put('sesi', 0);
    return redirect('/');
});
Route::get('/remove-session', function () {
    Session::put('invitation_id', null);
    Session::put('name', null);
    Session::put('location', null);
    Session::put('sesi', 0);
    return redirect('/');
});
Route::get('/template', [TemplateController::class, 'Index']);
