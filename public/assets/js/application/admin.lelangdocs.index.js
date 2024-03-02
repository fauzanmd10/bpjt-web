jQuery(document).ready(function(){
    
    //Replaces data-rel attribute to rel.
    //We use data-rel because of w3c validation issue
    jQuery('a[data-rel]').each(function() {
        jQuery(this).attr('rel', jQuery(this).data('rel'));
    });
    
    jQuery("#medialist a").colorbox();
    
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