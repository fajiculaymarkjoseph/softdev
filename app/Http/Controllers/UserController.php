<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log; // <-- Add this line

class UserController extends Controller
{
    public function index()
{
    return response()->json(User::all(), 200);
}

    public function store(Request $request)
{
    try {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($user, 201);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}




    // Show a single user
    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    // Update a user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'sometimes|required|min:6',
        ]);

        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return response()->json($user);
    }

    // Delete a user
    public function destroy($id)
    {
        User::destroy($id);

        return response()->json(['message' => 'User deleted successfully']);
    }
}

