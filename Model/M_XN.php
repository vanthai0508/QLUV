<?php
    include('Model/E_XN.php');
    class ModelXN
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
        public function addXN($IdUser,$NgayPV,$IdCV,$TinhTrang)
        {
            $sql="INSERT INTO xacnhan (Id_User,Ngaypv,Id_CV,TinhTrang) VALUES ('$IdUser','$NgayPV','$IdCV','$TinhTrang')";
            return $this->execute($sql);
        }
        public function listXN()
        {
            $sql="SELECT * FROM xacnhan ORDER BY Ngaypv ASC";
            $this->execute($sql);
          
            $xns=array();
              
            $i=1;
            while($data=mysqli_fetch_array($this->result))
                {
                    $Id_User=$data['Id_User'];
                    $NgayPV=$data['Ngaypv'];
                    $Id_CV=$data['Id_CV'];
                    $TinhTrang=$data['Tinhtrang'];
              
                
                    $xns[$i]=new EntityXN($Id_User,$NgayPV,$Id_CV,$TinhTrang);
                    $i++;
                }
            
        
            return $xns;

        }
        public function xacNhanChoUser($id)
        {
            $xn=array();
            $xns=array();
            $xns=$this->listXN();
            for($i=1;$i<=sizeof($xns);$i++)
            {
                if($xns[$i]->Id_User==$id && $xns[$i]->TinhTrang==0)
                {
                    $xn=$xns[$i];
                    continue;
                }
            }
            return $xn;
        }

        public function listUserThamGiaPV()
        {
            $sql = "SELECT * from xacnhan WHERE Tinhtrang=1  ";
            $this->execute($sql);
            $i= 1;
        //    $rs = mysqli_query($this->conn, $sql);
            $xns = array();
            while($row = mysqli_fetch_array($this->result)){
                $Id_User = $row['Id_User'];
                $NgayPV =  $row['Ngaypv'];
                $Id_CV = $row['Id_CV'];
                $TinhTrang =  $row['Tinhtrang'];
                $xns[$i] = new EntityXN($Id_User, $NgayPV,$Id_CV,$TinhTrang );
                $i++;
        }
        return $xns;
    
        }
    }



?>