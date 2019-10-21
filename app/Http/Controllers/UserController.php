<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct() { $this->middleware('auth'); }

    public function index() { return (Auth::user()->is_admin) ? view('pages.users.index')->with('users', User::where('is_admin', 0)->get()) : redirect('/account'); }

    public function create() {
        if (Auth::user()->is_admin) return view('pages.users.create');
        return redirect('/account');
    }

    public function store(Request $request) {
        if (Auth::user()->is_admin) {

            $validatedData = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed'
            ]);

            if ($validatedData->fails()) return redirect()->back()->withErrors($validatedData)->withInput();

            $user = new User(array(
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password'))
            ));

            $user->save();

            return redirect('/users')
                ->with('success', 'Added new user ' . $request->input('name') . ' Successfully!')
                ->with('users', User::where('is_admin', 0)->get());
        }

        return redirect('/account');
    }

    public function show($id) { return (Auth::user()->is_admin) ? view('pages.users.show')->with('user', User::find($id)) : redirect('/account'); }

    public function edit($id) { return (Auth::user()->is_admin) ? view('pages.users.edit')->with('user', User::find($id)) : redirect('/account'); }

    public function update(Request $request, $id) {
        if (Auth::user()->is_admin) {

            $user = User::find($id);
            if ($user->email == $request->input('email'))
                $validatedData = $request->validate(['name' => 'required']);
            else
                $validatedData = $request->validate([
                    'name' => 'required',
                    'email' => 'required|max:255|unique:users'
                ]);

            $user->name = $validatedData['name'];
            $user->email = $request->input('email');
            $user->save();

            return redirect('/users/'. $user->id)
                ->with('success', 'Updated user ' . $validatedData['name'] . ' Successfully!');
        }

        return redirect('/account');
    }

    public function destroy($id) {
        if (Auth::user()->is_admin) {
            $user = User::find($id);
            $user->delete();
            return redirect('/users')->with('success', 'Deleted user ' . $user->name . ' Successfully!');
        }

        return redirect('/account');
    }

    // CHANGE PASSWORD
    public function showChangePasswordForm(Request $request){ return (Auth::user()->is_admin) ? view('pages.users.changepassword')->with('user', User::find($request->get('id'))) : redirect('/account'); }

    public function changePassword(Request $request){
        if (Auth::user()->is_admin) {
            $user = User::find($request->input('id'));
            $validatedData = $request->validate([
                'new-password' => 'required|string|min:6|confirmed',
            ]);

            $user->password = bcrypt($validatedData['new-password']);
            $user->save();

            return redirect('/users/' . $user->id)->with("success", "User's Password Changed Successfully !");
        }

        return redirect('/account');
    }
}
