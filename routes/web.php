<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Controllers\ValidationController;


Route::get('/', function () {
    return view('welcome');
});

// Contoh Insert Data
Route::get('/insert-user', function () {
    DB::table('users')->insert([
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => bcrypt('password123')
    ]);

    return 'Data berhasil ditambahkan!';
});

// Insert dan Mendapatkan ID yang Dihasilkan
Route::get('/insert-user-id', function () {
    $id = DB::table('users')->insertGetId([
        'name' => 'Jane Doe',
        'email' => 'janedoe@example.com',
        'password' => bcrypt('password123')
    ]);

    return 'Data berhasil ditambahkan dengan ID: ' . $id;
});

// Mengambil Semua Data
Route::get('/users', function () {
    $users = DB::table('users')->get();

    return $users;
});

// Mengambil Data Berdasarkan Kondisi
Route::get('/user-email', function () {
    $user = DB::table('users')
        ->where('email', 'johndoe@example.com')
        ->first();

    return $user;
});

// Menggunakan Select untuk Menentukan Kolom yang Diambil
Route::get('/users-select', function () {
    $users = DB::table('users')
        ->select('id', 'name')
        ->get();

    return $users;
});

// Menggunakan Where dengan Banyak Kondisi
Route::get('/users-admin', function () {
    $users = DB::table('users')
        ->where('status', 'active')
        ->where('role', 'admin')
        ->get();

    return $users;
});

// Menggunakan Where dengan Operator
Route::get('/users-age', function () {
    $users = DB::table('users')
        ->where('age', '>=', 18)
        ->get();

    return $users;
});

// 3. MEMPERBARUI DATA

// Update Data
Route::get('/update-user', function () {
    DB::table('users')
        ->where('email', 'johndoe@example.com')
        ->update([
            'status' => 'inactive'
        ]);

    return 'Data berhasil diperbarui!';
});

// Increment
Route::get('/increment-points', function () {
    DB::table('users')
        ->where('id', 1)
        ->increment('points', 10);

    return 'Points berhasil ditambahkan 10!';
});

// Decrement
Route::get('/decrement-points', function () {
    DB::table('users')
        ->where('id', 1)
        ->decrement('points', 5);

    return 'Points berhasil dikurangi 5!';
});



// Hapus Data Berdasarkan Email
Route::get('/delete-user', function () {
    DB::table('users')
        ->where('email', 'johndoe@example.com')
        ->delete();

    return 'Data berhasil dihapus!';
});

// Hapus Semua Data
Route::get('/truncate-users', function () {
    DB::table('users')->truncate();

    return 'Semua data users berhasil dihapus!';
});


// Mengambil daftar nama
Route::get('/user-names', function () {
    $names = DB::table('users')->pluck('name');

    return $names;
});

// Mengambil dua kolom sebagai key dan value
Route::get('/user-list', function () {
    $users = DB::table('users')->pluck('name', 'email');

    return $users;
});

// 6. AGREGAT

// Menghitung Jumlah Data
Route::get('/total-users', function () {
    $totalUsers = DB::table('users')->count();

    return 'Jumlah user: ' . $totalUsers;
});

// Menjumlahkan Nilai Kolom
Route::get('/total-points', function () {
    $totalPoints = DB::table('users')->sum('points');

    return 'Total points: ' . $totalPoints;
});

// Mendapatkan Nilai Rata-rata
Route::get('/average-age', function () {
    $averageAge = DB::table('users')->avg('age');

    return 'Rata-rata umur: ' . $averageAge;
});

// Mendapatkan Nilai Maksimum
Route::get('/max-salary', function () {
    $maxSalary = DB::table('employees')->max('salary');

    return 'Gaji terbesar: ' . $maxSalary;
});

// Mendapatkan Nilai Minimum
Route::get('/min-salary', function () {
    $minSalary = DB::table('employees')->min('salary');

    return 'Gaji terkecil: ' . $minSalary;
});

// 7. JOIN

// Inner Join
Route::get('/users-orders', function () {
    $users = DB::table('users')
        ->join('orders', 'users.id', '=', 'orders.user_id')
        ->select('users.name', 'orders.total_price')
        ->get();

    return $users;
});

// Left Join
Route::get('/users-orders-left', function () {
    $users = DB::table('users')
        ->leftJoin('orders', 'users.id', '=', 'orders.user_id')
        ->get();

    return $users;
});

// 8. PENGURUTAN, LIMIT, DAN OFFSET

// Mengurutkan Data
Route::get('/users-order', function () {
    $users = DB::table('users')
        ->orderBy('name', 'asc')
        ->get();

    return $users;
});

// Membatasi Jumlah Data
Route::get('/users-limit', function () {
    $users = DB::table('users')
        ->limit(10)
        ->get();

    return $users;
});

// Menggunakan Offset untuk Pagination
Route::get('/users-offset', function () {
    $users = DB::table('users')
        ->offset(10)
        ->limit(10)
        ->get();

    return $users;
});

// 9. SUBQUERY

Route::get('/users-order-count', function () {
    $users = DB::table('users')
        ->select('name')
        ->selectSub(function ($query) {
            $query->from('orders')
                ->selectRaw('count(*)')
                ->whereColumn('orders.user_id', 'users.id');
        }, 'order_count')
        ->get();

    return $users;
});

// 10. QUERY RAW

// Menggunakan Raw untuk Select
Route::get('/users-group-status', function () {
    $users = DB::table('users')
        ->selectRaw('COUNT(*) as total_users, status')
        ->groupBy('status')
        ->get();

    return $users;
});

// Menggunakan Raw dalam Where
Route::get('/users-active-adult', function () {
    $users = DB::table('users')
        ->whereRaw('age > ? AND status = ?', [18, 'active'])
        ->get();

    return $users;
});

Route::get('/eloquent-create', function () {
    $user = User::create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => bcrypt('password')
    ]);

    return 'Data berhasil ditambahkan dengan ID: ' . $user->id;
});

Route::get('/eloquent-save', function () {
    $user = new User;

    $user->name = 'Jane Doe';
    $user->email = 'jane@example.com';
    $user->password = bcrypt('password');

    $user->save();

    return 'Data berhasil ditambahkan dengan ID: ' . $user->id;
});

// 2. RETRIEVE DATA DENGAN ELOQUENT

// a. Mengambil Semua Data
Route::get('/eloquent-users', function () {
    $users = User::all();

    return $users;
});

// b. Mengambil Data Berdasarkan ID
Route::get('/eloquent-user/{id}', function ($id) {
    $user = User::find($id);

    return $user;
});

// c. Menggunakan Where
Route::get('/eloquent-user-email', function () {
    $users = User::where('email', 'john@example.com')->get();

    return $users;
});

// d. Menggunakan firstOrFail()
Route::get('/eloquent-user-first', function () {
    $user = User::where('email', 'john@example.com')->firstOrFail();

    return $user;
});

// 3. UPDATE DATA DENGAN ELOQUENT

// a. Menggunakan update()
Route::get('/eloquent-update', function () {
    User::where('email', 'john@example.com')
        ->update([
            'name' => 'John Updated'
        ]);

    return 'Data John berhasil diperbarui!';
});

// b. Menggunakan save()
Route::get('/eloquent-update-save', function () {
    $user = User::find(1);

    if (!$user) {
        return 'User dengan ID 1 tidak ditemukan.';
    }

    $user->name = 'John Updated';
    $user->save();

    return 'Data berhasil diperbarui dengan save()!';
});

// 4. DELETE DATA DENGAN ELOQUENT

// a. Menggunakan delete()
Route::get('/eloquent-delete', function () {
    $user = User::find(1);

    if (!$user) {
        return 'User dengan ID 1 tidak ditemukan.';
    }

    $user->delete();

    return 'Data user berhasil dihapus dengan delete()!';
});

// b. Menggunakan destroy()
Route::get('/eloquent-destroy', function () {
    User::destroy(1);

    return 'Data user berhasil dihapus dengan destroy()!';
});

// 1. CONDITIONAL CLAUSE

// a. Menggunakan where()
Route::get('/conditional-where', function () {
    $users = User::where('status', 'active')->get();

    return $users;
});

// b. Menggunakan orWhere()
Route::get('/conditional-orwhere', function () {
    $users = User::where('status', 'active')
        ->orWhere('role', 'admin')
        ->get();

    return $users;
});

// c. Menggunakan whereBetween()
Route::get('/conditional-between', function () {
    $users = User::whereBetween('age', [18, 30])->get();

    return $users;
});

// d. Menggunakan whereIn()
Route::get('/conditional-in', function () {
    $users = User::whereIn('role', ['admin', 'editor'])->get();

    return $users;
});

// e. Menggunakan whereNull()
Route::get('/conditional-null', function () {
    $users = User::whereNull('deleted_at')->get();

    return $users;
});

// e. Menggunakan whereNotNull()
Route::get('/conditional-not-null', function () {
    $users = User::whereNotNull('email_verified_at')->get();

    return $users;
});

// f. Menggunakan when()
Route::get('/conditional-when', function () {
    $role = 'admin';

    $users = User::when($role, function ($query, $role) {
        return $query->where('role', $role);
    })->get();

    return $users;
});

Route::get('/mutator-accessor', function () {

    $user = User::first();

    if (!$user) {
        return 'Belum ada data user di database.';
    }

    return $user->full_name;
});

// Soft Delete
Route::get('/soft-delete', function () {

    $user = User::first();

    if (!$user) {
        return 'Belum ada user di database.';
    }

    $user->delete();

    return 'User berhasil di-soft delete. ID: ' . $user->id;
});

Route::get('/soft-delete-with-trashed', function () {

    $users = User::withTrashed()->get();

    return $users;
});

Route::get('/soft-delete-only-trashed', function () {

    $users = User::onlyTrashed()->get();

    return $users;
});

Route::get('/soft-delete-restore', function () {

    $user = User::onlyTrashed()->first();

    if (!$user) {
        return 'Tidak ada user yang sudah dihapus.';
    }

    $user->restore();

    return 'User berhasil dikembalikan. ID: ' . $user->id;
});

Route::get('/scope-active', function () {

    $activeUsers = User::active()->get();

    return $activeUsers;
});
Route::get('/test-mutator-accessor', function () {

    $user = User::create([
        'name' => 'Vesya',
        'email' => 'vesya' . time() . '@test.com',
        'password' => '12345678',
        'first_name' => 'Betari',
        'last_name' => 'Vesya',
    ]);

    return [
        'password_tersimpan' => $user->password,
        'full_name' => $user->full_name,
    ];
});

Route::get('/custom-validation', function () {
    return view('custom-validation');
});

Route::post('/custom-validation', function (Illuminate\Http\Request $request) {

    $messages = [
        'name.required' => 'Nama harus diisi!',
        'email.required' => 'Email tidak boleh kosong!',
        'password.confirmed' => 'Password tidak cocok!'
    ];

    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed'
    ], $messages);

    return "Data berhasil divalidasi!";
});
Route::get('/validation', [ValidationController::class, 'form']);
Route::post('/validation', [ValidationController::class, 'submitForm']);

Route::get('/uppercase', function () {
    return view('uppercase');
});

Route::post('/uppercase', [ValidationController::class, 'uppercase']);
