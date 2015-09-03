function crearGrafica(cosPoints) {
  // Some simple loops to build up data arrays.
  var plot3 = $.jqplot('chart3', [cosPoints], {
    title: 'Producción de la semana',
    legend: {show: false},
    axes: {
         pad: 2,
      xaxis: {
          tickRenderer:$.jqplot.CanvasAxisTickRenderer,
        renderer: $.jqplot.CategoryAxisRenderer,
          label: 'Peso en kilos',
          labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
          tickRenderer: $.jqplot.CanvasAxisTickRenderer,
          tickOptions: {
              angle: 30,
              fontFamily: 'Courier New',
              fontSize: '9pt'
          }
         
      },
      yaxis: {
//        pad: 2,
        renderer: $.jqplot.CategoryAxisRenderer,
          label: 'Fecha',
          labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
          tickRenderer: $.jqplot.CanvasAxisTickRenderer,
          renderer: $.jqplot.DateAxisRenderer,
          tickOptions: {
              angle: 30,
              fontFamily: 'Courier New',
              fontSize: '9pt'
          }
      }

    },
    
    series: [{lineWidth: 1, markerOptions: {style: 'dimaond'}, shadow: false, }],
  }
  );
}


function crearGrafica2(cosPoints2) {
//  var plot3 = $.jqplot('chart2', [cosPoints2], {
//    title: 'Historial de plantas',
//    legend: {show: false},
//    axes: {
//         pad: 2,
//      xaxis: {
//          renderer: $.jqplot.CategoryAxisRenderer,
//                label: 'Cantidad de plantas',
//                labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
//                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
//                tickOptions: {
//                    angle: 30
//                }         
//      },
//      yaxis: {
////        pad: 2,
//           renderer: $.jqplot.CategoryAxisRenderer,
//          label: 'Ubicacion',
//          labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
//          tickRenderer: $.jqplot.CanvasAxisTickRenderer,
//      }
//
//    },
//    
//    series: [{lineWidth: 1, markerOptions: {style: 'dimaond'}, shadow: false, }],
//  }
//  );
//  

       
         
        plot3 = $.jqplot('chart2', [cosPoints2], {
            seriesDefaults:{
            renderer:$.jqplot.BarRenderer,
            rendererOptions: {
                // Set the varyBarColor option to true to use different colors for each bar.
                // The default series colors are used.
                varyBarColor: true
            }
        },
            axes: {
                 xaxis: {
          renderer: $.jqplot.CategoryAxisRenderer,
                label: 'Cantidad de plantas',
                labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    angle: 30
                }         
      },
      yaxis: {
//        pad: 2,
           renderer: $.jqplot.CategoryAxisRenderer,
//          label: 'Ubicacion',
          labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
          tickRenderer: $.jqplot.CanvasAxisTickRenderer
      }

    },
       
        });
     
}

