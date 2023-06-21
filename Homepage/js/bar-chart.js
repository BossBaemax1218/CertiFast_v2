var xValues = ["Residency", "Indigency", "Clearance", "Business Permit"];
var yValues = [40, 65, 35, 55, 100];
var barColors = ["#D32D41", "#D32D41", "#D32D41", "#D32D41"];

new Chart("myChart", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
            backgroundColor: barColors,
            data: yValues
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            display: false
        },
        title: {
            display: true,
            text: "Most Requested Certificates"
        }
    }
});