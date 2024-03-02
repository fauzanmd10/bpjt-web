jQuery(function() {
    // dynamic table
    var spm_reports_table = jQuery('#dyntable').dataTable({
        "sPaginationType": "full_numbers",
        "aaSortingFixed": [[0,'asc']],
        "fnDrawCallback": function(oSettings) {
            jQuery.uniform.update();
        },
        "bProcessing": true,
        "sAjaxSource": '/bpjt/admin/spm_reports/api_get_all_spm_reports'
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
            var checked_spm_reports = new Array()
            , selected_rows = spm_reports_table.find('tr.row_selected');
            
            for (var key in checked_group) {
                checked_spm_reports.push(key);
            }

            window.location.href = "/admin/spm_reports/edit/" + checked_spm_reports[0];
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
            , selected_rows = spm_reports_table.find('tr.row_selected');
            
            for (var key in checked_group) {
                checked_categories.push(key);
            }
            
            window.location.href = "/admin/spm_reports/show/" + checked_categories[0];
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
                        var checked_spm_reports = new Array()
                        , selected_rows = spm_reports_table.find('tr.row_selected');
                        
                        for (var key in checked_group) {
                            checked_spm_reports.push(key);
                            console.log(key);
                        }

                        jQuery.ajax({
                            type:"POST",
                            url:"/admin/spm_reports/destroy",
                            data:{
                                spm_report_ids:checked_spm_reports,
                                bpjt_token:jQuery("#token-name").val()
                            },
                            dataType:"json",
                            success:function(response) {
                                if (response.status == "success") {
                                    for(var i=0; i<selected_rows.length; i++) {
                                        var selected_row = selected_rows[i];
                                        spm_reports_table.fnDeleteRow(selected_row);
                                    }
                                    jAlert('Data sudah berhasil dihapus.');
                                } else if (response.status == 'fail' && response.code == 1) {
                                    jAlert('Anda tidak berhak melakukan aksi ini.');
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

})