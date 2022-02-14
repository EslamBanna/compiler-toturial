<?php

namespace App\Http\Controllers;

use App\Models\VendorProduct;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class VendorProductController extends Controller
{
    use GeneralTrait;
    public function createVendorProduct(Request $request)
    {
        try {
            VendorProduct::create([
                'vendor_id' => $request->vendor_id,
                'product_id' => $request->product_id,
                'price' => $request->price,
                'note' => $request->note
            ]);
            return $this->returnSuccessMessage('the vendor sale the product');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }
}
