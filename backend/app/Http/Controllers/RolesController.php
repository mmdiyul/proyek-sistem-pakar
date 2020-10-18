<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Roles;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Roles::all();
        return response([
            'length' => count($roles),
            'data' => $roles
        ]);
    }

    public function show($id)
    {
        $role = Roles::find($id);

        if (!$role) {
            return response([
                'message' => 'Role not found!'
            ]);
        }

        return response($role);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code'      => 'required | string | unique:' . Roles::class,
            'name'      => 'required | string',
            'priority'  => 'required | numeric | unique:' . Roles::class
        ]);

        $data = $request->only('code', 'name', 'priority');
        $role = Roles::create($data);

        return response($role, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('code', 'name', 'priority');
        $role = Roles::find($id);

        if (!$role) {
            return response([
                'message' => 'Role not found!'
            ]);
        }

        if ($request->has('code') && $request->code != $role->code) {
            $code = $this->checkCode($request->code);
            if ($code) {
                return response([
                    'message' => 'Code already taken!'
                ]);
            }
            $data['code'] = $request->code;
        }

        $role->update($data);

        return response($role);
    }

    private function checkCode($code)
    {
        $role = Roles::where('code', $code)->first();
        return $role;
    }

    public function destroy($id)
    {
        $role = Roles::find($id);

        if (!$role) {
            return response([
                'message' => 'Role not found!'
            ]);
        }

        $role->delete();

        return response(['message' => "Roles with id: $id deleted!"]);
    }
}