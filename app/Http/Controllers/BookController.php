<?php

namespace App\Http\Controllers;

use App\Http\Resources\Books;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookRating;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort');
        $sort = in_array($sort, ['desc', 'asc']) ? $sort : 'asc';

        $books = Book::withAvg('ratings', 'rating')
            ->orderBy('ratings_avg_rating', $sort)
            ->get();

        return response()->json([
            'data' => $books
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'cover' => ['required', 'url'],
            'description' => ['required'],
            'year' => ['required', 'digits:4'],
            'authors' => ['required', 'array'],
            'authors.*' => ['numeric']
        ]);

        $authors = Author::whereIn('id', $validated['authors'])->get();

        if ($authors->count() === 0) {
            return response()->json([
                'message' => 'These authors are not found'
            ]);
        }

        $book = Book::create($validated);
        $book->authors()->saveMany($authors);

        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return new Books($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'name' => ['max:255'],
            'cover' => ['url'],
            'year' => ['digits:4']
        ]);

        $book->update($validated);

        return response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response();
    }

    /**
     * @param Request $request
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function estimate(Request $request, Book $book)
    {
        $validated = $request->validate([
            'rating' => ['required', 'numeric', 'min:1', 'max:10']
        ]);

        $userId = Auth::guard('api')->id();

        $rating = BookRating::where([
            ['book_id', $book->id],
            ['user_id', $userId]
        ])->first();

        if ($rating === null) {
            $book->ratings()->create([
                'rating' => $validated['rating'],
                'book_id' => $book->id,
                'user_id' => Auth::guard('api')->id()
            ]);
        } else {
            $rating->update($validated);
        }

        return response()->json();
    }
}
