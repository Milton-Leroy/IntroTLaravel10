<?php

use App\Http\Controllers\Avatarcontrolller;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::post('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('login.github');

Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
    
    $user = User::firstOrCreate(['email' => $user->email],
                                    [
                                        'name' => $user->name,
                                        'password' => bcrypt('password'),
                                    ]);


    Auth::login($user);

    return redirect('/dashboard');
    // $user->token
});
 