<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Orchid\Access\Impersonation;

class AuthContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        //
        return view('login');
    }

    public function register()
    {
        //
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function loginUser(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();
        if (!$user) {
            return back()->withErrors('Нет пользователя');
        };

        if($password != $user->password) {
            return back()->withErrors('Не праильный пароль');
        }

        Auth::login($user);

        return redirect('/');
    }


    public function logout() {
        Auth()->logout();
        return redirect('/');
    }
    
    public function registerUser(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $permissions = collect([        "cGxhdGZvcm0uc3lzdGVtcy5hdHRhY2htZW50" => "0",
        "cGxhdGZvcm0uc3lzdGVtcy5yb2xlcw==" => "0",
        "cGxhdGZvcm0uc3lzdGVtcy51c2Vycw==" => "0",
        "cGxhdGZvcm0uaW5kZXg=" => "1"])
            ->map(fn ($value, $key) => [base64_decode($key) => $value])
            ->collapse()
            ->toArray();


        $user = User::create([
            'name'=>$name,
            'email'=>$email,
            'password'=>Hash::make($password),
            'permissions' => $permissions
        ]);
        Auth()->login($user);
        Impersonation::loginAs($user);
        $user->replaceRoles($request->input('user'));
        return redirect('/');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
