<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Todo;
use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Http\Resources\TodosResource;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $todos = Todo::all();

	    TodosResource::withoutWrapping();
	    return new TodosResource($todos);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $todo = new Todo;
	    $todo->todo = $request->todo;
	    $todo->completed = 0;
	    $todo->save();

      TodoResource::withoutWrapping();
      return new TodoResource($todo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$todo = Todo::findOrFail($id);

	    TodoResource::withoutWrapping();
	    return new TodoResource($todo);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function update(Request $request, $id)
    {
	    $todo = Todo::firstOrNew([ 'id' => $id ]);
	    $todo->todo = $request->todo;
	    $todo->completed = $request->completed;
	    $todo->save();

      TodoResource::withoutWrapping();
      return new TodoResource($todo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    $todo = Todo::findOrFail($id);
	    $todo->delete();

	    return 204;
    }
}
