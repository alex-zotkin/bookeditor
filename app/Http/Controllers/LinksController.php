<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Color;
use App\Models\Link;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    public function index($book_id){
        $book = Book::query()
            ->where('id', $book_id)
            ->firstOrFail();

        return view('books.links', compact('book'));
    }



    public function all_info($book_id){
        $book = Book::query()
            ->where('id', $book_id)
            ->firstOrFail();

        $links = $book->links;
        for($i = 0; $i < count($links); $i++){
            $links[$i]['character1'] = $links[$i]->character1;
            $links[$i]['color'] = $links[$i]->color;
            $links[$i]['character2'] = $links[$i]->character2;
        }

        return response()->json([
            'colors' => $book->colors,
            'characters' => $book->characters,
            'links' => $links
        ]);
    }









    public function color_create(Request $request){
        if($request->input('name') != null && $request->input('value') != null){
            $color = new Color();
            $color->name = $request->input('name');
            $color->value = $request->input('value');
            $color->book_id = $request->input('book_id');

            $color->save();
        }

        return response()->json();
    }



    public function color_delete(Request $request){
        Color::query()
            ->where('id', $request->input('id'))
            ->delete();

        return response()->json();
    }









    public function link_create(Request $request){
        if($request->input('character1_id') != $request->input('character2_id')
            && $request->input('character1_id') != null
            && $request->input('character2_id') != null
            && $request->input('color_id') != null )
        {
            $link = new Link();
            $link->character1_id = $request->input('character1_id');
            $link->color_id = $request->input('color_id');
            $link->character2_id = $request->input('character2_id');
            $link->book_id = $request->input('book_id');

            $link->save();
        }

        return response()->json();
    }

    public function link_delete(Request $request){
        Link::query()
            ->where('id', $request->input('id'))
            ->delete();

        return response()->json();
    }
}
