<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Api\GDriveController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAddress;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function viewProfilePage()
    {
        $profile = Auth::user();
        return view('user.profile', [
            'profile' => $profile
        ]);
    }

    public function viewProfileAddressesPage()
    {
        $profile = Auth::user();
        $addresses = Auth::user()->userAddresses;
        return view('user.profileAddresses', [
            'addresses' => $addresses,
            'profile' => $profile
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());

        $validate_credentials = $request->validate([
            'username' => ['required', 'min:4', 'max:50', 'regex:/^\S*$/', Rule::unique('users', 'username')->ignore($user->id)],
            'name' => ['required', 'min:8', 'max:50'],
            'gender' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'phone_number' => ['nullable', 'min:6', 'max:20'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'profile_image' => ['image', 'max:5000'],
        ],  [
            'username.regex' => 'Username tidak boleh mengandung spasi.'
        ]);

        if($request->hasFile('profile_image')) {
            $image = GDriveController::upload($request->file('profile_image'));


        } else {
            dd('no image');
        }


        DB::beginTransaction();

        try {
            if ($request->hasFile('profile_image')) {
                if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                    Storage::disk('public')->delete($user->profile_image);
                }
                // $image = $request->file('profile_image');
                // $imageName = time() . '.' . $image->getClientOriginalExtension();
                // $image->storeAs('public/profile', $imageName);

                // $profile_image = $imageName;

                $image = GDriveController::upload($request->file('profile_image'));

                $profile_image = $image;
                
            } else {
                $profile_image = $user->profile_image;
            }

            if ($request->filled('new_password')) {
                $validate_credentials_password = $request->validate(
                    [
                        'current_password' => ['required', function ($attribute, $value, $fail) {
                            if (!Hash::check($value, Auth::user()->password)) {
                                $fail('The current password is incorrect.');
                            }
                        }],
                        'new_password' => ['required', 'min:8', 'max:50'],
                        'new_confirmation_password' => ['required', 'same:new_password']
                    ],
                    [
                        'current_password.required' => 'Current password is required',
                        'new_password.required' => 'New password is required',
                        'new_password.min' => 'New password must be at least 8 characters',
                        'new_confirmation_password.same' => 'Password confirmation does not match',
                    ]
                );

                // $validate_credentials['password'] = Hash::make($request->new_password);
                $user->update([
                    'password' => bcrypt($validate_credentials_password['new_password'])
                ]);
            }

            $user->update([
                'username' => $validate_credentials['username'],
                'name' => $validate_credentials['name'],
                'gender' => $validate_credentials['gender'],
                'email' => $validate_credentials['email'],
                'phone_number' => $validate_credentials['phone_number'],
                'date_of_birth' => $validate_credentials['date_of_birth'],
                'profile_image' => $profile_image,
            ]);

            DB::commit();
        } catch (ValidationException $e) {
            DB::rollBack();
            $errors = $e->validator->errors()->all();
            $errorMessages = implode('. ', ($errors)) . '.';
            return back()->with('error', ($errorMessages));
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error: update for user" . $validate_credentials['username'] . " failed " . $e->getMessage());
            return back()->with('error', 'An error occurred while updating your information. Please try again.');
        }
        return redirect()->route('profile.page')->with('success', 'Profile updated successfully. Hello ' . Auth::user()->username . '!');
    }

    public function updateAddresses(Request $request)
    {
        $address = UserAddress::find($request->id);

        $validate_credentials = $request->validate([
            'label' => ['required', 'max:50'],
            'category' => ['required'],
            'full_address' => ['required', 'max:200'],
            'receiver_name' => ['required', 'max:50'],
            'receiver_phone' => ['required', 'max:20'],
            'postal_code' => ['required', 'max:10'],
            'notes' => ['nullable']
        ]);


        DB::beginTransaction();

        try {
            $address->update([
                'label' => $validate_credentials['label'],
                'category' => $validate_credentials['category'],
                'full_address' => $validate_credentials['full_address'],
                'receiver_name' => $validate_credentials['receiver_name'],
                'receiver_phone' => $validate_credentials['receiver_phone'],
                'postal_code' => $validate_credentials['postal_code'],
                'notes' => $validate_credentials['notes'],
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error: update for user" . $validate_credentials['username'] . " failed " . $e->getMessage());
            return back()->with('error', 'An error occurred while updating your information. Please try again.');
        }
        return redirect()->route('profileAddresses.page')->with('success', 'Address updated successfully.');
    }

    public function addAddresses(Request $request)
    {
        $user = Auth::user();
        $validate_credentials = $request->validate([
            'label' => ['required', 'max:50'],
            'category' => ['required'],
            'full_address' => ['required', 'max:200'],
            'receiver_name' => ['required', 'max:50'],
            'receiver_phone' => ['required', 'max:20'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'postal_code' => ['required', 'max:10'],
            'notes' => ['nullable']
        ]);


        DB::beginTransaction();

        try {
            UserAddress::create([
                'label' => $validate_credentials['label'],
                'category' => $validate_credentials['category'],
                'full_address' => $validate_credentials['full_address'],
                'receiver_name' => $validate_credentials['receiver_name'],
                'receiver_phone' => $validate_credentials['receiver_phone'],
                'latitude' => $validate_credentials['latitude'],
                'longitude' => $validate_credentials['longitude'],
                'postal_code' => $validate_credentials['postal_code'],
                'notes' => $validate_credentials['notes'],
                'is_primary' => false,
                'user_id' => $user->id
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error: update for user" . $validate_credentials['username'] . " failed " . $e->getMessage());
            return back()->with('error', 'An error occurred while updating your information. Please try again.');
        }
        return redirect()->route('profileAddresses.page')->with('success', 'Address updated successfully.');
    }
}
