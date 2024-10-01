<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To Do</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>To Do App</h1>
                <?php
                if ($this->session->flashdata("OP")) {
                    switch ($this->session->flashdata("OP")) {
                        case "SALIO":
                            ?>
                            <div class="alert alert-success" role="alert">
                                Sesión cerrada.
                            </div>
                            <?php
                            break;
                        case "PROHIBIDO":
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Primero ingrese sesión.
                            </div>
                            <?php
                            break;
                        case "INACTIVO":
                            ?>
                            <div class="alert alert-success" role="alert">
                                Usuario inactivo, contacte a soporte.
                            </div>
                            <?php
                            break;
                        case "INCORRECTO":
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Datos incorrectos, vuelva a intentarlo.
                            </div>
                            <?php
                            break;
                    }
                }

                ?>
                <br>
                <div class="card">
                    <div class="card-body">
                        <!-- base_url() para acceder a archivos, site_url() para ejecutar -->
                        <?php echo validation_errors("<p>", "</p>"); ?>
                        <form action="<?php echo site_url("auth/login"); ?>" method="post">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario:</label>
                                <input type="text" class="form-control" id="usuario" name="usuario">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña:</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>