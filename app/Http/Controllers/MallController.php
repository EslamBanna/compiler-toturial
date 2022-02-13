<?php

namespace App\Http\Controllers;

use App\Models\Mall;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class MallController extends Controller
{
    use GeneralTrait;
    public function insertMall(Request $request)
    {
        try {
            $mall_photo = '';
            if ($request->hasFile('photo')) {
                $mall_photo = $this->saveImage($request->photo, 'malls');
            }
            Mall::create([
                'manager_id' => $request->manager_id,
                'name'  => $request->name,
                'address'  => $request->address,
                'phone'  => $request->phone,
                'space'  => $request->space,
                'note'  => $request->note,
                'photo'  => $mall_photo
            ]);

            return $this->returnSuccessMessage('inserted successfully');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function getMall($mallId)
    {
        try {
            $mall = Mall::with('manager')->find($mallId);
            if (!$mall) {
                return $this->returnError(202, 'this mall is not founded');
            }
            return $this->returnData('data', $mall);
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function getMalls()
    {
        try {
            $malls = Mall::get();
            return $this->returnData('data', $malls);
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function updateMall($mallId, Request $request)
    {
        try {
            $mall = Mall::find($mallId);
            if (!$mall) {
                return $this->returnError(202, 'this mall is not founded');
            }
            $mall->update([
                'name'  => $request->name,
                'address'  => $request->address,
                'phone'  => $request->phone,
                'space'  => $request->space,
                'note'  => $request->note
            ]);

            return $this->returnSuccessMessage('updated sucessfully');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function deleteMall($mallId)
    {
        try {
            $mall = Mall::find($mallId);
            if (!$mall) {
                return $this->returnError(202, 'this mall is not founded');
            }
            $mall->delete();
            return $this->returnSuccessMessage('deleted successfully');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }
}
