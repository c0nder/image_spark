<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $authors = Author::where(
            DB::raw('CONCAT(" ", name, surname, patronymic)'),
            'LIKE',
            "%{$query}%"
        )->get();

        $books = Book::whereHas('authors', function (Builder $q) use ($query) {
            $q->where(
                DB::raw('CONCAT(" ", name, surname, patronymic)'),
                'LIKE',
                "%{$query}%"
            );
        })->orWhere('name', 'LIKE', "%{$query}%")
            ->with('authors')
            ->get();

        return response()->json([
            'data' => [
                'authors' => $authors,
                'books' => $books
            ]
        ]);
    }
}
