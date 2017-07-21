@extends('layouts.layout')

@section('content')

    <h2>Профиль:</h2>
    <br><br>


    @include('common.errors')



        <div class="form">
            @if ($img != null)
                <img src="{{$img}}" width="200">

            @endif
            <div style="display: inline; float: left; margin-right: 50px">
                <form enctype="multipart/form-data" action="{{url('uploadFile')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                    <input name="userfile" type="file" />
                    <input type="submit" value="Загрузить файл" />
                </form>
            </div>

                <div style="display: inline; float: left; margin-right: 20px">
                <p>Логин</p>
                <p>E-mail</p>
                <p>Фамилия Имя</p>
                <p>Пол</p>
                <p>Моб.телефон</p>
            </div>
            <div style="display: inline; float: left;">

                <p>{{$login}}</p>
                <p>{{$email}}</p>
                <p>{{$fullname}}</p>
                <p>{{$sex}}</p>
                <p>{{$phone}}</p>
            </div>
            <div style="clear: left"></div>
        </div>
        <hr>



@endsection