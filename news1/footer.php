<div id ="footer" style="background: linear-gradient(to right top, #797889,#656281,#524b79,#41356f,#301f64) !important;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

            <?php
    include "config.php";



        $sql = "SELECT * FROM settings";

        $result = mysqli_query($con,$sql);

        if (mysqli_num_rows($result) > 0)
        {
            
            while ($row = mysqli_fetch_assoc($result))
            {


?>
                <span><?php echo $row['footerdesc']?></span>
                <?php
            }
        }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
