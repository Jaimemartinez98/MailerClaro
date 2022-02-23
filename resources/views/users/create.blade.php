@extends('layouts.app')

@section('content')
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">

            <div class="col-4">
                <label for="name" class="form-label">Nombre del usuario</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Ingrese el name del usuario"
                    value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="col-4">
                <label for="phone" class="form-label">Télefono del usuario</label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Ingrese el phone del usuario"
                    value="{{ old('phone') }}">
                @if ($errors->has('phone'))
                    <p class="text-danger">{{ $errors->first('phone') }}</p>
                @endif
            </div>
            <div class="col-4">
                <label for="document_number" class="form-label">Cédula del usuario</label>
                <input type="text" class="form-control" name="document_number" id="document_number"
                    placeholder="Ingrese el document_number del usuario" value="{{ old('document_number') }}">
                @if ($errors->has('document_number'))
                    <p class="text-danger">{{ $errors->first('document_number') }}</p>
                @endif
            </div>

            <div class="col-4">
                <label for="birth_date" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" name="birth_date" id="birth_date"
                    placeholder="Ingrese el birth_date del usuario" value="{{ old('birth_date') }}">
                @if ($errors->has('birth_date'))
                    <p class="text-danger">{{ $errors->first('birth_date') }}</p>
                @endif
            </div>

            <div class="col-4">
                <label for="email" class="form-label">Email del usuario</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Ingrese el email del usuario"
                    value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                @endif
            </div>



            <div class="col-4">
                <label for="password" class="form-label">Contraseña del usuario</label>
                <input type="password" class="form-control" name="password" id="password"
                    placeholder="Ingrese el password del usuario">
                @if ($errors->has('password'))
                    <p class="text-danger">{{ $errors->first('password') }}</p>
                @endif
            </div>




            <div class="col-4">
                <label for="country_id" class="form-label">Pais</label>
                <select name="country_id" required class="form-control show-tick ms select2" data-placeholder="Select">
                    <option value="">Escoja su país</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->abbreviation }}">{{ $country->name }}
                        </option>
                    @endforeach
                </select>
                @if ($errors->has('country_id'))
                    <p class="text-danger">{{ $errors->first('country_id') }}</p>
                @endif
            </div>





            <div class="col-4">
                <label for="province_id" class="form-label">Departamento</label>

                <select name="province_id" required="" class="form-control show-tick ms select2" data-placeholder="Select">
                    <option value="">Selecciona la/el provincia o departamento...
                    </option>
                </select>
                @if ($errors->has('province_id'))
                    <p class="text-danger">{{ $errors->first('province_id') }}</p>
                @endif
            </div>





            <div class="col-4">
                <label for="city_id" class="form-label">Ciudad</label>

                <select name="city_id" required="" class="form-control show-tick ms select2" data-placeholder="Select">
                    <option value="">Selecciona la ciudad...</option>
                </select>
                @if ($errors->has('city_id'))
                    <p class="text-danger">{{ $errors->first('city_id') }}</p>
                @endif
            </div>





            <br><br><br><br>
            <button type="submit" class="btn btn-success">Enviar</button>

        </div>



    </form>

    <script>
        $(document).ready(function() {

            $('select[name="country_id"]').on('change', function() {
                var country_id = $(this).val();
                if (country_id) {
                    $.ajax({
                        url: '/provinces/' + country_id,
                        type: "GET",
                        dataType: "json",
                        beforeSend: function() {
                            $('#loader').css("visibility", "visible");
                        },
                        success: function(data) {

                            $('select[name="province_id"]').empty();

                            $('select[name="province_id"]').append(
                                '<option value="">Ciudad</option>');
                            $.each(data, function(key, value) {

                                $('select[name="province_id"]').append(
                                    '<option value="' + value + '">' + key +
                                    '</option>');

                            });
                        },
                        complete: function() {
                            $('#loader').css("visibility", "hidden");
                        }
                    });
                } else {
                    $('select[name="province_id"]').empty();
                }

            });

            $('select[name="province_id"]').on('change', function() {
                var province_id = $(this).val();
                var province_name = $(this).find('option:selected')
                    .text(); // Capturamos el texto del option seleccionado
                console.log(province_name);

                if (province_name) {
                    $.ajax({
                        url: '/cities/' + province_name,
                        type: "GET",
                        dataType: "json",
                        beforeSend: function() {
                            $('#loader').css("visibility", "visible");
                        },
                        success: function(data) {

                            $('select[name="city_id"]').empty();

                            $('select[name="city_id"]').append(
                                '<option value="">Ciudad</option>');
                            $.each(data, function(key, value) {

                                $('select[name="city_id"]').append('<option value="' +
                                    value + '">' + key + '</option>');
                            });
                        },
                        complete: function() {
                            $('#loader').css("visibility", "hidden");
                        }
                    });
                } else {
                    $('select[name="city_id"]').empty();
                }

            });



        });
    </script>
@endsection
