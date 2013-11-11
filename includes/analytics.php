<?php
	// taken from php.net file_exists documentation
	// Fabrizio (staff at bibivu dot com)
	function url_exists($url) {
		$a_url = parse_url($url);
		if(!isset($a_url['port'])) $a_url['port'] = 80;
		$errno = 0;
		$errstr = '';
		$timeout = 5000;
		if(isset($a_url['host']) && $a_url['host'] != gethostbyname($a_url['host'])) {
			$fid = fsockopen($a_url['host'], $a_url['port'], $errno, $errstr, $timeout);
			if (!$fid) return false;
			$page  = isset($a_url['path'])?$a_url['path']:'';
			$page .= isset($a_url['query'])?'?'.$a_url['query']:'';
			fputs($fid, 'HEAD '.$page.' HTTP/1.0'."\r\n".'Host: '.$a_url['host']."\r\n\r\n");
			$head = fread($fid, 4096);
			fclose($fid);
			return preg_match('#^HTTP/.*\s+[200|302]+\s#i', $head);
		} else {
			return false;
		}
	}
?>
<?php if(url_exists('http://www.google-analytics.com/urchin.js')) : ?>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
<script type="text/javascript">
	_uacct = "UA-142689-6";
	urchinTracker();
</script>
<?php endif; ?>
