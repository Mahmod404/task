@extends('layout')

@section('content')
    <div class="container">
        <div class="text-center mb-4">
            <h1>Employee Tasks</h1>
        </div>
        <div class="text-end">

            @if (auth()->user() && auth()->user()->role == 'manager')
                <a href="{{ route('tasks.create') }}" class="btn btn-outline-primary mb-3">
                    <i class="fa-solid fa-plus me-2"></i>Create New Task</a>
            @endif
        </div>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Task Title</th>
                    @if (auth()->user() && auth()->user()->role == 'manager')
                        <th>Employee</th>
                    @endif
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        @if (auth()->user() && auth()->user()->role == 'manager')
                            <td>{{ $task->employee->name }}</td>
                        @endif

                        <td>{{ ucfirst($task->status) }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>
                            @if (auth()->user() && auth()->user()->role == 'manager')
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-outline-primary"><i
                                        class="fa-solid fa-check"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
