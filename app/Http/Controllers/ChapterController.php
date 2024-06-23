<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function index($book_id, $chapter_id){
        $chapter = Chapter::query()
            ->where('book_id', $book_id)
            ->where('sort', $chapter_id)
            ->firstOrFail();

        $max_chapter_sort = Chapter::query()
            ->max('sort');

        $chapter->prev = Chapter::query()->where('book_id', $book_id)->where('sort', $chapter->sort-1)->first();
        $chapter->next = Chapter::query()->where('book_id', $book_id)->where('sort', $chapter->sort+1)->first();

        $chapter->short_text_list = Chapter::query()
                                    ->where('sort', '<', $chapter->sort)
                                    ->whereNotNull('short_text')
                                    ->get();

        return view('books.chapter', compact('chapter'));
        // return response(view('books.chapter', compact('chapter')))->cookie( $book_id, $chapter->sort);
    }

    public function create($book_id, Request $request){
        $max_sort_index = 1;
        $max_sort = Chapter::query()
            ->where('book_id', $book_id)
            ->where('sort', $max_sort_index)
            ->first();

        $chapters_count = Chapter::query()
            ->where('book_id', $book_id)
            ->count('id');

        while($max_sort != null){
            $max_sort_index += 1;
            $max_sort = Chapter::query()
                ->where('book_id', $book_id)
                ->where('sort', $max_sort_index)
                ->first();
        }

        $chapter = new Chapter();
        $chapter->book_id = $book_id;
        $chapter->title = $request->title;
        $chapter->sort = $max_sort_index;

        $chapter->save();
        return redirect("/book/". $book_id . "/chapter/" . $chapter->sort);
    }

    public function delete($book_id, $chapter_sort){

        Chapter::query()
            ->where('book_id', $book_id)
            ->where('sort', $chapter_sort)
            ->delete();

        $next_index = $chapter_sort + 1;
        $next_chapter = Chapter::query()
            ->where('book_id', $book_id)
            ->where('sort', $next_index)
            ->first();

        while($next_chapter != null){
            $next_chapter->sort = $next_index - 1;
            $next_chapter->save();

            $next_index += 1;
            $next_chapter = Chapter::query()
                ->where('book_id', $book_id)
                ->where('sort', $next_index)
                ->first();
        }
        return redirect("/book/". $book_id);
    }

    public function save($book_id, $chapter_id, Request $request)
    {
        $chapter = Chapter::query()
            ->where('book_id', $book_id)
            ->where('sort', $chapter_id)
            ->firstOrFail();

        $chapter->text = $request->input('text');
        $chapter->short_text = $request->input('short_text');
        $chapter->save();

        return response()->json([], 200);
    }


    public function swap($book_id, Request $request)
    {
        $chapter_from = Chapter::query()
            ->where('book_id', $book_id)
            ->where('sort', $request->input('from'))
            ->firstOrFail();

        $chapter_to = Chapter::query()
            ->where('book_id', $book_id)
            ->where('sort', $request->input('to'))
            ->firstOrFail();

        $chapter_from->sort = $request->input('to');
        $chapter_from->save();
        $chapter_to->sort = $request->input('from');
        $chapter_to->save();

        return response()->json([], 200);
    }
}
