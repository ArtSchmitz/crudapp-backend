<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $book = Book::all();
        return response()->json([
            'success' => true,
            'books' => $book
        ], 200);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'image' => 'required'
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
    
    public function update(Request $request, string $id)
    {
        if(Book::where('id', $id)->exists()) {
            $book = Book::find($id);
            $book->title = $request->title;
            $book->author = $request->author;
            $book->publisher = $request->publisher;
            $book->image = $request->image;
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
