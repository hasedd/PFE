<?php

namespace App\Actions\Fortify;

use App\Http\Controllers\OtherController;
use App\Models\Student;
use App\Models\Other;
use App\Models\Teacher;
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
        if ($input['type']=='Student'|| $input['type']=='Teacher'  ) {
            Validator::make($input, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            ])->validate();
        }
       /* if ( $input['type']=='Other'){
            Validator::make($input, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'confirmed'] ,
                'terms' => ['required', 'accepted'] ,
            ])->validate();

        }*/

        if ($input['type']=='Student' ){
            $type = Student::where('email',$input['email'])->first();
        }
        else if ($input['type']=='Teacher'){
            $type = Teacher::where('email',$input['email'])->first();
        }
        else if ($input['type']=='Other'){
            $type=Other::where('email',$input['email'])->first();
            $type->user()->create(['username'=>$type->lastName.".".$type->firstName,'name'=>$type->firstName,'email'=>$type->email,'password'=>Hash::make($input['password'])]);
            return $type->user;
        }
        else $type=null;
        if ($type!=null){

            $type->user()->create(['username'=>$type->lastName.".".$type->firstName,'name'=>$type->firstName,'email'=>$type->email,'password'=>Hash::make($input['password'])]);
            return $type->user;
        }else {
            $message = __('No '.$input['type'].' with this email');
            throw ValidationException::withMessages([
                'notfound' => [$message],]) ;
            return redirect()->back()->withErrors(['notfound' => $message]);}
    }
}
