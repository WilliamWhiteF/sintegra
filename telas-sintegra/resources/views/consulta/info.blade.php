<div class="row">
	<div class="col-md-offset-4 col-md-4">
		<table id = "tbl-search-results" class="table table-striped table-hover table-bordered">
			<thead>
				<tr>
					<th>Campo</th>
					<th>Informação</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($consultaJson as $field => $info)
					<tr>
						<th>{{ $field }}</th>
						<td>{{ $info }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
