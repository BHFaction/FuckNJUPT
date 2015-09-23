<?

function curl_request($url, $post = '', $cookie_file = '', $fetch_cookie = 0, $referer = '', $timeout = 10)
{

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Expect:"));
	curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
	curl_setopt($curl, CURLOPT_REFERER, $referer);
	if ($post)
	{
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
	}
	if ($fetch_cookie)
	{
		curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file);
	}
	else
	{
		curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file);
	}
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($curl);
	if (curl_errno($curl))
	{
		return false;
	}

	return $data;
}

$result = curl_request("http://192.168.168.168/", $_POST, '', 0, 'http://192.168.168.168/', 3);
// $result = iconv( 'gb2312', 'utf-8', $result );
// exit($result);
if(strstr($result, "into our system."))
	exit("1");
else
	exit(0);