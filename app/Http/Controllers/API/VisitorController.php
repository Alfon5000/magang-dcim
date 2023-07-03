<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitors = Visitor::with('visitor_category')->latest()->paginate(5);
        $all = Visitor::all();

        return response()->json([
            'success' => 'true',
            'data' => $visitors,
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
            'visitor_category_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'application_letter' => 'required|file|max:2048',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ]);
        }

        $letter = $request->file('letter');
        $letter->storeAs('public/documents/application-letters', $letter->hashName());

        $validated = $validator->validated();
        $validated['application_letter'] = $letter->hashName();
        Visitor::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Visitor has been created.',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $visitor = Visitor::with('visitor_category')->find($id);

        if (!$visitor) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $visitor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $visitor = Visitor::with('visitor_category')->find($id);

        if (!$visitor) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor not found.',
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'visitor_category_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'application_letter' => 'file|max:2048',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ]);
        }

        $validated = $validator->validated();

        if ($request->hasFile('letter')) {
            $letter = $request->file('letter');
            $letter->storeAs('public/documents/application-letters', $letter->hashName());
            Storage::delete('public/documents/application-letters/' . basename($visitor->application_letter));
            $validated['application_letter'] = $letter->hashName();
            $visitor->update($validated);
        } else {
            $visitor->update($validated);
        }

        return response()->json([
            'success' => true,
            'message' => 'Visitor has been updated.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $visitor = Visitor::find($id);

        if (!$visitor) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor not found.'
            ], 404);
        }

        Storage::delete('public/application-letters/' . basename($visitor->application_letter));
        $visitor->delete();
        return response()->json([
            'success' => true,
            'message' => 'Visitor has been deleted.'
        ]);
    }
}
