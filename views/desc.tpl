<!DOCTYPE html>
<html>
<head>
	<title> <?php echo $site_title; ?> </title>
	<meta charset="utf8">  
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
   <link href="/static/bootstrap.min.css" rel="stylesheet" media="screen">
   <link href="/static/bootstrap-responsive.css" rel="stylesheet">
   <link href="/static/bootstrap.css" rel="stylesheet">

  <style type="text/css">
	body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
		background-image: url("../static/images/bgimg.png"); /*add the background picture */
      }

	
	/* Custom container */
      .container-narrow {
        margin: 0 auto;
        max-width: 900px;
	border-style: solid;
	border-color: transparent;
	background-color: #D8D8D8	;
	z-index: 9;
	height : 100%;
	-moz-border-radius: 15px;
	border-radius: 15px;
	
      }
      .container-narrow > hr {
        margin: 30px 0;
      }

	.sidebar-nav {
        padding: 20px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
	
  </style>

</head>
<body>

  <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          
          <a class="brand pull-left" href="/"><em><?php echo $site_title; ?></em></a>
	  
          <div class="nav-collapse collapse">
           
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>  <!-- end of div for nav bar-->
  
  <div class="container">
  <!-- <table class="table table-hover">
  <tr> -->
  <div class="hero-unit">
  <div>
  <h2><em><?php echo $item->TITLE   ?></em><h2> </div>
  <br/>
  
		<img src="/static/images/<?php echo $item->IMGSRC ?>" class="sale-photo">
	
		<h3>
			Item Description:
		</h3>
	
		<div id="description">
			<?php echo $item->DESCRIPTION ?>
		</div>
		
		<h3>
			Item Price: 
		</h3>
		
		<div id="price"><?php echo $item->PRICE ?>.00</div>

		<div>
			
		<h3>
			 <!-- <a href="../reserve/reserve.html">Reserve</a>  -->
       <a href="resform?id=<?php echo $item->ID ?>">Reserve</a>
		    
		</h3>
		
		</div>
  

 
  </div> <!-- end of the hero-unit-->
  </div> <!-- end of the container-->
  
</body>
</html>
