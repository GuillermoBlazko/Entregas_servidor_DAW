<?php
include_once "Usuario.php";
include_once "config.php";

/*
 * Acceso a datos con BD Usuarios y Patrón Singleton 
 * Un único objeto para la clase
 */
class AccesoDatos
{

    private static $modelo      = null;
    private $dbh                = null;
    private $stmt_usuarios      = null;
    private $stmt_usuario       = null;
    private $stmt_boruser       = null;
    private $stmt_moduser       = null;
    private $stmt_creauser      = null;
    //creadas: 
    private $stmt_updateusr1    = null;
    private $stmt_updateusr0    = null;
    private $stmt_updateusrFULL = null; 
    private $stmt_updatesald    = null; 
    private $stmt_getlogin      = null; 
    public static function getModelo()
    {
        if (self::$modelo == null) {
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }



    // Constructor privado  Patron singleton

    private function __construct()
    {

        try {
            $dsn = "mysql:host=" . SERVER_DB . ";dbname=usuariosctl;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "root");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión " . $e->getMessage();
            exit();
        }
        // Construyo las consultas
        $this->stmt_usuarios  = $this->dbh->prepare("select * from Usuarios");
        $this->stmt_usuario   = $this->dbh->prepare("select * from Usuarios where login=:login");
        $this->stmt_boruser   = $this->dbh->prepare("delete from Usuarios where login =:login");
        $this->stmt_moduser   = $this->dbh->prepare("update Usuarios set nombre=:nombre, password=:password, comentario=:comentario where login=:login");
        $this->stmt_creauser  = $this->dbh->prepare("insert into Usuarios (login,nombre,password,comentario) Values(?,?,?,?)");
        //consultas UPDATE BLOQUEO: 
        // $this->stmt_updateusr1 = $this->dbh->prepare("update Usuarios set bloqueo = 1 where login in (:id)");
        // $this->stmt_updateusr0 = $this->dbh->prepare("update Usuarios set bloqueo = 0 where login not in (:id)");
        $this->stmt_updateusr1 = $this->dbh->prepare("update Usuarios set bloqueo=1 where login =:id");
        $this->stmt_updateusr0 = $this->dbh->prepare("update Usuarios set bloqueo=0 where login =:id");
        $this->stmt_updateusrFULL = $this->dbh->prepare("update Usuarios set bloqueo=0"); 

        //Recoger todos los login: 
        $this->stmt_getlogin   = $this->dbh->prepare("select distinct login from Usuarios"); 

        //consultas UPDATE SALDO: 
        $this->stmt_updatesald = $this->dbh->prepare("update Usuarios set saldo = saldo + (saldo*10/100) where login =:id"); 
    }

    //funciones creadas durante el examen: 
    public function updateUSR(Array $listausr):void
    {   
        //NEW: FALLO COLOSAL
        //recojo todos los valores: 
        $logins=[]; 
        if($this->stmt_getlogin->execute()){
            while($valor = $this->stmt_getlogin->fetch() )
            $logins[] = $valor;
            // var_dump($logins); 
        }
        //los recorro y compruebo si estan: 
        foreach($logins as $usr){
            // var_dump($usr); 
            // var_dump($logins);
            if(in_array($usr["login"],$listausr)){
                $this->stmt_updateusr1->bindParam(":id",$usr["login"]); 
                $this->stmt_updateusr1->execute(); 
            }else{
                $this->stmt_updateusr0->bindParam(":id",$usr["login"]); 
                $this->stmt_updateusr0->execute(); 
            }
        }
        
        // OLD: 
        // if(count($listausr)>0){
        //     $usrimp = implode(',', $listausr);
        //     // var_dump($usrimp); 
        //     //bindeamos las consultas. 
        //     $this->stmt_updateusr0->bindValue(":id",$usrimp); 
        //     $this->stmt_updateusr1->bindValue(":id",$usrimp); 
        //     //Ejecutamos
        //     $this->stmt_updateusr1->execute(); 
        //     $this->stmt_updateusr0->execute(); 
        // }
    }
    //bloquar a todos lo usuarios: 
    public function blockALL(){
        $this->stmt_updateusrFULL->execute(); 
    }
    //incrementar salario: 
    public function incrementarSaldo($usr){
        $this->stmt_updatesald->bindParam(":id", $usr);
        $this->stmt_updatesald->execute(); 

    }


    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo()
    {
        if (self::$modelo != null) {
            $obj = self::$modelo;
            $obj->stmt_usuarios = null;
            $obj->stmt_usuario  = null;
            $obj->stmt_boruser  = null;
            $obj->stmt_moduser  = null;
            $obj->stmt_creauser = null;
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo la lista de Usuarios
    public function getUsuarios(): array
    {
        $tuser = [];
        $this->stmt_usuarios->setFetchMode(PDO::FETCH_CLASS, 'Usuario');

        if ($this->stmt_usuarios->execute()) {
            while ($user = $this->stmt_usuarios->fetch()) {
                $tuser[] = $user;
            }
        }
        return $tuser;
    }

    // Devuelvo un usuario o false
    public function getUsuario(String $login)
    {
        $user = false;

        $this->stmt_usuario->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
        $this->stmt_usuario->bindParam(':login', $login);
        if ($this->stmt_usuario->execute()) {
            if ($obj = $this->stmt_usuario->fetch()) {
                $user = $obj;
            }
        }
        return $user;
    }

    // UPDATE
    public function modUsuario($user): bool
    {

        $this->stmt_moduser->bindValue(':login', $user->login);
        $this->stmt_moduser->bindValue(':nombre', $user->nombre);
        $this->stmt_moduser->bindValue(':password', $user->password);
        $this->stmt_moduser->bindValue(':comentario', $user->comentario);
        $this->stmt_moduser->execute();
        $resu = ($this->stmt_moduser->rowCount() == 1);
        return $resu;
    }

    //INSERT
    public function addUsuario($user): bool
    {

        $this->stmt_creauser->execute([$user->login, $user->nombre, $user->password, $user->comentario]);
        $resu = ($this->stmt_creauser->rowCount() == 1);
        return $resu;
    }

    //DELETE
    public function borrarUsuario(String $login): bool
    {
        $this->stmt_boruser->bindValue(':login', $login);
        $this->stmt_boruser->execute();
        $resu = ($this->stmt_boruser->rowCount() == 1);
        return $resu;
    }

    // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    {
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }
}
