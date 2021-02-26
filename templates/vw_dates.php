<!DOCTYPE html>
<html lang="es_MX">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0"/>
    <meta name="description" content="Ink">
    <meta name="author" content="YoRcH">

    <link rel="shortcut icon" href="https://storage.cloud.google.com/yorch81/assets/favicon.png" type="image/ico" />
    <title>Ink & Thunder Tattoo &reg;</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" integrity="sha512-DUC8yqWf7ez3JD1jszxCWSVB0DMP78eOyBpMa5aJki1bIRARykviOuImIczkxlj1KhVSyS16w2FSQetkD4UU2w==" crossorigin="anonymous"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #ffffff;
    }

    .jumbotron {
      background-color: #ffffff;
      color: #3a3f48;
    }

    .jumbotron.vertical-center {
      margin-top: 0;
      margin-bottom: 0;
    }

    .vertical-center {
      min-height: 100%; 
      min-height: 100vh; 
      display: -webkit-box;
      display: -moz-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex; 
      
        -webkit-box-align : center;
      -webkit-align-items : center;
           -moz-box-align : center;
           -ms-flex-align : center;
              align-items : center;
      
      width: 100%;
      
             -webkit-box-pack : center;
                -moz-box-pack : center;
                -ms-flex-pack : center;
      -webkit-justify-content : center;
              justify-content : center;
    }

    .btn-social {
      color: #000000;
    }
    </style>
  </head>

 <body>
    <div class="container">
      <div class="jumbotron">
        <center>
          <img src="https://inttattoo.art/img/int.jpeg" class="img-responsive" width="15%">
          <h2>Citas registradas</h2>
        </center>
        <br/>
        <div class="container">
          <label>Nombre de Facebook : </label>
          <?php echo $data['info']['FBNAME']; ?>
          <br/>
          <label>Perfil de Facebook : </label>
          <a target="_blank" href="<?php echo $data['info']['FBURL']; ?>">
            <img src="<?php echo $data['info']['FBPICTURE']; ?>" class="img-rounded"  width="100" height="100">
          </a>
          <br/>
          <br/>
          <label>Diseños subidos</label>
          <?php 
            $totalImg = $data['info']['IMAGES'];

            if ($totalImg > 0){
              for ($i=0; $i<$totalImg; $i++){
                ?>
                  <a target="_blank" href="<?php echo $data['info']['IMAGESLNK'][$i]; ?>" class="thumbnail">
                    <img src="<?php echo $data['info']['IMAGESLNK'][$i]; ?>" class="img-responsive" style="width:200px;height:250px">
                  </a>
                  <br/>
          <?php
              }
            }
          ?>
        </div>
        <br/>
      </div>
    </div>
  </body>
</html>
