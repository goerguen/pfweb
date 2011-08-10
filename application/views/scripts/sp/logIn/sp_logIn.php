<?php         
$this->title = "VM Web LogIn";
$this->headTitle($this->title);
?>
<table bgcolor="#EEEEEE" border="0" align="center" cellspacing="5px" width="100%" height="100%">
	<tr >
		<td align="center" height="40px" style="font-family:Verdana,sans-serif; font-style:bold; font-size:24px; color:#888888">
			VMWeb Anmeldung
			<br>
			<div style="font-size:18px;" >-Smartphone Edition-</div>
		</td>
	</tr>
	<tr>
		<?php if (empty($this->Meldung)) { ?>
			<td></td>
		<?php } else { ?>
	    	<td style="font-family:Verdana,sans-serif; font-size:18px; color:#FF0000" bordercolor="#FF0000" bgcolor="#FFCCCC">
	    		<?php  echo $this->Meldung; ?>
			</td>
		<?php } ?>
	</tr>
	<tr align="center" valign="top">
		<td style="font-family:Verdana,sans-serif; font-size:18px; color:#888888" align="center">
			<?php echo $this->form ; ?>
		</td>
	</tr>
</table>