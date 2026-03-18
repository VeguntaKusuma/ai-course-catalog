<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        Enrollment::create($validated);

        return back()->with('success', 'Enrollment submitted successfully.');
    }
    public function index()
{
    $enrollments = \App\Models\Enrollment::with('course')->latest()->get();

    return view('admin.enrollments.index', compact('enrollments'));
}
}

