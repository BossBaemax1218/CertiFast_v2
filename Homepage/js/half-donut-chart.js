var ctx = document.getElementById("myChart2");
var myChart2 = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Barangay Residency"],
        datasets: [{
            label: 'Barangay Residency',
            data: [50,100],
            backgroundColor: [
                '#D32D41',
                'lightgray'
            ],
            borderColor: [
                'white'
            ],
            borderWidth: 0
        }]
    },
    options: {
        rotation: 1 * Math.PI,
        circumference: 1 * Math.PI,
        title: {
            display: true,
            text: "Weekly Requested Certificates"
    
        }
    }
    
});
