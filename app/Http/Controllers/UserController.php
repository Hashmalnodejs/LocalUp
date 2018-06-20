<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = User::all();
        return view('admin.listing.users', ['users' => $users]);
    }

    public function getOneUser(User $user)
    {
        return view('admin.detail.user', ['user' => $user]);
    }

    public function getUser(Request $request)
    {
        $user = $request->user();
        return view('profil', ['user' => $user]);
    }

    public function updateUser(Request $request)
    {
        $user = $request->user();
        $validator = $user->validator($request->all());

        if ($validator->fails()) {
            return redirect()->route('user')
                ->withErrors($validator)
                ->withInput();
        }

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->phone = $request->phone;

        // If the password exist hash, or ignore.
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $request->session()->flash('success', 'Vos modifications ont bien été prises en compte.');

        return redirect()->route('user');
    }

    public function adminUpdateUser(Request $request, User $user)
    {
        $validator = $user->validator($request->all());

        if ($validator->fails()) {
            return redirect('user')
                ->withErrors($validator)
                ->withInput();
        }

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->phone = $request->phone;

        if ($request->admin) {
            $user->admin = true;
        } else {
            $user->admin = false;
        }

        // If the password exist hash, or ignore.
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $request->session()->flash('success', 'Vos modifications ont bien été prises en compte.');

        return redirect()->route('admin_user', ['user' => $user]);
    }

    public function destroyUser(Request $request, User $user)
    {
        if ($request->user()->id === $user->id) {
            $request->session()->flash('error', 'Vous ne pouvez pas supprimer votre compte.');
            return back();
        }

        $request->session()->flash('success', sprintf('L\'utilisateur %s %s a bien été supprimé', $user->firstname, $user->lastname));

        User::destroy($user->id);

        return back();
    }
}
