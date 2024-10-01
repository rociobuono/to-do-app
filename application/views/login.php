<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To Do</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?>">
</head>

<body>
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
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="<?= base_url('assets/agenda.jpg'); ?>" alt="login form" id="img-login"
                                    class="img-fluid h-100" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <!-- base_url() para acceder a archivos, site_url() para ejecutar -->
                                    <?php echo validation_errors("<p>", "</p>"); ?>
                                    <form action="<?php echo site_url("auth/login"); ?>" method="post">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0"><i class="bi bi-journal-check">To
                                                    do</i></span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3">Inicia Sesión</h5>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="usuario">Usuario</label>
                                            <input type="text" id="usuario" name="usuario"
                                                class="form-control form-control-lg" />
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="password">Contraseña</label>
                                            <input type="password" id="password" name="password"
                                                class="form-control form-control-lg" />
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-dark btn-lg btn-block" type="submit">Acceder</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>