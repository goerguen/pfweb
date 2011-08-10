<?php         
$this->title = "VM Web LogIn";
$this->headTitle($this->title);
?>

<br><br><br>

<table bgcolor="#EEEEEE" border="0" align="center" cellspacing="5px" >
  <tr >
  	<td>
		<table bgcolor="#DDDDDD" border="0" cellspacing="5px" >
			<tr >
				<td align="center" height="40px" style="font-family:Verdana,sans-serif; font-style:bold; font-size:20px; color:#888888">
			  		VMWeb Anmeldung
			  	</td>
			  </tr>
			  <tr>
			  	<td>
					<table bgcolor="#EEEEEE" border="0" cellspacing="5px">
					  <tr valign="top">
					  	<td align="center" width="200px">
					  		<br>
					  		<div style="font-family:Verdana,sans-serif; font-size:14px; color:#888888">
					  			GK Consulting &amp; <br> &Ouml;zcelik IT <br> pr&auml;sentieren:
					  		</div> 
					  		<br>
					  		<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/vmweb/public/images/VM-Logo.jpg" alt="VM Logo" border="none"> 
					  		<br>
					  		<div style="font-family:Verdana,sans-serif; font-size:11px; color:#888888">
					  			Budapester Str. 49 <br> 20359 Hamburg <br> Tel.: 040 / 43 21 67 411 <br> Fax: 040 / 600 84 32 8
					  		</div> 
					  		<br>
					  		<div style="font-family:Verdana,sans-serif; font-size:11px; color:#888888">
					  			<a href="http://www.gk-consulting.org">www.gk-consulting.org</a> <br> <a href="http://www.erhano.eu">www.erhano.eu</a>
					  		</div>
					  	</td>
					  	<td bgcolor="#DDDDDD" width="1px"></td>  
					    <td width="200px">
							<table bgcolor="#EEEEEE" border="0" cellspacing="5px">
							  <tr>
							    <th>
							    	<br>
							    	<img src="http://<?php echo $_SERVER['SERVER_NAME'];?>/vmweb/public/images/VM-Logo.jpg" alt="VM Logo" border="none">
								</th>
							  </tr>
							  <?php if (empty($this->Meldung)) {?>
							  	  <tr></tr>
							  <?php } else { ?>
								  <tr >
								    <td style="font-family:Verdana,sans-serif; font-size:14px; color:#FF0000" bordercolor="#FF0000" bgcolor="#FFCCCC">
								    	<?php  echo $this->Meldung; ?>
									</td>
								  </tr>
							  <?php } ?>
							  <tr align="center">
							    <td style="font-family:Verdana,sans-serif; font-size:14px; color:#888888" align="center">
							  		<?php echo $this->form ; ?>
							  	</td>
							  </tr>
							</table>
						</td>	 
					  </tr>
					</table>
				</td>
			   </tr>
			</table>
		</td>
	</tr>
</table>