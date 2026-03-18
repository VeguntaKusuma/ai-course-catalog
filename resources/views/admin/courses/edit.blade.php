<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between mb-4">
        <h2>Edit Course</h2>
        <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <form method="POST" action="{{ route('admin.courses.update', $course->id) }}" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-3">
            <label>Title</label>
            <input id="title" name="title" class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title', $course->title) }}">
            <div class="invalid-feedback" id="titleError">@error('title'){{ $message }}@enderror</div>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label>Description</label>
            <textarea id="description" name="description"
                      class="form-control @error('description') is-invalid @enderror">{{ old('description', $course->description) }}</textarea>
            <div class="invalid-feedback" id="descriptionError">@error('description'){{ $message }}@enderror</div>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label>Price</label>
            <input id="price" name="price" class="form-control @error('price') is-invalid @enderror"
                   value="{{ old('price', $course->price) }}">
            <div class="invalid-feedback" id="priceError">@error('price'){{ $message }}@enderror</div>
        </div>

        <!-- Instructor -->
        <div class="mb-3">
            <label>Instructor</label>
            <input id="instructor" name="instructor"
                   class="form-control @error('instructor') is-invalid @enderror"
                   value="{{ old('instructor', $course->instructor) }}">
            <div class="invalid-feedback" id="instructorError">@error('instructor'){{ $message }}@enderror</div>
        </div>

        <!-- Duration -->
        <div class="mb-3">
            <label>Duration</label>
            <input id="duration" name="duration"
                   class="form-control @error('duration') is-invalid @enderror"
                   value="{{ old('duration', $course->duration) }}">
            <div class="invalid-feedback" id="durationError">@error('duration'){{ $message }}@enderror</div>
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label>Image</label>
            <input id="image" type="file" name="image"
                   class="form-control @error('image') is-invalid @enderror">
            <div class="invalid-feedback" id="imageError">@error('image'){{ $message }}@enderror</div>
        </div>

        <button class="btn btn-primary" id="updateBtn" disabled>Update</button>

    </form>

</div>

<script>
function setError(input, message) {
    input.classList.add('is-invalid');
    input.classList.remove('is-valid');
    document.getElementById(input.id + 'Error').textContent = message;
}

function setSuccess(input) {
    input.classList.remove('is-invalid');
    input.classList.add('is-valid');
    document.getElementById(input.id + 'Error').textContent = '';
}

document.addEventListener('DOMContentLoaded', function () {

    const submitBtn = document.getElementById('updateBtn');

    const title = document.getElementById('title');
    const description = document.getElementById('description');
    const price = document.getElementById('price');
    const instructor = document.getElementById('instructor');
    const duration = document.getElementById('duration');
    const image = document.getElementById('image');

    let isSubmitted = false;

    const touched = {
        title: false,
        instructor: false,
        price: false,
        description: false,
        duration: false,
        image: false,
    };

    const patterns = {
        alphaSpace: /^[A-Za-z\s]+$/,
        description: /^[A-Za-z0-9\s\.,]+$/,
        numeric: /^\d+(\.\d+)?$/,
        duration: /^[0-9]+\s?[A-Za-z]+$/,
    };

    function validateTitle(force = false) {
        if (!force && !isSubmitted && !touched.title) return true;
        const val = title.value.trim();
        if (!val) return setError(title, 'Title required');
        if (!patterns.alphaSpace.test(val)) return setError(title, 'Only alphabets');
        return setSuccess(title);
    }

    function validateInstructor(force = false) {
        if (!force && !isSubmitted && !touched.instructor) return true;
        const val = instructor.value.trim();
        if (!val) return setError(instructor, 'Instructor required');
        if (!patterns.alphaSpace.test(val)) return setError(instructor, 'Only alphabets');
        return setSuccess(instructor);
    }

    function validatePrice(force = false) {
        if (!force && !isSubmitted && !touched.price) return true;
        const val = price.value.trim();
        if (!val) return setError(price, 'Price required');
        if (!patterns.numeric.test(val)) return setError(price, 'Invalid price');
        return setSuccess(price);
    }

    function validateDescription(force = false) {
        if (!force && !isSubmitted && !touched.description) return true;
        const val = description.value.trim();
        if (!val) return setError(description, 'Description required');
        if (!patterns.description.test(val)) return setError(description, 'Invalid description');
        return setSuccess(description);
    }

    function validateDuration(force = false) {
        if (!force && !isSubmitted && !touched.duration) return true;
        const val = duration.value.trim();
        if (!val) return setError(duration, 'Duration required');
        if (!patterns.duration.test(val)) return setError(duration, 'Use format like 3 Months');
        return setSuccess(duration);
    }

    function validateImage(force = false) {
        if (!force && !isSubmitted && !touched.image) return true;

        const file = image.files[0];
        if (!file) return true;

        const allowed = ['jpg', 'jpeg', 'png'];
        const ext = file.name.split('.').pop().toLowerCase();

        if (!allowed.includes(ext)) {
            return setError(image, 'Invalid image');
        }

        return setSuccess(image);
    }

    function isFieldValid(input) {
        return input.classList.contains('is-valid');
    }

    function updateSubmitState() {
        if (!isSubmitted) {
            submitBtn.disabled = false;
            return;
        }

        const valid =
            isFieldValid(title) &&
            isFieldValid(instructor) &&
            isFieldValid(price) &&
            isFieldValid(description) &&
            isFieldValid(duration);

        submitBtn.disabled = !valid;
    }

    [title, instructor, price, description, duration].forEach(field => {
        field.addEventListener('input', () => {
            touched[field.id] = true;
            validateTitle(true);
            validateInstructor(true);
            validatePrice(true);
            validateDescription(true);
            validateDuration(true);
            updateSubmitState();
        });
    });

    image.addEventListener('change', () => {
        touched.image = true;
        validateImage(true);
    });

    updateSubmitState();

    document.querySelector('form').addEventListener('submit', function (e) {
        isSubmitted = true;

        validateTitle(true);
        validateInstructor(true);
        validatePrice(true);
        validateDescription(true);
        validateDuration(true);
        validateImage(true);

        updateSubmitState();

        if (submitBtn.disabled) {
            e.preventDefault();
        }
    });

});
</script>

</body>
</html>