<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('username', '<>', 'admin')->get();
        return view('dashboard.users')
            ->with('page', 'Users')
            ->with('users', $users);
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()
                ->route('user.index')
                ->with('msg', 'User has been removed successfully')
                ->with('msg_cls', 'success');
        } catch (Exception $ex) {
            return redirect()->back()->with('msg', $ex->getMessage())->with('msg_cls', 'warning');
        }
    }
}