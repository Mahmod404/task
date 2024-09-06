@extends('layout')

@section('content')
    <div class="container">
        <div class="text-center mb-4">
            <h1>Departments</h1>
        </div>
        <div class="text-end">

            @if (auth()->user() && auth()->user()->role == 'manager')
                <a href="{{ route('departments.create') }}" class="btn btn-outline-primary mb-3">
                    <i class="fa-solid fa-plus"></i> Add Department </a>
            @endif
        </div>
        <form action="{{ route('departments.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control"
                    placeholder="Search departments by name or description" value="{{ $query }}">
                <div class="input-group-append ms-5">
                    <button type="submit" class="btn btn-outline-info">Search</button>
                </div>
            </div>
        </form>

        <!-- Display Search Results -->
        @if ($departmentStats->isNotEmpty())
            <div class="card mb-4">
                <div class="card-header">
                    <h3>Department Search Results</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Department Name</th>
                                <th>Description</th>
                                <th>Employee Count</th>
                                <th>Total Salary</th>
                                @if (auth()->user() && auth()->user()->role == 'manager')
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departmentStats as $stat)
                                <tr>
                                    <td>{{ $stat['name'] }}</td>
                                    <td>{{ $stat['description'] ?? 'N/A' }}</td>
                                    <td>{{ $stat['employee_count'] }}</td>
                                    <td>{{ number_format($stat['total_salary'], 2) }}</td>
                                    @if (auth()->user() && auth()->user()->role == 'manager')
                                        <td>
                                            <a href="{{ route('departments.edit', $stat['id']) }}"
                                                class="btn btn-outline-warning"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{ route('departments.show', $stat['id']) }}"
                                                class="btn btn-outline-success"><i class="fa-solid fa-eye"></i></a>

                                            <form action="{{ route('departments.destroy', $stat['id']) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                @foreach ($departments as $department)
                                                    @if ($department->users->isEmpty())
                                                        {
                                                        <button type="submit" class="btn btn-outline-danger"><i
                                                                class="fa-solid fa-trash"></i></button>
                                                        }
                                                    @else
                                                        <button type="submit" class="btn btn-outline-danger disabled"><i
                                                                class="fa-solid fa-trash"></i></button>
                                                    @endif
                                                @endforeach

                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <p>No departments found.</p>
        @endif

    </div>

    {{-- <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                @if (auth()->user() && auth()->user()->role == 'manager')
                    <th>Actions</th>
                @endif

            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
                <tr>
                    <td class="text-uppercase font-weight-bolder"><a href="{{ route('departments.show', $department->id) }}"
                            class="text-dark text-decoration-none"> {{ $department->name }}</a></td>
                    <td>{{ $department->description }}</td>
                    @if (auth()->user() && auth()->user()->role == 'manager')
                        <td>
                            <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-outline-warning"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('departments.show', $department->id) }}" class="btn btn-outline-success"><i
                                    class="fa-solid fa-eye"></i></a>

                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                @if ($department->users->isEmpty())
                                    {
                                    <button type="submit" class="btn btn-outline-danger"><i
                                            class="fa-solid fa-trash"></i></button>
                                    }
                                @else
                                    <button type="submit" class="btn btn-outline-danger disabled"><i
                                            class="fa-solid
                                        fa-trash"></i></button>
                                @endif
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table> --}}
    </div>
@endsection
