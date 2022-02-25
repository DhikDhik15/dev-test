@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Company</span>
          <a class="btn btn-sm btn-primary" href="{{ route('admin.company.create') }}" role="button">Create</a>
        </div>

        <div class="card-body">
          @if($companies->count() > 0)
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="col-1">ID</th>
                <th class="col-5">Name</th>
                <th class="col-3">Email</th>
                <th class="col-3 text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($companies as $company)
              <tr>
                <th scope="row">{{ $company->id }}</th>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td class="text-center">
                  <a class="btn btn-sm btn-primary mb-1 mb-md-0" href="{{ route('admin.company.show', ['company' => $company->id]) }}" role="button">Detail</a>
                  <button type="button" class="btn btn-sm btn-danger" onclick="event.preventDefault();document.getElementById('delete-company-{{ $company->id }}').submit();">Delete</button>

                  <form id="delete-company-{{ $company->id }}" action="{{ route('admin.company.destroy', ['company' => $company->id]) }}" method="POST" class="d-none">
                    @csrf
                    @method('delete')
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <div class="d-flex justify-content-end">
            {{ $companies->links() }}
          </div>
          @else
          <span class="d-block text-center text-muted">Companies is empty</span>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection