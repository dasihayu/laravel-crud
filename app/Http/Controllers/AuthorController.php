<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use App\Models\AuthorProfile;
use App\Models\Hobby;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = request()->query('page', 1);
        $authors = Author::simplePaginate(10);
        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        $hobbies = Hobby::all();
        return view('authors.create', compact('hobbies', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorRequest $request)
    {
        $validated = $request->validated();

        // Buat author baru
        $author = Author::create($request->only(['name', 'email']));
    
        // Buat profile author baru
        $profileData = $request->only(['bio', 'office', 'age']);
        $profileData['author_id'] = $author->id;
        AuthorProfile::create($profileData);
    
        // Tambahkan hobi ke author
        if ($request->has('hobbies')) {
            $author->hobbies()->attach($request->input('hobbies'));
        }
    
        // Simpan author (sebenarnya tidak perlu jika sudah menggunakan create)
        $author->save();
    
        return redirect()->route('authors.index');
    
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $author = Author::findOrFail($id);

        // Mengambil profile author
        $profile = $author->profile;

        return view('authors.profile', compact('author', 'profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $author = Author::with('profile','hobbies')->findOrFail($id);
        $hobbies = Hobby::all(); 
        return view('authors.edit', compact('author', 'hobbies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, $id)
    {
        $author = Author::findOrFail($id);
        $author->name = $request->input('name');
        $author->email = $request->input('email');
        $profileData = [
            'office' => $request->input('office'),
            'age' => $request->input('age'),
            'bio' => $request->input('bio'),
        ];
    
        $author->profile()->updateOrCreate(
            ['author_id' => $author->id],
            $profileData
        );
    
        // Update hobbies
        $author->hobbies()->sync($request->input('hobbies', []));

    
        return redirect()->route('authors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return response()->json(['success' => true]);

    }

    public function showProfile($id)
{
    $author = Author::findOrFail($id);
    return view('authors.profile', compact('author'));
}
}
