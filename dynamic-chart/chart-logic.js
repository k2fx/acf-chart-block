document.addEventListener('DOMContentLoaded', function() {
    initializeCharts();
});

// Also initialize on Gutenberg changes
if (window.acf) {
    window.acf.addAction('render_block_preview', initializeCharts);
}

function initializeCharts() {
    const chartCanvases = document.querySelectorAll('.chart-canvas');

    chartCanvases.forEach(canvas => {
        // Get chart configuration
        const config = JSON.parse(canvas.dataset.chart);

        // Clear any existing chart
        if (canvas.chart) {
            canvas.chart.destroy();
        }

        // Create chart configuration
        const chartConfig = {
            type: config.type,
            data: {
                labels: config.data.labels,
                datasets: [{
                    label: config.settings.title,
                    data: config.data.values,
                    backgroundColor: config.data.colors,
                    borderColor: config.data.colors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: config.settings.showLegend
                    },
                    title: {
                        display: true,
                        text: config.settings.title
                    }
                },
                animation: {
                    duration: config.settings.animation ? 1000 : 0
                }
            }
        };

        // Create the chart
        canvas.chart = new Chart(canvas, chartConfig);
    });
}