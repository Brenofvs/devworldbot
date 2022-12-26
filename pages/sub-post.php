<?php

use Source\Models\Sub;
use Source\Models\Categoria;
use Source\Support\Message;

require "./vendor/autoload.php";

$model = new Sub;
$modelCat = new Categoria;
$message = new Message;

$postData = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

if ($postData) {
    if (empty($postData["id_categoria"]) || empty($postData["subcategoria"])) {
        $message->error("Ocorreu um erro, você precisa preencher todos os campos da matéria!");
    } else {
        $postData = $model->bootstrap($postData["id_categoria"], $postData["subcategoria"]);
        $postData->save();
        $message->success("A subcategoria foi cadastrada com sucesso!!!");
    }
}

include "./forms/form-sub-cadastro.php";
