<style>
    .m-r-10{
        margin-right: 10px;
    }
</style>
<div class="mediamgr">
    <?php if (!empty($this->session->flashdata('document_success'))) { ?>
        <div class="alert alert-success">
            Data sudah berhasil disimpan.
        </div>
    <?php } elseif (!empty($this->session->flashdata('document_failed'))) { ?>
        <div class="alert alert-error">
            Data tidak berhasil disimpan karena ada kesalahan pada sistem.
        </div>
    <?php } elseif (!empty($this->session->flashdata('documents_delete_success'))) { ?>
        <div class="alert alert-success">
            Berhasil hapus dokumen
        </div>
    <?php } elseif (!empty($this->session->flashdata('documents_delete_failed'))) { ?>
        <div class="alert alert-error">
            Gagal hapus dokumen
        </div>
    <?php } ?>
    <br class="clearall" />
    <table id="dyntableform" class="table table-bordered responsive">

        <div class="">
        <?php
         if ($this->session->userdata('user_group_id') == '22'||$this->session->userdata('user_group_id') == '23') {
           echo "<h3>Download Formulir Request For Proposal</h3>";
         }else{
            echo "<h3>Download Formulir Prequalification</h3>"; 
         }
        ?>

    <input type="hidden" id="id_ruas" value="<?php echo $this->input->get('id_ruas')?>">

    <?php
    //  print_r($this->session->userdata());
    if ($this->session->userdata('user_group_id') == '19'||$this->session->userdata('user_group_id') == '21'||$this->session->userdata('user_group_id') == '23'||$this->session->userdata('user_group_id') == '25'||$this->session->userdata('user_group_id') == '27'||$this->session->userdata('user_group_id') == '29'||$this->session->userdata('user_group_id') == '31'||$this->session->userdata('user_group_id') == '33'||$this->session->userdata('user_group_id') == '35'||$this->session->userdata('user_group_id') == '43'||$this->session->userdata('user_group_id') == '45') {

    ?>
        <a href="<?php echo site_url('auctions_form'); ?>" class="btn btn-primary pull-right">Upload File</a>
    <?php
    }
    ?>
      
        <div class="clearfix"></div>
        </div>
        <colgroup>
            <!-- <col class="con0" style="align: center; width: 4%" /> -->
            <col class="con1" />
            <col class="con0" />
            <?php if ($this->session->userdata('user_group_id') =='19'||$this->session->userdata('user_group_id') =='21') {
                    echo "<col class=\"con1\" />";
                } ?>
            
	    <col class="con0" />
            <col class="con1" />
            <col class="con0" />
            <col class="con1" />
            <!-- <col class="con0" />         -->
        </colgroup>
        <thead>
            <tr>
                <!-- <th class="head0 nosort"><input type="checkbox" id="checkall" /></th> -->
                <th class="head0">No.</th>
                <th class="head1">Document Name</th>
                <?php if ($this->session->userdata('user_group_id') =='19'||$this->session->userdata('user_group_id') =='21') {
                    echo "<th class=\"head0\">status</th>";
                } ?>
                
                <th class="head0">Slug</th>
                <th class="head0">Upload Dates</th>
                <!-- <th class="head0">Created By</th> -->
                <th class="head1">Dates Update</th>
                <th class="head0">Document</th>
                <?php
                if ($this->session->userdata('user_group_id') == '19'||$this->session->userdata('user_group_id') == '21'||$this->session->userdata('user_group_id') == '23'||$this->session->userdata('user_group_id') == '25'||$this->session->userdata('user_group_id') == '27'||$this->session->userdata('user_group_id') == '29'||$this->session->userdata('user_group_id') == '31'||$this->session->userdata('user_group_id') == '33'||$this->session->userdata('user_group_id') == '35'||$this->session->userdata('user_group_id') == '43'||$this->session->userdata('user_group_id') == '45') {
                ?>
                <th class="head1">Action</th>
                <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <!-- Data generated via AJAX -->
        </tbody>
    </table>

    <br /><br />
    <table id="dyntablealbum" class="table table-bordered responsive">
        <div class="">
        <?php
         if ($this->session->userdata('user_group_id') == '22'||$this->session->userdata('user_group_id') == '23') {
           echo "<h3>Uploaded Document </h3>";
         }else{
            echo "<h3>Uploaded Formulir Prequalification</h3>"; 
         }
        ?>
            
        </div>
        <colgroup>
            <!-- <col class="con0" style="align: center; width: 4%" /> -->
            <col class="con1" />
            <col class="con0" />
            <col class="con1" />
            <col class="con1" />
            <col class="con0" />
            <col class="con1" />
            <!-- <col class="con0" /> -->
            <!-- <col class="con1" /> -->
            <col class="con0" />
            <col class="con1" />
            <!-- <col class="con0" />         -->
        </colgroup>
        <thead>
            <tr>
                <!-- <th class="head0 nosort"><input type="checkbox" id="checkall" /></th> -->
                <th class="head0">No.</th>
                <th class="head1">Toll Road PQ</th>
                <th class="head0">Company Name</th>
                <th class="head1">Document Name</th>
                <th class="head0">Caption</th>
                <th class="head0">Slug</th>
                <!-- <th class="head0">Upload Dates</th> -->
                <!-- <th class="head0">Created By</th> -->
                <th class="head1">Dates Update</th>
                <th class="head0">Document</th>
                <?php
                if ($this->session->userdata('user_group_id') == '19'||$this->session->userdata('user_group_id') == '21'||$this->session->userdata('user_group_id') == '23'||$this->session->userdata('user_group_id') == '25'||$this->session->userdata('user_group_id') == '27'||$this->session->userdata('user_group_id') == '29'||$this->session->userdata('user_group_id') == '31'||$this->session->userdata('user_group_id') == '33'||$this->session->userdata('user_group_id') == '35'||$this->session->userdata('user_group_id') == '43'||$this->session->userdata('user_group_id') == '45') {
                ?>
                <th class="head1">Action</th>
                <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <!-- Data generated via AJAX -->
        </tbody>
    </table>
    <?php
    //  print_r($this->session->userdata());
    if ($this->session->userdata('user_group_id') == '18'||$this->session->userdata('user_group_id') == '20'||$this->session->userdata('user_group_id') == '22'||$this->session->userdata('user_group_id') == '24'||$this->session->userdata('user_group_id') == '26'||$this->session->userdata('user_group_id') == '28'||$this->session->userdata('user_group_id') == '30'||$this->session->userdata('user_group_id') == '32'||$this->session->userdata('user_group_id') == '34'||$this->session->userdata('user_group_id') == '42'||$this->session->userdata('user_group_id') == '44') {

    ?>


        <br /><br />
        <div class="mediamgr_left">
            <div class="mediamgr_head">
                <ul class="mediamgr_menu">
                    <li>
                        <?php if ($page == 1) { ?>
                            <a href="#" class="btn prev prev_disabled"><span class="icon-chevron-left"></span></a>
                        <?php } else { ?>
                            <a href="?page=<?php echo ($page - 1); ?>" class="btn prev"><span class="icon-chevron-left"></span></a>
                        <?php } ?>
                    </li>
                    <li>
                        <?php if ($page < $total_page) { ?>
                            <a href="?page=<?php echo ($page + 1); ?>" class="btn next"><span class="icon-chevron-right"></span></a>
                        <?php } else { ?>
                            <a href="#" class="btn next next_disabled"><span class="icon-chevron-right"></span></a>
                        <?php } ?>
                    </li>
                    <!--<li class="marginleft15"><a class="btn selectall"><span class="icon-check"></span> Pilih Semua</a></li>-->
                    <!--<li class="marginleft15 newfoldbtn"><a class="btn newfolder" title="Add New Folder"><span class="icon-folder-open"></span></a></li>-->
                    <!--<li class="marginleft5 trashbtn"><a class="btn trash" title="Trash"><span class="icon-trash"></span></a></li>-->
                    <li class="marginleft15 filesearch">
                        <form>
                            <input type="text" id="filekeyword" class="filekeyword" name="filename" placeholder="Search File" value="<?php echo (isset($_GET['filename'])) ? clean_str($_GET['filename']) : ''; ?>" />
                        </form>
                    </li>

                    <?php if ($this->user_access->add) {
                        
                       // if (date('w', strtotime(date('w'))) == 6 || date('w', strtotime(date('w'))) == 0) { ?>
                            <!-- echo 'today on a weekend'; -->
                            <!-- <li class="right newfilebtn"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalLong">Upload File</button></li> -->

                            <?php //} else {
                            // echo 'today is on a weekday'; 
                            //if (date('H') < 15 && date('H') > 9) { ?>

                                <li class="right newfilebtn"><a href="<?php echo site_url('auctions_doc'); ?>" class="btn btn-primary">Upload File</a></li>
                            <?php //} else { ?>

                                <!-- <li class="right newfilebtn"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalLong">Upload File</button></li> -->

                    <?php }
                        //}
                    // } ?>



                </ul>
                <span class="clearall"></span>
            </div>
            <!--mediamgr_head-->

            <div class="mediamgr_category">
                <ul id="mediafilter">
                    <li class="current"><a href="all">All</a></li>
                    <?php foreach ($this->types as $key => $type) { ?>
                        <?php if ($key != '0') { ?>
                            <li><a href="type-<?php echo $key; ?>"><?php echo $type; ?></a></li>
                        <?php } ?>
                    <?php } ?>
                    <li class="right"><span class="pagenuminfo">Tampil <?php echo $offset; ?> - <?php echo $offset - 1 + count($documents); ?> dari <?php echo $count_documents; ?></span></li>
                </ul>
            </div>
            <!--mediamgr_category-->
            <div class="mediamgr_content">

                <ul id="medialist" class="listfile">
                    <?php foreach ($documents as $document) { ?>
                        <?php if (empty($document->sub_content_type)) { ?>
                            <li>
                            <?php } else { ?>
                            <li class="type-<?php echo $document->sub_content_type; ?>">
                            <?php } ?>
                            <a href="<?php echo site_url('admin/lelangdoc/show/' . $document->id); ?>"><img src="<?php echo site_url('assets/images/thumbs/doc.png'); ?>" alt="" width="125" /></a>
                            <span class="filename"><?php echo $document->title; ?></span>
                            <span class="filename">by</span>
                            <span class="filename"><?php echo $document->fullname; ?></span>
                            </li>
                        <?php } ?>
                </ul>

                <br class="clearall" />

            </div>
            <!--mediamgr_content-->

        </div>
        <!--mediamgr_left -->
</div>
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Upload file available on weekdays ( 9 am- 15 pm)
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php echo form_open_multipart('admin/lelangdoc/destroy', array('class'=>'stdform', 'id' => 'f_delete_doc')); ?>
<input type="hidden" name="document_id" id="document_id">
<?php echo form_close(); ?> 

<?php echo form_open_multipart('admin/lelangdoc/destroy_form', array('class'=>'stdform', 'id' => 'f_delete_form')); ?>
<input type="hidden" name="document_id" id="form_document_id">
<?php echo form_close(); ?> 

<script>
    function deleteDoc(id){
        if(confirm('Apakah anda yakin akan menghapus dokumen ini?')){
            jQuery('#document_id').val(id);
            jQuery('#f_delete_doc').submit();
        }
    }

    function deleteForm(id){
        if(confirm('Apakah anda yakin akan menghapus dokumen ini?')){
            jQuery('#form_document_id').val(id);
            jQuery('#f_delete_form').submit();
        }
    }
</script>