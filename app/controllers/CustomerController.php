<?php
class CustomerController extends Controller {

        public function loginAction() {
            
           
  

        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
            $email = filter_input(INPUT_POST, 'name');
            $password = filter_input(INPUT_POST, 'password');
 
            if($email != " " && $password != " "){
                
                $params =array (
                    'name'=>$email,
                    'password'=> md5($password)
                );
                $customer = $this->getModel('customer')->initCollection()
                        ->filter($params)
                        ->getCollection()
                        ->selectFirst();
                if(!empty($customer)) {
                 $_SESSION['id'] = $customer['id'];
                    Helper::redirect('/index/index');
                }
            }
        }
       $this->setView();
        $this->renderLayout();
    }
    public function LogoutAction() {
        
        $_SESSION = [];

       

        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 3600, "/");
        }

        session_destroy();
        Helper::redirect('/index/index');
    }
}