<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;

class SensorController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function index()
    {
        $sensorData = $this->firebase->getSensorData() ?? [];
    
        // Static sensor names
        $staticSensorNames = [
            'phLevel' => 'pH Level',
            'salinity' => 'Salinity',
            'temperature' => 'Temperature',
            'turbidity' => 'Turbidity',
        ];
    
        return view('sensor', compact('sensorData', 'staticSensorNames'));
    }
    public function liveData()
{
    $sensorData = $this->firebase->getSensorData() ?? [];

    return response()->json($sensorData);
}
}
