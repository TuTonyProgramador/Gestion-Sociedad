<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/style.css">
    <script src="{{ asset('js/script.js') }}"></script>
    <link rel="shortcut icon" href="{{ asset('IMG/logo.jpg') }}" type="image/x-icon">
    <title>Club Timbrado Baenense</title>
</head>
<body>
    <div class="header">
        <img src="{{ asset('IMG/logo.png') }}" alt="Logo del Club">
        <h1>Club Timbrado Baenense</h1>
        @yield('contenido_extra')
    </div>

    @yield('contenido')

    <footer>
        <p>© 2024 Club Timbrado Baenense. Todos los derechos reservados.</p>
        <p>
            <a href="http://jigsaw.w3.org/css-validator/check/referer">
                <img style="border:0;width:88px;height:31px"
                    src="http://jigsaw.w3.org/css-validator/images/vcss"
                    alt="¡CSS Válido!" />
            </a>
        </p>
    </footer>    
</body>
</html>
