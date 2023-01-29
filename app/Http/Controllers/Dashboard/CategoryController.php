<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Request $request) {

         $categories = Category::where(function ($q) use ($request) {

            return $q->when($request->search, function ($query) use ($request) {

                return $query->where('name', 'like', '%' . $request->search . '%')

                    ->orWhere('name', 'like', '%' . $request->search . '%');
            });
        })->latest()->paginate(5);


        return view('dashboard.categories.index', compact('categories'));

    }// end of index

    public function create()
    {
        return view('dashboard.categories.create');
    }// end of create

    public function store(Request $request)
    {


        // dd($request->all());
        $data = $request->validate([
            'name' => 'required',
        ]);




        Category::create($data);

        // $user->attachRole('admin');

        // $user->syncPermissions($request->permissions);
        // dd($data);


        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.categories.index');
    }// end of store

    public function edit(Category $category) {

        return view('dashboard.categories.edit', compact('category'));

    }//end of edit

    public function update(Request $request, Category $category) {

        // dd($request->all());
        $data = $request->validate([
            'name' => 'required',
        ]);




        $category->update($data);




        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.categories.index');

    }// end of update

    public function destroy(Category $category) {

        $category->delete();

        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('dashboard.categories.index');

    }// end of destroy


}
