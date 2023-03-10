<?php
$categorias = $modelCat->queryBuild();
$subs = $modelSub->queryBuild();
if ($categorias && $subs) {
    $cat = '';
    foreach ($categorias as $categoria) {
        $cat .= '<option value="' . $categoria->categoria_id . '">' . $categoria->categoria . '</option>';
    }
?>

    <body>
        <main class="d-flex w-100">
            <div class="container-fluid d-flex flex-column">
                <div class="row">
                    <div class="col-sm-12 col-md-11 col-lg-10 mx-auto d-table h-100">
                        <div class="d-table-cell align-top">

                            <div class="text-center mt-4">
                                <div class="d-flex mb-4 justify-content-between">
                                    <h1 class="h2">Editar Curso!</h1>
                                    <a href='?page=cursos' class='btn btn-primary d-inline-flex justify-content-center align-items-center fs-5'><i class='align-middle me-2' data-feather='arrow-left-circle'></i>Voltar</a>
                                </div>
                                <?= $message->render(); ?>
                            </div>

                            <div class="card mt-4">
                                <div class="card-body ">
                                    <div class="m-sm-4">
                                        <form name='post' action='./?page=course-edit&postId=<?= $postUpdt->cursos_id ?>' method='post' enctype='multipart/form-data'>
                                            <div class="mb-3">
                                                <label class="form-label">Categoria</label>
                                                <select name="id_categoria" class="form-select" id="categoria">
                                                    <option value="" selected disabled><?= "Categoria atual: " . $postUpdt->categoria ?></option>
                                                    <?= $cat ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Sub-categoria</label>
                                                <select name="id_subcategoria" class="form-select" id="subcat">
                                                    <option value="" selected disabled><?= "Subcategoria atual: " . $postUpdt->subcategoria ?></option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nome do curso</label>
                                                <textarea style="resize: none" rows="1" class="form-control form-control-lg" name='nome'><?= $postUpdt->nome ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Id da Mensagem</label>
                                                <textarea style="resize: none" rows="1" class="form-control form-control-lg" name='message_id'><?= $postUpdt->message_id ?></textarea>
                                            </div>
                                            <div class="text-center mt-3">
                                                <button style="width: 60%; font-size: 20px;" class="btn btn-lg btn-block btn-warning text-dark" id="button"><i class='align-middle me-2' data-feather='edit'></i>Editar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script src="../js/app.js"></script>

    </body>

    </html>

<?php
} else {

?>

    <body>
        <main class="d-flex w-100">
            <div class="container-fluid d-flex flex-column">
                <div class="row">
                    <div class="col-sm-12 col-md-11 col-lg-10 mx-auto d-table h-100">
                        <div class="d-table-cell align-top">

                            <div class="text-center mt-4">
                                <div class="d-flex mb-4 justify-content-between">
                                    <h1 class="h2">Editar curso!</h1>
                                    <a href='?page=cursos' class='btn btn-primary d-inline-flex justify-content-center align-items-center fs-5'><i class='align-middle me-2' data-feather='arrow-left-circle'></i>Voltar</a>
                                </div>
                                <?php $message->error("Parece que n??o h?? nenhuma categoria ou subcategoria cadastrada, voc?? ir?? precisar cadastrar antes de prosseguir");
                                echo $message->render(); ?>
                            </div>
                        <?php
                    }

                        ?>