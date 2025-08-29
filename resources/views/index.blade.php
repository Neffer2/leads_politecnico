<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>Polit&eacute;cnico Gran Colombiano</title>
</head>
<body>
    <div class="main-container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center mt-5">
                <img class="" src="{{ asset('assets/poli-logo.png') }}" alt="Logo" height="100">
            </div>
            <div class="col-md-12 mt-0 p-0">
                <form method="POST" action="{{ route('store') }}" class="form-container">
                    @csrf
                    <div class="row px-2 gy-2">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" id="firstname" name="firstname" class="form-control" required placeholder="NOMBRE">
                                @error('firstname')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" id="lastname" name="lastname" class="form-control" required placeholder="APELLIDO">
                                @error('lastname')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="email" id="email" name="email" class="form-control" required placeholder="EMAIL">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" id="mobilephone" name="mobilephone" class="form-control" required placeholder="NÚMERO DE CELULAR">
                                @error('mobilephone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @livewire('leads.ciudades-component')
                        <div class="col-6">
                            <select name="tipo_de_documento" id="tipo_de_documento" class="form-control" required placeholder="TIPO DOCUMENTO">
                                <option value="">Seleccionar</option>
                                @foreach ($tipos_documento as $tipo)
                                    <option value="{{ $tipo['code'] }}">{{ $tipo['label'] }}</option>
                                @endforeach
                            </select>
                            @error('tipo_de_documento')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <input type="text" id="ilu_numerodocumento" name="ilu_numerodocumento" class="form-control" required placeholder="NÚMERO DE DOCUMENTO">
                            @error('ilu_numerodocumento')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <select name="preferred_contact_method" id="preferred_contact_method" class="form-control" required placeholder="MÉTODO DE CONTACTO PREFERIDO">
                                <option value="">Seleccionar</option>
                                @foreach ($contacto_preferido as $contacto)
                                    <option value="{{ $contacto['code'] }}">{{ $contacto['label'] }}</option>
                                @endforeach
                            </select>
                            @error('preferred_contact_method')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <input type="checkbox" id="ilu_habeasdata" name="ilu_habeasdata" class="form-check-input" required>
                            <label for="ilu_habeasdata">Tratamiento de datos.</label>
                            @error('ilu_habeasdata')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <input type="checkbox" id="aceptacion_de_terminos_y_condiciones" name="aceptacion_de_terminos_y_condiciones" class="form-check-input" required>
                            <label for="aceptacion_de_terminos_y_condiciones">Acepta términos y condiciones.</label>
                            @error('aceptacion_de_terminos_y_condiciones')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <button class="btn btn-primary mt-2" type="submit">ENVIAR</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
