<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        // $clients = Client::paginate(5);

        $clients = Client::when($request->search, function ($q) use ($request) {

            return $q->where('name', 'like', '%' . $request->search . '%')
            ->orwhere('phone', 'like', '%' . $request->search . '%')
            ->orwhere('address', 'like', '%' . $request->search . '%');


        })->latest()->paginate(5);

        return view('dashboard.clients.index', compact('clients'));
    } // end of index

    public function create()
    {
        return view('dashboard.clients.create');

    } // end of create

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3',
            'phone' => 'required',
            'address' => 'required'
        ]);


        Client::create($data);

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.clients.index');


    } // end of store


    public function edit(Client $client)
    {

        return view('dashboard.clients.edit', compact('client'));

    } // end of edit


    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name' => 'required|string|min:3',
            'phone' => 'required',
            'address' => 'required'
        ]);


        $client->update($data);

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.clients.index');

    } // end of update

    public function destroy(Client $client)
    {

        $client->delete();

        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('dashboard.clients.index');

    } // end of destroy
}// end of controller
