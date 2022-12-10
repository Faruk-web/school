<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
       
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'max:11', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $code = date("ymdhis");

        $data = array();
        $data['code'] = $code;
        $data['reseller_id'] = $input['reseller_id'];
        $data['name'] = $input['school_name'];
        //$data['type'] = 'owner';
        $data['registration_date'] = date("Y-m-d");
        DB::table('school_settings')->insert($data);
        
        
        return User::create([
            'type' => 'owner',
            's_code' => $code,
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'email_verified_at' => date("Y-m-d"),
            'password' => Hash::make($input['password']),
        ]);
        


    }
}
