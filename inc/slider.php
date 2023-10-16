<div class="slidersection templete clear">
        <div id="slider">
            <?php 
            /**
             * get all slider show to front-end
             * */ 
                $query = "SELECT * FROM blog_slider ORDER BY id LIMIT 5";
                $allSlider = $DB -> select($query);
                if($allSlider){
                    while($singleSlider = $allSlider -> fetch_assoc()){     
            ?>
            <a href="#"><img src="./admin/uploads/slider/<?php echo $singleSlider['image']; ?>" alt="nature 1" title="<?php echo $singleSlider['title']; ?>" /></a>
            <?php } } ?>
        </div>
</div>