<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Avatarcontrolller extends Controller
{

    public function update(UpdateAvatarRequest $request){

       
       $path = $request->file('avatar')->store('avatars', 'public');

       if($oldAvatar = $request->user()->avatar){

            Storage::disk('public')->delete($oldAvatar);

       }

       auth()->user()->update([
            'avatar' => $path,
       ]);

        return back()->with('message' , 'Avatar saved sucessfully.' );
    }

}
