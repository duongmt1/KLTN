<?php

namespace App\Http\Controllers\Page\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StudentLoginRequest;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //$this->middleware('guest')->except('logout');
        $this->user = $user;
    }

    public function login()
    {
        if (Auth::guard('students')->check()) {
            return redirect()->back();
        }
        return view('page.auth.login');
    }

    /**
     * Xử lý thực hiện đăng nhập trang admin
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(StudentLoginRequest $request)
    {
        $data = $request->except('_token', 'remember');
        $remember = false;
        if ($request->remember) {
            $remember = true;
        };
        $user = $this->user->getInfoEmail($data['email']);

        if (!$user) {
            return redirect()->back()->with('danger', 'Thông tin tài khoản không tồn tại');
        }

        if ($user->type == User::TEACHER)
        {
            return redirect()->back()->with('danger', 'Thông tin tài khoản không tồn tại');
        }

        if (Auth::guard('students')->attempt($data, $remember)) {
            return redirect()->route('user.home');
        }
        return redirect()->back()->with('danger', 'Đăng nhập thất bại.');
    }

    public function logout()
    {
        Auth::guard('students')->logout();
        return redirect()->route('user.login');
    }

}
