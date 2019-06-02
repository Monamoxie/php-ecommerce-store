<?php    
class Database extends mysqli 
{

    private $connections;
    public $last;
    public $insertId;
    private static $instance = null; 

    public function __construct() 
    {  
        $this->connections = new mysqli(SERVER, USERNAME, PASSWORD, DB);
        if (mysqli_connect_errno()) {
            trigger_error('Error connecting to host. ' . $this->connections->error, E_USER_ERROR);
        } 
    } 

    public static function getInstance()
    {
        if(!self::$instance)
    {
        self::$instance = new Database();
    }
        return self::$instance;
    }
	 
    public function runQuery($queryStr) 
    {
        if (!$result = $this->connections->query($queryStr))
        {
            trigger_error('Error executing query: ' . $queryStr . ' -' . $this->connections->error, E_USER_ERROR);
        } else 
        {
            $this->last = $result;
            $this->insertId = $this->connections->insert_id;
            return TRUE;
        }
    }

    public function getData() 
    {
        return $this->last->fetch_array(MYSQLI_ASSOC);
    }

    public function deleteData($table, $condition, $limit) 
    {
        $limit = ( $limit == '' ) ? '' : ' LIMIT ' . $limit;
        $delete = "DELETE FROM {$table} WHERE {$condition} {$limit}";
        $this->runQuery($delete);
    }

    public function numRows() 
    {
        return $this->last->num_rows;
    }
 
    public function updateData($table, $changes, $condition) 
    {
        $update = "UPDATE " . $table . " SET ";
        foreach ($changes as $field => $value) 
        {
            $update .= "`" . $field . "`='{$value}',";
        }

        $update = substr($update, 0, -1);
        if ($condition != '') {
            $update .= "WHERE " . $condition;
        }
        $this->runQuery($update);
        return true;
    }

    public function insertData($table, $data) 
    {
        $fields = "";
        $values = "";
        foreach ($data as $f => $v) {
            $fields .= "`$f`,";
            $values .= ( is_numeric($v) && ( intval($v) == $v ) ) ?
                $v . "," : "'$v',";
        } 
        $fields = substr($fields, 0, -1);
       
        $values = substr($values, 0, -1);
        $insert = "INSERT INTO $table ({$fields}) VALUES({$values})";
        return $this->runQuery($insert);
    }

    public function cleanData($value) 
    {
        if (get_magic_quotes_gpc()) {
            $value = stripslashes($value);
        }
        if (version_compare(phpversion(), "4.3.0") == "-1") {
            $value = $this->connections->escape_string($value);
        } else {
            $value = $this->connections->real_escape_string($value);
        }
        return $value;
    }
	 
    public function __destruct() 
    {
        $this->connections->close();
    }
    

}