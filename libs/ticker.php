<?php
// List your stocks here, separated by commas, no spaces
$stocks = "COMB.N0000,DIAL.N0000,JKH.N0000,LLUB.N0000,LOLC.N0000,SAMP.N0000,TJL.N0000,TKYO.N0000";
foreach ( explode(",", $stocks) as $stock ) {
	// Open the file, load our values into an array...
	$local_file = fopen ("stockcache/summery.csv","r");
	fgetcsv($local_file);
	do {
	$stock_info = fgetcsv ($local_file, 1000, ",");
	$symbol = $stock_info[1];
	} while ($stock !== $symbol);
	// ...format, and output them.symbols into links to CSE's stock pages.
	echo "<span class=\"text-dark bg-transparent\"><a class=\"text-dark font-weight-bold\" href=\"https://www.cse.lk/home/company-info/".$stock_info[1]."/trade-summery\"  target=\"_blank\">".$stock_info[0]."</a> &nbsp;&#8360;&#8228;".sprintf("%.2f",$stock_info[8])." <span style=\"";
	// Green prices for up, red for down
	if ($stock_info[10]>0) { echo "color: #009900;\">&nbsp;&uArr;";	}
	elseif ($stock_info[10]<0) { echo "color: #ff0000;\">&nbsp;&dArr;"; }
	elseif ($stock_info[10]==0) { echo "color: #000000;\">&nbsp;&#8661;"; }
	echo sprintf("%.2f",abs($stock_info[10]))."&#37;</span></span>\n";
	echo "<span>&nbsp;&nbsp;&#9553;&nbsp;&nbsp;&nbsp;</span>";
	// Done!
	fclose($local_file); 
}
?>