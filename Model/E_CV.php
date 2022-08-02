<?php
    class EntityCV
    {
        public $HoTen;
        public $ViTri;
        public $NgayApply;
        public $Phone;
        public $File;
        public $Id_User;
        public $Id_CV;

        public function __construct($_HoTen,$_ViTri,$_NgayApply,$_Phone,$_File,$_Id_User,$_Id_CV)
        {
            $this->HoTen=$_HoTen;
            $this->ViTri=$_ViTri;
            $this->NgayApply=$_NgayApply;
            $this->Phone=$_Phone;
            $this->File=$_File;
            $this->Id_User=$_Id_User;
            $this->Id_CV=$_Id_CV;
        }
    }

?>