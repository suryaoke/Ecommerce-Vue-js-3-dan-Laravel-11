<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthPelangganRequest;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Resources\PelangganResource;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class PelangganController extends Controller
{
    public function store(StorePelangganRequest $request)
    {
        if ($request->validated()) {
            Pelanggan::create($request->validated());
            return response()->json([
                'message' => 'Account created successfully'
            ]);
        }
    }

    /**
     * Login pelanggan
     */
    public function auth(AuthPelangganRequest $request)
    {
        if ($request->validated()) {
            $pelanggan = Pelanggan::whereEmail($request->email)->first();
            if (!$pelanggan || !Hash::check($request->password, $pelanggan->password)) {
                return response()->json([
                    'error' => 'These credentials do not match any of our records.'
                ]);
            } else {
                return response()->json([
                    'pelanggan' => PelangganResource::make($pelanggan),
                    'access_token' => $pelanggan->createToken('new_pelanggan')->plainTextToken,
                    'message' => 'Logged in successfully'
                ]);
            }
        }
    }

    /**
     * Logout the pelanggan
     */
    public function logout(Request $request)
    {
        $request->pelanggan()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    /***
     * Update pelanggan infos
     */
    public function UpdatePelangganProfile(Request $request)
    {
        $request->validate([
            'profile_image' => 'image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        if ($request->has('profile_image')) {
            //check if the old image exists and remove it
            if (File::exists(public_path($request->pelanggan()->profile_image))) {
                File::delete(public_path($request->pelanggan()->profile_image));
            }
            //store the pelanggan profile image
            $file = $request->file('profile_image');
            $profile_image_name = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('images/pelanggans', $profile_image_name, 'public');
            //update the pelanggan profile image
            $request->pelanggan()->update([
                'profile_image' => 'storage/images/pelanggans/' . $profile_image_name
            ]);
            //return the response
            return response()->json([
                'pelanggan' => PelangganResource::make($request->pelanggan()),
                'message' => 'Profile image has been updated successfully'
            ]);
        } else {
            $request->pelanggan()->update([
                'country' => $request->country,
                'city' => $request->city,
                'address' => $request->address,
                'zip_code' => $request->zip_code,
                'phone_number' => $request->phone_number,
                'profile_completed' => 1
            ]);
            //return the response
            return response()->json([
                'pelanggan' => PelangganResource::make($request->pelanggan()),
                'message' => 'Profile updated successfully'
            ]);
        }
    }
}
