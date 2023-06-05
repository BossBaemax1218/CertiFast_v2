
var xValues = ["Total Resident"];
var yValues = [100,50];
var barColors = ["#D32D41"];
var options = {
	pieceLabel: {
	render: function(d) { 
	return d.label + " (" + d.percentage + "%)" 
},
	fontColor: '#000',
	position: 'inside',
	segment: true
	}
};
new Chart("myChart1", {
	type: "pie",
	data: {
	labels: xValues,
	datasets: [{
	backgroundColor: barColors,
	data: yValues
	}]
},
    options: {
	title: {
	display: true,
	text: "Certificate Request"

		}
    }
});
