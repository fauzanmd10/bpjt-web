<?php if (!empty($flash)) { ?>
<div class="alert alert-success">
    Status User sudah diubah.
</div>
<?php } ?>
<?php if (!empty($this->session->flashdata('notif'))) { ?>
    <div class="alert alert-success">
    Status User sudah diubah.
</div>
<div class="alert alert-danger">
    <?php echo $this->session->flashdata('notif');?>
</div>
<?php } ?>

<ul class="list-nostyle list-inline">
    <li><a href="#" class="btn" id="btn-show"> <i class="icon-list-alt"></i> &nbsp; Lihat</a> </li>
    <!-- <?php //if ($this->user_access->add) { ?>
    <li><a href="<?php //echo site_url('admin/lelangs/add'); ?>" class="btn"> <i class="icon-plus"></i> &nbsp; Tambah</a> </li>
    <?php //} ?> -->

    <!-- <?php //if ($this->user_access->edit) { ?>
    <li><a href="#" id="btn-edit" class="btn"> <i class="icon-edit"></i> &nbsp; Edit</a> </li>
    <?php //} ?>-->

    <?php if ($this->user_access->destroy) { ?>
    <a class="btn confirmbutton" id="btn-delete">
        <i class="icon-trash"></i> &nbsp; <small>Hapus</small>
    </a> &nbsp;
    <?php } ?> 
    <input type="hidden" id="token-name" value="<?php echo $this->security->get_csrf_token_name(); ?>" />
    <input type="hidden" id="token-value" value="<?php echo $this->security->get_csrf_hash(); ?>" />
    <input type="hidden" id="id_ruas" value="<?php echo $this->input->get('id_ruas')?>">
        
    <?php if (false && $this->user_access->destroy) { ?>
    <div class="pull-right">
        <select class="form-control" id="filter_ruas">
            <option value="">Semua Ruas</option>
            <?php
            if($ruas_list){
                $id_ruas = $this->input->get('id_ruas');
                foreach($ruas_list as $ruas){
                    echo '<option value="'. $ruas->id .'" '. ($id_ruas == $ruas->id ? 'selected' : '') .'>'. $ruas->name .'</option>';
                }
            }
            ?>
        </select>
    </div>
    <?php } ?> 

</ul>

<table id="dyntable" class="table table-bordered responsive">
    <colgroup>
        <col class="con0" style="width: 4%" />
        <col class="con1" style="width: 4%"/>
        <col class="con0" />
        <col class="con0" />
        <col class="con1"/>
        <col class="con0" />
        <col class="con1"/>
        <col class="con0"/>
    </colgroup>
    <thead>
        <tr>
            <th class="head0 nosort"><input type="checkbox" id="checkall" /></th>
            <th class="head0">No.</th>
            <th class="head1">Lelang Jalan Tol</th>
            <th class="head1">Nama Perusahaan</th>
            <th class="head1">Nama Direktur Utama</th>
            <th class="head1">Nama Kontak</th>
            <th class="head1">Aktif</th>
            <th class="head0">Tanggal Input</th>
            <!-- <th class="head1">Tanggal Update</th> -->
        </tr>
    </thead>
    <tbody>
        <!-- Data generated via AJAX -->
    </tbody>
</table>

<br /><br />