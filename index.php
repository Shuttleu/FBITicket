<?php
	function remove_accents($string) { //Borrowed from WordPress to allow non diacritic searching
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

	$titlelist = json_decode(file_get_contents('https://3ds.titlekeys.com/json_enc'), true); //Grab JSON
							
	if (!empty($_GET['sort'])) //Sort by TitleID, Region or Name
		usort($titlelist, function($a, $b) {
				return $a[$_GET['sort']] <=> $b[$_GET['sort']];
		});
	
	if (!empty($_GET['type']) && !($_GET['type']=='all')) //Filter by title type
		$titlelist = array_filter($titlelist, function($v) {
			$types = ['eshop', 'sapp', 'sda', 'sapplet', 'smod', 'sfirm', 'down', 'dsisa', 'dsisda', 'dsiw', 'update', 'demo', 'dlc'];
			$typeslower = [['00040000'], ['00040010'], ['0004001B', '000400DB', '0004009B'], ['00040030'], ['00040130'], ['00040138'], ['00040001'], ['00048005'], ['0004800F'], ['00048000', '00048004'], ['0004000E'], ['00040002'], ['0004008C']];
			$lowergood = false;
			for ($i=0; $i<count($types); $i++)
				if ($types[$i] == $_GET['type'])
					for ($j=0; $j<count($typeslower[$i]); $j++)
						if (strtoupper(substr($v['titleID'], 0, 8)) == $typeslower[$i][$j])
							$lowergood = true;
			return $lowergood;
		});

	if (!empty($_GET['filter'])) //Filter by search
		$titlelist = array_filter($titlelist, function($v) {
			return fnmatch('*'.strtolower($_GET['filter']).'*', strtolower(remove_accents($v['name'])));
		});

	if (!empty($_GET['region'])) //Filter by region
		if (!($_GET['region'] == 'ALL'))
			$titlelist = array_filter($titlelist, function($v) { return $_GET['region'] == $v['region'];});
?>
<html>
	<head>
		<title>FBI Ticket Installer</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="style.css">
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
		<script type="text/javascript">
			var items = {<?php
				foreach($titlelist as $key => $row){
					echo $key.':false';
					if(end($titlelist) !== $row)
						echo ", ";
				}?>};
			var itemurl = {};

			$(document).ready(function() { //Set default QR Code and search boxes
				$('#qrcode').qrcode('Made By Shuttleu!');
				if (!empty($_GET['type'])) $("#type").val('<?php echo $_GET['type']; ?>');
				if (!empty($_GET['region'])) $("#region").val('<?php echo $_GET['region']; ?>');
			});

			function loadcode(id){
				$('#title-'+id).toggleClass("success");
				items[id] = !items[id];
				if (!(id in itemurl)){
					$.ajax({
						url: 'ajax.php?ticket='+$('#title-'+id).data('titleid'),
						async: false
					}).done(function(data) {
						var jsonobj = JSON.parse(data);
						itemurl[id] = jsonobj.short;
					});
				}
				sizeofselect = 0;
				sizeofselected = 0;
				qrurl = "";
				firstitem = 0;
				for (var x in items)
					if (items[x]){
						sizeofselect++;
						sizeofselected += $('#title-'+x).data('size');
						if (!(qrurl == ""))
							qrurl += '\n';
						qrurl += itemurl[x];
						firstitem = x;
					}
				sizeunit = "B";
				if (sizeofselected > 1024){
					sizeunit = "KB";
					sizeofselected = sizeofselected/1024;
					if (sizeofselected > 1024){
						sizeunit = "MB";
						sizeofselected = sizeofselected/1024;
						if (sizeofselected > 1024){
							sizeunit = "GB";
							sizeofselected = sizeofselected/1024;
						}
					}
				}


				$('#qrcode').html('').qrcode(qrurl);
				$("#qrsize").html("Size: "+Math.ceil(sizeofselected)+sizeunit);
				if (sizeofselect > 1){
					$("#qrtitle").html("Number of titles selceted: "+sizeofselect);
					$("#qrregion").html("");
					$("#qrserial").html("");
				} else if (sizeofselect == 0){
					$('#qrcode').html('').qrcode("Made By Shuttleu!");
					$("#qrtitle").html("FBI Ticket Installer");
					$("#qrsize").html("Made");
					$("#qrregion").html("By");
					$("#qrserial").html("Shuttleu!");
				} else {
					name = decodeURI($('#title-'+firstitem).data('name'));
					name = name.replace(/\+/g, ' '); //Replace perticular characters that dont get converted correctly
					name = name.replace(/\%3A/g, ':');
					name = name.replace(/\%26/g, '&');
					name = name.replace(/\%2B/g, '+');
					$("#qrtitle").html("Name: "+name);
					$("#qrregion").html("Region: "+$('#title-'+firstitem).data('region'));
					$("#qrserial").html("Serial: "+$('#title-'+firstitem).data('serial'));
				}
				$("html, body").animate({ scrollTop: 0 }, "slow");
			};
		</script>
	</head>
	<body>
		<div class="container-fluid">
			<div class="col-sm-3">
				<p id="qrcode"></p>
				<p id="qrtitle">FBI Ticket Installer</p>
				<p id="qrsize">Made</p>
				<p id="qrregion">By</p>
				<p id="qrserial">Shuttleu!</p>
			</div>
			<div class="col-sm-9">
				<form class="form">
					<div class="row">
						<div class="col-sm-3">
							<input type="text" class="form-control" name="filter" placeholder="Title Filter" value="<?php if (isset($_GET['filter'])) echo $_GET['filter'] ?>">
						</div>
						<div class="col-sm-3">
							<select id="region" class="form-control" name="region">
								<option>ALL</option>
								<option>EUR</option>
								<option>USA</option>
								<option>JPN</option>
							</select>
						</div>
						<div class="col-sm-3">
							<select id="type" class="form-control" name="type">
								<option value="all">ALL</option>
								<option value="eshop">eShop</option>
								<option value="update">Update</option>
								<option value="dlc">DLC</option>
								<option value="sapp">System Application</option>
								<option value="sda">System Data Archive</option>
								<option value="sapplet">System Applet</option>
								<option value="smod">System Module</option>
								<option value="sfirm">System firmware</option>
								<option value="down">Download Play Title</option>
								<option value="dsisa">DSIWare System Application</option>
								<option value="dsisda">DSIWare System Data Archive</option>
								<option value="dsiw">DSIWare</option>
								<option value="demo">Demo</option>
							</select>
						</div>
						<?php
							if (!empty($_GET['sort'])){
						?>
							<input type="hidden" name="sort" value="<?php echo $_GET['sort']; ?>">
						<?php
							}
						?>
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
							
							foreach($titlelist as $key => $row){ // Print out all titles that have not been removed by the filtering
						?>
						<tr id="title-<?php echo $key; ?>" data-name="<?php echo urlencode($row['name']); ?>" data-titleid="<?php echo urlencode($row['titleID']); ?>" data-region="<?php echo urlencode($row['region']); ?>" data-serial="<?php echo urlencode($row['serial']); ?>" data-size="<?php echo urlencode($row['size']); ?>" onclick="loadcode('<?php echo $key; ?>')">
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