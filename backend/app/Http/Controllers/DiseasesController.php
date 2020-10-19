<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Diseases;

class DiseasesController extends Controller
{
    public function index()
    {
        $diseases = Diseases::all();
        return response([
            'length' => count($diseases),
            'data' => $diseases
        ]);
    }

    public function show($id)
    {
        $disease = Diseases::find($id);

        if (!$disease) {
            return response([
                'message' => 'Disease not found!'
            ]);
        }

        return response($disease);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code'      => 'required | string | unique:' . Diseases::class,
            'name'      => 'required | string',
            'solution'  => 'required | string'
        ]);

        $data = $request->only('code', 'name', 'solution');
        $disease = Diseases::create($data);

        return response($disease, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('code', 'name', 'solution');
        $disease = Diseases::find($id);

        if (!$disease) {
            return response([
                'message' => 'Disease not found!'
            ]);
        }

        if ($request->has('code') && $request->code != $disease->code) {
            $code = $this->checkCode($request->code);
            if ($code) {
                return response([
                    'message' => 'Code already taken!'
                ]);
            }
            $data['code'] = $request->code;
        }

        $disease->update($data);

        return response($disease);
    }

    private function checkCode($code)
    {
        $disease = Diseases::where('code', $code)->first();
        return $disease;
    }

    public function destroy($id)
    {
        $disease = Diseases::find($id);

        if (!$disease) {
            return response([
                'message' => 'Disease not found!'
            ]);
        }

        $disease->delete();

        return response(['message' => "Diseases with id: $id deleted!"]);
    }
}