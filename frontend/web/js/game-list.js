$(document).ready(function() {
    $(".kategori").on("click", function() {
        $(".list-kategori").find(".active-list").removeClass("active-list");
        $(this).addClass("active-list");
        var kode_produk = $(this).attr("data-id");
        $('#kode_produk').val(kode_produk);
        console.log($(this).attr("data-id"));
    });
});