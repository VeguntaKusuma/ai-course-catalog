<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <h2 class="mb-4">Add Course</h2>

    <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Title -->
        <div class="mb-3">
            <label>Title</label>
            <input id="title" name="title" class="form-control">
            <div class="invalid-feedback" id="titleError"></div>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label>Description</label>
            <textarea id="description" name="description" class="form-control"></textarea>
            <div class="invalid-feedback" id="descriptionError"></div>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label>Price</label>
            <input id="price" name="price" class="form-control">
            <div class="invalid-feedback" id="priceError"></div>
        </div>

        <!-- Instructor -->
        <div class="mb-3">
            <label>Instructor</label>
            <input id="instructor" name="instructor" class="form-control">
            <div class="invalid-feedback" id="instructorError"></div>
        </div>

        <!-- Duration -->
        <div class="mb-3">
            <label>Duration</label>
            <input id="duration" name="duration" class="form-control">
            <div class="invalid-feedback" id="durationError"></div>
        </div>

        <!-- Image -->
        <div class="mb-3">
            <label>Image</label>
            <input id="image" type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-primary" id="createCourseBtn" disabled>Create</button>

    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const title = document.getElementById('title');
    const description = document.getElementById('description');
    const price = document.getElementById('price');
    const instructor = document.getElementById('instructor');
    const duration = document.getElementById('duration');
    const btn = document.getElementById('createCourseBtn');

    function validate() {
        let valid = true;

        if (!/^[A-Za-z\s]+$/.test(title.value)) {
            title.classList.add('is-invalid'); valid = false;
        } else title.classList.remove('is-invalid');

        if (!/^[A-Za-z0-9\s\.,]+$/.test(description.value)) {
            description.classList.add('is-invalid'); valid = false;
        } else description.classList.remove('is-invalid');

        if (!/^\d+(\.\d+)?$/.test(price.value)) {
            price.classList.add('is-invalid'); valid = false;
        } else price.classList.remove('is-invalid');

        if (!/^[A-Za-z\s]+$/.test(instructor.value)) {
            instructor.classList.add('is-invalid'); valid = false;
        } else instructor.classList.remove('is-invalid');

        if (!/^[0-9]+\s?[A-Za-z]+$/.test(duration.value)) {
            duration.classList.add('is-invalid'); valid = false;
        } else duration.classList.remove('is-invalid');

        btn.disabled = !valid;
    }

    document.querySelectorAll('input, textarea').forEach(el => {
        el.addEventListener('input', validate);
    });

});
</script>

</body>
</html>