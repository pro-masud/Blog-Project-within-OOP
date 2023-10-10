<div class="footersection templete clear">
	  <div class="footermenu clear">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>
	  <p>&copy; Copyright Training with live project.</p>
	</div>
	<?php 
		/**
		 * get all social data to database
		 * */ 
		$query = "SELECT * FROM  blog_social WHERE id = '1'";
		$social = $DB -> select($query);

		if($social){
			while($singleSocial = $social -> fetch_assoc()){
	?> 
	<div class="fixedicon clear">
		<a href="<?php echo $singleSocial['fb']; ?>"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="<?php echo $singleSocial['tw']; ?>"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="<?php echo $singleSocial['lin']; ?>"><img src="images/in.png" alt="LinkedIn"/></a>
		<a href="<?php echo $singleSocial['gg']; ?>"><img src="images/gl.png" alt="GooglePlus"/></a>
	</div>
	<?php } } ?>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>