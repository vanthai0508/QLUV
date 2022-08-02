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
        public function kiemTra($TDN,$MK)
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
        public function kiemTraTDN($TDN)
        {
            $sql="SELECT * FROM user WHERE Tendangnhap='$TDN'";
            $this->execute($sql);
            if($this->num_rows()==0)
            {
                $Ktra=0;
            }
            else{
                $Ktra=1;
            }
            return $Ktra;
    
        }
        public function iduserTheoTenDN($Ten)
        {
            $users=array();
            $users=$this->listUser();
            for($i=1;$i<=sizeof($users);$i++)
            {
                if($users[$i]->TenDangNhap==$Ten)
                {
                    return $users[$i];
                }
            }
        }
        public function userTheoId($id)
        {
            $users=array();
            $users=$this->listUser();
            for($i=1;$i<=sizeof($users);$i++)
            {
                if($users[$i]->Id_User==$id)
                {
                    return $users[$i];
                }
            }
        }
        public function listUser()
        {
       
            $sql="SELECT * FROM user ";
            $this->execute($sql);
          
            $users=array();
              
            $i=1;
            while($data=mysqli_fetch_array($this->result))
                {
                    $Id_User=$data['Id_User'];
                    $Ten=$data['Tendangnhap'];
                    $MatKhau=$data['Matkhau'];
                    $Email=$data['Email'];
              
                
                    $users[$i]=new EntityUser($Id_User,$Ten,$MatKhau,$Email);
                    $i++;
                }
            
        
            return $users;
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