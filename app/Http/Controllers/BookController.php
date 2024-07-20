<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($query) use ($searchTerm) {
                $query->where('title', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('serial_number', 'LIKE', "%{$searchTerm}%")
                        ->orWhereHas('author', function ($query) use ($searchTerm) {
                            $query->where('name', 'LIKE', "%{$searchTerm}%");
                    });
            });
        }

        $books = $query->simplePaginate(10);
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        return view('books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        $validatedData = $request->validated();
    
        // dd($validatedData);
        try {
            $publishedAt = Carbon::createFromFormat('Y-m-d', $validatedData['published_at']);
            $formattedDate = $publishedAt->format('Y-m-d');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['published_at' => 'Invalid date format']);
        }

        

        $book = new Book();
        $book->title = $validatedData['title'];
        $book->serial_number = $validatedData['serial_number'];
        $book->author_id = $validatedData['author_id'];
        $book->published_at = $formattedDate; // Gunakan data yang tervalidasi
        $book->save();
        
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('books.edit', compact('authors', 'book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->all());
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(['success' => true]);
    }
}
