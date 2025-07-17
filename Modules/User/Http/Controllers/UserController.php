<?php

namespace Modules\User\Http\Controllers;

use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\ChangePasswordUserRequest;
use Modules\User\Http\Requests\StoreUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $users = User::get();
        return view('user::index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $data = [
                'name' => $request['name'],
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'phone' => $request['phone'],
                'address' => $request['address'],
                'birthday' => $request['birthday'],
                'email_verified_at' => Carbon::now(),
            ];
            if ($request->hasFile('image')) {
                $imagePath = 'storage/' . $request->file('image')->store('avatar', 'public');
                $data['image'] = $imagePath;
            }
            User::create($data);
            Alert::success('Thanh cong', 'Them moi user thanh cong');
            return redirect()->route('admin.user.index')->with('success', 'Thêm mới user thành công');
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
    public function show(User $user)
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(string $id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        return view('user::edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user = User::withTrashed()->where('id', $user->id)->first();
        if (!$user) {
            Alert::error('Khong tim thay user:');
            return redirect()->back()->with('error', 'Khong tim thay user');
        }
        try {
            $data = [
                'name' => $request['name'],
                'username' => $request['username'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'birthday' => $request['birthday'],
            ];
            if ($request->hasFile('image')) {
                if ($user->image && file_exists(public_path($user->image))) {
                    unlink(public_path($user->image));
                }
                $imagePath = 'storage/' . $request->file('image')->store('avatar', 'public');
                $data['image'] = $imagePath;
                if ($imagePath != null) {
                    if ($user->image != null && file_exists(public_path($user->image))) {
                        unlink(public_path($user->image));
                    }
                }
            }
            $user->update($data);
            Alert::success('Thanh cong', 'Chinh sua user thanh cong');
            return redirect()->back()->with('success', 'Chinh sua user thành công');
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
    public function destroy(string $id)
    {
        try {
            $user = User::onlyTrashed()->where('id', $id)->first();
            if (!$user) {
                Alert::error('Khong thay user', 'user khong ton tai');
                return redirect()->back()->with('error', 'Khong tim thay user!');
            }
            if ($user->image != null && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
            $user->forceDelete();
            Alert::success('Thanh cong', 'Xoa vinh vien user thanh cong');
            return redirect()->back()->with('success', 'Xoa user thanh cong!');
        } catch (\Throwable $th) {
            Alert::error('Có lỗi xảy ra:', $th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }

    public function delete(Request $request, string $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                Alert::error('Có lỗi xảy ra', 'Không tìm thấy người dùng');
                return redirect()->back()->with('error', 'Không tìm thấy người dùng!');
            }
            if ($user->image != null && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
            $user->update(['image' => '']);
            $user->delete();
            Alert::success('Thành công', 'Xóa người dùng thành công');
            return redirect()->back()->with('success', 'Xóa người dùng thành công!');
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
        $users = User::onlyTrashed()->get();
        return view('user::restore', compact('users'));
    }

    public function restore(string $id)
    {
        try {
            $user = User::withTrashed()->where("id", $id)->first();
            if (!$user) {
                Alert::error('Có lỗi xảy ra', 'Khong tim thay người dùng');
                return redirect()->back()->with('error', 'Khong tim thay người dùng!');
            }
            $user->restore();
            Alert::success('Thanh cong', 'Khoi phuc người dùng thanh cong');
            return redirect()->back()->with('success', 'Khoi phuc người dùng thanh cong!');
        } catch (\Throwable $th) {
            Alert::error('Có lỗi xảy ra:', $th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }

    public function password(Request $request, ChangePasswordUserRequest $user)
    {
        try {
            $user = User::withTrashed()->find($user->id);
            if (!$user) {
                Alert::error('Khong tim thay user:');
                return redirect()->back()->with('error', 'Khong tim thay user');
            }
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->with('password_is_incorrect', 'Mat khau cu khong dung!!');
            }
            if (Hash::check($request->new_password, $user->password)) {
                return redirect()->back()->with('oldpassword_like_newpassword', 'Mat khau mới không được giống mật khẩu cũ!!');
            }
            $data = [
                'password' => Hash::make($request['new_password']),
            ];
            $user->update($data);
            Alert::success('Thanh cong', 'Cap nhap mat khau user thanh cong');
            return redirect()->back()->with('success', 'Cap nhap mat khau user thanh cong');
        } catch (\Throwable $th) {
            Alert::error('Có lỗi xảy ra:', $th->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }
}
