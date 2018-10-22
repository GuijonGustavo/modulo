$(document).ready(function () 
{
	//if submit button is clicked
	$('#iniciar').click(function () 
	{
		//Get the data from all the fields
		var usuario = $('input[name=usuario]');
		var password = $('input[name=password]');
		var c_nombre = $('input[name=c_nombre]');
		
		if (usuario.val() == '') 
		{
			usuario.addClass('highlight');
			$('.error').replaceWith('<div class="error">Ingrese el nombre de usuario</div>');
			$('.error').fadeIn('slow');
			$(usuario).focus();
			return false;
		}
	
		if (usuario.val().length <= 4) 
		{
			usuario.addClass('highlight');
			$('.error').replaceWith('<div class="error">El nombre de usuario debe tener m&iacute;nimo 5 car&aacute;cteres</div>');
			$('.error').fadeIn('slow');
			$(usuario).focus();
			return false;
		}
	
		else 
		{
			usuario.removeClass('highlight');
			$('.error').hide();
		}
	
		if (password.val() == '') 
		{
			password.addClass('highlight');
			$('.error').replaceWith('<div class="error">Ingrese su password</div>');
			$('.error').fadeIn('slow');
			$(password).focus();
			return false;
		} 
		
		if (password.val().length <= 4) 
		{
			password.addClass('highlight');
			$('.error').replaceWith('<div class="error">El password debe de tener m&iacute;nimo 5 car&aacute;cteres</div>');
			$('.error').fadeIn('slow');
			$(password).focus();
			return false;
		} 
	
		else 
		{
			password.removeClass('highlight');
			$('.error').hide();
		}
	}); // fin $('#iniciar')
}); // fin $(document)