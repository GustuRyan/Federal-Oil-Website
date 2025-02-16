<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserQueue;

class UserQueueController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'queue' => 'required|integer',
            'customer_id' => 'required|exists:customers,id',
            'issue' => 'nullable|string',
        ]);

        $userQueue = UserQueue::create($validated);

        return redirect()->back()->with('success', 'Antrean berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'queue' => 'required|integer',
            'customer_id' => 'required|exists:customers,id',
            'issue' => 'nullable|string',
        ]);

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
