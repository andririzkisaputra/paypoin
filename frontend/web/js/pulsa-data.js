var cache_no = '';
$('#error_para').hide();
$(".tombol").prop("disabled", true);

$(document).on('click', '.kategori', function() {
    $(".list-kategori").find(".active-list").removeClass("active-list");
    $(this).addClass("active-list");
    var kode_produk = $(this).attr("data-id");
    $('#kode_produk').val(kode_produk);
    $(".tombol").prop("disabled", false);
});

function list_harga() {
    var type = $('#type').val();
    var no          = $('#dest').val();
    var no          = no.substring(0, 4);
    var provider    = prefixData();
    var prefix      = '';
    for (var i = 0; i < provider.length; i++) {
        if (provider[i]['prefix'] == no) {
            prefix = provider[i];
        }
    }
    console.log(prefix['id']);
    var baseUrl = 'site/cek-notelp';
    if (no != cache_no) {
        cache_no = no;
        $.ajax({
            type     : 'POST',
            url      : baseUrl,
            dataType : 'JSON',
            data     : {
                'id'   : prefix['id'],
                'type' : type
            },
            success: function(res){
                $('#error_para').hide();
                let html  = '';
                let array = [];
                let gambar_link = '';
                let id = '';
                if (res.data.length > 0) {
                    res.data.map((item, index) => {
                        gambar_link = '<img class="img-responsive" src="'+prefix['img']+'" width="50%" style="min-width: -webkit-fill-available"></img>';
                        id          = 'id-'+item.code;
                        array.push(
                            '<label class="kategori" data-id='+item.code+' id='+id+' style="width: 150px;">'
                                +'<div class="">'
                                    +gambar_link
                                +'</div>'
                                +'<div class="bottom-text-list">'
                                    +'<figcaption><b>'+item.name+'</b></figcaption>'
                                    +'<figcaption><b>'+item.price_f+'</b></figcaption>'
                                +'</div>'
                            +'</label>'
                        );
                    })
                    array = array.join('');
                    html  = '<h2>Harga</h2>'
                            +'<div class="list-kategori" id="">'
                                +array.toString()
                            +'</div>';
                } else {
                    if (no.length > 3) {
                        $('#error_para').show();
                    } else {
                        $('#error_para').hide();
                    }
                }
                $('#my_harga').html(html);
                
                return true;
            },
            error: function(e){
                alert('ERROR at PHP side!!');
                return false;
            }
        });   
    }
}

function prefixData() {
    var prefix = [
        {
            "id"     : "TELKOMSEL",
            "prefix" : "0811",
            "name"   : "Telkomsel",
            "img"    : "https://npay.kemasayur.id/uploads/operator/telkomsel.png"
        },
        {
            "id"     : "TELKOMSEL",
            "prefix" : "0812",
            "name"   : "Telkomsel",
            "img"    : "https://npay.kemasayur.id/uploads/operator/telkomsel.png"
        },
        {
            "id"     : "TELKOMSEL",
            "prefix" : "0813",
            "name"   : "Telkomsel",
            "img"    : "https://npay.kemasayur.id/uploads/operator/telkomsel.png"
        },
        {
            "id"     : "TELKOMSEL",
            "prefix" : "0821",
            "name"   : "Telkomsel",
            "img"    : "https://npay.kemasayur.id/uploads/operator/telkomsel.png"
        },
        {
            "id"     : "TELKOMSEL",
            "prefix" : "0822",
            "name"   : "Telkomsel",
            "img"    : "https://npay.kemasayur.id/uploads/operator/telkomsel.png"
        },
        {
            "id"     : "TELKOMSEL",
            "prefix" : "0823",
            "name"   : "Telkomsel",
            "img"    : "https://npay.kemasayur.id/uploads/operator/telkomsel.png"
        },
        {
            "id"     : "TELKOMSEL",
            "prefix" : "0852",
            "name"   : "Telkomsel",
            "img"    : "https://npay.kemasayur.id/uploads/operator/telkomsel.png"
        },
        {
            "id"     : "TELKOMSEL",
            "prefix" : "0853",
            "name"   : "Telkomsel",
            "img"    : "https://npay.kemasayur.id/uploads/operator/telkomsel.png"
        },
        {
            "id"     : "INDOSAT",
            "prefix" : "0814",
            "name"   : "Indosat",
            "img"    : "https://npay.kemasayur.id/uploads/operator/indosat.png"
        },
        {
            "id"     : "INDOSAT",
            "prefix" : "0815",
            "name"   : "Indosat",
            "img"    : "https://npay.kemasayur.id/uploads/operator/indosat.png"
        },
        {
            "id"     : "INDOSAT",
            "prefix" : "0816",
            "name"   : "Indosat",
            "img"    : "https://npay.kemasayur.id/uploads/operator/indosat.png"
        },
        {
            "id"     : "INDOSAT",
            "prefix" : "0855",
            "name"   : "Indosat",
            "img"    : "https://npay.kemasayur.id/uploads/operator/indosat.png"
        },
        {
            "id"     : "INDOSAT",
            "prefix" : "0856",
            "name"   : "Indosat",
            "img"    : "https://npay.kemasayur.id/uploads/operator/indosat.png"
        },
        {
            "id"     : "INDOSAT",
            "prefix" : "0857",
            "name"   : "Indosat",
            "img"    : "https://npay.kemasayur.id/uploads/operator/indosat.png"
        },
        {
            "id"     : "INDOSAT",
            "prefix" : "0858",
            "name"   : "Indosat",
            "img"    : "https://npay.kemasayur.id/uploads/operator/indosat.png"
        },
        {
            "id"     : "XL",
            "prefix" : "0817",
            "name"   : "XL",
            "img"    : "https://npay.kemasayur.id/uploads/operator/xl.png"
        },
        {
            "id"     : "XL",
            "prefix" : "0818",
            "name"   : "XL",
            "img"    : "https://npay.kemasayur.id/uploads/operator/xl.png"
        },
        {
            "id"     : "XL",
            "prefix" : "0819",
            "name"   : "XL",
            "img"    : "https://npay.kemasayur.id/uploads/operator/xl.png"
        },
        {
            "id"     : "XL",
            "prefix" : "0859",
            "name"   : "XL",
            "img"    : "https://npay.kemasayur.id/uploads/operator/xl.png"
        },
        {
            "id"     : "XL",
            "prefix" : "0877",
            "name"   : "XL",
            "img"    : "https://npay.kemasayur.id/uploads/operator/xl.png"
        },
        {
            "id"     : "XL",
            "prefix" : "0878",
            "name"   : "XL",
            "img"    : "https://npay.kemasayur.id/uploads/operator/xl.png"
        },
        {
            "id"     : "AXIS",
            "prefix" : "0831",
            "name"   : "Axis",
            "img"    : "https://npay.kemasayur.id/uploads/operator/axis.png"
        },
        {
            "id"     : "AXIS",
            "prefix" : "0832",
            "name"   : "Axis",
            "img"    : "https://npay.kemasayur.id/uploads/operator/axis.png"
        },
        {
            "id"     : "AXIS",
            "prefix" : "0833",
            "name"   : "Axis",
            "img"    : "https://npay.kemasayur.id/uploads/operator/axis.png"
        },
        {
            "id"     : "AXIS",
            "prefix" : "0838",
            "name"   : "Axis",
            "img"    : "https://npay.kemasayur.id/uploads/operator/axis.png"
        },
        {
            "id"     : "THREE",
            "prefix" : "0895",
            "name"   : "Three",
            "img"    : "https://npay.kemasayur.id/uploads/operator/three.png"
        },
        {
            "id"     : "THREE",
            "prefix" : "0896",
            "name"   : "Three",
            "img"    : "https://npay.kemasayur.id/uploads/operator/three.png"
        },
        {
            "id"     : "THREE",
            "prefix" : "0897",
            "name"   : "Three",
            "img"    : "https://npay.kemasayur.id/uploads/operator/three.png"
        },
        {
            "id"     : "THREE",
            "prefix" : "0898",
            "name"   : "Three",
            "img"    : "https://npay.kemasayur.id/uploads/operator/three.png"
        },
        {
            "id"     : "THREE",
            "prefix" : "0899",
            "name"   : "Three",
            "img"    : "https://npay.kemasayur.id/uploads/operator/three.png"
        },
        {
            "id"     : "SMARTFREN",
            "prefix" : "0881",
            "name"   : "Smartfren",
            "img"    : "https://npay.kemasayur.id/uploads/operator/smartfren.png"
        },
        {
            "id"     : "SMARTFREN",
            "prefix" : "0882",
            "name"   : "Smartfren",
            "img"    : "https://npay.kemasayur.id/uploads/operator/smartfren.png"
        },
        {
            "id"     : "SMARTFREN",
            "prefix" : "0883",
            "name"   : "Smartfren",
            "img"    : "https://npay.kemasayur.id/uploads/operator/smartfren.png"
        },
        {
            "id"     : "SMARTFREN",
            "prefix" : "0884",
            "name"   : "Smartfren",
            "img"    : "https://npay.kemasayur.id/uploads/operator/smartfren.png"
        },
        {
            "id"     : "SMARTFREN",
            "prefix" : "0885",
            "name"   : "Smartfren",
            "img"    : "https://npay.kemasayur.id/uploads/operator/smartfren.png"
        },
        {
            "id"     : "SMARTFREN",
            "prefix" : "0886",
            "name"   : "Smartfren",
            "img"    : "https://npay.kemasayur.id/uploads/operator/smartfren.png"
        },
        {
            "id"     : "SMARTFREN",
            "prefix" : "0887",
            "name"   : "Smartfren",
            "img"    : "https://npay.kemasayur.id/uploads/operator/smartfren.png"
        },
        {
            "id"     : "SMARTFREN",
            "prefix" : "0888",
            "name"   : "Smartfren",
            "img"    : "https://npay.kemasayur.id/uploads/operator/smartfren.png"
        },
        {
            "id"     : "SMARTFREN",
            "prefix" : "0889",
            "name"   : "Smartfren",
            "img"    : "https://npay.kemasayur.id/uploads/operator/smartfren.png"
        },
        {
            "id"     : "BY.U",
            "prefix" : "0851",
            "name"   : "Byu",
            "img"    : "https://npay.kemasayur.id/uploads/operator/byu.png"
        },
    ];
    return prefix;
    
}
// var header = document.getElementById("my_harga");
// var btns   = header.getElementsByClassName("click_produk");

// for (var i = 0; i < btns.length; i++) {
//   btns[i].addEventListener("click", function() {
//   var current = document.getElementsByClassName("border-active");
//   if (current.length > 0) { 
//     current[0].className = current[0].className.replace(" border-active", "");
//   }
//   this.className += " active";
//   });
// }