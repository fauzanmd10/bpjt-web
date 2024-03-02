jQuery(document).ready(function(){
    jQuery('#login').submit(function(){
        var u = jQuery('#username').val();
        var p = jQuery('#password').val();
        if(u == '' && p == '') {
            jQuery('.login-alert').fadeIn();
            return false;
        }
    });
});