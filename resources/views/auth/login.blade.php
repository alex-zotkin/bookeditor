@extends("layouts.main")

@section("css")
    <link rel="stylesheet" href="{{url('css/auth/login.css')}}">
@endsection



@section("content")

    <section class="width form_section column">

        <div class="form_box">
            <div class="form_title row">
                Вход
            </div>

            <form action="/login" method="post" class="column">
                @csrf
                <label>
                    Email
                    <input type="email" name="email" required value="{{old('email')}}">
                </label>

                <label>
                    Пароль
                    <input type="password" name="password" required>
                </label>

                <button>Войти</button>

                <div class="row variant">
                    Еще нет аккаунта? &nbsp; <a href="/register" class="link">Зарегистируйтесь</a>
                </div>

            </form>
        </div>

    </section>


@endsection



