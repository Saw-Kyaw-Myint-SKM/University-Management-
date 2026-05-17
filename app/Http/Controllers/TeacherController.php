<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('user', 'department')->paginate(10);
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('teachers.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|min:3|max:255',
            'email'           => 'required|string|email|max:255|unique:users',
            'password'        => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'employee_number' => 'required|string|min:3|max:255|unique:teachers',
            'specialization'  => 'nullable|string|max:255',
            'phone'           => 'nullable|string|min:10|max:20|regex:/^[+\d\s\-()]+$/',
            'address'         => 'nullable|string|max:500',
            'department_id'   => 'required|exists:departments,id',
            'status'          => 'required|in:active,inactive',
        ], [
            'password.regex'  => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
            'phone.regex'     => 'Phone number can only contain digits, spaces, hyphens, parentheses, and plus sign.',
            'department_id.required' => 'Please select a department.',
        ]);

        $role = Role::where('name', 'teacher')->firstOrFail();

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => $role->id,
        ]);

        Teacher::create([
            'user_id'         => $user->id,
            'department_id'   => $request->department_id,
            'employee_number' => $request->employee_number,
            'specialization'  => $request->specialization,
            'phone'           => $request->phone,
            'address'         => $request->address,
            'status'          => $request->status,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }

    public function show(Teacher $teacher)
    {
        $teacher->load('user', 'department', 'enrollments.course');
        return view('teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        $departments = Department::all();
        return view('teachers.edit', compact('teacher', 'departments'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name'            => 'required|string|min:3|max:255',
            'email'           => 'required|string|email|max:255|unique:users,email,' . $teacher->user_id,
            'employee_number' => 'required|string|min:3|max:255|unique:teachers,employee_number,' . $teacher->id,
            'specialization'  => 'nullable|string|max:255',
            'phone'           => 'nullable|string|min:10|max:20|regex:/^[+\d\s\-()]+$/',
            'address'         => 'nullable|string|max:500',
            'department_id'   => 'required|exists:departments,id',
            'status'          => 'required|in:active,inactive',
        ], [
            'phone.regex'     => 'Phone number can only contain digits, spaces, hyphens, parentheses, and plus sign.',
            'department_id.required' => 'Please select a department.',
        ]);

        $teacher->user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ], [
                'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
            ]);
            $teacher->user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $teacher->update([
            'department_id'   => $request->department_id,
            'employee_number' => $request->employee_number,
            'specialization'  => $request->specialization,
            'phone'           => $request->phone,
            'address'         => $request->address,
            'status'          => $request->status,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->user->delete();
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
