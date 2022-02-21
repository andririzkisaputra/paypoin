$(document).ready(function() {
    $(".tombol").prop("disabled", true);
    $('.field-statusakun_dropdown').hide();
});

$(document).on('click', '.kategori', function() {
    $(".list-kategori").find(".active-list").removeClass("active-list");
    $(this).addClass("active-list");
    var kode_produk = $(this).attr("data-id");
    $('#kode_produk').val(kode_produk);
    $(".tombol").prop("disabled", false);
});

$('#brand').on('change', function() {
    $('#kode_produk').val('');
    $(".tombol").prop("disabled", true);
    var brand   = $( "#brand option:selected" ).val();
    var trxtype = $( "#trxtype" ).val();
    var baseUrl = 'e-money/default/get-brand';
    
    $.ajax({
        type     : 'POST',
        url      : baseUrl,
        dataType : 'JSON',
        data     : {
            'brand'   : brand,
            'trxtype' : trxtype,
        },
        success: function(res){
            let html  = '';
            if (res.success) {
                let array = [];
                if (res.data.length > 0) {
                    res.data.forEach((item, index) => {
                        if (brand === 'GOJEK' || brand === 'GRAB') {
                            array.push(
                                '<option value="'+item.category+'">'+item.category+'</option>'
                            );                                
                        } else {
                            array.push(
                                '<label class="kategori" data-id='+item.code+' style="width: 10%; margin:22px; padding:10px;">'
                                    // +'<figcaption><b>'+item.name+'</b></figcaption>'
                                    +'<figcaption><b>'+item.price_f+'</b></figcaption>'
                                +'</label>'
                            );    
                        }
                    })
                    array = array.join('');
                    if (brand === 'GOJEK' || brand === 'GRAB') {
                        html = '<label class="control-label" for="brand">Pilih</label>'
                                +'<select id="category" class="form-control" name="TagihanForm[category]">'
                                    +'<option value="">Kategori</option>'
                                    +array.toString()
                                +'</select>';
                        $('#category').html(html);
                        $('#my_harga').html('');
                        $('#category').show();
                        return true;                          
                    } else {
                        html = '<h2>Harga</h2>'
                                +'<div class="list-kategori row">'
                                +array.toString()
                             +'</div>';
                        $('#my_harga').html(html);
                        $('#category').html('');
                        $('#category').hide();
                        return true;
                    }
                }
            } else {
                $('#my_harga').html(html);
                return false;
            }
        },
        error: function(e){
            alert('ERROR at PHP side!!');
            return false;
        }
    });  
});


$('#category').on('change', function() {
    $('#kode_produk').val('');
    $(".tombol").prop("disabled", true);
    var brand    = $( "#brand option:selected" ).val();
    var category = $( "#category option:selected" ).val();
    var trxtype  = $( "#trxtype" ).val();
    var layanan = $( "#code_layanan" ).val();
    var baseUrl = 'e-money/default/get-brand';
    if (category) {
        $.ajax({
            type     : 'POST',
            url      : baseUrl,
            dataType : 'JSON',
            data     : {
                'brand'    : brand,
                'trxtype'  : trxtype,
                'category' : category,
            },
            success: function(res){
                let html  = '';
                if (res.success) {
                    let array = [];
                    if (res.data.length > 0) {
                        res.data.forEach((item, index) => {
                            array.push(
                                '<label class="kategori" data-id='+item.code+' style="width: 10%; margin:22px; padding:10px;">'
                                    +'<figcaption><b>'+item.price_f+'</b></figcaption>'
                                +'</label>'
                            );   
                        })
                        array = array.join('');
                        html = '<h2>Harga</h2>'
                                +'<div class="list-kategori row">'
                                +array.toString()
                             +'</div>';
                    }
                    $('#my_harga').html(html);
                    return true;
                } else {
                    $('#my_harga').html(html);
                    return false;
                }
            },
            error: function(e){
                alert('ERROR at PHP side!!');
                return false;
            }
        });  
    } else {
        $('#my_harga').html('');
    }
});