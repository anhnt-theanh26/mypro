<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Category\Entities\Category;
use Modules\Category\Http\Requests\StoreCategoryRequest;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('category::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('category::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $originalSlug = Str::slug($request['name']);
            $slug = $originalSlug;
            $count = 1;
            while (Category::withTrashed()->where('slug', $slug)->exists()) {
                $slug = $originalSlug + '-' + $count;
            }
            $data = [
                'name' => $request['name'],
                'slug' => $slug,
                'is_hot' => $request['is_hot'] ? true : false,
                'image' => $request['image'],
            ];
            Category::create($data);
            Alert::success('Danh mục', 'Thêm danh mục thành công');
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
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('category::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function deleted()
    {
        return view('category::restore');
    }
}
