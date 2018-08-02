<?php



class Functions extends Database
{
    private $selectables = array();
    private $table;
    private $whereClause;
    private $inwhereClause;
    private $orwhereClause;
    private $andwhereClause;
    private $limit;
    private $c_name;
    private $value;
    private $order_type;
    private $group_name;
    private $join_table;
    private $f_c_join_name;
    private $s_c_join_name;
    private $query;
    private $conn;


    public function __construct()
    {
        $db = new Database();
        $this->conn =  $db->connect();

    }

    function __destruct() {
//       return $this->db_disconnect();
    }

    public function db_connect(){
        return $this->conn;
    }

    function db_disconnect(){
        return mysqli_close($this->conn);;
    }

    public function select() {
        $this->selectables = func_get_args();
        return $this;
    }

    public function from($table) {
        $this->table = $table;
        return $this;
    }

    public function where($where) {
        $this->whereClause = $where;
        return $this;
    }

    public function group_by($group) {
        $this->group_name = $group;
        return $this;
    }


    public function inwhere($where,array $value) {
        $this->inwhereClause = $where;
        $value = implode('","',$value);
        $this->value = $value;
        return $this;
    }

    public function andwhere($where) {
        $this->andwhereClause = $where;
        return $this;
    }

    public function orwhere($where) {
        $this->orwhereClause = $where;
        return $this;
    }


    public function limit($limit) {
        $this->limit = $limit;
        return $this;
    }

    public function join($join_table,$first_table_coloumn_name,$second_table_coloumn_name) {
        $this->join_table = $join_table;
        $this->f_c_join_name = $first_table_coloumn_name;
        $this->s_c_join_name = $second_table_coloumn_name;
        return $this;
    }

    public function order($c_name,$order_type = null) {

        if($order_type === null) {
            $this->order_type = 'ASC';
        }else {
            $this->order_type = $order_type;
        }

        $this->c_name = $c_name;
        return $this;
    }

    public function result($query_string = null) {
        $query[] = "SELECT";
        // if the selectables array is empty, select all
        if (empty($this->selectables)) {
            $query[] = "*";
        }
        // else select according to selectables
        else {
            $query[] = join(', ', $this->selectables);
        }

        $query[] = "FROM";
        $query[] = $this->table;

        if (!empty($this->join_table)) {
            $query[] = "JOIN ";
            $query[] = $this->join_table;
            $query[] = 'ON';
            $query[] = $this->table . "." .$this->s_c_join_name;
            $query[] = " = " . $this->join_table . "." .$this->f_c_join_name;


            // join sns_posts  on sns_users.id = sns_posts.user_id
        }
        if (!empty($this->whereClause)) {
            $query[] = "WHERE";
            $query[] = $this->whereClause;
        }


        if (!empty($this->andwhereClause)) {
            $query[] = "AND ";
            $query[] = $this->andwhereClause;
        }

        if (!empty($this->orwhereClause)) {
            $query[] = "OR ";
            $query[] = $this->orwhereClause;
        }


        if (!empty($this->inwhereClause)) {
            $query[] = "WHERE ";
            $query[] = $this->inwhereClause;
            $query[] = " IN (";
            $query[] = '"';
            $query[] =  $this->value;
            $query[] = '"';
            $query[] = ") ";
        }




        if (!empty($this->group_name)) {
            $query[] = "GROUP BY ";
            $query[] = $this->group_name;
        }

        if (!empty($this->c_name)) {
            $query[] = "ORDER BY";
            $query[] = $this->c_name;
            $query[] = $this->order_type;
        }

        if (!empty($this->limit)) {
            $query[] = "LIMIT";
            $query[] = $this->limit;
        }



        $query =  join(' ', $query);

        if($query_string === true) {
            return $query;
        }else {
            return $this->get($query);
        }




    }


    function get($query) {

        $query  = $this->run($query);
        if(mysqli_num_rows($query) === 1  ) {
            return mysqli_fetch_assoc($query);
        }


        foreach ( $query as $calue ) {
            $a[] = $calue;
        }

        if(!isset($a)) {
            return  false;
        }
        return $a;
    }

    public function run($query,$rrr = false) {
        if($rrr) {
            return $query;
        }
        $query = mysqli_query($this->conn,$query);
        if(!$query) {
            return 'SQL Error : ' . mysqli_error($this->conn);
        }

        return $query;
    }

    public function cleanInput($text)
    {
        $text = mysqli_real_escape_string($this->conn,$text);
        $text = stripslashes($text);
        $text = htmlentities($text);
        $text = htmlspecialchars($text);
        return  $text;
    }

    public function check_login() {
        if(!isset($_SESSION['admin_login'])) {
            header('location:index.php');
        }
    }
    public  function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
?>