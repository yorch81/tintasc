<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link rel="stylesheet" href="https://yorch81.github.io/js/jquery_mobile_1_4_5/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet"  href="https://yorch81.github.io/js/jquery_mobile_icons/dist/jqm-icon-pack-fa.css" />
    <link rel="stylesheet"  href="https://yorch81.github.io/js/jtsage/jtsage-datebox-4.0.0.jqm.min.css" />
    
    <title>TintaSc</title>
</head>
<body>

    <div data-role="page" id="pageone" data-theme='b'>
      <div data-role="header">
        <h1>TintaSc App</h1>
      </div>
      
      <div data-role="main" class="ui-content"><br>
        <fieldset data-role="controlgroup" data-type="horizontal">
          <legend>Tipo de Cita:</legend>
          <label for="radDis">Diseño</label>
          <input type="radio" name="radCita" id="radDis" value="D" checked>
          <label for="radTat">Tatuaje</label>
          <input type="radio" name="radCita" id="radTat" value="T"> 
        </fieldset>

        <br/>
        <label for="txtFecha">Iniciando:</label>
        <input id="txtFecha" type="text" data-role="datebox" data-theme='b' data-options='{"mode":"flipbox", "overrideDateFormat": "%Y-%m-%d"}'>
        <input id="txtTime" type="text" data-role="datebox" data-theme='b' data-options='{"mode":"timeflipbox", "overrideTimeFormat": 12, "overrideTimeOutput": "%H:%M:00"}' />

        <label for="cmbHoras">Horas:</label>
        <select  id="cmbHoras" data-iconpos="right">
          <option value="1">1 Hora</option>
          <option value="2">2 Horas</option>
          <option value="3">3 Horas</option>
          <option value="4">4 Horas</option>
          <option value="5">5 Horas</option>
        </select>

        <label for="txtCom">Comentarios:</label>
        <textarea name="txtCom" id="txtCom" rows="4"></textarea>
        
        <a id="btn_calendar" href="#" data-role="button" data-icon="calendar-o">Agendar</a>

       </div>
           
      <div data-role="footer" data-position="fixed">
        <h1>&copy; Copyright 2017 TintaSc &reg;</h1>
      </div>
    </div> 

    <div data-role="page" id="pg_message" data-theme='b'>
      <div data-role="header">
        <h1>Header</h1>
      </div>
                  
      <div data-role="main" class="ui-content">
        <p>Message</p>
      </div>

      <div data-role="footer" data-position="fixed">
        <h1>&copy; Copyright 2017 TintaSc &reg;</h1>
      </div>
    </div> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 

    <script src="https://yorch81.github.io/js/jquery_mobile_1_4_5/jquery.mobile-1.4.5.min.js"></script>
    <script src="https://yorch81.github.io/js/ejs/ejs_production.js"></script>
    <script type="text/javascript" src="https://yorch81.github.io/js/jtsage/jtsage-datebox-4.0.0.jqm.min.js"></script>
    <script type="text/javascript" src="https://yorch81.github.io/js/jtsage/jtsage-datebox.i18n.es-ES.utf8.js"></script>

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

        //data = new Data('http://pr.localhost', 'VHPg8Mp4RTgnKo0PgRb5tdXhtSS6rYIt3KLYDf5O');

        $(document).ready( function() {
            $("#txtId").val(localStorage.pr_id);
            
            $("#btnMap").click(function() {
              var dbDate = $("#txtFecha").val() + 'T' + $("#txtTime").val() + '.000';
              console.log(dbDate);

              gotoMap();
              
              //$('#cmbProd').val(3);
              //$('#cmbProd').selectmenu('refresh');
            });

            $("#btn_calendar").click(function() {
              //$(':mobile-pagecontainer').pagecontainer('change', '#email');
              $.mobile.changePage( "#pg_message", { role: "dialog" } );
            });

            $("#cmbProd").change(function() {
              alert("id=" + $("#cmbProd").val());
            });

            var jsonData = {'pTable':'TAB_PRODUCTOS', 'pwhere':''};

            /*data.execute("sp_loadtable", jsonData, 
              function(response, status){
                if (status == "success"){
                  var html = new EJS({ url: 'js/combo.ejs' }).render(response);

                  $('#cmbProd').html(html);
                  $('#cmbProd').selectmenu('refresh');
                }
                else{
                  console.log(response);
                }
              });*/

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