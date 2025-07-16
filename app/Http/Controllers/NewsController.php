<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();
        return view('pages.admin.masterdata.berita.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.masterdata.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
        }

        $news = new News();
        $news->title = $validatedData['title'];
        $news->content = $validatedData['content'];
        $news->image = $imageName;
        $news->save();

        Alert::success('Success', 'Berhasil Menambahkan Berita');
        return redirect()->route('berita.index')->with('success', 'Berita berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news, $id)
    {
        $berita = News::find(decrypt($id));
        $beritas = News::latest()->take(10)->get();
        return view('pages.show', compact('berita', 'beritas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news, $id)
    {
        $berita = News::find(decrypt($id));

        return view('pages.admin.masterdata.berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news, $id)
    {
        $news = News::find($id);

        $validatedData = $request->validate([
            'title' => 'string|max:255',
            'content' => 'string',
            'image' => 'max:2048',
        ]);

        if ($request->hasFile('image')) {
            // delete
            if ($news->image) {
                Storage::delete('images/' . $news->image);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
        }

        $news->title = $validatedData['title'];
        $news->content = $validatedData['content'];
        if ($request->hasFile('image')) {
            $news->image = $imageName;
        }
        $news->save();

        Alert::success('Success', 'Berhasil Mengedit Berita');
        return redirect()->route('berita.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news, $id)
    {
        News::destroy($id);
        Alert::success('Success', 'Berhasil Menghapus Berita');
        return redirect()->route('berita.index');
    }
}
