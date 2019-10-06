<?php

use Phalcon\Mvc\Model;

class EmployeeEmployees extends Model
{
  public $employee_id;
  public $employee_subordinate_id;

  public function initialize()
   {
       $this->hasManyToMany(
           'id',
           'Employees',
           'employee_id', 'employee_subordinate_id',
           'Employees',
           'id'
       );
   }
}
