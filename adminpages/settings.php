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


function ea_add_admin_menu(  ) { 
	add_options_page( 'Empathy App', 'Empathy App', 'manage_options', 'empathy_app', 'ea_options_page' );
}
add_action( 'admin_menu', 'ea_add_admin_menu' );

function ea_settings_init(  ) { 
	register_setting( 'pluginPage', 'ea_settings' );
        
      	add_settings_section(
		'ea_pluginPage_donation_values_section', 
		__( 'Donation values', 'wordpress' ), 
		'ea_settings_donation_values_section_callback', 
		'pluginPage'
	);
	add_settings_field( 
		'donation_multiplier', 
		__( 'Multiplier', 'wordpress' ), 
		'ea_text_field_donation_multiplier_render', 
		'pluginPage', 
		'ea_pluginPage_donation_values_section' 
	);
	add_settings_field( 
		'max_donation', 
		__( 'Max Donation', 'wordpress' ), 
		'ea_text_field_max_donation_render', 
		'pluginPage', 
		'ea_pluginPage_donation_values_section' 
	);
        
        add_settings_section(
		'ea_pluginPage_stripe_keys_section', 
		__( 'Stripe keys', 'wordpress' ), 
		'ea_settings_stripe_keys_section_callback', 
		'pluginPage'
	);
	add_settings_field( 
		'private_stripe_key', 
		__( 'Private key', 'wordpress' ), 
		'ea_text_field_private_stripe_key_render', 
		'pluginPage', 
		'ea_pluginPage_stripe_keys_section' 
	);
        add_settings_field( 
		'shared_stripe_key', 
		__( 'Shared (public) key', 'wordpress' ), 
		'ea_text_field_shared_stripe_key_render', 
		'pluginPage', 
		'ea_pluginPage_stripe_keys_section' 
	);
}
add_action( 'admin_init', 'ea_settings_init' );

function ea_text_field_donation_multiplier_render(  ) { 
        $tDonationMultiplier = get_donation_multiplier();
	?>
	<input type='text' name='ea_settings[ea_text_field_donation_multiplier]'
               value='<?php echo $tDonationMultiplier; ?>'>
	<?php
}
function ea_text_field_max_donation_render(  ) { 
        $tMaxDonation = get_max_donation();
	?>
	<input type='text' name='ea_settings[ea_text_field_max_donation]'
               value='<?php echo $tMaxDonation; ?>'>
	<?php
}

function ea_text_field_private_stripe_key_render(  ) { 
        $tPrivateStripeKey = get_private_stripe_key();
	?>
	<input type='text' name='ea_settings[ea_text_field_private_stripe_key]'
               value='<?php echo $tPrivateStripeKey; ?>'>
	<?php
}
function ea_text_field_shared_stripe_key_render(  ) { 
        $tSharedStripeKey = get_shared_stripe_key();
	?>
	<input type='text' name='ea_settings[ea_text_field_shared_stripe_key]'
               value='<?php echo $tSharedStripeKey; ?>'>
	<?php
}

function get_donation_multiplier(){
    $tOptions = get_option('ea_settings');
    $rDonationMultiplier = $tOptions['ea_text_field_donation_multiplier'];
    if(!isset($rDonationMultiplier) || $rDonationMultiplier == Constants::empty_string){
        $rDonationMultiplier = stripe_donation::default_amount;
    }
    return $rDonationMultiplier;
}
function get_max_donation(){
    $tOptions = get_option('ea_settings');
    $rMaxDonation = $tOptions['ea_text_field_max_donation'];
    //-We get a NOTICE when having turned on WP_DEBUG which seems to not be a real issue:
    //https://wordpress.org/support/topic/notice-undefined-index-errors-fill-all-slider-settings-fields

    if(!isset($rMaxDonation) || $rMaxDonation == Constants::empty_string){
        $rMaxDonation = stripe_donation::default_max_amount;
    }
    return $rMaxDonation;
}

function get_private_stripe_key(){
    $tOptions = get_option('ea_settings');
    $rPrivateKey = $tOptions['ea_text_field_private_stripe_key'];
    if(!isset($rPrivateKey) || $rPrivateKey == Constants::empty_string){
        $rPrivateKey = stripe_donation::private_test_key;
    }
    return $rPrivateKey;
}
function get_shared_stripe_key(){
    $tOptions = get_option('ea_settings');
    $rSharedKey = $tOptions['ea_text_field_shared_stripe_key'];
    if(!isset($rSharedKey) || $rSharedKey == Constants::empty_string){
        $rSharedKey = stripe_donation::shared_test_key;
    }
    return $rSharedKey;
}

function ea_settings_donation_values_section_callback(  ) { 
	//echo __( 'Donation multiplier', 'wordpress' );
}
function ea_settings_stripe_keys_section_callback(  ) { 
	//echo __( 'Stripe keys', 'wordpress' );
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
