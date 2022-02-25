@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Employee</span>
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.employee.create') }}" role="button">Create</a>
                </div>

                <div class="card-body">
                    @if($employees->count() > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-1">ID</th>
                                <th class="col-5">Name</th>
                                <th class="col-3">Company</th>
                                <th class="col-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <th scope="row">{{ $employee->id }}</th>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->company->name }}</td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary mb-1 mb-md-0" href="{{ route('admin.employee.show', ['employee' => $employee->id]) }}" role="button">Detail</a>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="event.preventDefault();document.getElementById('delete-employee-{{ $employee->id }}').submit();">Delete</button>

                                    <form id="delete-employee-{{ $employee->id }}" action="{{ route('admin.employee.destroy', ['employee' => $employee->id]) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end">
                        {{ $employees->links() }}
                    </div>
                    @else
                    <span class="d-block text-center text-muted">Employee is empty</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection