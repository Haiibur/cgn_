<div class="row">
    <div class="col-8 col-md-8 mt-3">
        <div class="card">
            <div id="bar-chart" style="width:100%; height:300px;"></div>

        </div>
    </div>
    <div class="col-4 col-md-4 mt-3">
        <div class="card">
            <div id="doughnut-chart" style="width:100%; height:300px;"></div>

        </div>
    </div>
    <div class="col-12 col-md-12 mt-3">
        <div class="table-responsive">
            <table id="table" class="table table-striped" data-toggle="table" data-toolbar="#toolbar"
                data-show-refresh="true" data-auto-refresh="true" data-pagination="true" data-search="true"
                data-sort-order="desc" data-id-field="id" data-page-list="[10, 25, 50, 100, all]"
                data-url="<?=base_url('Grafik/load_grafik');?>">
                <thead>
                    <tr>
                        <th data-field="level_peserta" data-valign="top">Level Peserta</th>
                        <th data-field="status_peserta" data-valign="top">Kehadiran</th>
                        <th data-field="Jumlah_Data" data-valign="top">Jumlah Data</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="BSmodal" tabindex="-1" role="dialog" aria-labelledby="Modal FormData">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header backmodal">
                <h4 class="modal-title">

                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Level Admin</label>
                        <div class="col-sm-9">
                            <select class="select2 form-control" name="level" id="level">
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" id="username"
                                placeholder="Digunakan untuk Login">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan <span id="loading"></span></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Chart JS -->
<script src="<?= base_url(); ?>assets/dist/js/echarts-all.js"></script>
<script type="text/javascript">
var myChart = echarts.init(document.getElementById('bar-chart'));

// specify chart configuration item and data
option = {
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data: ['Konfirmasi Kehadiran']
    },
    toolbox: {
        show: true,
        feature: {
            magicType: {
                show: true,
                type: ['line', 'bar']
            },
            restore: {
                show: true
            },
            saveAsImage: {
                show: true
            }
        }
    },
    color: ["#55ce63"],
    calculable: true,
    xAxis: [{
        type: 'category',
        data: [
            <?php
            $status = json_decode($Status);
            foreach ($status as $s) {
                echo $s == 1 ? "'Belum Konfirmasi'," : "'Siap Hadir',";
            }
            ?>
        ]
    }],
    yAxis: [{
        type: 'value'
    }],
    series: [{
        name: 'Total',
        type: 'bar',
        data: JSON.parse('<?= $Jumlah ?>'),
        markPoint: {
            data: [{
                    type: 'max',
                    name: 'Jumlah'
                },
                {
                    type: 'min',
                    name: 'Jumlah'
                }
            ]
        },
    }]
};


// use configuration item and data specified to show chart
myChart.setOption(option, true), $(function() {
    function resize() {
        setTimeout(function() {
            myChart.resize()
        }, 100)
    }
    $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
});


// ============================================================== 
// doughnut chart option
// ============================================================== 
var doughnutChart = echarts.init(document.getElementById('doughnut-chart'));

// specify chart configuration item and data
option = {
    tooltip: {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient: 'vertical',
        x: 'left',
        data: JSON.parse('<?= $list_nama_level ?>')
    },
    toolbox: {
        show: true,
        feature: {
            dataView: {
                show: true,
                readOnly: false
            },
            magicType: {
                show: true,
                type: ['pie'],
                option: {
                    funnel: {
                        x: '25%',
                        width: '50%',
                        funnelAlign: 'center',
                        max: 1548
                    }
                }
            },
            restore: {
                show: true
            },
            saveAsImage: {
                show: true
            }
        }
    },
    color: ["#f62d51", "#009efb", "#55ce63"],
    calculable: true,
    series: [{
        name: 'Total',
        type: 'pie',
        radius: ['80%', '90%'],
        itemStyle: {
            normal: {
                label: {
                    show: false
                },
                labelLine: {
                    show: false
                }
            },
            emphasis: {
                label: {
                    show: true,
                    position: 'center',
                    textStyle: {
                        fontSize: '20',
                        fontWeight: 'bold'
                    }
                }
            }
        },
        data: [
            <?php
            $jumlah = json_decode($List_Jumlah);
            $nama = json_decode($list_nama_level);
            $label = json_decode($List_Status);
            for ($i = 0; $i < count($jumlah); $i++) {
                $label = $label[$i] == 1 ? 'Belum Konfirmasi' : 'Siap Hadir';
                echo "{ value: $jumlah[$i], name: '$nama[$i]' },";
            }
            ?>
        ]
    }]
};

// use configuration item and data specified to show chart
doughnutChart.setOption(option, true), $(function() {
    function resize() {
        setTimeout(function() {
            doughnutChart.resize()
        }, 100)
    }
    $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
});
</script>