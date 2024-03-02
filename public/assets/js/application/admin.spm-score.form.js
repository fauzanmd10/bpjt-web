jQuery(document).ready(function() {
	var $tree = jQuery("#klasifikasi"),
	$class_node = jQuery("#spm-classification-id"),
    $class_input_label = jQuery("#spm-classification-label"),
	$class_label_node = jQuery("#classification-label");

    $tree.tree().bind('tree.select', function(event) {
    	var node = event.node;
    	if (node.children.length == 0) {
    		$class_node.val(node.id);
            $class_input_label.val(node.name);
    		$class_label_node.text(node.name);
    	}
    });
});