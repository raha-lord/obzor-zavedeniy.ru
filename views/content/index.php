<?php
$score = '4-1';
$result = '10-10';

function surprise($score)
{
    $array = array();
    $array = str_split($score);
    $teamOne = '';
    $teamTwo = '';
    $c = 0;
    for($i= 0;$i<count($array);++$i)
    {
        if ($array[$i]=='-')
        {
           ++$c;
           $i++;
        }
        if ($c == 0)
            $teamOne = $teamOne.$array[$i];
        else if ($c == 1)
            $teamTwo = $teamTwo.$array[$i];
    }

    if ($teamOne>$teamTwo)
        return 1;
    else if ($teamOne<$teamTwo)
        return 2;
    else
        return 0;
}
function casino($score,$result)
{
    if ($score==$result)
        echo 'big';

}

//var_dump(surprise($score));
echo surprise($result);