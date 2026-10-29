<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // ==========================================
    public function tesStorage(Request $request)
    {
        Storage::put('catatan.txt', 'Isi dari file teks praktikum Acara 29');

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers');
        }

        Storage::disk('public')->put('contoh_disk.txt', 'Menyimpan file di disk public');

        return response()->json([
            'message' => 'Uji coba dasar penggunaan storage berhasil!',
            'file_exists' => Storage::exists('catatan.txt'),
        ], 200);
    }

    public function upload(Request $request)
    {
        $validated = $request->validate([
            'document' => ['required', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
        ]);

        $path = $validated['document']->store('documents', 'public');

        return redirect()
            ->route('upload.form')
            ->with('success', 'File berhasil diunggah: '.$path);
    }

    // Menampilkan semua buku
    public function index()
    {
        return response()->json(Book::all(), 200);
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required', 'integer', 'min:0', 'max:4294967295'],
        ]);

        $book = Book::create($validated);

        return response()->json($book, 201);
    }

    // Menampilkan satu buku berdasarkan ID
    public function show($id)
    {
        $book = Book::find($id);
        if (! $book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return response()->json($book, 200);
    }

    // Memperbarui buku
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if (! $book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->update($request->all());

        return response()->json($book, 200);
    }

    // Menghapus buku
    public function destroy($id)
    {
        $book = Book::find($id);
        if (! $book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted'], 200);
    }

    public function uploadCustomName(Request $request)
    {
        $file = $request->file('file');
        $filename = time().'_'.$file->getClientOriginalName();
        $path = $file->storeAs('documents', $filename, 'public');

        return 'File tersimpan dengan nama kustom: '.$path;
    }
}
