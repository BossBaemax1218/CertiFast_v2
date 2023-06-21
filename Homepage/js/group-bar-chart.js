var barChartData = {
    labels: [
      "2018",
      "2019",
      "2020",
      "2021",
      "2022",
    ],
    datasets: [
      {
        data: [53, 85, 76, 57],
        label: "Barangay Clearance",
        backgroundColor: "blue"
      },
      {
        data: [80,47,84,86],
        label: "Barangay Residency",
        backgroundColor: "red"
        
      },
      {
        data: [80,,77,63,90],
        label: "Barangay Indengency",
        backgroundColor: "lightgreen"
        
      },
      {
        data: [78,87,74,86],
        label: "Business Permint",
        backgroundColor: "violet"
        
      }
    ]
  };
  
  var chartOptions = {
    responsive: true,
    maintainAspectRatio: false, 
    legend: {
      position: "top"
    },
    title: {
      display: true,
      text: "Yearly Reports Certification Requested"
    },
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
  
  window.onload = function() {
    var ctx = document.getElementById("myChart3");
    window.myBar = new Chart(ctx, {
      type: "bar",
      data: barChartData,
      options: chartOptions
    });
  };
  