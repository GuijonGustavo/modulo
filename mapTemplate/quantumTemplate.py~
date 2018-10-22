#!/usr/bin/env python
# - *- coding: utf- 8 - *-


from PyQt4.QtCore import *
from PyQt4.QtGui import *
from qgis.core import *
from qgis.gui import *

class MapComposer:
    """PyQGIS Composer class.  Encapsulates boiler plate QgsComposition
    code and centers the QgsComposerMap object on an 8.5x11 inch page."""
    def __init__(self, qmlr=None, qmr=None, lyr=None, **kwargs):
	self.paperWidth = 297
	self.paperHeight = 210
	self.rectScale = 1
        #Dimensiones del cuadro principal dentro del cuadro principal
	self.xScale = 0.7  # En X 
	self.yScale = 0.7 #En Y
	self.qmlr = qmlr
	self.qmr = qmr
	self.__dict__.update(kwargs)			
	self.lyrs = self.qmlr.mapLayers().keys()
	self.qmr.setLayerSet(self.lyrs)
	self.rect = QgsRectangle(self.qmr.extent())
	self.rect.scale(self.rectScale)
	self.qmr.setExtent(self.rect)
	self.c = QgsComposition(self.qmr)
	self.c.setPlotStyle(QgsComposition.Print)
	self.c.setPaperSize(self.paperWidth, self.paperHeight)
	self.w = self.c.paperWidth() * self.xScale
	self.h = self.c.paperHeight() * self.yScale
	self.x = (self.c.paperWidth() - self.w) / 2
	self.y = (self.c.paperHeight() - self.h) / 2
	#self.y = 50
	self.composerMap = QgsComposerMap(self.c,self.x,self.y,self.w,self.h)
	self.composerMap.setNewExtent(self.rect)		
	self.composerMap.setFrameEnabled(True)
	#self.composerMap.save('/home/wattie/Descargas/prueba_1.qpt')
	#self.composerMap.save()
	self.c.addItem(self.composerMap)

    def output(self, path, format):
	self.dpi = self.c.printResolution()
	self.c.setPrintResolution(self.dpi)
	self.dpmm = self.dpi / 100  #Con esto se manipulan las dimensiones de salida
	self.width = int(self.dpmm * self.c.paperWidth())
	self.height = int(self.dpmm * self.c.paperHeight())
	self.image = QImage(QSize(self.width, self.height), QImage.Format_ARGB32)
	self.image.setDotsPerMeterX(self.dpmm * 1000)
	self.image.setDotsPerMeterY(self.dpmm * 1000)
	self.image.fill(0)
	self.imagePainter = QPainter(self.image)
	self.sourceArea = QRectF(0, 0, self.c.paperWidth(), self.c.paperHeight())
	self.targetArea = QRectF(0, 0, self.width, self.height)
	self.c.render(self.imagePainter, self.targetArea, self.sourceArea)
	self.imagePainter.end()
	self.image.save(path, format)		



#cargamos el archivo al lienzo como en este ejemplo:
#lyr = QgsVectorLayer("/home/wattie/Descargas/municipios/mun_2018cw.shp", "MunicipiosMex", "ogr") #Ruta del shp a usar
#lyr = QgsVectorLayer("Escriba la ruta de su shape", "Nombre", "ogr") 
reg = QgsMapLayerRegistry.instance()
reg.addMapLayer(lyr)





#generamos un disenador de impresion
mr = iface.mapCanvas().mapRenderer()
#qc = MapComposer.MapComposer(qmlr=reg, qmr=mr)
qc = MapComposer(qmlr=reg, qmr=mr)


"""
mcw = qc.composerMap.rect().width()
mch = qc.composerMap.rect().height()

ax = qc.x + mcw +10
ay = (qc.y - mch) +10

afy = ay -20
qc.arrow = QgsComposerArrow(QPointF(ax,ay), QPointF(ax, afy), qc.c)
qc.c.addItem(qc.arrow)
"""

#estilos del titulo del mapa
qc.label = QgsComposerLabel(qc.c)




cadena1 = unicode(cadena1, "utf-8")
cita1 = unicode(cita1, "utf-8")

qc.label.setText(cadena1)
f = QFont()
f.setBold(True)
f.setFamily("Arial")
f.setPointSize(25)
qc.label.setFont(f)
qc.label.adjustSizeToText()
qc.label.setFrameEnabled(True)
qc.label.setItemPosition(20,10)
qc.c.addItem(qc.label)


#estilos del cita del mapa
qc.label = QgsComposerLabel(qc.c)
qc.label.setText(cita1)
f = QFont()
f.setBold(False)
f.setFamily("Arial")
f.setPointSize(5)
qc.label.setFont(f)
qc.label.adjustSizeToText()
qc.label.setFrameEnabled(True)
qc.label.setItemPosition(20,155)
qc.c.addItem(qc.label)

#estilos de la leyenda del mapa
qc.legend = QgsComposerLegend(qc.c)
qc.legend.model().setLayerSet(qc.qmr.layerSet())
qc.legend.setItemPosition(10, 40)
qc.c.addItem(qc.legend)

#estilos de grillado
setGridAnnoPos = qc.composerMap.setGridAnnotationPosition
setGridAnnoDir = qc.composerMap.setGridAnnotationDirection
qcm = QgsComposerMap
qc.composerMap.setGridEnabled(True)
qc.composerMap.setGridIntervalX(100000) #Separacion de las lineas de la malla. Y se generan desde abajo a la izquierda
qc.composerMap.setGridIntervalY(100000)
qc.composerMap.setGridStyle(qcm.Solid)
qc.composerMap.setShowGridAnnotation(True)
qc.composerMap.setGridAnnotationPrecision(2)
setGridAnnoPos(qcm.OutsideMapFrame, qcm.Top)
setGridAnnoDir(qcm.Horizontal, qcm.Top)
setGridAnnoPos(qcm.OutsideMapFrame, qcm.Bottom)
setGridAnnoDir(qcm.Horizontal, qcm.Bottom)
setGridAnnoPos(qcm.OutsideMapFrame, qcm.Left)
setGridAnnoDir(qcm.Vertical, qcm.Left)
setGridAnnoPos(qcm.OutsideMapFrame, qcm.Right)
setGridAnnoDir(qcm.Vertical, qcm.Right)
qc.composerMap.setAnnotationFrameDistance(1) #Distancia de separacion entre la numeracion y el marco
qc.composerMap.setGridPenWidth(.1)
qc.composerMap.setGridPenColor(QColor(25, 30, 0))
qc.composerMap.setAnnotationFontColor(QColor(120, 0, 30))
qc.c.addComposerMap(qc.composerMap)






#definimos barra de escala
qc.scalebar = QgsComposerScaleBar(qc.c)
qc.scalebar.setStyle('Single Box')
qc.scalebar.setComposerMap(qc.composerMap)
qc.scalebar.applyDefaultSize()
sbw = qc.scalebar.rect().width()
sbh = qc.scalebar.rect().height()
mcw = qc.composerMap.rect().width()
mch = qc.composerMap.rect().height()
sbx = qc.x + (mcw - sbw)
sby = qc.y + mch
qc.scalebar.setItemPosition(45, 130)
qc.c.addItem(qc.scalebar)



qc.project = QgsProject.instance()
#Escribimos la ruta de salida del proyecto. Por ejemplo:
#qc.project.write(QFileInfo('/home/wattie/Descargas/geom_1.qgs'))
qc.project.write(QFileInfo('Ruta de salida.qgs'))
#definimos grafico de salida como en el siguiente ejemplo:
#qc.output("/home/wattie/Descargas/geom_v1.png", "png") 
qc.output("Ruta de salida", "png") #salida del archivo
