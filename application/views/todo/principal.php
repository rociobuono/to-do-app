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

<body style="background-color: #fafaf9;">
    <?php
    $this->load->view("menu");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php
                if ($this->session->flashdata("OP")) {
                    switch ($this->session->flashdata("OP")) {
                        case "OK":
                            ?>
                            <div class="alert alert-success" role="alert">
                                Tarea guardada.
                            </div>
                            <?php
                            break;
                        case "BORRADO":
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Tarea pendiente borrada.
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
                        <form action="<?php echo site_url("todo/nuevo"); ?>" method="post">
                            <div class="mb-3">
                                <label for="texto" class="form-label">Pendiente:</label>
                                <input type="text" class="form-control" id="texto" name="texto">
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?php if (count($pendientes)) { ?>
                    <ul class="list-group">
                        <?php foreach ($pendientes as $p) {
                            $estado_css = ($p["estado"] == 1) ? "text-decoration-line-through" : "";
                            ?>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <a href="<?php echo site_url("todo/marcar/" . $p["pendiente_id"]); ?>"
                                        class="btn btn-success btn-sm" title="Listo"><i class="bi bi-check-lg"></i></a>
                                    <span class="<?php echo $estado_css; ?>">
                                        <?php echo $p["texto"]; ?>
                                    </span><br>
                                    <small>
                                        <!-- procesamiento desde MYSQL -->
                                        <?php echo $p["fecha_humano"]; ?>
                                        <!--procesamiento desde PHP  -->
                                        <!-- <?php echo date("d/m/Y H:i", strtotime($p["fecha"])) ?> -->
                                    </small>
                                    <!-- <small class="d-block text-muted">Creado por: <?php echo $p["usuario"]; ?></small> -->
                                </div>
                                <p>
                                    <?php ?>
                                </p>
                                <a href="<?php echo site_url("todo/borrar/" . $p["pendiente_id"]); ?>"
                                    class="btn btn-danger btn-sm borrar" title="Borrar"><i class="bi bi-trash3-fill"></i></a>

                            </li>
                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <div class="alert alert-dark" role="alert">
                        <strong>Info: </strong> No hay pendientes
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"
        integrity="sha512-oVbWSv2O4y1UzvExJMHaHcaib4wsBMS5tEP3/YkMP6GmkwRJAa79Jwsv+Y/w7w2Vb/98/Xhvck10LyJweB8Jsw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- BOOTBOX -->
    <script>
        $(".borrar").click(function (e) {
            e.preventDefault();
            var dir = $(this).prop("href");
            bootbox.confirm({
                message:'¿Estas seguro que desea borrarlo?',
                buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
                callback: function (resultado) {
                    if (resultado) {
                        location.href = dir;
                    }
                }});
        })
    </script>
</body>

</html>