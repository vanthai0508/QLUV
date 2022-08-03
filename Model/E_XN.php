<?php
class EntityXN
{
    public $Id_User;
    public $NgayPV;
    public $Id_CV;
    public $TinhTrang;
    public $Id_XN;

    public function __construct($_Id_User,$_NgayPV,$_Id_CV,$_TinhTrang,$_Id_XN)
    {
        $this->Id_User=$_Id_User;
        $this->NgayPV=$_NgayPV;
        $this->Id_CV=$_Id_CV;
        $this->TinhTrang=$_TinhTrang;
        $this->Id_XN=$_Id_XN;
    }
}



?>