<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserCourseController extends Controller
{
    // public function index(Request $request): View
    // {
    //     $search = $request->query('search');

    //     $courses = Course::when($search, function ($query, $search) {
    //         $query->where('title', 'like', '%' . $search . '%');
    //     })->get();

    //     return view('user.courses.index', [
    //         'courses' => $courses,
    //         'search' => $search,
    //     ]);
    // }

    public function index(Request $request): View
{
    $search = $request->query('search');

    $courses = Course::when($search, function ($query, $search) {
        $query->where('title', 'like', '%' . $search . '%');
    })->paginate(6)->withQueryString();

    return view('user.courses.index', [
        'courses' => $courses,
        'search' => $search,
    ]);
}

    public function show($id): View
    {
        $course = Course::findOrFail($id);

        return view('user.courses.show', compact('course'));
    }

    // public function search(Request $request)
    // {
    //     $query = $request->get('q', '');

    //     $courses = Course::when($query !== '', function ($q) use ($query) {
    //         $q->where('title', 'like', $query . '%');
    //     })->get();

    //     return response()->json($courses);
    // }

    public function search(Request $request)
{
    $query = $request->q;

    $courses = Course::where('title', 'like', $query . '%')->get();

    return response()->json($courses);
}
}

