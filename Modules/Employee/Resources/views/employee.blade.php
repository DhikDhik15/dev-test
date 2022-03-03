<!DOCTYPE html>
<html>
<head>
	<title>Report</title>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<style>
		table, th, td {
	   border: 1px solid black;
	 }
	  th, td {
	   border-color: #41f3f3;
	  
	 }
	 .col1{
		width:100px;
	 }
	 
		</style>
</head>
<body>

	<div class="container mt-4">
		<div class="row">
			<div class="col-md-8">
			<h4>Report Employee</h4>
			</div>
		</div>
		<div class="col-md-4">
			<div class = mb-4 d-flex justify-content-end>

		<a class="btn btn-primary" href="/api/employee-export" target="blank">Export To PDF</a>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
		<table class='table'>
			<thead>
				<tr>
					<th scope="col" class="col1">No</th>
					<th scope="col" class="col1">Nama</th>
					<th scope="col" class="col1">Email</th>
					<th scope="col" class="col1">Company</th>
					<th scope="col" class="col1">Status</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($employies as $p)
				<tr>
					<td scope="row" class="col1">{{$i++}}</td>
					<td scope="col" class="col1">{{$p->name}}</td>
					<td scope="col" class="col1">{{$p->email}}</td>
					<td scope="col" class="col1">{{$p->company->name}}</td>
					<td scope="col" class="col1">{{$p->statusEmployee->name}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
			</div>
		</div>
	</div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>