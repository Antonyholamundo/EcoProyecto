<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gestión de Pacientes</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body class="d-flex flex-column min-vh-100">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="{{ asset('img/logo.png') }}" alt="Logo Ecografía Digital Machala" style="height: 40px;" class="me-2" />
        <span class="fw-semibold text-primary">Ecografía Digital</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link text-dark" href="{{ url('/') }}">Inicio</a></li>
          <li class="nav-item"><a class="nav-link text-dark" href="{{ route('logica.citas') }}">Agendar Cita</a></li>
          <li class="nav-item"><a class="nav-link text-dark" href="{{ route('logica.pacientes') }}">Pacientes</a></li>
          <li class="nav-item"><a class="nav-link text-dark" href="{{ route('reportes.index') }}">Reportes</a></li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-gear-fill me-1"></i> Opciones
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#"><i class="bi bi-cog me-2"></i>Configuración</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item text-danger" href="/login"><i class="bi bi-box-arrow-right me-2"></i>Salir</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <main class="container my-5">
    <div class="row align-items-center">
      <div class="col-lg-7 mb-4 mb-lg-0">
        <h1 class="display-5 fw-bold text-primary mb-3">Bienvenido a Ecografía Digital Machala</h1>
        <p class="lead text-muted">Especialistas en ecografías y diagnóstico por imagen con tecnología de vanguardia y atención personalizada.</p>
      </div>
      <div class="col-lg-5 text-center">
        <img src="./img/about.jpg" alt="Equipo Ecografía Digital Machala" class="img-fluid rounded shadow" loading="lazy" />
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="text-white mt-auto">
    <div class="container py-4">
      <div class="row">
        <div class="col-md-6 mb-3 mb-md-0">
          <h5 class="fw-bold">Contacto</h5>
          <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>Buenavista y Boyacá</p>
          <p class="mb-1"><i class="fas fa-phone-alt me-2"></i>0963947466</p>
          <p class="mb-0"><i class="fas fa-envelope me-2"></i>ecografiadigitalmachala@gmail.com</p>
        </div>
        <div class="col-md-6">
          <h5 class="fw-bold">Horario de Atención</h5>
          <p class="mb-1">Lunes a Viernes: 8:00 AM - 6:00 PM</p>
          <p class="mb-0">Sábado: 9:00 AM - 1:00 PM</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
