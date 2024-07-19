<?php

namespace App\Http\Controllers;

use App\Http\Requests\HobbyRequest;
use App\Models\Hobby;
use Illuminate\Http\Request;

class HobbyController extends Controller
{
    public function index()
    {
        // $hobbies = Hobby::simplePaginate(10);
        $hobbies = Hobby::withCount('authors')->get();
        return view('hobbies.index', compact('hobbies'));
    }

    public function create()
    {
        return view('hobbies.create');
    }

    public function store(HobbyRequest $request)
    {
        Hobby::create([
            'name' => $request->name,
        ]);

        return redirect()->route('hobbies.index');
    }

    public function destroy($id)
    {
        $hobby = Hobby::findOrFail($id);
        $hobby->delete();
        return response()->json(['success' => true]);
    }
}
