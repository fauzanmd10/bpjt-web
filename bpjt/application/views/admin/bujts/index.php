<?php if (!empty($flash)) { ?>
<div class="alert alert-success">
    Status terbit sudah diubah.
</div>
<?php } ?>

<ul class="list-nostyle list-inline">
    <li><a href="#" class="btn" id="btn-show"> <i class="icon-list-alt"></i> &nbsp; Lihat</a> </li>
    <?php if ($this->user_access->add) { ?>
    <li><a href="<?php echo site_url('admin/bujts/add'); ?>" class="btn"> <i class="icon-plus"></i> &nbsp; Tambah</a> </li>
    <?php } ?>

    <?php if ($this->user_access->edit) { ?>
    <li><a href="#" id="btn-edit" class="btn"> <i class="icon-edit"></i> &nbsp; Edit</a> </li>
    <?php } ?>

    <?php if ($this->user_access->destroy) { ?>
    <a class="btn confirmbutton" id="btn-delete">
        <i class="icon-trash"></i> &nbsp; <small>Hapus</small>
    </a> &nbsp;
    <?php } ?>
    <input type="hidden" id="token-name" value="<?php echo $this->security->get_csrf_hash(); ?>" />
</ul>

<table id="dyntable" class="table table-bordered responsive">
    <colgroup>
        <col class="con0" style="align: center; width: 4%" />
        <col class="con1" />
        <col class="con0" />
        <col class="con1" />
        <col class="con0" />
        <col class="con1" />
        <col class="con0" />
    </colgroup>
    <thead>
        <tr>
            <th class="head0 nosort"><input type="checkbox" id="checkall" /></th>
            <th class="head0">No.</th>
            <th class="head1">Nama</th>
            <th class="head0">Status</th>
            <th class="head1">Tanggal Input</th>
            <th class="head0">Tanggal Update</th>
        </tr>
    </thead>
    <tbody>
        <!-- Data generated via AJAX -->
    </tbody>
</table>

<br /><br />