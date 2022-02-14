<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use GeneralTrait;
    public function insertController(Request $request)
    {
        try {
            $photo = '';
            if ($request->hasFile('photo')) {
                $photo = $this->saveImage($request->photo, 'products');
            }
            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'manufacture_company' => $request->manufacture_company,
                'photo' => $photo
            ]);
            return $this->returnSuccessMessage('sucesss');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function getProduct($productId)
    {
        try {
            $product = Product::find($productId);
            if (!$product) {
                return $this->returnError(202, 'this product is not founded');
            }
            return $this->returnData('data', $product);
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }
    public function getProducts()
    {
        try {
            $product = Product::with('Vendors')->get();
            return $this->returnData('data', $product);
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function updateProduct($productId, Request $request)
    {
        try {
            $product = Product::find($productId);
            if (!$product) {
                return $this->returnError(202, 'this product is not founded');
            }
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'manufacture_company' => $request->manufacture_company
            ]);
            return $this->returnSuccessMessage('updated successfully');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }

    public function deleteProduct($productId)
    {
        try {
            $product = Product::find($productId);
            if (!$product) {
                return $this->returnError(202, 'this product is not founded');
            }
            $product->delete();
            return $this->returnSuccessMessage('this product is deleted successfully');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }
}
