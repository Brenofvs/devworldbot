$(document).ready(function () {
    $('#categoria').change(function () {
        let categoriaId = $(this).val();

        $.ajax({
            url: './js/subs.php',
            type: 'POST',
            data: { categoriaId: categoriaId },
            success: function (subcategorias) {
                $("#subcat").html(subcategorias)
            }
        });
    });
});