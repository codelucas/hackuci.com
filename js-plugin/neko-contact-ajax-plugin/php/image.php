<?php 

/*
 * Developed by Matthew Watts {Euphoric Code}
 * Questions? Email matthew@euphoriccode.com
 */


if ( !isset( $_SESSION ) ) session_start(); 
header( "(anti-spam-content-type:) image/png" );


$enc_num = rand( 0, 9999 );
$key_num = rand( 0, 24 );
$hash_string = substr( md5( $enc_num ), $key_num, 6 ); // Length of String
$hash_md5 = md5( $hash_string );

$_SESSION['nekoCheck']['verify'] = $hash_md5;

# This is our verification image Background Selection
$dir = dirname( dirname( __FILE__ ) ) . '/';
$bgs = array(
	$dir . 'img/bg-1.png',
	$dir . 'img/bg-2.png',
	$dir . 'img/bg-3.png'
);
$background = array_rand( $bgs, 1 );

# Loading our Verification Image Variables
$img_handle 	= imagecreatefrompng( $bgs[$background] );
$text_colour 	= imagecolorallocate( $img_handle, 255, 255, 255 );
$font_size 		= 5;

$size_array = getimagesize( $bgs[$background] );
$img_w = $size_array[0];
$img_h = $size_array[1];

$horiz = round( ( $img_w/2 )-( ( strlen( $hash_string )*imagefontwidth( 5 ) )/2 ), 1 );
$vert = round( ( $img_h/2 )-( imagefontheight( $font_size )/2 ) );

# Now we need to make the Verification Image
imagestring( $img_handle, $font_size, $horiz, $vert, $hash_string, $text_colour );
imagepng( $img_handle );

# To finalise we are going to destroy the Image to keep Server Space
imagedestroy( $img_handle );
