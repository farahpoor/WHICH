<?php
	include('./config.php');
	
	$row_count=1;
	$problem_array=[[]];
	$problem_counter=0;  
	$problem_flag=false; //by default is false if there is no problem and will be true if can find problem
	$nf=0;  //nt means not found
	$nm=0;  //nm means not match
	$np=0;  //no problem(OK)
	function send_email($from,$to,$getSubject,$getmessage)
    {
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .="From:$from\r\n";
		$headers .="Return-Path:$to\r\n";
		$headers .= "X-Mailer: Simply Mailer\n";
		$headers .= "X-Priority: 1 (Highest)\n";
		$headers .= "X-MSMail-Priority: High\n";
		$headers .= "Importance: High\n";
		$message="
		<html>
		<body>
		$getmessage
		</body>
		</html>
		";
		mail($to, $getSubject, $getmessage,$headers);
		if(mail)
		{
			echo "Mail has been sent to $to<br>";
		}
		else {
			echo 'Please try again';
		}
	}
	
	function getDirContents($dir, $filter = '', &$results = array()) {
		$files = scandir($dir);
		
		foreach($files as $key => $value){
			$path = realpath($dir.DIRECTORY_SEPARATOR.$value); 
			
			if(!is_dir($path)) {
				if(empty($filter) || preg_match($filter, $path)) $results[] = $path;
				} elseif($value != "." && $value != "..") {
				getDirContents($path, $filter, $results);
			}
		}
		
		return $results;
	} 
	
	$result_array=getDirContents($web_path, '/\.php$/');
	
	echo "<table border='1'><tr><td>Row</td><td>File Name</td><td>Path</td><td>sha512 Hash</td><td>Status</td></tr>";
	foreach ($result_array as $path) {
		$filename=basename($path);
		$sha512_hash=hash_file('sha512', $path,false);		
		echo "<tr><td>" . $row_count . "</td><td>" . $filename . "</td><td>".$path ."</td><td>" . $sha512_hash . "</td>";
		
		$sql = "SELECT * FROM file_sha512 WHERE Source_File_Path='$path'";		
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				if($row['sha512']==$sha512_hash) {echo "<td><div style='color: #00cc66'>OK</div></td>"; $np++;}
				else {echo "<td><div style='color: red'>sha512 not matches!</div></td>"; $nm++; $problem_array[$problem_counter][0]=$path;$problem_array[$problem_counter][1]="sha512 Not Match";$problem_counter++;$flag=true;}
			}
		}
		else{ echo "<td><div style='color: #ff9900'>File Not found in the Database!</div></td></tr>"; $nf++; $problem_array[$problem_counter][0]=$path;$problem_array[$problem_counter][1]="File not found";$problem_counter++;$flag=true;}
		$row_count++;
	}
	echo "</table>";
	echo "<center><table style='width:50%'><tr><td>OK</td><td>Not match</td><td>Not found</td><tr>";
	echo "<tr><td>".$np."</td><td>".$nm."</td><td>".$nf."</td></tr>";
	echo "</table></center>";
	for($i=0;$i<$problem_counter;$i++)
	{
		$message=$message . "File Path: " . $problem_array[$i][0] . " Status: " . $problem_array[$i][1] ."<br>"; 
	}
	if($flag==true) {send_email($from,$to,$subject,$message);}
	$conn->close();
	
?>
