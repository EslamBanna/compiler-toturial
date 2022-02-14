<?php

namespace App\Http\Controllers;

use App\Models\Dpartment;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class DepartmentContoller extends Controller
{
    use GeneralTrait;
    public function insertDepartment(Request $request)
    {
        try {
            Dpartment::create([
                'mall_id' => $request->mall_id,
                'name' => $request->name,
                'description' => $request->description,
                'note' => $request->note
            ]);
            return $this->returnSuccessMessage('inserted successfully');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }
    public function getDepartment($departmentId)
    {
        try {
            $department = Dpartment::with('mall')->find($departmentId);
            if (!$department) {
                return $this->returnError(202, 'this department is not founded');
            }
            return $this->returnData('data', $department);
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function getDepartments()
    {
        try {
            $departments = Dpartment::with(['mall' => function ($q) {
                $q->select('id', 'name');
            }])->get();
            return $this->returnData('data', $departments);
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function updateDepartment($departmentId, Request $request)
    {
        try {
            $department = Dpartment::with('mall')->find($departmentId);
            if (!$department) {
                return $this->returnError(202, 'this department is not founded');
            }
            $department->update([
                'mall_id' => $request->mall_id,
                'name' => $request->name,
                'description' => $request->description,
                'note' => $request->note
            ]);
            return $this->returnSuccessMessage('updated successfully');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function deleteDepartment($departmentId)
    {
        try {
            $department = Dpartment::with('mall')->find($departmentId);
            if (!$department) {
                return $this->returnError(202, 'this department is not founded');
            }
            $department->delete();
            return $this->returnSuccessMessage('this department deleted successfully');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }
}
