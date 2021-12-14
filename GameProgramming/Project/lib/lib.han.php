<?PHP


// while() 아닌 _while();
function _while($functionCallback, $booleanCallback, $no_count_exeception = false)
{
    $count = 0;

    begin:
    if ($booleanCallback()) goto start;
    else return;

    start:
    ++$count;
    if(!$no_count_exeception && $count > 10000) {
        echo "lib.han.php > _while(): ERR WHILE LOOP";
        exit();
    }
    $functionCallback();

    goto begin;
}

// for() 아닌 _repeat();
function _repeat($count, $callback)
{
    $i = 0;

    loop:
    if($i >= $count) return;
    ++$i;
    $callback();

    goto loop;
}

?>