<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Session::has('login')){
        return view('userprofile', ['login' => session()->get('login'),
            'password' => session()->get('password'),
            'email' => session()->get('email'),
            'fullname' => session()->get('fullname'),
            'sex' => session()->get('sex'),
            'phone' => session()->get('phone'),
            'role' => session()->get('role'),
            'img' => session()->get('img')
        ]);
    }
    else
    return redirect ('auth');
});

Route::post('/register', 'RegisterUserController@registerUser');

Route::get('/userprofile', function () {
    if (Session::has('login')){
        return view('userprofile', ['login' => session()->get('login'),
            'password' => session()->get('password'),
            'email' => session()->get('email'),
            'fullname' => session()->get('fullname'),
            'sex' => session()->get('sex'),
            'phone' => session()->get('phone'),
            'role' => session()->get('role'),
            'img' => session()->get('img')
        ]);
    }
    else
        return view('auth');
});

Route::get('/reg', function () {
    if (Session::has('login')){
        return view('userprofile', ['login' => session()->get('login'),
            'password' => session()->get('password'),
            'email' => session()->get('email'),
            'fullname' => session()->get('fullname'),
            'sex' => session()->get('sex'),
            'phone' => session()->get('phone'),
            'role' => session()->get('role'),
            'img' => session()->get('img')
        ]);
    }
    else
        return view('reg')->with(['login' => 'login',
            'password' => 'password',
            'email' => 'exemple@mail.com',
            'fullname' => 'Фамилия Имя',
            'sex' => 'sex',
            'phone' => '10 цифр']);
});

Route::get('/auth', function () {
    if (Session::has('login')){
        return view('userprofile', ['login' => session()->get('login'),
            'password' => session()->get('password'),
            'email' => session()->get('email'),
            'fullname' => session()->get('fullname'),
            'sex' => session()->get('sex'),
            'phone' => session()->get('phone'),
            'role' => session()->get('role'),
            'img' => session()->get('img')
        ]);
    }
    else
        return view('auth');
});
Route::post('uploadFile','RegisterUserController@uploadFile');
Route::post('/loginin', 'AuthController@authUser');
Route::get('/exit', 'RegisterUserController@authExit');
Route::get('allusers', 'UsersController@getAllUsers');


