<?php 
function sql ($campo, $id , $cv_principal , $cve)
{
	switch ($campo)
    {
		case "seleccion":			$array = array(	'SELECT "record_id" , "nombre" FROM coberturas  ORDER BY "nombre" ASC;',
													'SELECT coberturas."record_id" , coberturas."nombre" FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' ORDER BY coberturas."nombre" ASC ;'); break;
	 
	 	case "c_nombre":			$array = array(	'SELECT c."nombre" 			FROM coberturas AS c WHERE c."record_id" = '.$id.';',
	 												'SELECT c."nombre" 			FROM coberturas AS c GROUP BY c."nombre" 		HAVING c."nombre" 			Is Not Null ;',
													'SELECT coberturas."nombre" FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'); break;
											   
		case "c_cobertura":			$array = array( 'SELECT c."cobertura"			FROM coberturas AS c WHERE c."record_id" = '.$id.';',	
	 												'SELECT c."cobertura" 			FROM coberturas AS c GROUP BY c."cobertura" 	HAVING c."cobertura" 		Is Not Null ;',
													'SELECT coberturas."cobertura" 	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;
	
	 	case "c_fecha_inicial":		$array = array(	'SELECT c."fecha_inicial" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													'SELECT c."fecha_inicial" 			FROM coberturas AS c GROUP BY c."fecha_inicial" HAVING c."fecha_inicial" 	Is Not Null ;',
													'SELECT coberturas."fecha_inicial" 	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;								
												
	 	case "c_fecha": 			$array = array(	'SELECT c."fecha" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													'SELECT c."fecha" 			FROM coberturas AS c GROUP BY c."fecha"			HAVING c."fecha" 			Is Not Null ;',
													'SELECT coberturas."fecha" 	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;			
	 
	 	case "c_version":			$array = array(	'SELECT c."version" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													'SELECT c."version" 			FROM coberturas AS c GROUP BY c."version" 		HAVING c."version" 			Is Not Null ;',
													'SELECT coberturas."version" 	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;		
	 
	 	case "x_origin": 			$array = array(	'SELECT x."origin" 			FROM autores 	AS x WHERE x."dataset_id" = '.$id.';',
	 												'SELECT x."origin" 			FROM autores 	AS x GROUP BY x."origin" 		HAVING x."origin" 			Is Not Null ;' ,
													'SELECT autores."origin" 	FROM coberturas inner join autores on autores."dataset_id" = coberturas."record_id" and coberturas."record_id" ='.$id.';'); break;
	 
	 	case "c_publish":			$array = array( 'SELECT c."publish"   			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',     
		 											'SELECT c."publish_1" 			FROM institucion AS c GROUP BY c."publish_1" HAVING c."publish_1" Is Not Null ORDER BY  c."publish_1" ASC;',
													'SELECT coberturas."publish" 	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;		
	 
	 	case "c_publish_siglas":   $array = array( 	'SELECT c."publish_siglas"  		FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',    
		  											'SELECT c."publish_siglas_1" 		FROM institucion AS c GROUP BY c."publish_siglas_1" HAVING c."publish_siglas_1" Is Not Null ORDER BY  c."publish_siglas_1" ASC;',
													'SELECT coberturas."publish_siglas" FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
												
	 	case "c_pubplace":  	   $array = array(	'SELECT c."pubplace" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;', 
													'SELECT c."pubplace_1" 			FROM lugar AS c GROUP BY c."pubplace_1" HAVING c."pubplace_1" Is Not Null ORDER BY  c."pubplace_1" ASC;',
													'SELECT coberturas."pubplace" 	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
												
	 	case "c_pubdate": 			$array = array(	'SELECT c."pubdate" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													'SELECT c."pubdate" 			FROM coberturas AS c GROUP BY c."pubdate" 		HAVING c."pubdate"  		Is Not Null ;',
													'SELECT coberturas."pubdate" 	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
	 
	 	case "c_edition":  			$array = array( 'SELECT c."edition" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													'SELECT c."edition" 			FROM coberturas AS c GROUP BY c."edition" 		HAVING c."edition"			Is Not Null ;',
													'SELECT coberturas."edition" 	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
	 
	 	case "c_escala":			$array = array(	'SELECT c."escala" 				FROM coberturas AS c WHERE  c."record_id" = '.$id.' ;',
	 												"SELECT b.traduccion  		AS escala FROM palabras AS b WHERE b.fiel_code= '2.5.2.2' ORDER BY b.traduccion ASC;  
														 SELECT c.escala 				FROM coberturas As c GROUP BY c.escala 			HAVING c.escala 			Is Not Null;" 	,
												 	'SELECT coberturas."escala" 	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
	 
	 	case "c_clave":  			$array = array(	'SELECT c."clave" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;', 
													'SELECT c."clave" 			FROM coberturas AS c GROUP BY c."clave" 		HAVING c."clave" 			Is Not Null ;',
													'SELECT coberturas."clave" 	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
	
	 	case "c_issue": 			$array = array(	'SELECT c."issue" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;', 
	 												'SELECT c."issue" 			FROM coberturas AS c GROUP BY c."issue" 		HAVING c."issue" 			Is Not Null ;',
													'SELECT coberturas."issue" 	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
	 
	 
	 	case "c_resumen":  			$array = array(	'SELECT c."resumen" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													'SELECT c."resumen" 			FROM coberturas AS c GROUP BY c."resumen" 		HAVING c."resumen" 			Is Not Null ;',
													'SELECT coberturas."resumen" 	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
												
	 	case "c_abstract": 			$array = array(	'SELECT c."abstract" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													'SELECT c."abstract" 			FROM coberturas AS c GROUP BY c."abstract" 		HAVING c."abstract" 		Is Not Null ;',
													'SELECT coberturas."abstract" 	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
     
	 	case "c_objetivo": 			$array = array(	'SELECT c."objetivo" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													'SELECT c."objetivo" 			FROM coberturas AS c GROUP BY c."objetivo" 		HAVING c."objetivo" 		Is Not Null ;',
													'SELECT coberturas."objetivo" 	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
												
     	case "c_datos_comp": 		$array = array(	'SELECT c."datos_comp" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													'SELECT c."datos_comp" 			FROM coberturas AS c GROUP BY c."datos_comp" 	HAVING c."datos_comp" 		Is Not Null ;',
													'SELECT coberturas."datos_comp"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
	 
	 	case "c_tiempo": 			$array = array(	'SELECT c."tiempo" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													'SELECT c."tiempo" 			FROM coberturas AS c GROUP BY c."tiempo" 		HAVING c."tiempo" 			Is Not Null ;',
													'SELECT coberturas."tiempo"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
														
		case "c_tiempo2": 			$array = array(	'SELECT c."tiempo2"			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													'SELECT c."tiempo" 			FROM coberturas AS c GROUP BY c."tiempo" 		HAVING c."tiempo" 			Is Not Null ;',
													'SELECT coberturas."tiempo2"FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
														
		case "c_avance": 			$array = array(	'SELECT c."avance" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													"SELECT b.traduccion 		AS avance FROM palabras AS b WHERE b.fiel_code = '1.4.1' ORDER BY b.traduccion ASC; 
												 		SELECT c.avance 			FROM coberturas AS c GROUP BY c.avance 			HAVING c.avance 			Is Not Null;",
													'SELECT coberturas."avance"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	 
	
     	case "c_mantenimiento": 	$array = array(	'SELECT c."mantenimiento" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													"SELECT b.traduccion 		AS mantenimiento  FROM palabras AS b WHERE b.fiel_code ='1.4.2' ORDER BY b.traduccion ASC;  
												 		SELECT c.mantenimiento 			FROM coberturas AS c  GROUP BY c.mantenimiento 	HAVING c.mantenimiento 		Is Not Null;",
													'SELECT coberturas."mantenimiento"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	 
	
     	case "c_tamano":  			$array = array( 'SELECT c."tamano" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													"SELECT c.tamano 			FROM coberturas AS c GROUP BY c.tamano HAVING c.tamano Is Not Null And c.tamano<>0 ORDER BY c.tamano ASC;",
													'SELECT coberturas."tamano"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	 
	 
	 	case "c_geoform": 	   		$array = array(	'SELECT c."geoform" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													"SELECT b.traduccion 		AS geoform FROM palabras AS b WHERE b.fiel_code ='1.1.8.6' ORDER BY b.traduccion ASC;  
												 		SELECT c.geoform 			FROM coberturas AS c GROUP BY c.geoform 		HAVING c.geoform 			Is Not Null;",
													'SELECT coberturas."geoform"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
	 
		case "l_liga_www": 			$array = array( 'SELECT l."liga_www"		FROM ligas_www AS l WHERE l."dataset_id" = '.$id.';',
													'SELECT l."liga_www"  		FROM ligas_www AS l GROUP BY l."liga_www"  		HAVING l."liga_www" 		Is Not Null ;',
													'SELECT ligas_www."liga_www" FROM coberturas inner join ligas_www on ligas_www."dataset_id"  = coberturas."record_id" and coberturas."record_id" ='.$id.';'); break;
	 
	 	case "c_area_geo": 			$array = array(	'SELECT c."area_geo" 		FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													"SELECT b.traduccion 		AS area_geo FROM palabras AS b WHERE b.fiel_code='1.5.1' ORDER BY b.traduccion ASC; 
												 		SELECT c.area_geo 			FROM coberturas AS c  GROUP BY c.area_geo 		HAVING c.area_geo 			Is Not Null;",
													'SELECT coberturas."area_geo"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
		
     	case "c_oeste": 			$array = array(	'SELECT c."oeste" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
											   		"SELECT b.traduccion 		AS oeste FROM palabras AS b WHERE b.fiel_code='1.5.1.1' ORDER BY b.traduccion ASC;  
												 		SELECT c.oeste 			FROM coberturas AS c  GROUP BY c.oeste 			HAVING c.oeste 				Is Not Null; ",
													'SELECT coberturas."oeste"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
     
	 	case "c_este": 				$array = array(	'SELECT c."este"			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													"SELECT b.traduccion 		AS este  FROM palabras AS b WHERE b.fiel_code='1.5.1.2' ORDER BY b.traduccion ASC;  
												 		SELECT c.este 				FROM coberturas AS c  GROUP BY c.este 			HAVING c.este 				Is Not Null; ",
													'SELECT coberturas."este"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
     
	 	case "c_norte": 			$array = array(	'SELECT c."norte" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													"SELECT b.traduccion 		AS norte FROM palabras AS b WHERE b.fiel_code='1.5.1.3' ORDER BY b.traduccion ASC;  
												 		SELECT c.norte 			FROM coberturas AS c  GROUP BY c.norte 			HAVING c.norte 				Is Not Null; ",
													'SELECT coberturas."norte"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
     
	 	case "c_sur": 				$array = array(	'SELECT c.sur 				FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													"SELECT b.traduccion 		AS sur  FROM palabras AS b WHERE b.fiel_code='1.5.1.4' ORDER BY b.traduccion ASC;  
												 		SELECT c.sur 			FROM coberturas AS c  GROUP BY c.sur 			HAVING c.sur 				Is Not Null; ",
													'SELECT coberturas."sur"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
	 
	 	case "c_acceso": 			$array = array( 'SELECT c."acceso" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													"SELECT b.traduccion 		FROM palabras AS b WHERE b.fiel_code='1.7' ORDER BY b.traduccion ASC; "	,
													'SELECT coberturas."acceso"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
												
     	case "c_uso": 				$array = array(	'SELECT c."uso" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													"SELECT b.traduccion 		FROM palabras AS b WHERE b.fiel_code='1.8' ORDER BY b.traduccion ASC; "	,
													'SELECT coberturas."uso"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
     
	 	case "c_observaciones": 	$array = array(	'SELECT c."observaciones" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													"SELECT b.traduccion 				FROM palabras AS b WHERE b.fiel_code='1.7.8' ORDER BY b.traduccion ASC;  
														 SELECT c.observaciones 			FROM coberturas AS c  GROUP BY c.observaciones 	HAVING c.observaciones 		Is Not Null;",
													'SELECT coberturas."observaciones"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
	 
	 	case "m_Palabra_Clave":  	$array = array(	'SELECT m."palabra_clave" 	FROM temas_clave AS m WHERE m."dataset_id" = '.$id.';',
											 		"SELECT b.traduccion 		AS palabra_clave FROM palabras AS b WHERE b.fiel_code='1.6.1.1' ORDER BY b.traduccion ASC;
											 	 		SELECT m.palabra_clave 	FROM temas_clave AS m GROUP BY m.palabra_clave  HAVING m.palabra_clave 		Is Not Null; ",
													'SELECT temas_clave."palabra_clave" FROM coberturas inner join temas_clave on temas_clave."dataset_id"  = coberturas."record_id" 
													where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;
	  
												 
	 	case "s_Sitios_Clave": 		$array = array(	'SELECT s."sitios_clave" 	FROM sitios_clave AS s WHERE s."dataset_id" = '.$id.';',
											 		"SELECT b.traduccion 		AS sitios_clave FROM palabras AS b WHERE b.fiel_code='1.6.2.1' OR b.fiel_code='1.5.1' ORDER BY b.traduccion ASC; 
											  	 		SELECT s.sitios_clave 	FROM sitios_clave AS s GROUP BY s.sitios_clave 		HAVING s.sitios_clave 		Is Not Null; "	,
													'SELECT sitios_clave."sitios_clave" FROM coberturas inner join sitios_clave on sitios_clave."dataset_id"  = coberturas."record_id" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;
	 
	 	case "c_software_hardware":$array = array(	'SELECT c."software_hardware" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													"SELECT b.traduccion 					AS software_hardware FROM palabras AS b  WHERE b.fiel_code='1.16.1' ORDER BY b.traduccion ASC;  
												 		SELECT c.software_hardware   		FROM coberturas AS c  GROUP BY c.software_hardware HAVING c.software_hardware Is Not Null;"	,
													'SELECT coberturas."software_hardware"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
	
	 	case "c_sistema_operativo":$array = array(	'SELECT c."sistema_operativo" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													"SELECT b.traduccion 					AS sistema_operativo FROM palabras AS b WHERE b.fiel_code='1.16.2.3' ORDER BY b.traduccion ASC; 
														 SELECT c.sistema_operativo 		FROM coberturas AS c  GROUP BY c.sistema_operativo HAVING c.sistema_operativo Is Not Null;"	,
													'SELECT coberturas."sistema_operativo"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
	
	 	case "c_tecnicos": 			$array = array(	'SELECT c."tecnicos" 			FROM coberturas AS c  WHERE c."record_id" = '.$id.' ;',
													"SELECT b.traduccion 			AS tecnicos FROM palabras AS b  WHERE b.fiel_code='6.6' ORDER BY b.traduccion ASC; 
														 SELECT c.tecnicos 			FROM coberturas AS c GROUP BY c.tecnicos 	HAVING c.tecnicos 			Is Not Null;",
													'SELECT coberturas."tecnicos"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
	
	
	 	case "c_path": 				$array = array(	'SELECT c."path" 				FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													"SELECT b.traduccion 			AS path FROM palabras AS b WHERE b.fiel_code='1.14' ORDER BY b.traduccion ASC; 
												 		SELECT c.path 					FROM coberturas AS c GROUP BY c.path 		HAVING c.path 				Is Not Null;",
													'SELECT coberturas."path"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
	 
	 	case "c_metodologia": 		$array = array(	'SELECT c."metodologia" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													"SELECT b.traduccion 		AS metodologia FROM palabras AS b WHERE b.fiel_code='2.5.1.1' ORDER BY b.traduccion ASC; 
												 		SELECT c.metodologia 			FROM coberturas AS c GROUP BY c.metodologia 	HAVING c.metodologia 		Is Not Null;",
													'SELECT coberturas."metodologia"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
     
	 	case "c_descrip_metodologia":$array = array('SELECT c."descrip_metodologia" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													"SELECT c.descrip_metodologia 				FROM coberturas AS c GROUP BY c.descrip_metodologia HAVING c.descrip_metodologia Is Not Null ;",
													'SELECT coberturas."descrip_metodologia"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
     
	 	case "c_descrip_proceso": 	$array = array(	'SELECT c."descrip_proceso" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
													"SELECT c.descrip_proceso 				FROM coberturas AS c GROUP BY c.descrip_proceso HAVING c.descrip_proceso Is Not Null ;",
													'SELECT coberturas."descrip_proceso"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
	 
	 	case "d_nombre": 			$array = array(	"SELECT d.nombre, d.publish, d.publish_siglas, d.pubplace, d.edition, d.escala_original, d.pubdate, d.formato_original, d.geoform, d.srccontr, d.issue, d.onlink ,
														d.id_origen FROM datos_origen AS d WHERE d.dataset_id = '".$id."' ORDER BY d.id_origen ASC;",
	 
													 "SELECT d.nombre 				FROM datos_origen AS d GROUP BY d.nombre 			HAVING d.nombre 			Is Not Null ;",
													 "SELECT d.publish 				FROM datos_origen AS d GROUP BY d.publish 			HAVING d.publish 			Is Not Null ;",
													 "SELECT d.publish_siglas 		FROM datos_origen AS d GROUP BY d.publish_siglas 	HAVING d.publish_siglas 	Is Not Null ;",
													 "SELECT d.pubplace 			FROM datos_origen AS d GROUP BY d.pubplace 			HAVING d.pubplace 			Is Not Null ;",
													 "SELECT d.edition 				FROM datos_origen AS d GROUP BY d.edition 			HAVING d.edition 			Is Not Null ;",
													 "SELECT d.escala_original 		FROM datos_origen AS d GROUP BY d.escala_original 	HAVING d.escala_original 	Is Not Null ;",
													 "SELECT d.pubdate 				FROM datos_origen AS d GROUP BY d.pubdate 			HAVING d.pubdate 			Is Not Null ;",
																								
													 "SELECT b.traduccion 			AS formato 	FROM palabras 		AS b WHERE b.fiel_code='2.5.2.3' ORDER BY b.traduccion ASC; 
													  	SELECT d.formato_original 	AS formato 	FROM datos_origen 	AS d GROUP BY d.formato_original HAVING d.formato_original Is Not Null",
													 "SELECT b.traduccion 			AS geoform 	FROM palabras 		AS b WHERE b.fiel_code='1.1.8.6' ORDER BY b.traduccion ASC; 
													  	SELECT d.geoform 							FROM datos_origen 	AS d GROUP BY d.geoform HAVING d.geoform Is Not Null",
																								 
													 "SELECT d.srccontr 			FROM datos_origen AS d GROUP BY d.srccontr 			HAVING d.srccontr 	Is Not Null ;",
													 "SELECT d.issue 				FROM datos_origen AS d GROUP BY d.issue 			HAVING d.issue 		Is Not Null ;",
													 "SELECT d.onlink 				FROM datos_origen AS d GROUP BY d.onlink 			HAVING d.onlink 	Is Not Null ;",
													 
													 'SELECT datos_origen."nombre", datos_origen."publish", datos_origen."publish_siglas", datos_origen."pubplace", datos_origen."edition", datos_origen."escala_original" ,
													 	datos_origen."escala_original", datos_origen."pubdate", datos_origen."formato_original", datos_origen."geoform", datos_origen."srccontr", datos_origen."issue" ,
														datos_origen."onlink", datos_origen."id_origen"  FROM coberturas inner join datos_origen on datos_origen."dataset_id"  = coberturas."record_id" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.'  ORDER BY datos_origen.id_origen ASC;'	); break;	
													 
													 
											
	 
	 
		case "h_origin": 			$array = array(	'SELECT h."origin" 		FROM autores_origen AS h WHERE h."id_origen"='.$id.';',
													"SELECT h.origin 		FROM autores_origen AS h GROUP BY h.origin HAVING h.origin 	Is Not Null ORDER BY h.origin ASC;"		); break;
	 
	 	case "t_taxon":				$array = array(	'SELECT t."cobertura", t."reino", t."division", t."clase", t."orden", t."familia", t."genero", t."especie", t."nombre_comun", t."id_taxon" ,t."dataset_id"  	
														FROM taxonomia AS t WHERE  t."dataset_id" = '.$id.'  ORDER BY t."id_taxon" ASC;',
		
													"SELECT DISTINCT nom_categoria  FROM taxonomia ORDER BY nom_categoria  ASC ;",
													"SELECT t.reino 		FROM taxonomia AS t GROUP BY t.reino 		HAVING t.reino 			Is Not Null ;",
													"SELECT t.division 		FROM taxonomia AS t GROUP BY t.division 	HAVING t.division 		Is Not Null ;",
													"SELECT t.clase 		FROM taxonomia AS t GROUP BY t.clase 		HAVING t.clase			Is Not Null ;",
													"SELECT t.orden 		FROM taxonomia AS t GROUP BY t.orden 		HAVING t.orden 			Is Not Null ;",
													"SELECT t.familia 		FROM taxonomia AS t GROUP BY t.familia 		HAVING t.familia 		Is Not Null ;",
													"SELECT t.genero 		FROM taxonomia AS t GROUP BY t.genero 		HAVING t.genero 		Is Not Null ;",
													"SELECT t.especie 		FROM taxonomia AS t GROUP BY t.especie 		HAVING t.especie 		Is Not Null ;",
													"SELECT t.nombre_comun 	FROM taxonomia AS t GROUP BY t.nombre_comun HAVING t.nombre_comun 	Is Not Null ;",
													
													 'SELECT taxonomia."cobertura", taxonomia."reino", taxonomia."division", taxonomia."clase", taxonomia."orden", taxonomia."familia", taxonomia."genero", taxonomia."especie",
													 	taxonomia."nombre_comun", taxonomia."id_taxon" ,taxonomia."dataset_id" 
													 	FROM coberturas inner join taxonomia on taxonomia."dataset_id"  = coberturas."record_id" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
														
														
	
		case "g_taxonc": 		$array = array(	'SELECT * 					FROM taxon_cita AS g WHERE g."id_taxon"='.$id.' ORDER BY "idau_taxon" ASC;',
												"SELECT g.title 			FROM taxon_cita AS g GROUP BY g.title 			HAVING g.title 			Is Not Null ;",
												"SELECT g.publish 			FROM taxon_cita AS g GROUP BY g.publish 		HAVING g.publish 		Is Not Null ;",
												"SELECT g.publish_siglas 	FROM taxon_cita AS g GROUP BY g.publish_siglas 	HAVING g.publish_siglas Is Not Null ;",
												"SELECT g.pubplace 			FROM taxon_cita AS g GROUP BY g.pubplace 		HAVING g.pubplace 		Is Not Null ;",
												"SELECT g.edition 			FROM taxon_cita AS g GROUP BY g.edition 		HAVING g.edition 		Is Not Null ;",
												"SELECT g.pubdate 			FROM taxon_cita AS g GROUP BY g.pubdate 		HAVING g.pubdate 		Is Not Null ;",
												"SELECT g.sername 			FROM taxon_cita AS g GROUP BY g.sername 		HAVING g.sername 		Is Not Null ;",
												"SELECT g.issue 			FROM taxon_cita AS g GROUP BY g.issue 			HAVING g.issue 			Is Not Null ;"			); break;
	 
	 	case "z_origin": 		$array = array(	'SELECT z."origin" 			FROM autores_taxon AS z WHERE z."idau_taxon"='.$id. ' ;',
												"SELECT z.origin 			FROM autores_taxon AS z GROUP BY z.origin 		HAVING z.origin 		Is Not Null ;"			); break;	
	 
	 	case "c_estructura_dato":$array = array('SELECT c."estructura_dato" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
											 	"SELECT b.traduccion 		 			FROM palabras AS b WHERE b.fiel_code='3.2' 		ORDER BY b.traduccion;",
												'SELECT coberturas."estructura_dato"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;	
		
	 	case "c_tipo_dato": 	$array = array(	'SELECT c."tipo_dato" 		 FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
												"SELECT b.traduccion 	 FROM palabras AS b WHERE b.fiel_code='3.3.1.1' 	ORDER BY b.traduccion;",
												'SELECT coberturas."tipo_dato"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;
		
	 	case "c_total_datos": 	$array = array(	'SELECT c."total_datos" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
												"SELECT c.total_datos 				FROM coberturas AS c GROUP BY c.total_datos 	HAVING c.total_datos 	Is Not Null ;",
												'SELECT coberturas."total_datos"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;
		
	 	case "r_nun_renglones": $array = array(	'SELECT r."nun_renglones" 		FROM raster AS r WHERE r."record_id" = '.$id.';',
												"SELECT r.nun_renglones 		FROM raster AS r GROUP BY r.nun_renglones 	HAVING r.nun_renglones 	Is Not Null ;",
												'SELECT raster."nun_renglones" 	FROM coberturas inner join raster on raster."record_id"  = coberturas."record_id" and coberturas."record_id" ='.$id.';'); break;
		
	 	case "r_num_columnas": 	$array = array(	'SELECT r."num_columnas" 		FROM raster AS r WHERE r."record_id" = '.$id.';',
												"SELECT r.num_columnas 			FROM raster AS r GROUP BY r.num_columnas 	HAVING r.num_columnas 	Is Not Null ;",
												'SELECT raster."num_columnas" 	FROM coberturas inner join raster on raster."record_id"  = coberturas."record_id" and coberturas."record_id" ='.$id.';'); break;
        
		 case "r_pixel_X": 		$array = array(	'SELECT r."pixel_x" 		FROM raster AS r WHERE r."record_id" = '.$id.';',
												'SELECT r."pixel_x"			FROM raster AS r GROUP BY r."pixel_x" 		HAVING r."pixel_x" 		Is Not Null ;',
												'SELECT raster."pixel_x" 	FROM coberturas inner join raster on raster."record_id"  = coberturas."record_id" and coberturas."record_id" ='.$id.';'); break;
      	
		 case "r_pixel_Y":		$array = array(	'SELECT r."pixel_y" 		FROM raster AS r WHERE r."record_id" = '.$id.';',
												'SELECT r."pixel_y"			FROM raster AS r GROUP BY r."pixel_y" 		HAVING r."pixel_y" 		Is Not Null ;',
												'SELECT raster."pixel_y" 	FROM coberturas inner join raster on raster."record_id"  = coberturas."record_id" and coberturas."record_id" ='.$id.';'); break;
     
	 	case "r_COOR_X": 		$array = array(	'SELECT r."coor_x" 			FROM raster AS r WHERE r."record_id" = '.$id.';',
												'SELECT r."coor_x" 			FROM raster AS r GROUP BY r."coor_x"		HAVING r."coor_x" 		Is Not Null ;',
												'SELECT raster."coor_x" 	FROM coberturas inner join raster on raster."record_id"  = coberturas."record_id" and coberturas."record_id" ='.$id.';'); break;
     	
	 	case "r_COOR_Y": 		$array = array(	'SELECT r."coor_y" 			FROM raster AS r WHERE r."record_id" = '.$id.';',
												'SELECT r."coor_y" 			FROM raster AS r GROUP BY r."coor_y" 		HAVING r."coor_y" 		Is Not Null ;',
												'SELECT raster."coor_y" 	FROM coberturas inner join raster on raster."record_id"  = coberturas."record_id" and coberturas."record_id" ='.$id.';'); break;
	 
	 case "c_id_proyeccion": $array = array('SELECT c."id_proyeccion" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
											'SELECT c."id_proyeccion" 			FROM coberturas AS c GROUP BY c."id_proyeccion" HAVING c."id_proyeccion" Is Not Null ;',
											'SELECT coberturas."id_proyeccion"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
													where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;
		
		
	 case "c_datum": 		$array = array(	'SELECT c."datum" 				FROM coberturas 	AS c WHERE c."record_id" = '.$id.' ;',
											"SELECT b.traduccion as datum 	FROM palabras 		AS b WHERE b.fiel_code='4.1.4.1' ORDER BY b.traduccion DESC; 
												SELECT coberturas.datum   	FROM coberturas  	GROUP BY coberturas.datum 		HAVING coberturas.datum Is Not Null;",
											'SELECT coberturas."datum"		FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
													where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;
     	
	 case "c_elipsoide": 	$array = array(	'SELECT c."elipsoide" 				FROM coberturas 	AS c WHERE c."record_id" = '.$id.' ;',
											"SELECT b.traduccion as elipsoide  	FROM palabras 		AS b WHERE b.fiel_code='4.1.4.2'  	ORDER BY b.traduccion ASC; 
											 	SELECT coberturas.elipsoide 	FROM coberturas  	GROUP BY coberturas.elipsoide 		HAVING coberturas.elipsoide Is Not Null;",
											'SELECT coberturas."elipsoide"		FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
													where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;
	 
	 case "c_tabla": 		$array = array(	'SELECT c."tabla" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
											"SELECT c.tabla 			FROM coberturas AS c GROUP BY c.tabla 		HAVING c.tabla 			Is Not Null ;",
											'SELECT coberturas."tabla"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
													where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;
     	
	 case "c_descrip_tabla": $array = array('SELECT c."descrip_tabla" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
											"SELECT c.descrip_tabla 			FROM coberturas AS c GROUP BY c.descrip_tabla HAVING c.descrip_tabla Is Not Null ;",
											'SELECT coberturas."descrip_tabla"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
													where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;
	 
	 case "a_nombre": 		$array = array(	"SELECT *  FROM atributos AS a WHERE a.dataset_id = '".$id."';",
		
											"SELECT a.nombre 					FROM atributos AS a 	GROUP BY a.nombre 	HAVING a.nombre 		Is Not Null ;",
											"SELECT a.descipcion_atributo 		FROM atributos AS a 	GROUP BY a.descipcion_atributo HAVING a.descipcion_atributo Is Not Null ;",
											"SELECT a.fuente 					FROM atributos AS a 	GROUP BY a.fuente 	HAVING a.fuente 		Is Not Null ;",
											"SELECT b.traduccion as unidades  	FROM palabras  AS b 	WHERE b.fiel_code='5.1.2.5' 	ORDER BY b.traduccion; 
											 	SELECT a.unidades 					FROM atributos AS a 	GROUP BY a.unidades HAVING a.unidades 		Is Not Null;",
											"SELECT b.traduccion as tipo  		FROM palabras  AS b 	WHERE b.fiel_code='5.1.2.4.1.1' ORDER BY b.traduccion; 
											 	SELECT a.tipo 						FROM atributos AS a  	GROUP BY a.tipo 	HAVING a.tipo 			Is Not Null;",
											'SELECT atributos."nombre" , atributos."descipcion_atributo", atributos."fuente", atributos."unidades" , atributos."tipo" 
												FROM coberturas inner join atributos on atributos."dataset_id"  = coberturas."record_id" 
													where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;
	 
	 case "c_clasificacion": $array = array('SELECT c."clasificacion" 			FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
											'SELECT c."clasificacion" 			FROM coberturas AS c GROUP BY c."clasificacion" HAVING c."clasificacion" Is Not Null ;',
											'SELECT coberturas."clasificacion"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
													where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';'	); break;
	 
	 
	 case "carga_arbol":	$array = array( 'SELECT c."clasificacion" 	FROM coberturas AS c WHERE c."record_id" = '.$id.' ;',
 		'SELECT "idNivel1", "Nivel1", "idnivel2", "Nivel2", "idNivel3", "Nivel3", "idNivel4", "Nivel4", "idNivel5", "Nivel5", "idNivel6", "Nivel6", "id" FROM clasificacion GROUP BY "idNivel1", "Nivel1", "idnivel2", "Nivel2", "idNivel3", "Nivel3", "idNivel4", "Nivel4", "idNivel5", "Nivel5", "idNivel6", "Nivel6", "id" ORDER BY "idNivel1", "idnivel2", "idNivel3", "idNivel4", "idNivel5", "idNivel6", "id";' ); break;
	



	
		
	case "pais":			$array = array(	'SELECT coberturas."pubplace_pais"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';',
											'SELECT "cve_pais" , "nom_pais" FROM pais ORDER BY "nom_pais" ASC'	); break;
	

	
		
	case "estado":			$array = array(	'SELECT coberturas."pubplace_edo"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';',
											'SELECT "cve_ent" , "nom_ent" FROM estados ORDER BY "nom_ent" ASC'	); break;
	
	case "municipio": 		$array = array(	'SELECT coberturas."pubplace_edo" , coberturas."pubplace_muni"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
														where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';',
													'SELECT "cve_mun", "nom_mun" FROM municipios WHERE "cve_ent" = '.$cve.' ORDER BY "nom_mun" ASC'	); break;
	
	case "localidad":		$array = array(	'SELECT coberturas."pubplace_loc"	FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
													where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';',
													'SELECT "cve_loc", "nom_loc" FROM localidades  WHERE "cve_mun" = '.$cve.' ORDER BY "nom_loc" ASC'	); break;
													
	case "claves":			$array = array(	'SELECT coberturas."pubplace_edo" , coberturas."pubplace_muni" , coberturas."pubplace_loc" , coberturas."pubplace", coberturas."pubplace_pais"	
												FROM analistas inner join coberturas on coberturas."id_analista" = analistas."idAnalista" 
												where coberturas."id_analista" = '. $cv_principal.' AND coberturas."record_id" = '.$id.';',
											'SELECT "pubplace_edo" , "pubplace_muni" , "pubplace_loc" , "pubplace" 	, "pubplace_pais" FROM coberturas WHERE "record_id" = '.$id.' ;'	); break;
											
	case "uc_cobertura": 	$array = array(	'SELECT * FROM coberturas WHERE "record_id" = '.$id.' ;',
											''	); break;
	
	 
	 }
  return $array; 
}
?>
