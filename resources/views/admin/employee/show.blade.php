@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Detail employee</span>
          <div>
            <a class="btn btn-sm btn-secondary" href="{{ route('admin.employee.index') }}" role="button">Back</a>
            <a class="btn btn-sm btn-success mb-1 mb-md-0" href="{{ route('admin.employee.edit', ['employee' => $employee->id]) }}" role="button">Edit</a>
            <button type="button" class="btn btn-sm btn-danger" onclick="event.preventDefault();document.getElementById('delete-employee-{{ $employee->id }}').submit();">Delete</button>

            <form id="delete-employee-{{ $employee->id }}" action="{{ route('admin.employee.destroy', ['employee' => $employee->id]) }}" method="POST" class="d-none">
              @csrf
              @method('delete')
            </form>
          </div>
        </div>

        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input type="text" class="form-control disabled" id="exampleInputName" aria-describedby="nameHelp" name="name" value="{{ $employee->name }}" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail">Email address</label>
            <input type="email" class="form-control disabled" id="exampleInputEmail" aria-describedby="emailHelp" name="email" value="{{ $employee->email }}" disabled>
            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
          </div>
          <div class="form-group">
            <label for="exampleInputCompany">Company</label>
            <input type="text" class="form-control disabled" id="exampleInputCompany" aria-describedby="companyHelp" name="company" value="{{ $employee->company->name }}" disabled>
            <!-- <small id="companyHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection