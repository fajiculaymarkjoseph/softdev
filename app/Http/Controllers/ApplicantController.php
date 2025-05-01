<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function index()
    {
        return Applicant::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:applicants,email',
            'department' => 'required|string',
        ]);

        $applicant = Applicant::create($validated);
        return response()->json($applicant, 201);
    }

    public function show($id)
    {
        return Applicant::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $applicant = Applicant::findOrFail($id);

        $validated = $request->validate([
            'first_name' => 'sometimes|string',
            'last_name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:applicants,email,' . $id,
            'department' => 'sometimes|string',
        ]);

        $applicant->update($validated);
        return response()->json($applicant);
    }

    public function destroy($id)
    {
        Applicant::findOrFail($id)->delete();
        return response()->json(['message' => 'Applicant deleted']);
    }
}
