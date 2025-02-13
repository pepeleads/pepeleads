<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
      
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:255'],
            'companyName' => ['required', 'string', 'max:255'],
            'website' => ['required', 'string', 'max:255'],
            'address1' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:255'],
            'title' => ['string', 'max:255'],
            'question1' => ['required', 'string', 'max:400'],
            'question2' => ['required', 'string', 'max:400'],
            'question3' => ['required', 'string', 'max:400'],
            'question4' => ['required', 'string', 'max:400'],
            'question5' => ['required', 'string', 'max:400'],
            'question6' => ['required', 'string', 'max:400'],
            'question7' => ['required', 'string', 'max:400'],
            'skype' => ['required', 'string', 'max:255'],
            'linkedin' => ['string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd($data);
        return User::create([
            'name' =>  $data['name'],
            'refer_id' => uuid4(),
            'refer_by' => $data['refer_id']??null,
            'user_id'=>uuid4(),
            // 'email_verified_at' => now()->format('Y-m-d H:i:s'),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'companyName' =>  $data['companyName'],
            'website' =>  $data['website'],
            'address' =>  $data['address1']." ".$data['address2'],
            'city' =>  $data['city'],
            'country' =>  $data['country'],
            'state' =>  $data['state'],
            'zipcode' =>  $data['zipcode'],
            'title' =>  $data['title'],
            'question1' =>  $data['question1'],
            'question2' =>  $data['question2'],
            'question3' =>  $data['question3'],
            'question4' =>  $data['question4'],
            'question5' =>  $data['question5'],
            'question6' =>  $data['question6'],
            'question7' =>  $data['question7'],
            'skype' =>  $data['skype'],
            'linkedin' =>  $data['linkedin'],
            // 'status' =>  1,
        ]);
    }
}
