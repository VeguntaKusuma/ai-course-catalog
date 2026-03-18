@extends('layouts.user')

@section('title', 'Home')

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="text-center">
                        <h1 class="display-5 fw-semibold mb-3">
                            Welcome to Course Catalog
                        </h1>
                        <p class="lead text-muted mb-4">
                            Discover curated courses designed to help you grow your skills,
                            advance your career, and keep learning every day.
                        </p>
                        <a href="{{ route('courses.index') }}" class="btn btn-primary btn-lg">
                            Explore Courses
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

