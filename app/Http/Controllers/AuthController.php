<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\RegistrationRequest;

class AuthController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register(){
        return view("register");
    }

    public function login(){
        return view("login");
    }

    public function registration(RegistrationRequest $request){

        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);

        $user = $this->user->create($validated);

        if(!$user){
            session()->flash('Failed', "Unable to register");
            return view('register');
        }

        return to_route("payment_view");
        // return [
        //     "status" => $this->successResponse('Registration was successful'),
        //     "data" => $user,
        // ];

        // if(array_key_exists('status_code', $registerationResponse)) {
        //     return view('register', ["message" => $registerationResponse['message']]);
        // }

    }

    public function loggin(LoginRequest $request){
        if(!auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
            ])) {

            // return $this->failResponse("Invalid login details");
            session()->flash('failed', "Wrong credientials");
        }

        $user = $this->user->where("email", $request->email)->first();

        auth()->login($user);

        return to_route("payment_view");

        // return $this->successResponse([
        //         "user" => $user,
        //         "message"=>"Login successful"
        // ]);

        // if(array_key_exists('status_code', $loginResponse)) {

        //     Session::flash('success', 'Wrong Credientials');
        //     return view('register', ["message" => $loginResponse['message']]);
        // }


    }


    public function logout() {
        $this->user->where('email', auth()->user()->email)->first();

        auth()->logout();

        return to_route("login");
    }
}
