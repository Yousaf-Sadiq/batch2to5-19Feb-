<?php
declare(strict_types=1);
namespace src\database;

use mysqli;


class database
{

    // private  define("SERVER","localhost");
    private $server = "localhost";
    private $user_name = "root";
    private $pass = "";
    private $db = "oopscrudphp";

    protected $conn;

    private $query;

    private $exe;
    private $result = [];

    private $status = [
        "error" => 0,
        "msg" => []
    ];
    public function __construct()
    {

        $this->conn = new \mysqli($this->server, $this->user_name, $this->pass, $this->db);

        if ($this->conn) {
            // echo "ok";
        } else {
            echo $this->conn->error;
        }
    }



    public function checkEmail(string $email,string $table)
    {
        $check_email = "SELECT * FROM `{$table}` WHERE `email`= '{$email}'";

        $exe_email = $this->conn->query($check_email);


        if ($exe_email->num_rows > 0) {

            //    $this->status["error"]++;
            //    array_push($this->status["msg"], "Email already exist");

            //    echo json_encode($this->status);
            return true;

        } else {
            return false;

        }
    }


    public function insert_table(string $table, array $data)
    {
        /**
         *  INSERT INTO `table_name` (`column_name`,`column_name`)
         * VALUES ('value1','value2')
         */
        if ($this->CheckTable($table)) {

            $this->query = "INSERT INTO  `{$table}` ";


            $column = "`" . implode("`,`", array_keys($data)) . "`";
            $values = "'" . implode("','", array_values($data)) . "'";


            $this->query .= "({$column}) VALUES ({$values})";

            $this->exe = $this->conn->query($this->query);

            if ($this->exe) {
                if ($this->conn->affected_rows > 0) {

                    $this->status["msg"] = "Data has been inserted";
                    // return true;
                } else {
                    $this->status["error"]++;
                    $this->status["msg"] = "ERROR in Query " . $this->query;
                }

                return json_encode($this->status);

            } else {

                $this->status["error"]++;
                $this->status["msg"] = "ERROR in Query " . $this->query;

                return json_encode($this->status);
            }

        } else {

            $this->status["error"]++;
            $this->status["msg"] = "Table is not existed";

            return json_encode($this->status);
        }





    }


    private function CheckTable(string $table): bool
    {

        $this->query = "SELECT * 
  FROM information_schema.tables
  WHERE table_schema = '{$this->db}'
      AND table_name = '{$table}'
  LIMIT 1;";

        $this->exe = $this->conn->query($this->query);

        if ($this->exe->num_rows > 0) {

            return true;
        } else {
            return false;
        }

    }


}



class helper extends database
{

    public function filter_data(string $data)
    {
        $data = trim($data);
        $data = $this->conn->real_escape_string($data);
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);

        return $data;
    }

}

?>