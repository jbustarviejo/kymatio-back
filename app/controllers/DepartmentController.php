<?php

use Phalcon\Mvc\Controller;

class DepartmentController extends Controller
{
    /**
     * Show departments list
     */
    public function indexAction($department_id=null)
    {
      header('Access-Control-Allow-Origin: *'); //Not secure, but enough for this test scope
      $departments = Groups::find("company_id=".$this->request->getQuery('company_id', 'int'));
      $departments = $departments->toArray();
      for ($i=0; $i < count($departments); $i++) {
        $sub=GroupGroups::findFirst("group_id=".$departments[$i]['id']);
        $departments[$i]['risk']=$this->calculateTotalRisk($departments[$i]['id']);
        if($sub){
          $departments[$i]['group_mother_name']=Groups::findFirst("id=".$sub->group_subordinate_id)->name;
        }
      }
      return json_encode($departments);
    }

    /**
    * Calculate total risk of a department based on its employees
    */
    public function calculateTotalRisk($group_id){
      $value = $this->db->query('SELECT SUM(risk) as total_risk FROM employees WHERE group_id='.$group_id)->fetchAll()[0][0];
      return $value ? $value : 0;
    }

    /**
     * Register new department or update an existent one
     */
    public function saveAction($id=null)
    {
      header('Access-Control-Allow-Origin: *'); //Not secure, but enough for this test scope
      header("Access-Control-Allow-Methods: POST");

      if($id){
        $department = Groups::findFirst("id=$id");
      }else{
        $department = new Groups();
        $department->company_id = $this->request->getQuery("company_id");
      }
      $department->type = $this->request->getPost("type");
      $department->name = $this->request->getPost("name");
      $success=$department->save();

      if($success){
        $group = GroupGroups::findFirst("group_id=$department->id");
        if(!$group){
          //no previous group
          if($this->request->getPost("group_mother_id")){
              //Create
              $group = new GroupGroups();
              $group->group_id=$department->id;
              $group->group_subordinate_id=$this->request->getPost("group_mother_id");
              $success = $group->save();
          }
        }else{
          //Existent previous group
          if($this->request->getPost("group_mother_id")){
              //Update
              $group->group_id=$department->id;
              $group->group_subordinate_id=$this->request->getPost("group_mother_id");
              $success = $group->save();
          }else{
            //remove
            $success = $group->delete();
          }
        }
      }

      if ($success) {
          return json_encode(["ok"=>true]);
      } else {
          return json_encode(["ok"=>false]);
      }
    }

    /**
     * Delete department
     */
    public function deleteAction($id=null)
    {
      header('Access-Control-Allow-Origin: *'); //Not secure, but enough for this test scope
      header("Access-Control-Allow-Methods: DELETE");

      $department = Groups::findFirst($id);

      try {
        // Store and check for errors
        if ($department){
          $success = $department->delete();
        }else{
          $success=false;
        }
      } catch (\Exception $e) {
        $success = false;
      }

      if ($success) {
          return json_encode(["ok"=>true]);
      } else {
          return json_encode(["ok"=>false]);
      }
    }
}
