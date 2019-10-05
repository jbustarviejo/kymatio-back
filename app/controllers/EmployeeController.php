<?php

use Phalcon\Mvc\Controller;

class EmployeeController extends Controller
{
    /**
     * Show form to register a new employee
     */
    public function indexAction()
    {
    }

    /**
     * Register new employee and show message
     */
    public function registerAction()
    {
        $employee = new Employees();

        // Store and check for errors
        $success = $employee->save(
            $this->request->getPost(),
            ['name', 'email']
        );

        // passing the result to the view
        $this->view->success = $success;

        if ($success) {
            $message = "Thanks for registering!";
        } else {
            $message = "Sorry, the following problems were generated:<br>" . implode('<br>', $employee->getMessages());
        }

        // passing a message to the view
        $this->view->message = $message;
    }
}
