<?php

use Source\Support\Message;
use Source\Models\Post;

$message = new Message;
$post = new Post;

?>

<style>
    .card-text {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .img-fluid {
        width: 100%;
        height: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        object-position: center;
    }
</style>

<main class="content">
    <div class="row">
        <div class="col-12 d-flex mb-4 justify-content-between">
            <h1 class="fs-1">Cursos Cadastrados</h1>
            <a href='?page=course-post' class='btn btn-success d-inline-flex justify-content-center align-items-center fs-3'><i class='align-middle me-2' data-feather='plus-square'></i>Novo Curso</a>
        </div>
        <?php
        $all = $post->queryBuild("JOIN subcategoria on subcategoria.sub_id = cursos.id_subcategoria JOIN categorias on categorias.categoria_id = cursos.id_categoria", "", "cursos.cursos_id, cursos.nome, cursos.message_id, categorias.categoria, subcategoria.subcategoria");
        if (!is_null($all)) {
            foreach ($all as $posts) {
                echo "<div class='col-12 col-lg-6 col-xxl-4'>
                <div class='card mb-3' style='max-width: 540px;'>
                <div class='row g-0'>
                    <div class='col-12'>
                        <div class='card-body'>
                            <h5 class='card-title text-dark'>{$posts->nome}</h5>
                            <p class='card-text mb-1'>Categoria: " . filter_var($posts->categoria, FILTER_SANITIZE_SPECIAL_CHARS) . "</p>
                            <p class='card-text mb-1'>Sub-categoria: " . filter_var($posts->subcategoria, FILTER_SANITIZE_SPECIAL_CHARS) . "</p>
                            <p class='card-text mb-2'>Id da mensagem: " . filter_var($posts->message_id, FILTER_SANITIZE_SPECIAL_CHARS) . "</p>
                            <a href='?page=course-edit&postId={$posts->cursos_id}' class='btn btn-warning d-inline-flex justify-content-center align-items-center text-body'><i class='align-middle me-2' data-feather='edit'></i>Editar</a>
                            <a href='?page=course-delete&postId={$posts->cursos_id}' class='btn btn-danger d-inline-flex justify-content-center align-items-center'><i class='align-middle me-2' data-feather='trash-2'></i>Excluir</a>
                        </div>
                    </div>
                </div>
            </div>
            </div>";
            }
        } else {
            $message->error("Parece que não há nenhum curso cadastrado :(");
            echo $message->render();
        }

        ?>
    </div>
</main>