<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->query('perPage', 5);
        $books = Book::with('category')->paginate($perPage);
        return response()->json($books, 200);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $rules = [
            "name" => "required|max:191",
            "cover" =>  ['nullable', 'regex:/^data:image\/(\w+);base64,/'],
            "author" => "required|max:191",
            "publication" => "required|date",
            "status" => "required|boolean",
            "borrow_user" => "max:191",
            "categories_id"=>['required', 'numeric', 'exists:categories,id']         
        ];

        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $book = Book::create($data);

        return response()->json($book, 201);        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {       
        $book = Book::with('category')->find($id);
        if(is_null($book)) {
            return response()->json("Record not found!", 404);
        }
        return response()->json($book, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $book = Book::find($id);

        if(is_null($book)) {
            return response()->json("Record not found!", 404);
        }

        $data = $request->all();

        $rules = [
            "name" => "max:191",
            "cover" =>  ['nullable', 'regex:/^data:image\/(\w+);base64,/'],
            "author" => "max:191",
            "publication" => "date",
            "status" => "boolean",
            "borrow_user" => "max:191",
            "categories_id"=>['numeric', 'exists:categories,id']         
        ];

        $validator = Validator::make($data, $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $book->update($data);

        return response()->json($book, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $book = Book::find($id);
        if(is_null($book)) {
            return response()->json("Record not found!", 404);
        }
        $book->delete();
        return response()->json(null, 202);
    }
}
