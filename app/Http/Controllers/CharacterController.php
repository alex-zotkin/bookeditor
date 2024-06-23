<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function position_edit(Request $request){
        $character = Character::query()
            ->where('id', $request->input('character_id'))
            ->firstOrFail();

        $character->x = $request->input('x');
        $character->y = $request->input('y');
        $character->save();
        return response()->json();
    }


    public function character_create($book_id, Request $request){
        $book = Book::query()
            ->where('id', $book_id)
            ->firstOrFail();

        $image_path = '/imgs/books/characters/placeholder_character.png';
        if($request->file('image') != null){
            $md5Name = md5_file($request->file('image')->getRealPath());
            $image_extension = $request->file('image')->guessExtension();
            $image_name = $md5Name . "." . $image_extension;
            $image_dir = '/imgs/books/characters/';

            $request->file('image')->move(public_path() . $image_dir, $image_name);

            $image_path = $image_dir . $image_name;
        }

        $character = Character::query()->create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'age' => $request->input('age'),
            'info' => $request->input('info'),
            'book_id' => $book->id,
            'image' => $image_path,
            'x' => rand(100, 400),
            'y' => rand(100, 400),
        ]);


        return redirect('/book/' . $book->id . '/characters');
    }



    public function character_edit($book_id, $character_id, Request $request){
        $character = Character::query()
                                ->where('id', $character_id)
                                ->firstOrFail();

        $character->first_name = $request->input('first_name');
        $character->last_name = $request->input('last_name');
        $character->age = $request->input('age');
        $character->info = $request->input('info');

        if($request->file('image') != null){
            $md5Name = md5_file($request->file('image')->getRealPath());
            $image_extension = $request->file('image')->guessExtension();
            $image_name = $md5Name . "." . $image_extension;
            $image_dir = '/imgs/books/characters/';

            $request->file('image')->move(public_path() . $image_dir, $image_name);

            $character->image = $image_dir . $image_name;
        }

        $character->save();
        return redirect('/book/' . $book_id . '/characters');
    }


    public function character_delete($book_id, $character_id){
        Character::query()
            ->where('id', $character_id)
            ->delete();

        return redirect('/book/' . $book_id . '/characters');
    }
}
