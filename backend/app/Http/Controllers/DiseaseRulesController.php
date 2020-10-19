<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DiseaseRules;

class DiseaseRulesController extends Controller
{
    public function index()
    {
        $diseaseRules = DiseaseRules::all();
        return response([
            'length' => count($diseaseRules),
            'data' => $diseaseRules
        ]);
    }

    public function show($id)
    {
        $diseaseRule = DiseaseRules::find($id);

        if (!$diseaseRule) {
            return response([
                'message' => 'DiseaseRule not found!'
            ]);
        }

        return response($diseaseRule);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'disease_id'  => 'required | numeric | unique:' . DiseaseRules::class
        ]);

        $data = $request->only('disease_id');
        $diseaseRule = DiseaseRules::create($data);

        return response($diseaseRule, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('disease_id');
        $diseaseRule = DiseaseRules::find($id);

        if (!$diseaseRule) {
            return response([
                'message' => 'DiseaseRule not found!'
            ]);
        }

        if ($request->has('disease_id') && $request->disease_id != $diseaseRule->disease_id) {
            $disease_id = $this->checkDiseaseId($request->disease_id);
            if ($disease_id) {
                return response([
                    'message' => 'Disease_id already taken!'
                ]);
            }
            $data['disease_id'] = $request->disease_id;
        }

        $diseaseRule->update($data);

        return response($diseaseRule);
    }

    private function checkDisease_id($disease_id)
    {
        $diseaseRule = DiseaseRules::where('disease_id', $disease_id)->first();
        return $diseaseRule;
    }

    public function destroy($id)
    {
        $diseaseRule = DiseaseRules::find($id);

        if (!$diseaseRule) {
            return response([
                'message' => 'DiseaseRule not found!'
            ]);
        }

        $diseaseRule->delete();

        return response(['message' => "DiseaseRules with id: $id deleted!"]);
    }
}