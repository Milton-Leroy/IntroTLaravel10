<?php

use App\Http\Controllers\Avatarcontrolller;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
     return view('welcome');

    /* $users = DB::table('users')->insert([
        'name' => 'user2345',
        'email' => 'kjenrureie@gmail.com',
        'password' => 'password'
    ]); */

   // $users = DB::table('users')->get();    

    /* $users = User::insert([
        'name' => 'user2345',
        'email' => 'kjen@gmail.com',
        'password' =>  bcrypt('password')
    ]);
 */
   // dd($users);

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/avatar',[Avatarcontrolller::class, 'update'])->name('profile.avatar');
});
 
require __DIR__.'/auth.php';
 