$(document).ready(function() {
    var layanan = $("#layanan_dropdown option:selected").val();
    getLayanan(layanan);
})

$('#layanan_dropdown').on('change', function() {
    var layanan = $("#layanan_dropdown option:selected").val();
    getLayanan(layanan);
    
});

function getLayanan(layanan) {
    console.log(layanan);
    if (layanan == 'pulsa' || layanan == 'paket-data') {
        $('.field-sub_produk_dropdown').show();
        $('.field-provinsi_dropdown').hide();
        $('.field-kota_dropdown').hide();
        $('.field-jenis_dropdown').hide();
        $('.field-emoney_admin_dropdown').hide();
        $('.field-statusakun_dropdown').hide();        
        $('.field-game_dropdown').hide();    
    } else if (layanan == 'tagihan-listrik' || layanan == 'token-listrik' || layanan == 'telkom' || layanan == 'angsuran') {
        $('.field-jenis_dropdown').show();
        $('.field-sub_produk_dropdown').hide();
        $('.field-provinsi_dropdown').hide();
        $('.field-kota_dropdown').hide();
        $('.field-emoney_admin_dropdown').hide();
        $('.field-statusakun_dropdown').hide();       
        $('.field-game_dropdown').hide();   
    } else if (layanan == 'e-money') {
        $('.field-emoney_admin_dropdown').show();
        $('.field-jenis_dropdown').hide();
        $('.field-sub_produk_dropdown').hide();
        $('.field-provinsi_dropdown').hide();
        $('.field-kota_dropdown').hide();
        $('.field-statusakun_dropdown').hide();       
        $('.field-game_dropdown').hide();   
    } else if (layanan == 'pdam') {
        $('.field-provinsi_dropdown').show();
        $('.field-emoney_admin_dropdown').hide();
        $('.field-jenis_dropdown').hide();
        $('.field-sub_produk_dropdown').hide();
        $('.field-kota_dropdown').hide();
        $('.field-statusakun_dropdown').hide();       
        $('.field-game_dropdown').hide();   
    } else if (layanan == 'games') {      
        $('.field-game_dropdown').show(); 
        $('.field-provinsi_dropdown').hide();
        $('.field-emoney_admin_dropdown').hide();
        $('.field-jenis_dropdown').hide();
        $('.field-sub_produk_dropdown').hide();
        $('.field-kota_dropdown').hide();
        $('.field-statusakun_dropdown').hide();
    } else {
        $('.field-provinsi_dropdown').hide();
        $('.field-emoney_admin_dropdown').hide();
        $('.field-jenis_dropdown').hide();
        $('.field-sub_produk_dropdown').hide();
        $('.field-kota_dropdown').hide();
        $('.field-statusakun_dropdown').hide();        
        $('.field-game_dropdown').hide();       
    }
}

$('#emoney_admin_dropdown').on('change', function() {
    var emoney = $( "#emoney_admin_dropdown option:selected" ).val();
    if (emoney == '1' || emoney == '4') {
        $('.field-statusakun_dropdown').show();
    } else {
        $('.field-statusakun_dropdown').hide();
        $('.field-provinsi_dropdown').hide();
        $('.field-kota_dropdown').hide();
    }
});

$('#provinsi_dropdown').on('change', function() {
    var provinsi_id = $("#provinsi_dropdown option:selected").val();
    var baseUrl = 'get-kota';
    $.ajax({
        type     : 'POST',
        url      : baseUrl,
        dataType : 'JSON',
        data     : {
            'provinsi_id' : provinsi_id,
        },
        success: function(res){
            let html  = '';
            if (res.success) {
                let array = [];
                let gambar_link = '';
                let id = '';
                if (res.data.length > 0) {
                    array.push('<option value="">Seluruh Indonesia</option>');
                    res.data.forEach((item, index) => {
                        array.push('<option value='+item.kota_id+'>'+item.nama_kota+'</option>');
                    })
                    array = array.join('');
                    html  = '<label class="control-label" for="kota_dropdown">Kota</label>'
                            +'<select id="kota_dropdown" class="form-control" name="ProdukForm[kota_id]" aria-invalid="false">'
                                +array.toString()
                            +'</select>';
                } else {
                    if (no.length > 3) {
                        $('#error_para').show();
                    } else {
                        $('#error_para').hide();
                    }
                }
                $('.field-kota_dropdown').html(html);
                $('.field-kota_dropdown').show();
                $('.field-jenis_dropdown').show();
                return true;
            } else {
                $('.field-kota_dropdown').html(html);
                return false;
            }
        },
        error: function(e){
            alert('ERROR at PHP side!!');
            return false;
        }
    });  
});