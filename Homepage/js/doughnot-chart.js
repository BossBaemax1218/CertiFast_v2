var xValues = ["Complete", "Incomplete"];
var yValues = [10, 49, 100];
var barColors = [
    "#D32D41",
    "#D32D41",
    "#000"
];

new Chart("myChart4", {
  type: "doughnut",
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
      text: "Monthly Requested Certificates"
    }
  }
});
