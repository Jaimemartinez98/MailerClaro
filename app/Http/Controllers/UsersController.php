<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Profiles;
use App\Models\Countries;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index(){

        $usuarios = User::get();


        return view('users.index',[
            'usuarios' => $usuarios,
        ]);

    }

    public function create(){

        $profiles = Profiles::get();
        $countries = Countries::orderBy('name')->get();

        return view('users.create',[
            'profiles' => $profiles,
            'countries' => $countries,
        ]);

    }

    public function store(Request $request){


        //use Illuminate\Support\Facades\Hash;

        $request->validate([
            'name' => 'required',
            'document_number' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'birth_date' => 'required',
            'country_id' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
        ],[
            'name.required' => 'El nombre del usuario es requerido',
            'document_number.required' => 'La cedula es requerida',
            'phone.required' => 'El télefono es requerido',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email es no tiene el formato correcto',
            'password.required' => 'Contraseña requerida',
            'birth_date.required' => 'Fecha de nacimiento requerida',
            'country_id.required' => 'País requerido',
            'province_id.required' => 'Provincia/Departamento requerido',
            'city_id.required' => 'Ciudad requerida',
        ]

    );

        $user = new User;
        $user->name = $request->name;
        $user->document_number = $request->document_number;
        $user->phone = $request->phone;
        $user->birth_date = $request->birth_date;
        $user->profile_id = 2;
        $user->email = $request->email;
        $user->city_code = 2;
        $user->password = Hash::make($request->password);
        $user->save();


        return back();


    }

    public function edit($id){

        $profiles = Profiles::get();
        $user = User::where('id',$id)->first();
        $countries = Countries::orderBy('name')->get();

        return view('users.edit',[
            'profiles' => $profiles,
            'user' => $user,
            'countries' => $countries,
        ]);

    }

    public function update(Request $request, $id){


        $request->validate([
            'name' => 'required',
            'document_number' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'birth_date' => 'required',
        ],[
            'name.required' => 'El nombre del usuario es requerido',
            'document_number.required' => 'La cedula es requerida',
            'phone.required' => 'El télefono es requerido',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email es no tiene el formato correcto',
            'password.required' => 'Contraseña requerida',
            'birth_date.required' => 'Fecha de nacimiento requerida',
        ]
    );

        $user = User::where('id',$id)->first();
        $user->name = $request->name;
        $user->document_number = $request->document_number;
        $user->phone = $request->phone;
        $user->birth_date = $request->birth_date;
        $user->profile_id = 2;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();


        return back();


    }

    public function delete($id){

        User::where('id',$id)->delete();

        return back();

    }
}
