<?php
/**
 * Created by PhpStorm.
 * User: Susie Witch
 * Date: 21.07.2017
 * Time: 20:44
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{

    public function getAllUsers() {
        if (session('role') === 'admin'){

            $filename = 'users.txt';
            if (Storage::exists($filename)) {

                $json = Storage::get($filename);

                $usersarray = json_decode($json, true, 512);

                foreach ($usersarray as $userid) {
                    echo "Логин: ".$userid['login']."<br>";
                    echo "Права: ".$userid['role']."<br>";
                    echo "email: ".$userid['email']."<br>";
                    echo "Фамилия Имя: ".$userid['fullname']."<br>";
                    echo "Пол: ".$userid['sex']."<br>";
                    echo "Телефон: ".$userid['phone']."<br><br><br>";
                }
            }
            else {
                echo 'Нет зарегестрированных пользователей';
            }
        }
        else {
            return view('auth');
        }


    }

}