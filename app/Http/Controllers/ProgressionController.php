<?php

namespace App\Http\Controllers;

use App\Models\Progression;
use Illuminate\Http\Request;

class ProgressionController extends Controller
{
    public function index()
    {
        return response()->json(Progression::with(['user','cours'])->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'cours_id' => 'required|exists:cours,id',
            'points' => 'integer',
            'quizzes_termine' => 'integer'
        ]);

        $progression = Progression::create($request->all());

        return response()->json($progression, 201);
    }

    public function update(Request $request, $id)
    {
        $progression = Progression::findOrFail($id);
        $progression->update($request->all());

        return response()->json($progression, 200);
    }

    public function destroy($id)
    {
        $progression = Progression::findOrFail($id);
        $progression->delete();

        return response()->json(null, 204);
    }
}
