<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DiagnosisHistory;

class DiagnosisHistoryController extends Controller
{
    public function index()
    {
        $diagnosisHistory = DiagnosisHistory::all();
        return response([
            'length' => count($diagnosisHistory),
            'data' => $diagnosisHistory
        ]);
    }

    public function show($id)
    {
        $diagnosisHistory = DiagnosisHistory::find($id);

        if (!$diagnosisHistory) {
            return response([
                'message' => 'DiagnosisHistory not found!'
            ]);
        }

        return response($diagnosisHistory);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'disease_id'  => 'required | numeric | unique:' . DiagnosisHistory::class
        ]);

        $data = $request->only('disease_id');
        $diagnosisHistory = DiagnosisHistory::create($data);

        return response($diagnosisHistory, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('disease_id');
        $diagnosisHistory = DiagnosisHistory::find($id);

        if (!$diagnosisHistory) {
            return response([
                'message' => 'DiagnosisHistory not found!'
            ]);
        }

        if ($request->has('disease_id') && $request->disease_id != $diagnosisHistory->disease_id) {
            $disease_id = $this->checkDiseaseId($request->disease_id);
            if ($disease_id) {
                return response([
                    'message' => 'Disease_id already taken!'
                ]);
            }
            $data['disease_id'] = $request->disease_id;
        }

        $diagnosisHistory->update($data);

        return response($diagnosisHistory);
    }

    private function checkDisease_id($disease_id)
    {
        $diagnosisHistory = DiagnosisHistory::where('disease_id', $disease_id)->first();
        return $diagnosisHistory;
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