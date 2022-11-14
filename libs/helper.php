<?php
function get_date($time)
{
    return date("H:i d/m/Y", strtotime($time));
}