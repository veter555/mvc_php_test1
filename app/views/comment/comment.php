<?php  $customer = Helper::getCustomer();
if($customer['name'] != 'admin'): ?>
    <form method="POST" name="sort" action="<?php $_SERVER['PHP_SELF']; ?>">
        <div class="form-group"> 
            Сортировка по:
               <?php echo Helper::simpleLink('', 'Имени',array('sort'=>'name')); ?>
               <?php echo Helper::simpleLink('', 'Email',array('sort'=>'email')); ?>
               <?php echo Helper::simpleLink('', 'Статусу',array('sort'=>'checkbox')); ?>
        </div>
    </form>
<?php  endif;?>

<?php
$products =  $this->registry['comment'];

foreach($products as $product):?>
    <div class="col-xs-12 col-sm-9">
        <div class="jumbotron" style="height: 400px;">
        <?php if($product['checkbox'] == 1):?>
            <p style=" color: #00FF00;">Подтвержден</p>
            <p >Имя: <?php echo $product['name']?></p>
        <?php else :?>
            <p>Имя: <?php echo $product['name']?></p>
        <?php endif;?>
        <?php if($product['img'] != ' '):?>
            <img src="/img/<?php echo $product['img'];?>" style="float: left;" width="320" height="240">
        <?php endif;?>
        <p  > Email: <span ><?php echo $product['email']?></span></p>
       
        <?php if($customer['name'] != 'admin'):?>
            <p > Текста задачи: <span ><?php echo $product['text']?></span> </p>
        <?php else :?><div class="col-sm-6">
            <form class="form-horizontal" role="form" enctype="multipart/form-data" action="/comment/edit" method="post">
                <label for="inputText"  class="col-lg-6">Ваш отзыв</label>
                
                    <textarea type="text" class="form-control"  name="text" pattern="[a-zA-Z0-9]+">
                        <?php echo $product['text']?></textarea><label class="checkbox col-sm-6" style="margin-left: 20px;"><input type="checkbox" name="checkbox" value="1">подтвердить</label>
               
                
                <input type="hidden" name="id" value="<?php echo $product['id']?>">
             
                    <button type="submit" class="btn btn-default" style="" value="<?php echo $product['id']?>">Сохранить</button> 
            </form></div>
        <?php endif;?>
        </div>
    </div>
<?php endforeach; ?> 
        <div class="container">
        <?php $this->renderPartialview('comment/activ');?>
        </div>
<?php if($customer['name'] != 'admin'): ?>
        <div class="container">
        <?php $this->renderPartialview('comment/form');?>
        </div>
<?php endif;?>

