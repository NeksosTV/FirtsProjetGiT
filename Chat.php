<!-- This Script is from www.phpfreecpde.com, Coded by: Kerixa Inc-->

<?php
if (isset($_GET['enSubmit']) && isset($_GET['uname']) && isset($_GET['rname'])) {
	echo '<meta http-equiv="refresh" content="600">';
	$room = $_GET['rname'];
	$uname = $_GET['uname'];
	if (!is_dir($room)) mkdir($room);
	$files = scandir($room);
	foreach ($files as $user) {
		if ($user == '.' || $user == '..') continue;
		$handle = fopen("$room/$user", 'r');
		$time = fread($handle, filesize("$room/$user"));
		fclose($handle);
		if ((time() - $time) > 600) unlink("$room/$user");
	}
	$contents = '';
	$filename = "$room.txt";
	if (file_exists($filename)) {
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		fclose($handle);
	}
	$handle = fopen("$room/$uname", "w");
	fwrite($handle, time());
	fclose($handle);

	$files = scandir($room);
	$users = '';
	foreach ($files as $user) if ($user != '.' && $user != '..') $users .= $user . "\n";

	if (isset($_POST['Send'])) {
		$text = $_POST['txt'];
		$contents .= "$uname: $text";
		$handle = fopen("$filename", "a");
		fwrite($handle, "$uname: $text\n");
		fclose($handle);
	}
?>

	<body OnLoad="document.myform.txt.focus()">
		<link rel="stylesheet" href="/css/chat.css">
		<ul>
			<a href="index.php">
				<li>Acceuil</li>
			</a>
		</ul>
		<form action="" method="post" name="myform">
			<table style="border: 1px solid #000000;width: 752px" align="center">
				<tr>
					<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: center;width: 537; color: #2214B9;border-style: solid;border-width: 1px; height: 350px;">
						<textarea readonly="readonly" name="txtchat" style="width: 581px; color: #000000; height: 365px; background-color: #01A791; font-family: 'times New Roman', Times, serif; font-size: 12pt;"><?php echo "Bienvenue à la $room Chat Room...\n$contents" ?> </textarea>
					</td>
					<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: center;color: #2214B9;border-style: solid;border-width: 1px; height: 349px; width: 143px;">
						<textarea readonly="readonly" contenteditable="false" name="txtusers" style=";width: 163px; height: 365px; background-color: #01A791; font-family: 'times New Roman', Times, serif; font-size: 12pt; font-weight: bold; text-align: center;"><?php echo $users ?></textarea>
					</td>
				</tr>
				<tr>
					<td style="width: 537; border-style: solid;border-width: 1px;text-align: left; height: 39px; font-size: 14pt;">
						<textarea id="txtt" name="txt" style="width: 581px; height: 79px; font-family: 'times New Roman', Times, serif; font-size: 12pt"></textarea>
					</td>
					<td style="border-style: solid;border-width: 1px; height: 39px;padding-left: 8px; width: 143px; text-align: center;">
						<input name="Send" style="width: 118px; height: 63px; font-size: 15pt; font-family: 'Times New Roman', Times, serif; color: #19B024;" type="submit" value="Envoyer">
					</td>
				</tr>
			</table>
		</form>

	<?php
} else {
	?>
		<form method="get" action="">
			<table style="border: 1px solid #000000;width: 452px" align="center">
				<tr>
					<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: left; width: 432px; color: #2214B9;;border-style: solid;border-width: 1px;">Surnom:</td>
					<td style="border-style: solid; border-width: 1px; font-family: 'Times New Roman', Times, serif; font-size: 17pt; text-align: left; color: #2214B9; width: 430px;">
						<input name="uname" style="font-size: medium; width: 260px; color: #B01919;">
					</td>
				</tr>
				<tr>
					<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: left; width: 432px; color: #2214B9;border-style: solid;border-width: 1px;">Sélectionnez la chambre:</td>
					<td style="border-style: solid; border-width: 1px; font-family: 'Times New Roman', Times, serif; font-size: 17pt; text-align: left; color: #2214B9; width: 430px;">
						<select name="rname" style="width: 260px; font-size: medium; color: #B01919;">
							<option selected="">Help</option>
							<option>Discussions</option>
						</select>
					</td>
				</tr>
				<tr>
					<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: center; color: #2214B9; border-left-style: solid; border-left-width: 1px; border-right-style: none; border-right-width: medium; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px; padding-top:10px;padding-bottom:10px" colspan="2">
						<input name="enSubmit" style="width: 118px; height: 63px; font-size: 30pt; font-family: 'Times New Roman', Times, serif; color: #010401;" type="submit" value="Enter">
					</td>
				</tr>
			</table> <button>
		</form>
	<?php
}
	?>
	<script>
		el = document.myform.txtt
		if (typeof el.selectionStart == "number") {
			el.selectionStart = el.selectionEnd = el.value.length;
		} else if (typeof el.createTextRange != "undefined") {
			el.focus();
			var range = el.createTextRange();
			range.collapse(false);
			range.select();
		}
	</script>



	</body>