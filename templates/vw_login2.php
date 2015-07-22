<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Jorge Alberto Ponce Turrubiates">
    <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico">

    <title>Social Login Page</title>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
    <link href="./metro-bootstrap/dist/css/metro-bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    
    <style>
    body {
      padding-top: 5px;
      padding-bottom: 5px;
    }

    .navbar {
      margin-bottom: 5px;
    }

    .list-group-item {
      padding: 4px 10px;
    }

    .tooltip > .tooltip-inner {
      background-color: #428bca;
    }

    .scroll-500{
        height: 500px;
        border-top: solid 1px #BBB;
        border-left: solid 1px #BBB;
        border-bottom: solid 1px #FFF;
        border-right: solid 1px #FFF;
        background: #FFF;
        overflow: scroll;
        padding: 5px;
      }

    .jumbotron{
        padding: 15px;
      }
    </style>
  </head>
  <body>
    <div class="container">


      <!--<div class="jumbotron">  -->
        <center>
          <div class="row"> 
            <div class="col-md-3 col-lg-3">
            </div>

            <div class="col-md-6 col-lg-6">
              <div class="thumbnail tile tile-wide tile-teal">
                <a href="/tw" >
                  <img height="90" width="90" src="img/twitter.png">

                  <h3 class="tile-text">Sign in with Twitter</h3>
                </a>
              </div>
            </div>

            <div class="col-md-3 col-lg-3">
            </div>
          </div>

          <br>

          <div class="row"> 
            <div class="col-md-3 col-lg-3">
            </div>

            <div class="col-md-6 col-lg-6">
              <div class="thumbnail tile tile-wide nephritis">
                <a href="/fb" >
                  <img height="90" width="90" src="img/facebook.png">

                  <h3 class="tile-text">Sign in with Facebook</h3>
                </a>
              </div>
            </div>

            <div class="col-md-3 col-lg-3">
            </div>
          </div>
      <!--</div>  jumbotron -->
    </div> <!-- container -->

    <script src="./metro-bootstrap/bootstrap.min.js"></script>

  </body>
</html>