<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\anoController;

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


Route::get('/',[anoController::class,'index']);
Route::get('/view',[anoController::class,'view']);
Route::get('/fileOpen/{params}',[anoController::class,'fileOpen']);
Route::post('/getdetails',[anoController::class,'getDetails']);
Route::get('/editData/{params}',[anoController::class,'editData']);
Route::get('/delate/{params}',[anoController::class,'delate']);
Route::post('/registration_form',[anoController::class,'registration']); 
Route::get('/add', function () {
    return view('add');
});

Route::post('api/fetch-provider', [anoController::class, 'getDetails']);
Route::post('editData/registration_form',[anoController::class,'update']); 

Route::get('/leave', function () {
    return view('leave');
});
Route::get('export',[anoController::class,'export']);
Route::get('pdf',[anoController::class,'generatepdf']);




///////////////    profile   /////////////////


Route::get('/profile/{params}',[anoController::class,'profile']);

// Route::get('export-excel',[anoController::class,'export2']);

Route::match(['get','post'],'export-excel/{registration_id}',[anoController::class,'export2']);
Route::match(['get','post'],'profile_pdf/{registration_id}',[anoController::class,'profile_pdf']);