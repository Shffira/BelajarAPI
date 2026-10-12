<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $books = Books::all();
        return response()->json([
            'message' => 'Data Buku',
            'data' => $books
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'published_year' => 'required|integer',
        ]);

        $books = Books::create($request->all());

            return response()->json([
                'message' => 'Data Buku berhasil disimpan',
                'data' => $books,
            ], 201);    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $books = Books::find($id);

        if (!$books) {
            return response()->json([
                'message' => 'Buku not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Data Buku',
            'data' => $books
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $books = Books::find($id);

        if (!$books) {
            return response()->json([
                'message' => 'Buku not found'
            ], 404);
        }


        $request->validate([
            'author' => 'sometimes|required|string',
            'kode_buku' => 'sometimes|required|string|unique:books,kode_buku,' . $id,
            'judul_buku' => 'sometimes|required|string',
        ]);

        $books->update($request->all());

        return response()->json([
            'message' => 'Data Buku berhasil diperbarui',
            'data' => $books
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $books = Books::find($id);

        if (!$books) {
            return response()->json([
                'message' => 'Buku not found'
            ], 404);
        }

        $books->delete();

        return response()->json([
            'message' => 'Data Buku berhasil dihapus'
        ], 200);
    }
}
