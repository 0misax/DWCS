<?php

declare(strict_types=1);
?>

<?php
if (isset($input['resultado'])) {
    ?>
    <div class="alert alert-success" role="alert">
        <?php
        foreach($input['resultado'] as $r){
            echo implode(', ', $r).'<br>';
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
            <h6 class="m-0 font-weight-bold text-primary">Ejercicios Iterativas 3</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="matriz">Matriz a procesar:</label>
                        <input type="text" class="form-control"
                               name="matriz" id="matriz"
                               value="<?php
                               echo $input['matriz'] ?? ''; ?>"
                               maxlength="9999"
                               placeholder="1,2,3|4,5,6|7,8,9"
                        />
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
