var xValues = ["Clearance", "Residency", "Business Permit", "Indigency"];
var yValues = [55, 49, 44, 24];
var barColors = [
    "#D32D41",
    "#D32D41",
    "#D32D41",
    "#D32D41",
    "#D32D41"
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
