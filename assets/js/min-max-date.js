var minDate, maxDate;

$.fn.dataTable.ext.search.push(
	function(settings, data, dataIndex) {
		var min = minDate.val();
		var max = maxDate.val();
		var date = new Date(data[0]);

		if (
			(min === null && max === null) ||
			(min === null && date <= max) ||
			(min <= date && max === null) ||
			(min <= date && date <= max)
		) {
			return true;
		}
		return false;
	}
);

$(document).ready(function() {
	minDate = new DateTime($('#min'), {
		format: 'MMMM Do YYYY'
	});
	maxDate = new DateTime($('#max'), {
		format: 'MMMM Do YYYY'
	});

	var table = $('#revenuetable').DataTable({
		"order": [[0, "desc"]],
		dom: 'Bfrtip',
		buttons: []
	});

	$('#min, #max').on('change', function() {
		table.draw();
	});
});