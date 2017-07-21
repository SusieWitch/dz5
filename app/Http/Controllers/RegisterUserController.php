<?php
/**
 * Created by PhpStorm.
 * User: Susie Witch
 * Date: 17.07.2017
 * Time: 13:25
 */

namespace App\Http\Controllers;

use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class RegisterUserController extends Controller
{   public $data =[];
    public $userarray=[];

            /*проверка ввода в форму*/
    public function validateUser(Request $request){
        $this->validate($request,[
            'login' => 'required|max:30|alpha_dash',
            'password' => 'required|min:4|max:25|alpha_dash',
            'email' => 'required|email|max:255',
            'fullname' => 'required|max:255',
            'sex' => 'required',
            'phone' => 'required|digits:10',

        ]);
        session(['login' => $request['login'],
                'password' => $request['password'],
                'email' => $request['email'],
                'fullname' => $request['fullname'],
                'sex' => $request['sex'],
                'phone' =>$request['phone'],
                'role' => 'user',
                'img' => null]
        );

    }

                  /* запись в json файл*/

    public function registerUser(Request $request)
    {
        $this->validateUser($request);

        $data['login'] = $request->session()->get('login');
        $data['password'] = $request->session()->get('password');
        $data['email'] = $request->session()->get('email');
        $data['fullname'] = $request->session()->get('fullname');
        $data['sex'] = $request->session()->get('sex');
        $data['phone'] = $request->session()->get('phone');
        $data['role'] = $request->session()->get('role');
        $data['img'] = $request->session()->get('img');

        $filename = 'users.txt';
        if (Storage::exists($filename)) {

            $json = Storage::get($filename);

            $usersarray = json_decode($json, true, 512);
            $nameuser = strtolower($data['login']);


            foreach ($usersarray as $key => $userid) {
                foreach ($userid as $userkey => $value){

                if ($value === $nameuser) {
                    $request->session()->flush();
                    return view('reg')->with(['login' => 'Логин занят',
                        'password' => 'password',
                        'email' => 'email',
                        'fullname' =>'fullname',
                        'phone' => 'phone']);
                }}
            }
            $usersarray[$nameuser] = ['login' => $data['login'],
                                        'password' => $data['password'],
                                        'email' => $data['email'],
                                        'fullname' => $data['fullname'],
                                        'sex' => $data['sex'],
                                        'phone' => $data['phone'],
                                        'role' =>'user',
                                        'img' => null];

            $json = json_encode($usersarray, JSON_UNESCAPED_UNICODE, 512);
            Storage::disk('local')->put('users.txt', $json);


        }

        else {
            $nameuser = strtolower($data['login']);
            $usersarray[$nameuser] = ['login' => $data['login'],
                                                    'password' => $data['password'],
                                                    'email' => $data['email'],
                                                    'fullname' => $data['fullname'],
                                                    'sex' => $data['sex'],
                                                    'phone' => $data['phone'],
                                                    'role' =>'user',
                                                    'img' => null];

            $json = json_encode($usersarray, JSON_UNESCAPED_UNICODE, 512);
            Storage::disk('local')->put('users.txt', $json);
        }




            return view('userprofile', ['login' => $data['login'],
                                            'password' => $data['password'],
                                            'email' => $data['email'],
                                            'fullname' => $data['fullname'],
                                            'sex' => $data['sex'],
                                            'phone' => $data['phone']
                                            ]);
    }

                 /*удаление сессии*/

    public function authExit(Request $request){
        $request->session()->flush();
        return redirect('/auth');
    }

    public function uploadFile(){

        $filename = session()->get('login').'.jpg';

       if (is_uploaded_file($_FILES['userfile']['tmp_name'])){
           if (($_FILES['userfile']['size'] != 0) and ($_FILES['userfile']['tmp_name'] != null)){
               move_uploaded_file($_FILES['userfile']['tmp_name'], $filename);


               return view('userprofile', ['login' =>session()->get('login'),
                                               'email' => session()->get('email'),
                                               'fullname' => session()->get('fullname'),
                                               'sex' => session()->get('sex'),
                                               'phone' => session()->get('phone'),
                                               'img' => $filename,

               ]);
           }
           else {
               echo 'error_is_size'.$_FILES['userfile']['error'];
           }
       }
       else {
               echo 'error_is_uploaded'.$_FILES['userfile']['error'];
           }
    }

}