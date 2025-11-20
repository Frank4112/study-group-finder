<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        return Skill::all();
    }

    public function store(Request $request)
    {
        return Skill::create(
            $request->validate(['name' => 'required|string'])
        );
    }

    public function update(Request $request, Skill $skill)
    {
        $skill->update(
            $request->validate(['name' => 'required|string'])
        );

        return $skill;
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
