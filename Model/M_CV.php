<?php
    include_once('Model/E_CV.php');

    class ModelCV
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
        public function addCV($HoTen,$ViTri,$NgayApply,$Phone,$File,$Id_User)
        {
            $sql="INSERT INTO cv (HoTen,Vitri,Ngayapply,Phone,File,Id_User,Trangthai) VALUES ('$HoTen','$ViTri','$NgayApply','$Phone','$File','$Id_User',0)";
            return $this->execute($sql);
        }
        public function listCV()
        {
            $cvs=array();
            $i=1;
            $sql="SELECT * FROM cv WHERE Trangthai=0 ";
            $this->execute($sql);
            while($data=mysqli_fetch_array($this->result))
            {
                $HoTen=$data['HoTen'];
                $ViTri=$data['Vitri'];
                $NgayApply=$data['Ngayapply'];
                $Phone=$data['Phone'];
                $File=$data['File'];
                $Id_User=$data['Id_User'];
                $Id_CV=$data['Id_CV'];
                $TrangThai=$data['Trangthai'];
                $cvs[$i]=new EntityCV($HoTen,$ViTri,$NgayApply,$Phone,$File,$Id_User,$Id_CV,$TrangThai);
                $i++;
            }
            return $cvs;
        }
        public function list()
        {
            $cvs=array();
            $i=1;
            $sql="SELECT * FROM cv ";
            $this->execute($sql);
            while($data=mysqli_fetch_array($this->result))
            {
                $HoTen=$data['HoTen'];
                $ViTri=$data['Vitri'];
                $NgayApply=$data['Ngayapply'];
                $Phone=$data['Phone'];
                $File=$data['File'];
                $Id_User=$data['Id_User'];
                $Id_CV=$data['Id_CV'];
                $TrangThai=$data['Trangthai'];
                $cvs[$i]=new EntityCV($HoTen,$ViTri,$NgayApply,$Phone,$File,$Id_User,$Id_CV,$TrangThai);
                $i++;
            }
            return $cvs;
        }
        public function daDuyet($Id_User)
        {
            $sql="UPDATE cv SET Trangthai=1 WHERE Id_User='$Id_User'";
            return $this->execute($sql);
        }
        public function cvTheoID($id)
        {
            $cvs=array();
            $cvs=$this->list();
            for($i=1;$i<=sizeof($cvs);$i++)
            {
                if($cvs[$i]->Id_CV==$id)
                {
                    return $cvs[$i];
                }
            }

        }
    }
?>