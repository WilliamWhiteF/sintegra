@extends('layouts.app')
@section('content')
	{{-- Listagem --}}
	<div class="row">
		<div class="col-md-offset-2 col-md-8">
			@if ($consultas->isNotEmpty())
				<table id = "tbl-list" class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>Data de Consulta</th>
							<th>CNPJ</th>
							<th>Excluir</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($consultas as $consulta)
							<tr class = "consulta clickable" data-cnpj = "{{ $consulta->cnpj }}" data-id = "{{ $consulta->id }}" title = "Clique para exibir as informações da consulta">
								<td>{{ $consulta->created_at->format('d/m/Y H:i:s') }}</th>
								<td>{{ $consulta->cnpj }}</td>
								<td><button class="btn btn-default excluir-consulta" data-cnpj = "{{ $consulta->cnpj }}">Excluir</button></td>
							</tr>
							<tr class = "consulta-info display-none">
								<td colspan="3">
									<div id="consulta-info-{{ $consulta->id }}"></div>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				<span>Nenhuma Consulta realizada</span>

			@endif
		</div>
	</div>
@endsection