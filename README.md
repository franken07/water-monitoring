# IoT Smart Water Quality Monitoring System (SWQMS)

## Overview
The **Smart Water Quality Monitoring System (SWQMS)** is an Internet of Things (IoT) project designed to monitor the water quality of fishponds in real-time. The system captures key water parameters, including **pH level, temperature, dissolved oxygen, and turbidity**, and transmits the data wirelessly for remote monitoring and analysis.

This project is aimed at enhancing aquaculture efficiency, ensuring water safety for fish health, and providing automated real-time alerts for abnormal water conditions.

---

## Features
- **Real-Time Monitoring:** Continuous measurement of water parameters.
- **Wireless Data Transmission:** Utilizes Wi-Fi to send data to a Laravel-based web application.
- **User-Friendly Dashboard:** Visualizes data with charts, gauges, and historical trends.
- **Automated Alerts:** Notifies users if water parameters exceed safe levels.
- **Secure Access:** Authentication integrated with Firebase for user management.
- **Data Logging:** Historical data stored for trend analysis and reporting.

---

## System Architecture
1. **Sensors:**
   - **pH Sensor** – Measures the acidity/alkalinity of water.
   - **Temperature Sensor** – Monitors water temperature.
   - **Dissolved Oxygen Sensor** – Measures oxygen levels critical for fish survival.
   - **Turbidity Sensor** – Assesses water clarity.
   
2. **Microcontroller:** ESP8266/ESP32 or equivalent for sensor data acquisition and Wi-Fi connectivity.

3. **Backend:** Laravel web application for receiving, storing, and visualizing sensor data.

4. **Database:** Firebase Realtime Database for real-time data storage and retrieval.

5. **Frontend Dashboard:** Displays sensor readings using interactive charts, gauges, and tables.

---

## Technologies Used
- **Hardware:** ESP32 / ESP8266, sensors for pH, temperature, dissolved oxygen, and turbidity
- **Backend:** PHP, Laravel Framework
- **Database:** Firebase Realtime Database
- **Frontend:** Blade templates, Chart.js, Bootstrap
- **Authentication:** Firebase Authentication
- **Hosting/Deployment:** [Specify hosting platform if deployed, e.g., Render, Heroku, or local server]

---

## Installation & Setup

### Hardware
1. Connect sensors to the microcontroller following the provided wiring diagram.
2. Flash the microcontroller firmware to read sensor data and send it via Wi-Fi.

### Software
1. Clone this repository:
   ```bash
   git clone https://github.com/yourusername/swqms.git
