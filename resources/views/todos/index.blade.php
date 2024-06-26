@extends('layouts.app')

@section('styles')
    <style>
        #outer {
            width: auto;
            text-align: center;
        }

        .inner {
            display: inline-block;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">

                        @if (Session::has('alert-success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('alert-success') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('alert-error') }}
                            </div>
                        @endif

                        <div class="mb-3">
                            <a href="{{ route('todos.create') }}" class="btn btn-primary">Create New Todo</a>
                        </div>

                        @if (count($todos) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Completed</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($todos as $todo)
                                        <tr>
                                            <td>{{ $todo->title }}</td>
                                            <td>{{ $todo->description }}</td>
                                            <td>
                                                @if ($todo->completed == 1)
                                                    <a class="btn btn-sm btn-success" href="">Completed</a>
                                                @else
                                                    <a class="btn btn-sm btn-danger" href="">Incomplete</a>
                                                @endif
                                            </td>
                                            <td id='outer'>
                                                <a class="inner btn btn-sm btn-info"
                                                    href=" {{ route('todos.edit', $todo->id) }} ">Edit</a>
                                                <a class="inner btn btn-sm btn-success"
                                                    href=" {{ route('todos.show', $todo->id) }} ">View</a>

                                                <form action="{{ route('todos.destroy', $todo->id) }}" method="POST"
                                                    class="inner">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h4>No Todos are created yet</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
