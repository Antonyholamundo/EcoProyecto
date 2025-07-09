<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gestión de Pacientes</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>" />

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
        <img src="<?php echo e(asset('img/logo.png')); ?>" alt="Logo Ecografía Digital Machala" style="height: 40px;" class="me-2" />
        <span class="fw-semibold text-primary">Ecografía Digital</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link text-dark" href="<?php echo e(url('/')); ?>">Inicio</a></li>
          <li class="nav-item"><a class="nav-link text-dark" href="<?php echo e(route('logica.citas')); ?>">Agendar Cita</a></li>
          <li class="nav-item"><a class="nav-link text-dark" href="<?php echo e(route('logica.pacientes')); ?>">Pacientes</a></li>
          <li class="nav-item"><a class="nav-link text-dark" href="<?php echo e(route('reportes.index')); ?>">Reportes</a></li>
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

  <!-- Contenido principal -->
  <div class="container my-5">
    <h1 class="fw-bold text-primary mb-4">Agendar Cita</h1>

    <?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
      <strong>Ups, hubo algunos errores:</strong>
      <ul class="mb-0">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
    <?php endif; ?>

    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modalAgendarCita">
      <i class="bi bi-person-plus"></i> Agregar Cita
    </button>

    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-primary">
          <tr>
            <th>Nombre del Paciente</th>
            <th>Fecha</th>
            <th>Tipo de Ecografía</th>
            <th>Hora</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $citas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td><?php echo e($cita->paciente); ?></td>
            <td><?php echo e($cita->fecha); ?></td>
            <td><?php echo e($cita->tipo); ?></td>
            <td><?php echo e($cita->hora); ?></td>
            <td>$<?php echo e(number_format($cita->precio, 2)); ?></td>
            <td><?php echo e(ucfirst($cita->estado)); ?></td>
            <td>
              <button
                class="btn btn-warning btn-sm text-white btn-editar"
                data-id="<?php echo e($cita->id); ?>"
                data-paciente="<?php echo e($cita->paciente); ?>"
                data-fecha="<?php echo e($cita->fecha); ?>"
                data-hora="<?php echo e($cita->hora); ?>"
                data-tipo="<?php echo e($cita->tipo); ?>"
                data-precio="<?php echo e($cita->precio); ?>"
                data-estado="<?php echo e($cita->estado); ?>"
                data-bs-toggle="modal"
                data-bs-target="#modalEditarCita"
              >
                <i class="bi bi-pencil-square"></i> Editar
              </button>

              <form action="<?php echo e(route('citas.destroy', $cita->id)); ?>" method="POST" class="d-inline"
                onsubmit="return confirm('¿Seguro que quieres eliminar esta cita?');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger btn-sm">
                  <i class="bi bi-trash"></i> Eliminar
                </button>
              </form>
            </td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
            <td colspan="7" class="text-center">No hay citas agendadas</td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Agendar Cita -->
  <div class="modal fade" id="modalAgendarCita" tabindex="-1" aria-labelledby="modalAgendarCitaLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header py-3">
          <h5 class="modal-title">Agendar Cita</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <form action="<?php echo e(route('citas.store')); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <div class="modal-body p-3">
            <div class="mb-2">
              <label for="nombre-paciente" class="form-label">Nombre del Paciente</label>
              <input id="nombre-paciente" name="paciente" type="text" class="form-control form-control-sm" required>
            </div>
            <div class="row">
              <div class="col-6 mb-2">
                <label class="form-label">Fecha</label>
                <input type="date" name="fecha" class="form-control form-control-sm" required>
              </div>
              <div class="col-6 mb-2">
                <label class="form-label">Hora</label>
                <input type="time" name="hora" class="form-control form-control-sm" required>
              </div>
            </div>
            <div class="mb-2">
              <label class="form-label">Tipo de Ecografía</label>
              <select name="tipo" class="form-select form-select-sm" required>
                <option value="">Seleccione</option>
                <option value="Abdominal">Abdominal</option>
                <option value="Obstétrica">Obstétrica</option>
                <option value="Mamaria">Mamaria</option>
                <option value="Tiroidea">Tiroidea</option>
              </select>
            </div>
            <div class="row">
              <div class="col-6 mb-2">
                <label class="form-label">Precio</label>
                <input type="number" name="precio" class="form-control form-control-sm" step="0.01" required>
              </div>
              <div class="col-6 mb-2">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select form-select-sm" required>
                  <option value="">Seleccione</option>
                  <option value="pendiente">Pendiente</option>
                  <option value="atendido">Atendido</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer py-2">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Editar Cita -->
  <div class="modal fade" id="modalEditarCita" tabindex="-1" aria-labelledby="modalEditarCitaLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header py-3">
          <h5 class="modal-title">Editar Cita</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <form id="form-editar-cita" method="POST">
          <?php echo csrf_field(); ?>
          <?php echo method_field('PUT'); ?>
          <div class="modal-body p-3">
            <input id="edit-nombre-paciente" name="paciente" type="text" class="form-control form-control-sm mb-2" required>
            <input id="edit-fecha-cita" name="fecha" type="date" class="form-control form-control-sm mb-2" required>
            <input id="edit-hora-cita" name="hora" type="time" class="form-control form-control-sm mb-2" required>
            <select id="edit-tipo-ecografia" name="tipo" class="form-select form-select-sm mb-2" required>
              <option value="">Seleccione</option>
              <option value="Abdominal">Abdominal</option>
              <option value="Obstétrica">Obstétrica</option>
              <option value="Mamaria">Mamaria</option>
              <option value="Tiroidea">Tiroidea</option>
            </select>
            <input id="edit-precio" name="precio" type="number" step="0.01" class="form-control form-control-sm mb-2" required>
            <select id="edit-estado-paciente" name="estado" class="form-select form-select-sm mb-2" required>
              <option value="">Seleccione</option>
              <option value="pendiente">Pendiente</option>
              <option value="atendido">Atendido</option>
            </select>
          </div>
          <div class="modal-footer py-2">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-warning btn-sm text-white">Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-primary text-white mt-auto">
    <div class="container py-4">
      <div class="row">
        <div class="col-md-6">
          <h5>Contacto</h5>
          <p>Dirección: Buenavista y Boyaca</p>
          <p>Teléfono: 0963947466</p>
          <p>Email: ecografiadigitalmachala@gmail.com</p>
        </div>
        <div class="col-md-6">
          <h5>Horario de Atención</h5>
          <p>Lunes a Viernes: 8:00 AM - 6:00 PM</p>
          <p>Sábado: 9:00 AM - 1:00 PM</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const btnsEditar = document.querySelectorAll('.btn-editar');
      const formEditar = document.getElementById('form-editar-cita');

      btnsEditar.forEach(btn => {
        btn.addEventListener('click', function () {
          formEditar.action = `/citas/${this.dataset.id}`;
          document.getElementById('edit-nombre-paciente').value = this.dataset.paciente;
          document.getElementById('edit-fecha-cita').value = this.dataset.fecha;
          document.getElementById('edit-hora-cita').value = this.dataset.hora;
          document.getElementById('edit-tipo-ecografia').value = this.dataset.tipo;
          document.getElementById('edit-precio').value = this.dataset.precio;
          document.getElementById('edit-estado-paciente').value = this.dataset.estado;
        });
      });
    });
  </script>

</body>
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <?php if(session('success')): ?>
    <div class="toast align-items-center text-bg-success border-0 show" role="alert">
      <div class="d-flex">
        <div class="toast-body">
          <?php echo e(session('success')); ?>

        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  <?php endif; ?>
  <?php if($errors->any()): ?>
    <div class="toast align-items-center text-bg-danger border-0 show" role="alert">
      <div class="d-flex">
        <div class="toast-body">
          <strong>Ups, hubo algunos errores:</strong>
          <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  <?php endif; ?>
</div>
</html>
<?php /**PATH C:\Users\Usuario\EcoProyecto\resources\views/logica/citas.blade.php ENDPATH**/ ?>