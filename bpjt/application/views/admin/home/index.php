<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()
);
?>
<div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo animate0 bounceIn"><img src="<?php echo base_url(); ?>assets/images/logo-bpjt-medium.png" alt="" /></div>
         <?php echo form_open('admin/home/processing', array('id'=>'login')); ?>
            
            <?php if (!empty($flash)) { ?> -->
                <div class="alert alert-error">Invalid username or password</div>
            <?php } ?>
            <div class="inputwrapper animate1 bounceIn">
                <input type="text" name="username" id="username" placeholder="Nama Pengguna" />
            </div>
            <div class="inputwrapper animate2 bounceIn">
                <input type="password" name="password" id="password" placeholder="Kata Kunci" />
            </div>
            <div class="inputwrapper animate3 bounceIn">
                <button name="submit">Masuk</button>
            </div>
            <!-- <div class="inputwrapper animate4 bounceIn">
                <label><input type="checkbox" class="remember" name="signin" /> Keep me sign in</label>
            </div> -->
        <!-- <?php echo form_close(); ?> -->
    </div><!--loginpanelinner-->
</div><!--loginpanel-->