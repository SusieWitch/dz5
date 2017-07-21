<?php
/**
 * Created by PhpStorm.
 * User: Susie Witch
 * Date: 21.07.2017
 * Time: 11:21
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AuthController extends Controller
{
    public function authUser(Request $request)
    {

        session(['loginemail' => $request['loginemail'],
                'password' => $request['password']]
        );

        $data['login'] = $request->session()->get('loginemail');
        $data['password'] = $request->session()->get('password');


        if (Storage::exists('users.txt')) {

            $json = Storage::get('users.txt');

            $usersarray = json_decode($json, true, 512);
            $nameuser = strtolower($data['login']);

            foreach ($usersarray as $userid) {


                if ((($userid['login'] == $nameuser) or ($userid['email'] == $nameuser)) and ($userid['password'] === $data['password'])) {

                    if ($userid['role'] === 'admin') {
                        session(['login' => $userid['login'],
                                'password' => $userid['password'],
                                'email' => $userid['email'],
                                'fullname' => $userid['fullname'],
                                'sex' => $userid['sex'],
                                'phone' => $userid['phone'],
                                'role' => $userid['role']]
                        );

                        return view('usersprofile', ['login' => $userid['login'],
                            'password' => $userid['password'],
                            'email' => $userid['email'],
                            'fullname' => $userid['fullname'],
                            'sex' => $userid['sex'],
                            'phone' => $userid['phone']
                        ]);

                    } else {
                        session(['login' => $userid['login'],
                                'password' => $userid['password'],
                                'email' => $userid['email'],
                                'fullname' => $userid['fullname'],
                                'sex' => $userid['sex'],
                                'phone' => $userid['phone']]
                        );
                        return view('userprofile', ['login' => $userid['login'],
                            'password' => $userid['password'],
                            'email' => $userid['email'],
                            'fullname' => $userid['fullname'],
                            'sex' => $userid['sex'],
                            'phone' => $userid['phone']
                        ]);
                    }
                }
               /* else {
                    return view('reg')->with(['login' => 'Логин',
                        'password' => 'password',
                        'email' => 'email',
                        'fullname' =>'fullname',
                        'phone' => 'phone']);

                }*/

            }
        }
        else {
            return view('reg')->with(['login' => 'Логин',
                'password' => 'password',
                'email' => 'email',
                'fullname' =>'fullname',
                'phone' => 'phone']);
        }
    }
}