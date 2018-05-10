<?php


function usage( $err=null ) {
	echo 'Usage: '.$_SERVER['argv'][0]." <max_depth>\n";
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
	define( 'MAX_DEPTH', (int)$_SERVER['argv'][1] );
	define( 'O_FILE', __DIR__.'/obj.txt' );
	define( 'O_PATH', __DIR__.'/objects' );
	define( 'Q_PATH', __DIR__.'/queries' );
	define( 'M_PATH', __DIR__.'/mutations' );
	define( 'FIRST_N_EDGES', 5 );

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

	@mkdir( O_PATH, 0777 );
	@mkdir( Q_PATH, 0777 );
	@mkdir( M_PATH, 0777 );
}
// end init ---



/**
 * STEP 1 - grab the objects list
 */
{
	echo "\n".str_pad( " STEP 1 - grab the objects list ", 100, "#", STR_PAD_BOTH )."\n";
	
	$c = curl_init();
	curl_setopt( $c, CURLOPT_URL, $url );
	curl_setopt( $c, CURLOPT_POST, true );
	curl_setopt( $c, CURLOPT_HEADER, false );
	curl_setopt( $c, CURLOPT_TIMEOUT, 3 );
	curl_setopt( $c, CURLOPT_FOLLOWLOCATION, false );
	curl_setopt( $c, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $c, CURLOPT_HTTPHEADER, $t_headers );
	curl_setopt( $c, CURLOPT_POSTFIELDS, '{"query":"{__schema {types {name}}}"}' );
	$result = curl_exec( $c );
	$t_info = curl_getinfo( $c );
	curl_close( $c );
	//var_dump( $result );
	
	if( stristr($result,'{"data":{"__schema":{"types":') === false ) {
		echo "ERROR!";
		exit();
	} else {
		echo "OK";

		$t_types = [];
		$t_datas = json_decode( $result, true );
		foreach( $t_datas['data']['__schema']['types'] as $t ) {
			$t_types[] = $t['name'];
		}
		$t_types = array_unique( $t_types );
		sort( $t_types );

		file_put_contents( O_FILE, implode("\n",$t_types) );
	}

	echo "\n";
}
// end step 1 ---



/**
 * STEP 2 - grab the properties of all objects
 */
{
	echo "\n".str_pad( " STEP 2 - grab the properties of all objects ", 100, "#", STR_PAD_BOTH )."\n";

	$t_obj = file( 'obj.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
	//$t_obj = [ 'User' ];
	
	foreach( $t_obj as $o )
	{
		echo 'Grabbing '.$o.' properties... ';
		
		$c = curl_init();
		curl_setopt( $c, CURLOPT_URL, $url );
		curl_setopt( $c, CURLOPT_POST, true );
		curl_setopt( $c, CURLOPT_HEADER, false );
		curl_setopt( $c, CURLOPT_TIMEOUT, 3 );
		curl_setopt( $c, CURLOPT_FOLLOWLOCATION, false );
		curl_setopt( $c, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $c, CURLOPT_HTTPHEADER, $t_headers );
		curl_setopt( $c, CURLOPT_POSTFIELDS, '{"query":"query User_mini_profile {\n  __type(name:\"'.$o.'\") {name,description,fields {name,type{name,kind,ofType{name,kind}}}}}"}' );
		$result = curl_exec( $c );
		$t_info = curl_getinfo( $c );
		curl_close( $c );
		//var_dump( $result );
		
		if( stristr($result,'{"data":{"__type":{"name":"'.$o.'"') === false ) {
			echo 'ERROR!';
		} else {
			echo 'ok';
			$f = O_PATH.'/'.$o.'.json';
			$str = json_encode( json_decode($result), JSON_PRETTY_PRINT );
			file_put_contents( $f, $str );
		}
	
		echo "\n";
	}
}
// end step 2 ---



/**
 * STEP 3 - create queries files
 */
{
	echo "\n".str_pad( " STEP 3 - create queries files ", 100, "#", STR_PAD_BOTH )."\n";

	$level = 0;
	$t_ignore = ['pageInfo', 'cursor', 'membership', 'remaining_reports', 'policy_html'];
	$t_files = glob( O_PATH.'/*.json' );
	
	foreach( $t_files as $f )
	{
		//$f = 'objects/User.json';
		$obj = basename( $f, '.json' );
	
		$str_query = "query (\$var0:String!) {\n";
		$str_query .= "\t\t".strtolower($obj)." {\n";
	
		list( $q, $has_edges, $has_fields ) = runObject( $obj );
		
		if( $q != -1 ) {
			$str_query .= $q;
		}
		
		$str_query .= "\t\t}\n";
		$str_query .= "\t}";
		//echo $str_query;
		
		$t_query = [ 'variables'=>['var0'=>'__ARGV2__'], 'query'=>$str_query ];
		
		$str = json_encode( $t_query, JSON_PRETTY_PRINT );
		$str = str_replace( '\t', "\t", $str );
		$str = str_replace( '\n', "\n", $str );
		
		file_put_contents( Q_PATH.'/'.$obj.'.json', $str );
	}
}
// end step 3 ---



/**
 * STEP 4 - create mutations files
 */
{
	echo "\n".str_pad( " STEP 4 - create mutations files ", 100, "#", STR_PAD_BOTH )."\n";

	$level = 0;
	$t_ignore = ['pageInfo', 'cursor', 'errors', 'membership', 'remaining_reports', 'authentication_service', 'policy_html'];
	$t_files = glob( O_PATH.'/*Input*.json' );
	
	foreach( $t_files as $f )
	{
		//$f = 'objects/UpdateTeamSubmissionStateInput.json';
		
		if( stristr($f,'__') !== false ) {
			continue;
		}
		
		$obj = basename( $f, '.json' );
		$origin = str_replace( 'Input', '', $obj );
		$origin_bis = $origin;
		$origin_bis[0] = strtolower( $origin_bis[0] );
		$payload = str_replace( 'Input', 'Payload', $obj );
	
		$str_query = "mutation (\$input0:".$obj."!) {\n";
		$str_query .= "\t\t".$origin_bis."(input:\$input0) {\n";
	
		list( $q, $has_edges, $has_fields ) = runObject( $payload );
		
		if( $q != -1 ) {
			$str_query .= $q;
		}
		
		$str_query .= "\t\t}\n";
		$str_query .= "\t}";
		//echo $str_query;
		
		$c = file_get_contents( O_PATH.'/'.$payload.'.json' );
		$json = json_decode( $c, true );
		$t_vars = [];
		$t_vars['input0'] = [];
		
		foreach( $json['data']['__type']['fields'] as $i ) {
			if( $i['name'] == 'clientMutationId' ) {
				$v = '0';
			} else {
				$v = '';
			}
			$t_vars['input0'][ $i['name'] ] = $v;
		}
	
		$t_query = [ 'variables'=>$t_vars, 'query'=>$str_query ];
		
		$str = json_encode( $t_query, JSON_PRETTY_PRINT );
		$str = str_replace( '\t', "\t", $str );
		$str = str_replace( '\n', "\n", $str );
		
		file_put_contents( M_PATH.'/'.$obj.'.json', $str );
	}
}
// end step 4 ---



echo "\nThe end.\n";

	

/**
 * Recursive function that run through the childs of an object in order to create the final object in a string form
 *
 * @param string $obj the name of the object that will be treated
 * @param integer $level the current level of depth
 * @return array 0:the final object stringified, 1:true if it has edges, 2:true if it has fields
 */
function runObject( $obj, $level=0 )
{
	global $t_ignore;
	
	$str_query = '';
	$f = O_PATH.'/'.$obj.'.json';
	echo str_pad('',$level,"\t").$f.' '.$level."\n";
	$c = file_get_contents( $f );
	$json = json_decode( $c, true );

	if( $level > MAX_DEPTH ) {
		return -1;
	}

	if( !isset($json['data']) || !isset($json['data']['__type']) || !isset($json['data']['__type']['fields']) || is_null($json['data']['__type']['fields']) ) {
		return -1;
	}
	
	$t_fields = $json['data']['__type']['fields'];
	
	$has_fields = false;
	$has_edges = false;
		
	foreach( $t_fields as $field )
	{
		$field_name = $field['name'];
		
		if( in_array($field_name,$t_ignore) ) {
			continue;
		}
		
		if( isset($field['type']['ofType']) && !is_null($field['type']['ofType']) && isset($field['type']['ofType']['kind']) && $field['type']['ofType']['kind'] != 'NON_NULL' ) {
			$type_name = $field['type']['ofType']['name'];
			$type_kind = $field['type']['ofType']['kind'];
		} else {
			$type_name = $field['type']['name'];
			$type_kind = $field['type']['kind'];
		}
		
		// special treatment
		if( $field_name == 'profile_picture' ) {
			$field_name .= '(size:small)';
		}
		
		switch( $type_kind )
		{
			case 'INTERFACE':
				break;
			case 'OBJECT':
				{
					$r = runObject( $type_name, $level+1 );
					if( $r[2] )
					{
						if( $field_name == 'edges' ) {
							$has_edges = true;
						}
						
						$has_fields = true;
						$str_query .= str_pad('',$level+3,"\t").$field_name;
						if( $r[1] ) {
							$str_query .= "(first:".FIRST_N_EDGES.")";
						}
						$str_query .= " {\n";
						if( $r[0] != -1 ) {
							$str_query .= $r[0];
						}
						$str_query .= str_pad('',$level+3,"\t")."},\n";
					}
				}
				break;
			case 'UNION':
				break;
			case 'ENUM':
			case 'LIST':
			case 'SCALAR':
			default:
				$has_fields = true;
				$str_query .= str_pad('',$level+3,"\t").$field_name.",\n";
				break;
		}
	}
	
	return [$str_query,$has_edges,$has_fields];
}
// end runObject() ---

