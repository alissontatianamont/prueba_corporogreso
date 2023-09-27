<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Space+Grotesk:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    </head>
    <body class="antialiased">
        <div class="text-center my-4"><h1><b>PRUEBA TÉCNICA CORPROGRESO</b></h1></div>
        <section class="row">
            <div class="col-12  text-center">
                <div class="plantilla my-4">
                    <span class="my-3"><b>Por favor, utilice la plantilla para ingresar los datos de sus usuarios</b></span><br><br>
                    <a href="{{ asset('assets/excel/plantilla_usuarios.xlsx') }}" download class="btn buttons_general">Obtener plantilla</a>
                    <hr class="w-100">
                </div>
                
                <div class="form_excel text-center" >
                    <div class="form_container" >
                        <form action="{{ route('usuariosCrear') }}" method="post" style="display: grid; justify-content: center;" enctype="multipart/form-data">
                        @csrf
                        <label for="archivo_excel" class="file-upload-container">Elegir archivo Excel: <br> Click Aqui
                        <input type="file" name="archivo_excel" id="archivo_excel" accept=".xls,.xlsx" required><br><br>
                        <span id="selected-filename">Ningún archivo seleccionado</span>
                    </label>
                        <button type="submit" class="btn buttons_general">Subir Archivo</button>
                    </form>
                    </div>
                    <hr class="w-100">
                    @if(isset($data) && count($errors) == 0)
                    <table class="mt-4">
                        <thead>
                            <tr>
                                <th>USERNAME</th>
                                <th>EMAIL</th>
                                <th>PASSWORD</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $row)
                            <tr>
                                @foreach($row as $key => $value)
                                <td>{{ $value }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif

                    @if(isset($error_msg))
                    {{$error_msg}}
                    @endif
                    
                    @if(isset($errors) &&  count($errors) > 0)

                    <h2> Errores</h2>

                    <table>
                        <tbody>
                            @foreach($errors as $error)
                            <tr> <td>Error: {{$error}}cell</td></tr> 
                        @endforeach
                        </tbody>
                    </table>

                    @endif

                </div>
            </div>
        </section>
        <section>
            @if(isset($usuariosCreados))
            <div class="card_success" id="card-success">
                <div class="row d-flex justify-content-center h-100 align-items-center">
                    <div class="card centered-card " >
                        <div class="card-body   p-5 shadow rounded">
                            <h5 class="card-title">Se han creado los usuarios exitosamente!</h5>
                            <p class="card-text">Se han creado {{$usuariosCreados}} usuarios</p>
                            <label class="d-2"></label>

                            <button id ="close_modal" class="btn buttons_general" onclick="close_modal()">Continuar ingresando datos</button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </section>
        <script src="{{ asset('assets/js/script.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    </body>
</html>
