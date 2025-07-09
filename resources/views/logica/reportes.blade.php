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
            <!-- Aquí puedes poner tu menú si lo usas -->
          </li>
        </ul>
      </div>
    </div>
  </nav>


<div class="container my-5">
  <h1 class="fw-bold text-primary mb-4">Reportes</h1>
  <a href="{{ route('reportes.pacientes.pdf') }}" class="btn btn-danger mb-2"><i class="bi bi-file-earmark-pdf"></i> Descargar Pacientes PDF</a>
  <a href="{{ route('reportes.pacientes.csv') }}" class="btn btn-success mb-2">
    <i class="bi bi-file-earmark-excel"></i> Descargar Pacientes Excel
  </a>
 </div>
    <!-- Footer -->
    <footer class="bg-white text-center text-lg-start mt-auto">
        <div class="text-center p-3 bg-light">
        © 2023 Ecografía Digital Machala. Todos los derechos reservados.
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>