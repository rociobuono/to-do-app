<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php
    $this->load->view("menu");
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Rol</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $us) { ?>
                            <tr>
                                <th><?= $us['usuario_id'] ?></th>
                                <td><?= $us['usuario'] ?></td>
                                <td><?php
                                if ($us['rol_id'] == 1) {
                                    echo 'Administrador';
                                } else {
                                    echo 'Usuario';
                                }
                                ?></td>
                                <td><?php
                                if ($us['estado'] == 0) {
                                    echo 'Inactivo';
                                } else {
                                    echo 'Activo';
                                }
                                ?></td>
                                <td><?php
                                if ($us['estado'] == 0) { ?>
                                        <a href="<?= site_url("usuarios/activar/" . $us['usuario_id']) ?>"><i class="bi bi-arrow-up-square-fill"></i></a>
                                        <?php
                                } else { ?>
                                        <a href="<?= site_url("usuarios/borrar/" . $us['usuario_id']) ?>"> <i
                                                class="bi bi-trash3"></i></a>
                                    <?php }
                                ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                            AGREGAR
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Usuario</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?= site_url('usuarios/nuevo'); ?>" method="POST">

                                            <div class="mb-3">
                                                <label for="usuario" class="form-label">Usuario</label>
                                                <input type="text" class="form-control" id="usuario" name="usuario">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Contraseña</label>
                                                <input type="password" class="form-control" id="password" name="password">
                                            </div>
                                            <div class="mb-3">
                                                <label for="rol" class="form-label">Rol</label>
                                                <select class="form-select" id="rol" name="rol">
                                                    <?php foreach ($roles as $r) { ?>
                                                        <option value="<?= $r['rol_id'] ?>"><?= $r['nombre'] ?></option>
                                                    <?php } ?>
                
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>