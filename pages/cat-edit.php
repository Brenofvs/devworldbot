<?php

use Source\Models\Categoria;
use Source\Support\Message;

require __DIR__ . "./../vendor/autoload.php";

$model = new Categoria;
$message = new Message;

if (isset($_GET['postId'])) {
    $postId = intval(filter_input(INPUT_GET, "postId"));
} else {
    $postId = '';
}
$postData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$postUpdt = $model->findById($postId);
if ($postData) {
    if (!empty($postData["categoria"])) {

        if (!empty($postData["categoria"] && !is_null($postData["categoria"]))) {
            $postUpdt->categoria = $postData["categoria"];
        }

        if ($postUpdt != $model->findById($postId)) {
            $postUpdt->save();
            $message->success("Categoria atualizada com sucesso!");
        } else {
            $message->warning("Parece que essa Categoria já foi atualizada!");
        }
    } else {
        $message->warning("Parece que essa Categoria já está atualizada!");
    }
}

include "./forms/form-cat-edit.php";
