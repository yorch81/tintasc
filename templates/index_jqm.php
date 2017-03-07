<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link rel="stylesheet" href="css/jquerymobile/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet"  href="css/fajqm/jqm-icon-pack-fa.css" />
    <link rel="stylesheet"  href="css/jtsage/jtsage-datebox-4.0.0.jqm.min.css" />
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRxC6Y4f-j6nECyHWigtBATtJyXyha-XU&libraries=adsense&sensor=true&language=es"></script>
    
    <title>PetRide</title>
</head>
<body>

    <div data-role="page" id="pageone" data-theme="a">
      <div data-role="header">
      </div>

      <nav data-role="navbar">
        <ul>
          <li><a href="#home" data-icon="home">Home</a></li>

          <li><a href="#email" data-rel="dialog" data-icon="grid">Email</a></li>
          <li><a href="#phonebook" data-rel="dialog" data-icon="search">Phonebook</a></li>
          <li><a href="#calendar" data-rel="dialog" data-icon="calendar">Calendar</a></li>
        </ul>
      </nav>
      
      <div data-role="main" class="ui-content"><br>
        <p>Goto Index</p>
      
        <button id="btnMap" class="ui-btn ui-icon-back ui-btn-icon-left">Goto Map</button>

       

        <br>
       
          <label for="cmbProd">Productos</label>
          <select  id="cmbProd" data-iconpos="right">
          </select>

        <br/>
        <label for="txtFecha">Fecha</label>
        <input id="txtFecha" type="text" data-role="datebox" data-theme='b' data-options='{"mode":"flipbox", "overrideDateFormat": "%Y-%m-%d"}'>

        <label for="txtTime">Hora:</label>
        <input id="txtTime" type="text" data-role="datebox" data-theme='b' data-options='{"mode":"timeflipbox", "overrideTimeFormat": 12, "overrideTimeOutput": "%H:%M:00"}' />

        <label for="txtFecha2">Fecha2</label>
        <input id="txtFecha2" type="text" data-role="datebox" data-options='{"mode":"datebox", "showInitialValue": "true"}'>
      </div>
           
      <div data-role="footer" data-position="fixed">
      <h1>&copy; Copyright 2017 PetRide &reg;</h1>
      </div>
    </div> 

    <div data-role="page" id="email">
      <div data-role="header">
      <h1>Email Account</h1>
      </div>
                  
        <div data-role="main" class="ui-content">
        <ul data-role="listview" data-inset="true">
          <li><a href="#">Inbox<span class="ui-li-count">25</span></a></li>
          <li><a href="#">Sent<span class="ui-li-count">432</span></a></li>
          <li><a href="#">Trash<span class="ui-li-count">7</span></a></li>
        </ul>
      <a href="#pageone" data-role="button" data-inline="true" data-icon="back">Go Back</a>
      </div>
                      
      <div data-role="footer" data-position="fixed">
      <h1>Footer Text</h1>
      </div>
    </div> 

    <div data-role="page" id="home">
      <div data-role="header">
      <h1>Home</h1>
      </div>

      <div data-role="main" class="ui-content">
      <p>Home Is Where The Heart Is!</p>
      <a href="#pageone" data-role="button" data-inline="true" data-icon="back">Go Back</a>
      </div>

      <div data-role="footer" data-position="fixed">
      <h1>Home</h1>
      </div>
    </div>

    <div data-role="page" id="home2">
      <div data-role="header">
      <h1>Home</h1>
      </div>

      <div data-role="main" class="ui-content">
      <p>Home Is Where The Heart Is!</p>
      <a href="#pageone" data-role="button" data-inline="true" data-icon="back">Go Back</a>
      </div>

      <div data-role="footer">
      <h1>Footer Text</h1>
      </div>
    </div> 


    <div data-role="page" id="calendar">
      <div data-role="header">
      <h1>Calendar</h1>
      </div>

       <div data-role="main" class="ui-content">
         <ul data-role="listview" data-inset="true">
          <li data-role="list-divider">Tuesday, February 10, 2014 <span class="ui-li-count">2</span></li>   
          <li><a href="#">   
            <h2>Doctor</h2>
            <p>Regular check at 12:00</p>
            <p class="ui-li-aside">Appointment</p></a>
          </li>
          <li><a href="#">
            <h2>Glen Quagmire</h2>
            <p>The clam at 18:00</p>
            <p class="ui-li-aside">giggity giggity goo</p></a>
          </li>
        </ul>
        <a href="#pageone" data-role="button" data-inline="true" data-icon="back">Go Back</a>
      </div>
    </div>
      
    <div data-role="page" id="phonebook">
      <div data-role="header">
      <h1>Phonebook</h1>
      <a href="#pageone" data-role="button" class="ui-btn-right" data-icon="back">Go Back</a>
      </div>

     <div data-role="main" class="ui-content">
      
      <ul data-role="listview" data-autodividers="true" data-inset="true" data-filter="true">
        <li><a href="#">Adele</a></li>
        <li><a href="#">Albert</a></li>
        <li><a href="#">Billy</a></li>
        <li><a href="#">Calvin</a></li>
      </ul>
      </div>
    </div>

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="css/jquerymobile/jquery.mobile-1.4.5.min.js"></script>
    <script type="text/javascript" src="js/Data.js"></script>
    <script type="text/javascript" src="js/ejs.js"></script>
    <script type="text/javascript" src="css/jtsage/jtsage-datebox-4.0.0.jqm.min.js"></script>
    <script type="text/javascript" src="css/jtsage/jtsage-datebox.i18n.es-ES.utf8.js"></script>

    <script type="text/javascript">
        gotoMap = function (){
          if (confirm("Goto Map?"))
            window.location = "/map";

          //$(':mobile-pagecontainer').pagecontainer('change', '#home');
          
          /*
          $('#txtFecha2').val("2001-01-01");

          $('#txtFecha2').datebox({
              "mode":"datebox", 
              "overrideDateFormat": "%Y-%m-%d",
              "defaultValue": "2001-01-01",
              "showInitialValue": true
          });*/
        }

        data = new Data('http://pr.localhost', 'VHPg8Mp4RTgnKo0PgRb5tdXhtSS6rYIt3KLYDf5O');

        $(document).ready( function() {
            $("#txtId").val(localStorage.pr_id);
            
            $("#btnMap").click(function() {
              var dbDate = $("#txtFecha").val() + 'T' + $("#txtTime").val() + '.000';
              console.log(dbDate);

              gotoMap();
              
              //$('#cmbProd').val(3);
              //$('#cmbProd').selectmenu('refresh');
            });

            $("#cmbProd").change(function() {
              alert("id=" + $("#cmbProd").val());
            });

            var jsonData = {'pTable':'TAB_PRODUCTOS', 'pwhere':''};

            data.execute("sp_loadtable", jsonData, 
              function(response, status){
                if (status == "success"){
                  var html = new EJS({ url: 'js/combo.ejs' }).render(response);

                  $('#cmbProd').html(html);
                  $('#cmbProd').selectmenu('refresh');
                }
                else{
                  console.log(response);
                }
              });

        });


    </script>
</body>

</html>

<!--
  <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/jquerymobile/jquery.mobile-1.4.5.min.css">
  <link rel="stylesheet"  href="css/fajqm/jqm-icon-pack-fa.css" />
  <link rel="stylesheet"  href="css/jtsage/jtsage-datebox-4.0.0.jqm.min.css" />
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRxC6Y4f-j6nECyHWigtBATtJyXyha-XU&libraries=adsense&sensor=true&language=es"></script>
    
  <title>PetRide</title>
</head>
<body>

  <div data-role="page" id="mnu_page">
    <div data-role="header">
      <h1>PetRide Demo</h1>
    </div>

    <nav data-role="navbar">
      <ul>
        <li><a href="#" data-icon="user" id="mnuPerfil">Perfil</a></li>
        <li><a href="#" data-icon="heart" id="mnuPet">Mascotas</a></li>
        <li><a href="#" data-icon="globe" id="mnuRide">Paseos</a></li>
        <li><a href="#" data-icon="wrench" id="mnuHelp">Ayuda</a></li>
      </ul>
    </nav>

    <div data-role="main" class="ui-content">

    </div>

    <div data-role="footer" data-position="fixed">
      <h1>&copy; Copyright 2017 PetRide &reg;</h1>
    </div>
  </div>


  <div data-role="page" id="mnu_perfil">
    <div data-role="header">
      <h1>Perfil</h1>
      <a href="#mnu_page" data-icon="back" class="ui-btn-right">Atras</a>
    </div>

    <div data-role="main" class="ui-content">
      <fieldset data-role="controlgroup" data-type="horizontal">
        <legend>Registro:</legend>
        <label for="chkcliente">Cliente</label>
        <input type="checkbox" name="chkTipo" id="chkcliente" checked>
        <label for="chkpasea">Paseador</label>
        <input type="checkbox" name="chkTipo" id="chkpasea">
      </fieldset>

      <label for="txtNombre">Nombre(s):</label>
      <input type="text" name="txtNombre" id="txtNombre" placeholder="Nombre" data-clear-btn="true">

      <label for="txtPaterno">Apellido Paterno:</label>
      <input type="text" name="txtPaterno" id="txtPaterno" placeholder="Apellido Paterno" data-clear-btn="true">

      <label for="txtMaterno">Apellido Materno:</label>
      <input type="text" name="txtMaterno" id="txtMaterno" placeholder="Apellido Materno" data-clear-btn="true">

      <label for="txtEmail">Correo Electrónico:</label>
      <input type="email" name="txtEmail" id="txtEmail" placeholder="Correo Electrónico" data-clear-btn="true">

      <fieldset data-role="controlgroup" data-type="horizontal">
        <legend>Sexo:</legend>
        <label for="radMasculino">Masculino</label>
        <input type="radio" name="radSexo" id="radMasculino" value="M" checked>
        <label for="radFemenino">Femenino</label>
        <input type="radio" name="radSexo" id="radFemenino" value="F"> 
      </fieldset>

      <label for="txtDirec">Dirección:</label>
      <textarea name="txtDirec" id="txtDirec" rows="3"></textarea>
      
      <label for="txtCodPos">Código Postal:</label>
      <input type="text" class="positive-integer" name="txtCodPos" id="txtCodPos" placeholder="Código Postal" data-clear-btn="true" maxlength="5">

      <label for="txtFecha">Fecha de Nacimiento:</label>
      <input id="txtFecha" type="text" data-role="datebox" data-options='{"mode":"flipbox", "overrideDateFormat": "%Y-%m-%d"}'>

      <label for="txtCel">Celular:</label>
      <input type="text" class="positive-integer" name="txtCel" id="txtCel" placeholder="Celular" data-clear-btn="true" maxlength="12">

      <button id="btnTest" class="ui-btn ui-icon-back ui-btn-icon-left">Test</button>
    </div>

    <div data-role="footer" data-position="fixed">
      <h1>&copy; Copyright 2017 PetRide &reg;</h1>
    </div>
  </div>

  
  <div data-role="page" id="mnu_pets">
    <div data-role="header">
      <h1>Mascotas</h1>
      <a href="#mnu_page" data-icon="back" class="ui-btn-right">Atras</a>
    </div>

    <div data-role="main" class="ui-content">
    </div>

    <div data-role="footer" data-position="fixed">
      <h1>&copy; Copyright 2017 PetRide &reg;</h1>
    </div>
  </div>

  
  <div data-role="page" id="mnu_ride">
    <div data-role="header">
      <h1>Paseos</h1>
      <a href="#mnu_page" data-icon="back" class="ui-btn-right">Atras</a>
    </div>

    <div data-role="main" class="ui-content">
    </div>

    <div data-role="footer" data-position="fixed">
      <h1>&copy; Copyright 2017 PetRide &reg;</h1>
    </div>
  </div>

  
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script src="css/jquerymobile/jquery.mobile-1.4.5.min.js"></script>
  <script type="text/javascript" src="js/Data.js"></script>
  <script type="text/javascript" src="js/ejs.js"></script>
  <script type="text/javascript" src="css/jtsage/jtsage-datebox-4.0.0.jqm.min.js"></script>
  <script type="text/javascript" src="css/jtsage/jtsage-datebox.i18n.es-ES.utf8.js"></script>

  <script type="text/javascript" src="js/prApp.js"></script>
  <script type="text/javascript" src="js/prEvents.js"></script>
  <script type="text/javascript" src="js/prCliente.js"></script>
  <script type="text/javascript" src="js/prCnf.js"></script>
  <script type="text/javascript" src="js/jquery.numeric.js"></script>

  <script type="text/javascript">
    // Init Application
    $(document).ready( function() {
      $(".positive-integer").numeric({ decimal: false, negative: false });
      $(".positive-decimal").numeric({ decimal: ".", negative: false });

      $("#btnTest").click(function() {
        prCliente.saveForm();
      });

     
      prCnf.saveKey("1234567890987654321");
      prCnf.saveItem("SOCIAL_TYPE", "FB");
      prCnf.saveItem("SOCIAL_ID", '10154755344391897');

      prApp.initialize();

      prEvents.listen();
    });
  </script>
</body>
</html>
  -->