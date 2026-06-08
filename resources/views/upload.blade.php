<!DOCTYPE html>
<html>
<head>
    <title>Upload File ke S3</title>
</head>
<body>

    <h2>Upload File ke S3 (via Lambda)</h2>

    @if(session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <form method="POST"
          action="{{ route('upload.s3') }}"
          enctype="multipart/form-data">

        @csrf

        <input type="file" name="file" required>

        <button type="submit">
            Upload
        </button>

    </form>

</body>
</html>