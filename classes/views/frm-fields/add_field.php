<?php
if ( ! $ajax ) {
?>
<li id="frm_field_id_<?php echo esc_attr( $field['id'] ); ?>" class="<?php echo esc_attr( $li_classes ) ?>" data-fid="<?php echo esc_attr( $field['id'] ) ?>" data-formid="<?php echo ( 'divider' == $field['type'] ) ? esc_attr( $field['form_select'] ) : esc_attr( $field['form_id'] ); ?>">
<?php
}

if ( $field['type'] == 'divider' ) { ?>
<div class="divider_section_only">
<?php
}
?>

    <a href="javascript:void(0);" class="frm_bstooltip alignright frm-show-hover frm-move frm-hover-icon frm_icon_font frm_move_icon" title="<?php esc_attr_e( 'Move Field', 'formidable' ) ?>"> </a>
    <a href="#" class="frm_bstooltip alignright frm-show-hover frm-hover-icon frm_icon_font frm_delete_icon frm_delete_field" title="<?php esc_attr_e( 'Delete Field', 'formidable' ) ?>"> </a>
    <a href="#" class="frm_bstooltip alignright frm-show-hover frm-hover-icon frm_icon_font frm_duplicate_icon" title="<?php ( $field['type'] == 'divider' ) ? esc_attr_e( 'Duplicate Section', 'formidable' ) : esc_attr_e( 'Duplicate Field', 'formidable' ) ?>"> </a>
    <input type="hidden" name="frm_fields_submitted[]" value="<?php echo esc_attr($field['id']) ?>" />
    <?php do_action('frm_extra_field_actions', $field['id']); ?>
    <?php if ( $display['required'] ) { ?>
    <span id="require_field_<?php echo esc_attr( $field['id'] ); ?>">
		<a href="javascript:void(0);" class="frm_req_field frm_action_icon frm_required_icon frm_icon_font alignleft frm_required<?php echo (int) $field['required'] ?>" id="req_field_<?php echo esc_attr( $field['id'] ); ?>" title="Click to Mark as <?php echo FrmField::is_required( $field ) ? 'not ' : ''; ?>Required"></a>
    </span>
    <?php }

    ?>
    <label class="<?php echo ( $field['type'] == 'end_divider' ) ? '' : 'frm_ipe_field_label'; ?> frm_primary_label <?php echo ( $field['type'] == 'break' ) ? 'button': ''; ?>" id="field_label_<?php echo esc_attr( $field['id'] ); ?>"><?php echo ( $field['name'] == '' ) ? __( '(no label)', 'formidable' ) : force_balance_tags( $field['name'] ); ?></label>


<div id="field_<?php echo esc_attr( $field['id'] ) ?>_inner_container" class="frm_inner_field_container">
<div class="frm_form_fields" data-ftype="<?php echo esc_attr( $display['type'] ) ?>">
<?php

include( dirname( __FILE__ ) .'/show-build.php' );

if ( $display['clear_on_focus'] ) { ?>
    <span id="frm_clear_on_focus_<?php echo esc_attr( $field['id'] ) ?>" class="frm-show-click"><?php

    if ( $display['default_blank'] ) {
		FrmFieldsHelper::show_default_blank_js( $field['default_blank'] );
    }

	FrmFieldsHelper::show_onfocus_js( $field['clear_on_focus'] );
?>
    </span>
<?php

    do_action('frm_extra_field_display_options', $field);
}
?>
<div class="clear"></div>
</div>
<?php
if ( $display['description'] ) { ?>
    <div class="frm_ipe_field_desc description <?php echo ($field['description'] == '') ? 'frm-show-click' : '' ?>" id="field_description_<?php echo esc_attr( $field['id'] ); ?>"><?php echo ($field['description'] == '') ? __( '(Click to add description)', 'formidable' ) : force_balance_tags( $field['description'] ); ?></div>
    <input type="hidden" name="field_options[description_<?php echo esc_attr( $field['id'] ) ?>]" value="<?php echo esc_attr( $field['description'] ); ?>" />

<?php } ?>
</div> <?php //End field_x_inner_container div

if ( $display['conf_field'] ) { ?>
<div id="frm_conf_field_<?php echo esc_attr( $field['id'] ) ?>_container" class="frm_conf_field_container frm_form_fields frm_conf_details<?php echo esc_attr( $field['id'] . ( $field['conf_field'] ? '' : ' frm_hidden' ) ); ?>">
    <div id="frm_conf_field_<?php echo esc_attr( $field['id'] ) ?>_inner_container" class="frm_inner_conf_container">
		<div class="frm_form_fields">
			<input type="text" id="conf_field_<?php echo esc_attr( $field['field_key'] ) ?>" name="field_options[conf_input_<?php echo esc_attr( $field['id'] ) ?>]" value="<?php echo esc_attr( $field['conf_input'] ); ?>" <?php do_action('frm_field_input_html', $field) ?> />
		</div>
    	<div class="frm_ipe_field_conf_desc description <?php echo ($field['conf_desc'] == '') ? 'frm-show-click' : '' ?>"><?php echo ($field['conf_desc'] == '') ? __( '(Click to add description)', 'formidable' ) : force_balance_tags($field['conf_desc']); ?></div>
    	<input type="hidden" name="field_options[conf_desc_<?php echo esc_attr( $field['id'] ) ?>]" value="<?php echo esc_attr( $field['conf_desc'] ); ?>" />
</div>
	<?php if ( $display['clear_on_focus'] ) { ?>
        <div class="alignleft">
			<span id="frm_clear_on_focus_<?php echo esc_attr( $field['id'] ) ?>_conf" class="frm-show-click">
                <?php
                if ( $display['default_blank'] ) {
					FrmFieldsHelper::show_default_blank_js( $field['default_blank'] );
                }

				FrmFieldsHelper::show_onfocus_js( $field['clear_on_focus'] );
                ?>
            </span>
        </div>
    <?php } ?>
</div>
<div class="clear"></div>
<?php }

if ( in_array( $field['type'], array( 'select', 'radio', 'checkbox' ) ) ) { ?>
    <div class="frm-show-click frm_small_top_margin"><?php

    if ( isset($field['post_field']) && $field['post_field'] == 'post_category' ) {
        echo '<p class="howto">'. FrmFieldsHelper::get_term_link($field['taxonomy']) .'</p>';
	} else if ( ! isset( $field['post_field'] ) || ! in_array( $field['post_field'], array( 'post_category', 'post_status' ) ) ) {
?>
        <div id="frm_add_field_<?php echo esc_attr( $field['id'] ); ?>">
            <a href="javascript:void(0);" data-opttype="single" class="button frm_cb_button frm_add_opt"><?php _e( 'Add Option', 'formidable' ) ?></a>

            <?php
			if ( FrmAppHelper::pro_is_installed() ) { ?>
				<a href="javascript:void(0);" id="other_button_<?php echo esc_attr( $field['id'] ); ?>" data-opttype="other" data-ftype="<?php echo esc_attr( $field['type'] ) ?>" class="button frm_cb_button frm_add_opt<?php echo ( in_array( $field['type'], array( 'radio', 'select' ) ) && $field['other'] == true ? ' frm_hidden' : '' ); ?>"><?php _e( 'Add "Other"', 'formidable' ) ?></a>
                <input type="hidden" value="<?php echo esc_attr( $field['other'] ); ?>" id="other_input_<?php echo esc_attr( $field['id'] ); ?>" name="field_options[other_<?php echo esc_attr( $field['id'] ); ?>]">
            <?php
            }

            if ( ! isset($field['post_field']) || $field['post_field'] != 'post_category' ) { ?>
            <a href="<?php echo esc_url(admin_url('admin-ajax.php') .'?action=frm_import_choices&field_id='. $field['id'] .'&TB_iframe=1') ?>" title="<?php echo FrmAppHelper::truncate(esc_attr(strip_tags(str_replace('"', '&quot;', $field['name']))), 20) . ' '. __( 'Field Choices', 'formidable' ); ?>" class="thickbox frm_orange"><?php _e( 'Bulk Edit Options', 'formidable' ) ?></a>
            <?php } ?>
        </div>
<?php
    }
?>
    </div>
<?php
}

do_action('frm_before_field_options', $field);

include( dirname( __FILE__ ) . '/field_options.php' );

if ( $field['type'] == 'divider' ) { ?>
</div>
<div class="frm_no_section_fields">
	<p class="howto"><?php _e( 'Drag fields from your form or the sidebar into this section', 'formidable' ) ?></p>
</div>
<ul class="start_divider frm_sorting">
<?php
} else if ( $field['type'] == 'end_divider' ) { ?>
</ul>
<?php
}

if ( ! $ajax && $field['type'] != 'divider' ) { ?>
</li>
<?php
}
