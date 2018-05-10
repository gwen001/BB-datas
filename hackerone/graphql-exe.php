<?php


function usage( $err=null ) {
	echo 'Usage: '.$_SERVER['argv'][0]." <file_to_execute> [<argument>]\n";
	if( $err ) {
		echo 'Error: '.$err."!\n";
	}
	exit();
}

if( $_SERVER['argc'] != 2 ) {
  usage();
}



/**
 * init vars
 */
{
	$url = 'https://hackerone.com/graphql';
	
	$t_headers = [
		'User-Agent: Mozilla/5.0 (X11; Linux x86_64; rv:56.0) Gecko/20100101 Firefox/56.0',
		'Accept-Language: en-US,en;q=0.5',
		'content-type: application/json',
		'origin: https://hackerone.com',
		'Referer: https://hackerone.com/security',
		'x-auth-token: __YOUR_TOKEN_HERE__',
		'Cookie: __YOUR_COOKIES_HERE__',
	];
}
// end init ---



// run a query
run( $_SERVER['argv'][1] );



/**
 * run()
 *
 * @param string $f
 */
function run( $f )
{
	if( !is_file($f) ) {
		echo "ERR: file not found!\n";
	}
	$q = file_get_contents( $f );
	$q = preg_replace( '#\s+#', ' ', $q );
	
	if( isset($_SERVER['argv'][2]) ) {
		$q = str_replace( '__ARGV2__', $_SERVER['argv'][2], $q );
	}
	echo $q."\n\n";
	
	$result = query( $q );
	var_dump( json_decode($result,true) );
	
	/*if( stristr($result,"doesn't exist on type 'Query'") === false ) {
		echo $f."\n";
	}*/
}



/**
 * query()
 *
 * @param string $q
 * @return string
 */
function query( $q )
{
	global $url, $t_headers;
	
	$c = curl_init();
	curl_setopt( $c, CURLOPT_URL, $url );
	curl_setopt( $c, CURLOPT_POST, true );
	curl_setopt( $c, CURLOPT_HEADER, false );
	curl_setopt( $c, CURLOPT_TIMEOUT, 3 );
	curl_setopt( $c, CURLOPT_FOLLOWLOCATION, false );
	curl_setopt( $c, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $c, CURLOPT_HTTPHEADER, $t_headers );
	curl_setopt( $c, CURLOPT_POSTFIELDS, $q );
	$result = curl_exec( $c );
	$t_info = curl_getinfo( $c );
	curl_close( $c );
	
	return $result;
}

