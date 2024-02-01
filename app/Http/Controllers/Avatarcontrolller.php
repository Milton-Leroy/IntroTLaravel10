<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Http\Request;

class Avatarcontrolller extends Controller
{

    public function update(UpdateAvatarRequest $request){

       
       $path = $request->file('avatar')->store('avatars');

       auth()->user()->updatel([
            'avatar' => storage_path('app')."$path",
       ]);

        return back()->with('message' , 'Avatar saved sucessfully.' );
    }

}
