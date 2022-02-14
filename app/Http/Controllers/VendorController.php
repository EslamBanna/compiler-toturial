<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    use GeneralTrait;
    public function insertVendor(Request $request)
    {
        try {
            $logo = '';
            if ($request->hasFile('logo')) {
                $logo = $this->saveImage($request->logo, 'vendors');
            }
            Vendor::create([
                'department_id' => $request->department_id,
                'name' => $request->name,
                'phone' => $request->phone,
                'description' => $request->description,
                'note' => $request->note,
                'logo' => $logo
            ]);
            return $this->returnSuccessMessage('the vendor inserted successfully');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function getVendor($vendorId)
    {
        try {
            $vendor = Vendor::with(['department' => function ($q) {
                $q->select('id', 'name', 'description');
            }])->find($vendorId);
            if (!$vendor) {
                return $this->returnError(202, 'this vendor is not founded');
            }
            return $this->returnData('data', $vendor);
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }


    public function getVendors()
    {
        try {
            $vendor = Vendor::with(['department' => function ($q) {
                $q->select('id', 'name', 'description');
            }])
            ->with('products')
            ->get();
            return $this->returnData('data', $vendor);
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function updateVendor($vendorId, Request $request)
    {
        try {
            $vendor = Vendor::find($vendorId);
            if (!$vendor) {
                return $this->returnError(202, 'this vendor is not founded');
            }
            $vendor->update([
                'department_id' => $request->department_id,
                'name' => $request->name,
                'phone' => $request->phone,
                'description' => $request->description,
                'note' => $request->note
            ]);
            return $this->returnSuccessMessage('this vendor is updated successfully');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function deleteVendor($vendorId){
        try{
            $vendor = Vendor::find($vendorId);
            if (!$vendor) {
                return $this->returnError(202, 'this vendor is not founded');
            }
            $vendor->delete();
            return $this->returnSuccessMessage('this vendor is deleted successfully');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }
}
