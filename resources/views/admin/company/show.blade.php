@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Detail company</span>
          <div>
            <a class="btn btn-sm btn-secondary mb-1 mb-md-0" href="{{ route('admin.company.index') }}" role="button">Back</a>
            <a class="btn btn-sm btn-primary mb-1 mb-md-0" href="{{ route('admin.company.import_excel.create', ['company' => $company->id]) }}" role="button">Import excel</a>
            <a class="btn btn-sm btn-primary mb-1 mb-md-0" href="{{ route('admin.company.generate_pdf', ['company' => $company->id]) }}" role="button">Generate pdf</a>
            <a class="btn btn-sm btn-success mb-1 mb-md-0" href="{{ route('admin.company.edit', ['company' => $company->id]) }}" role="button">Edit</a>
            <button type="button" class="btn btn-sm btn-danger mb-1 mb-md-0" onclick="event.preventDefault();document.getElementById('delete-company-{{ $company->id }}').submit();">Delete</button>

            <form id="delete-company-{{ $company->id }}" action="{{ route('admin.company.destroy', ['company' => $company->id]) }}" method="POST" class="d-none">
              @csrf
              @method('delete')
            </form>
          </div>
        </div>

        <div class="card-body row">
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card">
              <div class="card-body">
                <span>Logo</span>
                <div class="pt-1" style="max-height: 17rem;">
                  <img class="img-fluid" src="{{ $company->logo->url }}" alt="{{ $company->logo->name }}">
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-8 pt-3 pt-md-0">
            <div class="form-group">
              <label for="exampleInputName">Name</label>
              <input type="text" class="form-control disabled" id="exampleInputName" aria-describedby="nameHelp" name="name" value="{{ $company->name }}" disabled>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail">Email address</label>
              <input type="email" class="form-control disabled" id="exampleInputEmail" aria-describedby="emailHelp" name="email" value="{{ $company->email }}" disabled>
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group">
              <label for="exampleInputWebsite">Website</label>
              <input type="text" class="form-control disabled" id="exampleInputWebsite" aria-describedby="websiteHelp" name="website" value="{{ $company->website }}" disabled>
              <!-- <small id="websiteHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group">
              <label for="exampleInputEmployees">Employees</label>
              <input type="text" class="form-control disabled" id="exampleInputEmployees" aria-describedby="employeesHelp" name="employees" value="{{ $company->employees->count() }}" disabled>
              <!-- <small id="employeesHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection