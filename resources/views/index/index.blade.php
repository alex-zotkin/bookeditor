@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="{{url('css/books/index.css')}}">
    <link rel="stylesheet" href="{{url('css/index/index.css')}}">
@endsection





@section('content')
    <section class="width column">
        <h1>BookEditor -</h1>
        <h3>ваш редактор для создания художественных книг</h3>
        <a href="/books"><button>Начать</button></a>
    </section>
@endsection




@section('js')
    <script src="{{url('js/books/index.js')}}"></script>
@endsection
