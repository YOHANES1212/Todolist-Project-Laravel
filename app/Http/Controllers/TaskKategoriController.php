<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskStatus;
use App\Models\TaskPriority;

class TaskKategoriController extends Controller
{
    public function index()
    {
        $statuses  = TaskStatus::all();
        $priorities = TaskPriority::all();

        return view('task_kategori', compact('statuses', 'priorities'));
    }

    public function storeStatus(Request $request)
    {
        $request->validate(['status_name' => 'required|string|max:255']);
        TaskStatus::create(['status_name' => $request->status_name]);
        return redirect()->route('task_kategori.index')->with('success', 'Task Status berhasil ditambahkan.');
    }

    public function storePriority(Request $request)
    {
        $request->validate(['priority_name' => 'required|string|max:255']);
        TaskPriority::create(['priority_name' => $request->priority_name]);
        return redirect()->route('task_kategori.index')->with('success', 'Task Priority berhasil ditambahkan.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['edit_value' => 'required|string|max:255']);
        TaskStatus::findOrFail($id)->update(['status_name' => $request->edit_value]);
        return redirect()->route('task_kategori.index')->with('success', 'Task Status berhasil diperbarui.');
    }

    public function updatePriority(Request $request, $id)
    {
        $request->validate(['edit_value' => 'required|string|max:255']);
        TaskPriority::findOrFail($id)->update(['priority_name' => $request->edit_value]);
        return redirect()->route('task_kategori.index')->with('success', 'Task Priority berhasil diperbarui.');
    }

    public function destroyStatus($id)
    {
        TaskStatus::findOrFail($id)->delete();
        return redirect()->route('task_kategori.index')->with('success', 'Task Status dihapus.');
    }

    public function destroyPriority($id)
    {
        TaskPriority::findOrFail($id)->delete();
        return redirect()->route('task_kategori.index')->with('success', 'Task Priority dihapus.');
    }
}
