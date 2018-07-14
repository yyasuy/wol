<?php
`scselect "Home Wi-Fi"`;
`networksetup -setairportnetwork en0 HG8045-0184-bg FAsR7ApH`;
sleep( 10 );

$current_network = _get_current_network();
if( $current_network != "HG8045-0184-bg" ){
	print( "Get closer to the router on the 2nd floor\n" );
	exit();
}

for( $i = 0; $i < 100; $i++ ){
	`wakeonlan 00:19:B9:0C:AB:AE`;
	$output = `ping -c 1 192.168.0.200`;
	print( $output );
	if( strpos( $output, 'icmp_seq' ) !== false ){
		printf( "The host is alive.\n" );
		break;
	}
}
`networksetup -setairportnetwork en0 Buffalo-A-472E brtebk8eiif37`;
$notification = sprintf( "osascript -e 'display notification with title \"Wake up complete!\"'" );
`$notification`;


function _get_current_network(){
	$output = `networksetup -getairportnetwork en0`;
	$pattern = '|(.+?)\s(.+?)\s(.+?)\s(.+)|';
	if( preg_match( $pattern, $output, $matches ) ){
		$current_network = trim( $matches[ 4 ] );
		return $current_network;
	}
	return '';
}



?>
