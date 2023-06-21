<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function store(Request $request)
    {
        $employee = Employee::create([
            'name' => $request->input('name')
        ]);

        return response()->json([
            'data' => $employee
        ], 201);
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return response()->json([
            'data' => $employee
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->name = $request->input('name');
        $employee->save();

        return response()->json([
            'data' => $employee
        ], 200);
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json(null, 204);
    }
}