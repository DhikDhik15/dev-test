@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Import employee</span>
          <a class="btn btn-sm btn-secondary" href="{{ route('admin.company.show', ['company' => $company->id]) }}" role="button">Back</a>
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

          <form method="POST" action="{{ route('admin.company.import_excel.store', ['company' => $company->id]) }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
              <label>Excel</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
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
            <button type="submit" class="btn btn-primary">Store</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <span>Download template excel</span>
        </div>

        <div class="card-body d-flex justify-content-center align-items-center">
          <a class="btn btn-primary" href="{{ asset('template/import-employees-template.xlsx') }}" role="button">Download</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection