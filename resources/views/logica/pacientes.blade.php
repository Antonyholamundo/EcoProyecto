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

  <!-- Contenido -->
  <main class="container my-5">
    <h1 class="fw-bold text-primary mb-4">Gestión de Pacientes</h1>

    <!-- Mensajes -->
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
      <strong>Ups, hubo algunos errores:</strong>
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <!-- Botón agregar -->
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalAgregarPaciente">
      <i class="bi bi-person-plus"></i> Agregar Paciente
    </button>

    <!-- Tabla -->
    <div class="table-responsive shadow-sm">
      <table class="table table-hover  table-bordered align-middle">
        <thead class="table-primary">
          <tr>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Cédula</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Sexo</th>
            <th>Fecha de Nacimiento</th>
            <th>Tipo de Ecografía</th>
            <th>Precio</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($pacientes as $paciente)
          <tr>
            <td>{{ $paciente->nombres }}</td>
            <td>{{ $paciente->apellidos }}</td>
            <td>{{ $paciente->cedula }}</td>
            <td>{{ $paciente->telefono }}</td>
            <td>{{ $paciente->email }}</td>
            <td>{{ ucfirst($paciente->sexo) }}</td>
            <td>{{ $paciente->fecha_nacimiento }}</td>
            <td>{{ $paciente->tipo_ecografia }}</td>
            <td>${{ number_format($paciente->precio, 2) }}</td>
            <td>
              <button
                class="btn btn-warning btn-sm me-1 text-white btn-editar"
                data-id="{{ $paciente->id }}"
                data-nombres="{{ $paciente->nombres }}"
                data-apellidos="{{ $paciente->apellidos }}"
                data-cedula="{{ $paciente->cedula }}"
                data-telefono="{{ $paciente->telefono }}"
                data-email="{{ $paciente->email }}"
                data-sexo="{{ $paciente->sexo }}"
                data-fecha_nacimiento="{{ $paciente->fecha_nacimiento }}"
                data-tipo_ecografia="{{ $paciente->tipo_ecografia }}"
                data-precio="{{ $paciente->precio }}"
                data-bs-toggle="modal"
                data-bs-target="#modalEditarPaciente"
              >
                <i class="bi bi-pencil-square"></i> Editar
              </button>

              <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que quieres eliminar este paciente?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                  <i class="bi bi-trash"></i> Eliminar
                </button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="10" class="text-center">No hay pacientes registrados</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </main>

  <!-- Modales (igual, sin cambios estructurales) -->

  <!-- Modal Agregar -->
  <!-- (Mismo modal, no se toca estructura, solo se mantiene limpio) -->
<div class="modal fade" id="modalAgregarPaciente" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('pacientes.store') }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Agregar Paciente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="row g-2">
              <div class="col-6">
                <label class="form-label">Nombres</label>
                <input type="text" class="form-control" name="nombres" required>
              </div>
              <div class="col-6">
                <label class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" required>
              </div>
              <div class="col-6">
                <label class="form-label">Cédula</label>
                <input type="text" class="form-control" name="cedula" required>
              </div>
              <div class="col-6">
                <label class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="telefono" required>
              </div>
              <div class="col-6">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email">
              </div>
              <div class="col-6">
                <label class="form-label">Sexo</label>
                <select class="form-select" name="sexo" required>
                  <option value="">Seleccione</option>
                  <option value="masculino">Masculino</option>
                  <option value="femenino">Femenino</option>
                </select>
              </div>
              <div class="col-6">
                <label class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="fecha_nacimiento" required>
              </div>
              <div class="col-6">
                <label class="form-label">Tipo de Ecografía</label>
                <select class="form-select" name="tipo_ecografia" required>
                  <option value="">Seleccione</option>
                  <option value="Abdominal">Abdominal</option>
                  <option value="Obstétrica">Obstétrica</option>
                  <option value="Mamaria">Mamaria</option>
                  <option value="Tiroidea">Tiroidea</option>
                </select>
              </div>
              <div class="col-6">
                <label class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" name="precio" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar Paciente</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal Editar -->
  <!-- (Mismo modal) -->
  <div class="modal fade" id="modalEditarPaciente" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <form id="form-editar-paciente" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title">Editar Paciente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="row g-2">
              <!-- Campos idénticos -->
              <div class="col-6">
                <label class="form-label">Nombres</label>
                <input type="text" id="edit-nombres" name="nombres" class="form-control" required>
              </div>
              <div class="col-6">
                <label class="form-label">Apellidos</label>
                <input type="text" id="edit-apellidos" name="apellidos" class="form-control" required>
              </div>
              <div class="col-6">
                <label class="form-label">Cédula</label>
                <input type="text" id="edit-cedula" name="cedula" class="form-control" required>
              </div>
              <div class="col-6">
                <label class="form-label">Teléfono</label>
                <input type="text" id="edit-telefono" name="telefono" class="form-control" required>
              </div>
              <div class="col-6">
                <label class="form-label">Email</label>
                <input type="email" id="edit-email" name="email" class="form-control">
              </div>
              <div class="col-6">
                <label class="form-label">Sexo</label>
                <select id="edit-sexo" name="sexo" class="form-select" required>
                  <option value="">Seleccione</option>
                  <option value="masculino">Masculino</option>
                  <option value="femenino">Femenino</option>
                </select>
              </div>
              <div class="col-6">
                <label class="form-label">Fecha de Nacimiento</label>
                <input type="date" id="edit-fecha_nacimiento" name="fecha_nacimiento" class="form-control" required>
              </div>
              <div class="col-6">
                <label class="form-label">Tipo de Ecografía</label>
                <select id="edit-tipo_ecografia" name="tipo_ecografia" class="form-select" required>
                  <option value="">Seleccione</option>
                  <option value="Abdominal">Abdominal</option>
                  <option value="Obstétrica">Obstétrica</option>
                  <option value="Mamaria">Mamaria</option>
                  <option value="Tiroidea">Tiroidea</option>
                </select>
              </div>
              <div class="col-6">
                <label class="form-label">Precio</label>
                <input type="number" step="0.01" id="edit-precio" name="precio" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-warning text-white">Actualizar Paciente</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Scripts -->
  <!-- (Igual, no se toca) -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const botonesEditar = document.querySelectorAll('.btn-editar');
    const formEditar = document.getElementById('form-editar-paciente');

    botonesEditar.forEach(function (boton) {
      boton.addEventListener('click', function () {
        formEditar.action = `/pacientes/${this.dataset.id}`;
        document.getElementById('edit-nombres').value = this.dataset.nombres;
        document.getElementById('edit-apellidos').value = this.dataset.apellidos;
        document.getElementById('edit-cedula').value = this.dataset.cedula;
        document.getElementById('edit-telefono').value = this.dataset.telefono;
        document.getElementById('edit-email').value = this.dataset.email;
        document.getElementById('edit-sexo').value = this.dataset.sexo;
        document.getElementById('edit-fecha_nacimiento').value = this.dataset.fecha_nacimiento;
        document.getElementById('edit-tipo_ecografia').value = this.dataset.tipo_ecografia;
        document.getElementById('edit-precio').value = this.dataset.precio;
      });
    });
  });
</script>
  <!-- Footer -->
  <footer class="mt-auto bg-primary text-white py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mb-3 mb-md-0">
          <h5 class="fw-bold">Contacto</h5>
          <p class="mb-1"><i class="bi bi-geo-alt-fill me-2"></i>Buenavista y Boyacá</p>
          <p class="mb-1"><i class="bi bi-telephone-fill me-2"></i>0963947466</p>
          <p class="mb-0"><i class="bi bi-envelope-fill me-2"></i>ecografiadigitalmachala@gmail.com</p>
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
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  @if(session('success'))
    <div class="toast align-items-center text-bg-success border-0 show" role="alert">
      <div class="d-flex">
        <div class="toast-body">
          {{ session('success') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  @endif
  @if($errors->any())
    <div class="toast align-items-center text-bg-danger border-0 show" role="alert">
      <div class="d-flex">
        <div class="toast-body">
          <strong>Ups, hubo algunos errores:</strong>
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  @endif
</div>
</html>
