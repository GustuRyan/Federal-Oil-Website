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
        $validated = $request->validate([
            'queue_list' => 'nullable|array',
            'last_queue' => 'nullable|integer',
        ]);

        if (empty($validated['queue_list'])) {
            $validated['queue_list'] = [1];
        }

        $validated['current_queue'] = 1;

        $queue = Queue::create($validated);

        return response()->json([
            'message' => 'Queue created successfully',
            'data' => $queue,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'queue_list' => 'nullable|array',
            'last_queue' => 'nullable|integer',
        ]);

        // Jika ID diberikan, lakukan update
        $queue = Queue::findOrFail($id);

        if (empty($validated['queue_list'])) {
            $validated['queue_list'] = [$queue->queue_list ? max($queue->queue_list) + 1 : 1];
        }

        $queue->update($validated);
        $message = 'Queue updated successfully';

        return response()->json([
            'message' => $message,
            'data' => $queue,
        ], 200);
    }

    public function updateCurrent(Request $request, $id)
    {
        $validated = $request->validate([
            'current_queue' => 'required|integer', // Sesuaikan dengan frontend
            'queue_list' => 'nullable|array',
        ]);

        $queue = Queue::findOrFail($id);

        if (empty($validated['queue_list'])) {
            $validated['queue_list'] = [$queue->queue_list ? max($queue->queue_list) + 1 : 1];
        }

        $queue->update($validated);

        return response()->json([
            'message' => 'Queue updated successfully',
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
