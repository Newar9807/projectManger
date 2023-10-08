<?php
function word_limiter($str, $limit = 12)
{
    if (strlen($str) > $limit) :
        $retVal = "";
        $str_s = str_split($str, 1);
        foreach ($str_s as $value) :
            $retVal .= $value;
            if (strlen($retVal) >= $limit) :
                break;
            endif;
        endforeach;
        return $retVal."..";
    else :
        return $str;
    endif;
}
// echo word_limiter('Hellya!!! this function really works nice for me.', 4)."..";
