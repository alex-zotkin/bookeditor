@extends("layouts.main")

@section("css")
    <link rel="stylesheet" href="{{url('css/auth/register.css')}}">
@endsection



@section("content")

    <section class="width form_section column">

        <div class="form_box">
            <div class="form_title row">
                Регистрация
            </div>

            @if($errors->any())
                <div class="error column">
                    @foreach($errors->all() as $error)
                        {{$error}}
                    @endforeach
                </div>
            @endif

            <form action="/register" method="post" class="column">
                @csrf
                <label>
                    Имя
                    <input type="text" name="first_name" required value="{{old('first_name')}}">
                </label>


                <label>
                    Фамилия
                    <input type="text" name="last_name" required value="{{old('last_name')}}">
                </label>

                <label>
                    Email
                    <input type="email" name="email" required value="{{old('email')}}">
                </label>

                <label>
                    Пароль
                    <input type="password" name="password" required>
                </label>

                <button>Зарегистрироваться</button>

                <div class="row variant">
                    Уже есть аккаунт? &nbsp; <a href="/login" class="link">Войдите</a>
                </div>
            </form>
        </div>

    </section>


@endsection



