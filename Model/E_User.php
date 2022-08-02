<?php
    //namespace Entity;
    class EntityUser
    {
        public $Id_User;
        public $TenDangNhap;
        public $MatKhau;
        public $Email;

        public function __construct($_Id_User,$_TenDangNhap,$_MatKhau,$_Email)
        {
            $this->Id_User=$_Id_User;
            $this->TenDangNhap=$_TenDangNhap;
            $this->MatKhau=$_MatKhau;
            $this->Email=$_Email;
        }
    }

?>