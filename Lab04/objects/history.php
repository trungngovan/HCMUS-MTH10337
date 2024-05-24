<?php
class History {

    // database connection and table name
    private $conn;
    private $table_name = "history";

    // object properties
    public $id;
    public $action;
    public $time;

    public function __construct($db){
        $this->conn = $db;
    }

    // used by select drop-down list
    function read(){
        //select all data
        $query = "SELECT id, action, time FROM " . $this->table_name . " ORDER BY time";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function countAll(){
        $query = "SELECT id FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();

        return $num;
    }

    // create history action
    function create(){
        // insert query
        $query = "INSERT INTO " . $this->table_name . " SET id=:id, action=:action, time=:time";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->action = htmlspecialchars(strip_tags($this->action));
        $this->time = date('Y-m-d H:i:s');

        // bind values
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":action", $this->action);
        $stmt->bindParam(":time", $this->time);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
    }
}
?>
