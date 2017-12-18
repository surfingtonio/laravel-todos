@extends('layout')

@section('content')
    @if(Session::has('success'))
    <div class="row mb-2">
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
    <div class="row mb-2">
        <div class="col">
            <form action="/todos">
                <input type="text" class="form-control form-control-lg" placeholder="Enter todo item">
            </form>
        </div>
    </div>
    <div class="row">
        @if($todos->count() < 1)
            <div class="col">
                <p class="text-center text-muted">There are no todo items</p>
            </div>
        @else
            <div class="col">
                @foreach($todos as $todo)
                    <div class="todo card mb-2 {{ $todo->completed ? 'completed' : '' }}">
                        <div class="card-body pl-5 pr-5">
                            <input type="checkbox" class="form-check form-check-inline" {{ $todo->completed ? 'checked' : '' }} value="{{ $todo->id }}">
                            <span>{{ $todo->todo }}</span>
                            <button type="button" class="close" data-todo="{{ $todo->id }}" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@stop