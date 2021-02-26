<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link rel="stylesheet" href="//yorch81.github.io/js/jquery_mobile_1_4_5/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet"  href="//yorch81.github.io/js/jquery_mobile_icons/dist/jqm-icon-pack-fa.css" />
    <link rel="stylesheet"  href="//yorch81.github.io/js/jtsage/jtsage-datebox-4.0.0.jqm.min.css" />
    <link href="//yorch81.github.io/js/dropzone4/min/dropzone.min.css" rel="stylesheet"> 

    <link rel="shortcut icon" href="https://storage.cloud.google.com/yorch81/assets/favicon.png" type="image/ico" />
    <title>Ink & Thunder Tattoo &reg;</title>

    <style type="text/css">
      img {
          max-width: 25%;
          max-height: 25%
      }

      .img_upd {
          max-width: 85%;
      }

      .dz {
        background-color: transparent;
        border-color: transparent;
      }
    </style>
</head>
<body>

    <div data-role="page" id="win_main" data-theme='a'>
      <div data-role="header">
        <h1>Agenda tu cita</h1>
        <a href="./logout" data-icon="power-off" class="ui-btn-right" rel="external">Salir</a>
      </div>
      
      <div data-role="main" class="ui-content">
        <center>
          <img id="imgUsr" src="<?php echo $_SESSION['SOCIAL_IMG']; ?>">
        </center>

        <fieldset data-role="controlgroup" data-type="horizontal">
          <legend>Tipo de Cita:</legend>
          <label for="radDis">Diseño (1 Hr)</label>
          <input type="radio" name="radCita" id="radDis" value="D" checked>
          <label for="radTat">Tatuaje (2 Hr)</label>
          <input type="radio" name="radCita" id="radTat" value="T"> 
        </fieldset>

        <br/>
        <label for="txtFecha">Iniciando:</label>
        <input id="txtFecha" type="text" data-role="datebox" data-theme='a' data-options='{"mode":"flipbox", "overrideDateFormat": "%Y-%m-%d"}'>
        <input id="txtTime" type="text" data-role="datebox" data-theme='a' data-options='{"mode":"timeflipbox", "overrideTimeFormat": 12, 
        "overrideTimeOutput": "%H:%M:00"}' />

        <!--
        <label for="cmbHoras">Horas:</label>
        <select  id="cmbHoras" data-iconpos="right">
          <option value="1">1 Hora</option>
          <option value="2">2 Horas</option>
          <option value="3">3 Horas</option>
          <option value="4">4 Horas</option>
          <option value="5">5 Horas</option>
        </select>
        -->

        <label for="txtCom">Comentarios:</label>
        <textarea name="txtCom" id="txtCom" rows="5"></textarea>
        
        <div data-role="popup" id="pr_popup" class="ui-content">
          <p id="pr_popmsg">Popup Message</p>
        </div>

        <a id="btn_calendar" href="#" data-role="button" data-icon="calendar-o">Agendar</a>
        <a id="btn_upload" href="#" data-role="button" data-icon="upload">Sube tus diseños</a>
       </div>
           
      <div data-role="footer" data-position="fixed">
        <h1>Ink &amp; Thunder &reg;</h1>
      </div>
    </div> 

    <div data-role="page" id="win_upload" data-theme='a'>
      <div data-role="header">
        <a href="#win_main" data-icon="back" class="ui-btn-left">Atras</a>
        <h1>Ahora sube tu(s) diseño(s)</h1>
        <a href="./logout" data-icon="power-off" class="ui-btn-right" rel="external">Salir</a>
      </div>

      <div data-role="main" class="ui-content">
        <br/>
        <center>
          <label>Toque o arrastre para subir diseños</label>
          <form action="./upload" class="dropzone dz" id="dropzonefile">
            <div class="dz-message">
              <img src="./img/upload.png" class="img_upd" alt="TintaSc">
            </div>
          </form>
        </center>
        <br/>
      </div>

      <div data-role="popup" id="up_popup" class="ui-content">
        <p id="up_popmsg">Popup Message</p>
      </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 

    <script src="//yorch81.github.io/js/jquery_mobile_1_4_5/jquery.mobile-1.4.5.min.js"></script>
    <script src="//yorch81.github.io/js/ejs/ejs_production.js"></script>
    <script type="text/javascript" src="//yorch81.github.io/js/jtsage/jtsage-datebox-4.0.0.jqm.min.js"></script>
    <script type="text/javascript" src="//yorch81.github.io/js/jtsage/jtsage-datebox.i18n.es-ES.utf8.js"></script>
    <script src="//yorch81.github.io/js/dropzone4/min/dropzone.min.js"></script>

    <script type="text/javascript">
        // Popup Class
        function prPopup(){
        }

        prPopup.show = function(msg, timeOut = 0) {
          $("#pr_popmsg").html(msg);
          $("#pr_popup").popup("open");

          if (timeOut > 0){
            setTimeout(function() {$("#pr_popup").popup("close");}, timeOut);
          }
        }

        prPopup.showU = function(msg, timeOut = 0) {
          $("#up_popmsg").html(msg);
          $("#up_popup").popup("open");

          if (timeOut > 0){
            setTimeout(function() {$("#up_popup").popup("close");}, timeOut);
          }
        }

        // Ready
        $(document).ready( function() {
            // Hide Upload Button 
            $("#btn_upload").hide();

            // DropZone Configuration
            Dropzone.autoDiscover = false;

            Dropzone.options.dropzonefile = {
              uploadMultiple : false,
              maxFiles : 1,
              acceptedFiles: "image/*",
              error: function(file, response) {
                  this.removeAllFiles();

                  prPopup.showU(response, 2000);
                },
              init: function() {
                this.on("success", function(file, response) { 
                  //this.disable();
                  this.removeAllFiles();

                  prPopup.showU("Su imagen se subió correctamente", 2000);

                  if (response.length == 0)
                    console.log("Error on upload file");       
                });
              }
            };

            new Dropzone("#dropzonefile" , Dropzone.options.dropzonefile );

            // upload File or Camera
            $("#btn_upload").click(function() {
              $(':mobile-pagecontainer').pagecontainer('change', '#win_upload');
            });

            // Add Calendar
            $("#btn_calendar").click(function() {
              var retValue = true;

              if ($("#txtFecha").val() == '') {
                prPopup.show("Debe seleccionar una fecha");
                retValue = false;
              } else if ($("#txtTime").val() == '') {
                  prPopup.show("Debe seleccionar una hora");
                  retValue = false;
              } else if ($("#txtCom").val() == '') {
                  prPopup.show("Por Favor agregue comentarios");
                  retValue = false;
              } else {
                  retValue = true;
              }

              if (retValue) {
                var start = $("#txtFecha").val() + 'T' + $("#txtTime").val() + '.000';

                // Is design
                var tipo = 1;
                var hc = 1;

                // Is tattoo
                if ($("#radTat").prop("checked")) {
                  tipo = "2";
                  var hc = 2;
                }

                $.post('./calendar', 
                      {start:start, hours:hc, type:tipo, comments:$('#txtCom').val()},
                      function(response) {
                        if (response == 'NOT_AVAILABLE'){
                          prPopup.show("Por el momento ese horario se encuentra ocupado, intente con otro horario");
                        }
                        else if (response == 'CREATED') {
                          prPopup.show("Ya ha creado una cita anteriormente, para subir diseños pulse Sube tus diseños");
                          $("#btn_upload").show();
                          $("#btn_calendar").addClass('ui-disabled');
                        }
                        else {
                          $("#btn_calendar").addClass('ui-disabled');
                          $("#btn_upload").show();

                          $(':mobile-pagecontainer').pagecontainer('change', '#win_upload');

                          prPopup.showU("Tu cita ha sido agendada, ahora puedes subir tus diseños", 2000);
                        }
                  }).error(
                      function(){
                          console.log('Error executing Post');
                      }
                  );
              }
            });
        });
    </script>
</body>
</html>
