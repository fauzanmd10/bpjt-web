jQuery(document).ready(function(){
    // dynamic table
    var albums_table = jQuery('#dyntableform').dataTable({
        "sPaginationType": "full_numbers",
        "aaSortingFixed": [[0,'asc']],
        "fnDrawCallback": function(oSettings) {
            jQuery.uniform.update();
        },
        "bProcessing": true,
        "sAjaxSource": '/admin/lelangdoc/api_get_all_formalbums?id_ruas=' + jQuery('#id_ruas').val()
    });
    
    jQuery('#dyntable2').dataTable( {
        "bScrollInfinite": true,
        "bScrollCollapse": true,
        "sScrollY": "300px"
    });

    var checked_count = 0
    , checked_group = new Array()
    , $check_all = jQuery("#checkall")
    , $btn_edit = jQuery("#btn-edit")
    , $btn_show = jQuery("#btn-show");

    $check_all.on('change', function(e) {
        var $checkers = jQuery(".checkerbox");
        if (this.checked) {
            for(var i=0; i<$checkers.length; i++) {
                var checker = $checkers[i];
                if (!checker.checked) {
                    var $checker = jQuery(checker);
                    $checker.attr('checked', true).parent().addClass('checked');
                    
                    checked_count++;
                    checked_group[checker.dataset.id] = true;

                    $checker.parent().parent().parent().parent().parent().addClass('row_selected');
                }
            }
        } else {
            for(var i=0; i<$checkers.length; i++) {
                var checker = $checkers[i];
                if (checker.checked) {
                    var $checker = jQuery(checker);
                    $checker.attr('checked', false).parent().removeClass('checked');
                    
                    //checker.checked = false;
                    checked_count--;
                    delete checked_group[checker.dataset.id];

                    $checker.parent().parent().parent().parent().parent().removeClass('row_selected');
                }
            }
        }
    })

    jQuery(document).on('change', '.checkerbox', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        var $this = jQuery(this)
        , $span = jQuery(this).parent();

        if (this.checked) {
            checked_count++;
            checked_group[this.dataset.id] = true;

            $this.parent().parent().parent().parent().parent().addClass('row_selected');
            $span.addClass('checked');
        } else {
            checked_count--;
            delete checked_group[this.dataset.id];

            $this.parent().parent().parent().parent().parent().removeClass('row_selected');
            $span.removeClass('checked');
        }
    });

    $btn_edit.on('click', function(e) {
        e.preventDefault();

        if (checked_count == 1) {
            var checked_categories = new Array()
            , selected_rows = albums_table.find('tr.row_selected');
            
            for (var key in checked_group) {
                checked_categories.push(key);
            }

            window.location.href = "/admin/photo_albums/edit/" + checked_categories[0];
        } else if (checked_count == 0) {
            jAlert('Silakan pilih minimal 1 data terlebih dahulu.');
        } else {
            jAlert('Maksimal memilih 1 data untuk diubah.');
        }
    });

    $btn_show.on('click', function(e) {
        e.preventDefault();

        if (checked_count == 1) {
            var checked_categories = new Array()
            , selected_rows = albums_table.find('tr.row_selected');
            
            for (var key in checked_group) {
                checked_categories.push(key);
            }
            
            window.location.href = "/admin/photo_albums/show/" + checked_categories[0];
        } else if (checked_count == 0) {
            jAlert('Silakan pilih minimal 1 data terlebih dahulu.');
        } else {
            jAlert('Maksimal memilih 1 data untuk diubah.');
        }
    });

    if(jQuery('.confirmbutton').length > 0) {
        jQuery('.confirmbutton').click(function() {
            if (checked_count == 0) {
                jAlert('Silakan pilih minimal 1 data terlebih dahulu.');
            } else {
                jConfirm('Anda yakin ingin menghapus item terpilih?', 'Pertanyaan', function(r) {
                    if (r) {
                        var checked_categories = new Array()
                        , selected_rows = albums_table.find('tr.row_selected');
                        
                        for (var key in checked_group) {
                            checked_categories.push(key);
                        }

                        jQuery.ajax({
                            type:"POST",
                            url:"/admin/photo_albums/destroy",
                            data:{
                                album_ids:checked_categories,
                                bpjt_token:jQuery("#token-name").val()
                            },
                            dataType:"json",
                            success:function(response) {
                                if (response.status == "success") {
                                    for(var i=0; i<selected_rows.length; i++) {
                                        var selected_row = selected_rows[i];
                                        albums_table.fnDeleteRow(selected_row);
                                    }
                                    jAlert('Data sudah berhasil dihapus.');
                                } else {
                                    jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
                                }
                            },
                            error:function(response) {
                                jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
                            }
                        });
                    }
                });
            }
        });
    }
    
});

jQuery(window).load(function(){
    jQuery('#medialist').isotope({
        itemSelector : 'li',
        layoutMode : 'fitRows'
    });
    
    // Media Filter
    jQuery('#mediafilter a').click(function(){
    
        var filter = (jQuery(this).attr('href') != 'all')? '.'+jQuery(this).attr('href') : '*';
        jQuery('#medialist').isotope({ filter: filter });
    
        jQuery('#mediafilter li').removeClass('current');
        jQuery(this).parent().addClass('current');
    
        return false;
    });
});

function myFunc(id,url) {
    // var v = 0;
    // for (var j=0; j<1000; j++) {
    // v+=j;
    // }
    // alert(v);
    console.log(url);
    jConfirm('Anda yakin ingin mengunduh dokumen?', 'Pertanyaan', function(r) {
        if (r) {
            jQuery.ajax({
                type:"POST",
                url:"/admin/lelangdoc/cek_download/" + id,
                dataType:"json",
                success:function(response) {
                    // console.log(response);
                    if (response.status == "success") {
                        
                        // jAlert('Data sudah berhasil Di Download.');
                        jQuery.ajax({
                            type:"POST",
                            url:"/admin/lelangdoc/update_download/" + id,
                            dataType:"json",
                            success:function(response) {
                                // console.log(response);
                                if (response.status == "success") {
                                    
                                    jAlert('Data sudah berhasil Di Download.');
                                    // window.location.href =url;
                                    window.open(
                                        url,
                                        '_blank' // <- This is what makes it open in a new window.
                                      );
                                } else {
                                    jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
                                }
                            },
                            error:function(response) {
                                jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
                            }
                        });
                    } else {
                        jAlert('Anda Sudah Pernah Melakukan Download Dokumen..');
                    }
                },
                // error: function(XMLHttpRequest, textStatus, errorThrown) {
                //     var errorMessage = errorThrown + ': ' + textStatus
                //     alert('Error - ' + errorMessage);
                //  }
                error:function(response) {
                    jAlert('Ada kesalahan pada sistem. Silakan mencoba beberapa saat lagi.');
                }
            });
        }
    });
}