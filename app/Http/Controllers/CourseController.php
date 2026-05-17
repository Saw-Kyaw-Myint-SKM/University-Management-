<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('department.faculty')
            ->orderBy('code')
            ->paginate(10);

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $departments = Department::with('faculty')->orderBy('name')->get();
        return view('courses.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'          => 'required|string|max:20|unique:courses,code|regex:/^[A-Z]{2,4}[0-9]{3,4}$/',
            'name'          => 'required|string|min:3|max:255',
            'department_id' => 'required|exists:departments,id',
            'credits'       => 'required|integer|min:1|max:6',
            'description'   => 'nullable|string|max:1000',
        ], [
            'code.regex'    => 'Course code must be letters followed by numbers (e.g. CS101, BA201).',
            'code.unique'   => 'This course code is already taken.',
        ]);

        Course::create($request->only('code', 'name', 'department_id', 'credits', 'description'));

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function show(Course $course)
    {
        $course->load('department.faculty', 'enrollments.student.user', 'exams');
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $departments = Department::with('faculty')->orderBy('name')->get();
        return view('courses.edit', compact('course', 'departments'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'code'          => 'required|string|max:20|unique:courses,code,' . $course->id . '|regex:/^[A-Z]{2,4}[0-9]{3,4}$/',
            'name'          => 'required|string|min:3|max:255',
            'department_id' => 'required|exists:departments,id',
            'credits'       => 'required|integer|min:1|max:6',
            'description'   => 'nullable|string|max:1000',
        ], [
            'code.regex'    => 'Course code must be letters followed by numbers (e.g. CS101, BA201).',
            'code.unique'   => 'This course code is already taken.',
        ]);

        $course->update($request->only('code', 'name', 'department_id', 'credits', 'description'));

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
