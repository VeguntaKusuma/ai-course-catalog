@extends('layouts.user') {{-- or layouts.admin if you created it --}}

@section('content')
<div class="container">
    <h2 class="mb-4">Enrollments</h2>
    <div class="mb-3">
    <button onclick="window.history.back()" class="btn btn-secondary">
        ← Back
    </button>
</div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Course</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($enrollments as $enrollment)
                <tr>
                    <td>{{ $enrollment->course->title ?? 'N/A' }}</td>
                    <td>{{ $enrollment->name }}</td>
                    <td>{{ $enrollment->email }}</td>
                    <td>{{ $enrollment->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No enrollments found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection