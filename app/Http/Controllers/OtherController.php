<?php

namespace App\Http\Controllers;
session_start();
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Models\Other;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Rules\Password;
use  Laravel\Jetstream\Jetstream;


class OtherController extends Controller
{
    public function createOther(Request $request)
    {
        if (!isset($_POST['terms'])) {
            $tab = ['The terms field is required'];
            $i=1 ;
            //return redirect()->route('register')->withErrors('The terms field is required');
        }
        else $i=0 ;
        if (!isset($_POST['password']) || strlen($_POST['password']) < 8) {
            array_push($tab,'The password must be at least 8 characters.');
            $j=1 ;
            //return redirect()->route('register')->withErrors('The password must be at least 8 characters.');
        } else $j=0 ;
        if($i==1 || $j==1)  return redirect()->route('register')->withErrors($tab);
         else {
            /*$validate = $request->validate([
                   'password' => ['required', 'string', 'confirmed'],
                   'terms' => ['required', 'accepted']
              ]);*/

            /*Validator::make($_POST, [
                //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            ])->validate();*/
            $type = new Other();
            $table = 'others';
            $id = $type->id;
            $type['email'] = $_SESSION['email'];
            $type['firstName'] = $_SESSION['f_name'];
            $type['lastName'] = $_SESSION['l_name'];
            $type['age'] = $_SESSION['age'];
            $type['address'] = $_SESSION['address'];
            $type['domain'] = $_POST['domain'];
            $type['university'] = $_POST['university'];
            $type['diplom'] = $_POST['diplom'];
            $type->save();
            $user = new CreateNewUser();
            $array = ['type' => 'Other', 'email' => $_SESSION['email'], 'password' => $_POST['password'], 'terms' => $_POST['terms']];
            $user->create($array);
            return redirect()->route('dashboard');


        }
    }
}
