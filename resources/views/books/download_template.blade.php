<div style="font-family: 'DejaVu Sans', sans-serif;">

    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <h1>{{$book->title}}</h1>
        {{-- <img src="{{public_path()}}{{$book->image}}" style="height: 85%;"> --}}
        <br><br><br>
    </div>

    @foreach ($chapters as $c)
        <h2>{{$c->title}}</h2>

        <p>{!! $c->text !!}</p>
        <br><br><br> <br><br><br>
    @endforeach

</div>
