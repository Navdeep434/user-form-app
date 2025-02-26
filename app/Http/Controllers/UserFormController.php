<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserForm;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserFormController extends Controller
{
    public function index()
    {
        $users = UserForm::all();
        return view('user_form', compact('users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_image' => 'required|image|mimes:jpg,jpeg|max:2048',
            'name' => 'required|string|max:25',
            'phone_area' => 'required|digits:3',
            'phone_prefix' => 'required|digits:3',
            'phone_line' => 'required|digits:4',
            'email' => 'required|email|unique:user_forms',
            'street_address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|in:CA,NY,AT',
            'country' => 'required|in:IN,US,EU',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Combine phone number parts into the required format
        $phone = "+1- (" . $request->phone_area . ") " . $request->phone_prefix . "-" . $request->phone_line;

        $imagePath = $request->file('profile_image')->store('profile_images', 'public');

        $user = UserForm::create([
            'profile_image' => $imagePath,
            'name' => $request->name,
            'phone' => $phone,
            'email' => $request->email,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
        ]);

        // Check if "Save and Export" button was clicked
        if ($request->has('export_current')) {
            return $this->exportCurrentUser($user);
        }

        return redirect()->back()->with('success', 'Record added successfully.');
    }

    public function destroy($id)
    {
        $user = UserForm::findOrFail($id);
        Storage::disk('public')->delete($user->profile_image);
        $user->delete();

        return redirect()->back()->with('success', 'Record deleted successfully.');
    }

    public function exportCsv()
    {
        $users = UserForm::all();
        
        if ($users->isEmpty()) {
            return redirect()->back()->with('error', 'No records to export.');
        }

        return response()->streamDownload(function () use ($users) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Profile Image', 'Name', 'Phone', 'Email', 'Street Address', 'City', 'State', 'Country']);

            foreach ($users as $user) {
                fputcsv($handle, [
                    asset('storage/' . $user->profile_image),
                    $user->name, $user->phone, $user->email,
                    $user->street_address, $user->city, $user->state, $user->country
                ]);
            }

            fclose($handle);
        }, 'all_users.csv', ['Content-Type' => 'text/csv']);
    }
    

    public function exportCurrentUser()
    {
        $user = UserForm::latest()->first();

        if (!$user) {
            return redirect()->back()->with('error', 'No user record found to export.');
        }

        $csvData = [
            ['Profile Image', 'Name', 'Phone', 'Email', 'Street Address', 'City', 'State', 'Country'],
            [
                asset('storage/' . $user->profile_image),
                $user->name, $user->phone, $user->email,
                $user->street_address, $user->city, $user->state, $user->country
            ]
        ];

        return response()->streamDownload(function () use ($csvData) {
            $handle = fopen('php://output', 'w');
            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }, 'current_user.csv', ['Content-Type' => 'text/csv']);
    }

}
