@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="{{url('css/books/index.css')}}">
@endsection





@section('content')
    <section class="width column" id="app">
        <h1>Ваши книги</h1>

{{--        {{dd(session()->get('user')->books)}}--}}

        <div class="books">
            @foreach($books as $book)
            <a href="/book/{{$book->id}}" class="books_elem">
                <div class="books_elem_img_box black_book">
                    <div class="books_elem_img" style="background-image: url({{$book->image}})"></div>
                </div>

                <h3 class="books_elem_title">{{$book->title}}</h3>
                <span>Количество глав: {{count($book->chapters)}}</span>
            </a>
            @endforeach


            <div href="/" class="books_elem" v-on:click="new_book_mode = true">
                <div class="books_elem_img_box blue_book">
                    <div class="books_elem_img">
                        <ion-icon name="add-outline"></ion-icon>
                    </div>
                </div>

                <h3 class="books_elem_title" style="color: var(--blue);">Новая книга</h3>

                <form action="/book/create" method="post" v-if="new_book_mode" enctype="multipart/form-data" v-cloak>
                    @csrf
                    <label>
                        Название
                        <input type="text" name="title" required>
                    </label>


                    <label>
                        Обложка
                        <input type="file" name="image" required>
                    </label>

                    <button>Создать</button>
                </form>

            </div>
        </div>
    </section>





    <section class="width column" id="app">
        <h1>Книги других авторов</h1>

        <div class="books">
            @foreach($other_books as $other_book)
            <a href="/book/{{$other_book->id}}" class="books_elem">
                <div class="books_elem_img_box black_book">
                    <div class="books_elem_img" style="background-image: url({{$other_book->image}})"></div>
                </div>

                <h3 class="books_elem_title">{{$other_book->title}}</h3>
                <h4 class="books_elem_title">Автор: {{$other_book->user()->first()->first_name}} {{$other_book->user()->first()->last_name}}</h4>
                <span>Количество глав: {{count($other_book->chapters)}}</span>
            </a>
            @endforeach


        </div>
    </section>
@endsection




@section('js')
    <script src="{{url('js/books/index.js')}}"></script>
@endsection
