var cambiar = 
{
   	accion:  function(show){ this.ocultar(); this.mostrar(show); },
   	ocultar: function()
	{ 
		var divs = document.getElementsByTagName('div');
		for(i=1; i<5;i++)
		{ 
			if (document.getElementById("div"+i).style.display == "block")
			{
				document.getElementById("div"+i).style.display = "none";
			}
		} 
	},
   	mostrar: function(num){ document.getElementById("div"+num).style['display'] = "block"; }
};



/*Ocultar Botones*/
$(document).ready(function()
{
	$(".accordion h1:first").addClass("active");
    $(".accordion div:not(:first)").hide();
    $(".accordion h1").click(function()
	{
    	$(this).next("div").slideToggle("fast")
     	.siblings("div:visible").slideUp("fast");
    	$(this).toggleClass("active");
    	$(this).siblings("h1").removeClass("active");
    });
	
	
});

$(document).ready(function(){
	
	if (document.getElementById("div1").style.display == "block") { desplegable (1);}
	
	$("button").click(function (){	for(i=1; i<5;i++){	if (document.getElementById("div"+i).style.display == "block")	{		desplegable (i);	}	}	});
});


function desplegable (numero){
	var top,bottom, y, page;
	var left = $('.tofix'+numero).offset().left;
	
	tofixwidth();
		
	$(window).scroll(function (event) {
		controlArticlePositions();
		if (y >= top && y<=bottom && y > page) 
		{
			$('.tofix'+numero).addClass('fixed');
			tofixl =  left-x;
			$('.tofix'+numero).css('left', tofixl);
				
		} 
		
		else {	$('.tofix'+numero).removeClass('fixed');	} 
	});

	$(window).resize(function() {	tofixwidth();	});

	function controlArticlePositions()
	{
		page = $('.page'+numero).offset().top;
		pageb = $('.tofix'+numero).height();
		top = $('.tofix'+numero).offset().top;
		bottom = page + $('.page'+numero).height() - pageb;
		y = $(window).scrollTop();
		x = $(window).scrollLeft();
	}

	function tofixwidth(){
		$('.tofix'+numero).css('width', '');			
		var sidebarW = $('.tofix'+numero).closest('.sidebar'+numero).css('width');
		$('.tofix'+numero).css('width', sidebarW);
	}
}