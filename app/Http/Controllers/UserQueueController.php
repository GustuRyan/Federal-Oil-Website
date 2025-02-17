<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserQueue;
use App\Models\Queue;

class UserQueueController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'issue' => 'nullable|string',
        ]);

        $today = now()->toDateString();
        $queue = Queue::whereDate('created_at', $today)->first();

        if (!$queue) {
            $updateQueue = [
                'current_queue' => 1,
                'queue_list' => [1, 2],
                'last_queue' => 2,
            ];

            $queue = Queue::create($updateQueue);
        }
        
        $validated['queue'] = $queue ? $queue->current_queue : 1;

        $available = $queue ? UserQueue::where('queue', $queue->current_queue)->first() : null;

        if ($available) {
            $available->update($validated);
        } else {
            $userQueue = UserQueue::create($validated);
        }

        return redirect()->back()->with('success', 'Antrean berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'issue' => 'nullable|string',
        ]);

        $today = now()->toDateString();
        $queue = Queue::whereDate('created_at', $today)->first();
        
        $validated['queue'] = $queue ? $queue->current_queue : 1;

        $userQueue = UserQueue::findOrFail($id);
        $userQueue->update($validated);

        return redirect()->back()->with('success', 'Antrean berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $userQueue = UserQueue::findOrFail($id);
        $userQueue->delete();

        return redirect()->back()->with('success', 'Antrean berhasil dihapus.');
    } //
}
