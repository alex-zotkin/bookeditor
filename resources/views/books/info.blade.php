@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="{{url('css/books/info.css')}}">
@endsection





@section('content')
    @include('includes/book_header')
<div id="app" class="column">
    <ul class="width column chapters_list" id="chapters_list">

    @foreach($book->chapters as $chapter)
        <li class="row chapter" chapter_index="{{$chapter->sort}}" v-cloak>
            @can('is-user-author', $book)
                <ion-icon name="move-outline" class="chapter_move"></ion-icon>
            @endcan

            <a href="/book/{{$book->id}}/chapter/{{$chapter->sort}}" class="chapter_left row">
                <div class="chapter_title">
                    <span>{{$chapter->sort}} глава</span>
                    <h3>{{$chapter->title}}</h3>
                </div>
            </a>

            @can('is-user-author', $book)
                <a href="/book/{{$book->id}}/chapter/{{$chapter->sort}}/delete" class="chapter_button row">
                    <ion-icon name="trash-outline"></ion-icon>
                </a>
            @endcan
        </li>
    @endforeach

    @can('is-user-author', $book)
        <button v-on:click="create_form = true">Добавить главу <ion-icon name="add-outline"></ion-icon></button>
    @endcan
    </ul>




    <section class="width form_section column" v-if="create_form" v-cloak>
        <div class="form_box">
            <ion-icon name="close-outline" class="form_close" v-on:click="create_form = false"></ion-icon>
            <div class="form_title row">
                Добавление главы
            </div>

            <form action="/book/{{$book->id}}/chapter/create" method="post" class="column">
                @csrf
                <label>
                    Название
                    <input type="text" name="title" required>
                </label>

                <button>Добавить  <ion-icon name="add-outline"></ion-icon></button>
            </form>
        </div>

    </section>


</div>
@endsection




@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js" integrity="sha512-Eezs+g9Lq4TCCq0wae01s9PuNWzHYoCMkE97e2qdkYthpI0pzC3UGB03lgEHn2XM85hDOUF6qgqqszs+iXU4UA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/js/books/info.js"></script>
@endsection
