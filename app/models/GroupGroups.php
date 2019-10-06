<?php

use Phalcon\Mvc\Model;

class GroupGroups extends Model
{
  public $group_id;
  public $group_subordinate_id;

  public function initialize()
   {
       $this->hasManyToMany(
           'id',
           'Groups',
           'group_id', 'group_subordinate_id',
           'Groups',
           'id'
       );
   }

}
