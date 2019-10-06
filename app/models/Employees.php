<?php

use Phalcon\Mvc\Model;

class Employees extends Model
{
    public $id;
    public $name;
    public $surname;
    public $email;
    public $address;
    public $risk;
    public $group_id;
}
