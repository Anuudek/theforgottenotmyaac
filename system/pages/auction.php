<?PHP
$title = 'Auction';
$jogador = 0;
	   
function actionsOfertas() {
	global $db, $config;

	$auctions = $db->query('SELECT `auction_system`.`player`, `auction_system`.`id`, `auction_system`.`item_name`, `auction_system`.`item_id`, `auction_system`.`count`, `auction_system`.`cost`, `auction_system`.`date`, `players`.`name` FROM `auction_system`, `players` WHERE `players`.`id` = `auction_system`.`player` ORDER BY `auction_system`.`id` DESC')->fetchAll();
	return $auctions;
}
    echo'<br><img src="/dbofalcon/images/auction/auction.png"><br><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>
    		<TR background="/images/auction/bg1_06.png" style="text-align: center;">
    			<TD CLASS=white><b>Instructions<b></TD>
    		</TR>
    		<TR bgcolor="#F4A460">
    			<TD>
    				<center>
	    				<h2>Commands</h2>
	    				<b>!offer_gold add, itemName, itemPrice, itemCount</b><br/>
	    				<small>
	    					Example: !offer_gold add, plate armor, 500, 1
	    				</small><br/>
	    				<br/>
	    				<b>!offer_gold buy, AuctionID</b>
	    				<br/>
	    				<small>
	    					Example: !offer_gold buy, 1943
	    				</small>
	    				<br/>
	    				<br/>
	    				<b>!offer_gold remove, AuctionID</b>
	    				<br/>
	    				<small>
	    					Example: !offer_gold remove, 1943
	    				</small>
	    				<br/>
	    				<br/>
	    				<b>!offer_gold withdraw</b>
	    				<br/>
	    				<small>Use this command to get money from items sold.</small>
    				</center>
    			</TD>
    		</TR>
		</TABLE><br/>';
    echo '<TABLE BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH=100%>
    		<TR background="/images/auction/bg1_06.png">
    			<TD CLASS=white><b><center>ID</center></b></TD>
    			<TD class="white"><b><center>#</center></b></TD>
    			<TD class="white"><b><center>Item Name</center></b></TD>
    			<TD class="white"><b><center>Player</center></b></TD>
    			<TD class="white"><b><center>Amount</center></b></TD>
    			<TD class="white"><b><center>Price</center></b></td>
    			<TD class="white"><b><center>Buy</center></b></td>
    		</TR>';
    foreach(actionsOfertas() as $auction) {
        $jogador++;
        if(is_int($jogador / 2))
            $bgcolor = $config['site']['lightborder'];
        else
            $bgcolor = $config['site']['darkborder'];
        $cost = round($auction['cost']/1000, 2);
        $cost2 = round($auction['cost']/10, 2);
        echo '<TR bgcolor="#F4A460">
        		<TD><center>'.$auction['id'].'</center></TD>
        		<TD><center><img src="' . $config['item_images_url'] . $auction['item_id'].'.png"/></center></TD>
        		<TD><center>'.$auction['item_name'].'</center></TD>
        		<TD><center><a href="?subtopic=characters&name='.urlencode($auction['name']).'">'.$auction['name'].'</a></center></TD>
        		<TD><center>'.$auction['count'].'</center></TD>
        		<TD><center>'.$cost.' gold<br /><small>'.$cost2.' dollar</small></center></TD>
        		<TD><center>!offer_gold buy, '.$auction['id'].'</center></td>
        	</TR>';
    }
    echo '</table><br /><p align="center"><center><small>System developed by <a href="http://www.fcgames.com.br/">Falcon Games</a>.</small></center></p>';
?> 