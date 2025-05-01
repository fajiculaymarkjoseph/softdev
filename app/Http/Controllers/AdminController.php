<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;  // ✅ Add this at the top of the file


class AdminController extends Controller
{

    

    public function index()
    {
        return Admin::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email',
        ]);

        $admin = Admin::create($validated);
        return response()->json($admin, 201);
    }

    public function show($id)
    {
        return Admin::findOrFail($id);
    }



    public function update(Request $request, $id)
    {
        try {
            Log::info("Updating Admin with AdminID: $id");
    
            // ✅ Use the correct primary key
            $admin = Admin::where('AdminID', $id)->first();
    
            if (!$admin) {
                return response()->json(['message' => 'Admin not found'], 404);
            }
    
            // ✅ Fix the validation rule: specify AdminID explicitly
            $validated = $request->validate([
                'name' => 'sometimes|string',
                'email' => "sometimes|email|unique:admins,email,{$id},AdminID"  // ✅ Reference `AdminID`
            ]);
    
            $admin->update($validated);
    
            Log::info("Admin updated successfully: ", $admin->toArray());
    
            return response()->json([
                'message' => 'Admin updated successfully!',
                'data' => $admin
            ]);
            
        } catch (\Exception $e) {
            Log::error("Error updating admin: " . $e->getMessage());
            return response()->json(['error' => 'Server Error: ' . $e->getMessage()], 500);
        }
    }
    

    public function destroy($id)
    {
        Admin::findOrFail($id)->delete();
        return response()->json(['message' => 'Admin deleted']);
    }
}
