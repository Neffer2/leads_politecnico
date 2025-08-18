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
    <div class="container">
        <form method="POST" action="{{ route('store') }}"> 
            @csrf
            <div class="row gy-2 form-container">
                <div class="col-md-12">
                    <h1>Formulario de recolección</h1>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="firstname">Nombre:</label>
                        <input type="text" id="firstname" name="firstname" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastname">Apellido:</label>
                        <input type="text" id="lastname" name="lastname" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobilephone">Número:</label>
                        <input type="text" id="mobilephone" name="mobilephone" class="form-control">
                    </div>
                </div>
                @livewire('leads.ciudades-component')
                <div class="col-md-6">
                    <label for="es_bachiller_">Bachiller:</label>
                    <select name="es_bachiller_" id="es_bachiller_" class="form-control">
                        <option value="si">Sí</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="tipo_de_documento">Tipo de documento:</label>
                    <select name="tipo_de_documento" id="tipo_de_documento" class="form-control">
                        <option value="">Seleccionar</option>
                        @foreach ($tipos_documento as $tipo)
                            <option value="{{ $tipo['code'] }}">{{ $tipo['label'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="ilu_numerodocumento">Número de documento:</label>
                    <input type="text" id="ilu_numerodocumento" name="ilu_numerodocumento" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="preferred_contact_method">Contacto preferido:</label>
                    <select name="preferred_contact_method" id="preferred_contact_method" class="form-control">
                        <option value="">Seleccionar</option>
                        @foreach ($contacto_preferido as $contacto)
                            <option value="{{ $contacto['code'] }}">{{ $contacto['label'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="ilu_habeasdata">Tratamiento de datos:</label>
                    <input type="checkbox" id="ilu_habeasdata" name="ilu_habeasdata" class="form-check-input">
                </div>
                <div class="col-md-6">
                    <label for="aceptacion_de_terminos_y_condiciones">Aceptación de términos y condiciones:</label>
                    <input type="checkbox" id="aceptacion_de_terminos_y_condiciones" name="aceptacion_de_terminos_y_condiciones" class="form-check-input">
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary" type="submit">Enviar</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html> 
