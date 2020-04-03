@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Изображение</th>
                <th scope="col">Адрес</th>
                <th scope="col">Рейтинг</th>
                <th scope="col">Группа</th>
                <th scope="col">Дата</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($gifts as $gift)
                <tr>
                    <td>{{$gift->id}}</td>
                    <td>{{$gift->title}}</td>
                    <td><img class="w-50 img-thumbnail" src="{{$gift->img}}"/></td>
                    <td><a href="{{$gift->url}}">ссылка</a></td>
                    <td>{{$gift->rating}}</td>
                    <td>{{$gift->group}}</td>
                    <td>{{$gift->created_at}}</td>
                    <td>
                        <a href='{{url("admin/gifts/edit/{$gift->id}")}}' class="btn btn-primary btn-sm">Изменить</a>
                        <a onclick="return confirm('Удалить запись?')"
                           href='{{url("admin/gifts/destroy/{$gift->id}")}}'
                           class="btn btn-danger btn-sm">Удалить</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $gifts->render() !!}
    </div>
@endsection
