<?php

namespace App\Http\Controllers;

use App\Books;
use App\Genres;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use JWTAuth;


class BooksController extends Controller
{
    var $ownerId = null;

    public function __construct()
    {
        $this->ownerId = JWTAuth::parseToken()->toUser()->id;
    }

    public function index()
	{
        return [
            'books' => Books::where('owner_id', $this->ownerId)->get(),
            'genres'=> Genres::all()
        ];
	}

	public function show($id)
	{
		return Books::findOrFail($id);
	}

	public function update(Request $request, $id)
	{
		$book = Books::findOrFail($id);
		$book->update($request->all());

		return $book;
	}

	public function store(Request $request)
	{
        $book = Books::create([
            'title'     => $request->get('title'),
            'author'    => $request->get('author'),
            'isbn'      => $request->get('isbn'),
            'genre_id'  => $request->get('genre_id'),
            'owner_id'  => $this->ownerId
        ]);
        return $book;
	}

	public function destroy($id)
	{
		$book = Books::findOrFail($id);
		$book->delete();
		return '';
	}
}
