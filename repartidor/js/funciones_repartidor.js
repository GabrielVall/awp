$(document).ready(function(){
  cambiar_contenido_hash();
  
  window.onhashchange = function() {
    cambiar_contenido_hash();
  };

  function cambiar_contenido_hash() {
    var hash = window.location.hash;
    hash = hash.replace('#', '');
    cambiar_hash(hash);
  }

  $(document).on("click", "#radio-1", function() {
    window.location.hash ="";
  });

  $(document).on("click", ".href", function() {
    var href = $(this).data("ref");
    window.location.hash = href;
  });

  $(document).on("click", ".orden-pendiente", function() {
    $(this).find('span').addClass('animate__animated animate__backOutLeft');
    setTimeout(function() {
      $(".nuevo-pedido").remove();
    }, 300);
  });

  function cambiar_hash(hash){
    if(!hash || hash == '') hash = 'inicio';
    if( hash.includes("=") ){
      var valor = hash.substring(hash.indexOf('=')+1);
    }else{
      var valor = 0;
    }
    hash = hash.replace('=' + valor, '');
    $.ajax({
      type: 'POST',
      url: '../php/v/3/'+hash+'.php',
      data: "valor=" + valor,
      success: function(respuesta) {
        $("#contenedor_vista").removeClass('animate__backInLeft');
        $("#contenedor_vista").addClass('animate__backOutRight');
        setTimeout(function() {
          $("#contenedor_vista").html(respuesta);
          $("#contenedor_vista").addClass('animate__backInLeft');
          $("#contenedor_vista").removeClass('animate__backOutRight');
          funciones_hash(hash);
        }, 400);
      },error: function() {   
        cambiar_hash('');
      }
    });
  }

  $(document).on('click', "#ver_detalles_next", function(){
    $("#detalles").slideToggle();
  });

  $(document).on('click', "#ver_detalles_cliente", function(){
    $("#detalles_cliente").slideToggle();
  });

  $(document).ajaxStart(function () {
    NProgress.start();
    NProgress.set(0.4);
    NProgress.set(0.6);
  }).ajaxStop(function () {
  	setTimeout(function() {
      NProgress.done();
	  }, 500);
  });

  function funciones_hash(hash) {
    switch (hash) {
      // case 'inicio':
      //   break;
      case 'editar_perfil':
        crear_inputs_telefono();
        break;
      default:
        break;
    }
  }

  var paises_pref = ["mx","co","us","es"];
  function crear_inputs_telefono(){
    const input = document.querySelector("#telefono");
    window.intlTelInput(input, {
      initialCountry:paises_pref[0],
      separateDialCode:true,
      preferredCountries: paises_pref,
    });
    var iti = window.intlTelInputGlobals.getInstance(input);

    if(input.value.length > 5 || input_wsp.value.length > 5){
      iti.setNumber('+'+input.value);
    }
    
  }

  $(document).on("click", "#generar_contraseña_formulario_inicio", function () {
    var pwd = generar_contrasena();
    $("#password").attr("type", "text").val(pwd);
    validar_pass();
  });

  $(document).on('input','.pass', function(e) {
    e.target.value = $(this).val().replace(/[^a-zA-Z0-9!@$%^&*()_+{}:<>?\|;\,.~]/g,'');
    validar_pass();
  });

  String.prototype.pick = function(min, max) {
    var n, chars = '';

    if (typeof max === 'undefined') {
        n = min;
    } else {
        n = min + Math.floor(Math.random() * (max - min + 1));
    }

    for (var i = 0; i < n; i++) {
        chars += this.charAt(Math.floor(Math.random() * this.length));
    }

    return chars;
  };


  String.prototype.shuffle = function() {
    var array = this.split('');
    var tmp, current, top = array.length;

    if (top) while (--top) {
        current = Math.floor(Math.random() * (top + 1));
        tmp = array[current];
        array[current] = array[top];
        array[top] = tmp;
    }

    return array.join('');
  };

  function generar_contrasena() {
    var specials = '!@$%^&*()_+{}:<>?\|[];\,./~';
    var lowercase = 'abcdefghijklmnopqrstuvwxyz';
    var uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var numbers = '0123456789';

    var all = specials + lowercase + uppercase + numbers;

    var password = '';
    password += specials.pick(1);
    password += lowercase.pick(1);
    password += uppercase.pick(1);
    password += numbers.pick(2);
    password += all.pick(6, 10);
    password = password.shuffle();
    return password;
  }

  function validar_pass(){
    var pass_val = $('.pass').val();
    
    var short = '<label class="text-danger"><i class="fas fa-exclamation-circle"></i> Demasiado corta</label>';
    var low = '<label class="text-danger"><i class="fas fa-exclamation-circle"></i> Debil</label>';
    var medium = '<label class="text-warning"><i class="fas fa-exclamation-circle"></i> Regular </label>';
    var secure = '<label class="text-success"><i class="fas fa-check-circle"></i> Segura </label>';
    var very_secure = '<label class="text-success"><i class="fas fa-check-circle"></i> Muy segura </label>';

    var strength=0;
    if ( pass_val.length > 6 ){
      if (pass_val.match(/[a-z]+/)){
        strength+=1;
      }
      if (pass_val.match(/[A-Z]+/)){
        strength+=1;
      }
      if (pass_val.match(/[0-9]+/)){
        strength+=1;
      }
      if (pass_val.match(/[$@#&!]+/)){
        strength+=1;
      }
    }else{
      $('.pass').parent().next().replaceWith(short);
    }
    var valido;
    switch (strength) {
      case 1:
        $('.pass').parent().next().replaceWith(low);
      break;
      case 2:
        $('.pass').parent().next().replaceWith(medium);
      break;
      case 3:
        $('.pass').parent().next().replaceWith(secure);
        valido = 1;
      break;
      case 4:
        $('.pass').parent().next().replaceWith(very_secure);
        valido = 1;
      break;
    
      default:
        $('.pass').parent().next().replaceWith(short);
      break;
    }
    if(valido == 1){
      $('.pass').addClass('.is-valid').removeClass('.is-invalid');
    }else{
      $('.pass').addClass('.is-invalid').removeClass('.is-valid');
    }

  }

  $(document).on('keyup','.val_text', function(e) {

    // Se declara el input
    var input = $(e.target);

    // Valor sin espacios dobles
    var valor_input = e.target.value.replace( /  +/g, ' ' );

    // Estructura lables para validar
    var inp_valido = '<label class="text-success"><i class="fas fa-check-circle"></i> Este campo es valido</label>';
    var inp_invalido = '<label class="text-danger"><i class="fas fa-exclamation-circle"></i> El texto es muy corto </label>';
    var inp_correo_invalido = '<label class="text-danger"><i class="fas fa-exclamation-circle"></i> Este correo no es valido </label>';
    
    // Parametros disponibles
    var minimo = parseInt(input.attr('val-min'));
    var maximo = parseInt(input.attr('val-max'));
    var text = input.attr('val-text');
    var mail = input.attr('val-mail');
    var tel = input.attr('val-tel');
    var placa = input.attr('val-placa');
    var nit = input.attr('val-nit');
    var usr = input.attr('val-usr');
    // Si no estan definidas se asigna un valor auto
    if (!maximo) { maximo = 100; }
    if (!minimo) { minimo = 0; }

    // Variables Regex
    var no_letras = new RegExp(/[^a-zA-Z ]/g);
    var no_num = new RegExp(/[^0-9\.]+/g);
    var espacios = new RegExp(/\s/g);
    var letras_num = new RegExp(/[^A-Za-z0-9_-]/g);
    if(text == 1 && tel != 1 ){
      // Remueve el ultimo caracter
      valor_input = valor_input.replace(no_letras, "")
    }
    if(text == 1 && tel == 1 ){
      // Remueve el ultimo caracter
      valor_input = valor_input.replace(letras_num, "")
    }
    if(usr == 1){
      // Elimina el texto de un string
      valor_input = valor_input.replace(no_letras, "")
    }
    if (tel == 1 && text != 1) {
      // Elimina los numeros de un string
      valor_input = valor_input.replace(no_num, '');
    }

    if (placa == 1) {
      // Elimina los espacios de un string y los pone auto cada 3 caracter
      // console.log(valor_input.length);
      if(valor_input.length < 4){
          // Si son los 3 primeros caracteres solo permite texto
          valor_input = valor_input.replace(no_letras, '');
      }else{
          if(!tiene_numero(valor_input.slice(-1))){
              // Si tiene mas de 4 caracteres y escribe un numero lo elimina
              valor_input = valor_input.slice(0, -1);
          }
          // Establece el nuevo valor del input y agrega un espacio en el 4to caracter
          valor_input = valor_input.replace(espacios, '').replace(/([A-Za-z0-9]{3})/g, '$1 ').trim();
      }
    }

    if(nit == 1){
      valor_input = valor_input.replaceAll(/[^0-9]/g, '').replace(/([0-9]{3})/g, '$1.').replace(/\.(?=[^.]*$)/, "-").trim();
    }

    // Tamaño del texto sin espacios
    var size = valor_input.replace(espacios, '').length;
    
    // Si el texto es más largo que lo permitido, se elmina el ultimo caracter escrito
    if(size > maximo) valor_input = valor_input.slice(0, maximo);

    // Si el texto es menor al minimo pero no es tipo correo, se agrega la clase invalida
    if(size < minimo && mail != 1) $(this).addClass('is-invalid').removeClass('is-valid').next().replaceWith(inp_invalido);

    // Si el valor se encuentra entre lo permitido y no es tipo mail, se agrega la clase valida
    if(size >= minimo && size <= maximo && mail != 1) $(this).removeClass('is-invalid').addClass('is-valid').next().replaceWith(inp_valido);
    
    // Si es tipo mail y no cumple con los requisitos, se agrega la clase invalida
    if(mail == 1 && !es_mail(valor_input) ) $(this).addClass('is-invalid').removeClass('is-valid').next().replaceWith(inp_correo_invalido);

    // Si es mail y se cumplen los requisitos, se agrega la clase valida
    else if( mail == 1 && es_mail(valor_input) ) $(this).removeClass('is-invalid').addClass('is-valid').next().replaceWith(inp_valido);
    
    // Se le asigna el valor al input
    e.target.value = valor_input;
  });

  function tiene_numero(x) {
    return /\d/.test(x);
  }
  function tiene_texto(x) {
      return /[^a-zA-Z ]/g.test(x);
  }
  function es_mail(x) {
      const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(x).toLowerCase());
  }

  function validar_inputs(contenedor){
    var vacios = 0;
    var invalidos = 0;
    $(contenedor+" input,"+contenedor+" textarea,"+contenedor+" select").each(function () {
      if( $(this).val() == '' && !$(this).hasClass("val_text")){
        vacios++;
      }else if( $(this).hasClass('val_text') && $(this).hasClass('is-invalid')){
        invalidos++;
      }
    });
    // console.log(invalidos,vacios);
    if(vacios > 0 && invalidos > 0){
      muestraMensajeError("Hay " +vacios+ " campo(s) sin rellenar y " +invalidos+ " campo(s) invalidos");
    }else if(vacios > 0){
      muestraMensajeError("Hay " +vacios+ " campos sin rellenar");
    }else if(invalidos > 0){
      muestraMensajeError("Hay " +invalidos+ " campos invalidos");
    }

    return vacios + invalidos;
  }

  function validar_perfil(contenedor){
    var vacios = 0;
    var invalidos = 0;
    // var pass = $("#password").attr("data-pass");
    $(contenedor+" input,"+contenedor+" textarea,"+contenedor+" select").each(function () {
      if( $(this).val() == '' && !$(this).hasClass("val_pass") || !$(this).hasClass("val_text")){
        vacios++;
      }else if( $(this).hasClass('val_text') && $(this).hasClass('is-invalid')){
        invalidos++;
      }
    });
    // console.log(invalidos,vacios);
    if(vacios > 0 && invalidos > 0){
      muestraMensajeError("Hay " +vacios+ " campo(s) sin rellenar y " +invalidos+ " campo(s) invalidos");
    }else if(vacios > 0){
      muestraMensajeError("Hay " +vacios+ " campos sin rellenar");
    }else if(invalidos > 0){
      muestraMensajeError("Hay " +invalidos+ " campos invalidos");
    }

    return vacios + invalidos;
  }

  $(document).on("click", "#editar_perfil", function(){
    if(validar_perfil("#form_editar_repartidor")==0){
      var usuario = $("#usuario").val();
      var verificacion_password = $("#password").val();
      if(verificacion_password.length>0){
        var password = verificacion_password;
      }else{
        var password = 0;
      }
      var correo = $("#correo").val();
      var num = $("#telefono").prev().find('.iti__selected-dial-code').html() + $("#telefono").val();
      num = num.substring(1);
      var tipo_vehiculo = $("#tipo_vehiculo").val();
      var modelo = $("#modelo").val();
      var color = $("#color").val();
      var detalles = $("#detalles").val();
      $.ajax({
        type: "POST",
        url: "../php/c/3/perfil/modificar_perfil.php",
        data: "usuario=" + usuario + "&password=" + password + "&correo=" + correo + "&num=" + num + "&tipo_vehiculo=" + tipo_vehiculo + "&modelo=" + modelo + "&color=" + color + "&detalles=" + detalles,
        success: function(respuesta){
          if(respuesta.status == "success"){

          }else{

          }
        }
      });
    }
  });

  function muestraMensajeError(mensaje) {
    $("#alert-danger").html(mensaje);
    $("#alert-danger").stop().fadeToggle("fast", function () {
      $("#alert-danger").css("display", "block");
      $("#alert-danger").fadeToggle(5500);
    });
  }
  function muestraMensajeOK(mensaje) {
    $("#alert-success").html(mensaje);
    $("#alert-success").stop().fadeToggle("fast", function () {
      $("#alert-success").css("display", "block");
      $("#alert-success").fadeToggle(5500);
    });
  }
  function muestraMensajeAdvertencia(mensaje) {
    $("#alert-warning").html(mensaje);
    $("#alert-warning").stop().fadeToggle("fast", function () {
      $("#alert-warning").css("display", "block");
      $("#alert-warning").fadeToggle(5500);
    });
  }
  function muestraMensajeInfo(mensaje) {
    $("#alert-primary").html(mensaje);
    $("#alert-primary").stop().fadeToggle("fast", function () {
      $("#alert-primary").css("display", "block");
      $("#alert-primary").fadeToggle(5500);
    });
  }
});