<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    function getContactForm(int $id, string $urlToken)
    {

        $isValidUrl = $this->ValidateClient($id, $urlToken);

        if ($isValidUrl) {
            $ClientFormData = ['id'=>$id,'urlToken'=>$urlToken];

            return View('contactForm',compact('ClientFormData'));
        } else {
            /*
                show error if url is invalid
            */
        }
    }

    function postContact(Request $request){
        $isValidUrl = $this->ValidateClient($request->ci,$request->curl);
       
        if($isValidUrl){
            $this->validate($request,$this->rules());

            $contactData = new Contact();
            $contactData->client_id = $request->ci;
            $contactData->name = $request->name;
            $contactData->email = $request->email;
            $contactData->phoneNumber = $request->phonenumber;
            $contactData->desireBudget = $request->budget;
            $contactData->message = $request->message;
            $contactData->save();

            return back()->with('success','Thank you for filling up this form');
        }
        else{
            return back()->with('err','Invalid Form Url !');
        }
    }

    public function rules() {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phonenumber'=> 'required|regex:/^[0-9]{10}$/',
            'budget'=>  'required|numeric',
            'message'=> 'required',
        ];
    }


    /**
     * ValidateClient Function
     *
     * Checks the validity of a client based on the provided user ID and URL token.
     *
     * This function queries the database to verify whether a client with the given user ID and URL token exists.
     *
     * @param int $id The user ID of the client to validate.
     * @param string $urlToken The URL token associated with the client.
     * @return bool Returns true if the client is valid, and false otherwise.
     * @throws \Throwable Throws any exceptions encountered during the validation process.
     */
    private function ValidateClient($id, $urlToken)
    {
        try {
            $isValidClient = User::where('id', $id)->where('urlToken', $urlToken)->count();
            return $isValidClient > 0;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
