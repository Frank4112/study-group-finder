<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index(Request $request)
{
    $query = Skill::query();

    // Server-side search
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('name', 'like', "%$search%")
              ->orWhere('description', 'like', "%$search%");
    }

    // Paginate 10 per page
    $skills = $query->orderBy('id', 'desc')->paginate(10);

    return view('skills.index', compact('skills'));
}

     public function create()
{
    return view('skills.create');
}

    public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string',
        'description' => 'nullable|string',
    ]);

    try {
        Skill::create($data);
        return redirect()->route('skills.index')
                         ->with('success', 'Skill added successfully!');
    } catch (\Illuminate\Database\QueryException $e) {
        // Check if it's a duplicate entry error
        if ($e->getCode() == 23000) { 
            return redirect()->back()->with('error', 'Skill already exists!');
        }
        // For other DB errors, just rethrow
        throw $e;
    }
}

        public function edit(Skill $skill)
{
    return view('skills.edit', compact('skill'));
}



    public function update(Request $request, Skill $skill)
{
    $data = $request->validate([
        'name' => 'required|string',
        'description' => 'nullable|string',
    ]);

    try {
        $skill->update($data);
        return redirect()->route('skills.index')
                         ->with('success', 'Skill updated successfully!');
    } catch (\Illuminate\Database\QueryException $e) {
        // Check for duplicate entry error
        if ($e->getCode() == 23000) {
            return redirect()->back()->with('error', 'Skill name already exists!');
        }
        // For other DB errors, just rethrow
        throw $e;
    }
}

    public function destroy(Skill $skill)
{
    $skill->delete();
    return redirect()->route('skills.index')
                     ->with('success', 'Skill deleted successfully!');
}

}