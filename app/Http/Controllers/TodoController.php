<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('todo.todos')->with('todos', Todo::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	  // save
	      $todo = new Todo;
	      $todo->todo = $request->todo;
	      $todo->save();

	    Session::flash('success', 'The todo item was added.');
        return redirect()->route('todos');
    }


    /**
     * Mark the specified resource as completed.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function complete($id)
    {
        $todo = Todo::find($id);
        $todo->completed = 1;
        $todo->save();

        Session::flash('success', 'The todo item marked as completed.');
        return redirect()->back();
    }


		/**
		 * Unmark the specified resource as completed.
		 *
		 * @param  \App\Todo  $todo
		 * @return \Illuminate\Http\Response
		 */
		public function restore($id)
		{
			$todo = Todo::find($id);
			$todo->completed = 0;
			$todo->save();

			Session::flash('success', 'The todo item was restored.');
			return redirect()->back();
		}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();

        Session::flash('success', 'The todo item was deleted');
        return redirect()->back();
    }
}
