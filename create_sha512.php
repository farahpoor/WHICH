<?php
	include('./config.php');
		// sql to truncate table
		$sql = "truncate table file_sha512";
		
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
		$sha512_hash=hash('sha512', $path);
		echo "file: " . $filename . "    sha512: " . $sha512_hash . "<br>";
		
		$sql = "INSERT INTO file_sha512 (File_Name, Source_File_Path, sha512) VALUES ('$filename', '$path', '$sha512_hash')";
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
			} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		
	}
$conn->close();
?>
