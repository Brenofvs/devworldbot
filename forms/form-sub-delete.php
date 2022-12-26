<style>
    input,
    textarea {
        resize: none;
    }
</style>

<body>
    <main class="d-flex w-100">
        <div class="container-fluid d-flex flex-column">
            <div class="row">
                <div class="col-sm-12 col-md-11 col-lg-10 mx-auto d-table h-100">
                    <div class="d-table-cell align-top">

                        <div class="text-center mt-4">
                            <div class="d-flex mb-4 justify-content-between">
                                <h1 class="h2">Excluir Subcategoria!</h1>
                                <a href='?page=subcategoria' class='btn btn-primary d-inline-flex justify-content-center align-items-center fs-5'><i class='align-middle me-2' data-feather='arrow-left-circle'></i>Voltar</a>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-body ">
                                <div class="m-sm-4">
                                    <form name='post' action='./?page=sub-delete&postId=<?= $postDel->sub_id ?>&delete=true' method='post' enctype='multipart/form-data'>
                                        <div class="mb-3">
                                            <label class="form-label">Categoria</label>
                                            <textarea rows="1" class="form-control form-control-lg text-dark" name='id_categoria' value='' placeholder='' disabled><?= $postDel->categoria ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Sub-categoria</label>
                                            <textarea rows="1" class="form-control form-control-lg text-dark" name='subcategoria' value='' placeholder='' disabled><?= $postDel->subcategoria ?></textarea>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button style="width: 60%; font-size: 20px;" class="btn btn-lg btn-block btn-danger" id="button"><i class='align-middle me-2' data-feather='trash-2'></i>Deletar</button>
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

</body>

</html>