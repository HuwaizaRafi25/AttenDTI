<?php

namespace App\Http\Controllers\auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function index()
    {
        return redirect('/');
    }

    public function authenticate(Request $request)
    {
        // try {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $data = $request->all();
        // echo "pre"; print_r($data) ; die;

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $user_auth = User::find(Auth::id());
            activity()
                ->performedOn($user_auth)
                ->causedBy(auth()->user())
                ->event('login')
                ->log('User bernama ' . $user_auth->username . ' berhasil melakukan login');

            if (isset($data['remember']) && $data['remember'] == 'on') {
                // $remember_me = true;
                setcookie("email", $data['email'], time() + 3600);
                setcookie("password", $data['password'], time() + 3600);
            } else {
                // $remember_me = false;
                setcookie("email", "");
                setcookie("password", "");
            }

            notify()->success('Selamat Datang Kembali di attenDTI!', 'Hai👋');
            return redirect()->intended('overview');
        } else {
            // notify()->error('Username atau Password Anda Salah!', 'Gagal Login');
            return back()
                ->withErrors(['email' => 'Oops, it seems like the email or password you entered is incorrect. Try again!'])
                ->withInput($request->only('email', 'password'));
        }
        // } catch (\Exception $e) {
        //     Log::error('Gagal Login: ' . $e->getMessage(), [
        //         'exception' => $e
        //     ]);
        // }
    }

    public function forgotPassword()
    {
        return view('auth.forgotPassword');
    }

    public function forgotPasswordAct(Request $request)
    {
        // try {
        $customMessages = [
            'email.required' => 'Email cannot be empty! Please enter your email',
            'email.email' => 'Email is invalid! Please try again',
            'email.exists' => 'Email not found! Please try again',
        ];

        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], $customMessages);

        $resetToken = PasswordResetToken::where('email', $request->email)->first();

        $token = Str::random(60);
        $username = User::where('email', $request->email)->first();

        if ($resetToken) {
            $resetToken->update([
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
        } else {
            PasswordResetToken::create([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
        }

        Mail::to($username->email)->send(new ResetPasswordMail($token, $username));

        return redirect()->route('forgotPassword')->with(['success' => 'Password reset link has been sent to your email']);
    }

    public function validateForgotPassword(Request $request, $token)
    {
        $resetToken = PasswordResetToken::where('token', $token)->first();

        if (!$resetToken) {
            return redirect()->route('login')->withErrors(['token' => 'Invalid or expired reset link!']);
        }else{
            return view('auth.validateToken', compact('token'));
        }
    }

    public function validateForgotPasswordAct(Request $request){
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $resetToken = PasswordResetToken::where('token', $request->token)->first();
        if (!$resetToken) {
            return redirect()->route('login')->withErrors(['token' => 'Invalid or expired reset link!']);
        }

        $user = User::where('email', $resetToken->email)->first();
        if (!$user) {
            return redirect()->route('login')->withErrors(['token' => 'Invalid or expired reset link!']);
        }

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        $resetToken->delete();

        return redirect()->route('login')->with(['success' => 'Password has been reset successfully!']);
    }

    public function logout(Request $request)
    {
        $user = User::find(Auth::id());
        activity()
            ->performedOn($user)
            ->causedBy(auth()->user())
            ->event('logout')
            ->log('User bernama ' . $user->username . ' berhasil melakukan logout');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/');
    }
}
