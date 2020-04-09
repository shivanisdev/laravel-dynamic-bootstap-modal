@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @include('layouts.flash')
                <div class="card-header">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#defaultModal" data-title="{{ __('Add New Workspace') }}" data-view="todo/create">Create</button>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S No</th>
                                <th>title</th>
                    
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todos as $todo)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $todo->title }}</td>
                    
                                <td>
                                    <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#defaultModal" data-title="{{ __('Edit Task ').$todo->id }}" data-view="{{ route('todo.edit',$todo->id) }}">Edit</a>

                                    <a class="btn btn-danger btn-sm float-right" onClick="
                                    event.preventDefault();
                                    if(confirm('Do you really want to delete>')){
                                        document.getElementById('form-{{ $todo->id }}').submit()
                                    }">Delete</a>

                                    <form action="{{ route('todo.destroy',$todo->id) }}" method="post"
                                        id="form-{{ $todo->id }}">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
