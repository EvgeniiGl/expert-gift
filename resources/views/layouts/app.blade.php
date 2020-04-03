<!DOCTYPE html>
<html lang="ru">

@include('layouts.head')

<body>

@yield('content')
{{--<script defer type="text/javascript" src="{{asset("/js/app.js")}}"></script>--}}
@if(Session::has('message'))
    <div class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
@endif
</body>
</html>









