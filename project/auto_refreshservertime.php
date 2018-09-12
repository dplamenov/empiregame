<?php
date_default_timezone_set('Europe/Sofia');
function getTimeInFormat(string $format, int $time): string
{
    return date($format, $time);
}

echo getTimeInFormat("d.m.Y H:i:s", time());