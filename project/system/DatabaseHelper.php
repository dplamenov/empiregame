<?php
namespace system;

class DatabaseHelper
{
    private static $instance = null;

    private $database = array();
    private $database_instance;

    private function __construct($host, $username, $password, $name, $port)
    {
        $this->database['host'] = trim($host);
        $this->database['username'] = trim($username);
        $this->database['password'] = trim($password);
        $this->database['name'] = trim($name);
        $this->database['port'] = trim($port);

        $this->database_instance = new \mysqli($this->database['host'], $this->database['username'], $this->database['password'], $this->database['name'], $this->database['port']);
        $this->setCharset("utf8");
    }

    public static function getInstance(string $host, string $username, string $password, string $name, int $port = 3306)
    {
        if (self::$instance == null) {
            self::$instance = new self($host, $username, $password, $name, $port);
        }
        return self::$instance;
    }

    public function setCharset($charset)
    {
        $this->database_instance->set_charset($charset);
    }

    public function runRawQuery($sql)
    {
        return $this->runRawQuery_($sql);
    }

    private function runRawQuery_($sql)
    {
        return $this->database_instance->query(trim($sql));
    }
}