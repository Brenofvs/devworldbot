<?php
require "../vendor/autoload.php";

use Source\Models\Sub;

$sub = new Sub;

$categoriaId = $_POST['categoriaId'];

$subs = $sub->queryBuild("WHERE id_categoria = :cat", "cat={$categoriaId}");

if ($subs) {
    $subcat = '';
    foreach ($subs as $sub) {
        $subcat .= '<option value="' . $sub->sub_id . '">' . $sub->subcategoria . '</option>';
    }

    echo "<option value='' disabled selected>Selecione uma Subcategoria</option>" . $subcat;
} else {
    echo '<option value="">Parece que não há nenhuma subcategoria para a categoria selecionada</option>';
}
