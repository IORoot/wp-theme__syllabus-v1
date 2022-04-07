<?php

/*
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - Login / Logout button
 * Plugin URI:        http://londonparkour.com
 * Description:       <strong>Login/Logout</strong> | Button that changes depending on your login status.
 * Version:           0.1.0
 * Author:            Andy Pearson
 * Author URI:        https://londonparkour.com
 * Domain Path:       /languages
 */

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                         Use composer autoloader                         │
// └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/vendor/autoload.php';

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                        	   Initialise    		                     │
// └─────────────────────────────────────────────────────────────────────────┘
new andyp\loginout\profile_button;