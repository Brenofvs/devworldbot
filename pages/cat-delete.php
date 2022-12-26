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

$postDel = $model->findById($postId);

if (!is_null($postDel)) {
    if (isset($_GET['delete']) && $_GET['delete'] === "true") {
        $postDel->destroy();
    } else {
        include('./forms/form-cat-delete.php');
    }
} elseif (is_null($postDel) && !isset($_GET['delete'])) {
    $message->error("Parece que essa categoria já foi deletada!");
    echo "
    <body>
    <main class='d-flex w-100'>
        <div class='container-fluid d-flex flex-column'>
            <div class='row'>
                <div class='col-sm-12 col-md-11 col-lg-10 mx-auto d-table h-100'>
                    <div class='d-table-cell align-top'>
                        <div class='text-center mt-4'>
                                <div class='d-flex mb-4 justify-content-between'>
                                    <h1 class='h2'>Excluir Categoria!</h1>
                                    <a href='?page=categoria' class='btn btn-primary d-inline-flex justify-content-center align-items-center fs-5'><i class='align-middle me-2' data-feather='arrow-left-circle'></i>Voltar</a>
                                </div>
                                {$message->render()}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </body>";
}
if (isset($_GET['delete']) && $_GET['delete'] === "true") {
    $message->success("Categoria deletada com sucesso!");
    echo "
    <body>
    <main class='d-flex w-100'>
        <div class='container-fluid d-flex flex-column'>
            <div class='row'>
                <div class='col-sm-12 col-md-11 col-lg-10 mx-auto d-table h-100'>
                    <div class='d-table-cell align-top'>
                        <div class='text-center mt-4'>
                                <div class='d-flex mb-4 justify-content-between'>
                                    <h1 class='h2'>Excluir Categoria!</h1>
                                    <a href='?page=categoria' class='btn btn-primary d-inline-flex justify-content-center align-items-center fs-5'><i class='align-middle me-2' data-feather='arrow-left-circle'></i>Voltar</a>
                                </div>
                                {$message->render()}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </body>";
}
