<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view("admin/_partials/head.php") ?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view("admin/_partials/sidebar.php") ?>

        <!-- top navigation -->
        <?php $this->load->view("admin/_partials/navbar.php") ?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row" style="display: inline-block; width: 100%" >
          <div class="tile_count">
            <div class="col-md-2 col-sm-4  tile_stats_count" style="text-align: center;">
              <a href="<?php echo site_url('admin/siswa') ?>">
              <span class="count_top"><i class="fa fa-user"></i> Total Siswa</span>
              <div class="count" style="text-align: center;"><?php echo $banyak_siswa ?></div>
              </a>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count" style="text-align: center;">
              <a href="<?php echo site_url('admin/bayar_spp/rekapSPP') ?>">
              <span class="count_top"><i class="fa fa-calendar"></i> Tunggakan SPP</span>
              <div class="count"><?php echo $jumlah_blmlunas_SPP ?></div>
              <span class="count_bottom"><?php $this->load->helper('bulan_helper'); echo bulan($bulan) ?> <?php echo $tahun ?></span>
              </a>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count" style="text-align: center;">
              <a href="<?php echo site_url('admin/bayar_catering/rekapCatering') ?>">
              <span class="count_top"><i class="fa fa-cutlery"></i> Tunggakan Catering</span>
              <div class="count"><?php echo $jumlah_blmlunas_Catering ?></div>
              <span class="count_bottom"><?php $this->load->helper('bulan_helper'); echo bulan($bulan) ?> <?php echo $tahun ?></span>
              </a>
            </div>
            <div class="col-md-2 col-sm-4  tile_stats_count" style="text-align: center;">
              <a href="<?php echo site_url('admin/daftar_ulang/rekapDaftarUlang') ?>">
              <span class="count_top"><i class="fa fa-money"></i>  Tunggakan DU</span>
              <div class="count"><?php echo $jumlah_blmlunas_du ?></div>
              </a>
            </div>
            <div class="col-md-4 col-sm-4  tile_stats_count" style="text-align: center;">
              <a href="<?php echo site_url('admin/rekapitulasi') ?>">
              <span class="count_top"><i class="fa fa-clock-o"></i>  Saldo Hingga Saat Ini</span>
              <div class="count"> Rp. <?php $this->load->helper('rupiah_helper'); echo rupiah($saldo) ?></div>
              <!-- <span class="count_bottom"><?php $this->load->helper('bulan_helper'); echo bulan($bulan) ?> <?php echo $tahun ?></span> -->
            </a>
            </div>
            
            
          </div>
        </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 ">
              <div class="dashboard_graph">
                <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Pemasukkan dan Pengeluaran 6 Bulan Terakhir</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="lineChart1"></canvas>
                  </div>
                </div>
              </div>
                

                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />

          <div class="row">

            <div class="col-md-6 col-sm-6 ">
              <div class="x_panel">
                  <div class="x_title">
                    <a href="<?php echo site_url('admin/bayar_spp/rekapSPP') ?>">
                    <h2>SPP <?php echo bulan($bulan) ?> <?php echo $tahun ?></h2>
                   </a>
                    <div class="clearfix"></div>
                  </div>
                 
                  <div class="x_content">

                    <div id="echart_pieSPP" style="height:385px;"></div>

                  </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 ">
              <div class="x_panel">
                  <div class="x_title">
                    <a href="<?php echo site_url('admin/bayar_catering/rekapCatering') ?>">
                    <h2>Catering <?php echo bulan($bulan) ?> <?php echo $tahun ?></h2>
                   </a>
                    <div class="clearfix"></div>
                  </div>
                 
                  <div class="x_content">

                    <div id="echart_pie_catering" style="height:385px;"></div>

                  </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 ">
              <div class="x_panel">
                  <div class="x_title">
                    <a href="<?php echo site_url('admin/pemasukkan_lain/rekapPemasukkanLain') ?>">
                    <h2>Pemasukkan Lain</h2>
                    </a>
                    <div class="clearfix"></div>
                  </div>
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p><?php echo bulan($bulan) ?> <?php echo $tahun ?></p>
                      </th>
                      <th>
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <p class="">Rp. <?php echo rupiah($nominal_pemasukkan_lain->total) ?></p>
                        </div>
                        
                      </th>
                    </tr>
                    
                  </table>
                  <div class="x_content">

                    <div id="echart_pie_Pemasukkan_lain" style="height:350px;"></div>

                  </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 ">
              <div class="x_panel">
                  <div class="x_title">
                    <a href="<?php echo site_url('admin/pengeluaran/rekapPengeluaran') ?>">
                    <h2>Pengeluaran</h2>
                   </a>
                    <div class="clearfix"></div>
                  </div>
                  <table class="" style="width:100%">
                    <tr>
                      <th style="width:37%;">
                        <p><?php echo bulan($bulan) ?> <?php echo $tahun ?></p>
                      </th>
                      <th>
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                          <p class="">Rp. <?php echo rupiah($nominal_pengeluaran->total) ?></p>
                        </div>
                        
                      </th>
                    </tr>
                    
                  </table>
                  <div class="x_content">

                    <div id="echart_pie_Pengeluaran" style="height:350px;"></div>

                  </div>
                </div>
            </div>



          </div>

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php $this->load->view("admin/_partials/footer.php") ?>
        <!-- /footer content -->
      </div>
    </div>

    


    <!-- jQuery -->

     <!-- jQuery -->
    <script src="<?php echo base_url('assets/jquery/dist/jquery.min.js') ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('assets/fastclick/lib/fastclick.js') ?>"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url('assets/nprogress/nprogress.js') ?>"></script>

    <!-- Chart.js -->
    <script src="<?php echo base_url('assets/Chart.js/dist/Chart.min.js') ?>"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url('assets/gauge.js/dist/gauge.min.js') ?>"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url('assets/bootstrap-progressbar/bootstrap-progressbar.min.js') ?>"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('assets/iCheck/icheck.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/echarts/dist/echarts.min.js') ?>"></script>
    
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('js/custom.min.js') ?>"></script>


    <script type="text/javascript">
          function init_charts() {
      
        console.log('run_charts  typeof [' + typeof (Chart) + ']');
      
        if( typeof (Chart) === 'undefined'){ return; }
        
        console.log('init_charts');
      
        
        Chart.defaults.global.legend = {
          enabled: false
        };
 
        // Line chart
      


      if ($('#lineChart1').length ){ 
      
        var ctx = document.getElementById("lineChart1");
        var lineChart1 = new Chart(ctx, {
        type: 'line',
        data: {
          labels: [
           <?php foreach($labelBulan as $d):
              echo '"' . $d. '"';?> ,
              <?php endforeach; ?>
           //"January","February","March", 
          // "April", 
          // "Ma", 
          // "Jun", 
          // "Jul",
          ],
          datasets: [{
          label: "Pemasukkan",
          backgroundColor: "rgba(38, 185, 154, 0.31)",
          borderColor: "rgba(38, 185, 154, 0.7)",
          pointBorderColor: "rgba(38, 185, 154, 0.7)",
          pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: "rgba(220,220,220,1)",
          pointBorderWidth: 1,
          data: [
            <?php foreach($grafPemasukkan as $grafPemasukkan):
              echo '"' . $grafPemasukkan. '"';?> ,
              <?php endforeach; ?>
            //131000000, 174000000, 116000000, 139000000, 120000000, 185000000, 117000000
          ]
          }, {
          label: "Pengeluaran",
          backgroundColor: "rgba(195, 3, 3, 0.3)",
          borderColor: "rgba(195, 3, 3, 0.70)",
          pointBorderColor: "rgba(195, 3, 3, 0.70)",
          pointBackgroundColor: "rgba(195, 3, 3, 0.70)",
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: "rgba(151,187,205,1)",
          pointBorderWidth: 1,
          data: [
            <?php foreach($grafPengeluaran as $grafPengeluaran):
              echo '"' . $grafPengeluaran. '"';?> ,
              <?php endforeach; ?>
          //82000000, 23000000, 66000000, 9000000, 99000000, 4000000, 2000000
          ]
          }]
        },
        });
      
      }
        
      
   
    }



    </script>
    <script type="text/javascript">
      
function init_echarts() {
    
        if( typeof (echarts) === 'undefined'){ return; }
        console.log('init_echarts');
      
    
          var theme = {
          color: [
            '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
            '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
          ],

          title: {
            itemGap: 8,
            textStyle: {
              fontWeight: 'normal',
              color: '#408829'
            }
          },

          dataRange: {
            color: ['#1f610a', '#97b58d']
          },

          toolbox: {
            color: ['#408829', '#408829', '#408829', '#408829']
          },

          tooltip: {
            backgroundColor: 'rgba(0,0,0,0.5)',
            axisPointer: {
              type: 'line',
              lineStyle: {
                color: '#408829',
                type: 'dashed'
              },
              crossStyle: {
                color: '#408829'
              },
              shadowStyle: {
                color: 'rgba(200,200,200,0.3)'
              }
            }
          },

          dataZoom: {
            dataBackgroundColor: '#eee',
            fillerColor: 'rgba(64,136,41,0.2)',
            handleColor: '#408829'
          },
          grid: {
            borderWidth: 0
          },

          categoryAxis: {
            axisLine: {
              lineStyle: {
                color: '#408829'
              }
            },
            splitLine: {
              lineStyle: {
                color: ['#eee']
              }
            }
          },

          valueAxis: {
            axisLine: {
              lineStyle: {
                color: '#408829'
              }
            },
            splitArea: {
              show: true,
              areaStyle: {
                color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
              }
            },
            splitLine: {
              lineStyle: {
                color: ['#eee']
              }
            }
          },
          timeline: {
            lineStyle: {
              color: '#408829'
            },
            controlStyle: {
              normal: {color: '#408829'},
              emphasis: {color: '#408829'}
            }
          },

          k: {
            itemStyle: {
              normal: {
                color: '#68a54a',
                color0: '#a9cba2',
                lineStyle: {
                  width: 1,
                  color: '#408829',
                  color0: '#86b379'
                }
              }
            }
          },
          map: {
            itemStyle: {
              normal: {
                areaStyle: {
                  color: '#ddd'
                },
                label: {
                  textStyle: {
                    color: '#c12e34'
                  }
                }
              },
              emphasis: {
                areaStyle: {
                  color: '#99d2dd'
                },
                label: {
                  textStyle: {
                    color: '#c12e34'
                  }
                }
              }
            }
          },
          force: {
            itemStyle: {
              normal: {
                linkStyle: {
                  strokeColor: '#408829'
                }
              }
            }
          },
          chord: {
            padding: 4,
            itemStyle: {
              normal: {
                lineStyle: {
                  width: 1,
                  color: 'rgba(128, 128, 128, 0.5)'
                },
                chordStyle: {
                  lineStyle: {
                    width: 1,
                    color: 'rgba(128, 128, 128, 0.5)'
                  }
                }
              },
              emphasis: {
                lineStyle: {
                  width: 1,
                  color: 'rgba(128, 128, 128, 0.5)'
                },
                chordStyle: {
                  lineStyle: {
                    width: 1,
                    color: 'rgba(128, 128, 128, 0.5)'
                  }
                }
              }
            }
          },
          gauge: {
            startAngle: 225,
            endAngle: -45,
            axisLine: {
              show: true,
              lineStyle: {
                color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
                width: 8
              }
            },
            axisTick: {
              splitNumber: 10,
              length: 12,
              lineStyle: {
                color: 'auto'
              }
            },
            axisLabel: {
              textStyle: {
                color: 'auto'
              }
            },
            splitLine: {
              length: 18,
              lineStyle: {
                color: 'auto'
              }
            },
            pointer: {
              length: '90%',
              color: 'auto'
            },
            title: {
              textStyle: {
                color: '#333'
              }
            },
            detail: {
              textStyle: {
                color: 'auto'
              }
            }
          },
          textStyle: {
            fontFamily: 'Arial, Verdana, sans-serif'
          }
        };

        //echart Pie
        
      if ($('#echart_pieSPP').length ){  
        
        var echartPie = echarts.init(document.getElementById('echart_pieSPP'), theme);

        echartPie.setOption({
        tooltip: {
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
          x: 'center',
          y: 'bottom',
          data: ['Lunas', 'Belum Lunas']
        },
        toolbox: {
          show: true,
          feature: {
          magicType: {
            show: true,
            type: ['pie', 'funnel'],
            option: {
            funnel: {
              x: '25%',
              width: '50%',
              funnelAlign: 'left',
              max: 1548
            }
            }
          },
          restore: {
            show: true,
            title: "Restore"
          },
          saveAsImage: {
            show: true,
            title: "Save Image"
          }
          }
        },
        calculable: true,
        series: [{
          name: '<?php echo bulan($bulan)." ".$tahun;?>',
          type: 'pie',
          radius: '75%',
          center: ['50%', '48%'],
          data: [{
          //value: 50, name: 'Lunas'
          value: <?php echo '"' . $jumlah_lunas_spp. '"';?>, name: 'Lunas'
          }, {
          value: <?php echo '"' . $jumlah_blmlunas_spp. '"';?>, name: 'Belum Lunas'
          }]
        }]
        });

        var dataStyle = {
        normal: {
          label: {
          show: false
          },
          labelLine: {
          show: false
          }
        }
        };

        var placeHolderStyle = {
        normal: {
          color: 'rgba(0,0,0,0)',
          label: {
          show: false
          },
          labelLine: {
          show: false
          }
        },
        emphasis: {
          color: 'rgba(0,0,0,0)'
        }
        };

      }


       //echart Pie
        
      if ($('#echart_pie_catering').length ){  
        
        var echartPie = echarts.init(document.getElementById('echart_pie_catering'), theme);

        echartPie.setOption({
        tooltip: {
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
          x: 'center',
          y: 'bottom',
          data: ['Lunas', 'Belum Lunas']
        },
        toolbox: {
          show: true,
          feature: {
          magicType: {
            show: true,
            type: ['pie', 'funnel'],
            option: {
            funnel: {
              x: '25%',
              width: '50%',
              funnelAlign: 'left',
              max: 1548
            }
            }
          },
          restore: {
            show: true,
            title: "Restore"
          },
          saveAsImage: {
            show: true,
            title: "Save Image"
          }
          }
        },
        calculable: true,
        series: [{
          name: '<?php echo bulan($bulan)." ".$tahun;?>',
          type: 'pie',
          radius: '75%',
          center: ['50%', '48%'],
          data: [{
          //value: 50, name: 'Lunas'
          value: <?php echo '"' . $jumlah_lunas_catering. '"';?>, name: 'Lunas'
          }, {
          value: <?php echo '"' . $jumlah_blmlunas_catering. '"';?>, name: 'Belum Lunas'
          }]
        }]
        });

        var dataStyle = {
        normal: {
          label: {
          show: false
          },
          labelLine: {
          show: false
          }
        }
        };

        var placeHolderStyle = {
        normal: {
          color: 'rgba(0,0,0,0)',
          label: {
          show: false
          },
          labelLine: {
          show: false
          }
        },
        emphasis: {
          color: 'rgba(0,0,0,0)'
        }
        };

      } 


        //echart Pie Collapse
        
      if ($('#echart_pie_Pengeluaran').length ){ 
        
        var echartPieCollapse = echarts.init(document.getElementById('echart_pie_Pengeluaran'), theme);
        
        echartPieCollapse.setOption({
        tooltip: {
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
          x: 'center',
          y: 'bottom',
          data: [
          <?php foreach ($pengeluaran_group as $groupkeluar): ?>
          '<?php echo $groupkeluar->nama_kategori?>',
          <?php endforeach; ?>
          ]
        },
        toolbox: {
          show: true,
          feature: {
          magicType: {
            show: true,
            type: ['pie', 'funnel']
          },
          restore: {
            show: true,
            title: "Restore"
          },
          saveAsImage: {
            show: true,
            title: "Save Image"
          }
          }
        },
        calculable: true,
        series: [{
          name: '<?php echo bulan($bulan) ?> <?php echo $tahun ?>',
          type: 'pie',
          radius: [25, 90],
          center: ['50%', 170],
          roseType: 'area',
          x: '50%',
          max: 40,
          sort: 'ascending',
          data: [
          <?php foreach ($pengeluaran_group as $keluar1): ?>
          {value: <?php echo $keluar1->total_kategori?>, name: '<?php echo $keluar1->nama_kategori?>' },
          <?php endforeach; ?>

          // {
          // value: 10,
          // name: 'rose1'
          // }, {
          // value: 5,
          // name: 'rose2'
          // }, {
          // value: 15,
          // name: 'rose3'
          // }, {
          // value: 25,
          // name: 'rose4'
          // }, {
          // value: 20,
          // name: 'rose5'
          // }, {
          // value: 35,
          // name: 'rose6'
          // }
          ]
        }]
        });

      } 

      //echart Pie Collapse
        
      if ($('#echart_pie_Pemasukkan_lain').length ){ 
        
        var echartPieCollapse = echarts.init(document.getElementById('echart_pie_Pemasukkan_lain'), theme);
        
        echartPieCollapse.setOption({
        tooltip: {
          trigger: 'item',
          formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
          x: 'center',
          y: 'bottom',
          data: [
          <?php foreach ($pemasukkan_lain_group as $group): ?>
          '<?php echo $group->nama_kategori?>',
          <?php endforeach; ?>
          ]
        },
        toolbox: {
          show: true,
          feature: {
          magicType: {
            show: true,
            type: ['pie', 'funnel']
          },
          restore: {
            show: true,
            title: "Restore"
          },
          saveAsImage: {
            show: true,
            title: "Save Image"
          }
          }
        },
        calculable: true,
        series: [{
          name: '<?php echo bulan($bulan) ?> <?php echo $tahun ?>',
          type: 'pie',
          radius: [25, 90],
          center: ['50%', 170],
          roseType: 'area',
          x: '50%',
          max: 40,
          sort: 'ascending',
          data: [
          <?php foreach ($pemasukkan_lain_group as $tes): ?>
          {value: <?php echo $tes->total_kategori?>, name: '<?php echo $tes->nama_kategori?>' },
          <?php endforeach; ?>

          // {
          // value: 10,
          // name: 'rose1'
          // }, {
          // value: 5,
          // name: 'rose2'
          // }, {
          // value: 15,
          // name: 'rose3'
          // }, {
          // value: 25,
          // name: 'rose4'
          // }, {
          // value: 20,
          // name: 'rose5'
          // }, {
          // value: 35,
          // name: 'rose6'
          // }
          ]
        }]
        });

      } 
        
        
        
       
     
    }




    </script>


    <!-- MODAL -->
    <?php $this->load->view("admin/_partials/modal.php") ?>

	
  </body>
</html>
