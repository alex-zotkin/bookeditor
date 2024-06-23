<link rel="stylesheet" href="{{url('css/header.css')}}">

<header>
    <a href="/" class="header_logo">
{{--        <ion-icon name="book-outline"></ion-icon>--}}
        <img src="/imgs/book_loader.gif">
        <b>BookEditor</b>
    </a>
    |

    <div class="header_links">
        @if(!auth()->check())
            <a href="/login" class="link">Войти</a>
            <a href="/register" class="link">Регистрация</a>
        @else
            <a href="/books" class="row">
                <img class="header_avatar" src="{{auth()->user()->avatar}}">
{{--                {{session()->get('user')->first_name}}--}}
                Ваши книги
            </a>
            <a href="/logout" class="link">Выйти</a>
        @endif

    </div>
</header>
