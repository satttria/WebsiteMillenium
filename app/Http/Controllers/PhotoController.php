<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\SupabaseStorageService;

class PhotoController extends Controller
{
    public function index()
    {
        return view('admin.photo.index', [
            'photos' => Photo::orderBy('id', 'desc')->get()
        ]);
    }

    public function store(Request $request, SupabaseStorageService $supabase)
    {
        $rules = [
            'judul' => 'required',
            'image' => 'required|max:1000|mimes:jpg,jpeg,png,webp',
        ];

        $massage = [
            'judul.required' => 'Judul Wajib diisi',
            'image.required' => 'Image Wajib diisi',
        ];

        $this->validate($request, $rules, $massage);

        // Upload image to Supabase
        $file = $request->file('image');
        $fileName = 'photo/' . Str::random(20) . '.' . $file->getClientOriginalExtension();
        $publicUrl = $supabase->upload($file, $fileName);

        Photo::create([
            'judul' => $request->judul,
            'image' => $publicUrl,
        ]);

        return redirect(route('photo'))->with('success', 'Data berhasil di Upload');
    }

    public function destroy($id)
    {
        $photo = Photo::find($id);
        $photo->delete();

        return redirect(route('photo'))->with('success', 'Data berhasil di hapus');
    }

    public function update(Request $request, SupabaseStorageService $supabase, $id)
    {
        $photo = Photo::find($id);

        $fileCheck = $request->hasFile('image') ? 'required|max:1000|mimes:jpg,jpeg,png' : '';
        $rules = [
            'judul' => 'required',
            'image' => $fileCheck,
        ];
        $messages = [
            'judul.required' => 'Judul wajib diisi!',
            'image.required' => 'Image wajib diisi!',
        ];

        $this->validate($request, $rules, $messages);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'photo/' . Str::random(20) . '.' . $file->getClientOriginalExtension();
            $publicUrl = $supabase->upload($file, $fileName);
        } else {
            $publicUrl = $photo->image;
        }

        $photo->update([
            'judul' => $request->judul,
            'image' => $publicUrl,
        ]);

        return redirect(route('photo'))->with('success', 'Data berhasil di update');
    }
}