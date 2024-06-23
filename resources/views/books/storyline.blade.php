@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="{{url('css/books/info.css')}}">
@endsection





@section('content')
    @include('includes/book_header')
<div id="app" class="column">
    <ul class="width column chapters_list" id="chapters_list">

    @foreach($storyline as $line)
        <div class="spoler" v-if="spoler != null && spoler == {{$line->sort}}">
            <h3 style="color: red;">Вы остановились на главе @{{spoler}}. Дальше возможны спойлеры</h3>
            <div style="width: 100%; height: 3px; background: red; margin-bottom: 20px;"></div>
        </div>

        <li class="row chapter">
            <a href="/book/{{$line->book_id}}/chapter/{{$line->sort}}" class="chapter_left row">
                <div class="chapter_title">
                    <h3>{{$line->sort}} глава - {{$line->title}}</h3>
                    <p>{{$line->short_text}}</p>
                </div>
            </a>
        </li>
    @endforeach
    </ul>


</div>
@endsection




@section('js')
    <script src="/js/books/storyline.js"></script>
@endsection
