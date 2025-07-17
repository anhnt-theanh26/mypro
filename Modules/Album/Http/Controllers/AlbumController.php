<?php

namespace Modules\Album\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Album\Entities\Album;
use Modules\Album\Http\Requests\StoreAlumRequest;
use RealRashid\SweetAlert\Facades\Alert;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $albums = Album::get();
        return view('album::index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('album::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreAlumRequest $request)
    {
        try {
            $originalSlug = Str::slug($request['name']);
            $slug = $originalSlug;
            $count = 1;
            while (Album::withTrashed()->where('slug', $slug)->exists()) {
                $slug = $originalSlug + '-' + $count;
            }
            $data = [
                'name' => $request['name'],
                'slug' => $slug,
                'artist' => $request['artist'],
                'thumbnail' => $request['thumbnail'],
                'release_date' => $request['release_date'],
                'is_hot' => $request['is_hot'] ? true : false,
            ];
            Album::create($data);
            Alert::success('Album', 'Thêm album thành công');
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
        return view('album::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $album = Album::withTrashed()->find($id);
        return view('album::edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Album $album)
    {
        try {
            $album = Album::withTrashed()->where('id', $album->id)->first();
            if (!$album) {
                Alert::error('Có lỗi xảy ra', 'Khong tim thay album');
                return redirect()->back()->with('error', 'Khong tim thay album!');
            }
            $originalSlug = Str::slug($request->name);
            $newSlug = $originalSlug;
            $count = 1;
            while (Album::withTrashed()->where('slug', $newSlug)->where('id', '!=', $album->id)->exists()) {
                $newSlug = $originalSlug . '-' . $count++;
            }
            $data = [
                'name' => $request['name'],
                'slug' => $newSlug,
                'artist' => $request['artist'],
                'thumbnail' => $request['thumbnail'],
                'release_date' => $request['release_date'],
                'is_hot' => $request['is_hot'] ? true : false,
            ];
            $album->update($data);
            Alert::success('Album', 'Thêm album thành công');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Có lỗi xảy ra:', $th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            $album = Album::onlyTrashed()->where('id', $id)->first();
            if (!$album) {
                Alert::error('Có lỗi xảy ra', 'Khong tim thay album');
                return redirect()->back()->with('error', 'Khong tim thay album!');
            }
            $album->forceDelete();
            Alert::success('Thanh cong', 'Xoa album thanh cong');
            return redirect()->back()->with('success', 'Xoa album thanh cong!');
        } catch (\Throwable $th) {
            Alert::error('Có lỗi xảy ra:', $th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }

    public function delete(Request $request, string $id)
    {
        try {
            $album = Album::find($id);
            if (!$album) {
                Alert::error('Có lỗi xảy ra', 'Không tìm thấy album');
                return redirect()->back()->with('error', 'Không tìm thấy album!');
            }
            $album->delete();
            Alert::success('Thành công', 'Xóa album thành công');
            return redirect()->back()->with('success', 'Xóa album thành công!');
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
        $albums = Album::onlyTrashed()->get();
        return view('album::restore', compact('albums'));
    }

    public function restore(string $id)
    {
        try {
            $album = Album::withTrashed()->where("id", $id)->first();
            if (!$album) {
                Alert::error('Có lỗi xảy ra', 'Khong tim thay album');
                return redirect()->back()->with('error', 'Khong tim thay album!');
            }
            $album->restore();
            Alert::success('Thanh cong', 'Khoi phuc album thanh cong');
            return redirect()->back()->with('success', 'Khoi phuc album thanh cong!');
        } catch (\Throwable $th) {
            Alert::error('Có lỗi xảy ra:', $th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }
}
