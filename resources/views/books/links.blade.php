@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="{{url('css/books/links.css')}}">
@endsection





@section('content')
    @include('includes/book_header')
    <div id="app" class="width row links">
        <div class="settings_box column">
            <ul class="color_box link_ul">
                <div class="loader column" v-if="loading">
                    <img src="/imgs/book_loader.gif">
                </div>

                <h3 v-if="!loading">Обозначения взаимосвязей</h3>

                @can('is-user-author', $book)
                    <li class="links_ul_top" v-if="!loading">
                        <input type="color" class="color" name="color" value="#f6b73c" id="color">
                        <input type="text" placeholder="Название" id="link_name">
                        <ion-icon name="add-outline" v-on:click="color_create({{$book->id}})"></ion-icon>
                    </li>
                @endcan


                <li v-for="color in data.colors" v-if="!loading">
                    <input disabled type="color" class="color" name="color" :value="color.value">
                    <p>@{{ color.name }}</p>

                    @can('is-user-author', $book)
                        <div class="links_ul_buttons">
                            <ion-icon name="create-outline"></ion-icon>
                            <ion-icon name="trash-outline" v-on:click="color_delete(color.id)"></ion-icon>
                        </div>
                    @endcan
                </li>


            </ul>




            <ul class="relations_box link_ul">
                <div class="loader column" v-if="loading">
                    <img src="/imgs/book_loader.gif">
                </div>

                <h3 v-if="!loading">Взаимоотношения героев</h3>

                @can('is-user-author', $book)
                    <li class="links_ul_top" v-if="!loading">
                        <select name="character_1" id="link_character_1">
                            <option selected disabled>Персонаж 1</option>
                            <option v-for="character in data.characters"
                                    :value="character.id">@{{  character.first_name }} @{{  character.last_name }}</option>
                        </select>
                        <select name="color" id="link_color">
                            <option selected disabled>Взаимосвязь</option>
                            <option v-for="color in data.colors" :value="color.id" >
                                @{{ color.name }}
                            </option>
                        </select>
                        <select name="character_2" id="link_character_2">
                            <option selected disabled>Персонаж 2</option>
                            <option v-for="character in data.characters"
                                    :value="character.id">@{{  character.first_name }} @{{  character.last_name }}</option>
                        </select>
                        <ion-icon name="add-outline" v-on:click="link_create"></ion-icon>
                    </li>
                @endcan


                <li v-for="link in data.links" class="relation">
                    <div class="relation_info row">
                        <div class="column">
                            <div class="relation_character" :style="'background-image: url('+ link.character1.image +')'"></div>
                            <p>@{{ link.character1.first_name }} @{{ link.character1.last_name }}</p>
                        </div>
                        <div class="relation_color column">
                            <h4>@{{ link.color.name }}</h4>
                            <span :style="'background:' + link.color.value"></span>
                        </div>
                        <div class="column">
                            <div class="relation_character" :style="'background-image: url('+ link.character2.image +')'"></div>
                            <p>@{{ link.character2.first_name }} @{{ link.character2.last_name }}</p>
                        </div>
                    </div>

                    @can('is-user-author', $book)
                        <div class="links_ul_buttons">
                            <ion-icon name="create-outline"></ion-icon>
                            <ion-icon name="trash-outline" v-on:click="link_delete(link.id)"></ion-icon>
                        </div>
                    @endcan
                </li>

            </ul>
        </div>

        <canvas id="canvas"></canvas>
    </div>
@endsection




@section('js')
    <script src="https://cdn.jsdelivr.net/npm/pixi.js@7.x/dist/pixi.min.js"></script>
    <script src="/js/books/links.js"></script>
@endsection
