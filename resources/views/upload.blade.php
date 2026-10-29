<!DOCTYPE html>
<html>
<head>
    <title>Upload File - Acara 29</title>
</head>
<body>
    <h2>Form Upload File</h2>

    @if (session('success'))
        <p role="status">{{ session('success') }}</p>
    @endif

    @error('document')
        <p role="alert">{{ $message }}</p>
    @enderror

    <!-- WAJIB: enctype="multipart/form-data" dan @csrf -->
    <form method="POST" action="{{ route('file.upload') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Pilih Dokumen/File:</label>
            <input type="file" name="document" accept=".jpg,.png,.pdf" required>
            <small>Format yang diizinkan: JPG, PNG, atau PDF. Maksimal 2 MB.</small>
        </div>
        <br>
        <button type="submit">Upload File</button>
    </form>
</body>
</html>