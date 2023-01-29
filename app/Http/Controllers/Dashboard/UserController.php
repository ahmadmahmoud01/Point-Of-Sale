<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // public function __construct()
    // {

        // $this->middleware(['permission:read_users'])->only('index');
        // $this->middleware(['permission:create_users'])->only('create');
        // $this->middleware(['permission:update_users'])->only('edit');
        // $this->middleware(['permission:delete_users'])->only('destroy');

    // }
    public function index(Request $request)
    {
        // if($request->search){
        //     $users = User::where('first_name', 'like', '%' . $request->search . '%')
        //     ->orwhere('last_name', 'like', '%' . $request->search . '%')->get();

        // } else {

        // $users = User::whereRoleIs('admin')->get();

        // }

        $users = User::whereRoleIs('admin')->where(function ($q) use ($request) {

            return $q->when($request->search, function ($query) use ($request) {

                return $query->where('first_name', 'like', '%' . $request->search . '%')

                    ->orWhere('last_name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(5);





        return view('dashboard.users.index', compact('users'));
    }


    public function create()
    {
        return view('dashboard.users.create');
    }


    public function store(Request $request)
    {

        // dd($request->permissions);

        // dd($request->all());
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'img' => 'required|image',
            'password' => 'required|confirmed',
        ]);

        $data = $request->except(['img', 'password', 'password_confirmation', 'permissions']);
        $data['password'] = bcrypt($request->password);


        if ($request->img) {

            Image::make($request->img)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $request->img->hashName()));
        }

        $data['img'] = $request->img->hashName();




        $user = User::create($data);

        $user->attachRole('admin');

        $user->syncPermissions($request->permissions);
        // dd($data);


        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.users.index');
    }


    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        // dd($request->permissions);

        // dd($request->all());
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'img' => 'required|image',
            'email' => [
                'required',
                Rule::unique('users')->ignore($user->id)
            ],
            // 'password' => 'required|confirmed',
        ]);

        $data = $request->except(['permissions', 'img']);
        // $data['password'] = bcrypt($request->password);

        if ($request->img) {

            if ($user->img !== 'default.png') {

                Storage::disk('public_uploads')->delete('user_images/' . $user->img);
            }

            Image::make($request->img)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $request->img->hashName()));

            $data['img'] = $request->img->hashName();
        }

        $user->update($data);

        $user->attachRole('admin');

        // $user->attachPermissions($request->permissions);

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.users.index');
    }


    public function destroy(User $user)
    {

        Storage::disk('public_uploads')->delete('user_images/' . $user->img);

        $user->delete();

        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('dashboard.users.index');
    }
}
