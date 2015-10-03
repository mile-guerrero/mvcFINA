function crearGrafica($cosPoints) {

  // Some simple loops to build up data arrays.

  var plot3 = $.jqplot('chart3', [$cosPoints], {
    title: 'Producción en kilos por semana',
    animate: !$.jqplot.use_excanvas,
   seriesDefaults: {
      renderer: $.jqplot.BarRenderer,
      pointLabels: {show: false},
      rendererOptions: {varyBarColor: true,
                    barDirection: 'horizontal'
                }
    },
    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
//   fontFamily: 'Georgia, Serif',
          fontSize: '10pt'
        },
      },
      yaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        label: 'Lote',
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
//          fontFamily: 'Georgia, Serif',
          fontSize: '8pt'
        },
      },

    },
  });

}

function crearGrafica2(cosPoints2) {


  plot3 = $.jqplot('chart2', [cosPoints2], {
    title: 'Historial de plantas',
    animate: !$.jqplot.use_excanvas,
    seriesDefaults: {
      renderer: $.jqplot.BarRenderer,
      pointLabels: {show: false},
      rendererOptions: {varyBarColor: true,
                    barDirection: 'horizontal'
                }
    },
    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
//   fontFamily: 'Georgia, Serif',
          fontSize: '10pt'
        },
      },
      yaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        label: 'Tabajador',
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
//          fontFamily: 'Georgia, Serif',
          fontSize: '8pt'
        },
      },
    },
  });

}


function crearGrafica3(cosPoints3) {
  plot3 = $.jqplot('chart4', [cosPoints3], {
    title: 'Historial de pago a trabajador',
    animate: !$.jqplot.use_excanvas,
    seriesDefaults: {
      renderer: $.jqplot.BarRenderer,
      pointLabels: {show: false},
      rendererOptions: {varyBarColor: true,
                    barDirection: 'horizontal'
                }
    },
    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
//   fontFamily: 'Georgia, Serif',
          fontSize: '10pt'
        },
      },
      yaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        label: 'Tabajador',
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
//          fontFamily: 'Georgia, Serif',
          fontSize: '8pt'
        },
      },
    },
  });

}


function crearGrafica4(cosPoints, sinPoints) {

 
   plot3 = $.jqplot('chart5', [cosPoints, sinPoints], 
    { 
      title:'Presupuesto Historico', 
    animate: !$.jqplot.use_excanvas,
//    seriesDefaults: {
//      renderer: $.jqplot.BarRenderer,
//      pointLabels: {show: false},
//      rendererOptions: {varyBarColor: true},
//    },
    axes: {
      xaxis: {
//        renderer: $.jqplot.CategoryAxisRenderer,
renderer: $.jqplot.LogAxisRenderer,
        label: 'Presupuesto en $',
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
          fontSize: '8pt'
        },
      },
      yaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
          fontSize: '10pt'
        },
      },
    },
  });
    

}

function crearGrafica5(pago1, pago2) {

 
   plot3 = $.jqplot('chart6', [pago1, pago2], 
    { 
      title:'Presupuesto pagos trabajador', 
    animate: !$.jqplot.use_excanvas,
//    seriesDefaults: {
//      renderer: $.jqplot.BarRenderer,
//      pointLabels: {show: false},
//      rendererOptions: {varyBarColor: true},
//    },
// cursor:{
//            show: true, 
//            zoom: true
//        },
    axes: {
      xaxis: {
        renderer: $.jqplot.LogAxisRenderer,
//        renderer: $.jqplot.CategoryAxisRenderer,
        label: 'Salario en $',
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
          fontSize: '8pt'
        },
      },
      yaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
          fontSize: '10pt'
        },
      },
    },
  });
}

function crearGrafica6(produccion1, produccion2) {

 
   plot3 = $.jqplot('chart7', [produccion1, produccion2], 
    { 
      title:'Presupuesto produccion', 
    animate: !$.jqplot.use_excanvas,
   
//    seriesDefaults: {
//      renderer: $.jqplot.BarRenderer,
//      pointLabels: {show: false},
//      rendererOptions: {varyBarColor: true},
//    },
//   cursor:{
//            show: true, 
//            zoom: true
//        },
    axes: {
      xaxis: {
//        min:0,
//        max: 500,
//        renderer: $.jqplot.CategoryAxisRenderer,
        renderer: $.jqplot.LogAxisRenderer,
        label: 'Producción en Kg',
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
          fontSize: '8pt'
        },
      },
      yaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
          fontSize: '10pt'
        },
      },
    },
    
  });
  
}


function crearGrafica8($cosPoints) {
  var plot3 = $.jqplot('chart8', [$cosPoints], {
    title: 'Ganancia Lote ',
    animate: !$.jqplot.use_excanvas,
   seriesDefaults: {
      renderer: $.jqplot.BarRenderer,
      pointLabels: {show: false},
      rendererOptions: {varyBarColor: true,
                    barDirection: 'horizontal'
                }
    },
    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
//   fontFamily: 'Georgia, Serif',
          fontSize: '10pt'
        },
      },
      yaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        label: 'Lote',
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
//          fontFamily: 'Georgia, Serif',
          fontSize: '8pt'
        },
      },

    },
  });

}