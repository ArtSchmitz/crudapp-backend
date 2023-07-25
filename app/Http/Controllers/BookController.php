<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error', $validator->errors());
        }
        $book = Book::create($input);
        return response()->json([
            'success'=> true,
            'message'=>'Livro criado com sucesso.',
            'book' => $book
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(Book::where('id', $id)->exists()) {
            $book = Book::find($id);
            $book->title = $request->title;
            $book->author = $request->author;
            $book->publisher = $request->publisher;
            $book->save();
            return response()->json([
                'message' => 'Livro atualizado com sucesso!'
            ], 200);
        }
        else{
            return response()->json([
                'message' => 'Livro não encontrado!'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Book::where('id', $id)->exists()) {
            $book = Book::find($id);
            $book->delete();
            return response()->json([
                'message' => "O livro foi deletado!"
            ], 200);
        }
        else {
            return response()->json([
                'message' => 'Livro não encontrado!'
            ], 404);
        }
    }
}
