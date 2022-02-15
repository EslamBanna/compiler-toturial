<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use GeneralTrait;
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        // print_r($data);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->returnError(202, 'this user is not authenticated');
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $data = [
            'user' => $user,
            'token' => $token
        ];
        return $this->returnData('data', $data);
    }

    public function register(Request $request)
    {
        try {
            $checkUser = User::where('email', $request->email)->first();
            if ($checkUser) {
                return $this->returnError(201, 'this account is existed already');
            }
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return $this->returnSuccessMessage('success');
        } catch (\Exception $e) {
            return $this->returnError(201, $e->getMessage());
        }
    }
}
