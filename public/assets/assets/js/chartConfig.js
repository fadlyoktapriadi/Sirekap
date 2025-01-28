
  /**
   * Dashboard Analytics
   */

  'use strict';

  (function () {
    let cardColor, headingColor, axisColor, shadeColor, borderColor;

    cardColor = config.colors.white;
    headingColor = config.colors.headingColor;
    axisColor = config.colors.axisColor;
    borderColor = config.colors.borderColor;

    let base_url = "http://localhost:8080/dashboard/"; 

    let year = new Date().getFullYear();

    // Fetch data from the server
    $.getJSON(base_url + "getKakDataJson/" + year, function(data) {
      // Process the data to fit the chart format
      let chartKAK = Array(12).fill(0);
      data.forEach(item => {
        chartKAK[item.bulan - 1] = item.total_kak;
      });

      $.getJSON(base_url + "getLpjDataJson/" + year, function(data) {
      // Process the data to fit the chart format
      let chartLpj = Array(12).fill(0);
      data.forEach(item => {
        chartLpj[item.bulan - 1] = item.total_lpj;
      });

      $.getJSON(base_url + "getKakSelesaiDataJson/" + year, function(data) {
      // Process the data to fit the chart format
      let chartSelesai = Array(12).fill(0);
      data.forEach(item => {
        chartSelesai[item.bulan - 1] = item.total_lpj_selesai;
      });

      const totalRevenueChartEl = document.querySelector('#totalRevenueChart'),
                    totalRevenueChartOptions = {
                        series: [
                            {
                                name: 'KAK',
                                data: chartKAK,
                                type: 'bar'
                            },
                            {
                                name: 'LPJ',
                                data: chartLpj,
                                type: 'bar'
                            },
                            {
                                name: 'Kegiatan Selesai',
                                data: chartSelesai,
                                type: 'bar'
                            },
                        ],
                        chart: {
                            height: 300,
                            type: 'bar',
                            stacked: false,
                            toolbar: { show: false },
                            fontFamily: 'Public Sans, sans-serif' 
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '50%'
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        xaxis: {
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                        },

                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return val;
                                }
                            }
                        }
                    };

                const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
                totalRevenueChart.render();
    });
    });
  });
  
  $.getJSON(base_url + "getPieUnit", function(data) {
      // Process the data to fit the chart format
      let chartPie = data.map(item => item);

      $.getJSON(base_url + "kinerjaUnit", function(data) {
      // Process the data to fit the chart format
      let resultKinerja = data;
  
    
  const chartOrderStatistics = document.querySelector('#orderStatisticsChart'),
    orderChartConfig = {
      chart: {
        height: 250,
        width: 250,
        type: 'donut'
      },
      labels: ['Kesehatan Masyarakat', 'Pengembangan', 'Kefarmasian & Labolatorium'],
      series: chartPie,
      colors: [config.colors.primary, config.colors.secondary, config.colors.info, config.colors.success],
      stroke: {
        width: 5,
        colors: cardColor
      },
      dataLabels: {
        enabled: false,
        formatter: function (val, opt) {
          return parseInt(val);
        }
      },
      legend: {
        show: false
      },
      grid: {
        padding: {
          top: 0,
          bottom: 0,
          right: 15
        }
      },
      plotOptions: {
        pie: {
          donut: {
            size: '75%',
            labels: {
              show: true,
              value: {
                fontSize: '1.5rem',
                fontFamily: 'Public Sans',
                color: headingColor,
                offsetY: -15,
                formatter: function (val) {
                  return parseInt(val) + '%';
                }
              },
              name: {
                offsetY: 20,
                fontFamily: 'Public Sans'
              },
              total: {
                show: true,
                fontSize: '0.8125rem',
                color: axisColor,
                label: 'Kinerja',
                formatter: function (w) {
                  return resultKinerja + '%';
                }
              }
            }
          }
        }
      }
    };
  
  if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
    const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
    statisticsChart.render();
  }
});
});
  })();


document.getElementById('cariButton').addEventListener('click', function() {
    var selectedYear = document.getElementById('tahun_kinerja').value;
    updateGrafikKinerja(selectedYear);
});

function updateGrafikKinerja(year) {
    let cardColor, headingColor, axisColor, borderColor;

    cardColor = config.colors.white;
    headingColor = config.colors.headingColor;
    axisColor = config.colors.axisColor;
    borderColor = config.colors.borderColor;

    let base_url = "http://localhost:8080/dashboard/";

    // Fetch data from the server
    $.getJSON(base_url + "getKakDataJson/" + year, function(data) {
        // Process the data to fit the chart format
        let chartKAK = Array(12).fill(0);
        data.forEach(item => {
            chartKAK[item.bulan - 1] = item.total_kak;
        });

        $.getJSON(base_url + "getLpjDataJson/" + year, function(data) {
            // Process the data to fit the chart format
            let chartLpj = Array(12).fill(0);
            data.forEach(item => {
                chartLpj[item.bulan - 1] = item.total_lpj;
            });

            $.getJSON(base_url + "getKakSelesaiDataJson/" + year, function(data) {
                // Process the data to fit the chart format
                let chartSelesai = Array(12).fill(0);
                data.forEach(item => {
                    chartSelesai[item.bulan - 1] = item.total_lpj_selesai;
                });

                

                // Total Revenue Report Chart - Bar Chart
                const totalRevenueChartEl = document.querySelector('#totalRevenueChart'),
                    totalRevenueChartOptions = {
                        series: [
                            {
                                name: 'KAK',
                                data: chartKAK,
                                type: 'bar'
                            },
                            {
                                name: 'LPJ',
                                data: chartLpj,
                                type: 'bar'
                            },
                            {
                                name: 'Kegiatan Selesai',
                                data: chartSelesai,
                                type: 'bar'
                            },
                        ],
                        chart: {
                            height: 300,
                            type: 'bar',
                            stacked: false,
                            toolbar: { show: false }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '50%'
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ['transparent']
                        },
                        xaxis: {
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                        },

                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return val;
                                }
                            }
                        }
                    };

                const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
                totalRevenueChart.render();
            });
        });
    });
}