@extends('layouts.app')

@section('content')
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('put')

        <div class="row">

            <div class="col-4">
                <label for="name" class="form-label">Nombre del usuario</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Ingrese el name del usuario"
                    value="{{ $user->name }}">
                @if ($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="col-4">
                <label for="phone" class="form-label">Télefono del usuario</label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Ingrese el phone del usuario"
                    value="{{ $user->phone }}">
                @if ($errors->has('phone'))
                    <p class="text-danger">{{ $errors->first('phone') }}</p>
                @endif
            </div>
            <div class="col-4">
                <label for="document_number" class="form-label">Cédula del usuario</label>
                <input type="text" class="form-control" name="document_number" id="document_number"
                    placeholder="Ingrese el document_number del usuario" value="{{ $user->document_number }}" disabled>
                @if ($errors->has('document_number'))
                    <p class="text-danger">{{ $errors->first('document_number') }}</p>
                @endif
            </div>

            <div class="col-4">
                <label for="birth_date" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" name="birth_date" id="birth_date"
                    placeholder="Ingrese el birth_date del usuario" value="{{ $user->birth_date }}">
                @if ($errors->has('birth_date'))
                    <p class="text-danger">{{ $errors->first('birth_date') }}</p>
                @endif
            </div>

            <div class="col-4">
                <label for="email" class="form-label">Email del usuario</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Ingrese el email del usuario"
                    value="{{ $user->email }}" disabled>
                @if ($errors->has('email'))
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                @endif
            </div>



            <div class="col-4">
                <label for="password" class="form-label">Contraseña del usuario</label>
                <input type="password" class="form-control" name="password" id="password"
                    placeholder="Ingrese el password del usuario" value="{{ $user->password }}">
                @if ($errors->has('password'))
                    <p class="text-danger">{{ $errors->first('password') }}</p>
                @endif
            </div>


            <button type="submit" class="btn btn-success">Enviar</button>

        </div>




    </form>
@endsection
