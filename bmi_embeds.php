<?php 

include("connect.php");



?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html_content; charset=utf-8">
<title>BMI Calculator</title>


<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/style.css"/>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

</head>

<body>

<div id="wrapper_large">

	
    <br>
    
    <ul class="nav nav-tabs">
      <li><a href="bmi_updates.php" data-toggle="tab">Usage</a></li>
      <li class="active"><a href="bmi_subscribers.php" data-toggle="tab">Subscribers</a></li>
      <li><a href="#messages" data-toggle="tab">Embeds</a></li>
    </ul>

    
	<h1>Subscribers</h1>
    
    <hr/>
    
    <table class="table table-bordered">
    
    		<tr style=" font-weight:bold;">
            	<td>Email</td>
                <td>Client</td>
                <td>Date</td>
            </tr>
            	
    <?php 
	
			$page = 1;
			
			if(isset($_GET['page']))
				$page = $_GET['page'];
		
			
			$rs_counter = mysql_fetch_array(mysql_query("select count(*) as total from `optins`"));	
			
			$records_per_page = 3;
			$offset = ($page - 1) * $records_per_page;		
			$total_pages = ceil($rs_counter['total'] / $records_per_page);
			
			
			$rs = mysql_query("select s.email, s.timestamp, w.url from `optins` as s, `websites` as w where s.client_id = w.client_id order by s.oid desc limit $offset, $records_per_page");
			
			
			while($row = mysql_fetch_array($rs))
			{	
	
			?>
            <tr>
            	<td><?php echo $row['email'];?></td>
                <td><?php echo $row['url'];?></td>
                <td><?php echo date("M d, Y",$row['timestamp']);?></td>
            </tr>
    
   		 	<?php 
		
			}
		?>

		</table>
        
        <ul class="pagination">
        	 <?php 
			 for($i=1;$i<$total_pages;$i++)
			 {
			 	?>
         	 	<li <?php if($page == $i) echo "class='active'";?>><a href="?page=<?php echo $i;?>" ><?php echo $i;?></a></li>
        		<?php 
			 }
			 ?>
        </ul>

        
</div>
</body>


</html>