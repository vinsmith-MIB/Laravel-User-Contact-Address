<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressCreateRequest;
use App\Http\Requests\AddressUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index(int $idContact, Request $request)
{
    $user = Auth::user();
    if (!$user instanceof \Illuminate\Database\Eloquent\Model) {
        return back()->with('error', 'User not found or not an Eloquent model instance.');
    }

    $contact = $user->contacts()->findOrFail($idContact);
    $search = $request->input('search');
    $addresses = $contact->addresses()
        ->when($search, function ($query) use ($search) {
            $query->where('street', 'like', '%' . $search . '%')
                ->orWhere('city', 'like', '%' . $search . '%')
                ->orWhere('province', 'like', '%' . $search . '%')
                ->orWhere('country', 'like', '%' . $search . '%')
                ->orWhere('postal_code', 'like', '%' . $search . '%');
        })
        ->paginate(5);
    $totalAddresses = $addresses->total();

    return view('Addresses.create', compact('addresses', 'idContact', 'totalAddresses', 'search'));
}

    
    public function create(int $idContact)
    {
        $user = Auth::user();
        if (!$user instanceof \Illuminate\Database\Eloquent\Model) {
            return back()->with('error', 'User not found or not an Eloquent model instance.');
        }

        $contact = $user->contacts()->findOrFail($idContact);
        return view('Addresses.create', compact('idContact'));
    }

    public function store(int $idContact, AddressCreateRequest $request)
    {
        $user = Auth::user();
        if (!$user instanceof \Illuminate\Database\Eloquent\Model) {
            return back()->with('error', 'User not found or not an Eloquent model instance.');
        }

        $contact = $user->contacts()->findOrFail($idContact);
        $data = $request->validated();
        $address = $contact->addresses()->create($data);

        return redirect()->route('addresses.index', ['idContact' => $contact->id])->with('success', 'Address created successfully');
    }

    public function edit(int $idContact, int $idAddress)
    {
        $user = Auth::user();
        if (!$user instanceof \Illuminate\Database\Eloquent\Model) {
            return back()->with('error', 'User not found or not an Eloquent model instance.');
        }

        $contact = $user->contacts()->findOrFail($idContact);
        $addresses = $contact->addresses()->paginate(5);
        $address = $contact->addresses()->findOrFail($idAddress);
        
        $totalAddresses = $contact->addresses()->count();
        return view('addresses.update', compact('address', 'idContact', 'totalAddresses', 'addresses'));
    }

    public function update(int $idContact, int $idAddress, AddressUpdateRequest $request)
    {
        $user = Auth::user();
        if (!$user instanceof \Illuminate\Database\Eloquent\Model) {
            return redirect()->route('addresses.index', ['idContact' => $idContact])->with('error', 'User not found or not an Eloquent model instance.');
        }

        $contact = $user->contacts()->findOrFail($idContact);
        $address = $contact->addresses()->findOrFail($idAddress);
        $data = $request->validated();
        $address->update($data);

        return redirect()->route('addresses.index', ['idContact' => $contact->id])->with('success', 'Address updated successfully');
    }

    public function destroy(int $idContact, int $idAddress)
    {
        $user = Auth::user();
        if (!$user instanceof \Illuminate\Database\Eloquent\Model) {
            return redirect()->route('addresses.index', ['idContact' => $idContact])->with('error', 'User not found or not an Eloquent model instance.');
        }

        $contact = $user->contacts()->findOrFail($idContact);
        $address = $contact->addresses()->findOrFail($idAddress);
        $address->delete();

        return redirect()->route('addresses.index', ['idContact' => $contact->id])->with('success', 'Address deleted successfully');
    }
}
