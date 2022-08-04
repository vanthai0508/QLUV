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
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
           
            for($i=1;$i<=sizeof($xns);$i++){ 
               ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $cv[$i]->HoTen; ?></td>
                <td><?php echo $cv[$i]->ViTri; ?></td>
                <td><?php echo $cv[$i]->NgayApply; ?></td>
                <td><?php echo $cv[$i]->Phone; ?></td>
                <td><img src="Model\uploads\<?php echo $cv[$i]->File; ?>"></td>
                <td><?php echo $user[$i]->Email; ?></td>
            
                

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