<h1>Form</h1>
<form method="post" accept-charset="utf-8" action="<?=base_url().'index.php/admin/home/processing'?>">
	                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">

<label for="nama">User : </label>
<input type="text" name="name" id="name">
<br>
<label for="majors">PAssword : </label>
<input type="text" name="majors" id="majors">
<br><br>
<input type="submit" name="submit" value="Submit Post!"  />
</form>