<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request('search')) {
            $users = User::with('role')
                ->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('email', 'like', '%' . request('search') . '%')
                ->latest()->paginate(5);
        } else {
            $users = User::with('role')->latest()->paginate(5);
        }

        $all = User::all();

        return response()->json([
            'success' => true,
            'data' => $users,
            'all' => $all,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'role_id' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'image' => 'required|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ]);
        }

        $image = $request->file('image');
        $image->storeAs('public/images/users', $image->hashName());

        $validated = $validator->validated();
        $validated['password'] = Hash::make($validated['password']);
        $validated['image'] = $image->hashName();
        User::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'User has been created.',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('role')->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::with('role')->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'role_id' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'image' => 'image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ]);
        }

        $validated = $validator->validated();
        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/images/users', $image->hashName());
            Storage::delete('public/images/users/' . basename($user->image));
            $validated['image'] = $image->hashName();
            $user->update($validated);
        } else {
            $user->update($validated);
        }

        return response()->json([
            'success' => true,
            'message' => 'User has been updated.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        }

        Storage::delete('public/images/users/' . basename($user->image));
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'User has been deleted.'
        ]);
    }
}
