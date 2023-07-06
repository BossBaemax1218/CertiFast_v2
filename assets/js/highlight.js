function applyFilter(filterType) {
    // Handle the filter selection
    // You can add your own custom logic here

    // Highlight the selected filter
    const filters = document.querySelectorAll('.dropdown-menu .dropdown-item');
    for (let i = 0; i < filters.length; i++) {
        filters[i].classList.remove('active');
    }
    event.target.closest('.dropdown-item').classList.add('active');
}

function applyDateRangeFilter() {
    // Handle the custom date range filter selection
    // You can add your own custom logic here

    // Highlight the selected filter
    const filters = document.querySelectorAll('.dropdown-menu .dropdown-item');
    for (let i = 0; i < filters.length; i++) {
        filters[i].classList.remove('active');
    }
    document.getElementById('applyRangeButton').classList.add('active');
}