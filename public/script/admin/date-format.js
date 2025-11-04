flatpickr("#fromDate", {
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "F j, Y",
    onChange: () => document.getElementById('filterForm').submit()
});

flatpickr("#toDate", {
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "F j, Y",
    onChange: () => document.getElementById('filterForm').submit()
});