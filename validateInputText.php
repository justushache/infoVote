<?php
    function removeCriticalText($text){
        $toReplace = array(";", "<", ">", "/", "\\", "*", "\"", "'", "=");
        //removes given characters or text passages to prevent sql injections ore executable html code
        foreach($toReplace as $replace){
            $text = str_replace($replace, "", $text);
        }
        //echo "removed critical text"; //for debug only
        return $text;
    }
?>