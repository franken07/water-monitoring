<!DOCTYPE html>
<html lang="en">
    <!-- Sensor -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/pond/icc.png" type="image/x-icon">
    <title>Water Monitoring System</title>
    <link rel="stylesheet" href="{{ asset('assets/web/assets/mobirise-icons2/mobirise2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/parallax/jarallax.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-reboot.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dropdown/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dropdown/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/socicon/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/animatecss/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/style.css') }}">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap"></noscript>
    <link rel="preload" as="style" href="{{ asset('assets/mobirise/css/additional.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/mobirise/css/additional.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.css">
  
    {{-- FontAwesome for icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/justgage"></script>
    <script src="https://cdn.jsdelivr.net/npm/raphael"></script>

   <style>
   :root {
        --primary-color: #d2b3db;
        --secondary-color: #64b5f6;
        --background-color: #CFDEF3;
        --card-color: #ffffff;
        --text-primary: #2c3e50;
        --text-secondary: #546e7a;
        --success-color: #4caf50;
        --warning-color: #ff9800;
        --danger-color: #f44336;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--background-color);
        margin: 0;
        padding: 0;
    }

    .dashboard-container {
        max-width: 1600px;
        margin: 60px auto;
        padding: 50px 30px;
    }

    .dashboard-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .dashboard-title {
        font-size: 38px;
        font-weight: 700;
        color: var(--text-primary);
    }

    .dashboard-subtitle {
        font-size: 16px;
        color: var(--text-secondary);
        margin-top: 8px;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .sensor-card {
        background-color: var(--card-color);
        padding: 24px;
        border-radius: 20px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.07);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .sensor-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    }

    .sensor-icon {
        font-size: 34px;
        color: var(--primary-color);
        margin-bottom: 10px;
    }

    .sensor-name {
        font-size: 40px;
        color: var(--text-secondary);
        font-weight: 600;
        margin-bottom: 10px;
    }

    .sensor-value-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .sensor-value {
        font-size: 34px;
        font-weight: 700;
        color: var(--text-primary);
        text-align: center;
    }

    .sensor-unit {
        font-size: 14px;
        color: var(--text-secondary);
        margin-left: 6px;
    }

    .visualization-tabs {
        margin-top: 10px;
    }

    .visualization-tab {
        display: inline-block;
        background-color: var(--secondary-color);
        color: white;
        padding: 5px 12px;
        border-radius: 14px;
        font-size: 13px;
        cursor: pointer;
    }

    .chart-container,
    .gauge-container {
        width: 100%;
        max-width: 400px;
        height: 200px;
        margin: 0 auto;
    }

    .sensor-timestamp {
        font-size: 13px;
        color: var(--text-secondary);
        margin-top: 12px;
    }

    .map-container {
        height: 340px;
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid #ccc;
    }

    .map-container iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    @media screen and (max-width: 768px) {
        .dashboard-title {
            font-size: 28px;
        }

        .sensor-value {
            font-size: 26px;
        }

        .sensor-card {
            padding: 20px;
        }
    }
    .chart-container {
    width: 100%;
    height: 200px;
    position: relative;
    }
     #summaryChart {
        width: 120% !important;
        height: 120% !important;
    }
    .chart-history-card {
    padding: 20px;
    grid-column: span 1 !important;
}

    .small-chart {
        height: 220px !important;
        max-width: 320px;
        margin: 0 auto;
    }
    .chart-history-card .sensor-name {
    font-size: 22px;
}
</style>

</head>
<body>

@include('include.header')

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1 class="dashboard-title"><i class="fas fa-water"></i> Water Monitoring Dashboard</h1>
    </div>

    <div class="dashboard-grid">
      <!-- Location Map -->
<div class="sensor-card" style="grid-column: span 2;">
    <div class="sensor-name">
        <i class="fas fa-map-marker-alt" style="margin-right: 8px; color: var(--primary-color);"></i>
        Monitoring Location
    </div>
    <div class="map-container">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1563.3423667808422!2d120.38481326324874!3d16.073394178123483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2sph!4v1741701226002!5m2!1sen!2sph" 
            loading="lazy" 
            allowfullscreen 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>
<!-- Summary Chart Card -->
<div class="sensor-card" style="grid-column: span 2;">
    <div class="sensor-name">
        <i class="fas fa-chart-pie" style="margin-right: 8px; color: var(--primary-color);"></i>
        Sensor Summary Overview
    </div>
    <div class="chart-container" style="height: 300px;">
       <canvas id="summaryChart" style="width: 100% !important; height: 100% !important;"></canvas>
    </div>
</div>


         <!-- Sensor Cards Loop -->
@if($sensorData)
   @foreach($staticSensorNames as $sensorKey => $sensorName)
    <div class="sensor-card">
        <!-- Sensor Name with Icon -->
        <h3 class="sensor-name">
            @if($sensorKey == 'phLevel')
                <i class="fas fa-vial" style="color: #7e57c2;"></i>
            @elseif($sensorKey == 'temperature')
                <i class="fas fa-thermometer-half" style="color: #ef5350;"></i>
            @elseif($sensorKey == 'turbidity')
                <i class="fas fa-tint" style="color: #2196f3;"></i>
            @elseif($sensorKey == 'salinity')
                <i class="fas fa-water" style="color: #00acc1;"></i>
            @else
                <i class="fas fa-microchip" style="color: #607d8b;"></i>
            @endif
            {{ $sensorName }}
        </h3>

        <!-- Value & Icon -->
        <div class="sensor-value-container">
            <div style="display: flex; align-items: center;">
                <span class="sensor-value" id="{{ $sensorKey }}-value">
                    {{ $sensorData[$sensorKey]['value'] ?? 'N/A' }}
                </span>
                <span class="sensor-unit">
                    @if($sensorKey == 'phLevel') pH 
                    @elseif($sensorKey == 'salinity') ppt 
                    @elseif($sensorKey == 'temperature') °C 
                    @elseif($sensorKey == 'turbidity') NTU 
                    @else units 
                    @endif
                </span>
            </div>

            <div>
                @if(isset($sensorData[$sensorKey]['value']))
                    @if($sensorData[$sensorKey]['value'] > 80)
                        <i id="{{ $sensorKey }}-icon" class="fas fa-arrow-up" style="color: var(--danger-color); font-size: 20px;"></i>
                    @elseif($sensorData[$sensorKey]['value'] > 50)
                        <i id="{{ $sensorKey }}-icon" class="fas fa-arrow-right" style="color: var(--warning-color); font-size: 20px;"></i>
                    @else
                        <i id="{{ $sensorKey }}-icon" class="fas fa-arrow-down" style="color: var(--success-color); font-size: 20px;"></i>
                    @endif
                @else
                    <i id="{{ $sensorKey }}-icon" class="fas fa-question-circle" style="color: var(--text-secondary); font-size: 20px;"></i>
                @endif
            </div>
        </div>

       
        <!-- Timestamp -->
        <div class="sensor-timestamp" id="{{ $sensorKey }}-timestamp">
            <i class="far fa-clock"></i> {{ $sensorData[$sensorKey]['timestamp'] ?? 'No Data' }}
        </div>
    </div>
@endforeach
{{-- ✅ Conditionally add the pH history card --}}
@if(isset($sensorData['phLevel']))
<div class="sensor-card chart-history-card">
    <div class="sensor-name">
        <i class="fas fa-chart-line" style="margin-right: 8px; color: #7e57c2;"></i>
        pH Level History 
    </div>
    <div class="chart-container small-chart">
        <canvas id="chart-history-ph"></canvas>
    </div>
</div>
@endif
@if(isset($sensorData['temperature']))
<div class="sensor-card chart-history-card">
    <div class="sensor-name">
        <i class="fas fa-chart-line" style="margin-right: 8px; color: #ef5350;"></i>
        Temperature History 
    </div>
    <div class="chart-container small-chart">
        <canvas id="chart-history-temp"></canvas>
    </div>
</div>
@endif
@if(isset($sensorData['turbidity']))
<div class="sensor-card chart-history-card">
    <div class="sensor-name">
        <i class="fas fa-chart-line" style="margin-right: 8px; color: #2196f3;"></i>
        Turbidity History 
    </div>
    <div class="chart-container small-chart">
        <canvas id="chart-history-turb"></canvas>
    </div>
</div>
@endif
@if(isset($sensorData['salinity']))
<div class="sensor-card chart-history-card">
    <div class="sensor-name">
        <i class="fas fa-chart-line" style="margin-right: 8px; color: #00acc1;"></i>
        Salinity History 
    </div>
    <div class="chart-container small-chart">
        <canvas id="chart-history-sal"></canvas>
    </div>
</div>
@endif



@else
    <div class="sensor-card" style="grid-column: span 2;">
        <p style="text-align: center; color: var(--danger-color); font-size: 16px;">
            <i class="fas fa-exclamation-triangle"></i> No sensor data available
        </p>
    </div>
@endif
    </div>
</div>




<!--footer -->
<section class="footer3 cid-u3GZCsJlbC" once="footers" id="footer-3-u3GZCsJlbC">
    <div class="container">
        <div class="row">
          <p class="mbr-fonts-style copyright display-1">
            WATER MONITORING
        </p>
            <div class="col-12 mt-4">
                <div class="social-row">
                    <div class="soc-item">
                        <a href="https://www.facebook.com/profile.php?id=61574551644376" target="_blank">
                            <span class="mbr-iconfont socicon socicon-facebook display-7"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="https://twitter.com/" target="_blank">
                            <span class="mbr-iconfont socicon-twitter socicon"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="https://Instagram.com/" target="_blank">
                            <span class="mbr-iconfont socicon-instagram socicon"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-5">
                <p class="mbr-fonts-style copyright display-7">
                   © 2024 WM. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</section>


<script src="assets/parallax/jarallax.js"></script>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/dropdown/js/navbar-dropdown.js"></script>
<script src="assets/scrollgallery/scroll-gallery.js"></script>
<script src="assets/mbr-switch-arrow/mbr-switch-arrow.js"></script>
<script src="assets/smoothscroll/smooth-scroll.js"></script>
<script src="assets/ytplayer/index.js"></script>
<script src="assets/theme/js/script.js"></script>
<script src="assets/formoid/formoid.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

<script>
const sensorCharts = {};
let summaryChart = null;

// History arrays for each sensor
let phHistory = [];
let temperatureHistory = [];
let turbidityHistory = [];
let salinityHistory = [];

let phLineChart = null;
let temperatureLineChart = null;
let turbidityLineChart = null;
let salinityLineChart = null;

function updateSensorData() {
    fetch('/sensor/live')
        .then(response => response.json())
        .then(data => {
            for (const key in data) {
                if (data[key]) {
                    const value = data[key].value ?? 'N/A';
                    const timestamp = data[key].timestamp ?? 'No Data';

                    const valueElem = document.getElementById(`${key}-value`);
                    const timeElem = document.getElementById(`${key}-timestamp`);
                    const iconElem = document.getElementById(`${key}-icon`);

                    if (valueElem) valueElem.innerText = value;
                    if (timeElem) timeElem.innerHTML = `<i class="far fa-clock"></i> ${timestamp}`;

                    if (iconElem) {
                        if (value > 80) {
                            iconElem.className = "fas fa-arrow-up";
                            iconElem.style.color = "var(--danger-color)";
                        } else if (value > 50) {
                            iconElem.className = "fas fa-arrow-right";
                            iconElem.style.color = "var(--warning-color)";
                        } else {
                            iconElem.className = "fas fa-arrow-down";
                            iconElem.style.color = "var(--success-color)";
                        }
                    }

                    // Update individual sensor chart (if any)
                    if (sensorCharts[key]) {
                        const chart = sensorCharts[key];
                        chart.data.datasets[0].data[0] = value;
                        chart.data.datasets[0].backgroundColor[0] =
                            value > 80 ? '#f44336' :
                            value > 50 ? '#ff9800' : '#4caf50';
                        chart.update();
                    }

                    // Update histories
                    if (key === 'phLevel') {
                        phHistory.push({ value: parseFloat(value), timestamp });
                        if (phHistory.length > 10) phHistory.shift();
                        updatePhChart();
                    } else if (key === 'temperature') {
                        temperatureHistory.push({ value: parseFloat(value), timestamp });
                        if (temperatureHistory.length > 10) temperatureHistory.shift();
                        updateTemperatureChart();
                    } else if (key === 'turbidity') {
                        turbidityHistory.push({ value: parseFloat(value), timestamp });
                        if (turbidityHistory.length > 10) turbidityHistory.shift();
                        updateTurbidityChart();
                    } else if (key === 'salinity') {
                        salinityHistory.push({ value: parseFloat(value), timestamp });
                        if (salinityHistory.length > 10) salinityHistory.shift();
                        updateSalinityChart();
                    }
                }
            }

            // Update summary chart
            if (summaryChart) {
                @foreach($staticSensorNames as $sensorKey => $sensorName)
                if (data['{{ $sensorKey }}']) {
                    summaryChart.data.datasets[0].data[{{ $loop->index }}] = data['{{ $sensorKey }}'].value ?? 0;
                }
                @endforeach
                summaryChart.update();
            }
        });
}

function createLineChart(ctx, label, color, unit, historyArray, chartRef) {
    const labels = historyArray.map(e => e.timestamp);
    const values = historyArray.map(e => e.value);

    if (chartRef.chart) {
        chartRef.chart.data.labels = labels;
        chartRef.chart.data.datasets[0].data = values;
        chartRef.chart.update();
    } else {
        chartRef.chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: values,
                    borderColor: color,
                    backgroundColor: color.replace(')', ',0.2)').replace('rgb', 'rgba'),
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                animation: false,
                scales: {
                    y: { title: { display: true, text: unit } },
                    x: { title: { display: true, text: 'Timestamp' } }
                }
            }
        });
    }
}

// Individual chart updaters
function updatePhChart() {
    const ctx = document.getElementById('chart-history-ph')?.getContext('2d');
    if (!ctx) return;
    createLineChart(ctx, 'pH Level (Live)', 'rgb(100,181,246)', 'pH', phHistory, { get chart() { return phLineChart; }, set chart(v) { phLineChart = v; } });
}

function updateTemperatureChart() {
    const ctx = document.getElementById('chart-history-temp')?.getContext('2d');
    if (!ctx) return;
    createLineChart(ctx, 'Temperature (°C)', 'rgb(239,83,80)', '°C', temperatureHistory, { get chart() { return temperatureLineChart; }, set chart(v) { temperatureLineChart = v; } });
}

function updateTurbidityChart() {
    const ctx = document.getElementById('chart-history-turb')?.getContext('2d');
    if (!ctx) return;
    createLineChart(ctx, 'Turbidity (NTU)', 'rgb(33,150,243)', 'NTU', turbidityHistory, { get chart() { return turbidityLineChart; }, set chart(v) { turbidityLineChart = v; } });
}

function updateSalinityChart() {
    const ctx = document.getElementById('chart-history-sal')?.getContext('2d');
    if (!ctx) return;
    createLineChart(ctx, 'Salinity (ppt)', 'rgb(0,172,193)', 'ppt', salinityHistory, { get chart() { return salinityLineChart; }, set chart(v) { salinityLineChart = v; } });
}

setInterval(updateSensorData, 1000);
</script>

<script>
(function(){
    var animationInput = document.createElement('input');
    animationInput.setAttribute('name', 'animation');
    animationInput.setAttribute('type', 'hidden');
    document.body.append(animationInput);
})();
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function setupSummaryChart() {
        const ctxSummary = document.getElementById('summaryChart')?.getContext('2d');
        if (!ctxSummary) return;

        const labels = [];
        const values = [];
        const colors = [];

        @foreach($staticSensorNames as $sensorKey => $sensorName)
            labels.push('{{ $sensorName }}');
            values.push({{ $sensorData[$sensorKey]['value'] ?? 0 }});
            colors.push(
                '{{ $sensorKey === "phLevel" ? "#7e57c2" : 
                     ($sensorKey === "temperature" ? "#ef5350" :
                     ($sensorKey === "turbidity" ? "#2196f3" :
                     ($sensorKey === "salinity" ? "#00acc1" : "#607d8b"))) }}'
            );
        @endforeach

        summaryChart = new Chart(ctxSummary, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Sensor Summary',
                    data: values,
                    borderColor: '#64b5f6',
                    backgroundColor: 'rgba(100,181,246,0.2)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: colors,
                    pointBorderColor: colors,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.raw}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Value'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Sensor Type'
                        }
                    }
                }
            }
        });
    }

    setTimeout(() => {
        setupSummaryChart();
    }, 100);
});
</script>



</body>
</html>