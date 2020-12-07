<?php

/**
 * Created by PhpStorm.
 * User: haslek_UCNET
 * Date: 12/6/2020
 * Time: 1:09 PM
 */
spl_autoload_register(function ($classname){
    require_once $classname .".php";
});
class User
{
    private $email;
    private $password;
    private $user_id;
    private $con;
    private $error;

    public function __construct()
    {
        $sql = new Database();
        $this->con = $sql->getConn();
    }
    public static function withEmail($email,$password,$n_user=false){
        $instance = new self();
        $instance->loadByEmail($email,$password,$n_user);
        return $instance;
    }
    public static function withID( $id ) {
        $instance = new self();
        $instance->loadByID( $id );
        return $instance;
    }
    public static function withRow( array $row ) {
        $instance = new self();
        $instance->fill( $row );
        return $instance;
    }
    private function loadByEmail($email,$password,$n_user=false){
        $this->password = password_hash($password,1);
        $this->email = $email;
        $this->setId($n_user);
    }
    private function loadByID( $id ) {
        // do query
        $row = $this->con->query("Select * from users where id ='$id'")->fetch_assoc();
        $row = $row != null ? $row : [];
        $this->fill( $row );
    }

    private function fill( array $row ) {
        // fill all properties from array
        $this->email = isset($row['email'])?$row['email']: null;
        $this->password = isset($row['password'])? $row['password']: null;
        $this->user_id = isset($row['id']) ? $row['id']: null;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function subscribe($pet_ids = []){
        if(count($pet_ids) > 0){
            foreach ($pet_ids as $pet_id){
                $exist = $this->con->query("Select id from subscriptions WHERE pet = '$pet_id' and user_id = '$this->user_id'");
                if($exist->num_rows > 0){
                    continue;
                }
                $this->con->query("insert into subscriptions(pet,user_id) values('$pet_id','$this->user_id')");
            }
        }
        return "Channel list updated";
    }
    public function getId(){
        return $this->user_id;
    }
    public function getError(){
        return $this->error;
    }
    private function setId($n_user){
        $id = $this->con->query("Select id from users WHERE email ='$this->email'");
        if($n_user){
            if($id->num_rows > 0){
                $this->error = "User with that email already exists!";
            }else{
                $this->con->query("Insert into users(email,password) VALUES ('$this->email','$this->password')");
                $this->user_id = $this->con->insert_id;
            }
        }else{
            $this->user_id = $id->fetch_assoc()['id'];
        }
    }
    public function setPreferredChanel($p_id){
        $this->con->query("update subscriptions set preferred = 0 where user_id ='$this->user_id' AND preferred = 1");
        $exist = $this->con->query("Select id from subscriptions WHERE pet = '$p_id' and user_id = '$this->user_id'");
        if($exist->num_rows > 0){
            $this->con->query("update subscriptions set preferred = 1 where user_id ='$this->user_id' AND pet = '$p_id'");
            return $this->con->affected_rows;
        }
        $this->con->query("insert into subscriptions (pet,user_id,preferred) values('$p_id','$this->user_id',1)");
        return $this->con->insert_id;
    }
    public function getSubscriptions(){

        $res = $this->con->query("Select pets.*,subscriptions.preferred from pets, subscriptions where pets.id = subscriptions.pet and subscriptions.user_id = '$this->user_id'");
        return $res->fetch_all(1);

    }

}