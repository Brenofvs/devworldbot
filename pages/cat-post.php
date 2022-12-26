<?php

use Source\Models\Categoria;
use Source\Support\Message;

require "./vendor/autoload.php";

$model = new Categoria;
$message = new Message;

$postData = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

if ($postData) {
    if (empty($postData["categoria"])) {
        $message->error("Ocorreu um erro, você precisa preencher todos os campos da categoria!");
    } else {
        $postData = $model->bootstrap($postData["categoria"]);
        $postData->save();
        $message->success("A categoria foi cadastrada com sucesso!!!");
    }
}

include "./forms/form-cat-cadastro.php";
