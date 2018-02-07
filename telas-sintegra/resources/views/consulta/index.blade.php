@extends('layouts.app')
@section('content')
	{{-- Busca --}}
	<div class="row offset-top">
		<div class="col-md-4 col-md-offset-4">
			<form action="/consulta/" method="GET" id="frmConsulta">
				<div class="form-group">
					<label for="cnpj">CNPJ</label>
					<input type="text" name="cnpj" id="cnpj" placeholder="31804115000243" class="form-control" required>
				</div>
				<input type="submit" class="btn btn-default">
			</form>
		</div>
	</div>
	<div id = "search-results" class="search-results offset-top display-none"></div>
@endsection