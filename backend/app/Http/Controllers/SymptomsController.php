<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Symptoms;

class SymptomsController extends Controller
{
    public function index()
    {
        $symptoms = Symptoms::all();
        return response([
            'length' => count($symptoms),
            'data' => $symptoms
        ]);
    }

    public function show($id)
    {
        $symptom = Symptoms::find($id);

        if (!$symptom) {
            return response([
                'message' => 'Symptom not found!'
            ]);
        }

        return response($symptom);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code'      => 'required | string | unique:' . Symptoms::class,
            'name'      => 'required | string'
            
        ]);

        $data = $request->only('code', 'name');
        $symptom = Symptoms::create($data);

        return response($symptom, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('code', 'name');
        $symptom = Symptoms::find($id);

        if (!$symptom) {
            return response([
                'message' => 'Symptom not found!'
            ]);
        }

        $symptom->update($data);

        return response($symptom);
    }

    public function destroy($id)
    {
        $symptom = Symptoms::find($id);

        if (!$symptom) {
            return response([
                'message' => 'Symptom not found!'
            ]);
        }

        $symptom->delete();

        return response(['message' => "Symptoms with id: $id deleted!"]);
    }
}