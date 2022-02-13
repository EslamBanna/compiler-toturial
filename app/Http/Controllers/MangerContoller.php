<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class MangerContoller extends Controller
{
    use GeneralTrait;
    public function insert(Request $request)
    {
        try {
            $manager_photo = '';
            if ($request->hasFile('photo')) {
                $manager_photo = $this->saveImage($request->photo, 'managers');
            }
            Manager::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'address' => $request->address,
                'photo' => $manager_photo,
                'gender' => $request->gender
            ]);
            return $this->returnSuccessMessage('inserted successfully');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function getManagers()
    {
        try {
            $managers = Manager::get();
            return $this->returnData('data', $managers);
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function getManager($managerId)
    {
        try {
            $manager = Manager::with('malls')->find($managerId);
            if (!$manager) {
                return $this->returnError(202, 'this manager is not founded');
            }
            return $this->returnData('data', $manager);
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function updateManager($managerId, Request $request)
    {
        try {
            $manager = Manager::find($managerId);
            if (!$manager) {
                return $this->returnError(202, 'this manager is not founded');
            }
            $manager->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'address' => $request->address,
                // 'gender' => $request->gender
            ]);
            return $this->returnSuccessMessage('updated successfully');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function deleteManager($managerId)
    {
        try {
            $manager = Manager::find($managerId);
            if (!$manager) {
                return $this->returnError(202, 'this manager is not founded');
            }
            $manager->malls()->delete();
            $manager->delete();
            return $this->returnSuccessMessage('deleted successfully');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }
}
