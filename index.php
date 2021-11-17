<?php

echo "<h2>커피</h2><h6>마시려면 아치 리눅스를</h6>";
echo "<h5>I use arch btw</h5>";
echo "<h5>방명록 만들어지는 중입니다.</h5>";

?>


<html>

<body>
	<form action="addWordToDB.php", method="POST">
		<div>
			남길 말<br>
			<input type="text" , name="leftword"><br>
			남길 이름<br>
			<input type="text" , name="leftname"><br>
			<input type="submit" value="남기기">
		</div>
	</form>
</body>

</html>