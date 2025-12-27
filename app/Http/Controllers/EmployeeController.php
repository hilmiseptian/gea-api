<?php

namespace App\Http\Controllers;

use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
  protected $service;

  public function __construct(EmployeeService $service)
  {
    $this->service = $service;
  }

  public function index()
  {
    return response()->json($this->service->getAll());
  }

  public function show($id)
  {
    return response()->json([
      'message' => 'Success',
      'data' => $this->service->getById($id)
    ], 200);
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'name' => 'required|string|max:255',
      'position' => 'required|string|max:255',
      'department' => 'required|string|max:255',
      'salary' => 'required|numeric|min:0',
      'hire_date' => 'required|date',
    ]);

    $employee = $this->service->create($data);
    return response()->json($employee, 201);
  }

  public function update(Request $request, $id)
  {
    $data = $request->validate([
      'name' => 'sometimes|string|max:255',
      'position' => 'sometimes|string|max:255',
      'department' => 'sometimes|string|max:255',
      'status' => 'sometimes|string|max:255',
      'salary' => 'sometimes|numeric|min:0',
      'hire_date' => 'sometimes|date',
    ]);

    $employee = $this->service->update($id, $data);
    return response()->json($employee);
  }

  public function destroy($id)
  {
    $this->service->delete($id);
    return response()->json(['message' => 'Employee deleted successfully']);
  }
}
