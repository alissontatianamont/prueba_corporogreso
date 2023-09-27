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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    </head>
    <body class="antialiased">
        <section class="row">
            <div class="col-12">
                <div>
                    <span>Por favor, utilice la plantilla para ingresar los datos de sus usuarios</span>
                    <a href="{{ asset('assets/excel/plantilla_usuarios.xlsx') }}" download class="btn btn-primary">Obtener plantilla</a>

                </div>
                <div class="form_excel text-center">
                    <form action="{{ route('usuariosCrear') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="archivo_excel">Elegir archivo Excel:</label>
                        <input type="file" name="archivo_excel" id="archivo_excel" accept=".xls,.xlsx" required>
                        <button type="submit">Subir Archivo</button>
                    </form>

                                        @if(isset($data))
                                        <table>
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
                                        
                                        
                                        @if(isset($errors))

                    <table>

                        <thead>
                            Errores
                        </thead>

                        <tbody>
                            @foreach($errors as $error)
                            Error: {{$error}} <br>
                            @endforeach
                        </tbody>
                    </table>

                    @endif

                </div>
            </div>
        </section>
        <section></section>

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    </body>
</html>
