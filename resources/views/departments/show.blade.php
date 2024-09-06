@extends('layout')

@section('content')
    <div class="container mt-5">

        <!-- Department Information Card -->
        <div class="card mb-4 shadow-lg">
            <div class="card-header bg-success">
                <h3>Department Information</h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $department->name }}</h5>
                <p class="card-text">{{ $department->description }}</p>
            </div>
        </div>

        <!-- Employees Information Card -->
        <div class="card shadow-lg">
            <div class="card-header bg-success">
                <h3>Employees in "<span class="text-uppercase font-italic">{{ $department->name }}</span>" department</h3>
            </div>
            <div class="card-body">
                @if ($department->users->isEmpty())
                    <p>No employees in this department.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($department->users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->salary ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

    </div>
@endsection
