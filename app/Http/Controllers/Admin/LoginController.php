<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
  public function show_login_view()
  {
    return view('admin.auth.login');
  }

  public function login(LoginRequest $request)
  {
    if (auth()->guard('admin')->attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
      return redirect()->route('admin.dashboard');
    } else {
      return redirect()->route('admin.showlogin')->withInput($request->only('username'))
        ->with('error', __('messages.invalid_credentials'));
    }
  }

  public function logout()
  {
    auth()->logout();
    return redirect()->route('admin.showlogin');
  }

  public function editlogin($id)
  {
    $data = $this->ownAccount($id);
    return view('admin.auth.edit', compact('data'));
  }

  public function updatelogin(Request $request, $id)
  {
    $admin = $this->ownAccount($id);

    $request->validate([
      'username' => 'required|string|max:100|unique:admins,username,' . $admin->id,
      'password' => 'nullable|string|min:8|confirmed',
    ], [], [
      'username' => __('messages.username_label'),
      'password' => __('messages.password_label'),
    ]);

    $admin->username = $request->input('username');
    if ($request->filled('password')) {
      $admin->password = Hash::make($request->input('password'));
    }
    $admin->save();

    // Sign in again with the new credentials.
    auth()->logout();
    return redirect()->route('admin.showlogin')->with('success', __('messages.account_updated_login'));
  }

  /** An admin may only edit their own account. */
  private function ownAccount($id): Admin
  {
    abort_unless((int) $id === (int) auth()->id(), 403, __('messages.forbidden'));

    return Admin::findOrFail($id);
  }
}
