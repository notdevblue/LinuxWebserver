<?php
require "init.php";
$libraries = new FilesystemIterator('lib');
foreach($libraries as $fileInfo) {
    require($fileInfo->getFilename()); # 원석이 코드 빼껴오기
}

// $db = new mysql("localhost", $id, $password, "study_db");



?>