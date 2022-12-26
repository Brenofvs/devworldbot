<?php

use Source\Models\Post;
use Source\Models\Sub;
use Source\Models\Categoria;
use Source\Support\Message;

require "./vendor/autoload.php";

$model = new Post;
$modelSub = new Sub;
$modelCat = new Categoria;
$message = new Message;

$postData = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

if ($postData) {
    if (empty($postData["id_categoria"]) || empty($postData["id_subcategoria"]) || empty($postData["nome"]) || empty($postData["message_id"])) {
        $message->error("Ocorreu um erro, você precisa preencher todos os campos da curso!");
    } else {
        $postData = $model->bootstrap($postData["id_categoria"], $postData["id_subcategoria"], $postData["nome"], $postData["message_id"]);
        $postData->save();
        $message->success("O curso foi cadastrado com sucesso!!!");
    }
}

include "./forms/form-course-cadastro.php";
