@extends('layouts.user')

@section('title', $course->title)

@section('content')

<!-- SUCCESS MESSAGE (TOP) -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="container mt-4">

    <!-- Title + Back -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">{{ $course->title }}</h1>
        <a class="btn btn-outline-secondary" href="{{ route('courses.index') }}">
            ← Back
        </a>
    </div>

    <!-- Hero Image -->
    @if ($course->image)
        <div class="mb-4">
            <img
                src="{{ asset('storage/' . $course->image) }}"
                class="img-fluid rounded shadow"
                style="width:100%; max-height:450px; object-fit:cover;"
            >
        </div>
    @endif

    <div class="row g-4">

        <!-- LEFT SIDE -->
        <div class="col-md-8">

            <!-- Instructor -->
            <div class="mb-3 text-muted">
                Instructor: <strong>{{ $course->instructor }}</strong>
            </div>

            <!-- Description -->
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Course Description</h5>
                    <p class="text-muted" style="line-height:1.8;">
                        {{ $course->description }}
                    </p>
                </div>
            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div class="col-md-4">

            <div class="card border-0 shadow-lg p-3">

                <div class="mb-3">
                    <div class="text-muted">Price</div>
                    <div class="fs-4 fw-bold text-primary">
                        ${{ number_format((float) $course->price, 2) }}
                    </div>
                </div>

                <div class="mb-3">
                    <div class="text-muted">Duration</div>
                    <div class="fw-semibold">
                        {{ $course->duration ?? 'N/A' }}
                    </div>
                </div>

                <button class="btn btn-primary w-100 mt-2"
                        data-bs-toggle="modal"
                        data-bs-target="#enrollModal">
                    Enroll Now
                </button>

            </div>

        </div>

    </div>

</div>

<!-- MODAL -->
<div class="modal fade" id="enrollModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Enroll in {{ $course->title }}</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="enrollForm" method="POST" action="{{ route('enrollments.store') }}">
                @csrf

                <div class="modal-body">

                    <input type="hidden" name="course_id" value="{{ $course->id }}">

                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input id="enrollName" type="text" name="name" class="form-control">
                        <div class="invalid-feedback" id="enrollNameError"></div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="form-label">Email</label>
                        <input id="enrollEmail" type="text" name="email" class="form-control">
                        <div class="invalid-feedback" id="enrollEmailError"></div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                        Submit Enrollment
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection

<!-- SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const name = document.getElementById('enrollName');
    const email = document.getElementById('enrollEmail');
    const submitBtn = document.getElementById('submitBtn');
    const modal = document.getElementById('enrollModal');

    function validateName() {
        const regex = /^[A-Za-z]+( [A-Za-z]+)*$/;
        if (!regex.test(name.value.trim())) {
            setError(name, 'Only alphabets allowed');
            return false;
        }
        setSuccess(name);
        return true;
    }

    function validateEmail() {
        const regex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
        if (!regex.test(email.value.trim())) {
            setError(email, 'Enter valid email');
            return false;
        }
        setSuccess(email);
        return true;
    }

    function setError(input, msg) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        document.getElementById(input.id + 'Error').textContent = msg;
    }

    function setSuccess(input) {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        document.getElementById(input.id + 'Error').textContent = '';
    }

    function checkForm() {
        submitBtn.disabled = !(validateName() && validateEmail());
    }

    name.addEventListener('input', checkForm);
    email.addEventListener('input', checkForm);

    modal.addEventListener('hidden.bs.modal', () => {
        name.value = '';
        email.value = '';
        name.classList.remove('is-valid', 'is-invalid');
        email.classList.remove('is-valid', 'is-invalid');
        submitBtn.disabled = true;
    });

});
</script>