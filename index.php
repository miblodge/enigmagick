<?php
	$search = '';
	if(isset($_GET["search_text"])) $search = $_GET["search_text"]; 

	//echo $search.' ';

	require_once 'lib/class_cipher_alw.php';

	$cipher = new cipher_alw();

	//print_r($cipher);
	$search_value = 0;
	$matches = array();	
	
	if($search != '') $search_value = $cipher->calculateValue($search);
	if($search_value > 0) {
		$matches = $cipher->getMatchesFromText($search_value);
		$triangle = $cipher->getTriangle($search);
	} else {
		// Check if search is numeric and if so evaluate...
		if((int)$search == $search) {
			$search_value = (int)$search;
			$matches = $cipher->getMatchesFromText($search_value);
			$search = $matches[0];
			$triangle = $cipher->getTriangle($search);
		}
	}	
?><html>
<head><title>EnigMagick</title></head>
<body>
<h1>EnigMagick</h1>

<form>
<p>Text: <input type='text' name="search_text" value="<?php echo $search; ?>" /></p>

<p><input type="submit" value="Apply Cipher" />
</form>
<p>Value: <?php echo $search_value; ?></p>

<?php if(!empty($triangle)) { ?>
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
<?php } ?>


<?php if($search_value > 0) { ?>
<p>Matches from Liber Al:

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

</body>
</html>
