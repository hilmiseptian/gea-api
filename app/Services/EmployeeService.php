<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;
use App\Models\Employee;
use Illuminate\Validation\ValidationException;

class EmployeeService
{
  protected $repository;

  public function __construct(EmployeeRepository $repository)
  {
    $this->repository = $repository;
  }

  public function getAll()
  {
    return $this->repository->all();
  }

  public function getById($id)
  {
    return $this->repository->find($id);
  }

  public function create(array $data)
  {
    return $this->repository->create($data);
  }

  public function update($id, array $data)
  {
    $employee = Employee::findOrFail($id);
    return $this->repository->update($employee, $data);
  }

  public function delete($id)
  {
    $employee = Employee::findOrFail($id);
    return $this->repository->delete($employee);
  }
}
