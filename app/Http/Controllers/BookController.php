<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Get all books
     */
    public function index()
    {
        $books = Book::with(['author' => function ($query) {
            $query->select('id', 'name');
        }])->get();

        $response = new ResponseApi;
        $response->setStatusCode(Response::HTTP_OK);
        $response->title('Books');
        $response->message('List of all books');
        $response->data($books);
        return $response;
    }

    /**
     * Store a newly created book.
     */
    public function store(Request $request)
    {
        $response = new ResponseApi;

        // validation request
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'publish_date' => 'required',
            'author_id' => 'required',
        ]);

        if ($validate->fails()) {
            $response->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
            $response->title('Book');
            $response->message('Validation error');
            $response->formError($validate->errors());
            return $response;
        }

        // find author
        $author = Author::find($request->author_id);
        if (!$author) {
            $response = new ResponseApi;
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
            $response->title('Book');
            $response->message('Author not found');
            return $response;
        }

        // create book
        DB::transaction(function () use ($request) {
            Book::create($request->only(['title', 'description', 'publish_date', 'author_id']));
        });

        // return success
        $response->setStatusCode(Response::HTTP_CREATED);
        $response->title('Book');
        $response->message('Successfully created');
        return $response;
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        // find book
        $book = Book::where('id', $request->id)->with([
            'author' => function ($query) {
                $query->select('id', 'name');
            }
        ])->get();

        // return success
        $response = new ResponseApi;
        $response->setStatusCode(Response::HTTP_OK);
        $response->title('Book');
        $response->message('Detail of book');
        $response->data($book);
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $response = new ResponseApi;
        // find book
        $book = Book::findOrFail($request->id);

        // validation request
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'publish_date' => 'required',
            'author_id' => 'required',
        ]);

        if ($validate->fails()) {
            $response->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
            $response->title('Book');
            $response->message('Validation error');
            $response->formError($validate->errors());
            return $response;
        }

        // create book
        DB::transaction(function () use ($request, $book) {
            $book->update($request->only(['title', 'description', 'publish_date', 'author_id']));
        });

        // return success
        $response->setStatusCode(Response::HTTP_OK);
        $response->title('Book');
        $response->message('Book successfully updated');
        $response->data(null);
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // find book
        $book = Book::findOrFail($request->id);

        // delete book
        $book->delete();

        // return success
        $response = new ResponseApi;
        $response->setStatusCode(Response::HTTP_OK);
        $response->title('Book');
        $response->message('Book successfully deleted');
        $response->data(null);
        return $response;
    }
}
