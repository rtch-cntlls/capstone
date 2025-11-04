document.addEventListener("DOMContentLoaded", () => {
    const ctx = document.getElementById("salesLineChart")?.getContext("2d");
    new Chart(ctx, {
        type: "line",
        data: {
            labels: salesLabels,
            datasets: [
                {
                    label: "Revenue (₱)",
                    data: salesRevenue,
                    borderColor: "#0d6efd",
                    backgroundColor: "rgba(13, 110, 253, 0.1)",
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: "#0d6efd",
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: "#0d6efd",
                    titleColor: "#fff",
                    bodyColor: "#fff",
                    callbacks: {
                        label: (context) =>
                            " ₱" + context.parsed.y.toLocaleString(),
                    },
                },
            },
            scales: {
                x: {
                    title: { display: true, text: "Date", font: { weight: "bold" } },
                    grid: { display: false },
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: "Sales (₱)",
                        font: { weight: "bold" },
                    },
                    ticks: {
                        callback: (value) => "₱" + value.toLocaleString(),
                    },
                    grid: { color: "#f2f2f2" },
                },
            },
        },
    });
});
