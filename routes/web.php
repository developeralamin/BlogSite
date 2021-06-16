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
Route::resource('tags', App\Http\Controllers\Admin\TagController::class);
Route::resource('category', App\Http\Controllers\Admin\CategoryController::class);
Route::resource('post', App\Http\Controllers\Admin\PostController::class);

Route::get('/pending/post',[App\Http\Controllers\Admin\PostController::class,'pending'])->name('post.pending');

Route::put('/post/{id}/approval',[App\Http\Controllers\Admin\PostController::class,'approval'])->name('approval.post');

});


///Author All Routes are here
Route::group(['as' =>'author.','prefix'=>'author','middleware' =>['auth','author']],function(){

Route::get('dashboard', [App\Http\Controllers\Author\DashboardController::class,'index'])->name('dashboard');

Route::resource('post',App\Http\Controllers\Author\PostController::class);

});