<?php

use Phalcon\Mvc\Controller;

class CompanyController extends Controller
{
    /**
     * Show companies list
     */
    public function indexAction()
    {
      header('Access-Control-Allow-Origin: *'); //Not secure, but enough for this test scope
      $companies = Companies::find();
      return json_encode($companies);

    }

    /**
     * Register new company or update an existent one
     */
    public function saveAction($id=null)
    {
      header('Access-Control-Allow-Origin: *'); //Not secure, but enough for this test scope
      header("Access-Control-Allow-Methods: POST");

      if($id){
        $company = Companies::findFirst("id=$id");
      }else{
        $company = new Companies();
      }
      
      try {
        // Store and check for errors
        $success = $company->save(
            $this->request->getPost(),
            ['name', 'cif', 'address']
        );
      } catch (\Exception $e) {
        $success = false;
      }

      if ($success) {
          return json_encode(["ok"=>true]);
      } else {
          return json_encode(["ok"=>false]);
      }
    }

    /**
     * Delete company
     */
    public function deleteAction($id=null)
    {
      header('Access-Control-Allow-Origin: *'); //Not secure, but enough for this test scope
      header("Access-Control-Allow-Methods: DELETE");

      $company = Companies::findFirstById($id);

      try {
        // Store and check for errors
        if ($company){
          $success = $company->delete();
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
