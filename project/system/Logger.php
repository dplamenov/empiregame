<?php

namespace system;
class Logger extends Base
{

    private static $insance = null;
    private $logfile = "";

    private function __construct($logfile)
    {
        file_put_contents($logfile, "Charstet: " . mb_internal_encoding() . PHP_EOL, FILE_APPEND);
    }

    public static function getInstance($logfile)
    {
        if (self::$insance == null) {
            self::$insance = new self($logfile);
        }
        return self::$insance;
    }
}
