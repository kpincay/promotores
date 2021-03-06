<?php

require_once "conexion.php";

class ModeloTiendas{

	/*=============================================
	CREAR Tienda
	=============================================*/

	static public function mdlIngresarTienda($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_cadena, nombre, ciudad, email, telefono, direccion, fecha_registro) VALUES (:id_cadena, :nombre, :ciudad, :email, :telefono, :direccion, :fecha_registro)");

		$stmt->bindParam(":id_cadena", $datos["id_cadena"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_registro", $datos["fecha_registro"], PDO::PARAM_STR);

        if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR TiendaS
	=============================================*/

	static public function mdlMostrarTiendas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR TIENDAS POR CADENAS
	=============================================*/

	static public function mdlMostrarTiendasPorCadenas($tabla, $item, $valor){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();
        return $stmt -> fetchAll();



		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	VALIDAR TIENDAS POR CADENAS
	=============================================*/

	static public function mdlValidarTiendasPorCadenas($tabla, $item, $valorTienda, $valorCiudad, $idCadena){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_cadena = $idCadena and nombre = '$valorTienda' ");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();



        $stmt2 = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_cadena = $idCadena and nombre = '$valorTienda' and ciudad = BINARY '$valorCiudad' ");

        $stmt2 -> execute();

        $f1 = $stmt ->fetch();
        $f2 = $stmt2 ->fetch();

        if ($f1 && $f2){
            $result['ciudad'] = 1;
            $result['tienda'] = 1;
            $result['result'] = 1;
        }elseif (!$f1  && $f2){
            $result['ciudad'] = 1;
            $result['tienda'] = 0;
            $result['result'] = 0;
        }elseif (!$f2  && $f1){
            $result['ciudad'] = 0;
            $result['tienda'] = 1;
            $result['result'] = 0;
        }else{
            $result['ciudad'] = 0;
            $result['tienda'] = 0;
            $result['result'] = 0;
        }

        return $result;
		$stmt2 = null;
        $stmt = null;

	}

	/*=============================================
	EDITAR Tienda
	=============================================*/

	static public function mdlEditarTienda($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, ciudad = :ciudad, email = :email, telefono = :telefono, direccion = :direccion, fecha_registro = :fecha_registro WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		// $stmt->bindParam(":id_cadena", $datos["id_cadena"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_registro", $datos["fecha_registro"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR Tienda
	=============================================*/

	static public function mdlEliminarTienda($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR Tienda
	=============================================*/

	static public function mdlActualizarTienda($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}