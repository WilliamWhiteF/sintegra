$(document).ready(function () {
	$.ajaxSetup({
  		headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		}
	});

	function limpaCnpj(cnpj)
	{
		return cnpj.toString().replace(/\.|-|\//g, '');
	}

	$('#frmConsulta').submit(function (event) {
		event.preventDefault();

		$('#search-results').fadeOut('slow');
		var cnpj = limpaCnpj($('#cnpj').val());

		$.get('/consulta/' + cnpj, {}, function (response) {
			$('#search-results').html(response);
			$('#search-results').fadeIn('slow');

		}, 'html');
	});

	$('.excluir-consulta').click(function (event) {
		event.preventDefault();
		event.stopPropagation();

		var self = $(this);
		var cnpj = limpaCnpj(self.data('cnpj'));

		$.ajax({
			url: '/consulta/' + cnpj,
			type: 'DELETE'
		})
		.done(function (response) {
			var consultaRow = self.closest('tr');
			var consultaId = consultaRow.data('id');

			$('#consulta-info-' + consultaId).closest('tr').fadeOut('slow');
			consultaRow.fadeOut('slow');
		});
	});

	$('tr.consulta').click(function (event) {
		event.preventDefault();
		event.stopPropagation();

		var id = $(this).data('id');
		if ($('#consulta-info-' + id).data('active') == 1) {
			return false;
		}

		$('.consulta-info').fadeOut('slow');
		var cnpj = limpaCnpj($(this).data('cnpj'));


		$.get('/consulta/' + cnpj, {}, function (response) {
			$('#consulta-info-' + id).data('active', 1).html(response);
			$('#consulta-info-' + id).closest('tr').fadeIn('slow');

		}, 'html');
	})
});