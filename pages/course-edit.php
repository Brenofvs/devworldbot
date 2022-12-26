<?php

use Source\Models\Post;
use Source\Models\Sub;
use Source\Models\Categoria;
use Source\Support\Message;

require __DIR__ . "./../vendor/autoload.php";

$model = new Post;
$modelSub = new Sub;
$modelCat = new Categoria;
$message = new Message;

if (isset($_GET['postId'])) {
    $postId = intval(filter_input(INPUT_GET, "postId"));
} else {
    $postId = '';
}
$postData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($postData);
$postUpdt = $model->findById($postId);
if ($postData) {
    if (!empty($postData["id_categoria"]) || !empty($postData["id_subcategoria"]) || !empty($postData["nome"]) || !empty($postData["message_id"])) {

        if (array_key_exists("id_categoria", $postData) && !empty($postData["id_categoria"] && !is_null($postData["id_categoria"]))) {
            $postUpdt->id_categoria = $postData["id_categoria"];
        }

        if (array_key_exists("id_subcategoria", $postData) && !empty($postData["id_subcategoria"] && !is_null($postData["id_subcategoria"]))) {
            $postUpdt->id_subcategoria = $postData["id_subcategoria"];
        }

        if (!empty($postData["nome"] && !is_null($postData["nome"]))) {
            $postUpdt->nome = $postData["nome"];
        }

        if (!empty($postData["message_id"] && !is_null($postData["message_id"]))) {
            $postUpdt->message_id = $postData["message_id"];
        }


        if ($postUpdt != $model->findById($postId)) {
            $postUpdt->save();
            $message->success("Curso atualizado com sucesso!");
        } else {
            $message->warning("Parece que esse curso já foi atualizado!");
        }
    } else {
        $message->warning("Parece que esse curso já está atualizado!");
    }
}

include "./forms/form-course-edit.php";
