<?php
	require_once("../.admin/class.manager.php");
	$manager = new manager();
	$messages = $manager->getMsg();
	
?>
	<table border="1" cellpadding="5">
		<?php
	foreach($messages as $message){
		echo "<tr><td>".$message['expediteur']."</td><td>".html_entity_decode($message['contenu'])."</td><td>".$message['date_message']."</td></tr>";
	}
?>
	</table>