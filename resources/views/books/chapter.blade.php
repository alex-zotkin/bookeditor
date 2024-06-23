@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="{{url('css/books/chapter.css')}}">
@endsection





@section('content')
<div id="app" class="column">
    <div class="width chapter_info row">
        <div class="chapter_top_left">
            @if($chapter->prev != null)
                <a href="/book/{{$chapter->book->id}}/chapter/{{$chapter->prev->sort}}"><ion-icon name="chevron-back-outline"></ion-icon> Глава {{$chapter->prev->sort}}</a>
            @endif
        </div>
        <div class="chapter_top_center column">
            <a href="/book/{{$chapter->book->id}}"><ion-icon name="book-outline"></ion-icon> {{$chapter->book->title}}</a>
            <span class="row">Глава {{$chapter->sort}} из {{count($chapter->book->chapters)}}.
                &nbsp; / &nbsp;
                <div v-if="save" class="chapter_save_button">Cохранено</div>
                <div v-else v-cloak class="chapter_save_button">Автосохранение <img src="/imgs/loader.gif"></div>
            </span>
            <h2>{{$chapter->title}}</h2>
        </div>
        <div class="chapter_top_right">
            @if($chapter->next != null)
                <a href="/book/{{$chapter->book->id}}/chapter/{{$chapter->next->sort}}">Глава {{$chapter->next->sort}} <ion-icon name="chevron-forward-outline"></ion-icon></a>
            @endif
        </div>
    </div>




    <div class="chapter_content row">

        <div class="chapter_characters_box column">
            <h3>Персонажи, встречающиеся в тексте</h3>

            <ul class="chapter_characters_list">
                <div v-for="character in show_characters" class="character_elem column" v-cloak>
                    <li class="character_top">
                        <div class="character_img" :style="'background-image: url('+ character.image +')'"></div>
                    </li>
                    <li class="character_name">
                        @{{ character.first_name }} @{{ character.last_name }}
                    </li>
                    <li class="character_info">
                        <b>Возраст:</b> @{{ character.age }} <br><br>
                        <b>Общая информация:</b> <p v-html="character.info"></p>
                    </li>
                </div>
            </ul>

        </div>

        <div class="chapter_text_box column width ">
            @can('is-user-author', $chapter->book()->first())
                <div id="chapter_text" v-on:input="find_characters">
                    {!! $chapter->text !!}
                </div>
            @endcan

            @cannot('is-user-author', $chapter->book()->first())
                <div id="chapter_text_nonedit">
                    {!! $chapter->text !!}
                </div>
            @endcannot
        </div>

        <div class="chapter_storyline_box">
            <h3>Краткий пересказ предыдущих глав</h3>
                @can('is-user-author', $chapter->book()->first())
                    <div class="character_elem column">
                        <h4>Напишите, краткий пересказ главы</h4>
                        <textarea style="width: 100% !important; height: 250px;" name="" id="short_text" placeholder="Краткий пересказ">{{$chapter->short_text}}</textarea>
                    </div>
                @endcan

                @foreach ($chapter->short_text_list as $short_text)
                    <div class="character_elem column">
                        <li class="character_info">
                            Глава {{$short_text->sort}}:<h2> {{$short_text->title}}</h2>  <br><br>
                            <p style="font-size: 16px;">{{$short_text->short_text}}</p>
                        </li>
                    </div>
                @endforeach
            </ul>

        </div>
    </div>

</div>
@endsection




@section('js')
    <script src="/js/nicEdit/nicEdit.js"></script>
{{--    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>--}}
    <script src="/js/books/chapter.js"></script>
@endsection
