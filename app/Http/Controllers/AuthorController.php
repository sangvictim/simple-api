<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    /**
     * Get all authors
     */
    public function index()
    {
        $authors = Author::all();

        $response = new ResponseApi;
        $response->setStatusCode(Response::HTTP_OK);
        $response->title('Author');
        $response->message('List of all authors');
        $response->data($authors);
        return $response;
    }

    /**
     * Store a newly created authors.
     */
    public function store(Request $request)
    {
        $response = new ResponseApi;

        // validation request
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'bio' => 'required',
            'birth_date' => 'required',
        ]);

        if ($validate->fails()) {

            $response->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
            $response->title('Author');
            $response->message('Validation error');
            $response->formError($validate->errors());
            return $response;
        }

        // create author
        DB::transaction(function () use ($request) {
            Author::create($request->only(['name', 'bio', 'birth_date']));
        });

        // return success
        $response->setStatusCode(Response::HTTP_OK);
        $response->title('Author');
        $response->message('Successfully created');
        $response->data(null);
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        // find author
        $author = Author::findOrFail($request->id);

        // return success
        $response = new ResponseApi;
        $response->setStatusCode(Response::HTTP_OK);
        $response->title('Author');
        $response->message('Detail of authors');
        $response->data($author);
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // find author
        $author = Author::findOrFail($request->id);

        // delete author
        $author->delete();

        // return success
        $response = new ResponseApi;
        $response->setStatusCode(Response::HTTP_OK);
        $response->title('Author');
        $response->message('Author successfully deleted');
        $response->data(null);
        return $response;
    }

    /**
     * Display a listing of the resource.
     */
    public function books()
    {
        //
    }
}
