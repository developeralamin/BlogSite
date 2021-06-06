  <?php

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
})->name('home');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

///Admin All Routes are here
Route::group(['as' =>'admin.','prefix'=>'admin','middleware' =>['auth','admin']],function(){

Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class,'index'])->name('dashboard');


});


///Author All Routes are here
Route::group(['as' =>'author.','prefix'=>'author','middleware' =>['auth','author']],function(){

Route::get('dashboard', [App\Http\Controllers\Author\DashboardController::class,'index'])->name('dashboard');

});