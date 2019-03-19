<?php

class CommentController extends Controller {
   
    public function commentAction() {
        if($this->getSort()){
			if($this->getSort() == 'checkbox'){
				$sortParams = array(
					'checkbox' => 'DESC'
					);
			}else{
				$sort = $this->getSort();
				$sortParams = array($sort => 'ASC');
			}
          var_dump($sortParams);
            $this->registry['comment'] = $this->getModel('comment')->initCollection()
                     ->sort(array($sortParams))->getCollection()->select();
        } else {
                    $this->registry['comment'] = $this->getModel('comment')->initCollection()
               ->getCollection()->select();
        }
        


        $this->setView();
        $this->renderLayout();
    }


    public function editAction() {
        $model = $this->getModel('Comment');
        $id = filter_input(INPUT_POST, 'id');
        if ($id) {
            $values = $model->getPostValues();
            $model->saveItem($id,$values); 
            }
        $this->commentAction();
    }

    public function addAction(){
        $upload_dir = "img";
        
        if (isset($_FILES['picture'])) {
            if($_FILES['picture']['type'] == 'image/jpeg' || $_FILES['picture']['type'] == 'image/gif' || $_FILES['picture']['type'] == 'image/png'){

                $filename = $_FILES['picture']['name'];
                $latin = $this->translit($filename);

                $tmp_filename = $_FILES['picture']['tmp_name'];

                move_uploaded_file($tmp_filename, "$upload_dir/original/$latin"); 


                $this->image_resize("$upload_dir/original/$latin", "$upload_dir/$latin", 300, 240, TRUE);

                 unlink("$upload_dir/original/$latin");
            }
            else {
                $latin = ' ';
            }

        }
        $model = $this->getModel('Comment');
        
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
            $values = $model->getPostValues();
          
            if ($values){ 
                if (isset($values['name']) && isset($values['email']) && isset($values['text'])){
                   
                    $values['img'] = $latin;
                    $model->addItem($values);
                }
            }
           $this->commentAction();
        }
        else{
           $this->commentAction();
        }
    }

    


    public function getSort() {

        return filter_input(INPUT_GET, 'sort');
    }
    
    public function image_resize(
    $source_path, 
    $destination_path, 
    $newwidth,
    $newheight = FALSE, 
    $quality = FALSE 
    ) {

        ini_set("gd.jpeg_ignore_warning", 1);

        list($oldwidth, $oldheight, $type) = getimagesize($source_path);

            switch ($type) {
                case IMAGETYPE_JPEG: $typestr = 'jpeg'; break;
                case IMAGETYPE_GIF: $typestr = 'gif' ;break;
                case IMAGETYPE_PNG: $typestr = 'png'; break;
            }
            $function = "imagecreatefrom$typestr";
            $src_resource = $function($source_path);

            if (!$newheight) { $newheight = round($newwidth * $oldheight/$oldwidth); }
            elseif (!$newwidth) { $newwidth = round($newheight * $oldwidth/$oldheight); }
            $destination_resource = imagecreatetruecolor($newwidth,$newheight);

            imagecopyresampled($destination_resource, $src_resource, 0, 0, 0, 0, $newwidth, $newheight, $oldwidth, $oldheight);

            if ($type = 2) { 
                imageinterlace($destination_resource, 1); 
                imagejpeg($destination_resource, $destination_path, $quality);      
            }
            else { 
                $function = "image$typestr";
                $function($destination_resource, $destination_path);
            }

            imagedestroy($destination_resource);
            imagedestroy($src_resource);
    }
    
    public function translit($s) {
        $s = (string) $s; 
        $s = strip_tags($s); 
        $s = str_replace(array("\n", "\r"), " ", $s); 
        $s = preg_replace("/\s+/", ' ', $s); 
        $s = trim($s);
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s);
        $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>''));
        $s = preg_replace("/[^0-9a-z-_ \.]/i", "", $s); 
        $s = str_replace(" ", "-", $s); 
        return $s; 
    }
}