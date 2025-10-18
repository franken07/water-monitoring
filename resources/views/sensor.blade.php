<!DOCTYPE html>
<html lang="en">
    <!-- Sensor -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/pond/icc.png" type="image/x-icon">
    <title>Sensors</title>
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
    <link rel="stylesheet" href="{{ asset('assets/sensorcss/sensor.css') }}">
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
    
</head>
<body>

@include('include.header')

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1 class="dashboard-title"><i class="fas fa-water"></i> Water Monitoring Dashboard</h1>
    </div>

    <div class="dashboard-grid">
<!-- Location Map -->
<div class="sensor-card" style="grid-column: span 2; display: flex; flex-direction: column; gap: 10px;">
    <div class="sensor-name" style="display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center;">
            <i class="fas fa-map-marker-alt" style="margin-right: 8px; color: var(--primary-color);"></i>
            <span>Monitoring Location</span>
        </div>
        <!-- Dynamic location display -->
        <div id="location" style="font-weight: 1000; color: var(--primary-color); font-size: 20px;">
            Loading location...
        </div>
    </div>

    <div id="map" style="width: 100%; height: 400px; border-radius: 8px; overflow: hidden;"></div>
</div>

<!-- Summary Chart Card -->
<div class="sensor-card" style="grid-column: span 2;">
    <div class="sensor-name">
        <i class="fas fa-chart-pie" style="margin-right: 8px; color: var(--primary-color);"></i>
        Sensor Summary Overview
    </div>

    <!-- Chart -->
    <div class="chart-container"
         style="height: 300px; position: relative; margin-bottom: 60px;">
        <canvas id="summaryChart"></canvas>
    </div>

    <!-- Cross Interpretation -->
    <div id="cross-interpretation"
         style="padding: 10px 14px; font-size: 14px; font-weight: 600;
                border-radius: 8px; text-align: center;
                transition: background-color .25s, color .25s;
                max-width: 95%; margin: 0 auto;">
        Analyzing combined sensor data...
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

        <!-- Interpretation (per sensor) -->
<div class="sensor-interpretation" id="{{ $sensorKey }}-interpretation"
     style="margin-top: 6px; font-style: italic; color: var(--text-secondary);">
    Interpreting data...
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


@else
    <div class="sensor-card" style="grid-column: span 2;">
        <p style="text-align: center; color: var(--danger-color); font-size: 16px;">
            <i class="fas fa-exclamation-triangle"></i> No sensor data available
        </p>
    </div>
@endif
    </div>
</div>

<div style="margin-top:     0px; grid-column: span 2; text-align: center;">
    <button id="exportHistoryBtn" class="btn btn-success">
        <i class="fas fa-file-excel"></i> Export History to Excel
    </button>
</div>


<!--footer -->
<section class="footer3 cid-u3GZCsJlbC" once="footers" id="footer-3-u3GZCsJlbC">
    <div class="container">
        <div class="row">
          <p class="mbr-fonts-style copyright display-1">
            SECURE WATER QUALITY MONITORING SYSTEM
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

// History arrays
let phHistory = JSON.parse(localStorage.getItem("phHistory")) || [];
let temperatureHistory = JSON.parse(localStorage.getItem("temperatureHistory")) || [];
let turbidityHistory = JSON.parse(localStorage.getItem("turbidityHistory")) || [];
let salinityHistory = JSON.parse(localStorage.getItem("salinityHistory")) || [];

let phLineChart = null;
let temperatureLineChart = null;
let turbidityLineChart = null;
let salinityLineChart = null;

function saveHistoryToLocalStorage() {
    localStorage.setItem("phHistory", JSON.stringify(phHistory));
    localStorage.setItem("temperatureHistory", JSON.stringify(temperatureHistory));
    localStorage.setItem("turbidityHistory", JSON.stringify(turbidityHistory));
    localStorage.setItem("salinityHistory", JSON.stringify(salinityHistory));
}

// ✅ Per-Sensor Interpretation Logic
function getSingleInterpretation(type, value) {
    if (value === null || value === undefined || value === 'N/A' || value === '') {
        return "No data available.";
    }

    value = parseFloat(value);

    switch (type) {
        case "phLevel":
            if (value < 6.5) return "⚠️ Water is acidic (low pH).";
            if (value > 8.5) return "⚠️ Water is alkaline (high pH).";
            return "✅ pH is within safe range.";
        
        case "temperature":
            if (value < 20) return "⚠️ Too cold — may stress fish.";
            if (value > 30) return "⚠️ Too hot — risk of low oxygen.";
            return "✅ Temperature is suitable.";
        
        case "turbidity":
            if (value > 80) return "❌ Extremely turbid — very poor conditions.";
            if (value > 50) return "⚠️ High turbidity — blocks sunlight.";
            if (value > 20) return "ℹ️ Slightly cloudy but tolerable.";
            return "✅ Water is clear.";
        
        case "salinity":
            if (value < 5) return "⚠️ Low salinity — may stress species.";
            if (value > 35) return "⚠️ High salinity — harmful for freshwater fish.";
            return "✅ Salinity is within safe range.";
        
        default:
            return "ℹ️ No interpretation available.";
    }
}

// ✅ Cross Interpretation Logic
function getCrossInterpretation(ph, temp, turb, sal) {
    if ([ph, temp, turb, sal].some(v => v === null || v === undefined || v === 'N/A' || v === '')) {
        return { text: "Not enough data to generate interpretation", severity: "neutral" };
    }

    ph = parseFloat(ph);
    temp = parseFloat(temp);
    turb = parseFloat(turb);
    sal = parseFloat(sal);

    // ✅ Ideal condition
    if (ph >= 6.5 && ph <= 8.5 && temp >= 20 && temp <= 30 && turb <= 20 && sal >= 5 && sal <= 35) {
        return { text: "Water quality is good — suitable for aquatic life.", severity: "good" };
    }

    // 🚨 Complex cross-conditions
    if (temp > 30 && sal > 35 && turb > 50) {
        return { text: "High temp + salinity + turbidity — prone to algae bloom, oxygen depletion likely.", severity: "critical" };
    }
    if (temp > 30 && turb > 50) {
        return { text: "High temp + turbidity — low oxygen levels, fish stress likely.", severity: "danger" };
    }
    if (ph < 6.5 && sal > 35) {
        return { text: "Acidic + high salinity — harmful for freshwater species, risk of fish kills.", severity: "danger" };
    }
    if (ph > 8.5 && turb > 50) {
        return { text: "Alkaline + cloudy water — reduced light penetration, poor plant growth.", severity: "danger" };
    }
    if (temp > 30 && sal > 35) {
        return { text: "Hot + saline water — stressful for fish, risk of gill damage.", severity: "danger" };
    }
    if (temp > 30 && ph > 8.5) {
        return { text: "Warm + alkaline water — may accelerate ammonia toxicity.", severity: "danger" };
    }
    if (sal > 40 && turb > 50) {
        return { text: "Salty + turbid water — harsh for aquatic life.", severity: "danger" };
    }

    // 🟡 Single-parameter warnings
    if (turb > 80) {
        return { text: "Extremely turbid — very poor for aquatic life.", severity: "critical" };
    }
    if (sal > 40) {
        return { text: "Very high salinity — freshwater species cannot survive.", severity: "danger" };
    }
    if (temp > 35) {
        return { text: "Excessive heat — oxygen depletion likely.", severity: "danger" };
    }
    if (ph < 6.0) {
        return { text: "Highly acidic — corrosive and harmful for organisms.", severity: "danger" };
    }
    if (ph > 9.0) {
        return { text: "Highly alkaline — may cause ammonia toxicity.", severity: "danger" };
    }

    return { text: "Some parameters outside optimal range — monitor closely.", severity: "warning" };
}

// ✅ Style interpretation box with severity
function styleInterpretation(element, result) {
    let colors = {
        good:   { color: "#2e7d32", bg: "#c8e6c9", icon: "✔️" },
        warning:{ color: "#01579b", bg: "#bbdefb", icon: "ℹ️" },
        danger: { color: "#e65100", bg: "#ffe0b2", icon: "⚠️" },
        critical:{ color: "#b71c1c", bg: "#ffcdd2", icon: "❌" },
        neutral:{ color: "#607d8b", bg: "#eceff1", icon: "…" }
    };

    let scheme = colors[result.severity] || colors.neutral;
    element.innerText = `${scheme.icon} ${result.text}`;
    element.style.color = scheme.color;
    element.style.backgroundColor = scheme.bg;
}

// ✅ Update ONLY Live Data (cards & gauges)
function updateLiveData() {
    fetch('/sensor/live')
        .then(response => response.json())
        .then(data => {
            let ph = null, temp = null, turb = null, sal = null;

            for (const key in data) {
                if (data[key]) {
                    const value = data[key].value ?? 'N/A';
                    const timestamp = data[key].timestamp ?? 'No Data';

                    const valueElem = document.getElementById(`${key}-value`);
                    const timeElem = document.getElementById(`${key}-timestamp`);
                    const interpElem = document.getElementById(`${key}-interpretation`);
                    const iconElem = document.getElementById(`${key}-icon`);

                    if (valueElem) valueElem.innerText = value;
                    if (timeElem) timeElem.innerHTML = `<i class="far fa-clock"></i> ${timestamp}`;

                    // ✅ Per-sensor live interpretation
                    if (interpElem) interpElem.innerText = getSingleInterpretation(key, value);

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

                    // Save values for interpretation
                    if (key === "phLevel") ph = value;
                    if (key === "temperature") temp = value;
                    if (key === "turbidity") turb = value;
                    if (key === "salinity") sal = value;

                    // Update individual gauge charts (not history)
                    if (sensorCharts[key]) {
                        const chart = sensorCharts[key];
                        chart.data.datasets[0].data[0] = value;
                        chart.data.datasets[0].backgroundColor[0] =
                            value > 80 ? '#f44336' :
                            value > 50 ? '#ff9800' : '#4caf50';
                        chart.update();
                    }
                }
            }

            // ✅ Update summary chart
            if (summaryChart) {
                @foreach($staticSensorNames as $sensorKey => $sensorName)
                if (data['{{ $sensorKey }}']) {
                    summaryChart.data.datasets[0].data[{{ $loop->index }}] = data['{{ $sensorKey }}'].value ?? 0;
                }
                @endforeach
                summaryChart.update();
            }

            // ✅ Update Cross Interpretation
            let interpElem = document.getElementById("cross-interpretation");
            if (interpElem) {
                let result = getCrossInterpretation(ph, temp, turb, sal);
                styleInterpretation(interpElem, result);
            }
        });
}

// ✅ Update ONLY History Data
function updateHistoryData() {
    fetch('/sensor/live')
        .then(response => response.json())
        .then(data => {
            for (const key in data) {
                if (data[key]) {
                    const value = parseFloat(data[key].value ?? 0);
                    const timestamp = data[key].timestamp ?? 'No Data';

                    if (key === 'phLevel') {
                        phHistory.push({ value, timestamp });
                        if (phHistory.length > 10) phHistory.shift();
                        updatePhChart();
                    } else if (key === 'temperature') {
                        temperatureHistory.push({ value, timestamp });
                        if (temperatureHistory.length > 100) temperatureHistory.shift();
                        updateTemperatureChart();
                    } else if (key === 'turbidity') {
                        turbidityHistory.push({ value, timestamp });
                        if (turbidityHistory.length > 100) turbidityHistory.shift();
                        updateTurbidityChart();
                    } else if (key === 'salinity') {
                        salinityHistory.push({ value, timestamp });
                        if (salinityHistory.length > 100) salinityHistory.shift();
                        updateSalinityChart();
                    }
                }
            }
            saveHistoryToLocalStorage();
        });
}

// ✅ Chart creation (show last 10)
function createLineChart(ctx, label, color, unit, historyArray, chartRef) {
    const last10 = historyArray.slice(-10);
    const labels = last10.map(e => e.timestamp);
    const values = last10.map(e => e.value);

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

// ✅ Chart updaters
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

// ✅ Start intervals
updateLiveData();
updateHistoryData();
setInterval(updateLiveData, 1000);
setInterval(updateHistoryData, 10000);
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


<!-- map  script -->
<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Default coordinates
    let lat = 16.076983;
    let lng = 120.386907;

    // Initialize map
    const map = L.map('map').setView([lat, lng], 19);

    // Add ESRI World Imagery (high-res satellite) tiles
    L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, NASA, USGS, etc.',
        maxZoom: 19
    }).addTo(map);

    // Add marker
    const marker = L.marker([lat, lng]).addTo(map);

    // Function to get concise location name
    async function getLocationName(lat, lng) {
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&addressdetails=1`);
            const data = await response.json();
            const addr = data.address;

            const town = addr.city || addr.town || addr.village || addr.hamlet || '';
            const province = addr.state || '';
            const region = addr.region || addr.county || '';
            const postcode = addr.postcode || '';
            const country = addr.country || '';

            return [town, province, region, postcode, country].filter(Boolean).join(', ');
        } catch (err) {
            console.error('Error reverse geocoding:', err);
            return `${lat.toFixed(5)}, ${lng.toFixed(5)}`;
        }
    }

    // Update map, marker, and location
    async function updateMap() {
        try {
            const res = await fetch('/sensor/live-data');
            const data = await res.json();

            const newLat = parseFloat(data.latitude.value);
            const newLng = parseFloat(data.longitude.value);

            // Update marker & map view
            marker.setLatLng([newLat, newLng]);
            map.setView([newLat, newLng], map.getZoom());

            // Update location name
            const locationName = await getLocationName(newLat, newLng);
            document.getElementById('location').innerText = locationName;

        } catch (err) {
            console.error('Error fetching sensor data:', err);
        }
    }

    // Initial update & interval
    updateMap();
    setInterval(updateMap, 5000); // Update every 5 seconds
});
</script>


<script>
function exportHistoryToCSV() {
    let csvRows = [];

    // Parse different timestamp shapes into milliseconds since epoch.
    function parseTimestampToMillis(ts) {
        if (ts == null) return NaN;

        // Firebase-like object { seconds: ..., nanoseconds: ... }
        if (typeof ts === 'object' && ts.seconds !== undefined) {
            return (Number(ts.seconds) * 1000) + (Number(ts.nanoseconds || 0) / 1e6);
        }

        // If it's already a Date object
        if (ts instanceof Date) return ts.getTime();

        // If numeric
        if (typeof ts === 'number') {
            // If looks like seconds (10 digits) convert to ms
            if (ts < 1e12) return ts * 1000;
            // if already ms (13+ digits)
            return ts;
        }

        // If string, try parsing ISO or other date string
        const parsed = Date.parse(ts);
        if (!isNaN(parsed)) return parsed;

        // Fallback: NaN
        return NaN;
    }

    // Format millis -> YYYY-MM-DD HH:mm:ss (24h)
    function formatMillis(millis) {
        if (isNaN(millis)) return ''; // unknown
        const d = new Date(millis);
        const Y = d.getFullYear();
        const M = String(d.getMonth() + 1).padStart(2, '0');
        const D = String(d.getDate()).padStart(2, '0');
        const h = String(d.getHours()).padStart(2, '0');
        const m = String(d.getMinutes()).padStart(2, '0');
        const s = String(d.getSeconds()).padStart(2, '0');
        return `${Y}-${M}-${D} ${h}:${m}:${s}`;
    }

    // Adds a sensor block; limits to 15 latest entries
    function addHistoryBlock(sensorName, historyArray) {
        csvRows.push([sensorName]);
        csvRows.push(["Timestamp", "Value"]);

        if (!Array.isArray(historyArray) || historyArray.length === 0) {
            csvRows.push(['', '']);
            csvRows.push([]);
            return;
        }

        // ✅ Limit to last 15 entries
        const limitedHistory = historyArray.slice(-15);

        // Convert all timestamps to millis
        const millisArr = limitedHistory.map(e => parseTimestampToMillis(e.timestamp));

        // Detect if all timestamps are the same
        const uniqueSet = new Set(millisArr.map(x => (isNaN(x) ? `__NaN_${Math.random()}` : x)));
        const allSame = uniqueSet.size === 1;

        let baseMillis = millisArr.find(x => !isNaN(x));
        if (allSame) {
            if (isNaN(baseMillis)) baseMillis = Date.now();
        }

        const fallbackIncrementMs = 1000; // 1 second

        limitedHistory.forEach((entry, idx) => {
            let finalMillis;
            if (!allSame) {
                finalMillis = millisArr[idx];
            } else {
                finalMillis = baseMillis + (idx * fallbackIncrementMs);
            }

            const timeStr = formatMillis(finalMillis);
            const valueStr = (entry.value === undefined || entry.value === null) ? '' : String(entry.value);
            csvRows.push([timeStr, valueStr]);
        });

        csvRows.push([]); // spacing row
    }

    // ✅ Only export the latest 15 per sensor
    addHistoryBlock("pH Level", phHistory);
    addHistoryBlock("Temperature (°C)", temperatureHistory);
    addHistoryBlock("Turbidity (NTU)", turbidityHistory);
    addHistoryBlock("Salinity (ppt)", salinityHistory);

    // Build CSV
    function csvSafe(val) {
        if (val == null) return '';
        const s = String(val);
        if (s.includes(',') || s.includes('"') || s.includes('\n')) {
            return `"${s.replace(/"/g, '""')}"`;
        }
        return s;
    }

    let csvContent = "data:text/csv;charset=utf-8," 
        + csvRows.map(row => row.map(csvSafe).join(",")).join("\n");

    let encodedUri = encodeURI(csvContent);
    let link = document.createElement("a");
    link.href = encodedUri;
    link.download = "sensor_history.csv";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

document.getElementById("exportHistoryBtn")
    .addEventListener("click", exportHistoryToCSV);
</script>




</body>
</html>