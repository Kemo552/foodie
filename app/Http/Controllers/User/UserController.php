<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public $class = 'sub_page';
    public function login(Request $request)
    {
        return view('user.auth.login')
            ->with('class', $this->class);
    }

    public function register(Request $request)
    {
        return view('user.auth.register')->with('class', $this->class);
    }

    public function sign_in(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|string',
                'password' => 'required',
            ]
        );
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            if ($request->username == 'admin') {
                return redirect('/dashboard/main');
            }
            return view('user.home', ['class' => null]);
        }
        return redirect()->back()->with('msg', "Username or password is wrong!")
            ->with('msg_cls', "danger");
    }

    public function sign_up(UserRequest $data)
    {
        try {
            if ($data->hasFile('imageUrl')) {
                $file = $data['imageUrl'];
                $file_name = time() . '.' . $file->getClientOriginalExtension();
                $data['imageUrl']->move('images\user', $file_name);
            } else {
                $file_name = 'no_image.png';
            }

            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'zip' => $data['zip'],
                'password' => Hash::make($data['password']),
                'imageUrl' => $file_name,
            ]);

            Auth::login($user);
            return redirect()->route('profile')
                ->with('msg', "User has been registred successfully")
                ->with('msg_cls', "success");
        } catch (Exception $ex) {
            return redirect()->back()
                ->with('msg', $ex->getMessage())
                ->with('msg_cls', "warning");
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', ['class' => 'sub_page', 'user' => $user]);
    }

    public function edit_form(Request $request)
    {
        return view('user.auth.register')->with('edit', $request->edit)->with('class', $this->class);
    }
    public function edit(EditProfileRequest $data)
    {
        // get current authenticated user
        $user = User::findOrFail(auth()->id());

        if ($data->hasFile('imageUrl')) {
            $file = $data->imageUrl;
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $data->imageUrl->move('images\user', $file_name);
        } else if ($user->imageUrl != null) {
            $file_name = $user->imageUrl;
        } else {
            $file_name = 'no_image.png';
        }

        // update data
        $user->name = $data['name'] ?? $user->name;
        $user->username = $data['username'] ?? $user->username;
        $user->email = $data['email'] ?? $user->email;
        $user->address = $data['address'] ?? $user->address;
        $user->password = Hash::make($data['password']) ?? $user->password;
        $user->phone = $data['phone'] ?? $user->phone;
        $user->zip = $data['zip'] ?? $user->zip;
        $user->imageUrl = $file_name;
        $user->update();

        // response
        return redirect()->route('profile')
            ->with('msg', "Your data has been updated successfully!")
            ->with('msg_cls', "success");

    }
}