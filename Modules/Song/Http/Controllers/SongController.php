<?php

namespace Modules\Song\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Album\Entities\Album;
use Modules\Category\Entities\Category;
use Modules\Song\Entities\Song;
use Modules\Song\Http\Requests\StoreSongRequest;
use Modules\Song\Http\Requests\UpdateSongRequest;
use RealRashid\SweetAlert\Facades\Alert;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $songs = Song::with('album', 'category')->get();
        return view('song::index', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $albums = Album::all();
        $categories = Category::all();
        return view('song::create', compact('albums', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreSongRequest $request)
    {
        try {
            $originalSlug = Str::slug($request['name']);
            $slug = $originalSlug;
            $count = 1;
            while (Song::withTrashed()->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count;
            }
            $data = [
                'name' => $request['name'],
                'slug' => $slug,
                'artist' => $request['artist'],
                'album_id' => $request['album_id'],
                'cover_art' => $request['cover_art'],
                'file_path' => $request['file_path'],
                'type' => $request['type'],
                'duration' => $request['duration'],
                'release_date' => $request['release_date'],
                'category_id' => $request['category_id'],
            ];
            Song::create($data);
            Alert::success('Song', 'Thêm bài nhạc thành công');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Có lỗi xảy ra:', $th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('song::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $song = Song::withTrashed()->find($id);
        $albums = Album::all();
        $categories = Category::all();
        return view('song::edit', compact('song', 'albums', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateSongRequest $request, Song $song)
    {
        try {
            $song = Song::withTrashed()->where('id', $song->id)->first();
            $originalSlug = Str::slug($request->name);
            $newSlug = $originalSlug;
            $count = 1;
            while (Song::withTrashed()->where('slug', $newSlug)->where('id', '!=', $song->id)->exists()) {
                $newSlug = $originalSlug . '-' . $count++;
            }
            $data = [
                'name' => $request['name'],
                'slug' => $newSlug,
                'artist' => $request['artist'],
                'album_id' => $request['album_id'],
                'type' => $request['type'],
                'duration' => $request['duration'],
                'release_date' => $request['release_date'],
                'category_id' => $request['category_id'],
            ];
             if($request->cover_art){
                $data['cover_art'] = $request['cover_art'];
            }
             if($request->file_path){
                $data['file_path'] = $request['file_path'];
            }
            $song->update($data);
            Alert::success('Song', 'Sửa bài nhạc thành công');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Có lỗi xảy ra:', $th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $song = Song::onlyTrashed()->where('id', $id)->first();
            if (!$song) {
                Alert::error('Có lỗi xảy ra', 'Không tìm thấy bài nhạc');
                return redirect()->back()->with('error', 'Không tìm thấy bài nhạc!');
            }
            $song->forceDelete();
            Alert::success('Thanh cong', 'Xoa bai nhac thanh cong');
            return redirect()->back()->with('success', 'Xoa bai nhac thanh cong!');
        } catch (\Throwable $th) {
            Alert::error('Có lỗi xảy ra:', $th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }

    public function delete(Request $request, string $id)
    {
        try {
            $song = Song::find($id);
            if (!$song) {
                Alert::error('Có lỗi xảy ra', 'Không tìm thấy bài nhạc');
                return redirect()->back()->with('error', 'Không tìm thấy bài nhạc!');
            }
            $song->delete();
            Alert::success('Thành công', 'Xóa bài nhạc thành công');
            return redirect()->back()->with('success', 'Xóa bài nhạc thành công!');
        } catch (\Throwable $th) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Có lỗi xảy ra: ' . $th->getMessage()], 500);
            }
            Alert::error('Có lỗi xảy ra:', $th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }

    public function deleted()
    {
        $songs = Song::onlyTrashed()->with('album', 'category')->get();
        return view('song::restore', compact('songs'));
    }

    public function restore(string $id)
    {
        try {
            $song = Song::withTrashed()->where("id", $id)->first();
            if (!$song) {
                Alert::error('Có lỗi xảy ra', 'Không tìm thấy bài nhạc');
                return redirect()->back()->with('error', 'Không tìm thấy bài nhạc!');
            }
            $song->restore();
            Alert::success('Thanh cong', 'Khôi phục bài nhạc thành công');
            return redirect()->back()->with('success', 'Khôi phục bài nhạc thành công!');
        } catch (\Throwable $th) {
            Alert::error('Có lỗi xảy ra:', $th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }
}
