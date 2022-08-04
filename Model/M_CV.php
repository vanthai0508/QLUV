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
        public function upAnh()
        {
        //    if(isset($_POST["submitcv"])) {
                $target_dir = "Model/uploads/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if($check !== false) {
             //   echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            
        
            // Check if file already exists
            if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
            }
        
            // Check file size
            if ($_FILES["file"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
            }
        
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, jpeg, PNG & GIF files are allowed.";
            $uploadOk = 0;
            }
           // move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
              //  echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
            //    echo htmlspecialchars( basename( $_FILES["file"]["name"]));
                
            }
            
        //}
        return htmlspecialchars( basename( $_FILES["file"]["name"]));
    } 
}
    
?>