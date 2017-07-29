<?php

switch ($link_type) {
case 1:
    $link_type_name = 'Design Guideline';
    break;
case 2:
    $link_type_name = 'Project Goal';
    break;
case 3:
    $link_type_name = 'Project Constraint';
    break;
case 4:
    $link_type_name = 'Reported Issue';
    break;
case 5:
    $link_type_name = 'Example';
    break;
default: 
	$link_type_name = 'General';
}

?>
{{$link_type_name}}