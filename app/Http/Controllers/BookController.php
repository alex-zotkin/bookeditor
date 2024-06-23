<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Character;
use Illuminate\Http\Request;
use PDF;

class BookController extends Controller
{
    public function index(){
        $books = [];
        $books = auth()->user()->books;


        $other_books = Book::query()
                        ->where('user_id', '!=', auth()->user()->id)
                        ->get();

        return view('books.index', compact('books', 'other_books'));
    }

    public function create(Request $request){

        $md5Name = md5_file($request->file('image')->getRealPath());
        $image_extension = $request->file('image')->guessExtension();
        $image_name = $md5Name . "." . $image_extension;
        $image_dir = '/imgs/books/covers/';

        $request->file('image')->move(public_path() . $image_dir, $image_name);
        //$user = session()->get('user');
        $user = auth()->user();

        $book = Book::query()->create([
            'title' => $request->input('title'),
            'image' => $image_dir . $image_name,
            'user_id' => $user->id,
        ]);

//        dd($request->all());

        return redirect('/book/' . $book->id);
    }

    public function info($id){
        $book = Book::query()
                        ->where('id', $id)
                        ->firstOrFail();

//        if($book->user != session()->get('user')){
//            return redirect('/');
//        }

        return view('books.info', compact('book'));
    }

    public function delete($id){
        $book = Book::query()
            ->where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->delete();

        return redirect('/books');
    }





    public function download($book_id){
        $chapters = Chapter::query()
                    ->where('book_id', $book_id)
                    ->orderBy('sort')
                    ->get();

        $book = Book::query()
            ->where('id', $book_id)
            ->first();

        $pdf = PDF::loadView('books.download_template', compact('chapters', 'book'));
        return $pdf->download($book->title . '.pdf');
    }








    public function characters($book_id){
        $book = Book::query()
                        ->where('id', $book_id)
                        ->firstOrFail();

        return view('books.characters', compact('book'));
    }


    public function storyline($book_id){
        $book = Book::query()
                    ->where('id', $book_id)
                    ->firstOrFail();

        $storyline = Chapter::query()
                    ->where('book_id', $book_id)
                    ->orderBy('sort')
                    ->get();


        return view('books.storyline', compact(['storyline', 'book']));
    }

}
