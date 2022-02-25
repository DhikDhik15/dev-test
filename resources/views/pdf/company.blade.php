<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ public_path('js/app.js') }}"></script>

  <!-- Styles -->
  <link href="{{ public_path('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <div id="app">
    <div class="container-fluid py-5">
      <h1 class="text-center mb-5">Company Employees</h1>
      <span class="mb-2 d-block">Company name : {{$company->name}}</span>
      @if($company->employees->count() > 0)
      <table class="table table-hover">
        <thead>
          <tr>
            <th class="col-1">ID</th>
            <th class="col-5">Name</th>
            <th class="col-3">Email</th>
          </tr>
        </thead>
        <tbody>
          @foreach($company->employees as $employee)
          <tr>
            <th scope="row">{{ $employee->id }}</th>
            <td>{{ $employee->name }}</td>
            <td>{{ $employee->email }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <span class="d-block text-center text-muted">Company employees is empty</span>
      @endif
    </div>
  </div>
</body>

</html>