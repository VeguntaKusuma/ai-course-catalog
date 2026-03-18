@extends('layouts.user')

@section('title', 'Courses')

@section('content')

<div class="container mt-4">

    <!-- Hero Section -->
    <div class="hero-section text-white d-flex align-items-center justify-content-center mb-4">
        <div class="text-center">
            <h1 class="fw-bold">Explore Our Courses</h1>
            <p>Upgrade your skills with top courses</p>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="mb-4">
        <input
            type="text"
            id="courseSearch"
            class="form-control"
            placeholder="Search courses..."
            autocomplete="off"
        >
    </div>

    <!-- Courses -->
    <div id="coursesContainer">
        @if ($courses->isEmpty())
            <div class="alert alert-info mb-0">
                No courses found.
            </div>
        @else
            <div class="row g-4">
                @foreach ($courses as $course)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card course-card h-100 border-0 shadow">

                            <!-- Image -->
                            @if($course->image)
                                <img src="{{ asset('storage/' . $course->image) }}"
                                     class="card-img-top"
                                     style="height: 200px; object-fit: cover;">
                            @endif

                            <!-- Body -->
                            <div class="card-body d-flex flex-column">
                                <h5 class="fw-bold">{{ $course->title }}</h5>

                                <p class="text-muted">
                                    {{ \Illuminate\Support\Str::limit($course->description, 120) }}
                                </p>

                                <div class="mt-auto">
                                    <div class="fw-semibold mb-2">
                                        ${{ number_format((float) $course->price, 2) }}
                                    </div>

                                    <a class="btn btn-primary w-100"
                                       href="{{ route('courses.show', $course->id) }}">
                                        View Details
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $courses->links() }}
        </div>
    </div>

</div>

<!-- Search Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('courseSearch');
    const coursesContainer = document.getElementById('coursesContainer');

    let currentController;

    searchInput.addEventListener('input', function () {
        const query = this.value.trim();

        if (currentController) {
            currentController.abort();
        }
        currentController = new AbortController();

        const url = new URL('{{ route('courses.search') }}', window.location.origin);
        url.searchParams.set('q', query);

        fetch(url.toString(), { signal: currentController.signal })
            .then(response => response.json())
            .then(data => {

                if (!Array.isArray(data) || data.length === 0) {
                    coursesContainer.innerHTML = `
                        <div class="alert alert-info mb-0">
                            No courses found.
                        </div>
                    `;
                    return;
                }

                const rows = data.map(course => {
                    const description = (course.description || '').length > 120
                        ? course.description.substring(0, 117) + '...'
                        : (course.description || '');

                    const price = parseFloat(course.price || 0).toFixed(2);
                    const detailsUrl = `/courses/${course.id}`;

                    return `
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card course-card h-100 border-0 shadow">

                                ${course.image ? `
                                <img src="/storage/${course.image}" 
                                     class="card-img-top"
                                     style="height:200px; object-fit:cover;">
                                ` : ''}

                                <div class="card-body d-flex flex-column">
                                    <h5 class="fw-bold">${course.title ?? ''}</h5>
                                    <p class="text-muted">${description}</p>

                                    <div class="mt-auto">
                                        <div class="fw-semibold mb-2">$${price}</div>

                                        <a class="btn btn-primary w-100" href="${detailsUrl}">
                                            View Details
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    `;
                }).join('');

                coursesContainer.innerHTML = `<div class="row g-4">${rows}</div>`;
            })
            .catch(error => {
                if (error.name !== 'AbortError') {
                    console.error(error);
                }
            });
    });
});
</script>

@endsection