<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="style.css">
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#qrcode').qrcode('Made By Shuttleu!');
			});
			function loadcode(titleid, name, region, serial, size){
				$.ajax({
					url: 'http://fbiticket.uk/api/?url=https://3ds.titlekeys.com/ticket/'+titleid
				}).done(function(data) {
					sizeunit = "B";
					if (size > 1024){
						sizeunit = "KB";
						size = size/1024;
						if (size > 1024){
							sizeunit = "MB";
							size = size/1024;
							if (size > 1024){
								sizeunit = "GB";
								size = size/1024;
							}
						}
					}
					name = name.replace(/\+/g, ' ');
					name = name.replace(/\%3A/g, ':');
					name = name.replace(/\%26/g, '&');
					name = name.replace(/\%2B/g, '+');
					var jsonfix = JSON.stringify(data);
					var jsonobj = JSON.parse(jsonfix);
					$('#qrcode').html('');
					$('#qrcode').qrcode(jsonobj.short);
					$("#qrtitle").html("Name: "+decodeURI(name));
					$("#qrregion").html("Region: "+region);
					$("#qrserial").html("Serial: "+serial);
					$("#qrsize").html("Size: "+Math.ceil(size)+sizeunit);
					$("html, body").animate({ scrollTop: 0 }, "slow");
				});
			};
		</script>
	</head>
	<body>
		<div class="container-fluid">
			<div class="col-sm-3">
				<p id="qrcode"></p>
				<p id="qrtitle">FBI Ticket Installer</p>
				<p id="qrregion">Made</p>
				<p id="qrserial">By</p>
				<p id="qrsize">Shuttleu!</p>
			</div>
			<div class="col-sm-9">
				<form class="form">
					<div class="row">
						<div class="col-sm-3">
							<input type="text" class="form-control" name="filter" placeholder="Title Filter" value="<?php if (isset($_GET['filter'])) echo $_GET['filter'] ?>">
						</div>
						<div class="col-sm-3">
							<select class="form-control" name="region">
								<option>ALL</option>
								<option<?php if (!empty($_GET['region'])&&($_GET['region']=='EUR')) echo ' selected="selected"'; ?>>EUR</option>
								<option<?php if (!empty($_GET['region'])&&($_GET['region']=='USA')) echo ' selected="selected"'; ?>>USA</option>
								<option<?php if (!empty($_GET['region'])&&($_GET['region']=='JPN')) echo ' selected="selected"'; ?>>JPN</option>
							</select>
						</div>
						<div class="col-sm-3">
							<select class="form-control" name="type">
								<option value="all">ALL</option>
								<option <?php if (!empty($_GET['type'])&&($_GET['type']=='eshop')) echo 'selected="selected" '; ?>value="eshop">eShop</option>
								<option <?php if (!empty($_GET['type'])&&($_GET['type']=='update')) echo 'selected="selected" '; ?>value="update">Update</option>
								<option <?php if (!empty($_GET['type'])&&($_GET['type']=='dlc')) echo 'selected="selected" '; ?>value="dlc">DLC</option>
								<option <?php if (!empty($_GET['type'])&&($_GET['type']=='sapp')) echo 'selected="selected" '; ?>value="sapp">System Application</option>
								<option <?php if (!empty($_GET['type'])&&($_GET['type']=='sda')) echo 'selected="selected" '; ?>value="sda">System Data Archive</option>
								<option <?php if (!empty($_GET['type'])&&($_GET['type']=='sapplet')) echo 'selected="selected" '; ?>value="sapplet">System Applet</option>
								<option <?php if (!empty($_GET['type'])&&($_GET['type']=='smod')) echo 'selected="selected" '; ?>value="smod">System Module</option>
								<option <?php if (!empty($_GET['type'])&&($_GET['type']=='sfirm')) echo 'selected="selected" '; ?>value="sfirm">System firmware</option>
								<option <?php if (!empty($_GET['type'])&&($_GET['type']=='down')) echo 'selected="selected" '; ?>value="down">Download Play Title</option>
								<option <?php if (!empty($_GET['type'])&&($_GET['type']=='dsisa')) echo 'selected="selected" '; ?>value="dsisa">DSIWare System Application</option>
								<option <?php if (!empty($_GET['type'])&&($_GET['type']=='dsisda')) echo 'selected="selected" '; ?>value="dsisda">DSIWare System Data Archive</option>
								<option <?php if (!empty($_GET['type'])&&($_GET['type']=='dsiw')) echo 'selected="selected" '; ?>value="dsiw">DSIWare</option>
								<option <?php if (!empty($_GET['type'])&&($_GET['type']=='demo')) echo 'selected="selected" '; ?>value="demo">Demo</option>
							</select>
						</div>
						<input type="hidden" name="sort" value="<?php if (!empty($_GET['sort'])) echo $_GET['sort']; ?>">
						<div class="col-sm-3">
							<input class="form-control" type="submit" value="Filter">
						</div>
					</div>
				</form>
				<div class="row">
					<table class="table table-striped table-bordered">
						<tr>
							<th><a href="?sort=titleID<?php if (!empty($_GET['filter'])) echo "&filter=".$_GET['filter']; if (!empty($_GET['region'])) echo "&region=".$_GET['region']; if (!empty($_GET['type'])) echo "&type=".$_GET['type']; ?>">TitleID</a></th>
							<th><a href="?sort=region<?php if (!empty($_GET['filter'])) echo "&filter=".$_GET['filter']; if (!empty($_GET['region'])) echo "&region=".$_GET['region']; if (!empty($_GET['type'])) echo "&type=".$_GET['type']; ?>">Region</a></th>
							<th><a href="?sort=name<?php if (!empty($_GET['filter'])) echo "&filter=".$_GET['filter']; if (!empty($_GET['region'])) echo "&region=".$_GET['region']; if (!empty($_GET['type'])) echo "&type=".$_GET['type']; ?>">Name</a></th>
						</tr>
					<?php
						function remove_accents($string) {
						    if ( !preg_match('/[\x80-\xff]/', $string) )
						        return $string;

						    $chars = array(
						    // Decompositions for Latin-1 Supplement
						    chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
						    chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
						    chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
						    chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
						    chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
						    chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
						    chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
						    chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
						    chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
						    chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
						    chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
						    chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
						    chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
						    chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
						    chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
						    chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
						    chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
						    chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
						    chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
						    chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
						    chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
						    chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
						    chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
						    chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
						    chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
						    chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
						    chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
						    chr(195).chr(191) => 'y',
						    // Decompositions for Latin Extended-A
						    chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
						    chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
						    chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
						    chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
						    chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
						    chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
						    chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
						    chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
						    chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
						    chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
						    chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
						    chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
						    chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
						    chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
						    chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
						    chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
						    chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
						    chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
						    chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
						    chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
						    chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
						    chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
						    chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
						    chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
						    chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
						    chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
						    chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
						    chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
						    chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
						    chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
						    chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
						    chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
						    chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
						    chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
						    chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
						    chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
						    chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
						    chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
						    chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
						    chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
						    chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
						    chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
						    chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
						    chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
						    chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
						    chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
						    chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
						    chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
						    chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
						    chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
						    chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
						    chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
						    chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
						    chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
						    chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
						    chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
						    chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
						    chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
						    chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
						    chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
						    chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
						    chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
						    chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
						    chr(197).chr(190) => 'z', chr(197).chr(191) => 's'
						    );

						    $string = strtr($string, $chars);

						    return $string;
						}
						$test = json_decode(file_get_contents('https://3ds.titlekeys.com/json_enc'), true);
						if (!empty($_GET['sort']))
							usort($test, function($a, $b) {
		    					return $a[$_GET['sort']] <=> $b[$_GET['sort']];
							});
						if (!empty($_GET['type']))
							switch($_GET['type']){
								case 'eshop': $test = array_filter($test, function($v) { return '00040000' == strtoupper(substr($v['titleID'], 0, 8));});
									break;
								case 'sapp': $test = array_filter($test, function($v) { return '00040010' == strtoupper(substr($v['titleID'], 0, 8));});
									break;
								case 'sda': $test = array_filter($test, function($v) { return (('0004001B' == strtoupper(substr($v['titleID'], 0, 8))) || ('000400DB' == strtoupper(substr($v['titleID'], 0, 8))) || ('0004009B' == strtoupper(substr($v['titleID'], 0, 8))));});
									break;
								case 'sapplet': $test = array_filter($test, function($v) { return '00040030' == strtoupper(substr($v['titleID'], 0, 8));});
									break;
								case 'smod': $test = array_filter($test, function($v) { return '00040130' == strtoupper(substr($v['titleID'], 0, 8));});
									break;
								case 'sfirm': $test = array_filter($test, function($v) { return '00040138' == strtoupper(substr($v['titleID'], 0, 8));});
									break;
								case 'down': $test = array_filter($test, function($v) { return '00040001' == strtoupper(substr($v['titleID'], 0, 8));});
									break;
								case 'dsisa': $test = array_filter($test, function($v) { return '00048005' == strtoupper(substr($v['titleID'], 0, 8));});
									break;
								case 'dsisda': $test = array_filter($test, function($v) { return '0004800F' == strtoupper(substr($v['titleID'], 0, 8));});
									break;
								case 'dsiw1': $test = array_filter($test, function($v) { return (('00048000' == strtoupper(substr($v['titleID'], 0, 8))) || ('00048004' == strtoupper(substr($v['titleID'], 0, 8))));});
									break;
								case 'update': $test = array_filter($test, function($v) { return '0004000E' == strtoupper(substr($v['titleID'], 0, 8));});
									break;
								case 'demo': $test = array_filter($test, function($v) { return '00040002' == strtoupper(substr($v['titleID'], 0, 8));});
									break;
								case 'dlc': $test = array_filter($test, function($v) { return '0004008C' == strtoupper(substr($v['titleID'], 0, 8));});
									break;
								default: break;
							}
						if (!empty($_GET['filter']))
							$test = array_filter($test, function($v) { return fnmatch('*'.strtolower($_GET['filter']).'*', strtolower(remove_accents($v['name'])));});
						if (!empty($_GET['region'])){
							if (($_GET['region'] == 'EUR')||($_GET['region'] == 'USA')||($_GET['region'] == 'JPN'))
								$test = array_filter($test, function($v) { return $_GET['region'] == $v['region'];});
						}
						foreach($test as $key => $row){
							?>
							<tr onclick="loadcode('<?php echo strtolower($row['titleID']); ?>', '<?php echo urlencode($row['name']); ?>', '<?php echo $row['region']; ?>', '<?php echo $row['serial']; ?>', '<?php echo $row['size']; ?>')">
								<td><?php echo strtoupper($row['titleID']);?></td>
								<td><?php echo strtoupper($row['region']);?></td>
								<td><?php echo $row['name'];?></td>
							</tr>
							<?php
						}
					?>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>
