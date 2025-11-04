document.addEventListener("DOMContentLoaded", function () {
    if (typeof dailyTrends === "undefined") return;

    const labels = Object.keys(dailyTrends);
    const dataValues = Object.values(dailyTrends);

    new Chart(document.getElementById("serviceTrendChart"), {
        type: "line",
        data: {
            labels: labels,
            datasets: [
                {
                    data: dataValues,
                    borderColor: "#198754",
                    tension: 0.3,
                    fill: false,
                    borderWidth: 2,
                    pointBackgroundColor: "#198754"
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        title: (tooltipItems) => tooltipItems[0].label,
                        label: (tooltipItem) =>
                            `Total Services: ${tooltipItem.formattedValue}`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: "Number of Services" }
                },
                x: {
                    title: { display: true, text: "Date" }
                }
            }
        }
    });
});
