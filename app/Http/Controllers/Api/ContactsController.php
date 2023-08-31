<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{
    public function exportContacts()
    {
        if (!Auth::guard('api')->check()) {
            return response()->json([
                'error' => true,
                'status' => 400,
                'message' => 'Unauthorized',
            ]);
        }


        $LoggedinUser = Auth::guard('api')->user()->id;

        $contacts = Contact::where('client_id',$LoggedinUser)->get()->toArray();
       
        return response()->json([
            'error' => false,
            'status' => 200,
            'data' => $contacts
        ]);
    }
}
