<?php

/* 
 * Copyright (C) 2015 sunyata
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */





/*
 * Code generated with
 * http://wpsettingsapi.jeroensormani.com/
 * Please note: Because of a bug in the generator we need to change the name of
 * the options_page function or of the last argument used for the
 * add_options_page function call
 * 
 * Info on the wp settings api:
 * http://codex.wordpress.org/Settings_API
 */


add_action( 'admin_menu', 'ea_add_admin_menu' );
add_action( 'admin_init', 'ea_settings_init' );


function ea_add_admin_menu(  ) { 

	add_options_page( 'Empathy App', 'Empathy App', 'manage_options', 'empathy_app', 'ea_options_page' );
        

}


function ea_settings_init(  ) { 

	register_setting( 'pluginPage', 'ea_settings' );

	add_settings_section(
		'ea_pluginPage_section', 
		__( 'Your section description', 'wordpress' ), 
		'ea_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'ea_text_field_0', 
		__( 'Settings field description', 'wordpress' ), 
		'ea_text_field_0_render', 
		'pluginPage', 
		'ea_pluginPage_section' 
	);


}


function ea_text_field_0_render(  ) { 

	$options = get_option( 'ea_settings' );
	?>
	<input type='text' name='ea_settings[ea_text_field_0]' value='<?php echo $options['ea_text_field_0']; ?>'>
	<?php

}


function ea_settings_section_callback(  ) { 

	echo __( 'This section description', 'wordpress' );

}


function ea_options_page(  ) { 

	?>
	<form action='options.php' method='post'>
		
		<h2>Empathy App</h2>
		
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
		
	</form>
	<?php

}

