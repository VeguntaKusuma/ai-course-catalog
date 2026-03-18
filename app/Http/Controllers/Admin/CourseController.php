<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $validated = $request->validated();

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('course_images', 'public');
            $validated['image'] = $path;
        }

        Course::create($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $validated = $request->validated();

        // Handle image upload if present
        if ($request->hasFile('image')) {

            //delete old image if exists
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $path = $request->file('image')->store('course_images', 'public');
            $validated['image'] = $path;
        }

        $course->update($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course deleted successfully.');
    }

//     public function destroy(Course $course)
// {
//     // delete image if exists
//     if ($course->image) {
//         Storage::disk('public')->delete($course->image);
//     }

//     // delete course
//     $course->delete();

//     return redirect()->route('admin.courses.index')
//         ->with('success', 'Course deleted successfully.');
// }

public function dashboard()
{
    $totalCourses = \App\Models\Course::count();
    $totalEnrollments = \App\Models\Enrollment::count();

    return view('admin.dashboard', compact('totalCourses', 'totalEnrollments'));
}
}
