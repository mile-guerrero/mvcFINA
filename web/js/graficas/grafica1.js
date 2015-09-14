function crearGrafica($cosPoints) {

  // Some simple loops to build up data arrays.

  var plot3 = $.jqplot('chart3', [$cosPoints], {
    title: 'Producción en kilos por semana',
    animate: !$.jqplot.use_excanvas,
    seriesDefaults: {
      renderer: $.jqplot.BarRenderer,
      pointLabels: {show: true},
      rendererOptions: {varyBarColor: true},
      pointLabels: {show: false}//ensima de las barras
    },
    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        label: 'Ubicacion',
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
//   fontFamily: 'Georgia, Serif',
          fontSize: '7pt'
        },
      },
      yaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
//   fontFamily: 'Georgia, Serif',
          fontSize: '10pt'
        },
      }

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
      rendererOptions: {varyBarColor: true},
    },
    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        label: 'Ubicacion',
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
//          fontFamily: 'Georgia, Serif',
          fontSize: '7pt'
        },
      },
      yaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
//   fontFamily: 'Georgia, Serif',
          fontSize: '10pt'
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
      rendererOptions: {varyBarColor: true},
    },
    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        label: 'Tabajador',
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
//          fontFamily: 'Georgia, Serif',
          fontSize: '8pt'
        },
      },
      yaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
//   fontFamily: 'Georgia, Serif',
          fontSize: '10pt'
        },
      },
    },
  });

}