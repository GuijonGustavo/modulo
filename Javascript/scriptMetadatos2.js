// JavaScript Document

$(document).ready(function(){				
	
	$("#msgs_actualiza").fadeOut(10000);
	$("#mielemento").css("display", "block");
	
	$("#c_fecha_inicial, #c_fecha, #c_pubdate, #c_tiempo, #c_tiempo2").datepicker
	({
		changeYear: true,
		changeMonth: true,
		yearRange: "1999:2014",
		numberOfMonths: 1,
		dateFormat: 'dd/mm/yy',
	});
	   
	$('#datos').click(function (){
		
		var c_nombre 		= $('input[name = c_nombre]');
		var c_cobertura 	= $('input[name = c_cobertura]');
		var c_fecha_inicial = $('input[name = c_fecha_inicial]');
		var c_fecha 		= $('input[name = c_fecha]');
		var x_origin		= $('input[name ^= x_origin]');
		var c_publish 		= $('input[name = c_publish]');
		var c_publish_siglas= $('input[name = c_publish_siglas]');
		var estado			= $('select[name = estado]');
		var estadoOtro		= $('select[name = estado]').val();
		var municipio 		= $('select[name = municipio]');
		var c_pubplace 		= $('input[name = c_pubplace]');
		var c_pubdate 		= $('input[name = c_pubdate]');
		var c_escala 		= $('input[name = c_escala]');
		var c_escalaVal		= $('input[name = c_escala]').val();
		var c_issue 		= $('textarea[name = c_issue]');
		var c_resumen		= $('textarea[name = c_resumen]');
		var c_abstract		= $('textarea[name = c_abstract]');
		var c_objetivo 		= $('textarea[name = c_objetivo]');
		var c_tiempo 		= $('input[name = c_tiempo]');
		var c_tiempo2 		= $('input[name = c_tiempo2]');
		
		var validaDatos = [ [c_nombre 		, " Ingrese el T&iacute;tulo del Mapa"	] , 
								[c_cobertura	, " Ingrese el Nombre del Archivo"		] ,
								[c_fecha_inicial, " Seleccione la Fecha de Ingreso"		] ,
								[c_fecha		, " Seleccione la Fecha de Actualizaci&oacute;n"] ,
								[x_origin		, " Ingrese un Nombre de Autor"] ,
								[c_publish		, " Ingrese el nombre de la Instituci&oacute;n"] ,
								[c_publish_siglas," Ingrese las siglas de la Instituci&oacute;n"] ,
								[estado			, " Seleccione un Estado"] ,
								[c_pubdate		, " Ingrese la Fecha de Publicaci&oacute;n"] ,
								[c_escala		, " Ingrese la Escala de Mapa"] ,
								[c_issue		, " Ingrese la Descripci&oacute;n del Mapa"] ,
								[c_resumen		, " Ingrese la Resumen del Mapa"] ,
								[c_abstract		, " Ingrese el Abstract del Mapa"] ,
								[c_objetivo		, " Ingrese los Objetivos principales"] ,
								[c_tiempo		, " Ingrese la Fecha del Tiempo Comprendido"] ,
								[c_tiempo2		, " Ingrese la Fecha del Tiempo Comprendido"]
								
							  ];
		
		for (i = 0 ; i < validaDatos.length ; i++)
		{
			if (typeof(validaDatos[i]) !== 'undefined')
			{				
				if (validaDatos[i][0].val() == '') 
					{
						validaDatos[i][0].addClass('highlight');
						$('.error').replaceWith('<div class="error" >' + validaDatos[i][1] + '</div>');
						$('.error').fadeIn('slow');
						$(".error").fadeOut(10000);
						$(validaDatos[i][0]).focus();
						return false;
					}
				else	
					{
						validaDatos[i][0].removeClass('highlight');
						$('.error').hide();
					}
			}
		} // FIN FOR
		
		if (estadoOtro != '33')
		{
			if (municipio.val() == '') 
			{
				municipio.addClass('highlight');
				$('.error').replaceWith('<div class="error">Ingrese el municipio</div>');
				$('.error').fadeIn('slow');
				$(".error").fadeOut(10000);
				$(municipio).focus();
				return false;
			}
			else	
			{
				municipio.removeClass('highlight');
				$('.error').hide();
			}
		}
		else
		{
			if (c_pubplace.val() == '') 
			{
				c_pubplace.addClass('highlight');
				$('.error').replaceWith('<div class="error">Ingrese el lugar de publicaci&oacute;n</div>');
				$('.error').fadeIn('slow');
				$(".error").fadeOut(10000);
				$(c_pubplace).focus();
				return false;
			}
			else	
			{
				c_pubplace.removeClass('highlight');
				$('.error').hide();
			}
		}
		
		///<<<  ESPACIO DONDE SE VALIDA LA ESCALA >>>
		if (!validarEscala(c_escalaVal)) 
		{
			c_escala.addClass('highlight');
			$('.error').replaceWith('<div class="error">La escala es incorrecta <br> Ejemplo de escala 1:5000</div>');
			$('.error').fadeIn('slow');
			$(".error").fadeOut(10000);
			$(c_escala).focus();
			return false;
		} 
		else 	
		{
			c_escala.removeClass('highlight');
			$('.error').hide();
		}
		
		///<<<  ESPACIO DONDE SE VALIDA LAS FECHAS >>>
		var campos_fecha = ["c_fecha_inicial" , "c_fecha" , "c_pubdate" ,"c_tiempo" , "c_tiempo2"];	
		for (i = 0 ; i <= campos_fecha.length ; i++)
		{
			if (typeof(campos_fecha[i]) !== 'undefined')
			{
				var campo 	 = $('input[name= ' + campos_fecha[i] +']');
				var valFecha = $('input[name= ' + campos_fecha[i] +']').val();
				
				
				if (valFecha.length > 10) 
				{
					campo.addClass('highlight');
					$('.error').replaceWith('<div class="error">Ingrese correctamente la fecha <br>DD / MM / YYYY </div>');
					$('.error').fadeIn('slow');
					$(".error").fadeOut(10000);
					$(campo).focus();
					return false;
				} 
				
				if (!validarFecha(valFecha)) 
				{
					campo.addClass('highlight');
					$('.error').replaceWith('<div class="error">Ingrese correctamente la fecha <br>DD / MM / YYYY </div>');
					$('.error').fadeIn('slow');
					$(".error").fadeOut(10000);
					$(campo).focus();
					return false;
				} 
				else 	
				{
					campo.removeClass('highlight');
					$('.error').hide();
				}
			}
		}
					
	});// FIN $('#datos').click(function ()	
	
	$('#ubicacion').click(function (){
		
		var c_area_geo 	= $('textarea[name = c_area_geo]');
		var c_oeste 	= $('input[name = c_oeste]');
		var c_este 		= $('input[name = c_este]');
		var c_norte 	= $('input[name = c_norte]');
		var c_sur 		= $('input[name = c_sur]');
		
		var validaUbicacion = [ [c_area_geo	, " Ingrese el &Aacute;rea Geogr&aacute;fica"] ,
								[c_oeste	, " Ingrese las Coordenadas del Extremo Oeste"] ,
								[c_este		, " Ingrese las Coordenadas del Extremo Este"] ,
								[c_norte	, " Ingrese las Coordenadas del Extremo Norte"] ,
								[c_sur		, " Ingrese las Coordenadas del Extremo Sur"]
							  ];
		
		for (i = 0 ; i < validaUbicacion.length ; i++)
		{
			if (typeof(validaUbicacion[i]) !== 'undefined')
			{				
				if (validaUbicacion[i][0].val() == '') 
					{
						validaUbicacion[i][0].addClass('highlight');
						$('.error').replaceWith('<div class="error">' + validaUbicacion[i][1] + '</div>');
						$('.error').fadeIn('slow');
						$(".error").fadeOut(10000);
						$(validaUbicacion[i][0]).focus();
						return false;
					}
				else	
					{
						validaUbicacion[i][0].removeClass('highlight');
						$('.error').hide();
					}
			}
		} // FIN FOR
	});// FIN $('#ubicacion').click(function ()	
	
	$('#restricciones').click(function (){
		
		
		var c_acceso= $('input[name = c_acceso]');
		var c_uso 	= $('input[name = c_uso]');

		
		var validaRestriccion = [ 	[c_acceso	, " Ingrese la Restricci&oacute;n de Acceso"] ,
									[c_uso		, " Ingrese la Restricci&oacute;n de Uso"] 
							    ];
		
		for (i = 0 ; i < validaRestriccion.length ; i++)
		{
			if (typeof(validaRestriccion[i]) !== 'undefined')
			{				
				if (validaRestriccion[i][0].val() == '') 
					{
						validaRestriccion[i][0].addClass('highlight');
						$('.error').replaceWith('<div class="error">' + validaRestriccion[i][1] + '</div>');
						$('.error').fadeIn('slow');
						$(".error").fadeOut(10000);
						$(validaRestriccion[i][0]).focus();
						return false;
					}
				else	
					{
						validaRestriccion[i][0].removeClass('highlight');
						$('.error').hide();
					}
			}
		} // FIN FOR
	});// FIN $('#restricciones').click(function ()	
	
	$('#palabrasClave').click(function (){
		
		
		var m_Palabra_Clave	= $('input[name ^= m_Palabra_Clave]');
		var s_Sitios_Clave 	= $('input[name ^= s_Sitios_Clave]');

		
		var validapalabrasClave = [ [m_Palabra_Clave	, " Ingrese por lo menos un Tema"] ,
									[s_Sitios_Clave		, " Ingrese por lo menos un Sitio"] 
							      ];
		
		for (i = 0 ; i < validapalabrasClave.length ; i++)
		{
			if (typeof(validapalabrasClave[i]) !== 'undefined')
			{				
				if (validapalabrasClave[i][0].val() == '') 
					{
						validapalabrasClave[i][0].addClass('highlight');
						$('.error').replaceWith('<div class="error">' + validapalabrasClave[i][1] + '</div>');
						$('.error').fadeIn('slow');
						$(".error").fadeOut(10000);
						$(validapalabrasClave[i][0]).focus();
						return false;
					}
				else	
					{
						validapalabrasClave[i][0].removeClass('highlight');
						$('.error').hide();
					}
			}
		} // FIN FOR
	});// FIN $('#palabrasClave').click(function ()
	
	$('#calidadDeDatos').click(function (){
		
		var c_metodologia 			= $('input[name = c_metodologia]');
		var c_descrip_metodologia 	= $('textarea[name = c_descrip_metodologia]');
		var c_descrip_proceso		= $('textarea[name = c_descrip_proceso]');
		var d_nombre 				= $('input[name ^= d_nombre]');
		var d_publish				= $('input[name ^= d_publish]');
		var d_siglas 				= $('input[name ^= d_siglas]');
		var d_pubplace				= $('input[name ^= d_pubplace]');
		var d_edition				= $('input[name ^= d_edition]');
		var d_escala 				= $('input[name ^= d_escala]');
		var d_pubdate 				= $('input[name ^= d_pubdate]');
		var d_formato 				= $('input[name ^= d_formato]');
		var d_geoform				= $('input[name ^= d_geoform]');
		var h_origin 				= $('input[name ^= h_origin]');

		
		var validacalidadDeDatos = [ 	[c_metodologia 			, " Ingrese la metodolog&iacute;a utilizada"	] , 
										[c_descrip_metodologia	, " Ingrese la Descripci&oacute;n la metodolog&iacute;a"		] ,
										[c_descrip_proceso		, " Ingrese la Descripci&oacute;n del Proceso"		] ,
										[d_nombre		, " Ingrese el T&iacute;tulo"] ,
										[d_publish		, " Ingrese la Intituci&oacute;n"] ,
										[d_siglas		, " Ingrese las Siglas"] ,
										[d_pubplace		, " Ingrese el Lugar"] ,
										[d_edition		, " Ingrese la Versi&oacute;n"] ,
										[d_escala		, " Ingrese la Escala"] ,
										[d_pubdate		, " Ingrese la Fecha"] ,
										[d_formato		, " Ingrese el Formato Utilizado"] ,
										[d_geoform		, " Ingrese Dato Geoespacial"] ,
										[h_origin		, " Ingrese el Autor"]
								
							  	   ];
		
		for (i = 0 ; i < validacalidadDeDatos.length ; i++)
		{
			if (typeof(validacalidadDeDatos[i]) !== 'undefined')
			{				
				if (validacalidadDeDatos[i][0].val() == '') 
					{
						validacalidadDeDatos[i][0].addClass('highlight');
						$('.error').replaceWith('<div class="error">' + validacalidadDeDatos[i][1] + '</div>');
						$('.error').fadeIn('slow');
						$(".error").fadeOut(10000);
						$(validacalidadDeDatos[i][0]).focus();
						return false;
					}
				else	
					{
						validacalidadDeDatos[i][0].removeClass('highlight');
						$('.error').hide();
					}
			}
		} // FIN FOR					
	});// FIN $('#calidadDeDatos').click(function ()
	
	$('#taxonomia').click(function (){
		
		var t_taxon 		= $('input[name ^= t_taxon]');
		var t_taxonVal 		= $('input[name ^= t_taxon]').val();
		var t_reino 		= $('input[name ^= t_reino]');
		var t_division		= $('input[name ^= t_division]');
		var t_clase 		= $('input[name ^= t_clase]');
		var t_orden			= $('input[name ^= t_orden]');
		var t_familia 		= $('input[name ^= t_familia]');
		var t_genero		= $('input[name ^= t_genero]');
		var t_especie		= $('input[name ^= t_especie]');
		var t_nombre_comun 	= $('input[name ^= t_nombre_comun]');
		var g_title 		= $('input[name ^= g_title]');
		var g_publish 		= $('input[name ^= g_publish]');
		var g_siglas		= $('input[name ^= g_siglas]');
		var g_pubplace 		= $('input[name ^= g_pubplace]');
		var g_edition		= $('input[name ^= g_edition]');
		var g_pubdate 		= $('input[name ^= g_pubdate]');
		var z_origin		= $('input[name ^= z_origin]');

		
		var validaTaxonomia = [ 	[t_taxon 		, " Ingrese la Cobertura General"] , 
									[t_reino		, " Ingrese el Reino"] ,
									[t_division		, " Ingrese la Divisi&oacute;n"] ,
									[t_clase		, " Ingrese la Clase"] ,
									[t_orden		, " Ingrese el Orden"] ,
									[t_familia		, " Ingrese la Familia"] ,
									[t_genero		, " Ingrese el G&eacute;nero"] ,
									[t_especie		, " Ingrese la Especie"] ,
									[t_nombre_comun	, " Ingrese el Nombre Com&uacute;m"] ,
									[g_title		, " Ingrese el T&iacute;tulo"] ,
									[g_publish		, " Ingrese la Intituci&oacute;n"] ,
									[g_siglas		, " Ingrese las Siglas"] ,
									[g_pubplace		, " Ingrese el Lugar"] ,
									[g_edition		, " Ingrese la Versi&oacute;n"] ,
									[g_pubdate		, " Ingrese la Fecha"] ,
									[z_origin		, " Ingrese el Autor"]
								
							  ];
			if (t_taxonVal != '') 
			{				  
				for (i = 0 ; i < validaTaxonomia.length ; i++)
				{
					if (typeof(validaTaxonomia[i]) !== 'undefined')
					{
						if (validaTaxonomia[i][0].val() == '') 
							{
								validaTaxonomia[i][0].addClass('highlight');
								$('.error').replaceWith('<div class="error">' + validaTaxonomia[i][1] + '</div>');
								$('.error').fadeIn('slow');
								$(".error").fadeOut(10000);
								$(validaTaxonomia[i][0]).focus();
								return false;
							}
						else	
							{
								validaTaxonomia[i][0].removeClass('highlight');
								$('.error').hide();
							}
					}
				} // FIN FOR
			}
				
	});// FIN $('#taxonomia').click(function ()	
	
	$('#estructuraRaster').click(function (){
		
		var c_estructura_dato 	= $('input[name = c_estructura_dato]');
		var c_estructura_datoVal= $('input[name = c_estructura_dato]').val();
		var c_tipo_dato 		= $('input[name = c_tipo_dato]');
		var c_total_datos		= $('input[name = c_total_datos]');
		var r_nun_renglones 	= $('input[name = r_nun_renglones]');
		var r_num_columnas		= $('input[name = r_num_columnas]');
		var r_pixel_X 			= $('input[name = r_pixel_X]');
		var r_pixel_Y			= $('input[name = r_pixel_Y]');
		var r_COOR_X			= $('input[name = r_COOR_X]');
		var r_COOR_Y			= $('input[name = r_COOR_Y]');

		
		var validaRestricciones = [ [c_estructura_dato 	, " Ingrese la Estructura del Dato"] , 
									[c_tipo_dato		, " Ingrese el Tipo de Dato"] ,
									[c_total_datos		, " Ingrese el N&uacute;mero Total del Dato"] 							
							  	  ];
		var validaRaster = [ [r_nun_renglones, " Ingrese el N&uacute;mero de Renglones"] ,
							 [r_num_columnas, " Ingrese el N&uacute;mero de Columnas"] ,
							 [r_pixel_X		, " Ingrese el Tama&ntilde;o del pixel X"] ,
							 [r_pixel_Y		, " Ingrese el Tama&ntilde;o del pixel Y"] ,
							 [r_COOR_X		, " Ingrese la Coordenada X"] ,
							 [r_COOR_Y		, " Ingrese la Coordenada Y"] 								
						   ];
		
		for (i = 0 ; i < validaRestricciones.length ; i++)
		{
			if (typeof(validaRestricciones[i]) !== 'undefined')
			{
				if (validaRestricciones[i][0].val() == '') 
				{
					validaRestricciones[i][0].addClass('highlight');
					$('.error').replaceWith('<div class="error">' + validaRestricciones[i][1] + '</div>');
					$('.error').fadeIn('slow');
					$(".error").fadeOut(10000);
					$(validaRestricciones[i][0]).focus();
					return false;
				}
				else	
				{
					validaRestricciones[i][0].removeClass('highlight');
					$('.error').hide();
				}
			}
		} // FIN FOR			
		
		if (c_estructura_datoVal == "Raster" || c_estructura_datoVal == "raster" || c_estructura_datoVal == "RASTER")
		{
			for (i = 0 ; i < validaRaster.length ; i++)
			{
				if (typeof(validaRaster[i]) !== 'undefined')
				{
					if (validaRaster[i][0].val() == '') 
					{
						validaRaster[i][0].addClass('highlight');
						$('.error').replaceWith('<div class="error">' + validaRaster[i][1] + '</div>');
						$('.error').fadeIn('slow');
						$(".error").fadeOut(10000);
						$(validaRaster[i][0]).focus();
						return false;
					}
					else	
					{
						validaRaster[i][0].removeClass('highlight');
						$('.error').hide();
					}
				}
			} // FIN FOR	
		}
	});// FIN $('#estructuraRaster').click(function ()	
	
	$('#proyeccion').click(function (){
		
		var c_id_proyeccion = $('input[name = c_id_proyeccion]');
		var c_datum			= $('input[name = c_datum]');
		var c_elipsoide 	= $('input[name = c_elipsoide]');
		
		var validaProyeccion = [ [c_id_proyeccion, " Ingrese la Proyecci&oacute;n Cartogr&aacute;fica"] , 
								 [c_datum		 , " Ingrese el Datum"] ,
								 [c_elipsoide	 , " Ingrese el Nombre del Elipsoide"] 							
							   ];
		
		for (i = 0 ; i < validaProyeccion.length ; i++)
		{
			if (typeof(validaProyeccion[i]) !== 'undefined')
			{
				if (validaProyeccion[i][0].val() == '') 
				{
					validaProyeccion[i][0].addClass('highlight');
					$('.error').replaceWith('<div class="error">' + validaProyeccion[i][1] + '</div>');
					$('.error').fadeIn('slow');
					$(".error").fadeOut(10000);
					$(validaProyeccion[i][0]).focus();
					return false;
				}
				else	
				{
					validaProyeccion[i][0].removeClass('highlight');
					$('.error').hide();
				}
			}
		} // FIN FOR			
	});// FIN $('#proyeccion').click(function ()	
	
	$('#atributos').click(function (){
		
		var c_tabla 				= $('input[name = c_tabla]');
		var c_descrip_tabla			= $('textarea[name = c_descrip_tabla]');
		var a_nombre 				= $('input[name ^= a_nombre]');
		var a_descipcion_atributo 	= $('input[name ^= a_descipcion_atributo]');
		var a_fuente				= $('input[name ^= a_fuente]');
		var a_unidades 				= $('input[name ^= a_unidades]');
		var a_tipo 					= $('input[name ^= a_tipo]');
		
		var validaAtributos = [ [c_tabla				, " Ingrese el Nombre de la Entidad"] , 
								 [c_descrip_tabla		, " Ingrese la Descripci&oacute;n de la Entidad"] ,
								 [a_nombre	 			, " Ingrese el Nombre del Atributo"] ,
								 [a_descipcion_atributo	, " Ingrese la Descripci&oacute;n del Atributo"] , 
								 [a_fuente		 		, " Ingrese la Fuente del Atributo"] ,
								 [a_unidades	 		, " Ingrese las Unidades de Medida"] 	,
								 [a_tipo	 			, " Ingrese el Tipo de Dato"] 								
							   ];
		
		for (i = 0 ; i < validaAtributos.length ; i++)
		{
			if (typeof(validaAtributos[i]) !== 'undefined')
			{
				if (validaAtributos[i][0].val() == '') 
				{
					validaAtributos[i][0].addClass('highlight');
					$('.error').replaceWith('<div class="error">' + validaAtributos[i][1] + '</div>');
					$('.error').fadeIn('slow');
					$(".error").fadeOut(10000);
					$(validaAtributos[i][0]).focus();
					return false;
				}
				else	
				{
					validaAtributos[i][0].removeClass('highlight');
					$('.error').hide();
				}
			}
		} // FIN FOR			
	});// FIN $('#atributoss').click(function ()	
	
	var val_edo = document.getElementById("estado").value ;
	
	if (val_edo == 33) { $("#OTRO").show(); }
	
	var val_muni = document.getElementById("municipio").value ;
	
	if (val_muni) { document.getElementById("municipio").disabled = false; }
	
	var val_loc = document.getElementById("localidad").value ; 
			
	if (val_loc) { document.getElementById("localidad").disabled = false; }	
	
	
  }); // FIN $(document).ready(function()
	
	function validarFecha(valFecha)
	{
		var pattern = new RegExp("^(0[1-9]|[12][0-9]|3[01])[/](0[1-9]|1[012])[/](19[0-9]{2}|20[0-9]{2})");
		return pattern.test(valFecha);
	} 
	
	function validarEscala(valEscala)
	{
		var pattern = new RegExp("^(1)[:]([0-9])");
		return pattern.test(valEscala);
	} 
	
	function validarNro(e) 
	{
			var key;
			if(window.event)
				{key = e.keyCode;}
			else if(e.which)
				{key = e.which;}
			if (key < 48 || key > 57)
				{
					if(key == 46 || key == 8 || key == 45 || key == 58)
						{ return true; }
					else 
    					{ return false; }
				}
			return true;
	}
	
	function validarCampos(e)
	{
			var key;
			if(window.event)
				{key = e.keyCode;}
			else if(e.which)
				{key = e.which;}
			if (key != 39 )	{ return true; }
			else 			{ return false; }
			return true;
	}
		
	function cambioestado(str)
	{
		
		
		if ( str == "") 
		{
			
			document.getElementById("municipio").innerHTML = '<option value="">Seleccione un municipio</option>';
			document.getElementById("municipio").disabled = true;
			document.getElementById("localidad").innerHTML = '<option value="">Seleccione una localidad</option>';
			document.getElementById("localidad").disabled = true;

		}
		

		if ( str != "33" && str != "") 
		{

				loadDoc("estado="+str,"PHP/municipio.php", function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						document.getElementById("municipio").innerHTML=xmlhttp.responseText;
						document.getElementById("municipio").disabled = false;
						document.getElementById("localidad").innerHTML = '<option value="">Seleccione una localidad</option>';
						document.getElementById("localidad").disabled = true;
					}
				});
		}
		
		if (str === "33") 	
		{		

			$("#OTRO").show();
			
			document.getElementById("municipio").innerHTML = '<option value="">Seleccione un municipio</option>';
			document.getElementById("municipio").disabled = true;
			document.getElementById("localidad").innerHTML = '<option value="">Seleccione una localidad</option>';
			document.getElementById("localidad").disabled = true;
			

			
				
		}
		
		
		else	{ $("#OTRO").hide();	}
	}
	
	function cambiomunicipio(str)
	{

		loadDoc("municipio="+str,"PHP/localidad.php",function()
  		{
  			if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
    			document.getElementById("localidad").innerHTML=xmlhttp.responseText;
				document.getElementById("localidad").disabled = false;
    		}
  		});
	}
	
	function generaReino (val)
	{
		if ( val != "" ) 
		{
			loadDoc("taxonomia="+val,"PHP/cobertura.php",function()
  			{
  				if (xmlhttp.readyState==4 && xmlhttp.status==200)
    			{
					document.getElementById("listReino").innerHTML=xmlhttp.responseText;
				}
  			});
		}
	}
	
	function generaDivision (val)
	{
		if ( val != "" ) 
		{
			loadDoc("division="+val,"PHP/division.php",function()
  			{
  				if (xmlhttp.readyState==4 && xmlhttp.status==200)
    			{
					document.getElementById("listDivision").innerHTML=xmlhttp.responseText;
				}
  			});
		}
	}
	
	function generaClase (val)
	{
		if ( val != "" ) 
		{
			loadDoc("clase="+val,"PHP/clase.php",function()
  			{
  				if (xmlhttp.readyState==4 && xmlhttp.status==200)
    			{
					document.getElementById("listClase").innerHTML=xmlhttp.responseText;
				}
  			});
		}
	}
	
	function generaOrden (val)
	{
		if ( val != "" ) 
		{
			loadDoc("orden="+val,"PHP/orden.php",function()
  			{
  				if (xmlhttp.readyState==4 && xmlhttp.status==200)
    			{
					document.getElementById("listOrden").innerHTML=xmlhttp.responseText;
				}
  			});
		}
	}
	
	function generaFamilia (val)
	{
		if ( val != "" ) 
		{
			loadDoc("familia="+val,"PHP/familia.php",function()
  			{
  				if (xmlhttp.readyState==4 && xmlhttp.status==200)
    			{
					document.getElementById("listFamilia").innerHTML=xmlhttp.responseText;
				}
  			});
		}
	}
	
	
	function generaGenero (val)
	{
		if ( val != "" ) 
		{
			loadDoc("genero="+val,"PHP/genero.php",function()
  			{
  				if (xmlhttp.readyState==4 && xmlhttp.status==200)
    			{
					document.getElementById("listGenero").innerHTML=xmlhttp.responseText;
				}
  			});
		}
	}
	
	function generaEspecie (val)
	{
		if ( val != "" ) 
		{
			loadDoc("especie="+val,"PHP/especie.php",function()
  			{
  				if (xmlhttp.readyState==4 && xmlhttp.status==200)
    			{
					document.getElementById("listEspecie").innerHTML=xmlhttp.responseText;
				}
  			});
		}
	}
	
	function generaNombre (val)
	{
		if ( val != "" ) 
		{
			loadDoc("nombre="+val,"PHP/nombre.php",function()
  			{
  				if (xmlhttp.readyState==4 && xmlhttp.status==200)
    			{
					document.getElementById("listNombre").innerHTML=xmlhttp.responseText;
				}
  			});
		}
	}
	
	
	
	
	$(function() 
	{
		var name = $( "#name" ),
			allFields = $( [] ).add( name ),
			tips = $( ".validateTips" );

		var valor = $( "#nameDuplica" ),
			allFields = $( [] ).add( valor ),
			tips = $( ".validateTips" );
			
		
		function updateTips( t ) 
		{
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
				setTimeout(function() {		tips.removeClass( "ui-state-highlight", 5000 );	}, 5000 );
		}

		function checkLength( o, n, min) 
		{
			if ( o.val() == "" ) 
			{
				o.addClass( "ui-state-error" );
				updateTips( "Inserte el nombre del metadato" );
				return false;
			}
			
			else if ( o.val().length <= min ) 
			{
				o.addClass( "ui-state-error" );
				updateTips( "El nombre del metadato es muy corto" );
				return false;
			} 
			 
			else 
			{
				return true;
			}
		}

		function checkRegexp( o, regexp, n ) 
		{
			if ( !( regexp.test( o.val() ) ) ) 
			{
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} 
			else 
			{
				return true;
			}
		}

	
		$( "#dialog_nuevo" ).dialog
		({
			autoOpen: false,
			height: 250,
			width: 450,
			modal: true,
			buttons: 
			{
				"Crear Metadato": function() 
				{
					var bValid = true;
					allFields.removeClass( "ui-state-error" );

					bValid = bValid && checkLength( name, "username", 5);
					bValid = bValid && checkRegexp( name, /^[a-z] || [A-Z] ([0-9a-z_]) +$/i, "El nombre no debe contener carácteres ." );
					
					if ( bValid ) 	{ 	$( "#formNuevo" ).submit() }
				},
				
				"Cancelar": function() {	$( this ).dialog( "close" );	}
			},
			
			close: function() {		allFields.val( "" ).removeClass( "ui-state-error" );	}
		});
		
		
		
		
		
		$( "#dialog_duplica" ).dialog
		({
			autoOpen: false,
			height: 250,
			width: 450,
			modal: true,
			buttons: 
			{
				"Duplicar Metadato": function() 
				{
					var validacion = true;
					allFields.removeClass( "ui-state-error" );

					validacion = validacion && checkLength( valor, "username", 5);
					validacion = validacion && checkRegexp( valor, /^[a-z] || [A-Z] ([0-9a-z_]) +$/i, "El nombre no debe contener carácteres ." );
					
					if ( validacion ) 	{ 	$( "#formDuplica" ).submit() }
				},
				
				"Cancelar": function() {	$( this ).dialog( "close" );	}
			},
			
			close: function() {		allFields.val( "" ).removeClass( "ui-state-error" );	}
		});
		
		$( "#cerrar_sesion" ).dialog
		({
			autoOpen: false,
			resizable: false,
			height: 200,
			width: 450,
			modal: true,
			buttons: 
			{
				"Finalizar": function() 
				{
					$( "#formTerminoSesion" ).submit() 
				},
				
				"Cancelar": function() {	$( this ).dialog( "close" );	}
			},
		});
		

		$( "#nuevo" ).click(function() {	$( "#dialog_nuevo" ).dialog( "open" );	});
		$( "#duplica" ).click(function() {	$( "#dialog_duplica" ).dialog( "open" );	});
		
		$( "#cerrarSesion" ).click(function() {	$( "#cerrar_sesion" ).dialog( "open" );	});

	});
