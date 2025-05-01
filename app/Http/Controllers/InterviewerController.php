<?php

namespace App\Http\Controllers;

use App\Models\Interviewer;
use Illuminate\Http\Request;

class InterviewerController extends Controller
{
    public function index()
    {
        return Interviewer::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'DepartmentID' => 'required|integer',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:interviewers,email',
        ]);

        $interviewer = Interviewer::create($validated);
        return response()->json($interviewer, 201);
    }

    public function show($id)
    {
        return Interviewer::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $interviewer = Interviewer::findOrFail($id);

        $validated = $request->validate([
            'DepartmentID' => 'sometimes|integer',
            'first_name' => 'sometimes|string',
            'last_name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:interviewers,email,' . $id,
        ]);

        $interviewer->update($validated);
        return response()->json($interviewer);
    }

    public function destroy($id)
    {
        Interviewer::findOrFail($id)->delete();
        return response()->json(['message' => 'Interviewer deleted']);
    }
}
