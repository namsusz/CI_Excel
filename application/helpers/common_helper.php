<?php
defined('BASEPATH') or exit('No direct script access allowed');

function getAlert($text, $url)
{
    return print "<script language=javascript> alert('$text'); location.replace('$url'); </script>";
}

?>