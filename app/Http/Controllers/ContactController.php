<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactCreateRequest;
use App\Http\Requests\ContactUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function createContact(ContactCreateRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();

        if (!$user instanceof \Illuminate\Database\Eloquent\Model) {
            return back()->with('error', 'User not found or not an Eloquent model instance.');
        }

        $contact = $user->contacts()->create($data);
        return back()->with('success', 'Contact created successfully.');
    }

    public function get(Request $request)
    {
        $user = Auth::user();

        if (!$user instanceof \Illuminate\Database\Eloquent\Model) {
            return back()->with('error', 'User not found or not an Eloquent model instance.');
        }

        $search = $request->input('search');
        $contacts = $user->contacts()
            ->when($search, function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%');
            })
            ->paginate(5);

        return view('contact', compact('contacts'));
    }

    public function editContact($id)
    {
        $user = Auth::user();

        if (!$user instanceof \Illuminate\Database\Eloquent\Model) {
            return back()->with('error', 'User not found or not an Eloquent model instance.');
        }

        $contact = $user->contacts()->findOrFail($id);
        return view('updateContact', compact('contact'));
    }

    public function updateContact(ContactUpdateRequest $request, $id)
    {
        $user = Auth::user();

        if (!$user instanceof \Illuminate\Database\Eloquent\Model) {
            return redirect()->route('get.contact')->with('error', 'User not found or not an Eloquent model instance.');
        }

        $contact = $user->contacts()->findOrFail($id);
        $contact->update($request->validated());

        return redirect()->route('get.contact')->with('success', 'Contact updated successfully.');
    }

    public function deleteContact($id)
    {
        $user = Auth::user();

        if (!$user instanceof \Illuminate\Database\Eloquent\Model) {
            return redirect()->route('get.contact')->with('error', 'User not found or not an Eloquent model instance.');
        }

        $contact = $user->contacts()->findOrFail($id);
        $contact->delete();

        return redirect()->route('get.contact')->with('success', 'Contact deleted successfully.');
    }
}
