<?php
	// Log File
	function errorLog($preFix = "log", $msg = "no message", $levelType)
	{

		$levelMsg = "";

		switch ($levelType) {
			case 0:
				$levelMsg = "DEBUG";
				break;

			case 1:
				$levelMsg = "WARNING";
				break;

			case 2:
				$levelMsg = "FATAL";
				break;
		}

		if (is_array($msg)) {
			$msg = serialize($msg); // 직열화로
			// $msg = unserialize($msg); // 다시 배열로
		}


		// prefix : log_11_23.log 중 "log"

		$logFile = LOG_DIR . "/" . $preFix . "_" . date("Ymd") . ".log";

		if (is_writeable(LOG_DIR)) {
			return error_log($msg, 3, $logFile);
		} else {
			// return error(LOG_DIR . "is not writable");
		}
	}


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