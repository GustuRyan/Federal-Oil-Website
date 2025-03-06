<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
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
            'current_queue' => 'required|integer',
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
        $queue = Queue::findOrFail($id);

        $queue->delete();

        return response()->json([
            'message' => 'Queue deleted successfully',
        ], 200);
    }

    public function generatePDF()
    {
        $today = now()->toDateString();
        $queue = Queue::whereDate('created_at', $today)->first();

        $data = ['current_queue' => $queue ? $queue->current_queue : 1];

        $pdf = PDF::loadView('queue-ticket', compact('data'))
            ->setOption('page-width', '120mm')
            ->setOption('page-height', '120mm')
            ->setOption('orientation', 'portrait');

        return $pdf->download('ticket.pdf');
    }

}
