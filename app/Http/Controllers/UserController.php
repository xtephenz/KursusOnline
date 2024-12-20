<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function viewRegisterPage()
    {
        $roles = Role::with('users')->where('name', 'Student')->get();
        return view('main.RegisterPage', ['roles' => $roles]);
    }

    public function register(Request $request)
    {
        // validasi request
        $validatedData = $request->validate(
            [
                'name' => 'required|string|max:100',
                'gender' => 'required|string',
                'dob' => 'required|date|before:13 years ago',
                'role' => 'required|exists:roles,id',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'tnc' => 'accepted'
            ],
            [
                // custom message buat validasi dob.before
                'dob.before' => 'You must be at least 13 years old.'
            ]
        );

        // password akan dihash sebelum dimasukkan ke dalam DB
        $validatedData['password'] = Hash::make($request->password);

        // create user dan dimasukkan ke dalam database
        User::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'date_of_birth' => $request->dob,
            'role_id' => $request->role,
            'email' => $request->email,
            'password' => $validatedData['password']
        ]);

        // redirect ke login page dan menampilkan message success
        return redirect()->route('loginPage.view')->with('success', 'Registration successful!');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        // cek apakah remember me dicentang?
        $remember = $request->has('remember_me');  // Use remember_me here

        // percobaan login
        if (Auth::attempt($credentials, $remember)) {
            // kalau email + password benar, redirect ke home PAGE
            return redirect()->route('homePage.view')->with('user', Auth::user());
        }
        // kalau email / password salah, muncul pesan error
        return back()->with('fail', 'These credentials do not match our records.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginPage.view');
    }

    public function viewAddCoursePage()
    {
        $lecturers = User::with('role', 'enrollments', 'courses', 'submissions')->where('role_id', '3')->get();
        return view('main.AddCoursePage', ['lecturers' => $lecturers]);
    }

    public function updateProfile(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::with('role', 'enrollments', 'courses', 'submissions')->find($user_id);

        $request->validate([
            'name' => 'required|string|max:100',
            'dob' => 'required|date|before:13 years ago',
            'photo' => 'nullable|image|max:5000'
        ]);

        $user->name = $request->name;
        $user->date_of_birth = $request->dob;
        
        if($request->hasFile('photo')){
            if($user->photo != null){
                Storage::disk('s3')->delete($user->photo);
                $user->photo = null;
            }
            $user->photo = $request->photo->storePublicly('users');
        }
        $user->save();

        return redirect()->back();
    }

    public function deletePhoto()
    {
        $user_id = Auth::user()->id;
        $user = User::with('role', 'enrollments', 'courses', 'submissions')->find($user_id);
        Storage::disk('s3')->delete($user->photo);
        $user->photo = null;
        $user->save();
        return redirect()->back();
    }

    public function changePassword(Request $request)
    {
        $user_id = Auth::user()->id;
        $user = User::with('role', 'enrollments', 'courses', 'submissions')->find($user_id);
        
        $request->validate([
            'currentPassword' => 'required|string',
        ]);

        if (!Hash::check($request->currentPassword, $user->password)) {
            return back()->withErrors(['currentPassword' => 'The provided password does not match your current password.']);
        }

        $request->validate([
            'newPassword' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->newPassword);
        $user->save();

        return redirect()->back()->with('success', 'Password has been changed!');
    }
}
