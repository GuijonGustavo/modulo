<?php

ob_start();

session_start();
$id = $_POST['btn_map_xml'];

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

/*
$xml_text_1="<?xml version='1.0' encoding='UTF-8'?><metadata xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:noNamespaceSchemaLocation='http://www.conabio.gob.mx/informacion/gis/schemas/fgdc/fgdc-std-001-1998.xsd'><idinfo><citation><citeinfo><origin>José Gálvez, (23/10/2018). 'Cuencas Hidrográficas en la República de Guatemala', escala: 1:500000. edición: Primera. Ministerio de Agricultura, Ganadería y Alimentación. Datos extraídos y digitalizados por el MAGA del Atlas Hidrográfico de Guatemala, elaborado por el IGN.. Guatemala. </origin><pubdate>20181023</pubdate><title>Cuencas Hidrográficas en la República de Guatemala</title><geoform>Shapefile. Formato vectorial compuesto por 4 archivos (shp, shx, dbf,prj)</geoform><onlink>http://www.conabio.gob.mx/informacion/metadata/gis/cencashidgw.xml?_httpcache=yes&amp;_xsl=/db/metadata/xsl/fgdc_html.xsl&amp;_indent=no</onlink></citeinfo></citation><descript><abstract>Cuencas Hidrográficas de la República de Guatemala.</abstract><purpose>Este mapa fue creado para poder realizar análisis del territorio Guatemalteco enfocado a las Cuencas Hidrográficas como territorio.</purpose><supplinf>Algunos proyectos nacionales se han desarrollado en base a esta base de datos, que son fuente importante de información del comportamiento del territorio nacional Referencias en la web: http://web.maga.gob.gt</supplinf></descript><timeperd><timeinfo><sngdate><caldate>00000000</caldate></sngdate></timeinfo><current>02/02/1979 al 02/04/2001</current></timeperd><status><progress>Complete</progress><update>No planeado</update></status><spdom><bounding><westbc>-92.2402496337891</westbc><eastbc>-88.2214965820312</eastbc><northbc>17.8194522857666</northbc><southbc>13.7394018173218</southbc></bounding></spdom><keywords><theme><themekt>CNB.ACCESO</themekt><themekey>publico</themekey></theme><theme><themekt>CNB.LICENCIA</themekt><themekey>CC_BY_NC_2.5_MX</themekey></theme><theme><themekt>CNB.VISIBILIDAD</themekt><themekey>0</themekey><themekey>10</themekey></theme><theme><themekt>ESTRUCTURA</themekt><themekey>biodiv</themekey><themekey>bidcbmm</themekey><themekey>bidcbguate</themekey><themekey>cencashidgw</themekey></theme><theme><themekt>CNB.ESCALA</themekt><themekey>500000</themekey></theme><theme><themekt>CONABIO</themekt><themekey>Cuencas</themekey><themekey>Hidrográficas</themekey><themekey>Guatemala</themekey><themekey>Ríos</themekey><themekey>Territorio</themekey></theme><theme><themekt>CNB2:THEME:LICENCE</themekt><themekey>bync25mx</themekey></theme><theme><themekt>CNB2:THEME:STATUS</themekt><themekey>terminado</themekey></theme><theme><themekt>CNB2:THEME:DATATYPE</themekt><themekey>dataset</themekey></theme><theme><themekt>CNB2:THEME:ACCESS</themekt><themekey>publico</themekey></theme><theme><themekt>CNB2:THEME:IDENTIFIER</themekt><themekey>cencashidgw</themekey></theme><theme><themekt>CNB2:THEME:KEYWORDS</themekt><themekey>biodiv,bidcbmm,bidcbguate</themekey></theme>";

$xml_text_2="<theme><themekt>CNB2:THEME:AUTHOR</themekt><themekey>José Gálvez, (23/10/2018). 'Cuencas Hidrográficas en la República de Guatemala', escala: 1:500000. edición: Primera. Ministerio de Agricultura, Ganadería y Alimentación. Datos extraídos y digitalizados por el MAGA del Atlas Hidrográfico de Guatemala, elaborado por el IGN.. Guatemala. </themekey></theme><place><placekt>CONABIO</placekt><placekey>República de Guatemala</placekey></place><place><placekt>CNB2:PLACE:BOX</placekt><placekey>northlimit=17.8194522857666; eastlimit=-88.2214965820312; southlimit=13.7394018173218; westlimit=-92.2402496337891; uplimit=0; units=signed decimal degrees; zunits=metres; projection=EPSG:4326</placekey></place><temporal><tempkt>CNB2:DATE:PUBLISHED</tempkt><tempkey>2018-10-23</tempkey></temporal><temporal><tempkt>CNB2:DATE:UPDATED</tempkt><tempkey>2018-10-23</tempkey></temporal></keywords><accconst>Sin restricciones</accconst><useconst>No se permite utilizar estos datos con fines lucrativos y se debe citar la fuente del mapa y a CONABIO. Ver la licencia completa en http://creativecommons.org/licenses/by-nc/2.5/mx/</useconst><browse><browsen>http://geoportal.conabio.gob.mx/descargas/mapas/imagen/20/cencashidgw</browsen><browsed>171 x 132 píxeles</browsed><browset>image/png</browset></browse><browse><browsen>http://geoportal.conabio.gob.mx/descargas/mapas/imagen/96/cencashidgw</browsen><browsed>1002 x 774 píxeles</browsed><browset>image/png</browset></browse><native>Arc Gis 10.2, Windows XP</native></idinfo><dataqual><logic>Gabinete</logic><complete>Digitalización de la información</complete><lineage><srcinfo><srccite><citeinfo><origin>No conocido</origin><pubdate>00000000</pubdate><title>No conocido</title><geoform>No conocido</geoform></citeinfo></srccite><srcscale>500000</srcscale><typesrc>shapefile</typesrc><srctime><timeinfo><sngdate><caldate>00000000</caldate></sngdate></timeinfo><srccurr>No conocido</srccurr></srctime><srccitea>No conocido</srccitea>";
    
$xml_text_6="<srccontr>MAGA, , , (2001/20/20), 'Cuencas Hidrográficas de Guatemala', Escala 1:500000. 1, Ministerio de Agricultura, Ganadería y Alimentación, Sin dato, No Aplica, Guatemala.</srccontr></srcinfo><srcinfo><srccite><citeinfo><origin>No conocido</origin><pubdate>00000000</pubdate><title>No conocido</title><geoform>No conocido</geoform></citeinfo></srccite><srcscale>500000</srcscale><typesrc>shapefile</typesrc><srctime><timeinfo><sngdate><caldate>00000000</caldate></sngdate></timeinfo><srccurr>No conocido</srccurr></srctime><srccitea>No conocido</srccitea><srccontr>MAGA, , , (2001/20/20), 'Cuencas Hidrográficas de Guatemala', Escala 1:500000. 1, Ministerio de Agricultura, Ganadería y Alimentación, Sin dato, No Aplica, Guatemala.</srccontr></srcinfo><srcinfo><srccite><citeinfo><origin>No conocido</origin><pubdate>00000000</pubdate><title>No conocido</title><geoform>No conocido</geoform></citeinfo></srccite><srcscale>500000</srcscale><typesrc>shapefile</typesrc>";
  
$mxl_text_3="<srctime><timeinfo><sngdate><caldate>00000000</caldate></sngdate></timeinfo><srccurr>No conocido</srccurr></srctime><srccitea>No conocido</srccitea><srccontr>MAGA, , , (2001/20/20), 'Cuencas Hidrográficas de Guatemala', Escala 1:500000. 1, Ministerio de Agricultura, Ganadería y Alimentación, Sin dato, No Aplica, Guatemala.</srccontr></srcinfo><procstep><procdesc>Se utilizaron las placas de información generada por el Instituto Geográfico Nacional de Guatemala y fueron Digitalizadas para convertirlas en formato Shape</procdesc><procdate>00000000</procdate></procstep></lineage></dataqual><spdoinfo><direct>Vector</direct><ptvctinf><sdtsterm><sdtstype>G-polygon</sdtstype><ptvctcnt>38</ptvctcnt></sdtsterm></ptvctinf></spdoinfo><spref><horizsys><geograph><latres>0.0174532925199433</latres><longres>0.0174532925199433</longres><geogunit>Decimal degrees</geogunit></geograph><geodetic><horizdn>WGS84</horizdn><ellips>WGS84</ellips><semiaxis>6378137.000000</semiaxis><denflat>298.257224</denflat></geodetic></horizsys></spref><eainfo><detailed><enttyp><enttypl>CENCASHIDGW.DBF</enttypl><enttypd>Atributos de la Base de Datos de las Cuencas Hidrográficas.</enttypd><enttypds>No conocido</enttypds></enttyp><attr><attrlabl>CODCUENCA</attrlabl><attrdef>String</attrdef><attrdefs>Asignado por el Operador</attrdefs><attrdomv><udom>Codigo de cada poligono</udom></attrdomv><attrvai><attrva>1</attrva><attrvae>no aplica</attrvae></attrvai></attr><attr><attrlabl>NCUENCA</attrlabl><attrdef>String</attrdef><attrdefs>Asignado por el Operador</attrdefs><attrdomv><udom>Nombre de la Cuenca Hidrográfica</udom></attrdomv><attrvai><attrva>1</attrva><attrvae>no aplica</attrvae></attrvai></attr><attr><attrlabl>NVERTIENTE</attrlabl><attrdef>String</attrdef><attrdefs>Asignado por el Operador</attrdefs><attrdomv><udom>Nombre de la Vertiente donde desfogan las cuencas</udom></attrdomv><attrvai><attrva>1</attrva><attrvae>no aplica</attrvae></attrvai></attr><attr><attrlabl>ha</attrlabl><attrdef>Double</attrdef><attrdefs>Calculado por ArcGIS</attrdefs><attrdomv><udom>Superficie del poligono en hectareas</udom></attrdomv><attrvai><attrva>1</attrva><attrvae>Hectáreas cuadradas</attrvae></attrvai></attr></detailed></eainfo><distinfo><distrib><cntinfo><cntorgp><cntorg>CONABIO</cntorg><cntper>Mto.Enrique Muñoz López</cntper></cntorgp><cntpos>Director de Análisis Territorial</cntpos><cntaddr><addrtype>mailing and physical address</addrtype><address>Av. Liga Periférico - Insurgentes Sur, Núm. 4903, Col. Parques del Pedregal. Delegación Tlalpan. México, D.F.</address><city>Ciudad de México</city><state>D.F.</state><postal>14010</postal><country>México</country></cntaddr><cntvoice>5004 5005</cntvoice><cntfax>5004 4931</cntfax><cntemail>emunoz@conabio.gob.mx</cntemail>";
    
$xml_text_4="<hours>Lunes a Viernes de 8 a 18 hrs.</hours></cntinfo></distrib><resdesc>cencashidgw</resdesc><distliab>La Subdirección de Sistemas de Información Geográfica de la CONABIO solo se hace responsable de la información presentada en el mapa y se deslinda del uso que se le de a la misma.</distliab><stdorder><digform><digtinfo><formname>CNB.GEO.TMS</formname><formvern>1.0.0</formvern><formspec>PNG</formspec></digtinfo><digtopt><onlinopt><computer><networka><networkr>http://wms0.conabio.gob.mx/cencashidgw.py/</networkr><networkr>http://wms1.conabio.gob.mx/cencashidgw.py/</networkr><networkr>http://wms2.conabio.gob.mx/cencashidgw.py/</networkr></networka></computer></onlinopt></digtopt></digform><digform><digtinfo><formname>Metadato (HTML)</formname><formvern>CNB2:LINK</formvern><formspec>describedby canonical</formspec><formcont>text/html</formcont></digtinfo><digtopt><onlinopt><computer><networka><networkr>metadatos/doc/html/cencashidgw.html</networkr></networka></computer></onlinopt></digtopt></digform><digform><digtinfo><formname>Metadato (XML)</formname><formvern>CNB2:LINK</formvern><formspec>describedby alternate</formspec><formcont>text/xml</formcont></digtinfo><digtopt><onlinopt><computer><networka><networkr>metadatos/doc/fgdc/cencashidgw.xml</networkr></networka></computer></onlinopt></digtopt></digform><digform><digtinfo><formname>Acceso directo al mapa</formname><formvern>CNB2:LINK</formvern><formspec>bookmark</formspec><formcont>text/html</formcont></digtinfo><digtopt><onlinopt><computer><networka><networkr>#!l=cencashidgw</networkr></networka></computer></onlinopt></digtopt></digform><digform><digtinfo><formname>Vista previa</formname><formvern>CNB2:LINK</formvern><formspec>preview</formspec><formcont>image/png</formcont></digtinfo><digtopt><onlinopt><computer><networka><networkr>descargas/mapas/imagen/96/cencashidgw</networkr></networka></computer></onlinopt></digtopt></digform><digform><digtinfo><formname>Vista previa</formname><formvern>CNB2:LINK</formvern><formspec>icon</formspec><formcont>image/png</formcont></digtinfo><digtopt><onlinopt><computer><networka><networkr>descargas/mapas/imagen/20/cencashidgw</networkr></networka></computer></onlinopt></digtopt></digform><digform><digtinfo><formname>Licencia</formname><formvern>CNB2:LINK</formvern><formspec>license</formspec><formcont>text/html</formcont><filedec>cnb:external</filedec></digtinfo><digtopt><onlinopt><computer><networka><networkr>http://creativecommons.org/licenses/by-nc/2.5/mx/</networkr></networka></computer></onlinopt></digtopt></digform><digform><digtinfo><formname>ESRI Shapefile (SHP)</formname><formvern>CNB2:LINK</formvern><formspec>related archives</formspec>";
    
$xml_text_5="<formcont>application/zip</formcont><filedec>cnb:external</filedec><transize>4.51</transize></digtinfo><digtopt><onlinopt><computer><networka><networkr>http://www.conabio.gob.mx/informacion/gis/maps/geo/cencashidgw.zip</networkr></networka></computer></onlinopt></digtopt></digform><digform><digtinfo><formname>Google Earth (KML)</formname><formvern>CNB2:LINK</formvern><formspec>related archives</formspec><formcont>application/vnd.google-earth.kmz</formcont><filedec>cnb:external</filedec></digtinfo><digtopt><onlinopt><computer><networka><networkr>http://www.conabio.gob.mx/informacion/gis/maps/kmz/cencashidgw.kmz</networkr></networka></computer></onlinopt></digtopt></digform><fees>Acceso libre sin ningún cargo al público en general.</fees></stdorder><techpreq>Arc Gis 102, en caso que existan se pueden visualizar en Google Earth KML y/o conexión al servicio WMS.</techpreq></distinfo><metainfo><metd>20181023</metd><metc><cntinfo><cntorgp><cntorg>CONABIO</cntorg><cntper>Tonantzin Camacho Sandoval</cntper></cntorgp><cntpos>Administrador de Metadatos</cntpos><cntaddr><addrtype>mailing and physical address</addrtype><address>Liga Periférico Insurgentes Sur Num. 4903 1er piso. Col. Parques del Pedregal. Delg. Tlalpan</address><city>Ciudad de México</city><state>D.F.</state><postal>14010</postal><country>México</country></cntaddr><cntvoice>01 55 5004 5039</cntvoice><cntfax>50044931</cntfax><cntemail>tcamacho@conabio.gob.mx</cntemail><hours>Lunes a Viernes de 8 a 18 hrs.</hours></cntinfo></metc><metstdn>FGDC Content Standards for Digital Geospatial Metadata, 1998</metstdn><metstdv>FGDC-STD-001-1998 version 2.0</metstdv></metainfo></metadata>";
 */ 
/*

/*
$xml_text_1 = '<?xml version="1.0" encoding="UTF-8"?><metadata xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://www.conabio.gob.mx/informacion/gis/schemas/fgdc/fgdc-std-001.1-1999.xsd"><idinfo><citation><citeinfo><origin>'.$cita.'</origin><pubdate>'.$fecha_inicial.'</pubdate><title>'.$nombre.'</title><geoform>'.$geoform.'</geoform><othercit>1000000_XML</othercit><onlink>'.$ligas_www.'</onlink></citeinfo></citation><descript><abstract>'.$resumen.'</abstract><purpose>'.$objetivo.'</purpose><supplinf>'.$datos_comp.'</supplinf></descript><timeperd><timeinfo><sngdate><caldate>'.$tiempo.'</caldate></sngdate></timeinfo><current>'.$teimpo2.'</current></timeperd><status><progress>'.$avance.'</progress><update>'.$mantenimiento.'</update></status><spdom><descgeog>'.$area_geo.'</descgeog><bounding><westbc>'.$oeste.'</westbc><eastbc>'.$este.'</eastbc><northbc>'.$norte.'</northbc><southbc>'.$sur.'</southbc></bounding></spdom><keywords><theme>'.$palabra_clave.'</theme><place>'.$sitios_clave.'</place></keywords><taxonomy><keywtax>'.$taxon_conabio.'</keywtax><taxonsys><classsys><classcit><citeinfo>'.$citeinfo.'</citeinfo></classcit></classsys><taxonpro>No conocido</taxonpro></taxonsys><taxoncl><taxonrn>Reino</taxonrn><taxonrv>'.$reino.'</taxonrv><taxoncl><taxonrn>Division</taxonrn><taxonrv>'.$division.'</taxonrv><taxoncl><taxonrn>Clase</taxonrn><taxonrv>'.$clase.'</taxonrv>/taxonr><taxoncl><taxonrn>Orden</taxonrn><taxonrv>'.$orden.'</taxonrv><taxoncl><taxonrn>Familia</taxonrn><taxonrv>'.$familia.'</taxonrv><taxoncl><taxonrn>Genero</taxonrn><taxonrv>'.$genero.'</taxonrv><taxoncl><taxonrn>Especie</taxonrn><taxonrv>'.$especie.'</taxonrv><common>'.$nombre_comun.'</common><common>'.$nombre_comun.'</common></taxoncl></taxoncl></taxoncl></taxoncl></taxoncl></taxoncl></taxoncl></taxonomy><accconst>Sin restricciones</accconst><useconst>No se permite utilizar estos datos con fines lucrativos y se debe citar la fuente del mapa y a CONABIO Ver la licencia completa en http://creativecommons.org/licenses/by-nc/25/mx/</useconst><browse><browsen>http://wwwconabiogobmx/informacion/gis/layouts/'.$cobertura.'.png</browsen><browsed>Mapa ilustrativo de '.$nombre.'. La proyección citada, es exclusiva para el diseño de esta imagen.</browsed><browset>png</browset></browse><native>'.$software_hardware.'. '.$sistema_operativo.'</native>';

$xml_text_2 = '</idinfo><dataqual><logic>'.$metodologia.'</logic><complete>'.$descrip_metodologia.'</complete><lineage>'.$dato_origen.'<procstep><procdesc>'.$descrip_proceso.'</procdesc>';

$xml_text_3 = '<procdate>00000000</procdate></procstep></lineage></dataqual><spdoinfo><direct>Vector</direct><ptvctinf><sdtsterm ><sdtstype>G-polygon</sdtstype><ptvctcnt>19377</ptvctcnt></sdtsterm></ptvctinf></spdoinfo><spref><horizsys><geograph><latres>0.0174532925199433</latres><longres>0.0174532925199433</longres><geogunit>Decimal degrees</geogunit></geograph><geodetic><horizdn>'.$datum.'</horizdn><ellips>'.$elipsoide.'</ellips><semiaxis>6378137.000000</semiaxis><denflat>298.257224</denflat></geodetic></horizsys></spref><eainfo><detailed><enttyp><enttypl>'.$tabla.'</enttypl><enttypd>'.$descripcion_atributo.'</enttypd><enttypds>No conocido</enttypds></enttyp>'.$atributo.'</detailed></eainfo><distinfo><distrib><cntinfo><cntorgp><cntorg>CONABIO</cntorg>';
    
 $xml_text_4 = '<cntper>Jose Manuel Davila Rosas</cntper></cntorgp><cntpos>Subcoordinador de Sistemas de Información Geográfica</cntpos><cntaddr><addrtype>mailing and physical address</addrtype><address>Liga Perif&#x00E9;rico Insurgentes Sur Num. 4903 1er piso. Col. Parques del Pedregal. Delg. Tlalpan</address><city>Ciudad de M&#x00E9;xico</city><state>D.F.</state><postal>14010</postal><country>M&#x00E9;xico</country></cntaddr><cntvoice>50045012</cntvoice><cntfax>50044931</cntfax><cntemail>jdavila@conabio.gob.mx</cntemail><hours>Lunes a Viernes de 8 a 18 hrs.</hours></cntinfo></distrib><resdesc>'.$cobertura.'</resdesc><distliab>La Subdirecci&#x00F3;n de Sistemas de Informaci&#x00F3;n Geogr&#x00E1;fica de la CONABIO solo se hace responsable de la informaci&#x00F3;n presentada en el mapa y se deslinda del uso que se le de a la misma.</distliab><stdorder><digform><digtinfo><formname>ESRI Shapefile (SHP)</formname><formverd>199807</formverd><filedec>compactado en ZIP</filedec><transize>5.28</transize></digtinfo><digtopt><onlinopt><computer><networka><networkr> http://www.conabio.gob.mx/informacion/gis/maps/geo/'.$cobertura.'.zip</networkr></networka></computer><accinstr>Coordenadas geogr&#x00E1;ficas WGS84. (EPSG:4326). Formato vectorial de almacenamiento de elementos geogr&#x00E1;ficos y sus atributos asociados. </accinstr></onlinopt></digtopt></digform><digform><digtinfo><formname>Google Earth (KML)</formname><formvern>2.2</formvern><filedec>compactado como KMZ</filedec></digtinfo><digtopt><onlinopt><computer><networka><networkr> http://www.conabio.gob.mx/informacion/gis/maps/kmz/'.$cobertura.'.kmz</networkr></networka></computer><accinstr>Coordenadas geogr&#x00E1;ficas WGS84. (EPSG:4326). Los archivos KML representan datos geogr&#x00E1;ficos para Google Earth, a menudo suelen distribuirse comprimidos como KMZ.</accinstr></onlinopt></digtopt></digform><digform><digtinfo><formname>CNB.GEO.TMS</formname><formvern>1.0.0</formvern><formspec>PNG</formspec></digtinfo><digtopt><onlinopt><computer><networka><networkr>http://wms0.conabio.gob.mx/'.$cobertura.'.py/</networkr><networkr>';
    
 $xml_text_5 = 'http://wms1.conabio.gob.mx/'.$cobertura.'.py/</networkr><networkr>http://wms2.conabio.gob.mx/'.$cobertura.'.py/</networkr></networka></computer></onlinopt></digtopt></digform><digform><digtinfo><formname>Servicio de im&#x00E1;genes (WMS)</formname><formvern>1.1.1</formvern></digtinfo><digtopt><onlinopt><computer><networka><networkr>http://www.conabio.gob.mx/informacion/explorer/wms?Format=image/gif&amp;request=GetMap&amp;version=1.1.1&amp;width=800&amp;height=424&amp;srs=EPSG:4326&amp;bbox=-120.0,13.8,-85.1,33.5&amp;layers='.$cobertura.'</networkr></networka></computer><accinstr>Coordenadas geogr&#x00E1;ficas WGS84. (EPSG:4326). Servicio Web Map Service. Los mapas de datos referenciados espacialmente producidos se generan normalmente en un formato de imagen como PNG, GIF o JPEG, pueden se vistos en un SIG </accinstr></onlinopt></digtopt></digform><digform><digtinfo><formname>Mapa digital interactivo</formname><formvern>1.0</formvern></digtinfo><digtopt><onlinopt><computer><networka><networkr>http://www.conabio.gob.mx/informacion/gis/?vns=gis_root/biodiv/distpot/dpmamif/dpmcarni/'.$cobertura.'.</networkr></networka></computer><accinstr>Coordenadas geogr&#x00E1;ficas WGS84. (EPSG:4326)</accinstr></onlinopt></digtopt></digform><fees>Acceso libre sin ning&#x00FA;n cargo al p&#x00FA;blico en general.</fees></stdorder><techpreq>Tener Arc-Info, Arcview o sistemas compatibles, en caso que existan se pueden visualizar en Google Earth KML y/o conexi&#x00F3;n al servicio WMS.</techpreq></distinfo><metainfo><metd>20140130</metd><metc><cntinfo><cntorgp><cntorg>CONABIO</cntorg><cntper>'.$persona.'</cntper></cntorgp><cntpos>'.$puesto.'</cntpos><cntaddr><addrtype>mailing and physical address</addrtype><address>Liga Periférico Insurgentes Sur Num. 4903 1er piso. Col. Parques del Pedregal. Delg. Tlalpan</address><city>Ciudad de M&#x00E9;xico</city><state>D.F.</state><postal>14010</postal><country>M&#x00E9;xico</country></cntaddr><cntvoice>01 55 5004 4963</cntvoice><cntfax>50044931</cntfax><cntemail>'.$mail.'</cntemail><hours>Lunes a Viernes de 8 a 18 hrs.</hours></cntinfo></metc><metstdn>FGDC Biological Data Profile of the Content Standard for Digital Geospatial Metadata</metstdn><metstdv>FGDC-STD-001.1-1999</metstdv></metainfo></metadata>';
 */
/*

$xml_text_1 =
    "<?xml version='1.0' encoding='UTF-8'?>
<note>
<to>Tove</to>
<from>Jani</from>
<heading>Reminder</heading>
<body>Don't forget me this weekend!</body>
</note>";
 */











/*
//Dudas: Se ponen todas las ligas? formato de la fecha. Ahora aparece asi: dd/mm/yy?
$xml_map_1='<?xml version="1.0" encoding="UTF-8"?>'.
'<metadata xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://www.conabio.gob.mx/informacion/gis/schemas/fgdc/fgdc-std-001-1998.xsd">\n'.
'    <idinfo>'.
'        <citation>'.
'            <citeinfo>'.
'                <origin>José Gálvez, (23/10/2018). "Cuencas Hidrográficas en la República de Guatemala", escala: 1:500000. edición: Primera. Ministerio de Agricultura, Ganadería y Alimentación. Datos extraídos y digitalizados por el MAGA del Atlas Hidrográfico de Guatemala, elaborado por el IGN.. Guatemala. </origin>'.
'               <pubdate>20181023</pubdate>';


 */

$xml_text_1='<?xml version="1.0" encoding="UTF-8"?>
<metadata xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://www.conabio.gob.mx/informacion/gis/schemas/fgdc/fgdc-std-001-1998.xsd">
    <idinfo>
        <citation>
            <citeinfo>
                <origin>'.$autores_list.'('.$fecha_pub.'). "'.$nombre.'", escala: '.$escala_original.'. edición: '.$edicion.'. '.$publish_d.'. '.$issue_d.' '.$pubplace_d.'</origin>
                <pubdate>'.$anio.$mes.$dia.'</pubdate>
                <title>'.$nombre.'</title>
                <geoform>'.$geoform.'</geoform>
                <onlink>http://www.conabio.gob.mx/informacion/metadata/gis/'.$cobertura.'.xml?_httpcache=yes&amp;_xsl=/db/metadata/xsl/fgdc_html.xsl&amp;_indent=no</onlink>
            </citeinfo>
        </citation>
        <descript>
            <abstract>'.$nombre.'</abstract>
            <purpose>'.$objetivo.'</purpose>
            <supplinf>'.$datos_comp.' Referencias en la web: '.$ligas_www.'</supplinf>
        </descript>
        <timeperd>
            <timeinfo>
                <sngdate>
                    <caldate>00000000</caldate>
                </sngdate>
            </timeinfo>
            <current>'.$timepo1.' al '.$tiempo2.'</current>
        </timeperd>
        <status>
            <progress>'.$avance.'</progress>
            <update>'.$mantenimiento.'</update>
        </status>
        <spdom>
            <bounding>
                <westbc>-92.2402496337891</westbc>
                <eastbc>-88.2214965820312</eastbc>
                <northbc>17.8194522857666</northbc>
                <southbc>13.7394018173218</southbc>
            </bounding>
        </spdom>
        <keywords>
            <theme>
                <themekt>CNB.ACCESO</themekt>
                <themekey>publico</themekey>
            </theme>
            <theme>
                <themekt>CNB.LICENCIA</themekt>
                <themekey>CC_BY_NC_2.5_MX</themekey>
            </theme>
            <theme>
                <themekt>CNB.VISIBILIDAD</themekt>
                <themekey>0</themekey>
                <themekey>10</themekey>
            </theme>
            <theme>
                <themekt>ESTRUCTURA</themekt>
                <themekey>biodiv</themekey>
                <themekey>bidcbmm</themekey>
                <themekey>bidcbguate</themekey>
                <themekey>'.$cobertura.'</themekey>
            </theme>
            <theme>
                <themekt>CNB.ESCALA</themekt>
                <themekey>'.$suf.'</themekey>
            </theme>
            <theme>
                <themekt>CONABIO</themekt>
                '.$palabra_clave.'
            </theme>
            <theme>
                <themekt>CNB2:THEME:LICENCE</themekt>
                <themekey>bync25mx</themekey>
            </theme>
            <theme>
                <themekt>CNB2:THEME:STATUS</themekt>
                <themekey>terminado</themekey>
            </theme>
            <theme>
                <themekt>CNB2:THEME:DATATYPE</themekt>
                <themekey>dataset</themekey>
            </theme>
            <theme>
                <themekt>CNB2:THEME:ACCESS</themekt>
                <themekey>publico</themekey>
            </theme>
            <theme>
                <themekt>CNB2:THEME:IDENTIFIER</themekt>
                <themekey>'.$cobertura.'</themekey>
            </theme>
            <theme>
                <themekt>CNB2:THEME:KEYWORDS</themekt>
                <themekey>biodiv,bidcbmm,bidcbguate</themekey>
            </theme>
            <theme>
                <themekt>CNB2:THEME:AUTHOR</themekt>
                <themekey>'.$autores_list.'('.$fecha_pub.'). "'.$nombre.'", escala: '.$escala_original.'. edición: '.$edicion.'. '.$publish_d.'. '.$issue_d.' '.$pubplace_d.'</themekey>
            </theme>
            <place>
                <placekt>CONABIO</placekt>
                <placekey>'.$area_geo.'</placekey>
            </place>
            <place>
                <placekt>CNB2:PLACE:BOX</placekt>
                <placekey>northlimit=17.8194522857666; eastlimit=-88.2214965820312; southlimit=13.7394018173218; westlimit=-92.2402496337891; uplimit=0; units=signed decimal degrees; zunits=metres; projection=EPSG:4326</placekey>
            </place>
            <temporal>
                <tempkt>CNB2:DATE:PUBLISHED</tempkt>
                <tempkey>'.$anio.'-'.$mes.'-'.$dia.'</tempkey>
            </temporal>
            <temporal>
                <tempkt>CNB2:DATE:UPDATED</tempkt>
                <tempkey>'.$anio.'-'.$mes.'-'.$dia.'</tempkey>
            </temporal>
        </keywords>
        <accconst>Sin restricciones</accconst>
        <useconst>No se permite utilizar estos datos con fines lucrativos y se debe citar la fuente del mapa y a CONABIO. Ver la licencia completa en http://creativecommons.org/licenses/by-nc/2.5/mx/</useconst>
        <browse>
            <browsen>http://geoportal.conabio.gob.mx/descargas/mapas/imagen/20/'.$cobertura.'cencashidgw</browsen>
            <browsed>171 x 132 píxeles</browsed>
            <browset>image/png</browset>
        </browse>
        <browse>
            <browsen>http://geoportal.conabio.gob.mx/descargas/mapas/imagen/96/'.$cobertura.'cencashidgw</browsen>
            <browsed>1002 x 774 píxeles</browsed>
            <browset>image/png</browset>
        </browse>
        <native>Arc Gis 10.2, Windows XP</native>
    </idinfo>
    <dataqual>
        <logic>Gabinete</logic>
        <complete>Digitalización de la información</complete>
        <lineage>
            <srcinfo>
                <srccite>
                    <citeinfo>
                        <origin>No conocido</origin>
                        <pubdate>00000000</pubdate>
                        <title>No conocido</title>
                        <geoform>No conocido</geoform>
                    </citeinfo>
                </srccite>
                <srcscale>'.$suf.'</srcscale>
                <typesrc>shapefile</typesrc>
                <srctime>
                    <timeinfo>
                        <sngdate>
                            <caldate>00000000</caldate>
                        </sngdate>
                    </timeinfo>
                    <srccurr>No conocido</srccurr>
                </srctime>
                <srccitea>No conocido</srccitea>
                <srccontr>MAGA, , , (2001/20/20), "Cuencas Hidrográficas de Guatemala", Escala 1:500000. 1, Ministerio de Agricultura, Ganadería y Alimentación, Sin dato, No Aplica, Guatemala.</srccontr>
            </srcinfo>
            <srcinfo>
                <srccite>
                    <citeinfo>
                        <origin>No conocido</origin>
                        <pubdate>00000000</pubdate>
                        <title>No conocido</title>
                        <geoform>No conocido</geoform>
                    </citeinfo>
                </srccite>
                <srcscale>'.$suf.'</srcscale>
                <typesrc>shapefile</typesrc>
                <srctime>
                    <timeinfo>
                        <sngdate>
                            <caldate>00000000</caldate>
                        </sngdate>
                    </timeinfo>
                    <srccurr>No conocido</srccurr>
                </srctime>
                <srccitea>No conocido</srccitea>
                <srccontr>MAGA, , , (2001/20/20), "Cuencas Hidrográficas de Guatemala", Escala 1:500000. 1, Ministerio de Agricultura, Ganadería y Alimentación, Sin dato, No Aplica, Guatemala.</srccontr>
            </srcinfo>
            <srcinfo>
                <srccite>
                    <citeinfo>
                        <origin>No conocido</origin>
                        <pubdate>00000000</pubdate>
                        <title>No conocido</title>
                        <geoform>No conocido</geoform>
                    </citeinfo>
                </srccite>
                <srcscale>'.$suf.'</srcscale>
                <typesrc>shapefile</typesrc>
                <srctime>
                    <timeinfo>
                        <sngdate>
                            <caldate>00000000</caldate>
                        </sngdate>
                    </timeinfo>
                    <srccurr>No conocido</srccurr>
                </srctime>
                <srccitea>No conocido</srccitea>
                <srccontr>MAGA, , , (2001/20/20), "Cuencas Hidrográficas de Guatemala", Escala 1:500000. 1, Ministerio de Agricultura, Ganadería y Alimentación, Sin dato, No Aplica, Guatemala.</srccontr>
            </srcinfo>
            <procstep>
                <procdesc>Se utilizaron las placas de información generada por el Instituto Geográfico Nacional de Guatemala y fueron Digitalizadas para convertirlas en formato Shape</procdesc>
                <procdate>00000000</procdate>
            </procstep>
        </lineage>
    </dataqual>
    <spdoinfo>
        <direct>Vector</direct>
        <ptvctinf>
            <sdtsterm>
                <sdtstype>G-polygon</sdtstype>
                <ptvctcnt>38</ptvctcnt>
            </sdtsterm>
        </ptvctinf>
    </spdoinfo>
    <spref>
        <horizsys>
            <geograph>
                <latres>0.0174532925199433</latres>
                <longres>0.0174532925199433</longres>
                <geogunit>Decimal degrees</geogunit>
            </geograph>
            <geodetic>
                <horizdn>WGS84</horizdn>
                <ellips>WGS84</ellips>
                <semiaxis>6378137.000000</semiaxis>
                <denflat>298.257224</denflat>
            </geodetic>
        </horizsys>
    </spref>
    <eainfo>
        <detailed>
            <enttyp>
                <enttypl>'.$tabla.'</enttypl>
                <enttypd>'.$descrip_tabla.'</enttypd>
                <enttypds>No conocido</enttypds>
            </enttyp>
            '.$atributo.'
        </detailed>
    </eainfo>
    <distinfo>
        <distrib>
            <cntinfo>
                <cntorgp>
                    <cntorg>CONABIO</cntorg>
                    <cntper>Mto.Enrique Muñoz López</cntper>
                </cntorgp>
                <cntpos>Director de Análisis Territorial</cntpos>
                <cntaddr>
                    <addrtype>mailing and physical address</addrtype>
                    <address>Av. Liga Periférico - Insurgentes Sur, Núm. 4903, Col. Parques del Pedregal. Delegación Tlalpan. México, D.F.</address>
                    <city>Ciudad de México</city>
                    <state>D.F.</state>
                    <postal>14010</postal>
                    <country>México</country>
                </cntaddr>
                <cntvoice>5004 5005</cntvoice>
                <cntfax>5004 4931</cntfax>
                <cntemail>emunoz@conabio.gob.mx</cntemail>
                <hours>Lunes a Viernes de 8 a 18 hrs.</hours>
            </cntinfo>
        </distrib>
        <resdesc>cencashidgw</resdesc>
        <distliab>La Subdirección de Sistemas de Información Geográfica de la CONABIO solo se hace responsable de la información presentada en el mapa y se deslinda del uso que se le de a la misma.</distliab>
        <stdorder>
            <digform>
                <digtinfo>
                    <formname>CNB.GEO.TMS</formname>
                    <formvern>1.0.0</formvern>
                    <formspec>PNG</formspec>
                </digtinfo>
                <digtopt>
                    <onlinopt>
                        <computer>
                            <networka>
                                <networkr>http://wms0.conabio.gob.mx/cencashidgw.py/</networkr>
                                <networkr>http://wms1.conabio.gob.mx/cencashidgw.py/</networkr>
                                <networkr>http://wms2.conabio.gob.mx/cencashidgw.py/</networkr>
                            </networka>
                        </computer>
                    </onlinopt>
                </digtopt>
            </digform>
            <digform>
                <digtinfo>
                    <formname>Metadato (HTML)</formname>
                    <formvern>CNB2:LINK</formvern>
                    <formspec>describedby canonical</formspec>
                    <formcont>text/html</formcont>
                </digtinfo>
                <digtopt>
                    <onlinopt>
                        <computer>
                            <networka>
                                <networkr>metadatos/doc/html/cencashidgw.html</networkr>
                            </networka>
                        </computer>
                    </onlinopt>
                </digtopt>
            </digform>
            <digform>
                <digtinfo>
                    <formname>Metadato (XML)</formname>
                    <formvern>CNB2:LINK</formvern>
                    <formspec>describedby alternate</formspec>
                    <formcont>text/xml</formcont>
                </digtinfo>
                <digtopt>
                    <onlinopt>
                        <computer>
                            <networka>
                                <networkr>metadatos/doc/fgdc/cencashidgw.xml</networkr>
                            </networka>
                        </computer>
                    </onlinopt>
                </digtopt>
            </digform>
            <digform>
                <digtinfo>
                    <formname>Acceso directo al mapa</formname>
                    <formvern>CNB2:LINK</formvern>
                    <formspec>bookmark</formspec>
                    <formcont>text/html</formcont>
                </digtinfo>
                <digtopt>
                    <onlinopt>
                        <computer>
                            <networka>
                                <networkr>#!l=cencashidgw</networkr>
                            </networka>
                        </computer>
                    </onlinopt>
                </digtopt>
            </digform>
            <digform>
                <digtinfo>
                    <formname>Vista previa</formname>
                    <formvern>CNB2:LINK</formvern>
                    <formspec>preview</formspec>
                    <formcont>image/png</formcont>
                </digtinfo>
                <digtopt>
                    <onlinopt>
                        <computer>
                            <networka>
                                <networkr>descargas/mapas/imagen/96/cencashidgw</networkr>
                            </networka>
                        </computer>
                    </onlinopt>
                </digtopt>
            </digform>
            <digform>
                <digtinfo>
                    <formname>Vista previa</formname>
                    <formvern>CNB2:LINK</formvern>
                    <formspec>icon</formspec>
                    <formcont>image/png</formcont>
                </digtinfo>
                <digtopt>
                    <onlinopt>
                        <computer>
                            <networka>
                                <networkr>descargas/mapas/imagen/20/cencashidgw</networkr>
                            </networka>
                        </computer>
                    </onlinopt>
                </digtopt>
            </digform>
            <digform>
                <digtinfo>
                    <formname>Licencia</formname>
                    <formvern>CNB2:LINK</formvern>
                    <formspec>license</formspec>
                    <formcont>text/html</formcont>
                    <filedec>cnb:external</filedec>
                </digtinfo>
                <digtopt>
                    <onlinopt>
                        <computer>
                            <networka>
                                <networkr>http://creativecommons.org/licenses/by-nc/2.5/mx/</networkr>
                            </networka>
                        </computer>
                    </onlinopt>
                </digtopt>
            </digform>
            <digform>
                <digtinfo>
                    <formname>ESRI Shapefile (SHP)</formname>
                    <formvern>CNB2:LINK</formvern>
                    <formspec>related archives</formspec>
                    <formcont>application/zip</formcont>
                    <filedec>cnb:external</filedec>
                    <transize>4.51</transize>
                </digtinfo>
                <digtopt>
                    <onlinopt>
                        <computer>
                            <networka>
                                <networkr>http://www.conabio.gob.mx/informacion/gis/maps/geo/cencashidgw.zip</networkr>
                            </networka>
                        </computer>
                    </onlinopt>
                </digtopt>
            </digform>
            <digform>
                <digtinfo>
                    <formname>Google Earth (KML)</formname>
                    <formvern>CNB2:LINK</formvern>
                    <formspec>related archives</formspec>
                    <formcont>application/vnd.google-earth.kmz</formcont>
                    <filedec>cnb:external</filedec>
                </digtinfo>
                <digtopt>
                    <onlinopt>
                        <computer>
                            <networka>
                                <networkr>http://www.conabio.gob.mx/informacion/gis/maps/kmz/cencashidgw.kmz</networkr>
                            </networka>
                        </computer>
                    </onlinopt>
                </digtopt>
            </digform>
            <fees>Acceso libre sin ningún cargo al público en general.</fees>
        </stdorder>
        <techpreq>Arc Gis 102, en caso que existan se pueden visualizar en Google Earth KML y/o conexión al servicio WMS.</techpreq>
    </distinfo>
    <metainfo>
        <metd>20181023</metd>
        <metc>
            <cntinfo>
                <cntorgp>
                    <cntorg>CONABIO</cntorg>
                    <cntper>Tonantzin Camacho Sandoval</cntper>
                </cntorgp>
                <cntpos>Administrador de Metadatos</cntpos>
                <cntaddr>
                    <addrtype>mailing and physical address</addrtype>
                    <address>Liga Periférico Insurgentes Sur Num. 4903 1er piso. Col. Parques del Pedregal. Delg. Tlalpan</address>
                    <city>Ciudad de México</city>
                    <state>D.F.</state>
                    <postal>14010</postal>
                    <country>México</country>
                </cntaddr>
                <cntvoice>01 55 5004 5039</cntvoice>
                <cntfax>50044931</cntfax>
                <cntemail>tcamacho@conabio.gob.mx</cntemail>
                <hours>Lunes a Viernes de 8 a 18 hrs.</hours>
            </cntinfo>
        </metc>
        <metstdn>FGDC Content Standards for Digital Geospatial Metadata, 1998</metstdn>
        <metstdv>FGDC-STD-001-1998 version 2.0</metstdv>
    </metainfo>
</metadata>';
 
$xml_text=simplexml_load_string($xml_text_1) or die("Error: Cannot create object");
//print_r($xml_);


$xml_text = $xml_text_1.$xml_text_2.$xml_text_6.$xml_text_3.$xml_text_4.$xml_text_5; 


echo $xml_text;

//---nombre del archivo

$fichero = 'map_xml.xml';
$dir = $cobertura.".xml";

copy($fichero,$dir);
//-----Descarga del archivo

if (is_file($dir)) {
header("Content-Disposition: attachment; filename=\"$dir\"");
readfile($dir);
} else {
die("Error: no se encontró el archivo '$dir'");
}

?>
