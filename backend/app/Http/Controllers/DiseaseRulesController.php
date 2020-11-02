<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Symptoms;
use App\DiseaseRules;
use App\DiseaseRulesSymptoms;

class DiseaseRulesController extends Controller
{
    public function index()
    {
        $diseaseRules = DiseaseRules::all();

        $diseaseRules->load('disease', 'symptoms');

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

        $diseaseRule->load('disease', 'symptoms');

        return response($diseaseRule);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'disease_id'=> 'required | numeric | unique:' . DiseaseRules::class,
            'code'      => 'required | string | unique:' . DiseaseRules::class,
            'symptoms'  => 'required | array',
            'symptoms.*'=> 'required | numeric | exists:' . Symptoms::class . ',id'
        ]);

        $data = $request->only('code', 'disease_id');
        $diseaseRule = DiseaseRules::create($data);

        if ($request->symptoms) {
            foreach ($request->symptoms as $symptoms) {
                $payload = [
                    'disease_rule_id'   => $diseaseRule->id,
                    'symptoms_id'       => $symptoms
                ];

                DiseaseRulesSymptoms::create($payload);
            }
        }

        $diseaseRule->load('disease', 'symptoms');

        return response($diseaseRule, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('code', 'disease_id');
        $diseaseRule = DiseaseRules::find($id);

        if (!$diseaseRule) {
            return response([
                'message' => 'DiseaseRule not found!'
            ]);
        }

        if ($request->has('code') && $request->code != $diseaseRule->code) {
            $code = $this->checkCode($request->code);
            if ($code) {
                return response([
                    'message' => 'Code already taken!'
                ]);
            }
            $data['code'] = $request->code;
        }

        $diseaseRule->update($data);

        if ($request->symptoms) {
            DiseaseRulesSymptoms::where('disease_rule_id', $diseaseRule->id)->delete();

            foreach ($request->symptoms as $symptoms) {
                $payload = [
                    'disease_rule_id'   => $diseaseRule->id,
                    'symptoms_id'       => $symptoms
                ];

                DiseaseRulesSymptoms::create($payload);
            }
        }

        $diseaseRule->load('disease', 'symptoms');

        return response($diseaseRule);
    }

    private function checkCode($code)
    {
        $diseaseRule = DiseaseRules::where('code', $code)->first();
        return $diseaseRule;
    }

    public function destroy($id)
    {
        $diseaseRule = DiseaseRules::find($id);

        if (!$diseaseRule) {
            return response([
                'message' => 'DiseaseRules not found!'
            ]);
        }

        $diseaseRule->delete();

        return response(['message' => "DiseaseRules with id: $id deleted!"]);
    }
}