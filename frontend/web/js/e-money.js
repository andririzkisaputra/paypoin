$(document).ready(function() {
    $(".tombol").prop("disabled", true);
    $('.field-statusakun_dropdown').hide();
});

$(document).on('click', '.click_produk', function() {
    var id          = $(this).attr("id");
    var kode_produk = $(this).attr("data-id");
    console.log(kode_produk);
    $('#kode_produk').val(kode_produk);
    $(".tombol").prop("disabled", false);
});

$('#emoney_dropdown').on('change', function() {
    $(".tombol").prop("disabled", true);
    var emoney  = $( "#emoney_dropdown option:selected" ).val();
    var status  = $( "#statusakun_dropdown option:selected" ).val();
    var layanan = $( "#code_layanan" ).val();
    var baseUrl = 'e-money/default/get-emoney';
    if (emoney == '1' || emoney == '4') {
        $('.field-statusakun_dropdown').show();
    } else {
        status = '';
        $('.field-statusakun_dropdown').hide();
    }
    
    $.ajax({
        type     : 'POST',
        url      : baseUrl,
        dataType : 'JSON',
        data     : {
            'is_emoney'        : emoney,
            'is_emoney_status' : status,
            'code_layanan'     : layanan,
        },
        success: function(res){
            let html  = '';
            if (res.success) {
                let array = [];
                let gambar_link = '';
                let id = '';
                if (res.data.length > 0) {
                    res.data.forEach((item, index) => {
                        // gambar_link = '<img class="img-responsive" src="'+prefix['img']+'" width="150" style="margin: 15px 50px 20px 50px"></img>';
                        id = 'id-'+item.kode_produk;
                        if (index == 0) {
                            array.push(
                                '<label class="click_produk active" data-id='+item.kode_produk+' id='+id+' style="width: 250px; margin:2px">'
                                    +'<figcaption>'+item.nama_produk+'</figcaption>'
                                    +'<figcaption>'+item.total_harga+'</figcaption>'
                                +'</label>'
                            );                                   
                        } else {
                            array.push(
                                '<label class="click_produk" data-id='+item.kode_produk+' id='+id+' style="width: 250px; margin:2px">'
                                    +'<figcaption>'+item.nama_produk+'</figcaption>'
                                    +'<figcaption>'+item.total_harga+'</figcaption>'
                                +'</label>'
                            );   
    
                        }
                    })
                    array = array.join('');
                    html  = '<h2>Harga</h2>'
                            +array.toString();
                } else {
                    if (no.length > 3) {
                        $('#error_para').show();
                    } else {
                        $('#error_para').hide();
                    }
                }
                $('#my_harga').html(html);
                var btnContainer = document.getElementById("my_harga");
                var btns = btnContainer.getElementsByClassName("click_produk");
                console.log(btns.length);
                for (var i = 0; i < btns.length; i++) {
                    btns[i].addEventListener("click", function() {
                        var current = document.getElementsByClassName("active");
                        current[0].className = current[0].className.replace(" active", "");
                        this.className += " active";
                    });
                }
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
});


$('#statusakun_dropdown').on('change', function() {
    $(".tombol").prop("disabled", true);
    var emoney  = $( "#emoney_dropdown option:selected" ).val();
    var status  = $( "#statusakun_dropdown option:selected" ).val();
    var layanan = $( "#code_layanan" ).val();
    var baseUrl = 'e-money/default/get-emoney';
    if (emoney == '1' || emoney == '4') {
        $('.field-statusakun_dropdown').show();
    } else {
        $('.field-statusakun_dropdown').hide();
    }
    $.ajax({
        type     : 'POST',
        url      : baseUrl,
        dataType : 'JSON',
        data     : {
            'is_emoney'        : emoney,
            'is_emoney_status' : status,
            'code_layanan'       : layanan,
        },
        success: function(res){
            let html  = '';
            if (res.success) {
                let array = [];
                let gambar_link = '';
                let id = '';
                if (res.data.length > 0) {
                    res.data.forEach((item, index) => {
                        // gambar_link = '<img class="img-responsive" src="'+prefix['img']+'" width="150" style="margin: 15px 50px 20px 50px"></img>';
                        id = 'id-'+item.kode_produk;
                        if (index == 0) {
                            array.push(
                                '<label class="click_produk active" data-id='+item.kode_produk+' id='+id+' style="width: 250px; margin:2px">'
                                    +'<figcaption>'+item.nama_produk+'</figcaption>'
                                    +'<figcaption>'+item.total_harga+'</figcaption>'
                                +'</label>'
                            );                                   
                        } else {
                            array.push(
                                '<label class="click_produk" data-id='+item.kode_produk+' id='+id+' style="width: 250px; margin:2px">'
                                    +'<figcaption>'+item.nama_produk+'</figcaption>'
                                    +'<figcaption>'+item.total_harga+'</figcaption>'
                                +'</label>'
                            );   
    
                        } 
                    })
                    array = array.join('');
                    html  = '<h2>Harga</h2>'
                            +array.toString();
                } else {
                    if (no.length > 3) {
                        $('#error_para').show();
                    } else {
                        $('#error_para').hide();
                    }
                }
                $('#my_harga').html(html);
                var btnContainer = document.getElementById("my_harga");
                var btns = btnContainer.getElementsByClassName("click_produk");
                for (var i = 0; i < btns.length; i++) {
                    btns[i].addEventListener("click", function() {
                        var current = document.getElementsByClassName("active");
                        current[0].className = current[0].className.replace(" active", "");
                        this.className += " active";
                    });
                }
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
});