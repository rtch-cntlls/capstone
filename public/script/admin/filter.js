document.querySelectorAll('.auto-filter').forEach(el => {
    el.addEventListener('change', () => {
        document.getElementById('filterForm').submit();
    });
});
flatpickr("#dateRange", {
    mode: "range",
    dateFormat: "Y-m-d", 
    altInput: true,
    altFormat: "M d, Y",
    defaultDate: [window.defaultFrom, window.defaultTo],
    onClose: function(selectedDates) {
        if(selectedDates.length === 2){
            const [from, to] = selectedDates;
            document.getElementById('from').value = from.toISOString().split('T')[0];
            document.getElementById('to').value = to.toISOString().split('T')[0];
            document.getElementById('filterForm').submit();
        }
    }
});

document.getElementById('from').value = window.defaultFrom;
document.getElementById('to').value = window.defaultTo;
