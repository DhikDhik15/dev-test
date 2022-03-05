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
			<div class = mb-6 d-flex justify-content-end>
				<a class="btn btn-primary" href="/api/employee-export" target="blank">Export To PDF</a>
				<a class="btn btn-warning" href="/api/export-excel" target="blank">Export Excel</a>
				<a class="btn btn-success" data-toggle="modal" data-target="#importExcel">Import Excel</a>
			</div>		
		</div>

		<!-- Import Excel -->
		<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="/api/employee/import_excel" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Import Employee</h5>
						</div>
						<div class="modal-body">

							{{ csrf_field() }}

							<label>Pilih file excel</label>
							<div class="form-group">
								<input type="file" name="file" required="required">
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Import</button>
						</div>
					</div>
				</form>
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>