<?php

require_once __DIR__ . '/file-functions.php';

$input  = __DIR__ . '/input';
$output = __DIR__ . '/output';

if (!empty($_POST['plugin_slug'])) {
	$params = [
		'author_name'  => $_POST['author_name'],
		'author_email' => $_POST['author_email'],
		'author_uri'   => $_POST['author_uri'],
		'plugin_slug'  => $_POST['plugin_slug'],
		'plugin_name'  => $_POST['plugin_name'],
		'plugin_uri'   => $_POST['plugin_uri'],
	];
} else {
	$params = [
		'author_name'  => 'Andrew A. Chuev',
		'author_email' => 'andrew.chuev@gmail.com',
		'author_uri'   => 'https://reslab.tech',
		'plugin_slug'  => 'epb2',
		'plugin_name'  => 'Express Pay Buttons',
		'plugin_uri'   => 'https://academweb.com/epb/'
	];
}

$plugin_slug = $params['plugin_slug'];

@rrmdir( "$output/" );

rcopy( $input, $output );
rrename( $output, $params );
rename( "$output/plugin-name", "$output/".$params['plugin_slug'] );
zip( "$output/", "$output/$plugin_slug/$plugin_slug.zip" );
download_zip("$output/$plugin_slug/", "$plugin_slug.zip" );


function replace_data( $path, $params ) {

	$plugin_slug = $params['plugin_slug'];

	$replaces = [

		'Your Name'                           => $params['author_name'],
		'email@example.com'                   => $params['author_email'],
		'http://example.com/plugin-name-uri/' => $params['plugin_uri'],
		'http://example.com'                  => $params['author_uri'],
		'WordPress Plugin Boilerplate'        => $params['plugin_name'],
		'plugin_name'                         => str_replace( '-', '_', $plugin_slug ),
		'plugin-name'                         => $plugin_slug,
		'Plugin_Name'                         => ucwords( str_replace( '-', '_', $plugin_slug ), '_' ),
		'PLUGIN_NAME_'                        => strtoupper( str_replace( '-', '_', $plugin_slug ) ) . '_'
	];

	foreach ( $replaces as $from => $to ) {
		$input   = file_get_contents( $path );
		$replace = str_replace( $from, $to, $input );
		file_put_contents( $path, $replace );
	}
}



