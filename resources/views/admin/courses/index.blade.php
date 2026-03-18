<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0">Courses</h1>
        <div class="d-flex gap-2">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-dark">
        Dashboard
    </a>
            <a class="btn btn-primary" href="{{ route('admin.courses.create') }}">Add Course</a>
            <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-secondary">Logout</button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Instructor</th>
                            <th scope="col">Price</th>
                            <th scope="col" style="width:140px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                            <tr>
                                <td>
                                    @if($course->image)
                                        <img src="{{ asset('storage/'.$course->image) }}" alt="Course Image" style="width:60px; height:60px; object-fit:cover; border-radius:6px;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $course->title }}</td>
                                <td>{{ $course->instructor }}</td>
                                <td>${{ number_format($course->price, 2) }}</td>
                                <td>
                                    <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-sm btn-outline-primary me-1">
                                        Edit
                                    </a>
                                    <form
                                        id="delete-course-{{ $course->id }}"
                                        action="{{ route('admin.courses.destroy', $course) }}"
                                        method="POST"
                                        class="d-inline"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-danger js-delete-btn"
                                            data-form-id="delete-course-{{ $course->id }}"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No courses found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal (single instance) -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this course?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalEl = document.getElementById('deleteConfirmModal');
        const confirmBtn = document.getElementById('confirmDeleteBtn');

        if (!modalEl || !confirmBtn || typeof bootstrap === 'undefined') {
            return;
        }

        const modal = new bootstrap.Modal(modalEl);
        let formToSubmit = null;

        document.addEventListener('click', function (e) {
            const btn = e.target.closest('.js-delete-btn');
            if (!btn) return;

            const formId = btn.getAttribute('data-form-id');
            if (!formId) return;

            const form = document.getElementById(formId);
            if (!form) return;

            formToSubmit = form;
            modal.show();
        });

        confirmBtn.addEventListener('click', function () {
            if (formToSubmit) {
                formToSubmit.submit();
            }
        });

        modalEl.addEventListener('hidden.bs.modal', function () {
            formToSubmit = null;
        });
    });
</script>
</body>
</html>