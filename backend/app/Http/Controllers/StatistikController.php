<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Diseases;
use App\Symptoms;
use App\DiagnosisHistory;

class StatistikController extends Controller
{
    public function statistik()
    {
        $users = User::count();
        $diseases = Diseases::count();
        $symptoms = Symptoms::count();
        $diagnosis = DiagnosisHistory::count();
        $diagnosisHealthy = DiagnosisHistory::where('disease_id', 9)->count();
        $diagnosisSick = DiagnosisHistory::where('disease_id', '!=', 9)->count();

        return response([
            'users'             => $users,
            'diseases'          => $diseases,
            'symptoms'          => $symptoms,
            'diagnosis'         => $diagnosis,
            'diagnosisHealthy'  => $diagnosisHealthy,
            'diagnosisSick'     => $diagnosisSick
        ]);
    }
}