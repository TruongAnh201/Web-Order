<?php
// file này gần giống với file table nhưng chỉ là nó nhỏ hơn
include_once('../../configs/dbConfig.php');
if (isset($_POST['id_cate'])) {
    $id_cate = $_POST['id_cate'];
    if ($id_cate == 0) { ?>

        <ul>
            <?php
            $table = "SELECT * FROM ban";
            $resultTable = mysqli_query($connect, $table);
            while ($rowTable = mysqli_fetch_array($resultTable)) { ?>
                <li id="table-status" <?php if ($rowTable['trangthai'] == 1) {
                                            echo 'class="tb-active"';
                                        } ?> id="<?php echo $rowtTable['maban']; ?>" onclick="order_table_load(<?php echo $rowTable['maban']; ?>)"><?php echo $rowTable['tenban']; ?></li>
            <?php }
            ?>
        </ul>

    <?php } else { ?>

        <ul>
            <?php
            $table = "SELECT * FROM ban where matang='$id_cate';";
            $resultTable = mysqli_query($connect, $table);
            while ($rowTable = mysqli_fetch_array($resultTable)) { ?>
                <li id="table-status" <?php if ($rowTable['trangthai'] == 1) {
                                            echo 'class="tb-active"';
                                        } ?> id="<?php echo $rowtTable['maban']; ?>" onclick="order_table_load(<?php echo $rowTable['maban']; ?>)"><?php echo $rowTable['tenban']; ?></li>
            <?php }
            ?>
        </ul>

<?php }
}
?>