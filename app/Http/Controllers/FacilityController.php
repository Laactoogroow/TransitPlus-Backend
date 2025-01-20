<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::all();
        return response()->json($facilities);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $facility = Facility::create($request->all());

        return response()->json($facility, 201);
    }

    public function show($id)
    {
        $facility = Facility::find($id);

        if (!$facility) {
            return response()->json(['message' => 'Facility not found'], 404);
        }

        return response()->json($facility);
    }

    public function update(Request $request, $id)
    {
        $facility = Facility::find($id);

        if (!$facility) {
            return response()->json(['message' => 'Facility not found'], 404);
        }

        $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string',
        ]);

        $facility->update($request->all());

        return response()->json($facility);
    }

    public function destroy($id)
    {
        $facility = Facility::find($id);

        if (!$facility) {
            return response()->json(['message' => 'Facility not found'], 404);
        }

        $facility->delete();

        return response()->json(['message' => 'Facility deleted']);
    }
}
