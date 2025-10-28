<?php

declare(strict_types=1);

?>

<?php
if (isset($resultado)) {
    ?>
    <div class="alert alert-success" role="alert">
        <?php
        foreach ($resultado as $letra => $cantidad) {
            echo $letra . ': ' . $cantidad . '<br>';
        }
        ?>
    </div>
    <?php
}
?>
<div class="card shadow mb-4">
    <form method="post" action="">
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $titulo; ?> </h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="texto">Texto a procesar:</label>
                        <textarea class="form-control" name="texto" id="texto"
                                  rows="6"><?php echo $input['texto'] ?? ''; ?></textarea>
                        <p class="text-danger small">
                            <?php
                            echo $errors['texto'] ?? '';
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="col-12 text-right">
                <input type="submit" value="Enviar" class="btn btn-primary ml-2"/>
            </div>
        </div>
    </form>
</div>
