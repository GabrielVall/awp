$(function() {
    var contenedor_vista = '#contenedor_inicio';

    cambiar_hash(contenedor_vista);
    $(window).on('hashchange', function() {
        cambiar_hash(contenedor_vista);
    });
    

    $(document).on('click', '#ref', function() {
        var ref = $(this).data('ref');
        window.location.href = '#' + ref;
    });
    // $(document).on('keydown', 'body', function(evt) {
    //     if (evt.shiftKey && evt.keyCode === 76) { 
    //         alert('locked');
    //     } 
    // });
    $(document).on('click', '#agregar_sucursal', function(){
        var id = $(this).data('id');
        var nombre_sucursal = $('#nombre_sucursal').val();
        var id_ciudad = $('#select_ciudad').val();
        var direccion = $('#direccion').val();
        var id_categ = $('#categoria_select').val();
        var tel = $("#telefono").val();
        var desc = $('#desc').val();
        var img = $('#imagen_sucursal').val();
        var lat = $('#lat_mp').val();
        var lng = $('#lng_map').val();
        var x = 0;
        switch (true) {
            case nombre_sucursal.length < 3:
                basic_alert('Formulario invalido','El nombre de la sucursal esta vacio o demasiado corto.');
                break;
            case !esNum(id_ciudad):
                basic_alert('Formulario invalido','Selecciona una ciudad valida para continuar');
                break;
            case direccion == '':
                basic_alert('Formulario invalido','Introudce una direccion valida');
                break;
            case direccion == '':
                basic_alert('Formulario invalido','Asegurate de utilizar el autocompletado');
                break;
            case !esNum(id_categ):
                basic_alert('Formulario invalido','Selecciona una categoria valida');
                break;
            case tel.length < 9:
                basic_alert('Formulario invalido','El numero de telefono no es valido');
                break;
            case desc.length < 30:
                basic_alert('Formulario invalido','La descripcion esta vacia o es demasiado corta');
                break;
            case lat == 0: 
            case lng == 0:
                basic_alert('Formulario invalido','Utiliza el autocompletado en el input de direcciones')
                break;
            default:
                if(id == 0){
                    if(img.length < 1){
                        console.log(id == 0,img.length < 1);
                        basic_alert('Formulario invalido','Selecciona una imagen valida');
                    }else{
                        insertar_sucursal_form(this);
                    }
                }else{
                    insertar_sucursal_form(this);
                }
                
            break;
        }
        
    });

    function insertar_sucursal_form(target){
        $(target).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...').addClass('unable');
        (async function(){
            await insertar_formulario('#formulario_sucursal','insertar_sucursal');
            $(target).html('Agregar sucursal').removeClass('unable');
            window.location.href = "";
        })();
    }
    
    



    $(document).on('change', '#pais_select', function() {
        cambiar_select_estado();
    });

    $(document).on('change', '#select_estado', function() {
        cambiar_ciudad_select();
    });

    $(document).on('change', '#select_ciudad', function() {
        cambiar_direccion_formulario();
    });

    $(document).on('input', '.validar_no_especiales', function(e) {
        validar_texto_no_especiales(e,$(this).data('min'));
    });


    $(document).on('click', '.audio_test', function() {
        var clase = $(this).data('audio');
        play(clase);
    });

    $(document).on('click', '#modal_cuenta_sucursal', function() {
        var arr_val = [];
        var valor1 = [];
        valor1.push('id_sucursal',$(this).data('id'))
        arr_val.push(valor1);
        (async function(){
            await imprimir_contenido('modal_cuenta', '#content_modal', arr_val);
            $('#cuenta_modal').modal('show');
            $('#pass_sucursal').val(generate_pwd());
        })();
    });

    $(document).on('click', '#reload_pass_suc', function() {
        $('#pass_sucursal').val(generate_pwd());
    });

    $(document).on('click', '#copiar_pass_suc', function() {
        copiar($('#pass_sucursal')[0]);
    });
    var timer_x;
    $(document).on('keydown','#user_sucursal', function(e) {
        var user = $(this).val();
        if((e.keyCode||e.which)==32){
            return false;
        }
        if(user.length > 5){
            clearTimeout(timer_x);
            $(this).next().removeClass('btn-danger btn-success').addClass('btn-default').html('<i class="fas fa-circle-notch fa-spin"></i>');
            $('#btn_add_usuario').addClass('disabled');
            timer_x = setTimeout(validar_usuario, 2000);
        }
    });

    $(document).on('click','#btn_add_usuario', function(e) {
        (async function(){
            await insertar_formulario('.modal-content','insertar_usuario_emp_com');
            if (status_ajx == 'success') {
                peticion_ajax_general('inicio', '#contenedor_inicio', 0);
            }
            status_ajx = '';
        })();
    });

    $(document).on('change','#editar_imagen_usuario', function(e) {
        var file = this.files[0];
        if(file !== ''){
            alertify.confirm('¿Estas seguro?', 'Cambiaras tu foto por una nueva', function(){
                (async function(){
                    await insertar_formulario('#form_imagen','actualizar_perfil_empresa');
                    if (status_ajx == 'success') {
                        peticion_ajax_general('configuracion', '#contenedor_inicio', 0);
                    }
                    status_ajx = '';
                })();
            }, function(){
                $('#editar_imagen_usuario').val('');
            });
            
        }
    });

    function validar_usuario() {
        if($('#user_sucursal').val().length > 5){
            (async function(){
                await insertar_formulario('.modal-content', 'validar_usuario');
                interval_x = 0;
                if (status_ajx == 'success' ) {
                    $('#user_sucursal').next().removeClass('btn-default btn-danger').addClass('btn-success').html('<i class="fas fa-check"></i>');
                    $('#btn_add_usuario').removeClass('disabled'); 
                }else{
                    $('#user_sucursal').next().removeClass('btn-default btn-success').addClass('btn-danger').html('<i class="fas fa-exclamation-circle"></i>');
                    $('#btn_add_usuario').addClass('disabled'); 
                }
                status_ajx = '';
            })();
        }else{
            $('#user_sucursal').next().removeClass('btn-default btn-success').addClass('btn-danger').html('<i class="fas fa-exclamation-circle"></i>');
            $('#btn_add_usuario').addClass('disabled'); 
        }
    }

    function generate_pwd() {
        var length = 8,
        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        return retVal;

    }

    function copiar(selector) {
        var copyText = selector;
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* Para dispositivos moviles */
        navigator.clipboard.writeText(copyText.value);
        basic_notify('message','Texto copiado al portapapeles');
    }

    array_autoc = [];
    $(document).on('blur', '#nombre_sucursal,#categoria_select', function(e) {   
        var nombre_sucursal = $("#nombre_sucursal").val();
        var categ_sucursal = $('option:selected', '#categoria_select').attr('data-cat'); 
        array_autoc = [
            "En "+nombre_sucursal+" disfruta de los mejores momentos con nuestras promociones y productos, ¿que esperas?, ven y disfruta!.",
            "Buscas "+categ_sucursal+", aqui lo tenemos, ven y encuentra nuestra gran variedad de productos",
            "Para "+categ_sucursal+" deliciosa, ¡visita "+nombre_sucursal+" hoy!, ¡Mira nuestra amplia selección de productos hechos especialmente para ti!",
        ];
        autocomplete_input()
    });

    function autocomplete_input(){ 
        
        try {
            autoCompleteJS.unInit();
        } catch (error) {
            
        }
        // Autocompletado de descripcion de sucursal
        autoCompleteJS = new autoComplete({
            selector: "#desc",
            placeHolder: "Describe tu negocio...",
            threshold: 0,
            searchEngine: "loose",
            data: {
                src: array_autoc,
                cache: false,
            },
            resultItem: {
                highlight: false
            },
            events: {
                input: {
                    selection: (event) => {
                        var selection = event.detail.selection.value;
                        autoCompleteJS.input.value = selection;
                    }
                }
            }
        });
        
    }

    $(document).on('keypress', '.validar_solo_numero', function(e) {
        var min = $(this).data('min');
        var max = $(this).data('max');
        if($(this).val().length > max ) {
         return false;
        }
        return /\d/.test(String.fromCharCode(e.keyCode));
    });

    var anm_entrada = 'animate__zoomIn';
    var anm_salida = 'animate__zoomOut';
    $(document).on('click','#guia_siguiente', function() {
        var total_guide = $('.guide').length;
        var activa = '.guide.active';
        if(total_guide < 3){
            $('#guia_siguiente').replaceWith('<button type="button" style="max-width:50%; font-size:1em;" class="btn bg-gradient-primary" data-bs-dismiss="modal">Terminar</button>');
        }
        $(activa).addClass(anm_salida);
        setTimeout(function() {
            $(activa).hide();
            $(activa).next().show().addClass(anm_entrada);
            $(activa).remove();
        },500);
        $('.guide:first').addClass('active');
    });
    

    $(document).on('click', '#preview_sucursal', function() {
        preview_sucursal();
    });


    // Audios js
    var audio_src = '';
    $(document).on('click', '.audio_modal', function() {
        var audio = $(this).next()[0];
        audio_src = $(audio).attr('src');
        $('.selected').removeClass('selected');
        $(this).parent().addClass('selected');
        audio.play();
    });

    var tipo_modal = 'notify';
    $(document).on('click', '#modal_sonido', function() {
        tipo_modal = $(this).data('tipo');
        var title_modal = $(this).parent().find('.my-auto').html();
        $('#title_modal').html('Cambiar sonido - ' + title_modal);
    });

    $(document).on('click','#cambiar_sonido', function(e) {
        localStorage.setItem(tipo_modal,audio_src);
        sonido_actual();
        cambiar_sonido_local();
    });

    $(document).on('click','[data-ayuda]', function() {
        var ayuda = $(this).data('ayuda');
        localStorage.removeItem(ayuda);
        window.location.href = '#'+ayuda;
    });

    $(document).on('change','#confirmar_desactivar', function(e) {
        $('#confirmar_desactivar').addClass('unable');
        if ($(this).is(':checked')) {
            $('#boton_desactivar').html('Espera 5');
            var t = 5;
            var x = setInterval(function() {
                t--;
                $('#boton_desactivar').html('Espera '+t);
                if(t < 1){
                    $('#boton_desactivar').removeClass('desactivado').addClass('activado').html('desactivar');
                    $('#confirmar_desactivar').removeClass('unable');
                    clearInterval(x);
                }
            },1000);
        }else{
            $('#boton_desactivar').addClass('desactivado').removeClass('activado').html('Desactivar');
            $('#confirmar_desactivar').removeClass('unable');
        }
    });

    $(document).on('click','#boton_desactivar', function() {
        insertar_formulario(this, 'desactivar_sucursales')
    });

    $(document).on('click','#modal', function() {
        var target = $(this);
        var vista = target.data('modal');
        target.html(add_load_btn(target,0,1));
        (async function(){
            await peticion_ajax_general(vista,'#contenido_modal',0,1);
            $('#modal_sucursal').modal('show');
            target.html(add_load_btn(target,1));
        })();
    });

    $(document).on('click','#insertar_categoria', function(e) {
        $(e.target).html(add_load_btn(e.target,0));
        (async function(){
            await insertar_formulario('#formulario_categoria','insertar_categoria',1);
            $(e.target).html(add_load_btn(e.target,1));
            $('#modal_sucursal').modal('hide');
            peticion_ajax_general('select_categorias_sucursal', '#id_categoria', '0');
        })();
        
    });

    
    

    $(document).on('click','#modal_complementos', function() {
        var pos = $(this).data('pos');
        var comp = this.getAttribute('complementos');
        if(comp != 0){
        comp = comp.split(',');
        comp = JSON.stringify(comp);
        }else{
            comp = 0;
        }
        $.ajax({
            type: 'POST',
            url:'../php/v/1/lista_complementos_sucursal.php',
            data:"pos=" + pos + "&comp=" + comp,
            success:function(respuesta){
                $('#contenido_modal').html(respuesta);
                $('#modal_sucursal').modal('show');
            }
        })
    });
    $(document).on('click','#agregar_ing_vista',function(e) {
        agregar_row_ingrediente(1);
    });

    $(document).on('click','#quitar_ing_vista', function(e) {
        var total_divs = $('.nom-comp').length;
        $('.nom-comp:last').remove();
        $('.precio-comp:last').remove();
        if(total_divs <= 2){
            $('#quitar_ing_vista').hide();
        }
    });

    $(document).on('click','#seleccionar_complementos', function(e) {
        var lista_complementos = $('#complementos_lista').val();
        var pos_complementos = $(this).data('pos');
        agregar_complementos_div(lista_complementos,pos_complementos);
        $('#modal_sucursal').modal('hide');
    });

    

    $(document).on('click','#agregar_complemento', function() {
        if(validar_inputs('#formulario_complementos') == 2){
            var id = $(this).data('id');
            var nombre_ingrediente = $('#nombre_complemento').val();
            var cantidad_minima_ingrediente = $('#cant_minima').val();
            var cantidad_maxima_ingrediente = $('#cant_maxima').val();
            var seleccion_multiple_ingrediente = $('#seleccion_multiple').val();
            var ingredientes_extra = [];
            $('.ingrediente_row').each(function() {
                var nombre = $(this).find('.nombre').val();
                var precio = $(this).find('.precio').val();
                var ingredientes = $(this).find('#modal_complementos')[0];
                try {
                    ingredientes = ingredientes.getAttribute('complementos');
                    ingredientes_extra.push({nombre:nombre,precio:precio,id_subcomplemento:ingredientes});
                } catch (error) {
                }
                
            });
            var ruta = '';
            if( id == 0){
                ruta = '../php/c/1/insertar_ingrediente.php';
            }else{
                ruta = '../php/c/1/editar_ingrediente.php';
            }
            $.ajax({
                type: 'POST',
                url: ruta,
                data:'id=' + id + '&nombre_ingrediente='+ nombre_ingrediente+ '&cantidad_minima_ingrediente=' + cantidad_minima_ingrediente+ '&cantidad_maxima_ingrediente=' + cantidad_maxima_ingrediente+ "&seleccion_multiple_ingrediente=" +  seleccion_multiple_ingrediente + "&ingredientes_extras=" + JSON.stringify(ingredientes_extra),
                success: function(respuesta) {
                    alerta_ajax('',respuesta.msg,respuesta.status,0);
                    vaciar_inputs_contenedor('#formulario_complementos');
                    quitar_complementos_generados();
                    if(id==0){
                        id = respuesta.id
                    }
                    $('.tab_suc:not(:first)').trigger('click');
                    cargar_tabla_ingredientes(id);
                    var btn = $('#agregar_complemento');
                    btn.html('Agregar complemento');
                    btn[0].setAttribute('data-id','0');
                    $('#cancelar_editar_complemento').remove();
                }
            });
        }
    });

    $(document).on('click','.tab_suc',function() {
        $('.tab_suc:not(.active)').each(function() {
            var to_hide= $(this).data('show');
            $(to_hide).slideUp();
        });
        var to_show = $(this).data('show');
        $('.tab_suc').removeClass('active-tab');
        $(this).addClass('active-tab');
        $(to_show).slideDown();
    });

    $(document).on('click','#btn_editar_complemento', function() {
        $('#cancelar_editar_complemento').remove();
        var id = $(this).data('id');
        var td = $(this).parent().parent().parent();
        var nombre = td.find('.nombre_ingrediente').html();
        var cantidad_minima = td.find('.cantidad_minima').html();
        var cantidad_maxima = td.find('.cantidad_maxima').html();
        var multiple = td.find('[data-multiple]').data('multiple');
        var complementos= $(this).data('complementos');
        quitar_complementos_generados();
        $('.tab_suc:first').trigger('click');
        generar_editar_ingrediente(id,nombre,cantidad_minima,cantidad_maxima,multiple,complementos);
        $('#agregar_complemento').html('Editar servicio').parent().append('<a href="javascript:void(0)" id="cancelar_editar_complemento" class="btn btn-danger">Cancelar</a>');
        $('#agregar_complemento')[0].setAttribute('data-id',id);
        $('#folio').val(new Date(nombre).getTime() + id);
    });

    $(document).on('click', '#btn_eliminar_complemento', function(e){
        var id = $(this).data('id');
        alertify.confirm('¿Estas seguro?', 'Esta accion no puede deshacerse.', function(){
            (async function(){
                insertar_formulario('#formulario_sucursal','desactivar_ingrediente',1,id);
                cargar_tabla_ingredientes(0);
            })();
        }, function(){});
    });

    $(document).on('click','#cancelar_editar_complemento', function() {
        $('#agregar_complemento').html('Agregar complemento');
        $('#agregar_complemento')[0].setAttribute('data-id',0);
        quitar_complementos_generados();
        vaciar_inputs_contenedor('#formulario_complementos');
        $(this).remove();
        $('#folio').val('');
    });

    $(document).on('click', '#agregar_producto',function(){
        (async function(){
            await insertar_formulario('#formulario_producto','insertar_producto',1);
            vaciar_inputs_contenedor('#formulario_producto');
        })();
        
    });

    $(document).on('change', '#tipo_unidad', function(){
        var target = $(this).parent().next();
        var target_kg = $('#precio_kg');
        if($(this).val() == 1){
            target.show();
            target_kg.val('1');
        }else{
            target.hide();
            target_kg.val('0');
        }
        
    });

    cambiar_sonido_local();
    

    


});