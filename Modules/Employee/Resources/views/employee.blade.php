<!DOCTYPE html>
<html>
<head>
	<title>Report</title>
</head>
<body>

	<div class="container">
		<center>
			<h4>Report Employee</h4>
		</center>
		<br/>
		<a href="/api/employee-export" class="btn btn-primary" target="_blank">CETAK PDF</a>
		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Email</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($employies as $p)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{$p->name}}</td>
					<td>{{$p->email}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>

	</div>

</body>
</html>