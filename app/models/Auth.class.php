<?php
class Auth
{
    public database $db;
    public function __construct(){
        $this->db = new database();
    }
    public function is_logged_in()
    {
        if (isset($_SESSION["User"])) {
            return $_SESSION["User"];
        } elseif (isset($_COOKIE["Login"])) {
            $id = $this->isValidCookie($_COOKIE["Login"]);
            if ($id) {
                return $this->getUserData($id);
            }
        }
        return false;
    }

    public function login($data)
    {
        $arr["username"] = $data["username"];
        $arr["password"] = sha1($data["password"]);
        $remember = isset($data["remember"]) ? true : false;
        $query = "SELECT * FROM users WHERE (username = :username || university_id = :username) && password = :password LIMIT 1";
        $userdata = $this->db->read($query, $arr);
        if ($userdata === false) {
            return false;
        }
        $this->log_in($userdata);
        if ($remember == true) {
            $this->rememberMe($userdata);
        }
        return $userdata;
    }

    private function log_in($userdata)
    {
        $_SESSION["User"] = $userdata;
    }

    public function getUserData($id)
    {
        $query = "SELECT * FROM users WHERE id = :id LIMIT 1";
        return $this->db->read($query, [
            "id" => $id
        ]);
    }

    private function rememberMe($data)
    {
        $model = new Model();
        $cookie = array();
        $cookie_name = "Login";
        $query = "SELECT token from user_tokens WHERE token = :token LIMIT 1";
        $result = true;
        while ($result) {
            $cookie["value"] = sha1($data[0]->username) . $model->generateRandomString(40);
            $result = $this->db->read($query, [
                "token" => $cookie["value"]
            ]);
        }

        $cookie["date"] = strtotime('+15 days');
        setcookie($cookie_name, $cookie["value"], $cookie["date"]);
        $cookie["user_id"] = $data[0]->id;
        $query = "INSERT INTO user_tokens (token,expiry,user_id) VALUES(:value,:date,:user_id)";
        $this->db->write($query, $cookie);
    }

    private function isValidCookie($token)
    {
        $query = "SELECT * FROM user_tokens WHERE  token = :value && expiry >= :now";
        $data = $this->db->read($query, [
            "value" => $token,
            "now" => time()
        ]);
        if ($data) {
            return $data[0]->user_id;
        }
        return false;
    }

    public function hasRightPrivilege($privilegeRequired){
        $data = $this->is_logged_in();
        $RANK["admin"] = ["admin","techEmployee","lecturer","student"];
        $RANK["techEmployeed"] = ["techEmployee","lecturer","student"];
        $RANK["lecturer"] = ["lecturer","student"];
        $RANK["student"] = ["student"];
        if(in_array($privilegeRequired,$RANK[$data[0]->rank])){
            return true;
        }
        else{
            return false;
        }
    }
}


