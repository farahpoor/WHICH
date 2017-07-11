<?php
	include('./config.php');
		// sql to truncate table
		$sql = "truncate table file_md5";
		
		if ($conn->query($sql) === TRUE) {
			echo "Table Truncated";
			} else {
			echo "Error truncating table: " . $conn->error;
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



	$myarray=getDirContents($web_path, '/\.php$/');


	foreach ($myarray as $path) {
		$filename=basename($path);
		$md5_hash=md5_file($path,false);
		echo "file: " . $filename . "    md5: " . $md5_hash . "<br>";
		
		$sql = "INSERT INTO file_md5 (File_Name, Source_File_Path, MD5) VALUES ('$filename', '$path', '$md5_hash')";
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
			} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		
	}
$conn->close();
?>
