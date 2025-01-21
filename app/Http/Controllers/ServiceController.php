<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    // Fetch all services
    public function index()
    {
        $services = Service::all();
        return view('backviews.pages.service', compact('services'));
    }

    // Create a new service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_code' => 'required|string|unique:services,service_code|max:50',
            'service_name' => 'required|string|max:255',
            'service_price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
        ]);

        $service = Service::create($validated);

        return response()->json(['message' => 'Service created successfully.', 'service' => $service], 201);
    }

    // Show a specific service
    public function edit($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Service not found.'], 404);
        }

        return view('backviews.pages.service.update', compact('service'));
    }

    // Update an existing service
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

        return response()->json(['message' => 'Service updated successfully.', 'service' => $service]);
    }

    // Delete a service
    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Service not found.'], 404);
        }

        $service->delete();

        return response()->json(['message' => 'Service deleted successfully.']);
    }
}
