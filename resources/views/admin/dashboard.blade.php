@extends('layouts.user')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard</h2>

    <div class="row">
        <div class="col-md-6">
            <!-- <div class="card p-4 text-center">
                <h4>Total Courses</h4>
                <h2>{{ $totalCourses }}</h2>
            </div> -->
            <a href="{{ route('admin.courses.index') }}" class="text-decoration-none text-dark">
    <div class="card p-4 text-center shadow-sm">
        <h5>Total Courses</h5>
        <h2>{{ $totalCourses }}</h2>
    </div>
</a>
        </div>

        <div class="col-md-6">
            <!-- <div class="card p-4 text-center">
                <h4>Total Enrollments</h4>
                <h2>{{ $totalEnrollments }}</h2>
            </div> -->
            <a href="{{ route('admin.enrollments.index') }}" class="text-decoration-none text-dark">
    <div class="card p-4 text-center shadow-sm">
        <h5>Total Enrollments</h5>
        <h2>{{ $totalEnrollments }}</h2>
    </div>
</a>
        </div>
    </div>
</div>
@endsection