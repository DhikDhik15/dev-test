<!DOCTYPE html>
<html>
<head>
	<title>Report</title>
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Report Employee</h4>
	</center>

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
			@foreach($employee as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->name}}</td>
				<td>{{$p->email}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>