<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodo;
use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $todos = Todo::all();
        return view('todo.index',compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTodo  $request
     * @return Response
     */
    public function store(StoreTodo $request)
    {
        $todo = Todo::create($request->all());
        return response()->json([
            'type' => 'success',
            'message' => __('Task Added')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Todo $todo
     * @return View
     */
    public function show(Todo $todo)
    {
        return view('todo.show',compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Todo $todo
     * @param Request $request
     * @return View
     */
    public function edit(Todo $todo, Request $request)
    {
        return view('todo.edit',compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Todo  $todo
     * @return Response
     */
    public function update(Request $request, Todo $todo)
    {
        $todo = $todo->update($request->all());
        return response()->json([
            'type' => 'success',
            'message' => __('todo updated successfully')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Todo $todo
     * @throws Exception
     * @return Redirect
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect(route('todo.index'))->with('message','todo deleted successfully');
    }
}
