<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" type="image/x-icon" href="/img/tinta.ico">

    <title>TintaSc</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>  

    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>-->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/3.4.1/darkly/bootstrap.min.css" integrity="sha384-pKJMCXwCXq3HwRBt27cwwSmc0/DAo2BjRxGd7nEESEStk++p6LffHmhX9oqzVDUk" crossorigin="anonymous">

	  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.js"></script>
	  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 20px;
      }

      .navbar {
        margin-bottom: 20px;
      }

      .atl-panel {
          border-top: solid 1px #BBB;
          border-left: solid 1px #BBB;
          border-bottom: solid 1px #FFF;
          border-right: solid 1px #FFF;
          background: #FFF;
          padding: 5px;
      }
            
      .modal-static .modal-content {
      	width: 200px; 
      	height: 200px; 
      	overflow: visible !important;
      	top: 50% !important; 
        left: 50% !important;
        position: fixed;
      }
    </style>
    <script type="text/javascript">       
      
    </script>
  </head>

  <body>

    <div class="container">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/logout">TintaSc</a>
          </div>
          
          <div id="navbar" class="navbar-collapse collapse">
          
          
          <ul class="nav navbar-nav navbar-right">
            <li class="active" id="btn_credits"><a href="#">Créditos <span class="sr-only">(current)</span></a></li>
          </ul>
        </div>
        </div><!--/.container-fluid -->
      </nav>

      <div class="jumbotron">
        <center><h2>Citas</h2></center>      
        
        <div class="container">
            <label>FBNAME</label>
            <?php 
              echo $data['info']['FBNAME'];
            ?>
	        
            <br><br>
            <label>FB Profile</label>
            <a href="<?php echo $data['info']['FBURL']; ?>">
              <img src="<?php echo $data['info']['FBPICTURE']; ?>" class="img-rounded"  width="100" height="100">
            </a>

            <br><br>
            <label>Diseños</label>
            <div class="row">
            <?php 
              $totalImg = $data['info']['IMAGES'];

              if ($totalImg > 0){
                for ($i=0; $i<$totalImg; $i++){
                  ?>
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <a href="<?php echo $data['info']['IMAGESLNK'][$i]; ?>" class="thumbnail">
                      <img src="<?php echo $data['info']['IMAGESLNK'][$i]; ?>" alt="Design" style="width:200px;height:250px">
                    </a>
                  </div>
            <?php
                }
              }
            ?>
            </div>

        </div>
      </div>
    </div>

      <!-- Static Modal Credits -->
      <div class="modal fade" id="window-credits" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Créditos</h4>
                   </div>

                  <div class="modal-body">
                      <center>
                          <p><h3>Jorge Alberto Ponce Turrubiates</h3></p>
                          <p><h5><a href="mailto:the.yorch@gmail.com<">the.yorch@gmail.com</a></h5></p>
                          <p><h5><a href="http://the-yorch.blogspot.mx/">Blog</a></h5></p>
                          <p><h5><a href="https://bitbucket.org/yorch81">BitBucket</a></h5></p>
                          <p><h5><a href="https://github.com/yorch81">GitHub</a></h5></p>
                          <p></p>
                      </center>
                  </div>
              </div>
          </div>
      </div>

  </body>
</html>
