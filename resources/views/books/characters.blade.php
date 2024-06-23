@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="{{url('css/books/characters.css')}}">
@endsection





@section('content')
    @include('includes/book_header')
<div id="app" class="column">
    <div class="character_list width">
        @foreach($book->characters as $character)
            <ul class="character_elem column">
                <li class="character_top">
                    <div class="character_img" style="background-image: url({{$character->image}})"></div>
                    @can('is-user-author', $book)
                        <div class="character_edit_buttons">
                            <a v-on:click="edit({{$character}});">
                                <ion-icon name="create-outline"></ion-icon>
                            </a>
                            <a href="/book/{{$book->id}}/characters/delete/{{$character->id}}">
                                <ion-icon name="trash-outline" style="color: red;"></ion-icon>
                            </a>
                        </div>
                    @endcan
                </li>
                <li class="character_name">
                    {{$character->first_name}} {{$character->last_name}}
                </li>
                <li class="character_info">
                    <b>Возраст:</b> {{$character->age}} <br><br>
                    <b>Общая информация:</b></br> <p v-html="urlify(`{{$character->info}}`)"></p>
                </li>
            </ul>
        @endforeach

        @can('is-user-author', $book)
            <ul class="character_elem character_add column" v-on:click="create_form = true">
                <ion-icon name="add-outline"></ion-icon>
                <h3>Добавить персонажа</h3>
            </ul>
        @endcan
    </div>










    <section class="width form_section column" id="character_create" v-show="create_form" v-cloak>

        <div class="form_box">
            <ion-icon name="close-outline" class="form_close" v-on:click="create_form = false"></ion-icon>

            <div class="form_title row">
                Добавление персонажа
            </div>

            <form action="/book/{{$book->id}}/characters/create" method="post" class="column" enctype="multipart/form-data">
                @csrf
                <label class="input_image_label">
                    <ion-icon name="image-outline"></ion-icon>
                    <input type="file" name="image">
                </label>

                <label>
                    Имя (обязательно)
                    <input type="text" name="first_name" required>
                </label>

                <label>
                    Фамилия
                    <input type="text" name="last_name">
                </label>

                <label>
                    Возраст
                    <input type="number" name="age">
                </label>

                <label>
                    Информация
                    <textarea name="info" cols="30" rows="15"></textarea>
                </label>

                <button>Добавить <ion-icon name="add-outline"></ion-icon></button>
            </form>
        </div>

    </section>

    <section class="width form_section column" id="character_edit" v-show="edit_form" v-cloak>

        <div class="form_box">
            <ion-icon name="close-outline" class="form_close" v-on:click="edit_form = false"></ion-icon>

            <div class="form_title row">
                Редактирование персонажа
            </div>

            <form :action="'/book/{{$book->id}}/characters/edit/'+ edit_character.id" method="post" class="column" enctype="multipart/form-data">
                @csrf
                <label class="input_image_label" :style="'background-image: linear-gradient(0deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.3)), url('+ edit_character.image +');'">
                    <ion-icon name="image-outline"></ion-icon>
                    <input type="file" name="image">
                </label>

                <label>
                    Имя (обязательно)
                    <input type="text" name="first_name" required :value="edit_character.first_name">
                </label>

                <label>
                    Фамилия
                    <input type="text" name="last_name" :value="edit_character.last_name">
                </label>

                <label>
                    Возраст
                    <input type="number" name="age" :value="edit_character.age">
                </label>

                <label>
                    Информация
                    <textarea name="info" cols="30" rows="15" v-text="edit_character.info"></textarea>
                </label>

                <button>Сохранить <ion-icon name="save-outline"></ion-icon></button>
            </form>
        </div>

    </section>
</div>
@endsection




@section('js')
    <script src="/js/books/characters.js"></script>
@endsection
