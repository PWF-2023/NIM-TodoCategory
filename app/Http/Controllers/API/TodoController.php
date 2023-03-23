<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        if ($search) {
            $todos = Todo::with('category')
                ->where('user_id', auth()->user()->id)
                ->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');
                })
                ->latest()
                ->get();
            return response()->json([
                'status' => 'success',
                'data' => [
                    'todos' => $todos,
                ]
            ], 200);
        }
        $todos = Todo::with('category')
            ->where('user_id', auth()->user()->id)
            ->latest()
            ->get();
        return response()->json([
            'status' => 'success',
            'data' => [
                'todos' => $todos,
            ]
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        $todo = Todo::with('category')
            ->where('id', $todo->id)
            ->first();
        if ($todo->user_id != auth()->user()->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Forbidden'
            ], 403);
        }
        return response()->json([
            'status' => 'success',
            'data' => [
                'todo' => $todo,
            ]
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
