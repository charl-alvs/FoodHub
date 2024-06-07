<?php
    function showR($categories) {
        include('include/connectionDB.php');
        $query = "SELECT * FROM menu_tbl WHERE menu_category = ?";
        $statement = $connect -> prepare($query);
        $statement -> bind_param("s", $categories);
        $statement -> execute();
        $result = $statement -> get_result();
        if ($result -> num_rows > 0) {
            while ($rows = $result -> fetch_assoc()) {
                ?>
                <div class="col-md-3">
                    <div class="card shadow my-3">
                        <div class="card-body">
                        <img src="assets/menu-images/<?php echo $rows['menu_image']; ?>" 
                        style="width: 100%; height: fit-content;">
                        </div>
                        <div class="card-body py-0" style="height: fit-content;">
                            <label class="d-block text-truncate"
                                style="max-width: 400px; font-size: 1.3vw;"
                                title="<?php echo $rows['menu_name'] ?>">
                                <?php echo $rows['menu_name'] ?>
                            </label>
                        </div>
                        <div class="card-body py-0" style="height: fit-content;">
                            <?php echo "$ " . $rows['menu_price'] ?>
                        </div>
                        <div class="card-body" style="height: fit-content;">
                            <div class="text-center">
                                <?php
                                if ($rows['menu_status'] == "Available") {
                                    ?>
                                    <a href="database/updateProd.php?id=<?php echo $rows['id']; ?>" class="btn btn-success" onclick="return confirm('Are you sure you want to set this to ( Not Available ) ?')">
                                        <?php
                                        echo $rows['menu_status'];
                                        ?>
                                    </a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="database/updateProd.php?id=<?php echo $rows['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to set this to ( Available ) ?')">
                                        <?php
                                        echo $rows['menu_status'];
                                        ?>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
?>