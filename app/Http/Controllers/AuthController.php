<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['logout']);
        $this->middleware(['guest'])->only([
            'register',
            'registerShow',
            'login',
            'loginShow',
        ]);
    }

    public function registerShow()
    {
        return view('Auth.registery');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'username' => ['required', 'unique:users,username'],
            'password' => ['required', 'confirmed'],
            'profile_picture' => [
                /*'required', 'mimes:jpeg,jpg,png,gif'*/
            ],
        ]);

        if (isset($request->profile_picture)) {
            $temprorayFile = TemporaryFile::where(
                'folder',
                $request->profile_picture
            )->first();

            $old =
                'profile pictures/temp/' .
                $temprorayFile->folder .
                '/' .
                $temprorayFile->filename;

            $new =
                'profile pictures/users/' .
                $request->username .
                '/' .
                $temprorayFile->filename;

            Storage::disk('public')->copy($old, $new);
        } else {
            $new = '';
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'profile_picture' => 'storage/' . $new,
        ]);

        auth()->attempt(
            $request->only('username', 'password'),
            $request->remmber
        );

        return redirect('/');
    }

    public function loginShow()
    {
        return view('Auth.loginy');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if (
            !auth()->attempt(
                $request->only('username', 'password'),
                $request->remmber
            )
        ) {
            return back()->with('status', 'Wronge username or password');
        }

        return redirect('/');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}
