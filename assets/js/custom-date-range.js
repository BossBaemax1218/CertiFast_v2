document.addEventListener("DOMContentLoaded", function() {
    var startDate = document.getElementById("startDate");
    var endDate = document.getElementById("endDate");
    var today = new Date();

    startDate.value = today.toISOString().substr(0, 10);
    endDate.value = today.toISOString().substr(0, 10);
});

document.getElementById("customRangeButton").addEventListener("click", function() {
    showCustomRange();
});

function applyFilter(filter) {
    var startDate = document.getElementById("startDate");
    var endDate = document.getElementById("endDate");
    var today = new Date();

    switch (filter) {
        case "day":
            startDate.value = today.toISOString().substr(0, 10);
            endDate.value = today.toISOString().substr(0, 10);
            break;
        case "yesterday":
            var yesterday = new Date(today);
            yesterday.setDate(today.getDate() - 1);
            startDate.value = yesterday.toISOString().substr(0, 10);
            endDate.value = yesterday.toISOString().substr(0, 10);
            break;
        case "last7days":
            var last7Days = new Date(today);
            last7Days.setDate(today.getDate() - 6);
            startDate.value = last7Days.toISOString().substr(0, 10);
            endDate.value = today.toISOString().substr(0, 10);
            break;
        case "last30days":
            var last30Days = new Date(today);
            last30Days.setDate(today.getDate() - 29);
            startDate.value = last30Days.toISOString().substr(0, 10);
            endDate.value = today.toISOString().substr(0, 10);
            break;
        case "thismonth":
            var startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
            startDate.value = startOfMonth.toISOString().substr(0, 10);
            endDate.value = today.toISOString().substr(0, 10);
            break;
        case "lastmonth":
            var startOfLastMonth = new Date(today.getFullYear(), today.getMonth() - 1, 1);
            var endOfLastMonth = new Date(today.getFullYear(), today.getMonth(), 0);
            startDate.value = startOfLastMonth.toISOString().substr(0, 10);
            endDate.value = endOfLastMonth.toISOString().substr(0, 10);
            break;
        case "thisyear":
            var startOfYear = new Date(today.getFullYear(), 0, 1);
            startDate.value = startOfYear.toISOString().substr(0, 10);
            endDate.value = today.toISOString().substr(0, 10);
            break;
        case "lastyear":
            var startOfLastYear = new Date(today.getFullYear() - 1, 0, 1);
            var endOfLastYear = new Date(today.getFullYear() - 1, 11, 31);
            startDate.value = startOfLastYear.toISOString().substr(0, 10);
            endDate.value = endOfLastYear.toISOString().substr(0, 10);
            break;
    }

    // Highlight the selected filter
    const filters = document.querySelectorAll('.dropdown-menu .dropdown-item');
    for (let i = 0; i < filters.length; i++) {
        filters[i].classList.remove('active');
    }
    event.target.classList.add('active');
}

function showCustomRange() {
    var startDate =document.getElementById("startDate");
    var endDate = document.getElementById("endDate");

    // Set initial values to empty strings or desired default dates
    startDate.value = "";
    endDate.value = "";

    // Show the date inputs for custom range
    startDate.style.display = "inline-block";
    endDate.style.display = "inline-block";

    // Highlight the selected filter
    const filters = document.querySelectorAll('.dropdown-menu .dropdown-item');
    for (let i = 0; i < filters.length; i++) {
        filters[i].classList.remove('active');
    }
    document.getElementById("customRangeButton").classList.add('active');
}