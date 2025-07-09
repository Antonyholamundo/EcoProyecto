<!DOCTYPE html>
<html lang="es">
<head>
 
<h2>Listado de Pacientes</h2>
<table border="1" width="100%" cellspacing="0" cellpadding="5">
  <thead>
    <tr>
      <th>Nombres</th>
      <th>Apellidos</th>
      <th>Cédula</th>
      <th>Teléfono</th>
      <th>Email</th>
    </tr>
  </thead>
  <tbody>
    <?php $__currentLoopData = $pacientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paciente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><?php echo e($paciente->nombres); ?></td>
        <td><?php echo e($paciente->apellidos); ?></td>
        <td><?php echo e($paciente->cedula); ?></td>
        <td><?php echo e($paciente->telefono); ?></td>
        <td><?php echo e($paciente->email); ?></td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>
<footer class="bg-white text-center text-lg-start mt-auto">
    <div class="text-center p-3 bg-light">
      © 2025 Ecografía Digital Machala. Todos los derechos reservados.
    </div>
</footer>

</body>         
</html><?php /**PATH C:\Users\Usuario\EcoProyecto\resources\views/logica/reportes_pacientes_pdf.blade.php ENDPATH**/ ?>