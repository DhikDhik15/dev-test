<!DOCTYPE html>
<html>
<head>
	<title>Report</title>
	<style>
		table, th, td {
	   border: 0.5ch solid black;
	   font-size: 9pt;
	 }
	  th, td {
	   border-color: #2bdbdb;
	  
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

</body>
</html>