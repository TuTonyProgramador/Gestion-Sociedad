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

    <footer class="pie">
        <!-- Sección "Dónde estamos" -->
        <div class="footer-section">
            <h4>Dónde nos encontramos</h4>
            <div class="map-widget">
                <p>Dirección: C/ Espejo, Baena (Córdoba)</p>
                <p>Código Postal: 14850</p>
            </div>
        </div>
        <!-- Sección "Contacto" -->
        <div class="footer-section">
            <h4>Contacto</h4>
            <p>Teléfono: +34 654 789 665</p>
            <p>Email: clubtimbradobaenense@gmail.com</p>
        </div>

        <!-- Sección "Redes Sociales" -->
        <div class="footer-section">
            <h4>Redes Sociales</h4>
            <div class="social-icons">
                <a href="#"><img src="{{asset('/IMG/facebook.png')}}" alt="Facebook" width="40" height="40"></a>
                <a href="#"><img src="{{asset('/IMG/instagram.png')}}" alt="Twitter" width="40" height="40"></a>
                <a href="#"><img src="{{asset('/IMG/youtube.png')}}" alt="YouTube" width="50" height="40"></a>
            </div>
        </div>

        <!-- Widget de verificación W3C -->
        <div class="footer-section">
            <p>
                <a href="http://jigsaw.w3.org/css-validator/check/referer">
                    <img style="border:0;width:88px;height:31px"
                        src="http://jigsaw.w3.org/css-validator/images/vcss"
                        alt="¡CSS Válido!" />
                </a>
            </p>
        </div>
    </footer>
  
</body>
</html>
