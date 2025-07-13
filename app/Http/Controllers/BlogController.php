<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\SupabaseStorageService;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function index()
    {
        return view('admin.blog.index', [
            'artikels' => Blog::orderBy('id', 'desc')->get()
        ]);
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request, SupabaseStorageService $supabase)
    {
        $rules = [
            'judul' => 'required',
            'image' => 'required|max:1000|mimes:jpg,jpeg,png,webp',
            'desc' => 'required|min:20',
        ];

        $massage = [
            'judul.required' => 'Judul Wajib diisi',
            'image.required' => 'Image Wajib diisi',
            'desc.required' => 'Deskripsi Wajib diisi',
        ];

        $this->validate($request, $rules, $massage);

        // Upload image to Supabase
        $file = $request->file('image');
        $fileName = 'artikel/' . Str::random(20) . '.' . $file->getClientOriginalExtension();
        $publicUrl = $supabase->upload($file, $fileName);

        // Handle content images if needed (unchanged logic)
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->desc, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        Blog::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul, '-'),
            'image' => $publicUrl,
            'desc' => $dom->saveHTML(),
        ]);

        return redirect(route('blog'))->with('success', 'data berhasil di simpan');
    }

    public function edit($id)
    {
        $artikel = Blog::find($id);
        return view('admin.blog.edit', [
            'artikel' => $artikel
        ]);
    }

    public function update(Request $request, SupabaseStorageService $supabase, $id)
    {
        $artikel = Blog::find($id);

        $fileCheck = $request->hasFile('image') ? 'required|max:1000|mimes:jpg,jpeg,png' : '';
        $rules = [
            'judul' => 'required',
            'image' => $fileCheck,
            'desc' => 'required|min:20',
        ];
        $messages = [
            'judul.required' => 'Judul wajib diisi!',
            'image.required' => 'Image wajib diisi!',
            'desc.required' => 'Desc wajib diisi!',
        ];

        $this->validate($request, $rules, $messages);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = 'artikel/' . Str::random(20) . '.' . $file->getClientOriginalExtension();
            $publicUrl = $supabase->upload($file, $fileName);
        } else {
            $publicUrl = $artikel->image;
        }

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->desc, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $artikel->update([
            'judul' => $request->judul,
            'image' => $publicUrl,
            'desc' => $dom->saveHTML(),
        ]);

        return redirect(route('blog'))->with('success', 'data berhasil di update');
    }

    public function destroy($id)
    {
        $artikel = Blog::find($id);
        $artikel->delete();

        return redirect(route('blog'))->with('success', 'data berhasil di hapus');
    }
}