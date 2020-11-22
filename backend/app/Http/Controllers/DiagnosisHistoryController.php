<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\DiagnosisHistorySymptoms;
use App\DiagnosisHistory;
use App\Diseases;
use App\Symptoms;
use App\User;

class DiagnosisHistoryController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->user->id;
        $rolePriority = User::find($userId)->load('role')->role->priority;
        
        if ($rolePriority > 0) {
            $diagnosisHistory = DiagnosisHistory::where('created_by', $userId)->get();
        } else {
            $diagnosisHistory = DiagnosisHistory::all();
        }

        $diagnosisHistory->load('disease', 'symptoms_diagnosis_history', 'symptoms');

        return response([
            'length' => count($diagnosisHistory),
            'data' => $diagnosisHistory
        ]);
    }

    public function show($id)
    {
        $diagnosisHistory = DiagnosisHistory::find($id);

        $diagnosisHistory->load('disease', 'symptoms_diagnosis_history', 'symptoms');

        if (!$diagnosisHistory) {
            return response([
                'message' => 'DiagnosisHistory not found!'
            ]);
        }

        $diagnosisHistory->symptoms_data = $diagnosisHistory->symptoms;
        $symptoms = [];

        foreach ($diagnosisHistory->symptoms as $symp) {
            $symptoms[] = $symp['id'];
        }

        unset($diagnosisHistory->symptoms);
        
        $diagnosisHistory->symptoms = $symptoms;

        return response($diagnosisHistory);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'symptoms'      => 'required | array',
            'symptoms.*'    => 'required | numeric | exists:' . Symptoms::class . ',id'
        ]);

        $knnResult = HTTP::post('http://localhost:5000/knn', $request->all());
        $diseaseId = $knnResult->json();

        $data['disease_id'] = $diseaseId;
        $data['created_by'] = $request->user->id;
        $diagnosisHistory = DiagnosisHistory::create($data);

        if ($request->symptoms) {
            foreach ($request->symptoms as $symptoms) {
                $payload = [
                    'diagnosis_history_id'  => $diagnosisHistory->id,
                    'symptoms_id'           => $symptoms
                ];

                DiagnosisHistorySymptoms::create($payload);
            }
        }

        $diagnosisHistory->load('disease', 'symptoms_diagnosis_history', 'symptoms');

        return response($diagnosisHistory, 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'symptoms'      => 'required | array',
            'symptoms.*'    => 'required | numeric | exists:' . Symptoms::class . ',id'
        ]);

        $knnResult = HTTP::post('http://localhost:5000/knn', $request->all());
        $diseaseId = $knnResult->json();

        $data['disease_id'] = $diseaseId;
        $diagnosisHistory = DiagnosisHistory::find($id);

        if (!$diagnosisHistory) {
            return response([
                'message' => 'DiagnosisHistory not found!'
            ]);
        }
        $diagnosisHistory->update($data);

        if ($request->symptoms) {
            DiagnosisHistorySymptoms::where('diagnosis_history_id', $diagnosisHistory->id)->delete();
            foreach ($request->symptoms as $symptoms) {
                $payload = [
                    'diagnosis_history_id'  => $diagnosisHistory->id,
                    'symptoms_id'           => $symptoms
                ];

                DiagnosisHistorySymptoms::create($payload);
            }
        }

        $diagnosisHistory->load('disease', 'symptoms_diagnosis_history', 'symptoms');

        return response($diagnosisHistory);
    }

    public function destroy($id)
    {
        $diagnosisHistory = DiagnosisHistory::find($id);

        if (!$diagnosisHistory) {
            return response([
                'message' => 'DiagnosisHistory not found!'
            ]);
        }

        $diagnosisHistory->delete();

        return response(['message' => "DiagnosisHistory with id: $id deleted!"]);
    }
}