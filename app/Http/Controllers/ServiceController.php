<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();
        $searchTerm = $request->search ?? null;

        if (!empty($searchTerm)) {
            $query->where('service_name', 'like', '%'. $searchTerm .'%');
        }

        $services = $query->paginate(10);
        return view('backviews.pages.service.index', compact('services', 'searchTerm'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_code' => 'required|string|unique:services,service_code|max:50',
            'service_name' => 'required|string|max:255',
            'service_price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
        ]);

        $service = Service::create($validated);

        return redirect()->route('admin.service.index')->with('success', 'Service berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Service not found.'], 404);
        }

        return view('backviews.pages.service.update', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Service not found.'], 404);
        }

        $validated = $request->validate([
            'service_code' => 'sometimes|required|string|unique:services,service_code,' . $id . '|max:50',
            'service_name' => 'sometimes|required|string|max:255',
            'service_price' => 'sometimes|required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
        ]);

        $service->update($validated);

        return redirect()->route('admin.service.index')->with('success', 'Service berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Service not found.'], 404);
        }

        $service->delete();

        return redirect()->route('admin.service.index')->with('success', 'Service berhasil dihapus.');
    }
}
