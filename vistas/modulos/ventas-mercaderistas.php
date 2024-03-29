<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$xml = ControladorVentasM::ctrDescargarXML();

if($xml){

  rename($_GET["xml"].".xml", "xml/".$_GET["xml"].".xml");

  echo '<a class="btn btn-block btn-success abrirXML" archivo="xml/'.$_GET["xml"].'.xml" href="ventas">Se ha creado correctamente el archivo XML <span class="fa fa-times pull-right"></span></a>';

}

?>

<head>
    <script src="https://www.jqueryscript.net/demo/Export-Html-Table-To-Excel-Spreadsheet-using-jQuery-table2excel/src/jquery.table2excel.js"></script>
</head>
<div class="content-wrapper">

  <section class="content-header"> 
    
    <h1>
      
      Administrar ventas para Mercaderistas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar ventas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="crear-venta-mercaderistas">

          <button class="btn btn-primary">
            
            Agregar venta

          </button>

        </a>

      <button class="btn btn-success" id="toExcel">

        Exportar Excel

      </button>

         <button type="button" class="btn btn-default pull-right" id="daterange-btn">
           
            <span>
              <i class="fa fa-calendar"></i> 

              <?php

                if(isset($_GET["fechaInicial"])){

                  echo $_GET["fechaInicial"]." - ".$_GET["fechaFinal"];
                
                }else{
                 
                  echo 'Rango de fecha';

                }

              ?>
            </span>

            <i class="fa fa-caret-down"></i>

         </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" id="table2excel" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Cliente</th>
<!--           <th>Cliente</th>-->
           <th>Imei(s)</th>
           <th>Cantidad</th>
           <th>Modelo</th>
           <th>Forma Pago</th>
           <th>Fecha</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

          $respuesta = ControladorVentasM::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

          foreach ($respuesta as $key => $value) {
           
           echo '<tr>

                  <td>'.($key+1).'</td>';

//                  $itemCliente = "id";
//                  $valorCliente = $value["id_cliente"];
//
//                  $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);
//
//                  echo '<td>'.$respuestaCliente["nombre"].'</td>';

              $itemUsuario = "id";
              $valorUsuario = $value["id_cliente"];

              $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

              $obj = json_decode($value["productos"], true);
              $obj_imei = json_decode($value["impuesto"], true);

              $imeis = "";
              $conteo = 0;
              foreach ($obj_imei as $item) {
                  $imeis .= " *" . $item["imei"];
                  $conteo += 1;
              }

              echo '<td>'.$value["id_cliente"].'</td>

                  <td style="width: 200px;">'.$imeis.'</td>

                  <td> '.$conteo.'</td>

                  <td>'.$obj[0]['descripcion'].'</td>
                  
                  <td>'.$value["metodo_pago"].'</td>

                  <td>'.$value["fecha"].'</td>

                  <td>

                    <div class="btn-group">

                    <!--aqui va la parte de abajo (botones)-->

                     
                      ';

//              <button class="btn btn-success btnImprimirTicket" codigoVenta="'.$value["codigo"].'">
//
//                        <i class="fa fa-print">Ticket</i>
//
//                      </button>
//
//                      <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'">
//
//                        <i class="fa fa-print"></i>PDF
//
//                      </button>
                      if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){
//                          <button class="btn btn-warning btnEditarVenta" idVenta="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
                      echo '
                      <button class="btn btn-warning btnEditarVentaM" idVenta="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger btnEliminarVentaM" idVenta="'.$value["id"].'"><i class="fa fa-times"></i></button>';

                    }

                    echo '</div>  

                  </td>

                </tr>';
            }

        ?>
               
        </tbody>

       </table>

       <?php

      $eliminarVenta = new ControladorVentasM();
      $eliminarVenta -> ctrEliminarVenta();

      ?>
       

      </div>

    </div>

  </section>

</div>

<script type="text/javascript">

    $(function() {
        $("#toExcel").click(function(){
            $("#table2excel").table2excel({
                exclude: ".noExl",
                name: "Excel Document Name"
            });
        });
    });
</script>


