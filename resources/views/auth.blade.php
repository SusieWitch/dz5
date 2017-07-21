@extends('layouts.layout')

@section('content')

    <h2>Войдите:</h2>
    <br><br>


    @include('common.errors')

    <form method="POST" action="{{url('loginin')}}">
        {{ csrf_field() }}
        <div class="form">
            <div style="display: inline; float: left; margin-right: 25px">
                <label for="lg">Логин или e-mail:</label><br><br>
                <label for="pw">Пароль:</label><br><br>

            </div>
            <div style="display: inline; float: left;">
                <input type="text" name="loginemail" id="lg"><br><br>
                <input type="password" name="password" id="pw"><br><br>

            </div>
            <div style="clear: left"></div>
        </div>
        <hr>
        <button type="submit">Войти!</button>
    </form>

@endsection