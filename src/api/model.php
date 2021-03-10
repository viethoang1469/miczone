<?php
class model{
    protected $connect;
    public function __construct()
    {
        $this->connect = new mysqli("mariadb", "root", "root","db_todolist");
    }
    public function __destruct()
	{
		@mysqli_close($this->connect);
	}
    public function GetAllData()
    {
        // Check connection
        if ($this->connect->connect_error) {
            return false;
        }
        $sql = "SELECT *  FROM  list";
        $objResult = $this->connect->query($sql);
        $arrResult = [];
        if ($objResult->num_rows > 0) {
            // output data of each row
            while($row = $objResult->fetch_assoc()) {
                array_push($arrResult, $row);
            }
        } 
        return $arrResult;
    }
    public function insert($name, $status)
    {
        if ($this->connect->connect_error) {
            return false;
        }
        $sql = "INSERT INTO list(name,status)
                VALUES('$name', '$status')";
        if ($this->connect->query($sql) === TRUE) {
            return $this->connect->insert_id;
        }
        return false;
    }
    public function delete ($id)
    {
        if ($this->connect->connect_error) {
            return false;
        }
        $sql = "DELETE FROM list WHERE id = $id";
        if ($this->connect->query($sql) === TRUE) {
            return $id;
        }
        return false;
    }
    public function edit($id, $status)
    {
        if ($this->connect->connect_error) {
            return false;
        }
        $sql = "UPDATE list SET status='$status' WHERE id=$id";
        if($this->connect->query($sql) === TRUE) {
            return true;
        }
        return false;
    }
    

}
