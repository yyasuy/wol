<?php
`scselect "Home Wi-Fi"`;
`networksetup -setairportnetwork en0 HG8045-0184-a FAsR7ApH`;
sleep( 10 );

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
?>
