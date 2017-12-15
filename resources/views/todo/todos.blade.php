@extends('layout')

@section('content')
    @if(Session::has('success'))
    <div class="row">
        <div class="col">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col">
            <form action="/todos/create" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" name="todo" class="form-control form-control-lg" placeholder="Type a new todo and hit 'Enter'">
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <ul class="list-group">
                @foreach($todos as $todo)
                    <li class="list-group-item">
                        @if($todo->completed)
                            <button href="{{ route('todos.restore', [ 'id' => $todo->id ]) }}" class="btn btn-info">
                                <i class="fa fa-undo"></i>
                            </button>
                        @else
                            <button href="{{ route('todos.complete', [ 'id' => $todo->id ]) }}" class="btn btn-success">
                                <i class="fa fa-check"></i>
                            </button>
                        @endif
                        <button href="{{ route('todos.delete', [ 'id' => $todo->id ]) }}" class="btn btn-danger ml-1">
                            <i class="fa fa-close"></i>
                        </button>
                        <span class="pl-4 {{ $todo->completed ? 'completed' : ''}}">{{ $todo->todo }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@stop