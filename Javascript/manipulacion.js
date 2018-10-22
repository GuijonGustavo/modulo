
/* <<<<<<<<<<<<<<<<<<   SCRIPT PARA AGREGAR FILA D EN LA Tabla >>>>>>>>>>>>>>>>>>>>>*/
	$(document).on('click','.clsAgregarFilad',function(){
   		var objCuerpo=$(this).parents().get(2);
		var objTabla=$(this).parents().get(3);
		var node= objTabla.childNodes[1].lastChild.cloneNode(true);
 	    var strNueva_Fila='<tr>'+ node.innerHTML + 		'</tr>';
		var pos_letra = strNueva_Fila.indexOf('h_origina') + 9;
		var pos_a = strNueva_Fila.substring( pos_letra, pos_letra + 6).indexOf('"');
	    var letra = strNueva_Fila.substring( pos_letra, pos_letra + pos_a ) ;
		var letra1 = (letra * 1 ) + 1;
        do { 
          strNueva_Fila = strNueva_Fila.replace('h_origina'+ letra ,'h_origina' + letra1 );
        } while(strNueva_Fila.indexOf('h_origina' + letra) >= 0);
		 strNueva_Fila = strNueva_Fila.replace('d_idorigen[]" value="a'+ letra ,'d_idorigen[]" value="a' + letra1 );
		//   alert(strNueva_Fila);
  	      $(objTabla).append(strNueva_Fila);
		if(!$(objTabla).find('tbody').is(':visible')){
			$(objTabla).find('caption').click();
		}
	});		
	

	$(document).on('click','.clsAgregarFilatc',function(){
   		var objCuerpo=$(this).parents().get(2);
		var objTabla=$(this).parents().get(3);
		var node= objTabla.childNodes[1].lastChild.cloneNode(true);
 	    var strNueva_Fila='<tr>'+ node.innerHTML + 		'</tr>';
		//   alert(strNueva_Fila);
		var pos_letra = strNueva_Fila.indexOf('z_origin') + 8;
		var pos_a = strNueva_Fila.substring( pos_letra, pos_letra + 20).indexOf('_');
	    var idt = strNueva_Fila.substring( pos_letra, pos_letra + pos_a); 
		var letra = strNueva_Fila.substring( pos_letra + pos_a + 2, pos_letra + pos_a + 3 ) ;
		var letra1 = (letra * 1 ) + 1;
         // alert(letra1);
        do { 
          strNueva_Fila = strNueva_Fila.replace('z_origin'+ idt + "_a"  +  letra ,'z_origin' + idt + "_a"  +  letra1 );
        } while(strNueva_Fila.indexOf('z_origin' + idt + "_a"  +  letra) >= 0);
          strNueva_Fila = strNueva_Fila.replace('value="a'+ letra , 'value="a' + letra1 );
         // alert(strNueva_Fila);
  	      $(objTabla).append(strNueva_Fila);
		if(!$(objTabla).find('tbody').is(':visible')){
			$(objTabla).find('caption').click();
		}
	});	
	
	$(document).on('click','.clsAgregarFilat',function(){
   		var objCuerpo=$(this).parents().get(2);
		var objTabla=$(this).parents().get(3);
		var node= objTabla.childNodes[1].lastChild.cloneNode(true);
 	    var strNueva_Fila='<tr>'+ node.innerHTML + 		'</tr>';
		 //  alert(strNueva_Fila);
		var pos_letra = strNueva_Fila.indexOf('g_titlet') + 8;
		var pos_a = strNueva_Fila.substring( pos_letra, pos_letra + 6).indexOf('"');
	    var letra = strNueva_Fila.substring( pos_letra, pos_letra + pos_a ) ;
		var letra1 = (letra * 1 ) + 1;
		 //alert( letra + "....." + letra1);
        do { 
          strNueva_Fila = strNueva_Fila.replace('t' +  letra ,'t'+  letra1 );
        } while(strNueva_Fila.indexOf('t' +  letra) >= 0);
          
		do { 
         strNueva_Fila = strNueva_Fila.replace('value="t'+ letra , 'value="t' + letra1 );
        } while(strNueva_Fila.indexOf('value="t' +  letra) >= 0);
 		 // alert(strNueva_Fila);
  	      $(objTabla).append(strNueva_Fila);
		if(!$(objTabla).find('tbody').is(':visible')){
			$(objTabla).find('caption').click();
		}
	});	
	
/* <<<<<<<<<<<<<<<<<<   SCRIPT PARA AGREGAR LA CLASE AUTOR >>>>>>>>>>>>>>>>>>>>>*/
$(document).on('click','.clsAutor',function(){
 	    var objCuerpo=$(this).parents().get(2);
			if($(objCuerpo).find('tr').length==1){
					return;
			}
		var objFila=$(this).parents().get(1);
		alert($(objFila).value);
		
	});

$(document).on('click','.clspre_azt',function(){
	   document.getElementsByName('areglo')[0].value = "c";	 
	//	alert(document.getElementsByName("areglo").length) 
	});

$(document).on('click','.clspre_az',function(){
	    alert(" Prueba de funcion clspre_az")    
	 
	});
	
});