<?php
				$result = mysql_query("INSERT INTO pastebinshare(name, codelang, code, note, url) VALUES('${vals['name']}', '${vals['codelang']}', '${vals['code']}', '${vals['note']}', '${vals['url']}')");
				if (!$result) die(mysql_error());
				$flash_msg[] = 'Code posted';
			}
		?>
		
		<div id="recentcodeshare-wrapper">
		<ul id="recentcodeshare">
		<?php
			$result = mysql_query('SELECT id, name, SUBSTRING(note, 1, 25) AS excerpt FROM pastebinshare ORDER BY id DESC LIMIT 5');
			if (!$result) die(mysql_error());

			while ($row = mysql_fetch_assoc($result)) {
				echo "<li><a href=\"view.php?id=${row['id']}\">${row['name']} - ${row['excerpt']}&#8230;</a></li>";
			}
			
			mysql_free_result($result);
		?>
		</ul>	
		
		<?php
			mysql_close($conn);
		?>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="formposttocodeshare">
			<label class="formposttocodeshare">Your Name</label>
			<input class="formposttocodeshare" type="text" name="name" />

			<label class="formposttocodeshare">URL (optional)</label>
			<input class="formposttocodeshare" type="text" name="url" />

			<label class="formposttocodeshare">Language</label>
			<select class="formposttocodeshare" name="codelang">
			</select>
			
			<label class="formposttocodeshare">Code</label>
			<textarea class="formposttocodeshare" id="txtcode" name="code"></textarea>

			<label class="formposttocodeshare">Note</label>
			<textarea class="formposttocodeshare" id="txtnote" name="note"></textarea>
			
			<input class="formposttocodeshare" type="submit" name="submit" value="Post" />
		</form>
	</body>
</html>