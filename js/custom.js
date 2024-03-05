function seribu(ongkos) {
    var titik = '.';
    var nilai = new String(ongkos);
    var pecah = [];
    while (nilai.length > 3) {
        var asd = nilai.substr(nilai.length - 3);
        pecah.unshift(asd);
        nilai = nilai.substr(0, nilai.length - 3);
    }

    if (nilai.length > 0) { pecah.unshift(nilai); }
    nilai = pecah.join(titik);
    return nilai;
}

jQuery(document).ready(function () {
    jQuery("#loading_raj").removeClass("d-block");
    jQuery("#loading_raj").addClass("d-none");
    jQuery("#ongkos_raj_wrapper").remove();
    jQuery("#ket_raj").hide();

    jQuery('#asal').focus(function () {
        jQuery("#loading_raj").removeClass("d-block");
        jQuery("#loading_raj").addClass("d-none");
        jQuery("#ongkos_raj_wrapper").remove();
        jQuery("#ket_raj").hide();
    });

    jQuery('#tujuan').focus(function () {
        jQuery("#loading_raj").removeClass("d-block");
        jQuery("#loading_raj").addClass("d-none");
        jQuery("#ongkos_raj_wrapper").remove();
        jQuery("#ket_raj").hide();
    });

    jQuery('#asal').autocomplete({
        source: function (request, response) {
            jQuery.ajax({
                url: RajaongkirAjax.ajaxurl,
                type: 'POST',
                dataType: "json",
                data: {
                    action: 'cek_kota',
                    term: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        maxShowItems: 3,
        minLength: 1,
        delay: 10,
        select: function (event, ui) {
            jQuery("#asal").val(ui.item.label);
            jQuery("#asalkota").val(ui.item.value);
            return false;
        },
        search: function () {
            jQuery(this).addClass('working');
        },
        open: function () {
            jQuery(this).removeClass('working');
        }
    });

    jQuery('#tujuan').autocomplete({
        source: function (request, response) {
            jQuery.ajax({
                url: RajaongkirAjax.ajaxurl,
                type: 'POST',
                dataType: "json",
                data: {
                    action: 'cek_kota',
                    term: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        maxShowItems: 3,
        minLength: 1,
        delay: 10,
        select: function (event, ui) {
            jQuery("#tujuan").val(ui.item.label);
            jQuery("#tujuankota").val(ui.item.value);
            return false;
        },
        search: function () {
            jQuery(this).addClass('working');
        },
        open: function () {
            jQuery(this).removeClass('working');
        }
    });

    jQuery("#cek_raj").click(function () {
        jQuery("#ongkos_raj_wrapper").remove();
        jQuery("#ket_raj").empty();
        jQuery("#loading_raj").addClass("d-block");
        jQuery("#ket_raj").after('<table id="ongkos_raj" class="table table-striped"></table>');

        var asal = jQuery('#asalkota').val();
        var tujuan = jQuery('#tujuankota').val();
        var berat = jQuery('#berat').val();
        var kurir = jQuery('input[name=kurir]:checked').val();

        if (asal === '') {
            jQuery("#loading_raj").removeClass("d-block");
            jQuery("#loading_raj").addClass("d-none");
            Swal.fire({
                title: "Kota Asal Pengiriman",
                text: "Tidak boleh kosong!",
                icon: "error"
            });
        } else if (tujuan === '') {
            jQuery("#loading_raj").removeClass("d-block");
            jQuery("#loading_raj").addClass("d-none");
            Swal.fire({
                title: "Kota Tujuan Pengiriman",
                text: "Tidak boleh kosong!",
                icon: "error"
            });
        } else if (berat === '') {
            jQuery("#loading_raj").removeClass("d-block");
            jQuery("#loading_raj").addClass("d-none");
            Swal.fire({
                title: "Berat Kiriman",
                text: "Tidak boleh kosong",
                icon: "error"
            });
        } else if (berat.includes(".")) {
            jQuery("#loading_raj").removeClass("d-block");
            jQuery("#loading_raj").addClass("d-none");
            Swal.fire({
                title: "Berat Kiriman",
                text: "Harus berupa angka tanpa titik!",
                icon: "error"
            });
        } else {
            jQuery.ajax({
                type: 'POST',
                url: RajaongkirAjax.ajaxurl,
                data: {
                    'action': 'cek_ongkir',
                    'tujuan': tujuan,
                    'asal': asal,
                    'berat': berat,
                    'kurir': kurir
                },
                success: function (resp) {
                    jQuery("#loading_raj").removeClass("d-block");
                    jQuery("#loading_raj").addClass("d-none");
                    const data = resp.split('^');
                    if (data.length > 1) {
                        Swal.fire({
                            title: "cURL Error",
                            text: data[1],
                            icon: "error"
                        });
                    } else {
                        var obj = jQuery.parseJSON(resp);
                        var status = obj['rajaongkir'].status;
                        if (status.code == 400) {
                            Swal.fire({
                                title: "Rajaongkir Error",
                                text: status.description,
                                icon: "error"
                            });
                        } else {
                            var hasil = obj['rajaongkir'].results;
                            var n = hasil.length;
                            document.title = 'Ongkir dari ' + obj['rajaongkir'].origin_details.type + ' ' + obj['rajaongkir'].origin_details.city_name + ', ' + obj['rajaongkir'].origin_details.province + ' ke ' + obj['rajaongkir'].destination_details.type + ' ' + obj['rajaongkir'].destination_details.city_name + ', ' + obj['rajaongkir'].destination_details.province + ' @ ' + seribu(obj['rajaongkir'].query.weight) + ' gram';
                            jQuery("#ket_raj").show();
                            jQuery("#ket_raj").html(
                                '<div class="text-center">Asal: <span class="badge badge-primary">' + obj['rajaongkir'].origin_details.type + ' ' + obj['rajaongkir'].origin_details.city_name + ', ' + obj['rajaongkir'].origin_details.province + '</span></div>' +
                                '<div class="text-center">Tujuan: <span class="badge badge-primary">' + obj['rajaongkir'].destination_details.type + ' ' + obj['rajaongkir'].destination_details.city_name + ', ' + obj['rajaongkir'].destination_details.province + '</span></div>' +
                                '<div class="text-center">Berat: <span class="badge badge-primary">' + seribu(obj['rajaongkir'].query.weight) + '</span> Gram</div>'
                            );
                            jQuery("#ongkos_raj").html('<thead class="bg-primary">' +
                                '<tr><th class="text-left">Kurir</th><th class="text-center">Layanan</th><th class="text-center">Sampai (Hari)</th><th style="text-align:right;">Ongkir (Rp)</th></tr></thead>' +
                                '<tbody>');
                            for (i = 0; i < n; i++) {
                                if (obj['rajaongkir'].results[i].costs.length > 0) {
                                    var m = obj['rajaongkir'].results[i].costs.length;
                                    for (j = 0; j < m; j++) {
                                        jQuery("#ongkos_raj").append('<tr>' +
                                            '<td class="text-left">' +
                                            '<span class="text-uppercase">' +
                                            obj['rajaongkir'].results[i].code + '</span> (' + obj['rajaongkir'].results[i].name + ')' +
                                            '</td>' +
                                            '<td class="text-center">' +
                                            '<span class="text-uppercase">' +
                                            obj['rajaongkir'].results[i].costs[j].service + '</span> (' + obj['rajaongkir'].results[i].costs[j].description + ')' +
                                            '</td>' +
                                            '</td>' +
                                            '<td class="text-center">' +
                                            obj['rajaongkir'].results[i].costs[j].cost[0].etd +
                                            '</td>' +
                                            '</td>' +
                                            '<td class="text-center">' +
                                            seribu(obj['rajaongkir'].results[i].costs[j].cost[0].value) + ',00' +
                                            '</td>' +
                                            '</tr>');
                                    }
                                }
                            }

                            jQuery("#ongkos_raj").append('</tbody>');
                            jQuery('#asal').val('');
                            jQuery('#asalkota').val('');
                            jQuery('#tujuan').val('');
                            jQuery('#tujuankota').val('');
                            jQuery('#berat').val('');
                            jQuery("#ongkos_raj").DataTable({
                                responsive: true,
                                columns: [
                                    { responsivePriority: 4 },
                                    { responsivePriority: 3 },
                                    { responsivePriority: 2 },
                                    { responsivePriority: 1 }
                                ],
                                dom: 'Bfrtip',
                                buttons: [
                                    
                                    { extend: 'pdfHtml5' }
                                ]
                            });
                        }
                    }
                }
            });
        }
    });
});