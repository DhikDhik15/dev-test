@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Create company</span>
          <a class="btn btn-sm btn-secondary" href="{{ route('admin.company.index') }}" role="button">Back</a>
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

          <form method="POST" action="{{ route('admin.company.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
              <label>Logo</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="exampleInputFile" name="logo">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                <script>
                  const inputFile = document.getElementById('exampleInputFile')
                  const inputFileLabel = document.querySelector('label[for=exampleInputFile]')

                  inputFile.addEventListener('change', (e) => {
                    inputFileLabel.innerHTML = e.target.files[0].name
                  })
                </script>
              </div>
            </div>

            <div class="form-group">
              <label for="exampleInputName">Name</label>
              <input type="text" class="form-control" id="exampleInputName" aria-describedby="nameHelp" name="name" value="{{ old('name') }}">
              <!-- <small id="nameHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group">
              <label for="exampleInputEmail">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" name="email" value="{{ old('email') }}">
              <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <div class="form-group">
              <label for="exampleInputWebsite">Website</label>
              <input type="text" class="form-control" id="exampleInputWebsite" aria-describedby="websiteHelp" name="website" value="{{ old('website') }}">
              <!-- <small id="websiteHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
            </div>
            <button type="submit" class="btn btn-primary">Store</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection