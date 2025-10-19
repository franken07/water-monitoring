<!DOCTYPE html>
<html lang="en">
<!-- Sensor -->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="shortcut icon" href="{{ asset('images/pond/icc.png') }}" type="image/x-icon">
  <title>Sensors</title>

  <!-- ✅ Local Assets (Laravel secured paths) -->
  <link rel="stylesheet" href="{{ asset('assets/web/assets/mobirise-icons2/mobirise2.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/parallax/jarallax.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-grid.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-reboot.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dropdown/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/socicon/css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/animatecss/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/theme/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/sensorcss/sensor.css') }}">
  <link rel="preload" as="style" href="{{ asset('assets/mobirise/css/additional.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/mobirise/css/additional.css') }}" type="text/css">

  <!-- ✅ Secure Google Fonts -->
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;700&display=swap">
  </noscript>

  <!-- ✅ Font Awesome (Latest & Secure) -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2qqK0O5T8v7FpC18VC0Sy0yRyvCb4s46HoPazTA7kGEXd2v2Q=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />

  <!-- ✅ Chart.js, Raphael, and JustGage via HTTPS -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js" integrity="sha384-ZHleAHoYVh4kmqD6qH9vT8t+FTniVDCr6N0Xqj9hbINz2i8pR6VJ3xSm7rWQhKUY" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/raphael@2.3.0/raphael.min.js" integrity="sha384-Lm2pGJQ03lO/vy9T2R2W7UTpDRD5b4jqloN0E6r3A2aywsvbTQmJmD6r5Af0/x+G" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/justgage@1.3.5/justgage.min.js" integrity="sha384-D0xP4Uq02x0g/3yA4TzNfW2mGyF4ZgiFq0gT3Vj2jZgP8yLRR5pEXbRZB+I2By7G" crossorigin="anonymous"></script>
</head>

    
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


<!-- ✅ Secure Local JS Files (auto HTTPS via Laravel asset helper) -->
<script src="{{ asset('assets/parallax/jarallax.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/dropdown/js/navbar-dropdown.js') }}"></script>
<script src="{{ asset('assets/scrollgallery/scroll-gallery.js') }}"></script>
<script src="{{ asset('assets/mbr-switch-arrow/mbr-switch-arrow.js') }}"></script>
<script src="{{ asset('assets/smoothscroll/smooth-scroll.js') }}"></script>
<script src="{{ asset('assets/ytplayer/index.js') }}"></script>
<script src="{{ asset('assets/theme/js/script.js') }}"></script>
<script src="{{ asset('assets/formoid/formoid.min.js') }}"></script>

<!-- ✅ Secure CDN Script with integrity + crossorigin -->
<script 
  src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
  integrity="sha512-QSkVNOCYLtj2aflK4+YVd3Ap6yNcn+GU+e1LZC7sFvUGJ3eG7Q+9VYjF9Y6w5G8h1sF4WzNq0k1+Mgpjv8HU1w==" 
  crossorigin="anonymous" 
  referrerpolicy="no-referrer">
</script>


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
        return { text: "No data available.", severity: "neutral" };
    }

    value = parseFloat(value);

    switch (type) {
        case "phLevel":
            if (value < 6.5) return { text: "⚠️ Water is acidic (low pH).", severity: "danger" };
            if (value > 8.5) return { text: "⚠️ Water is alkaline (high pH).", severity: "danger" };
            return { text: "✅ pH is within safe range.", severity: "good" };
        
        case "temperature":
            if (value < 20) return { text: "⚠️ Too cold — may stress fish.", severity: "warning" };
            if (value > 30) return { text: "⚠️ Too hot — risk of low oxygen.", severity: "danger" };
            return { text: "✅ Temperature is suitable.", severity: "good" };
        
        case "turbidity":
            if (value > 80) return { text: "❌ Extremely turbid — very poor conditions.", severity: "critical" };
            if (value > 50) return { text: "⚠️ High turbidity — blocks sunlight.", severity: "danger" };
            if (value > 20) return { text: "ℹ️ Slightly cloudy but tolerable.", severity: "warning" };
            return { text: "✅ Water is clear.", severity: "good" };
        
        case "salinity":
            if (value < 5) return { text: "⚠️ Low salinity — may stress species.", severity: "danger" };
            if (value > 35) return { text: "⚠️ High salinity — harmful for freshwater fish.", severity: "danger" };
            return { text: "✅ Salinity is within safe range.", severity: "good" };
        
        default:
            return { text: "ℹ️ No interpretation available.", severity: "neutral" };
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

    if (ph >= 6.5 && ph <= 8.5 && temp >= 20 && temp <= 30 && turb <= 20 && sal >= 5 && sal <= 35) {
        return { text: "Water quality is good — suitable for aquatic life.", severity: "good" };
    }

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

// ✅ Unified colors: green = good, orange = warning, red = danger/critical
function styleInterpretation(element, result) {
    const colors = {
        good:    { color: "#2e7d32", border: "#2e7d32", icon: "✔️" },  // green
        warning: { color: "#ff9800", border: "#ff9800", icon: "⚠️" },  // orange
        danger:  { color: "#f44336", border: "#f44336", icon: "⚠️" },  // red
        critical:{ color: "#f44336", border: "#f44336", icon: "❌" },  // red
        neutral: { color: "#607d8b", border: "#607d8b", icon: "…" }    // gray
    };

    const scheme = colors[result.severity] || colors.neutral;
    element.innerText = `${scheme.icon} ${result.text}`;
    element.style.color = scheme.color;

    const card = element.closest('.sensor-card');
    if (card) card.style.border = `2px solid ${scheme.border}`;
}

// ✅ Update Live Data
function updateLiveData() {
    fetch('/sensor/live')
        .then(res => res.json())
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

                    const interpResult = getSingleInterpretation(key, value);
                    if (interpElem) styleInterpretation(interpElem, interpResult);

                    // Arrows
                    if (iconElem) {
                        if (value > 50) {
                            iconElem.className = "fas fa-arrow-right";
                            iconElem.style.color = "#f44336"; // red
                        } else if (value > 20) {
                            iconElem.className = "fas fa-arrow-right";
                            iconElem.style.color = "#ff9800"; // orange
                        } else {
                            iconElem.className = "fas fa-arrow-down";
                            iconElem.style.color = "#2e7d32"; // green
                        }
                    }

                    if (key === "phLevel") ph = value;
                    if (key === "temperature") temp = value;
                    if (key === "turbidity") turb = value;
                    if (key === "salinity") sal = value;

                    if (sensorCharts[key]) {
                        const chart = sensorCharts[key];
                        chart.data.datasets[0].data[0] =
                            value === 'N/A' ? 0 : value;
                        chart.data.datasets[0].backgroundColor[0] =
                            value > 50 ? '#f44336' : value > 20 ? '#ff9800' : '#2e7d32';
                        chart.update();
                    }
                }
            }

            if (summaryChart) {
                @foreach($staticSensorNames as $sensorKey => $sensorName)
                if (data['{{ $sensorKey }}']) {
                    summaryChart.data.datasets[0].data[{{ $loop->index }}] = data['{{ $sensorKey }}'].value ?? 0;
                }
                @endforeach
                summaryChart.update();
            }

            const interpElem = document.getElementById("cross-interpretation");
            if (interpElem) {
                const result = getCrossInterpretation(ph, temp, turb, sal);
                styleInterpretation(interpElem, result);
            }
        });
}

// ✅ Update History Data
function updateHistoryData() {
    fetch('/sensor/live')
        .then(res => res.json())
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

// ✅ Chart Creation
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

// ✅ Chart Updaters
function updatePhChart() {
    const ctx = document.getElementById('chart-history-ph')?.getContext('2d');
    if (!ctx) return;
    createLineChart(ctx, 'pH Level (Live)', 'rgb(46,125,50)', 'pH', phHistory, { get chart() { return phLineChart; }, set chart(v) { phLineChart = v; } });
}
function updateTemperatureChart() {
    const ctx = document.getElementById('chart-history-temp')?.getContext('2d');
    if (!ctx) return;
    createLineChart(ctx, 'Temperature (°C)', 'rgb(46,125,50)', '°C', temperatureHistory, { get chart() { return temperatureLineChart; }, set chart(v) { temperatureLineChart = v; } });
}
function updateTurbidityChart() {
    const ctx = document.getElementById('chart-history-turb')?.getContext('2d');
    if (!ctx) return;
    createLineChart(ctx, 'Turbidity (NTU)', 'rgb(46,125,50)', 'NTU', turbidityHistory, { get chart() { return turbidityLineChart; }, set chart(v) { turbidityLineChart = v; } });
}
function updateSalinityChart() {
    const ctx = document.getElementById('chart-history-sal')?.getContext('2d');
    if (!ctx) return;
    createLineChart(ctx, 'Salinity (ppt)', 'rgb(46,125,50)', 'ppt', salinityHistory, { get chart() { return salinityLineChart; }, set chart(v) { salinityLineChart = v; } });
}

// ✅ Start Intervals
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

<script>
async function exportHistoryToExcel() {
    try {
        // --- Helpers ---
        function parseTimestampToMillis(ts) {
            if (!ts) return NaN;
            if (typeof ts === 'object' && ts.seconds !== undefined)
                return (Number(ts.seconds) * 1000) + (Number(ts.nanoseconds || 0) / 1e6);
            if (ts instanceof Date) return ts.getTime();
            if (typeof ts === 'number') return ts < 1e12 ? ts * 1000 : ts;
            const parsed = Date.parse(ts);
            return isNaN(parsed) ? NaN : parsed;
        }

        function formatMillis(millis) {
            if (isNaN(millis)) return '';
            const d = new Date(millis);
            return `${d.getFullYear()}-${String(d.getMonth()+1).padStart(2,'0')}-${String(d.getDate()).padStart(2,'0')} ` +
                   `${String(d.getHours()).padStart(2,'0')}:${String(d.getMinutes()).padStart(2,'0')}:${String(d.getSeconds()).padStart(2,'0')}`;
        }

        function prepareRows(arr) {
            return (arr || []).slice(-15).map(e => [
                formatMillis(parseTimestampToMillis(e.timestamp)),
                e.value ?? ''
            ]);
        }

        // --- Interpretation ---
        function getInterpretation(sensorName, latestValue) {
            if (latestValue == null || latestValue === '') return "No data";
            switch(sensorName) {
                case "pH Level":
                    if (latestValue < 7) return "Acidic";
                    if (latestValue === 7) return "Neutral";
                    return "Alkaline";
                case "Temperature (°C)":
                    if (latestValue < 20) return "Cold";
                    if (latestValue <= 30) return "Normal";
                    return "Hot";
                case "Turbidity (NTU)":
                    if (latestValue < 5) return "Clear";
                    if (latestValue < 50) return "Slightly Turbid";
                    return "Murky";
                case "Salinity (ppt)":
                    if (latestValue < 5) return "Low";
                    if (latestValue <= 20) return "Medium";
                    return "High";
                default:
                    return "";
            }
        }

        function getInterpretationColor(sensorName, latestValue) {
            if (latestValue == null || latestValue === '') return 'FFB0B0B0';
            switch(sensorName) {
                case "pH Level":
                    if (latestValue >= 6.5 && latestValue <= 8) return 'FF00FF00';
                    if ((latestValue >= 5.5 && latestValue < 6.5) || (latestValue > 8 && latestValue <= 9)) return 'FFFFA500';
                    return 'FFFF0000';
                case "Temperature (°C)":
                    if (latestValue >= 20 && latestValue <= 30) return 'FF00FF00';
                    if ((latestValue >= 15 && latestValue < 20) || (latestValue > 30 && latestValue <= 35)) return 'FFFFA500';
                    return 'FFFF0000';
                case "Turbidity (NTU)":
                    if (latestValue < 5) return 'FF00FF00';
                    if (latestValue >= 5 && latestValue <= 50) return 'FFFFA500';
                    return 'FFFF0000';
                case "Salinity (ppt)":
                    if (latestValue >= 5 && latestValue <= 20) return 'FF00FF00';
                    if ((latestValue >= 3 && latestValue < 5) || (latestValue > 20 && latestValue <= 25)) return 'FFFFA500';
                    return 'FFFF0000';
                default:
                    return 'FFB0B0B0';
            }
        }

        function getInterpretationEmoji(sensorName, latestValue) {
            if (latestValue == null || latestValue === '') return '❔';
            switch(sensorName) {
                case "pH Level":
                    if (latestValue >= 6.5 && latestValue <= 8) return '✅';
                    if ((latestValue >= 5.5 && latestValue < 6.5) || (latestValue > 8 && latestValue <= 9)) return '⚠️';
                    return '❌';
                case "Temperature (°C)":
                    if (latestValue >= 20 && latestValue <= 30) return '✅';
                    if ((latestValue >= 15 && latestValue < 20) || (latestValue > 30 && latestValue <= 35)) return '⚠️';
                    return '❌';
                case "Turbidity (NTU)":
                    if (latestValue < 5) return '✅';
                    if (latestValue >= 5 && latestValue <= 50) return '⚠️';
                    return '❌';
                case "Salinity (ppt)":
                    if (latestValue >= 5 && latestValue <= 20) return '✅';
                    if ((latestValue >= 3 && latestValue < 5) || (latestValue > 20 && latestValue <= 25)) return '⚠️';
                    return '❌';
                default:
                    return '❔';
            }
        }

        // --- Fetch live location ---
        const res = await fetch('/sensor/live-data');
        const data = await res.json();
        const lat = parseFloat(data.latitude.value);
        const lng = parseFloat(data.longitude.value);

        // --- Reverse geocode ---
        const locationRes = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`);
        const locData = await locationRes.json();
        let readableAddress = "Unknown location";
        if (locData && locData.address) {
            const addr = locData.address;
            const parts = [
                addr.city || addr.town || addr.village || addr.hamlet || '',
                addr.state || ''
            ].filter(Boolean);
            readableAddress = parts.join(', ');
        }
        if (readableAddress.length > 30) readableAddress = readableAddress.substring(0, 27) + '...';

        // --- Sensors ---
        const sensors = [
            { name: "pH Level", rows: prepareRows(phHistory), color: "BBDEFB" },
            { name: "Temperature (°C)", rows: prepareRows(temperatureHistory), color: "FFF9C4" },
            { name: "Turbidity (NTU)", rows: prepareRows(turbidityHistory), color: "C8E6C9" },
            { name: "Salinity (ppt)", rows: prepareRows(salinityHistory), color: "FFCDD2" },
        ];
        const maxRows = Math.max(...sensors.map(s => s.rows.length));

        const wb = new ExcelJS.Workbook();
        const ws = wb.addWorksheet('Sensor Data');

        let startCol = 1;
        const spacingBetweenCols = 2;

        // --- Sensor Tables ---
        sensors.forEach(sensor => {
            // Title row
            ws.mergeCells(1, startCol, 1, startCol + 1);
            const titleCell = ws.getCell(1, startCol);
            titleCell.value = sensor.name;
            titleCell.font = { bold: true, color: { argb: '#000000' } };
            titleCell.alignment = { horizontal: 'center' };
            titleCell.fill = { type: 'pattern', pattern: 'solid', fgColor: { argb: sensor.color } };

            // Header row
            ws.getCell(2, startCol).value = 'Timestamp';
            ws.getCell(2, startCol + 1).value = 'Value';
            [ws.getCell(2, startCol), ws.getCell(2, startCol + 1)].forEach(cell => {
                cell.font = { bold: true };
                cell.alignment = { horizontal: 'center' };
                cell.fill = { type: 'pattern', pattern: 'solid', fgColor: { argb: sensor.color } };
                cell.border = { top: { style: 'thin' }, bottom: { style: 'thin' }, left: { style: 'thin' }, right: { style: 'thin' } };
            });

            // Data rows with alternating shading
            sensor.rows.forEach((row, idx) => {
                const r = 3 + idx;
                ws.getCell(r, startCol).value = row[0];
                ws.getCell(r, startCol + 1).value = row[1];
                const fillColor = idx % 2 === 0 ? 'FFFFFFFF' : 'FFF0F0F0';
                [ws.getCell(r, startCol), ws.getCell(r, startCol + 1)].forEach(cell => {
                    cell.fill = { type: 'pattern', pattern: 'solid', fgColor: { argb: fillColor } };
                    cell.border = { top: { style: 'thin' }, bottom: { style: 'thin' }, left: { style: 'thin' }, right: { style: 'thin' } };
                });
            });

            // Location rows
            const locationRow = 3 + maxRows;
            ws.getCell(locationRow, startCol).value = 'Location';
            ws.getCell(locationRow, startCol + 1).value = readableAddress;
            ws.getCell(locationRow + 1, startCol).value = 'Latitude';
            ws.getCell(locationRow + 1, startCol + 1).value = lat;
            ws.getCell(locationRow + 2, startCol).value = 'Longitude';
            ws.getCell(locationRow + 2, startCol + 1).value = lng;
            for (let r = locationRow; r <= locationRow + 2; r++) {
                [ws.getCell(r, startCol), ws.getCell(r, startCol + 1)].forEach(cell => {
                    cell.border = { top: { style: 'thin' }, bottom: { style: 'thin' }, left: { style: 'thin' }, right: { style: 'thin' } };
                    cell.fill = { type: 'pattern', pattern: 'solid', fgColor: { argb: 'FFEFEFEF' } };
                    cell.font = { bold: true };
                });
            }

            // --- Interpretation Row with Emoji ---
            const interpretationRow = locationRow + 3;
            const latestValue = sensor.rows[sensor.rows.length - 1]?.[1];
            ws.getCell(interpretationRow, startCol).value = 'Interpretation';
            ws.getCell(interpretationRow, startCol + 1).value =
                getInterpretationEmoji(sensor.name, latestValue) + ' ' + getInterpretation(sensor.name, latestValue);
            [ws.getCell(interpretationRow, startCol), ws.getCell(interpretationRow, startCol + 1)].forEach(cell => {
                cell.border = { top: { style: 'thin' }, bottom: { style: 'thin' }, left: { style: 'thin' }, right: { style: 'thin' } };
                cell.fill = { type: 'pattern', pattern: 'solid', fgColor: { argb: getInterpretationColor(sensor.name, latestValue) } };
                cell.font = { bold: true };
                cell.alignment = { horizontal: 'center' };
            });

            // Auto-width
            ws.getColumn(startCol).width = Math.max(15, sensor.rows.reduce((max, r) => Math.max(max, r[0]?.length || 0), 0) + 2, readableAddress.length + 2);
            ws.getColumn(startCol + 1).width = Math.max(10, sensor.rows.reduce((max, r) => Math.max(max, r[1]?.toString().length || 0), 0) + 2);

            startCol += 2 + spacingBetweenCols;
        });

        // --- Save Excel ---
        wb.xlsx.writeBuffer().then(buffer => {
            const blob = new Blob([buffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
            saveAs(blob, "sensor_data_report.xlsx");
        });

    } catch (err) {
        console.error(err);
        alert("Failed to export Excel. Check console for details.");
    }
}

document.getElementById("exportHistoryBtn").addEventListener("click", exportHistoryToExcel);
</script>


</body>
</html>