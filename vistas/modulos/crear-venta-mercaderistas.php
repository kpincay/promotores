<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear venta para Mercaderistas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear venta</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-5 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
  
              <div class="box">

                <!--=====================================
                ENTRADA DEL LA FECHA DE REGISTRO
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" value="<?php echo date('Y-m-d'); ?>" required>

                  </div>

                </div>

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

                </div>

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================-->

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php

                    $item = null;
                    $valor = null;

                    $ventas = ControladorVentasM::ctrMostrarVentas($item, $valor);

                    if(!$ventas){

                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';
                  

                    }else{

                      foreach ($ventas as $key => $value) {
                        
                        
                      
                      }

                      $codigo = $value["codigo"] + 1;



                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';
                  

                    }

                    ?>
                    
                    
                  </div>
                
                </div>

                  <!--=====================================
                   ENTRADA DE LA CADENA
                   ======================================-->

<!--                  <div class="form-group">-->
<!---->
<!--                      <div class="input-group">-->
<!---->
<!--                          <span class="input-group-addon"><i class="fa fa-building"></i></span>-->
<!--                          <input type="hidden" name="nombreCadena" id="nombreCadena"> -->
<!---->
<!--                          <select class="form-control seleccionarCadena" id="seleccionarCadena" name="seleccionarCadena" onchange="cadenaSelected()" required>-->
<!---->
<!--                              <option value="">Seleccionar cadena</option>-->
<!---->
<!--                              --><?php
//
//                              $item = null;
//                              $valor = null;
//
//                              $categorias = ControladorCadenas::ctrMostrarCadenas($item, $valor);
//
//                              foreach ($categorias as $key => $value) {
//
//                                  echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
//
//                              }
//
//                              ?>
<!---->
<!--                          </select>-->
<!---->
<!--                      </div>-->
<!---->
<!--                  </div>-->

                  <!--=====================================
                   ENTRADA DE LA TIENDA
                   ======================================-->

<!--                  <div class="form-group">-->
<!---->
<!--                      <div class="input-group">-->
<!--                      <input type="hidden" name="nombreTienda" id="nombreTienda">-->
<!---->
<!--                          <span class="input-group-addon"><i class="fa fa-building"></i></span>-->
<!---->
<!--                          <select class="form-control seleccionarTienda" id="seleccionarTienda" name="seleccionarTienda" onchange="tiendaSelected()" required>-->
<!---->
<!--                              <option value="">Seleccionar tienda</option>-->
<!---->
<!--                          </select>-->
<!---->
<!--                      </div>-->
<!---->
<!--                  </div>-->

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select class="form-control selecionarcliente" id="seleccionarCliente" name="seleccionarCliente" required>

                    <option value="">Seleccionar cliente</option>

                    <?php

                      $item = null;
                      $valor = null;

                      $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                       foreach ($categorias as $key => $value) {

                         echo '<option value="'.$value["nombre"].'">'.$value["nombre"].'</option>';

                       }

                    ?>

                    </select>

<!--                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>-->

                  </div>

                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProducto">

                

                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">
                <input type="hidden" id="listaImeis" name="listaImeis">
                 <input type="hidden" id="errores" name="errores">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-8 pull-right">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Total</th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                          
                          <td style="width: 50%; display: none;">
                            
                            <div class="input-group">
                           
                              <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0">

                               <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto">

                               <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto">

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                        
                            </div>

                          </td>

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>

                              <input type="hidden" name="totalVenta" id="totalVenta">

                                <input type="hidden" class="form-control input-lg" id="proceso" name="proceso" value="mercaderista" readonly required>
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

                <div class="form-group row">
                  
                  <div class="col-xs-6" style="padding-right:0px">
                    
                     <div class="input-group">
                  
                      <select class="form-control" id="nuevoMetodoPago_" name="nuevoMetodoPago_" required>
                        <option value="">Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Credito">Crédito</option>
                        <option value="Payjoy">PayJoy</option>
                        <!-- <option value="TD">Tarjeta Débito</option>                   -->
                      </select>    

                    </div>

                  </div>

                  <div class="cajasMetodoPago"></div>

                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                </div>

                <br>
      
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>

          </div>

        </form>

        <?php

          $guardarVenta = new ControladorVentasM();
          $guardarVenta -> ctrCrearVenta();
          
        ?>

        </div>
            
      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaVentas">
              
               <thead>

                 <tr>
                  <th style="width: 10px">#</th>
                  <th>Imagen</th>
<!--                  <th>Costo</th>-->
                  <th>Descripcion</th>
<!--                  <th>Stock</th>-->
                  <th>Acciones</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>

    </div>
   
  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->
<!---->
<!--<div id="modalAgregarCliente" class="modal fade" role="dialog">-->
<!--  -->
<!--  <div class="modal-dialog">-->
<!---->
<!--    <div class="modal-content">-->
<!---->
<!--      <form role="form" method="post">-->
<!---->
<!--        <!--=====================================-->
<!--        CABEZA DEL MODAL-->
<!--        ======================================-->-->
<!---->
<!--        <div class="modal-header" style="background:#3c8dbc; color:white">-->
<!---->
<!--          <button type="button" class="close" data-dismiss="modal">&times;</button>-->
<!---->
<!--          <h4 class="modal-title">Agregar cliente</h4>-->
<!---->
<!--        </div>-->
<!---->
<!--        <!--=====================================-->
<!--        CUERPO DEL MODAL-->
<!--        ======================================-->-->
<!---->
<!--        <div class="modal-body">-->
<!---->
<!--          <div class="box-body">-->
<!---->
<!--            <!-- ENTRADA PARA EL NOMBRE -->-->
<!--            -->
<!--            <div class="form-group">-->
<!--              -->
<!--              <div class="input-group">-->
<!--              -->
<!--                <span class="input-group-addon"><i class="fa fa-user"></i></span> -->
<!---->
<!--                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>-->
<!---->
<!--              </div>-->
<!---->
<!--            </div>-->
<!---->
<!--            <!-- ENTRADA PARA EL DOCUMENTO ID -->-->
<!--            -->
<!--            <div class="form-group">-->
<!--              -->
<!--              <div class="input-group">-->
<!--              -->
<!--                <span class="input-group-addon"><i class="fa fa-key"></i></span> -->
<!---->
<!--                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento" required>-->
<!---->
<!--              </div>-->
<!---->
<!--            </div>-->
<!---->
<!--            <!-- ENTRADA PARA EL EMAIL -->-->
<!--            -->
<!--            <div class="form-group">-->
<!--              -->
<!--              <div class="input-group">-->
<!--              -->
<!--                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> -->
<!---->
<!--                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>-->
<!---->
<!--              </div>-->
<!---->
<!--            </div>-->
<!---->
<!--            <!-- ENTRADA PARA EL TELÉFONO -->-->
<!--            -->
<!--            <div class="form-group">-->
<!--              -->
<!--              <div class="input-group">-->
<!--              -->
<!--                <span class="input-group-addon"><i class="fa fa-phone"></i></span> -->
<!---->
<!--                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>-->
<!---->
<!--              </div>-->
<!---->
<!--            </div>-->
<!---->
<!--            <!-- ENTRADA PARA LA DIRECCIÓN -->-->
<!--            -->
<!--            <div class="form-group">-->
<!--              -->
<!--              <div class="input-group">-->
<!--              -->
<!--                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> -->
<!---->
<!--                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>-->
<!---->
<!--              </div>-->
<!---->
<!--            </div>-->
<!---->
<!--             <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->-->
<!--            -->
<!--            <div class="form-group">-->
<!--              -->
<!--              <div class="input-group">-->
<!--              -->
<!--                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> -->
<!---->
<!--                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>-->
<!---->
<!--              </div>-->
<!---->
<!--            </div>-->
<!--  -->
<!--          </div>-->
<!---->
<!--        </div>-->
<!---->
<!--        <!--=====================================-->
<!--        PIE DEL MODAL-->
<!--        ======================================-->-->
<!---->
<!--        <div class="modal-footer">-->
<!---->
<!--          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>-->
<!---->
<!--          <button type="submit" class="btn btn-primary">Guardar cliente</button>-->
<!---->
<!--        </div>-->
<!---->
<!--      </form>-->
<!---->
<!--      --><?php
//
//        $crearCliente = new ControladorClientes();
//        $crearCliente -> ctrCrearCliente();
//
//      ?>
<!---->
<!--    </div>-->
<!---->
<!--  </div>-->
<!---->
<!--</div>-->
<script>

    function cadenaSelected() {
        var nombreCadena = $("#seleccionarCadena :selected").text(); // The text content of the selected option
        var idCadena = $("#seleccionarCadena").val(); // The value of the selected option

        $("#nombreCadena").val("");
        $("#nombreCadena").val(nombreCadena);
        var datos = new FormData();


        $('#seleccionarTienda').find('option').remove().end()
            .append('<option value="">Seleccione tienda</option>').val('whatever');

        datos.append("idCadena", idCadena);
        $.ajax({

            url:"ajax/tiendas.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success:function(respuesta){

                $("#idTienda").val(respuesta["id"]);
                console.log(respuesta);
                // $.each(respuesta, function(key, value) {
                //     $('#seleccionarTienda')
                //         .append($("<option></option>")
                //             .attr("value", key)
                //             .text(value));
                // });
                var list = $("#seleccionarTienda");
                $.each(respuesta, function(index, item) {
                    list.append(new Option(item.nombre, item.id));
                });
            }
        })
    }

    function tiendaSelected(params) {
        var nombreTienda = $("#seleccionarTienda :selected").text(); // The text content of the selected option
        var idCadena = $("#seleccionarTienda").val(); // The value of the selected option

        $("#nombreTienda").val("");
        $("#nombreTienda").val(nombreTienda);

    }


    
    $('.selecionarcliente').select2();


</script>