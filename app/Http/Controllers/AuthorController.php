<?php

namespace App\Http\Controllers;

use App\Filters\AuthorFilters;
use App\Http\Resources\Authors;
use App\Models\Author;
use App\Models\AuthorRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "data" => Author::all()
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
            'surname' => ['required', 'max:255'],
            'patronymic' => ['max:255'],
            'birthday' => ['required', 'date_format:d.m.Y']
        ]);

        Author::create($validated);

        return response();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return new Authors($author);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => ['max:255'],
            'surname' => ['max:255'],
            'patronymic' => ['max:255'],
            'birthday' => ['date_format:d.m.Y']
        ]);

        $author->update($validated);

        return response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return response();
    }

    /**
     * Estimate author
     *
     * @param Request $request
     * @param Author $author
     * @return \Illuminate\Http\JsonResponse
     */
    public function estimate(Request $request, Author $author)
    {
        $validated = $request->validate([
            'rating' => ['required', 'numeric', 'min:1', 'max:10']
        ]);

        $userId = Auth::guard('api')->id();

        $rating = AuthorRating::where([
            ['author_id', $author->id],
            ['user_id', $userId]
        ])->first();

        if ($rating === null) {
            $author->ratings()->create([
                'rating' => $validated['rating'],
                'author_id' => $author->id,
                'user_id' => Auth::guard('api')->id()
            ]);
        } else {
            $rating->update($validated);
        }

        return response()->json();
    }
}
