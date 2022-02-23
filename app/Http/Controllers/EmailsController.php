<?php

namespace App\Http\Controllers;

use App\Models\Emails;
use Illuminate\Http\Request;
use Mail;
use App\Mail\SendEmail;

class EmailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index(){


        if (auth()->user()->profile_id != 1 ) {
            $emails = Emails::get()->where('created_by', '=', auth()->user()->id);
        }else{
            $emails = Emails::get();
        }




        return view('emails.index',[
            'emails' => $emails,
        ]);

    }

    public function create(){


        return view('emails.create',[
        ]);

    }

    public function store(Request $request){


        //use Illuminate\Support\Facades\Hash;

        $request->validate([
            'subject' => 'required',
            'addressee' => 'required|email',
            'bodytext' => 'required',
        ],[
            'subject.required' => 'El asunto es requerido',
            'addressee.required' => 'El email es requerido',
            'addressee.email' => 'El email es no tiene el formato correcto',
            'bodytext.required' => 'El cuerpo es requerido',
        ]

    );

        $email = new Emails;
        $email->subject = $request->subject;
        $email->addressee = $request->addressee;
        $email->bodytext = $request->bodytext;
        $email->created_by = auth()->user()->id;
        $email->state_id = 0;
        $email->save();



        return back();


    }


    public function updateState($id){



        $email = Emails::where('id',$id)->first();
        $email->state_id = 1;
        $email->save();

        Mail::to($email->addressee)->send(new SendEmail($email));


        return back();


    }



    public function delete($id){

        Emails::where('id',$id)->delete();

        return back();

    }
}
