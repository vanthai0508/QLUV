<?php
    
   // namespace Model;

    //use mysqli;

    include_once('Model/E_User.php');
    class ModelUser
    {
        private $hostname='localhost';
        private $username='root';
        private $pass='';
        private $dbname='QLUV'; 
        private $conn=null;
        private $result=null;

        public function connect()
        {
           // $this->conn=new mysqli($this->hostname);
            $this->conn=new mysqli($this->hostname,$this->username,$this->pass,$this->dbname);
            if(!$this->conn)
            {
                echo "Ket noi that bai";
                exit();
            }
            else {
                mysqli_set_charset($this->conn,'utf8');
            }
            return $this->conn;
        }
    
        public function execute($sql)
        {   
            $this->connect();
            $this->result=$this->conn->query($sql);
            return $this->result;
        }
        public function add($TDN,$MK,$Email)
        {
            $sql="INSERT INTO user (Tendangnhap,Matkhau,Email,Role) values ('$TDN','$MK','$Email',1)";
            return $this->execute($sql);
        }
        public function ktrauserpass($TDN,$MK)
        {
            $sql="SELECT * FROM user WHERE Tendangnhap='$TDN' AND Matkhau='$MK'";
            $this->execute($sql);
            if($this->num_rows()==0)
            {
                $ktra=0;
            }
            else{
                $ktra=1;
            }
            return $ktra;
    
        }
        public function num_rows()
        {
            if($this->result)
            {
                $num=mysqli_num_rows($this->result);
    
            }
            else {
                $num=0;
            }
            return $num;
        }
    }


?>