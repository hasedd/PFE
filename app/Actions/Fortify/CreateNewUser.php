<?php

namespace App\Actions\Fortify;

use App\Models\Student;
use App\Models\Other;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();


        if ($input['type']=='Student' ){
            $type = Student::where('email',$input['email'])->first();
        }
        else if ($input['type']=='Teacher'){
            $type = Teacher::where('email',$input['email'])->first();
        }
        else {
            $type=new Other();
            $table='others';
            $id=$type->id;
            $type['email']=$input['email'];
            $type['firstName']=$input['f_name'];
            $type['lastName']=$input['l_name'];
            $type['age']=$input['age'];
            $type['address']=$input['address'];
            $type['domain']=$input['domain'];
            $type['university']=$input['university'];
            $type['diplom']=$input['diplom'];
            $type->save();
        }
        if ($type!=null){

            $type->user()->create(['name'=>$type->firstName,'email'=>$type->email,'password'=>Hash::make($input['password'])]);

            return $type->user;
        }else {
            $message = __('No '.$input['type'].' with this email');
            throw ValidationException::withMessages([
                'notfound' => [$message],]) ;
            return redirect()->back()->withErrors(['notfound' => $message]);}
    }
}
