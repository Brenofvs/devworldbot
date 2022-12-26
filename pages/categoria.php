<?php

use Source\Support\Message;
use Source\Models\Categoria;

$message = new Message;
$post = new Categoria;

?>

<style>
    .card-text {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
</style>

<main class="content">
    <div class="row">
        <div class="col-12 d-flex mb-4 justify-content-between">
            <h1 class="fs-1">Categorias Cadastradas</h1>
            <a href='?page=cat-post' class='btn btn-success d-inline-flex justify-content-center align-items-center fs-3'><i class='align-middle me-2' data-feather='plus-square'></i>Nova Categoria</a>
        </div>
        <?php
        $all = $post->queryBuild();
        if (!is_null($all)) {
            foreach ($all as $posts) {
                echo "<div class='col-12 col-lg-6 col-xxl-4'>
                <div class='card mb-3' style='max-width: 540px;'>
                <div class='row g-0'>
                    <div class='col-12'>
                        <div class='card-body'>
                            <h5 class='card-title text-dark'>{$posts->categoria}</h5>
                            <a href='?page=cat-edit&postId={$posts->categoria_id}' class='btn btn-warning d-inline-flex justify-content-center align-items-center text-body'><i class='align-middle me-2' data-feather='edit'></i>Editar</a>
                            <a href='?page=cat-delete&postId={$posts->categoria_id}' class='btn btn-danger d-inline-flex justify-content-center align-items-center'><i class='align-middle me-2' data-feather='trash-2'></i>Excluir</a>
                        </div>
                    </div>
                </div>
            </div>
            </div>";
            }
        } else {
            $message->error("Parece que não há nenhuma categoria cadastrada :(");
            echo $message->render();
        }

        ?>
    </div>
</main>