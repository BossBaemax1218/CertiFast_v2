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
        data: [3, 5, 6, 7,3, 5, 6, 7],
        label: "Barangay Clearance",
        backgroundColor: "blue"
      },
      {
        data: [4, 7, 3, 6, 100,7,4,6],
        label: "Barangay Residency",
        backgroundColor: "red"
        
      },
      {
        data: [100,7,4,6,9,7,3,100],
        label: "Barangay Indengency",
        backgroundColor: "lightgreen"
        
      },
      {
        data: [6,9,7,3,100,7,4,6],
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
  