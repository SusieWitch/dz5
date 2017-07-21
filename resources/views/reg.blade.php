@extends('layouts.layout')

@section('content')

    <h2>Регистрация:</h2>
    <br><br>


    @include('common.errors')

    <form method="POST" action="{{url('register')}}">
        {{ csrf_field() }}
        <div class="form">
            <div style="display: inline; float: left; margin-right: 25px">
                <label for="lg">Логин:</label><br><br>
                <label for="pw">Пароль:</label><br><br>
                <label for="em">E-mail:</label><br><br>
                <label for="fn">Фамилия Имя:</label><br><br>
                <label for="sx">Пол:</label><br><br>
                <label for="ph">Телефон:</label>
            </div>
            <div style="display: inline; float: left;  margin-right: 25px">
                <input type="text" name="login" placeholder='{{$login}}' id="lg"><br><br>
                <input type="password" name="password" placeholder='{{$password}}' id="pw"><br><br>
                <input type="text" name="email" placeholder='{{$email}}' id="em"><br><br>
                <input type="text" name="fullname" placeholder='{{$fullname}}' id="fn"><br><br>
                <select name="sex" id="sx">
                    <option value="man" selected>Муж.</option>
                    <option value="woman">Жен.</option>
                </select><br><br>
                 <input type="text" name="phone" placeholder='{{$phone}}' id="ph">

            </div>
            <div style="display: inline; float: left;">

            </div>
            <div style="clear: left"></div>
        </div>
        <hr>
        <button type="submit">Зарегестрироваться!</button>
    </form>

@endsection