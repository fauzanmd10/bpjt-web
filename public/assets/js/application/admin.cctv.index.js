jQuery(document).ready(function(){
    // dynamic table
    var cctv_table = jQuery('#dyntable').dataTable({
        "sPaginationType": "full_numbers",
        "aaSortingFixed": [[0,'asc']],
        "fnDrawCallback": function(oSettings) {
            jQuery.uniform.update();
        },
        "bProcessing": true,
        "sAjaxSource": '/admin/cctv/api_get_all_cctv'
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
            , selected_rows = cctv_table.find('tr.row_selected');
            
            for (var key in checked_group) {
                checked_categories.push(key);
            }

            window.location.href = "/admin/cctv/edit/" + checked_categories[0];
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
            , selected_rows = cctv_table.find('tr.row_selected');
            
            for (var key in checked_group) {
                checked_categories.push(key);
            }
            
            window.location.href = "/admin/cctv/show/" + checked_categories[0];
        } else if (checked_count == 0) {
            jAlert('Silakan pilih minimal 1 data terlebih dahulu.');
        } else {
            jAlert('Maksimal memilih 1 data untuk diubah.');
        }
    });

    if(jQuery('.confirmbutton_edit').length > 0) {
        jQuery('.confirmbutton_edit').click(function() {
            if (checked_count == 0) {
                jAlert('Silakan pilih minimal 1 data terlebih dahulu.');
            } else {
                jConfirm('Anda yakin ingin mengedit urutan item terpilih?', 'Pertanyaan', function(r) {
                    if (r) {
                        var checked_categories = new Array()
                        , selected_rows = cctv_table.find('tr.row_selected');
                        var checked_sequences = new Array();
                        
                        for (var key in checked_group) {
                            checked_categories.push(key);
                            checked_sequences.push(jQuery('#sequence_' + key).val());
                        }

                        jQuery.ajax({
                            type:"POST",
                            url:"/admin/cctv/update_sequence",
                            data:{
                            	cctv_ids:checked_categories,
                                sequences: checked_sequences,
                                tolkitasemua:jQuery("#token-value").val()
                            },
                            dataType:"json",
                            success:function(response) {
                                if (response.status == "success") {
                                    jAlert('Data sudah berhasil diedit.');
                                    setTimeout(function(){
                                        window.location.reload();
                                    }, 3000);
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

    if(jQuery('.confirmbutton').length > 0) {
        jQuery('.confirmbutton').click(function() {
            if (checked_count == 0) {
                jAlert('Silakan pilih minimal 1 data terlebih dahulu.');
            } else {
                jConfirm('Anda yakin ingin menghapus item terpilih?', 'Pertanyaan', function(r) {
                    if (r) {
                        var checked_categories = new Array()
                        , selected_rows = cctv_table.find('tr.row_selected');
                        
                        for (var key in checked_group) {
                            checked_categories.push(key);
                        }

                        jQuery.ajax({
                            type:"POST",
                            url:"/admin/cctv/destroy",
                            data:{
                            	cctv_ids:checked_categories,
                                tolkitasemua:jQuery("#token-value").val()
                            },
                            dataType:"json",
                            success:function(response) {
                                if (response.status == "success") {
                                    for(var i=0; i<selected_rows.length; i++) {
                                        var selected_row = selected_rows[i];
                                        cctv_table.fnDeleteRow(selected_row);
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