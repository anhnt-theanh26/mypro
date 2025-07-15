<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Category\Entities\Category;
use Modules\Category\Http\Requests\StoreCategoryRequest;
use Modules\Category\Http\Requests\UpdateCategoryRequest;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categories = Category::get();
        return view('category::index', compact('categories'));
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
    public function show(Category $category)
    {
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Category $category)
    {
        $category = Category::withTrashed()->where('id', $category->id)->first();
        return view('category::edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $category = Category::withTrashed()->where('id', $category->id)->first();
            if (!$category) {
                Alert::error('Có lỗi xảy ra', 'Khong tim thay danh muc');
                return redirect()->back()->with('error', 'Khong tim thay danh muc!');
            }
            $originalSlug = Str::slug($request->name);
            $newSlug = $originalSlug;
            $count = 1;
            while (
                Category::withTrashed()->where('slug', $newSlug)->where('id', '!=', $category->id)->exists()
            ) {
                $newSlug = $originalSlug . '-' . $count++;
            }
            $data = [
                'name' => $request->name,
                'slug' => $newSlug,
                'is_hot' => $request->has('is_hot') ? true : false,
                'category_parent_id' => $request->category_parent_id,
                'image' => $request->image,
            ];
            $category->update($data);
            Alert::success('Thanh cong', 'Cập nhật danh mục thành công');
            // return redirect()->route('admin.category.index')->with('success', 'Cập nhật thành công!');
            return redirect()->back()->with('success', 'Cập nhật thành công!');
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

    public function destroy(Category $category)
    {
        try {
            $category = Category::onlyTrashed()->where('id', $category->id)->first();
            if (!$category) {
                Alert::error('Có lỗi xảy ra', 'Khong tim thay danh muc');
                return redirect()->back()->with('error', 'Khong tim thay danh muc!');
            }
            $category->forceDelete();
            Alert::success('Thanh cong', 'Xoa danh muc thanh cong');
            return redirect()->back()->with('success', 'Xoa danh muc thanh cong!');
        } catch (\Throwable $th) {
            Alert::error('Có lỗi xảy ra:', $th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }

    public function delete(Request $request, Category $category)
    {
        try {
            $category = Category::find($category->id);
            if (!$category) {
                Alert::error('Có lỗi xảy ra', 'Không tìm thấy danh mục');
                return redirect()->back()->with('error', 'Không tìm thấy danh mục!');
            }
            $category->delete();
            Alert::success('Thành công', 'Xóa danh mục thành công');
            return redirect()->back()->with('success', 'Xóa danh mục thành công!');
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
        $categories = Category::onlyTrashed()->orderByDesc('id')->get();
        return view('category::restore', compact('categories'));
    }

    public function restore(Category $category)
    {
        try {
            $category = Category::withTrashed()->where("id", $category->id)->first();
            if (!$category) {
                Alert::error('Có lỗi xảy ra', 'Khong tim thay danh muc');
                return redirect()->back()->with('error', 'Khong tim thay danh muc!');
            }
            $category->restore();
            Alert::success('Thanh cong', 'Khoi phuc danh muc thanh cong');
            return redirect()->back()->with('success', 'Khoi phuc danh muc thanh cong!');
        } catch (\Throwable $th) {
            Alert::error('Có lỗi xảy ra:', $th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }
}
