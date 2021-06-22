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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Route::get('posts','PostController@index')->name('post.index');
Route::get('post/{slug}',[App\Http\Controllers\PostController::class, 'index'])->name('post.details');
/// All Routes are here
 
Route::group(['middleware'=>['auth']], function (){

  Route::post('favorite/{post}/add',[App\Http\Controllers\FavoriteController::class, 'store'])->name('post.favorite');
   // Route::post('comment/{post}','CommentController@store')->name('comment.store');
});

Route::post('suscribe', [App\Http\Controllers\SuscriberController::class, 'store'])->name('suscribe.store');

///Admin All Routes are here
Route::group(['as' =>'admin.','prefix'=>'admin','middleware' =>['auth','admin']],function(){

Route::get('setting', [App\Http\Controllers\Admin\SettingController::class,'index'])->name('setting');

Route::put('profile-update', [App\Http\Controllers\Admin\SettingController::class,'updateProfile'])->name('profile.update');

Route::put('password-update', [App\Http\Controllers\Admin\SettingController::class,'updatePassword'])->name('password.update');



Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class,'index'])->name('dashboard');
Route::resource('tags', App\Http\Controllers\Admin\TagController::class);
Route::resource('category', App\Http\Controllers\Admin\CategoryController::class);
Route::resource('post', App\Http\Controllers\Admin\PostController::class);

Route::get('/pending/post',[App\Http\Controllers\Admin\PostController::class,'pending'])->name('post.pending');

Route::put('/post/{id}/approval',[App\Http\Controllers\Admin\PostController::class,'approval'])->name('approval.post');

Route::get('/suscriber',[App\Http\Controllers\Admin\SuscriberController::class,'index'])->name('suscriber.show');

Route::delete('/suscriber/{id}',[App\Http\Controllers\Admin\SuscriberController::class,'destroy'])->name('suscribeber.destroy');


Route::get('/favorite',[App\Http\Controllers\Admin\FavoriteController::class,'index'])->name('favorite.index');


});


///Author All Routes are here
Route::group(['as' =>'author.','prefix'=>'author','middleware' =>['auth','author']],function(){

Route::get('dashboard', [App\Http\Controllers\Author\DashboardController::class,'index'])->name('dashboard');
Route::get('setting', [App\Http\Controllers\Author\SettingController::class,'index'])->name('setting');

Route::put('profile-update', [App\Http\Controllers\Author\SettingController::class,'updateProfile'])->name('profile.update');

Route::put('password-update', [App\Http\Controllers\Author\SettingController::class,'updatePassword'])->name('password.update');

Route::resource('post',App\Http\Controllers\Author\PostController::class);


Route::get('/favorite',[App\Http\Controllers\Author\FavoriteController::class,'index'])->name('favorite.index');

});