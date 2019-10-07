<?php

use Phalcon\Mvc\Controller;

class EmployeeController extends Controller
{
    /**
     * Show employees list
     */
    public function indexAction($employee_id=null)
    {
      header('Access-Control-Allow-Origin: *'); //Not secure, but enough for this test scope
      $employees = Employees::find("group_id=".$this->request->getQuery('department_id', 'int'));
      $employees = $employees->toArray();
      for ($i=0; $i < count($employees); $i++) {
        $sub=EmployeeEmployees::findFirst("employee_id=".$employees[$i]['id']);
        if($sub){
          $employees[$i]['employee_boss_name']=Employees::findFirst("id=".$sub->employee_subordinate_id)->name;
        }
      }
      return json_encode($employees);
    }

    /**
     * Register new employee or update an existent one
     */
    public function saveAction($id=null)
    {
      header('Access-Control-Allow-Origin: *'); //Not secure, but enough for this test scope
      header("Access-Control-Allow-Methods: POST");

      if($id){
        $employee = Employees::findFirst("id=$id");
      }else{
        $employee = new Employees();
        $employee->group_id = $this->request->getQuery("department_id");
      }

      $employee->name = $this->request->getPost("name");
      $employee->surname = $this->request->getPost("surname");
      $employee->email = $this->request->getPost("email");
      $employee->address = $this->request->getPost("address");
      $employee->risk = $this->request->getPost("risk");

      if($success){
        $employee = EmployeeEmployees::findFirst("employee_id=$employee->id");
        if(!$employee){
          //no previous employee
          if($this->request->getPost("employee_boss_id")){
              //Create
              $employee = new EmployeeEmployees();
              $employee->employee_id=$employee->id;
              $employee->employee_subordinate_id=$this->request->getPost("employee_boss_id");
              $success = $employee->save();
          }
        }else{
          //Existent previous employee
          if($this->request->getPost("employee_boss_id")){
              //Update
              $employee->employee_id=$employee->id;
              $employee->employee_subordinate_id=$this->request->getPost("employee_boss_id");
              $success = $employee->save();
          }else{
            //remove
            $success = $employee->delete();
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
     * Delete employee
     */
    public function deleteAction($id=null)
    {
      header('Access-Control-Allow-Origin: *'); //Not secure, but enough for this test scope
      header("Access-Control-Allow-Methods: DELETE");

      $employee = Employees::findFirst($id);

      try {
        // Store and check for errors
        if ($employee){
          $success = $employee->delete();
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
