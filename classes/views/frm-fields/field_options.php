<?php
if ( $display['options'] ) { ?>
    <div class="widget">
        <div class="widget-top">
    	    <div class="widget-title-action"><a href="javascript:void(0);" class="widget-action"></a></div>
    		<div class="widget-title"><h4><?php _e( 'Field Options', 'formidable' ) ?> (ID <?php echo (int) $field['id'] ?>)</h4></div>
        </div>
    	<div class="widget-inside">
            <table class="form-table frm_clear_none">
                <?php $field_types = FrmFieldsHelper::get_field_types($field['type']); ?>
				<tr><td class="frm_150_width"><label><?php _e( 'Field Type', 'formidable' ) ?></label></td>
                    <td>
                <select <?php if ( count($field_types) == 1 ) { ?>disabled="disabled"<?php } else { ?>name="field_options[type_<?php echo esc_attr( $field['id'] ) ?>]"<?php } ?>>
                    <?php
					foreach ( $field_types as $fkey => $ftype ) { ?>
                        <option value="<?php echo esc_attr( $fkey ) ?>" <?php echo ( $fkey == $field['type'] ) ? ' selected="selected"' : ''; ?> <?php echo array_key_exists($fkey, $disabled_fields ) ? 'disabled="disabled"' : '';  ?>><?php echo is_array($ftype) ? $ftype['name'] : $ftype ?> </option>
                    <?php
						unset( $fkey, $ftype );
					} ?>
                </select>

                <?php
				if ( $display['required'] ) { ?>
                    <label for="frm_req_field_<?php echo esc_attr( $field['id'] ) ?>" class="frm_inline_label"><input type="checkbox" id="frm_req_field_<?php echo esc_attr( $field['id'] ) ?>" class="frm_req_field" name="field_options[required_<?php echo esc_attr( $field['id'] ) ?>]" value="1" <?php echo $field['required'] ? 'checked="checked"': ''; ?> /> <?php _e( 'Required', 'formidable' ) ?></label>
                <?php
                }

				if ( $display['unique'] ) {
                    if ( ! isset( $field['unique'] ) ) {
                        $field['unique'] = false;
                    }
                ?>
                <label for="frm_uniq_field_<?php echo esc_attr( $field['id'] ) ?>" class="frm_inline_label frm_help" title="<?php esc_attr_e( 'Unique: Do not allow the same response multiple times. For example, if one user enters \'Joe\' then no one else will be allowed to enter the same name.', 'formidable' ) ?>"><input type="checkbox" name="field_options[unique_<?php echo esc_attr( $field['id'] ) ?>]" id="frm_uniq_field_<?php echo esc_attr( $field['id'] ) ?>" value="1" <?php checked( $field['unique'], 1 ); ?> class="frm_mark_unique" /> <?php _e( 'Unique', 'formidable' ) ?></label>
                <?php
                }

				if ( $display['read_only'] ) {
                    if ( ! isset( $field['read_only'] ) ) {
                        $field['read_only'] = false;
					}
                ?>
                <label for="frm_read_only_field_<?php echo esc_attr( $field['id'] ) ?>" class="frm_inline_label frm_help" title="<?php esc_attr_e( 'Read Only: Show this field but do not allow the field value to be edited from the front-end.', 'formidable' ) ?>" ><input type="checkbox" id="frm_read_only_field_<?php echo esc_attr( $field['id'] ) ?>" name="field_options[read_only_<?php echo esc_attr( $field['id'] ) ?>]" value="1" <?php echo $field['read_only'] ? ' checked="checked"' : ''; ?>/> <?php _e( 'Read Only', 'formidable' ) ?></label>
                <?php }

                do_action('frm_field_options_form_top', $field, $display, $values);

                ?>
                <?php
				if ( $display['required'] ) { ?>
                <div class="frm_required_details<?php echo esc_attr( $field['id'] . ( $field['required'] ? '' : ' frm_hidden' ) ); ?>">
                    <span class="howto"><?php _e( 'Indicate required field with', 'formidable' ) ?></span>
                    <input type="text" name="field_options[required_indicator_<?php echo esc_attr( $field['id'] ) ?>]" value="<?php echo esc_attr( $field['required_indicator'] ); ?>" />
                </div>
                <?php } ?>
                    </td>
                </tr>
				<tr>
					<td class="frm_150_width">
						<div class="hide-if-no-js edit-slug-box frm_help" title="<?php esc_attr_e( 'The field key can be used as an alternative to the field ID in many cases.', 'formidable' ) ?>">
                            <?php _e( 'Field Key', 'formidable' ) ?>
					</td>
					<td>
						<input type="text" name="field_options[field_key_<?php echo esc_attr( $field['id'] ) ?>]" value="<?php echo esc_attr( $field['field_key'] ); ?>" />
					</td>
				</tr>

                <?php
				if ( $display['css'] ) { ?>
                <tr><td><label><?php _e( 'CSS layout classes', 'formidable' ) ?></label>
					<span class="frm_help frm_icon_font frm_tooltip_icon" title="<?php esc_attr_e( 'Add a CSS class to the field container. Use our predefined classes to align multiple fields in single row.', 'formidable' ) ?>" ></span>
                    </td>
                    <td><input type="text" name="field_options[classes_<?php echo esc_attr( $field['id'] ) ?>]" value="<?php echo esc_attr( $field['classes'] ) ?>" id="frm_classes_<?php echo esc_attr( $field['id'] ) ?>" class="frm_classes frm_long_input" />
                    </td>
                </tr>
                <?php
				}

				if ( $display['label_position'] ) { ?>
                    <tr><td class="frm_150_width"><label><?php _e( 'Label Position', 'formidable' ) ?></label></td>
                        <td><select name="field_options[label_<?php echo esc_attr( $field['id'] ) ?>]">
                            <option value=""<?php selected($field['label'], ''); ?>><?php _e( 'Default', 'formidable' ) ?></option>
                            <option value="top"<?php selected($field['label'], 'top'); ?>><?php _e( 'Top', 'formidable' ) ?></option>
                            <option value="left"<?php selected($field['label'], 'left'); ?>><?php _e( 'Left', 'formidable' ) ?></option>
                            <option value="right"<?php selected($field['label'], 'right'); ?>><?php _e( 'Right', 'formidable' ) ?></option>
                            <option value="inline"<?php selected($field['label'], 'inline'); ?>><?php _e( 'Inline (left without a set width)', 'formidable' ) ?></option>
                            <option value="none"<?php selected($field['label'], 'none'); ?>><?php _e( 'None', 'formidable' ) ?></option>
                            <option value="hidden"<?php selected($field['label'], 'hidden'); ?>><?php _e( 'Hidden (but leave the space)', 'formidable' ) ?></option>
                        </select>
                        </td>
                    </tr>
                <?php } ?>
				<?php if ( $display['size'] ) { ?>
                    <tr><td class="frm_150_width"><label><?php _e( 'Field Size', 'formidable' ) ?></label></td>
                        <td>
                        <?php
						if ( in_array( $field['type'], array( 'select', 'time', 'data' ) ) ) {
							if ( ! isset( $values['custom_style'] ) || $values['custom_style'] ) { ?>
								<label for="size_<?php echo esc_attr( $field['id'] ) ?>">
									<input type="checkbox" name="field_options[size_<?php echo esc_attr( $field['id'] ) ?>]" id="size_<?php echo esc_attr( $field['id'] ) ?>" value="1" <?php echo FrmField::is_option_true( $field, 'size' ) ? 'checked="checked"' : ''; ?> />
									<?php _e( 'automatic width', 'formidable' ) ?>
								</label>
                            <?php
                            }
						} else { ?>
                                <input type="text" name="field_options[size_<?php echo esc_attr( $field['id'] ) ?>]" value="<?php echo esc_attr( $field['size'] ); ?>" size="5" /> <span class="howto"><?php _e( 'pixels wide', 'formidable' ) ?></span>

								<?php if ( $display['max'] ) { ?>
                                <input type="text" name="field_options[max_<?php echo esc_attr( $field['id'] ) ?>]" value="<?php echo esc_attr( $field['max'] ); ?>" size="5" /> <span class="howto"><?php echo ( $field['type'] == 'textarea' || $field['type'] == 'rte' ) ? __( 'rows high', 'formidable' ) : __( 'characters maximum', 'formidable' ) ?></span>
                        <?php	}
                        } ?>
                        </td>
                    </tr>
                <?php } ?>

				<?php if ( $field['type'] == 'number' && $frm_settings->use_html ) { ?>
					<tr>
						<td>
							<label><?php _e( 'Number Range', 'formidable' ) ?>
								<span class="frm_help frm_icon_font frm_tooltip_icon" title="<?php esc_attr_e( 'Browsers that support the HTML5 number field require a number range to determine the numbers seen when clicking the arrows next to the field.', 'formidable' ) ?>" ></span>
							</label>
						</td>
						<td><input type="text" name="field_options[minnum_<?php echo $field['id'] ?>]" value="<?php echo esc_attr($field['minnum']); ?>" size="7" /> <span class="howto"><?php echo _e( 'minimum', 'formidable' ) ?></span>
							<input type="text" name="field_options[maxnum_<?php echo $field['id'] ?>]" value="<?php echo esc_attr($field['maxnum']); ?>" size="7" /> <span class="howto"><?php _e( 'maximum', 'formidable' ) ?></span>
							<input type="text" name="field_options[step_<?php echo $field['id'] ?>]" value="<?php echo esc_attr($field['step']); ?>" size="7" /> <span class="howto"><?php _e( 'step', 'formidable' ) ?></span></td>
						</tr>
				<?php } else if ( $field['type'] == 'phone' ) { ?>
					<tr>
						<td><label><?php _e( 'Format', 'formidable' ) ?></label>
							<span class="frm_help frm_icon_font frm_tooltip_icon" title="<?php esc_attr_e( 'Insert the format you would like to accept. Use a regular expression starting with ^ or an exact format like (999)999-9999.', 'formidable' ) ?>" ></span>
						</td>
						<td><input type="text" class="frm_long_input" value="<?php echo esc_attr( $field['format'] ) ?>" name="field_options[format_<?php echo esc_attr( $field['id'] ) ?>]" />
						</td>
					</tr>
				<?php } else if ( $field['type'] == 'date' ) { ?>
					<tr><td><label><?php _e( 'Calendar Localization', 'formidable' ) ?></label></td>
						<td>
							<select name="field_options[locale_<?php echo esc_attr( $field['id'] ) ?>]">
								<?php foreach ( $locales as $locale_key => $locale ) {
									$selected = ( isset( $field['locale'] ) && $field['locale'] == $locale_key ) ? ' selected="selected"' : ''; ?>
									<option value="<?php echo esc_attr( $locale_key ) ?>"<?php echo $selected; ?>><?php echo esc_html( $locale ) ?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label><?php _e( 'Year Range', 'formidable' ) ?></label>
								<span class="frm_help frm_icon_font frm_tooltip_icon" title="<?php esc_attr_e( 'Use four digit years or +/- years to make it dynamic. For example, use -5 for the start year and +5 for the end year.', 'formidable' ) ?>" ></span>
							</td>
							<td>
								<span><?php _e( 'Start Year', 'formidable' ) ?></span>
								<input type="text" name="field_options[start_year_<?php echo esc_attr( $field['id'] ) ?>]" value="<?php echo esc_attr( isset( $field['start_year'] ) ? $field['start_year'] : '' ); ?>" size="4" />

								<span><?php _e( 'End Year', 'formidable' ) ?></span>
								<input type="text" name="field_options[end_year_<?php echo esc_attr( $field['id'] ) ?>]" value="<?php echo esc_attr( isset( $field['end_year'] ) ? $field['end_year'] : '' ); ?>" size="4" />
							</td>
						</tr>
				<?php } else if ( $field['type'] == 'time' ) { ?>
					<tr><td><label><?php _e( 'Clock Settings', 'formidable' ) ?></label></td>
						<td>
							<select name="field_options[clock_<?php echo esc_attr( $field['id'] ) ?>]">
								<option value="12" <?php selected( $field['clock'], 12 ) ?>>12</option>
								<option value="24" <?php selected( $field['clock'], 24 ) ?>>24</option>
							</select>
							<span class="howto" style="padding-right:10px;"><?php _e( 'hour clock', 'formidable' ) ?></span>

							<input type="text" name="field_options[step_<?php echo esc_attr( $field['id'] ) ?>]" value="<?php echo esc_attr( $field['step'] ); ?>" size="3" />
							<span class="howto" style="padding-right:10px;"><?php _e( 'minute step', 'formidable' ) ?></span>

							<input type="text" name="field_options[start_time_<?php echo esc_attr( $field['id'] ) ?>]" id="start_time_<?php echo esc_attr( $field['id'] ) ?>" value="<?php echo esc_attr( $field['start_time'] ) ?>" size="5" />
							<span class="howto" style="padding-right:10px;"><?php _e( 'start time', 'formidable' ) ?></span>

							<input type="text" name="field_options[end_time_<?php echo esc_attr( $field['id'] ) ?>]" id="end_time_<?php echo esc_attr( $field['id'] ) ?>" value="<?php echo esc_attr( $field['end_time'] ) ?>" size="5" />
							<span class="howto"><?php _e( 'end time', 'formidable' ) ?></span>
						</td>
					</tr>
				<?php } else if ( $field['type'] == 'html' ) { ?>
					<tr><td colspan="2"><?php _e( 'Content', 'formidable' ) ?><br/>
						<textarea name="field_options[description_<?php echo esc_attr( $field['id'] ) ?>]" class="long-text" rows="8"><?php
							if ( FrmField::is_option_true( $field, 'stop_filter' ) ) {
								echo $field['description'];
							} else{
								echo FrmAppHelper::esc_textarea( $field['description'] );
							}
							?></textarea>
						</td>
					</tr>
				<?php } ?>

                <?php do_action('frm_field_options_form', $field, $display, $values);

                if ( $display['required'] || $display['invalid'] || $display['unique'] || $display['conf_field'] ) { ?>
					<tr class="frm_validation_msg <?php echo ($display['invalid'] || $field['required'] || FrmField::is_option_true( $field, 'unique' ) || FrmField::is_option_true( $field, 'conf_field' ) ) ? '' : 'frm_hidden'; ?>">
					<td colspan="2">
                    <div class="menu-settings">
                    <h3 class="frm_no_bg"><?php _e( 'Validation', 'formidable' ) ?></h3>

                    <div class="frm_validation_box">
                        <?php
						if ( $display['required'] ) { ?>
                        <p class="frm_required_details<?php echo esc_attr( $field['id'] . ( $field['required'] ? '' : ' frm_hidden' ) ); ?>"><label><?php _e( 'Required', 'formidable' ) ?></label>
                            <input type="text" name="field_options[blank_<?php echo esc_attr( $field['id'] ) ?>]" value="<?php echo esc_attr( $field['blank'] ); ?>" />
                        </p>
                        <?php
                        }

						if ( $display['invalid'] ) { ?>
                            <p><label><?php _e( 'Invalid Format', 'formidable' ) ?></label>
                                <input type="text" name="field_options[invalid_<?php echo esc_attr( $field['id'] ) ?>]" value="<?php echo esc_attr( $field['invalid'] ); ?>" />
                            </p>
                        <?php
						}

						if ( $display['unique'] ) { ?>
                        <p class="frm_unique_details<?php echo esc_attr( $field['id'] . ( $field['unique'] ? '' : ' frm_hidden' ) ); ?>">
                            <label><?php _e( 'Unique', 'formidable' ) ?></label>
                            <input type="text" name="field_options[unique_msg_<?php echo esc_attr( $field['id'] ) ?>]" value="<?php echo esc_attr( $field['unique_msg'] ); ?>" />
                        </p>
                        <?php
                        }

						if ( $display['conf_field'] ) { ?>
                        <p class="frm_conf_details<?php echo esc_attr( $field['id'] . ( $field['conf_field'] ? '' : ' frm_hidden' ) ); ?>">
                            <label><?php _e( 'Confirmation', 'formidable' ) ?></label>
                            <input type="text" name="field_options[conf_msg_<?php echo esc_attr( $field['id'] ) ?>]" value="<?php echo esc_attr( $field['conf_msg'] ); ?>" />
                        </p>
                        <?php
                        } ?>
                    </div>
                    </div>
                    </td>
                    </tr>
                <?php } ?>

            </table>
        </div>
    </div>
<?php }
