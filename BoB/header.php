<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
       <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<title><?php bloginfo('name'); ?></title>
	
		<?php wp_head(); ?>
	</head>
	
<body class="container-full" <?php body_class(); ?>>
<div class="wrapper">
            <header>

                  <nav>

                        <div class="menu-icon">
                              <i class="fa fa-bars fa-2x"></i>
                        </div>

                        <div class="logo">
						<a class="navbar-brand" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a> 
                        </div>

                        <div class="menu">
                              <ul>
								        <?php wp_page_menu() ?>
                              </ul>
                        </div>
                  </nav>

            </header>

           
</div>

			
		
		</header>
	
		<script type="text/javascript">

// Menu-toggle en javascript

$(document).ready(function() {
	  $(".menu-icon").on("click", function() {
			$("nav ul").toggleClass("showing");
	  });
});

// Scrolling Effect

$(window).on("scroll", function() {
	  if($(window).scrollTop()) {
			$('nav').addClass('black');
	  }

	  else {
			$('nav').removeClass('black');
	  }
})


</script>	
		<!-- /site-header -->	
		