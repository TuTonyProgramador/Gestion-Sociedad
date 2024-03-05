<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/style.css">
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

    <br><br><br><br>

    <div class="footer" id="pieDePag">
        <p>© 2024 Club Timbrado Baenense. Todos los derechos reservados.</p>
    </div>

    <script>
        window.onload = function() {
            var contentHeight = document.body.scrollHeight;
            var windowHeight = window.innerHeight;
            var footer = document.getElementById('pieDePag');
            
            if (contentHeight < windowHeight) {
                var footerMargin = windowHeight - contentHeight;
                footer.style.marginTop = footerMargin + 'px';
            }
        }
    </script>    
</body>
</html>
