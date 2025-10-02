<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <style>
        table { border-collapse: collapse; width: 60%; margin: 20px auto; }
        th, td { border: 1px solid #666; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Usuarios Registrados</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Password</th>
            <th>Estado</th>
        </tr>
        <?php if (!empty($usuarios) && is_array($usuarios)) : ?>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= esc($usuario['id']) ?></td>
                    <td><?= esc($usuario['nombre']) ?></td>
                    <td><?= esc($usuario['pass']) ?></td>
                    <td><?= esc($usuario['rol']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">No hay usuarios registrados.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
