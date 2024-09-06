@extends('layout')

@section('content')
    <div class="container">
        <h1>Create Task</h1>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Task Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Task Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="employee_id">Assign to Employee</label>
                <select name="employee_id" class="form-control" required>
                    <option value="">Select Employee</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" name="due_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Create Task</button>
        </form>
    </div>
@endsection
