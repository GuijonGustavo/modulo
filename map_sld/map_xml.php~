<?php

ob_start();

session_start();
$id = $_POST['btn_map_xml'];
$color1 = $_POST['color1'];
$color2 = $_POST['color2'];
$rango = $_POST['rango'];
$attr = $_POST['attr'];

require('../PHP/conn.php');
//	require('../PHP/funciones.php');
	$db = conectar();
	if ($db)
	{
		$sql = 'SELECT * FROM coberturas where record_id='.$id.';';
		$result = pg_query($db, $sql); 
		if( $fila = pg_fetch_array($result) )
            $cobertura= $fila['cobertura']; 
        $cobertura = strtolower($cobertura);
		$cita = $fila['cita']; 	
		$fecha_inicial = $fila['fecha_inicial']; 	
        $fecha_pub = $fila['pubdate']; 
        list($dia, $mes, $anio) = split('[/.-]', $fecha_pub);
        $edicion = $fila['edition'];
        $issue_d = $fila['issue'];
        $timepo1 = $fila['tiempo'];
        $timepo2 = $fila['tiempo2'];

		$nombre = $fila['nombre']; 	
		$resumen = $fila['resumen']; 	
        $geoform = $fila['geoform'];
        $resumen = $fila['resumen'];
        $objetivo = $fila['objetivo'];
        $datos_comp = $fila['datos_comp'];
        $software_hardware = $fila['software_hardware'];
        $sistema_operativo = $fila['sistema_operativo'];
        $metodologia = $fila['metodologia'];
        $descrip_proceso = $fila['descrip_proceso'];
        $descrip_tabla = $fila['descrip_tabla'];
        $descrip_metodologia = $fila['descrip_metodologia'];
        $tabla = $fila['tabla'];
        $datum = $fila['datum'];
        $elipsoide = $fila['elipsoide'];
        if (NULL == $fila['tiempo'])
            $tiempo = "000000"; // Hay que preguntar que hacer si el dato esta vacio. En este caso estoy rellenando con 00 pero tal vez podria no llevar algo
        $tiempo2 = $fila['tiempo2'];
        //--------------------
        
        $autores = 'select origin from autores where dataset_id=(select record_id from coberturas where record_id='.$id.');';
        $autores_k= pg_query($db, $autores);
        $num_autores = pg_num_rows($autores_k); 

        for ($l = 0; $l < $num_autores; $l++){
            $autores_p = pg_fetch_result($autores_k, $l, 0);
            $autores_list .= $autores_p.', ';
        };

        
        
        //-----------------
        $links ='SELECT liga_www FROM ligas_www where dataset_id='.$id.';';     
        $links_k = pg_query($db, $links);
        $num_link = pg_num_rows($links_k); 

        for ($l = 0; $l < $num_link; $l++){
            $links_p = pg_fetch_result($links_k, $l, 0);
            $ligas_www .= $links_p.' ';
        };

//-----------------

        $avance = $fila['avance'];
        $mantenimiento = $fila['mantenimiento'];
        $area_geo = $fila['area_geo'];
        $oeste = $fila['oeste'];
        $este = $fila['este'];
        $norte = $fila['norte'];
        $sur = $fila['sur'];
//-----------------
        $palabras='SELECT palabra_clave FROM temas_clave where dataset_id='.$id.';';     
        $palabras_k = pg_query($db, $palabras);
        $num_clave = pg_num_rows($palabras_k); 

        for ($i = 0; $i < $num_clave; $i++){
            $clave_p = pg_fetch_result($palabras_k, $i, 0);
            $palabra_clave .= '<themekey>'.$clave_p.'</themekey>';
        };

//-----------------

        $sitios='SELECT sitios_clave FROM sitios_clave where dataset_id='.$id.';';     
        $sitio_k = pg_query($db, $sitios);
        $num_sitios = pg_num_rows($sitio_k); 

        for ($j = 0; $j < $num_sitios; $j++){
            $clave_k = pg_fetch_result($sitio_k, $j, 0);
            $sitios_clave .= '<placekt>'.$clave_k.'</placekt>';
        };

//-----------------
        $taxonomia = 'SELECT * FROM taxonomia where dataset_id='.$id.';';
		$tax = pg_query($db, $taxonomia); 
		if( $fila_tax = pg_fetch_array($tax) )
            $reino = $fila_tax['reino']; 
            $division = $fila_tax['division']; 
            $clase = $fila_tax['clase']; 
            $orden = $fila_tax['orden']; 
            $familia = $fila_tax['familia']; 
            $genero = $fila_tax['genero']; 
            $especie = $fila_tax['especie']; 
            $nombre_comun = $fila_tax['nombre_comun']; 
	
        $taxon_conabio = '<taxonkt>Taxon_CONABIO</taxonkt><taxonkey>'.$clase.'</taxonkey><taxonkey>'.$orden.'</taxonkey><taxonkey>'.$familia.'</taxonkey><taxonkey>'.$genero.'</taxonkey><taxonkey>'.$especie.'</taxonkey><taxonkey>'.$nombre_comun.'</taxonkey>';


//-----------------

        $tax_cita = 'select * from taxon_cita where id_taxon=(select id_taxon from taxonomia where dataset_id='.$id.');';
        $taxon_cita = pg_query($db, $tax_cita);
        $num_tax_cita = pg_num_rows($taxon_cita); 

        $citeinfo = ''; 
        for ($m = 0; $m < $num_tax_cita; $m++){
            
		if( $fila_taxon_c = pg_fetch_array($taxon_cita) )
            $origin_t = $fila_taxon_c['cita']; 
            $pubdate_t = $fila_taxon_c['pubdate']; 
            $title_c = $fila_taxon_c['title']; 
            $geoform_t = 'No conocido';
    
            $citeinfo .= '<origin>'.$origin_t.'</origin><pubdate>'.$pubdate_t.'</pubdate><title>'.$title_t.'</title><geoform>'.$geoform_t.'</geoform>';
        };
//-----------------
        $d_orig = 'select * from datos_origen where dataset_id='.$id.';';
        $d_origin = pg_query($db, $d_orig);
        $num_d_origin = pg_num_rows($d_origin); 

        $dato_origen = ''; 
        for ($d = 0; $d < $num_d_origin; $d++){
            if( $fila_dato_o = pg_fetch_array($d_origin) )
                if (NULL == $fila_dato_o['origen_dato']){
                    $origen_dato = "No conocido";}
                else {
                    $origen_dato = $fila_dato_o['origen_dato'];} 
                if (NULL == $fila_dato_o['escala_original']){
                    $escala_original = "No conocido";}
                else {
                    $escala_original = $fila_dato_o['escala_original'];}
                    list($pre, $suf) = split('[:]', $escala_original);





                if (NULL == $fila_dato_o['formato_original']){
                    $formato_original = "No conocido";}
                else {
                    $formato_original = $fila_dato_o['formato_original'];} 
                if (NULL == $fila_dato_o['nombre']){
                    $nombre_d = "No conocido";}
                else {
                    $nombre_d = $fila_dato_o['nombre'];} 
                if (NULL == $fila_dato_o['publish']){
                    $publish_d = "No conocido";}
                else {
                    $publish_d = $fila_dato_o['publish'];} 
                if (NULL == $fila_dato_o['publish_siglas']){
                    $publish_siglas_d = "No conocido";}
                else {
                    $publish_siglas_d = $fila_dato_o['publish_siglas'];} 
                if (NULL == $fila_dato_o['pubplace']){
                    $pubplace_d = "No conocido";}
                else {
                    $pubplace_d = $fila_dato_o['pubplace'];} 
                if (NULL == $fila_dato_o['edition']){
                    $edition_d = "No conocido";}
                else {
                    $edition_d = $fila_dato_o['edition'];} 
                if (NULL == $fila_dato_o['geoform']){
                    $geoform_d = "No conocido";}
                else {
                    $geoform_d = $fila_dato_o['geoform'];} 
                if (NULL == $fila_dato_o['pubdate']){
                    $pubdate_d = "No conocido";}
                else {
                    $pubdate_d = $fila_dato_o['pubdate'];} 
                if (NULL == $fila_dato_o['srccontr']){
                    $srccontr = "No conocido";}
                else {
                    $srccontr = $fila_dato_o['srccontr'];} 
                if (NULL == $fila_dato_o['issue']){
                    $issue = "No conocido";}
                else {
                    $issue = $fila_dato_o['issue'];} 
                if (NULL == $fila_dato_o['onlink']){
                    $onlink = "No conocido";}
                else {
                    $onlink = $fila_dato_o['onlink'];} 
            $srccitea = 'No conocido'; //revisar
            $srccurr = 'No conocido';  //revisar 
    
            $dato_origen .= '<srcinfo><srccite><citeinfo><origin>'.$origen_dato.'</origin><pubdate>'.$publish_d.'</pubdate><title>'.$nombre_d.'</title><geoform>'.$geoform_d.'</geoform></citeinfo></srccite><srcscale>'.$escala_original.'</srcscale><typesrc>'.$formato_original.'</typesrc><srctime><timeinfo><sngdate><caldate>'.$pubdate_d.'</caldate></sngdate></timeinfo><srccurr>'.$srccurr.'</srccurr></srctime><srccitea>'.$srccitea.'</srccitea><srccontr>'.$srccontr.'</srccontr></citeinfo></srccite></srcinfo>';
        }
//-----------------//-----------------
        $d_attr = 'select * from atributos where dataset_id='.$id.';';
        $d_atributo = pg_query($db, $d_attr);
        $num_d_atributo = pg_num_rows($d_atributo); 

        $atributo = ''; 
        for ($a = 0; $a < $num_d_atributo; $a++){
            if( $fila_attr = pg_fetch_array($d_atributo) )
                    $nombre_atributo = $fila_attr['nombre']; 
                    $tipo_atributo = $fila_attr['tipo'];
                    $descripcion_atributo = $fila_attr['descipcion_atributo']; 
                    $fuente = $fila_attr['fuente']; 
                    $unidades = $fila_attr['unidades']; 
        $atributo .= '<attr><attrlabl>'.$nombre_atributo.'</attrlabl><attrdef>'.$tipo_atributo.'</attrdef><attrdefs>'.$fuente.'</attrdefs><attrdomv><udom>'.$descripcion_atributo.'</udom></attrdomv><attrvai><attrva>1</attrva><attrvae>'.$unidades.'</attrvae></attrvai></attr>';
        }

        $analista_query = 'select * from analistas where "idAnalista" = (select id_analista from coberturas where record_id ='.$id.');';
		$result_ana = pg_query($db, $analista_query); 
		if( $fila_ana = pg_fetch_array($result_ana) )
            $persona = $fila_ana['Persona']; 
		    $mail = $fila_ana['mail']; 	
		    $puesto = $fila_ana['Puesto']; 	
	
} //Cerrrar conexion a la BD

$xml_text_1= '<?xml version="1.0" encoding="UTF-8"?><sld:StyledLayerDescriptor xmlns="http://www.opengis.net/sld" xmlns:sld="http://www.opengis.net/sld" xmlns:ogc="http://www.opengis.net/ogc" xmlns:gml="http://www.opengis.net/gml" version="1.0.0"><sld:NamedLayer><sld:Name>'.$cobertura.'</sld:Name><sld:UserStyle><sld:Name>'.$cobertura.'</sld:Name><sld:Title>'.$cobertura.'</sld:Title><sld:FeatureTypeStyle><sld:Name>name</sld:Name><sld:Rule><sld:PolygonSymbolizer><sld:Fill><sld:Title>'.$attr.'</sld:Title><sld:CssParameter name="fill">'.$color1.'</sld:CssParameter><sld:CssParameter name="fill-opacity">0.5</sld:CssParameter></sld:Fill><sld:Stroke><sld:CssParameter name="stroke">'.$color2.'</sld:CssParameter><sld:CssParameter name="stroke-opacity">0.5</sld:CssParameter></sld:Stroke></sld:PolygonSymbolizer></sld:Rule></sld:FeatureTypeStyle></sld:UserStyle></sld:NamedLayer></sld:StyledLayerDescriptor>';
/*'<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<StyledLayerDescriptor version="1.0.0" xsi:schemaLocation="http://www.opengis.net/sld StyledLayerDescriptor.xsd" xmlns="http://www.opengis.net/sld" xmlns:ogc="http://www.opengis.net/ogc" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <NamedLayer>
    <Name>Demo Style</Name>
    <UserStyle>
      <Name>Demo Style</Name>
      <Title>Demo Style</Title>
      <FeatureTypeStyle>
        <Rule>
          <Name>rule_8490</Name>
          <MinScaleDenominator>2</MinScaleDenominator>
          <MaxScaleDenominator>1</MaxScaleDenominator>
          <PointSymbolizer>
            <Graphic>
              <Mark>
                <WellKnownName>circle</WellKnownName>
                <Fill>
                  <CssParameter name="fill">#0E1058</CssParameter>
                </Fill>
              </Mark>
            </Graphic>
          </PointSymbolizer>
        </Rule>
      </FeatureTypeStyle>
    </UserStyle>
  </NamedLayer>
</StyledLayerDescriptor>';
 */ 
$xml_text=simplexml_load_string($xml_text_1) or die("Error: Cannot create object");
//print_r($xml_);


$xml_text = $xml_text_1.$xml_text_2.$xml_text_6.$xml_text_3.$xml_text_4.$xml_text_5; 


echo $xml_text;

//---nombre del archivo

$fichero = 'map_xml.xml';
$dir = $cobertura.".sld";

copy($fichero,$dir);
//-----Descarga del archivo

if (is_file($dir)) {
header("Content-Disposition: attachment; filename=\"$dir\"");
readfile($dir);
} else {
die("Error: no se encontró el archivo '$dir'");
}

?>
