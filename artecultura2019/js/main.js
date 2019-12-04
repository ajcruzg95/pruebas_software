$( document ).ready(function(){
	
	
	$(".colors a").click(function(){
		if($(this).attr("class") !="default"){
			$("#jquery-accordion-menu").removeClass(); 
		$("#jquery-accordion-menu").addClass("jquery-accordion-menu").addClass($(this).attr("class"));
	}else{
		$("#jquery-accordion-menu").removeClass(); 
		$("#jquery-accordion-menu").addClass("jquery-accordion-menu");
	}});
	
	$( '#menu-toggle' ).click(function() {
		
	  $( '#jquery-accordion-menu  ul li span' ).toggleClass( "hide" );
		
		$( '#jquery-accordion-menu' ).toggleClass( "jquery-accordion-menu-toggle" );
		
		$( '#container-nav-down' ).toggleClass( "container-nav-down-toggle" );
		
		$( '#container-down' ).toggleClass( "container-down-toggle" );
		
		$( '.jquery-accordion-menu-header  span' ).toggleClass( "hide" );
		
		$( '.jquery-accordion-menu-footer  span' ).toggleClass( "hide" );
		
		$( '#menu-toggle' ).toggleClass( "float-none" );
		
		$( '.fa-angle-left' ).toggleClass( "fa-angle-right" );
		
		
		$('.jquery-accordion-menu>ul>li>.submenu').css("display", "none");
		
		
	});
	
	$( '.jquery-accordion-menu>ul>li>a' ).click(function() {
		
		if($( '.jquery-accordion-menu-header span' ).hasClass('hide')){
			$( '#menu-toggle' ).click();
		}
		
	});
	
	$( '.fa-bars' ).click(function() {
		
		$( '#container-nav-down' ).toggleClass( 'container-nav-down-toggle' );
		
	});

})

