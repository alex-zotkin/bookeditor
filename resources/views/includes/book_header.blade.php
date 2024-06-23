<link rel="stylesheet" href="{{url('css/book_header.css')}}">

<section class="width column">

    <div class="book_info row">
        <div class="book_info_left row">
            <div class="books_elem_img_box black_book">
                <div class="books_elem_img" style="background-image: url({{$book->image}})"></div>
            </div>

            <div class="book_info_text column">
                <h3 class="books_elem_title">{{$book->title}}</h3>
                <span>Количество глав: {{count($book->chapters)}}</span>
                <span>Дата начала: <i>{{date('d/m/y', strtotime($book->created_at))}}</i></span>
                <span>Последнее редактирование: <i>{{date('d/m/y', strtotime($book->updated_at))}}</i></span>
                <a id="continue_read" style="color: blue; font-weight: 500;"></a>
            </div>
        </div>

        <div class="book_info_buttons column">
            <a href="/book/{{$book->id}}/download">
                <button>Экспортировать <ion-icon name="download-outline"></ion-icon></button>
            </a>

            @can('is-user-author', $book)
                <a href="/book/{{$book->id}}/delete">
                    <button>Удалить</button>
                </a>
            @endcan
        </div>
    </div>


    <div class="links_to_functions">
        <a href="/book/{{$book->id}}" class="button2 row">
            <ion-icon name="code-working-outline"></ion-icon>
            Главы
        </a>

        <a href="/book/{{$book->id}}/characters" class="button2 row">
            <ion-icon name="people-outline"></ion-icon>
            Персонажи
        </a>

        <a href="/book/{{$book->id}}/links" class="button2 row">
            <ion-icon name="link-outline"></ion-icon>
            Взаимосвязь героев
        </a>

        <a href="/book/{{$book->id}}/storyline" class="button2 row">
            <ion-icon name="git-commit-outline"></ion-icon>
            Краткий пересказ
        </a>
    </div>


</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="/js/books/book_header.js"></script>
