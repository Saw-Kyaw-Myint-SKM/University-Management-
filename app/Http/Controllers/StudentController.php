<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user', 'department')->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $departments = \App\Models\Department::all();
        return view('students.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'student_number' => 'required|string|min:3|max:255|unique:students',
            'phone' => 'nullable|string|min:10|max:20|regex:/^[+\d\s\-()]+$/',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date|before:' . now()->subYears(16)->format('Y-m-d'),
            'department_id' => 'nullable|exists:departments,id',
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
            'phone.regex' => 'Phone number can only contain digits, spaces, hyphens, parentheses, and plus sign.',
            'date_of_birth.before' => 'Student must be at least 16 years old.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 3,
        ]);

        Student::create([
            'user_id' => $user->id,
            'student_number' => $request->student_number,
            'phone' => $request->phone,
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'department_id' => $request->department_id,
            'status' => 'active',
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $departments = \App\Models\Department::all();
        return view('students.edit', compact('student', 'departments'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $student->user_id,
            'student_number' => 'required|string|min:3|max:255|unique:students,student_number,' . $student->id,
            'phone' => 'nullable|string|min:10|max:20|regex:/^[+\d\s\-()]+$/',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date|before:' . now()->subYears(16)->format('Y-m-d'),
            'department_id' => 'nullable|exists:departments,id',
        ], [
            'phone.regex' => 'Phone number can only contain digits, spaces, hyphens, parentheses, and plus sign.',
            'date_of_birth.before' => 'Student must be at least 16 years old.',
        ]);

        $student->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $request->validate([
                'password' => 'string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ], [
                'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, and one number.',
            ]);
            $student->user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $student->update([
            'student_number' => $request->student_number,
            'phone' => $request->phone,
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'department_id' => $request->department_id,
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->user->delete();
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
