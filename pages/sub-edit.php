<?php

use Source\Models\Sub;
use Source\Models\Categoria;
use Source\Support\Message;

require __DIR__ . "./../vendor/autoload.php";

$model = new Sub;
$modelCat = new Categoria;
$message = new Message;

if (isset($_GET['postId'])) {
    $postId = intval(filter_input(INPUT_GET, "postId"));
} else {
    $postId = '';
}
$postData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$postUpdt = $model->findById($postId);
if ($postData) {
    if (!empty($postData["id_categoria"]) || !empty($postData["subcategoria"])) {

        if (!empty($postData["id_categoria"] && !is_null($postData["id_categoria"]))) {
            $postUpdt->id_categoria = $postData["id_categoria"];
        }

        if (!empty($postData["subcategoria"] && !is_null($postData["subcategoria"]))) {
            $postUpdt->subcategoria = $postData["subcategoria"];
        }

        if ($postUpdt != $model->findById($postId)) {
            $postUpdt->save();
            $message->success("Subcategoria atualizada com sucesso!");
        } else {
            $message->warning("Parece que essa subcategoria já foi atualizada!");
        }
    } else {
        $message->warning("Parece que essa subcategoria já está atualizada!");
    }
}

include "./forms/form-sub-edit.php";
