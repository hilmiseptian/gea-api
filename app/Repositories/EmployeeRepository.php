<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
  public function all()
  {
    return Employee::orderBy('id', 'desc')->paginate(8);
  }

  public function find($id)
  {
    return Employee::findOrFail($id);
  }

  public function create(array $data)
  {
    return Employee::create($data);
  }

  public function update(Employee $employee, array $data)
  {
    $employee->update($data);
    return $employee;
  }

  public function delete(Employee $employee)
  {
    return $employee->delete();
  }
}
