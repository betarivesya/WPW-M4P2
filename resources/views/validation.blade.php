<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Validasi Data</title>
</head>
<body>

    <h2>Form Validasi Data</h2>
    @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="/validation" method="POST">
        @csrf

        <label>Nama:</label>
        <input type="text" name="name">

        <br><br>

        <label>Email:</label>
        <input type="text" name="email">

        <br><br>

        <label>Password:</label>
        <input type="password" name="password">

        <br><br>

        <label>Konfirmasi Password:</label>
        <input type="password" name="password_confirmation">

        <br><br>

        <button type="submit">Submit</button>
    </form>

</body>
</html>
