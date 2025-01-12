<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queue;

class QueueController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();
        $queue = Queue::whereDate('created_at', $today)->first(); 

        if ($queue) {
            return response()->json($queue); 
        } else {
            return response()->json([
                'queue_list' => [], 
                'id' => null,
            ]);
        }
    }


    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'current_queue' => 'required|integer',
            'queue_list' => 'nullable|array',
        ]);

        // Simpan data ke database
        $queue = Queue::create($validated);

        return response()->json([
            'message' => 'Queue created successfully',
            'data' => $queue,
        ], 201);
    }

    public function createOrUpdate(Request $request, $id = null)
    {
        $validated = $request->validate([
            'queue_list' => 'nullable|array',
        ]);

        if ($id) {
            $queue = Queue::findOrFail($id);

            if (empty($validated['queue_list'])) {
                $validated['queue_list'] = [$queue->queue_list ? max($queue->queue_list) + 1 : 1];
            }

            $queue->update($validated);
            $message = 'Queue updated successfully';
        } else {
            if (empty($validated['queue_list'])) {
                $validated['queue_list'] = [1];
            }

            $queue = Queue::create($validated);
            $message = 'Queue created successfully';
        }

        return response()->json([
            'message' => $message,
            'data' => $queue,
        ], 200);
    }


    public function destroy($id)
    {
        // Cari Queue berdasarkan ID
        $queue = Queue::findOrFail($id);

        // Hapus data
        $queue->delete();

        return response()->json([
            'message' => 'Queue deleted successfully',
        ], 200);
    }
}
