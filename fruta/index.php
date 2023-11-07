<?php
    
    session_start(); 
   $msg=""; 
    $compraRealizada="";
    if (isset($_GET["cliente"])){
        $_SESSION["cliente"]=$_GET["cliente"]; 
        $_SESSION["carrito"]=[]; 
} 


    if(!isset($_SESSION["cliente"])){
            require_once ('bienvenida.php'); 
            exit();
    }

    
    
    if (isset($_REQUEST["accion"])){
        switch($_REQUEST["accion"]){
            case "Anotar": 
                if (isset($_REQUEST["fruta"])){
                    if (isset($_REQUEST["cantidad"])&&$_REQUEST["cantidad"]>0){
                       $fruta = $_REQUEST["fruta"];
                       $cantidad =$_REQUEST["cantidad"];
                       
                       if(isset($_SESSION["carrito"][$fruta])){
                         $_SESSION["carrito"][$fruta]+=$cantidad; 
                       }else{
                            $_SESSION["carrito"][$fruta]=$cantidad; 
                       }
                    }else{
                        $msg="Se debe especificar una superior a cero";
                    }
                }else{
                    $msg="Se debe añadir un artículo";
                }
            break; 
            case "Borrar": 
                if(isset($_REQUEST["fruta"])){
                    if(isset($_REQUEST["cantidad"])&&isset($_REQUEST["cantidad"])>0){
                        $fruta = $_REQUEST["fruta"];
                        $cantidad =$_REQUEST["cantidad"];

                        if(isset($_SESSION["carrito"][$fruta])){
                            if($_SESSION["carrito"][$fruta]>$cantidad){
                                $_SESSION["carrito"][$fruta]-=$cantidad; 
                            }else{
                                unset($_SESSION["carrito"][$fruta]);
                            }
                        }else{
                            $msg ="No se puede eliminar un producto no añadido a la lista";
                        }                        
                    }else{
                        $msg = "Se debe especificar una fruta seleccionada"; 
                    }
                }else{
                    $msg="Se debe especificar un artículo";
                }
            break; 
            case "Terminar": 
                $compraRealizada = arraytotable($_SESSION["carrito"]);
                include_once ("despedida.php"); 
                session_destroy(); 
                exit;          
        }
    
    $compraRealizada = arraytotable($_SESSION["carrito"]);
    require_once ('compra.php'); 
    }

    function arraytotable():string{
        $html = '<table border="1">';
    
    foreach ($_SESSION["carrito"] as $key => $value) {
        $html .= '<tr>';
        $html .= "<td>$key</td>";
        $html .= "<td>$value</td>";
        $html .= '</tr>';
    }
    
    $html .= '</table>';
    
    return $html;

    } 
    