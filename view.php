<?php
/*
Copyright (C) K.N.Reddy 2012
All Rights Reserved
*/
?><!doctype html>
<html>
	<head>
	<title>KNR CodeShare</title>
	<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<h1>KNR CodeShare</h1>
		<?php include('menulinks.php'); ?>
		<?php
			include('config.php');
			$flash_msg = array();
			
			$conn= mysql_connect($dbhost, $dbuser, $dbpass);
			if (!$conn) die(mysql_error());
			if (!mysql_select_db($dbname, $conn)) die(mysql_error());							
		?>

		<?php
		if (isset($_REQUEST['id'])) {
			$result = mysql_query('SELECT id, name, codelang, code, note, url, tstamp FROM pastebinshare WHERE id = '.mysql_escape_string($_REQUEST['id']));
			if (!$result) die(mysql_error());
		
			$row = mysql_fetch_assoc($result);
		
			if (file_exists('geshi.php')) {
				include('geshi.php');	
				$geshi = new GeSHi($row['code'], $row['codelang'], 'geshi/');
				$formatted_code = $geshi->parse_code();	
			} else {
				if ($row['codelang'] == 'PHP' || $row['codelang'] == 'php')
					$formatted_code = highlight_string($row['code']);
				else
					$formatted_code = $row['code'];
			}
		?>
		
		<?php
		//TODO: Display $flash_msg
		?>
		
		<p class="codeshare-meta">Posted by: <?php echo $row['name']; ?></p>
		<p class="codeshare-meta">Posted on: <?php echo $row['tstamp']; ?></p>
		<p class="codeshare-meta">Language: <?php echo $row['codelang']; ?></p>
		<?php if (isset($row['url']) && $row['url']!=''): ?>
			<p class="codeshare-meta">URL: <a href="<?php echo $row['url']; ?>"><?php echo $row['url']; ?></a></p>
		<?php endif; ?>
		<div id="codeshare-code"><?php echo $formatted_code; ?></div>
		<div><?php echo $row['note']; ?></div>
		
		<?
			mysql_free_result($result);	
		} else {
			$result = mysql_query('SELECT id, name, SUBSTRING(note, 1, 25) AS excerpt, tstamp FROM pastebinshare ORDER BY id DESC');
			if (!$result) die(mysql_error());
		
			echo '<ul id="codeshare-listing">';
			while ($row = mysql_fetch_assoc($result)) {
				echo "<li><a href=\"view.php?id=${row['id']}\">${row['name']} - ${row['excerpt']}&#8230;</a><span class=\"tstamp\">${row['tstamp']}</span></li>";
			}
			echo '</ul>';
			
			mysql_free_result($result);	
		}
		?>
		
		<?php
			mysql_close($conn);
		?>
	</body>
</html>