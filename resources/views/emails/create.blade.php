@extends('layouts.app')

@section('content')
    <form action="{{ route('emails.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">

            <div class="col-6">
                <label for="subject" class="form-label">Asunto</label>
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Ingrese el subject del usuario"
                    value="{{ old('subject') }}">
                @if ($errors->has('subject'))
                    <p class="text-danger">{{ $errors->first('subject') }}</p>
                @endif
            </div>
            <div class="col-6">
                <label for="addressee" class="form-label">Email del usuario</label>
                <input type="text" class="form-control" name="addressee" id="addressee" placeholder="Ingrese el email del usuario"
                    value="{{ old('addressee') }}">
                @if ($errors->has('addressee'))
                    <p class="text-danger">{{ $errors->first('addressee') }}</p>
                @endif
            </div>
            <div class="col-12">
                <label for="bodytext" class="form-label">Cuerpo del mensaje</label>
                <textarea class="form-control" id="bodytext" name="bodytext" rows="3"   value="{{ old('bodytext') }}"></textarea>

                @if ($errors->has('bodytext'))
                    <p class="text-danger">{{ $errors->first('bodytext') }}</p>
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
