<?php

class IndexController extends Controller {
    
    public function IndexAction() {
        $this->setTitle("Test shop");
     
        Helper::redirect('/comment/comment');
         
    }

}