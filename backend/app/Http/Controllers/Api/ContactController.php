<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($data);

        // TODO: send email to admin (mail configuration required)

        return response()->json(['message' => 'Contact submitted', 'data' => $contact], 201);
    }
}
