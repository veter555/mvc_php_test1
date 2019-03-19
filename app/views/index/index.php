 <html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?php echo BP;?>/css/style.css" >
        <title>Test BeeJee</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
   
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="jumbotron">
            <div class="container text-center">
                <h1>Test BeeJee</h1>
            </div>
        </div>

        <div id="header">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php $customer = Helper::getCustomer();
                        if( $customer): ?>
                              <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo $customer['name'] ; ?></a></li>
                              <li><a href="<?php echo BP;?>/customer/logout/"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                        <?php else: ?>
                              <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                              <li><a href="<?php echo BP;?>/customer/login/"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="container">
            <?php $this->renderView(); ?>
        </div>
        
        <script type="text/javascript" src="<?php echo BP;?>/js/script.js"></script>
        <hr style="margin:50px 5px;background-color: black;height: 1px;">
        <footer class="container-fluid text-center">
            <p>Test BeeJee Copyright</p>
        </footer>
    </body>
</html>