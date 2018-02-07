@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-4 col-md-offset-4 offset-top">
		<form action="/login" method = "POST">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="usuario">Usuario</label>
				<input type="text" name="usuario" id="usuario" class="form-control" placeholder="teste">
			</div>

			<div class="form-group">
				<label for="senha">Senha</label>
				<input type="password" name="senha" id="senha" class="form-control" placeholder="123">
			</div>
			<input type="submit" class = "btn btn-default">
		</form>
	</div>
</div>
@endsection