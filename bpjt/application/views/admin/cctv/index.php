<?php if (!empty($flash)) { ?>
<div class="alert alert-success">
    Status terbit sudah diubah.
</div>
<?php } ?>

<ul class="list-nostyle list-inline">
    <li><a href="#" class="btn" id="btn-show"> <i class="icon-list-alt"></i> &nbsp; Lihat</a> </li>

    <?php if ($this->user_access->add) { ?>
    <li><a href="<?php echo site_url('admin/cctv/add'); ?>" class="btn"> <i class="icon-plus"></i> &nbsp; Tambah</a> </li>
    <?php } ?>

    <?php if ($this->user_access->edit) { ?>
    <li><a href="#" id="btn-edit" class="btn"> <i class="icon-edit"></i> &nbsp; Edit</a> </li>
    <?php } ?>

    <?php if ($this->user_access->edit) { ?>
    <a class="btn confirmbutton_edit" id="btn-sort-edit">
        <i class="fa fa-align-center"></i> &nbsp; <small>Edit Urutan</small>
    </a> &nbsp;
    <?php } ?>

    <?php if ($this->user_access->destroy) { ?>
    <a class="btn confirmbutton" id="btn-delete">
        <i class="icon-trash"></i> &nbsp; <small>Hapus</small>
    </a> &nbsp;
    <?php } ?>

    <input type="hidden" id="token-name" value="<?php echo $this->security->get_csrf_token_name(); ?>" />
    <input type="hidden" id="token-value" value="<?php echo $this->security->get_csrf_hash(); ?>" />

</ul>

<table id="dyntable" class="table table-bordered responsive">
    <colgroup>
        <col class="con0" style="width: 4%" />
        <col class="con1" style="width: 4%"/>
        <col class="con1" style="width: 4%"/>
        <col class="con0" style="width: 15%"/>
        <col class="con1" style="width: 15%" />
        <col class="con0"/>
        <col class="con1"/>
        <col class="con0" style="width: 4%" />
        <col class="con1" style="width: 6%" />
    </colgroup>
    <thead>
        <tr>
            <th class="head0 nosort"><input type="checkbox" id="checkall" /></th>
            <th class="head0">No.</th>
            <th class="head0">ID Ruas</th>
            <th class="head1">Nama Ruas</th>
            <th class="head0">Nama CCTV</th>
            <th class="head1">Nama BUJT</th>
            <th class="head1">Urutan</th>
            <th class="head0">Stream URL</th>
            <th class="head1">Protocol</th>
            <th class="head1">Status</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data generated via AJAX -->
    </tbody>
</table>

<br /><br />