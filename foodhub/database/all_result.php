<?php
    function all() {
        include('include/connectionDB.php');
        $query = "SELECT * FROM menu_tbl ORDER BY id";
        $statement = $connect -> prepare($query);
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
                            <?php
                            if ($rows['menu_status'] == "Available") {
                                ?>
                                <div class="text-center text-success">
                                    <?php echo $rows['menu_status']; ?>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="text-center text-danger">
                                    <?php echo $rows['menu_status']; ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
?>