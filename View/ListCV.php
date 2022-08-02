<head>
    <link rel="stylesheet" type="text/css" href="Css/Listcv.css">
</head>
<h2>DANH SÁCH CÁC CV</h2>
<div class="table-wrapper">
    <table class="fl-table">

        <thead>
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Vị trí</th>
                <th>Ngày apply</th>
                <th>Phone</th>
                <th>Link CV</th>
                <th>Id User</th>
                <th>Reject or approve</th>
            </tr>
        </thead>
        <tbody>
            <?php
           // $stt=1;
            for($i=1;$i<=sizeof($cvs);$i++){ ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $cvs[$i]->HoTen; ?></td>
                <td><?php echo $cvs[$i]->ViTri; ?></td>
                <td><?php echo $cvs[$i]->NgayApply; ?></td>
                <td><?php echo $cvs[$i]->Phone; ?></td>
                <td><a href="<?php echo $cvs[$i]->File;?>" >CV</a></td>
                <td><?php echo $cvs[$i]->Id_User; ?></td>
                <!-- <td><?php echo $cvs[$i]->Id_CV; ?></td> -->
                <td>
                    <a href="index.php?Controller=cv&Action=reject&idcv=<?php echo $cvs[$i]->Id_CV;?>">Reject</a>
                    <a href="index.php?Controller=cv&Action=approve&idcv=<?php echo $cvs[$i]->Id_CV;?>">Approve</a>
                </td>

            </tr>
            <?php
         //   $stt++;
            }
        ?>




            <!-- <?php
          
        ?> -->
        </tbody>
    </table>
</div>