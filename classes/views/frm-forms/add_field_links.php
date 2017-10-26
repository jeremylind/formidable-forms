<div id="postbox-container-1" class="postbox-container frm-right-panel">
<div class="frm-fixed-panel">
	<div class="frm-ltr">
<?php
$action = isset( $_REQUEST['frm_action'] ) ? 'frm_action' : 'action';
$action = FrmAppHelper::get_param( $action, '', 'get', 'sanitize_title' );
$button = ( $action == 'new' || $action == 'duplicate' ) ? __( 'Create', 'formidable' ) : __( 'Update', 'formidable' );

include( FrmAppHelper::plugin_path() . '/classes/views/frm-forms/_publish_box.php' );
?>

    <div class="postbox frm_field_list">
    <div class="inside">
    <div id="taxonomy-linkcategory" class="categorydiv">
        <ul id="category-tabs" class="category-tabs frm-category-tabs">
    		<li class="tabs"><a href="#frm-insert-fields" id="frm_insert_fields_tab"><?php _e( 'Fields', 'formidable' ); ?></a></li>
    		<li class="hide-if-no-js"><a href="#frm-layout-classes" id="frm_layout_classes_tab" class="frm_help" title="<?php esc_attr_e( 'Open the Field Options and click on the CSS Layout Classes option to enable this tab', 'formidable' ) ?>"><?php _e( 'Layout', 'formidable' ); ?></a></li>
<?php do_action('frm_extra_form_instruction_tabs'); ?>
    	</ul>

    	<div id="frm-insert-fields" class="tabs-panel">
		    <ul class="field_type_list">
<?php
foreach ( $frm_field_selection as $field_key => $field_type ) { ?>
				<li class="frmbutton <?php echo esc_attr( ' frm_t' . $field_key ) ?>" id="<?php echo esc_attr( $field_key ) ?>">
					<a href="#" class="frm_add_field frm_animate_bg">
						<i class="dashicons dashicons-editor-paragraph frm_animate_bg"></i>
						<span><?php echo esc_html( $field_type ) ?></span>
					</a>
				</li>
<?php
	unset( $field_key, $field_type );
} ?>
            </ul>
            <div class="clear"></div>
			<?php FrmTipsHelper::pro_tip( 'get_builder_tip' ); ?>
			<ul class="field_type_list">
<?php

$no_allow_class = apply_filters( 'frm_noallow_class', 'frm_noallow' );
foreach ( FrmField::pro_field_selection() as $field_key => $field_type ) {

	if ( is_array( $field_type ) ) {
		$field_label = $field_type['name'];

		if ( isset( $field_type['switch_from'] ) ) {
			continue;
		}

?>
				<li class="frmbutton <?php echo esc_attr( $no_allow_class . ' frm_t' . $field_key ) ?> dropdown" id="<?php echo esc_attr( $field_key ) ?>">
	                <a href="#" id="frm-<?php echo esc_attr( $field_key ) ?>Drop" class="frm-dropdown-toggle" data-toggle="dropdown">
						<i class="dashicons dashicons-editor-paragraph frm_animate_bg"></i>
						<span><?php echo esc_html( $field_label ) ?> <b class="caret"></b></span>
					</a>

                    <ul class="frm-dropdown-menu" role="menu" aria-labelledby="frm-<?php echo esc_attr( $field_key ) ?>Drop">
                	<?php
					foreach ( $field_type['types'] as $k => $type ) { ?>
						<li class="frm_t<?php echo esc_attr( $field_key ) ?>" id="<?php echo esc_attr( $field_key ) ?>|<?php echo esc_attr( $k ) ?>">
							<?php echo apply_filters( 'frmpro_field_links', $type, $id, $field_key . '|' . $k ) ?>
						</li>
                	<?php
						unset( $k, $type );
					} ?>
                	</ul>
                </li>
<?php
                } else {
                    $field_label = '<i class="dashicons dashicons-editor-paragraph frm_animate_bg"></i> <span>' . $field_type .'</span>';
                    ?>
					<li class="frmbutton <?php echo esc_attr( $no_allow_class . ' frm_t' . $field_key ) ?>" id="<?php echo esc_attr( $field_key ) ?>">
						<?php echo apply_filters( 'frmpro_field_links', $field_label, $id, $field_key ) ?>
					</li>
                    <?php
                }

                unset($field_key, $field_type, $field_label);
            } ?>
            </ul>
            <div class="clear"></div>
        </div>
    	<?php do_action('frm_extra_form_instructions'); ?>

    	<div id="frm-layout-classes" class="tabs-panel">
			<ol class="howto">
				<li><?php _e( 'Click inside the "CSS layout classes" field option in any field.', 'formidable' ) ?></li>
				<li><?php _e( 'This box will activate and you can click to insert classes.', 'formidable' ) ?></li>
			</ol>
    	    <ul class="frm_code_list">
    	    <?php
			$classes = FrmFormsHelper::css_classes();
			$col = 'one';
			foreach ( $classes as $c => $d ) {
				$title = ( ! empty( $d ) && is_array( $d ) && isset( $d['title'] ) ) ? $d['title'] : '';
				?>
    	        <li class="frm_col_<?php echo esc_attr( $col ) ?>">
                    <a href="javascript:void(0);" class="frmbutton button frm_insert_code show_frm_classes<?php
	if ( ! empty( $title ) ) {
		echo ' frm_help';
	} ?>" data-code="<?php echo esc_attr($c) ?>" <?php
	if ( ! empty( $title ) ) {
		?>title="<?php echo esc_attr($title); ?>"<?php
	} ?>>
						<?php echo esc_html( FrmFormsHelper::style_class_label( $d, $c ) ); ?>
                    </a>
                </li>
<?php
	$col = ( $col == 'one' ) ? 'two' : 'one';
	unset( $c, $d );
}
?>
    	    </ul>
    	</div>
    </div>
	</div>

	<form method="post" id="frm_js_build_form">
		<input type="hidden" id="frm_compact_fields" name="frm_compact_fields" value="" />
		<button class="frm_submit_form frm_submit_<?php echo ( isset( $values['ajax_load'] ) && $values['ajax_load'] ) ? '': 'no_'; ?>ajax frm_hidden frm_button_submit" type="button" id="frm_submit_side" ><?php echo esc_html( $button ) ?></button>
	</form>

	</div>
	</div>
</div>
</div>
