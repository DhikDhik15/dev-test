@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Edit employee</span>
          <div>
            <a class="btn btn-sm btn-secondary" href="{{ route('admin.employee.show', ['employee' => $employee->id]) }}" role="button">Back</a>
          </div>
        </div>

        <div class="card-body">
          @if($errors->any())
          <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Whoops, something went wrong.</h4>
            <ul>
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <form method="POST" action="{{ route('admin.employee.update', ['employee' => $employee->id]) }}">
            @csrf
            @method('put')

            <div class="form-group">
              <label for="exampleInputCompany">Name</label>
              <select id="exampleInputCompany" class="js-example-basic-single w-100" name="company_id"></select>
              <!-- <small id="nameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>

            <div class="form-group">
              <label for="exampleInputName">Name</label>
              <input type="text" class="form-control" id="exampleInputName" aria-describedby="nameHelp" name="name" value="{{ old('name') ?? $employee->name }}">
              <!-- <small id="nameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group">
              <label for="exampleInputEmail">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" name="email" value="{{ old('email') ?? $employee->email }}">
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  $('#exampleInputCompany').select2({
    theme: 'bootstrap4',
    placeholder: "Select a company",
    width: '100%',
    data: [{
      id: new Number('{{ $employee->company->id }}'),
      text: "{{ $employee->company->name }}"
    }],
    ajax: {
      url: "{{ route('admin.ajax.company.index') }}",
      dataType: 'json',
      delay: 250,
      data: function(params) {
        return {
          term: params.term || '',
          page: params.page || 1
        }
      },
      cache: true
    }
  });
</script>
@endsection