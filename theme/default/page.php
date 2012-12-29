<html>
<head>
	<title>EnigMagick</title>
	<link rel='stylesheet' id='enigmagick-main-css'  href='/enigmagick/theme/default/css/enigmagick.css' type='text/css' media='all' />
</head>
<body>
	<div class="page">
		<div class="header">
			<h1>EnigMagick</h1>

			<div class="menu">
			<ul id="MainMenu">
				<li><a href="index.php?search_text=<?php echo $search; ?>">Liber Al</a></li>
				<li><a href="custom_text.php?search_text=<?php echo $search; ?>">Custom text</a></li>
			</ul>
			<br style="clear:left"/>
			</div>
		</div>

		<div class="search-form">
			<form method='post'>
			<p>Search: <input type='text' name="search_text" value="<?php echo $search; ?>" /></p>

			<?php if($form == 'custom') { ?><p>Custom Text: <textarea name="text_source"><?php echo $text_source; ?></textarea></p><?php } ?>

			<p><input type="submit" value="Apply Cipher" />
			</form>
		</div>

		<div class="results">
			<p>Value: <?php echo $search_value; ?></p>

			<?php if(!empty($triangle)) { ?>
			<div class="results-triangle">
			<p>Word/Value Triangle:</p>
			<table>
			<?php
				$words = explode(' ',$search);
			?>
				<tr>
					<?php
				foreach($words as $word) {?>
					<th><?php echo $word; ?></th><th>&nbsp;</th>
					<?php
				}
					?>
				</tr>
			<?php
				$indent = 0;
				$alt = false;
				foreach($triangle as $row) {
			?>
				<tr>
					<?php
						$tmp = 0;
						while($tmp++ < $indent) {
						?>
						<td>&nbsp;</td>
						<?php
						}
						$first = true;
						foreach($row as $node) {
							if($alt and !$first) {
					?>
					<td>&nbsp;</td>
					<?php
							}
					?>
					<td><a href="index.php?search_text=<?php echo $node['text']; ?>" title="<?php echo $node['text']; ?>"><?php echo $node['value']; ?></a></td>
					<?php
							if(!$alt) {
					?>
					<td>&nbsp;</td>
					<?php
							}
							$first = false;
						}
					?>
				</tr>
			<?php
					$indent++;
					$alt = !$alt;
				}
			?>
			</table>
			</div>
			<?php } ?>

			<div class="matches">
			<?php if($search_value > 0) { ?>
			<p>Matches from <?php echo $source_name; ?>:

			<?php if(empty($matches)) { ?>
			<em>None</em>
			<?php } else { ?>
			<ol>
			<?php
				foreach($matches as $match) {
					echo '<li><a href="index.php?search_text='.$match.'">'.$match.'</li>';
				}
			?>
			</ol>
			<?php } ?>
			</p>
			<?php } ?>
			</div>
		</div>
	</body>
</html>
