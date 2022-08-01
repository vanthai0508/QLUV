<?php
    //namespace Entity;
    class EtityUser{
        public $TenDangNhap;
        public $MatKhau;
        public $Email;

        public function __construct($_TenDangNhap,$_MatKhau,$_Email)
        {
            $this->TenDangNhap=$_TenDangNhap;
            $this->MatKhau=$_MatKhau;
            $this->Email=$_Email;
        }
    }

?>