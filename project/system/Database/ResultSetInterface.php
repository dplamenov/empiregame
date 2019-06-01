<?php

namespace Database;


interface ResultSetInterface
{
    public function fetch($className): \Generator;
    public function getOne($className);
}