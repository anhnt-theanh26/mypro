<?php

namespace Modules\Login\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('login::index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email-phone' => 'required',
            'password' => 'required',
        ]);
        try {
            $login = $request->input('email-phone');
            $password = $request->input('password');
            $remember = $request->has('remember') ? true : false;
            $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
            $user = User::where($fieldType, $login)->first();
            if (!$user || !Hash::check($password, $user->password)) {
                Alert::error("Thông tin không chính xác", "Email/SĐT hoặc mật khẩu không đúng.");
                return redirect()->back()->withInput()->with("error", "Email/SĐT hoặc mật khẩu không đúng.");
            }
            if ($user->email_verified_at === null) {
                Alert::error('Chưa xác minh email', 'Vui lòng xác minh email trước khi đăng nhập.');
                return redirect()->back()->withInput()->with("error", "Tài khoản chưa xác minh email.");
            }
            Auth::login($user, $remember);
            Alert::success('Đăng nhập thành công', 'Xin chào: ' . $user->name);
            return redirect()->route('admin.category.index');
        } catch (\Throwable $th) {
            Alert::error('Có lỗi xảy ra:', $th->getMessage());
            return redirect()->back()->with("error", 'Có lỗi xảy ra: ' . $th->getMessage());
        }
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('admin.login');
        }
        return redirect()->route('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('login::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('login::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('login::edit');
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
}
