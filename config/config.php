<?php
define( "BASE_URL", "/my-project/");
define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"] . "/my-project/");

function split_name($name) {
    $parts = array();

    while ( strlen( trim($name)) > 0 ) {
        $name = trim($name);
        $string = preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $parts[] = $string;
        $name = trim( preg_replace('#'.$string.'#', '', $name ) );
    }

    if (empty($parts)) {
        return false;
    }

    $parts = array_reverse($parts);
    $name = array();
    $name['first_name'] = $parts[0];
    $name['middle_name'] = (isset($parts[2])) ? $parts[1] : '';
    $name['last_name'] = (isset($parts[2])) ? $parts[2] : ( isset($parts[1]) ? $parts[1] : '');

    return $name;
}

function split_article_name($name){
    $parts = explode(", ", $name);

// After you have the parts, pop the last one as $lastname:

$first_name = array_pop($parts);

// Finally, implode back the rest of the array as your $firstname:

$last_name = implode(" ", $parts);
return array("first_name"=> $first_name,"last_name" => $last_name);
}


