<?php
class EntityXN
{
    public $Id_User;
    public $NgayPV;
    public $Id_CV;
    public $TinhTrang;

    public function __construct($_Id_User,$_NgayPV,$_Id_CV,$_TinhTrang)
    {
        $this->Id_User=$_Id_User;
        $this->NgayPV=$_NgayPV;
        $this->Id_CV=$_Id_CV;
        $this->TinhTrang=$_TinhTrang;
    }
}



?>