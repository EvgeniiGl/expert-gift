@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="d-flex flex-row">
            <a href='{{url("admin/gifts")}}'>Список идей</a>

        </div>
        <div class="d-flex flex-row">
            <a href='{{url("/admin/parse_etsy_com/run_parse_url_gift/1")}}'>Добавить страницы с идеями etsy.com</a>
        </div>
        <div class="d-flex flex-row">
            <a href='{{url("/admin/parse_etsy_com/run_parse_gift")}}'>Парсить картинки и заголовки идей</a>
        </div>
    </div>


@endsection
