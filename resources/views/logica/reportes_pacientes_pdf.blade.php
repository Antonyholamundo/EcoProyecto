<!DOCTYPE html>
<html lang="es">
<head>
 
<h2>Listado de Pacientes</h2>
<table border="1" width="100%" cellspacing="0" cellpadding="5">
  <thead>
    <tr>
      <th>Nombres</th>
      <th>Apellidos</th>
      <th>Cedula</th>
      <th>Telefono</th>
      <th>Email</th>
    </tr>
  </thead>
  <tbody>
    @foreach($pacientes as $paciente)
      <tr>
        <td>{{ $paciente->nombres }}</td>
        <td>{{ $paciente->apellidos }}</td>
        <td>{{ $paciente->cedula }}</td>
        <td>{{ $paciente->telefono }}</td>
        <td>{{ $paciente->email }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
<footer class="bg-white text-center text-lg-start mt-auto">
    <div class="text-center p-3 bg-light">
      © 2025 Ecografía Digital Machala. Todos los derechos reservados.
    </div>
</footer>

</body>         
</html>