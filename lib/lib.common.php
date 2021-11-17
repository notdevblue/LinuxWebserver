<?php


$_PW = "hhwy1203";

	function p()
	{
		$args = func_get_args();
		echo "<div align='left'><pre>= RESULT = \n";
	
		if(is_array($args))
		{
			$i = 0;
			foreach($args as $tgt)
			{
				echo "[param:" . (++$i) . "]\n";
				print_r($tgt);
				echo "\n";
			}
		}
		echo "</pre></div>";
	}

	function pe()
	{
		$args = func_get_args();
		echo "<div align='left'><pre>= RESULT = \n";

		if (is_array($args)) {
			$i = 0;
			foreach ($args as $tgt) {
				echo "[param:" . (++$i) . "]\n";
				print_r($tgt);
				echo "\n";
			}
		}
		echo "</pre></div>";
		exit;
	}

	function setCode($length = 10, $characters = "12356abdkkygnp")
	{
		#random code
		$ran_code = "";
		$i = 0;
		while($i < $length)
		{
			$char = substr($characters, mt_rand(0, strlen($characters) -1), 1);
			$ran_code .= $char;
			++$i;
		}
		return $ran_code;
	}

	function is_rendCode($array)
	{
		$isFlag = true;
		$ret_code = setCode();
		while($isFlag) {
			if(!in_array($ret_code, $array))
			{
				array_push($array,$ret_code);
				$isFlag = false;
			}
		}
		return $array;
	}


	function db_query($query, $msg = "error")
	{
		global $_PW;

		$dbo = mysqli_connect("localhost", "HanUseArch", $_PW, "Class_10011");
		$ret = mysqli_query($dbo, $query) or die($msg);
		mysqli_close($dbo);
		return $ret;
	}

?>