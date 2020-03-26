<?php
    function isLower($char){
        return ($char >= "a" AND $char <= "z"); 
    }
    function isLetter($char){
        return ($char >= "a" AND $char <= "z") OR ($char >= "A" AND $char <= "Z");
    }
    function getArrayLength(array $array){
        $i = 0;
        foreach ($array as $value) {
            $i++;
        }
        return $i;
    }
    function getStringlength(string $string){
        $j = 0;
        for ($i=0; isset($string[$i]) ; $i++) { 
            $j++;
        }
        return $j;
    }
    function getLength($array){
        if(gettype($array) === "array"){
            return getArrayLength($array);
        }
        elseif (gettype($array) === "string") {
            return getStringlength($array);
        }
    }
    function stringToArray(string $string){
        $array = [];
        $length = getStringlength($string);
        for ($i=0; $i < $length; $i++) { 
            $array[] = $string[$i];
        }
        return $array;
    }
    function arrayToString(array $array){
        $string = "";
        foreach ($array as $value) {
            $string .= $value;
        }
        return $string;
    }
    function arrayString($arg){
        if(gettype($arg) == "array"){
            return arrayToString($arg);
        }elseif (gettype($arg) == "string") {
            return stringToArray($arg);
        }
    }
    function isInArray(array $array,$elt){
        $length = getArrayLength($array);
        $index = -1;
        for ($i=0; $i < $length; $i++) { 
            if($array[$i] == $elt){
                $index = $i;
                return $index;
            }
        }
        return $index;
    }
    function isInString(string $string,$elt){
        $length = getStringlength($string);
        $index = -1;
        for ($i=0; $i < $length; $i++) { 
            if ($string[$i] == $elt) {
                $index = $i;
                return $index;
            }
        }
        return $index;
    }
    function isIn($conatainer,$elt){
        if(gettype($conatainer) == "array"){
            return isInArray($conatainer,$elt);
        }elseif (gettype($conatainer) == "string") {
            return isInString($conatainer,$elt);
        }
    }
    function toUpper($char){
        if(isLetter($char)){
            $alphabet = [
                'a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'D', 'e' => 'E',
                'f' => 'F', 'g' => 'G', 'h' => 'H', 'i' => 'I', 'j' => 'J',
                'k' => 'K', 'l' => 'L', 'm' => 'M', 'n' => 'N', 'o' => 'O',
                'p' => 'P', 'q' => 'Q', 'r' => 'R', 's' => 'S', 't' => 'T', 
                'u' => 'U', 'v' => 'V', 'w' => 'W', 'x' => 'X', 'y' => 'Y',
                'z' => 'Z'
            ];
            foreach ($alphabet as $lowerCase => $upperCase) {
                if($lowerCase == $char){
                    $char = $upperCase;
                    return $char;
                }
            }
        }
        return $char;
    }
    function toLower($char){
        if(isLetter($char)){
            $alphabet = [
                'a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'D', 'e' => 'E',
                'f' => 'F', 'g' => 'G', 'h' => 'H', 'i' => 'I', 'j' => 'J',
                'k' => 'K', 'l' => 'L', 'm' => 'M', 'n' => 'N', 'o' => 'O',
                'p' => 'P', 'q' => 'Q', 'r' => 'R', 's' => 'S', 't' => 'T', 
                'u' => 'U', 'v' => 'V', 'w' => 'W', 'x' => 'X', 'y' => 'Y',
                'z' => 'Z'
            ];
            foreach ($alphabet as $lowerCase => $upperCase) {
                if($upperCase == $char){
                    $char = $lowerCase;
                    return $char;
                }
            }
        }
        return $char;
    }
    function toUpperString(string $string){
        $length = getStringlength($string);
        $result = "";
        for ($i=0; $i < $length ; $i++) { 
            $result .= toUpper($string[$i]);
        }
        return $result;
    }
    function toLowerString(string $string){
        $length = getStringlength($string);
        $result = "";
        for ($i=0; $i < $length ; $i++) { 
            $result .= toLower($string[$i]);
        }
        return $result;
    }
    function isthisStringValide(string $string){
        $accent = "àâçéèêëîïôùûüÿŸÜÛÙÔÏÎËÊÈÉÇÂÀ";
        $length = getStringlength($string);
        for ($i=0; $i < $length; $i++) { 
            if(!(isLetter($string[$i]) || $string[$i] == "-" || isIn($accent,$string[$i])>=0)){
                return false;
            }
        }
        return true;
    }
    function howManyAccent(string $string){
        $accent = "àâçéèêëîïôùûüÿŸÜÛÙÔÏÎËÊÈÉÇÂÀ";
        $length = getStringlength($string);
        $number = 0;
        for ($i=0; $i < $length; $i++) { 
            if(isIn($accent,$string[$i])>=0){
                $number++;
            }
        }
        return $number/2;
    }
?>