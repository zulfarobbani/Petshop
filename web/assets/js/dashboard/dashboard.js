var optionsPenjualanProduk = {
    series: [{
        data: [300, 400, 200, 250, 450, 400]
    }],
    chart: {
        type: 'bar',
        background: 'white',
        height : 250,
        events: {
            click: function (chart, w, e) {
                // console.log(chart, w, e)
            }
        }
    },
    title: {
        text: "Penjualan Berdasar Produk",
        align: "center"
    },
    // colors: colors,
    plotOptions: {
        bar: {
            columnWidth: '40%',
            distributed: true,
        }
    },
    dataLabels: {
        enabled: false
    },
    legend: {
        show: false
    },
    xaxis: {
        categories: [
            ['Produk', 'A'],
            ['Produk', 'B'],
            ['Produk', 'C'],
            ['Produk', 'D'],
            ['Produk', 'E'],
            ['Produk', 'F'],
        ],
    }
};


var optionsOmset = {
    series: [{
        name: 'series1',
        data: [400, 700, 750, 480, 900, 800, 1100, 1300, 1200]
    }],
    chart: {
        type: 'area',
        height : 250,
        toolbar: {
            show: false,
        },
        background: 'white',
    },
    colors: ['#ffd694'],
    stroke: {
        curve: "straight"
    },
    title: {
        text: ["Rp 2. 000. 000", "Omset saat ini"],
        align: "left"
    },
    grid: {
        show: false,
    },
    dataLabels: {
        enabled: false
    },
    xaxis: {
        type: 'datetime',
        categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z", "2018-09-19T07:30:00.000Z", "2018-09-19T08:30:00.000Z"],
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        },
        labels: {
            show: false,
        }
    },
    yaxis: {
        labels: {
            show: false,
        },
    },
    tooltip: {
        x: {
            format: 'dd/MM/yy HH:mm'
        },
    },
};

var optionsKuantiti = {
    series: [65, 23, 12],
    chart: {
        type: 'pie',
        height : 247,
        background : 'white'
    },
    title : {
        text: ['Pembelian', 'berdasarkan kuantiti'],
        align : 'left'
    },
    labels: ['Kg', 'Karung', 'Buah'],
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                position: 'bottom'
            }
        }
    }]
};

var chartPenjualanProduk = new ApexCharts(document.querySelector("#penjualan_produk"), optionsPenjualanProduk);
var chartOmset = new ApexCharts(document.querySelector("#omset"), optionsOmset);
var chartKuantiti = new ApexCharts(document.querySelector("#kuantiti_pembelian"), optionsKuantiti);

chartPenjualanProduk.render();
chartOmset.render();
chartKuantiti.render();