<div class="sidebar clear">
    <div class="samesidebar clear">
        <h2>Categories</h2>
            <ul>
            <?php 
                $catQuery = "SELECT * FROM blog_category limit 6";
				$allCat = $DB -> select($catQuery);

				if($allCat){
					while($categroy = $allCat -> fetch_assoc()){
                        ?>
                <li><a href="posts.php?id=<?php echo $categroy['id']; ?>"><?php echo $categroy['name']; ?></a></li>
                <?php } }else{ ?>	
                    <li>No Category Insert</li>
                <?php } ?>				
            </ul>
    </div>
    
    <div class="samesidebar clear">
        <h2>Latest articles</h2>
        <?php 
                $query = "SELECT * FROM blog_post limit 4";	
                $posts = $DB -> select($query);
                if($posts){
                while($singlePost = $posts -> fetch_assoc()){
        ?>
            <div class="popular clear">
                <h3><a href="post.php?id=<?php echo $singlePost['id']; ?>"><?php echo $singlePost['title']; ?></a></h3>
                <a href="post.php?id=<?php echo $singlePost['id']; ?>"><img src="./admin/uploads/<?php echo $singlePost['image']; ?>" alt="MyImage"/></a>
                <?php echo $format -> textCount($singlePost['body'], 200); ?>
            </div>

            <?php  } }?>
    </div>
</div>