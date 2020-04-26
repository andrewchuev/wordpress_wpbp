<?php
function rrename( $path, $params ) {

	$path = realpath( $path );

	$di = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator( $path, FilesystemIterator::SKIP_DOTS ),
		RecursiveIteratorIterator::LEAVES_ONLY
	);

	foreach ( $di as $name => $fio ) {
		$newname = $fio->getPath() . DIRECTORY_SEPARATOR . str_replace( 'plugin-name', $params['plugin_slug'], $fio->getFilename() );
		//echo $newname, "\r\n";
		rename( $name, $newname );
		replace_data( $newname, $params );
	}

}

function rcopy( $source, $dest ) {
	//$source = "dir/dir/dir";
	//$dest= "dest/dir";

	@mkdir( $dest, 0755 );
	foreach (
		$iterator = new \RecursiveIteratorIterator(
			new \RecursiveDirectoryIterator( $source, \RecursiveDirectoryIterator::SKIP_DOTS ),
			\RecursiveIteratorIterator::SELF_FIRST ) as $item
	) {
		if ( $item->isDir() ) {
			mkdir( $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName() );
		} else {
			copy( $item, $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName() );
		}
	}
}

function rrmdir( $dir ) {
	$di = new RecursiveDirectoryIterator( $dir, FilesystemIterator::SKIP_DOTS );
	$ri = new RecursiveIteratorIterator( $di, RecursiveIteratorIterator::CHILD_FIRST );
	foreach ( $ri as $file ) {
		$file->isDir() ? rmdir( $file ) : unlink( $file );
	}

	return true;
}

function zip( $source, $destination ) {
	if ( ! extension_loaded( 'zip' ) || ! file_exists( $source ) ) {
		return false;
	}

	$zip = new ZipArchive();
	if ( ! $zip->open( $destination, ZIPARCHIVE::CREATE ) ) {
		return false;
	}

	$source = str_replace( '\\', '/', realpath( $source ) );

	if ( is_dir( $source ) === true ) {
		$files = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $source ), RecursiveIteratorIterator::SELF_FIRST );

		foreach ( $files as $file ) {
			$file = str_replace( '\\', '/', $file );

			if ( in_array( substr( $file, strrpos( $file, '/' ) + 1 ), array( '.', '..' ) ) ) {
				continue;
			}

			$file = realpath( $file );

			if ( is_dir( $file ) === true ) {
				$zip->addEmptyDir( str_replace( $source . '/', '', $file . '/' ) );
			} else if ( is_file( $file ) === true ) {
				$zip->addFromString( str_replace( $source . '/', '', $file ), file_get_contents( $file ) );
			}
		}
	} else if ( is_file( $source ) === true ) {
		$zip->addFromString( basename( $source ), file_get_contents( $source ) );
	}

	return $zip->close();
}

function download_zip( $filepath, $filename ) {
	$file = $filepath . $filename;
	if ( headers_sent() ) {
		echo 'HTTP header already sent';
	} else {
		if ( ! is_file( $file ) ) {
			header( $_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found' );
			echo 'File not found';
		} else if ( ! is_readable( $file ) ) {
			header( $_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden' );
			echo 'File not readable';
		} else {

			header( $_SERVER['SERVER_PROTOCOL'] . ' 200 OK' );
			header( "Content-Type: application/zip" );
			header( "Content-Transfer-Encoding: Binary" );
			header( "Content-Length: " . filesize( $file ) );
			header( "Content-Disposition: attachment; filename=\"" . basename( $file ) . "\"" );
			ob_end_flush();
			readfile( $file );
			exit;
		}
	}
}

