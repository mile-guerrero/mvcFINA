function crearGrafica(cosPoints) {
  // Some simple loops to build up data arrays.
  var plot3 = $.jqplot('chart3', [cosPoints], {
    title: 'Producción en kilos por semana',
    seriesDefaults: {
      renderer: $.jqplot.BarRenderer,
      rendererOptions: {
        // Set the varyBarColor option to true to use different colors for each bar.
        // The default series colors are used.
        varyBarColor: true
      }
    },
    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        label: 'Ubicacion',
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
          fontFamily: 'Georgia, Serif',
          fontSize: '10pt'
        },
      },
      yaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer
      }

    },
  });
}


function crearGrafica2(cosPoints2) {


  plot3 = $.jqplot('chart2', [cosPoints2], {
    title: 'Historial de plantas',
    seriesDefaults: {
      renderer: $.jqplot.BarRenderer,
      rendererOptions: {
        // Set the varyBarColor option to true to use different colors for each bar.
        // The default series colors are used.
        varyBarColor: true
      }
    },
    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        label: 'Ubicacion',
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer,
        tickOptions: {
          fontFamily: 'Georgia, Serif',
          fontSize: '10pt'
        },
      },
      yaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
        tickRenderer: $.jqplot.CanvasAxisTickRenderer
      }

    },
  });

}

