<?php

	// Get all of something
	function getAll($tbl){
		include('connect.php');
    $queryAll = "SELECT * FROM {$tbl}"; //$tbl is a varirable that can be switch to  so this function can do and table we choose, instead of hardcoding a different  one.
		$runAll = mysqli_query($link, $queryAll);
		if($runAll){
			return $runAll;
		}else{
			$error = "There was an error accessing this information. Please contact your admin.";
			return $error;
		}
		mysqli_close($link); //closes the include
	}

  function getSingle($tbl, $col, $id){
		include('connect.php');
    $querySingle = "SELECT * FROM {$tbl} WHERE {$col} = {$id}";
		$runSingle = mysqli_query($link, $querySingle);
		if($runSingle){
			return $runSingle;
		}else{
			$error = "There was an error accessing this information. Please contact your admin.";
			return $error;
		}
		mysqli_close($link);
	}

	function filterType($tbl, $tbl2, $tbl3, $col, $col2, $col3, $filter) {
		include('connect.php');

		$queryFilter = "SELECT * FROM {$tbl}, {$tbl2}, {$tbl3} WHERE {$tbl}.{$col} = {$tbl3}.{$col} AND {$tbl2}.{$col2} = {$tbl3}.{$col2} AND {$tbl2}.{$col3} = '{$filter}'";
		//echo $queryFilter;
		$runFilter = mysqli_query($link, $queryFilter);

		if($runFilter){
			return $runFilter;
		}else{
			$error = "There was an error accessing this information. Please contact your admin.";
			return $error;
		}
		mysqli_close($link);

	}


?>
