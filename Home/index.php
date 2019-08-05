<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="author" content="ISC Lizeth Viviana Martínez Gómez">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Base para desarrollo de sistemas</title>
    <link rel="icon" type="image/png" href="../Libs/image/ICON.png" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Libs/css/bootstrap.min.css">
    <!-- CSS  propio-->
    <link rel="stylesheet" href="../Libs/css/style4.css">

    <!-- Font Awesome JS -->
    <script defer src="../Libs/fontAwesome/js/solid.js" ></script>
    <script defer src="../Libs/fontAwesome/js/fontawesome.js"></script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php 
          include '../Main/main.php';
        ?>

        <!-- Page Content  -->
        <div>
        <!--PARA INCORPORAR LA CABECERA DE IDENTIFICACIÓN DEL SISTEMA-->
            <?php 
            include '../Main/head.php'; ?>
        </div>
        <div id="content" style="margin-top: 10%; margin-left:0; width: 100%;">
           <div class="col-md-6">
                <h2>Visión general del mercado</h2>
                <p> Le permite echar un vistazo rápido a la última actividad del mercado en distintos sectores</p>
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <div class="tradingview-widget-copyright"><a href="https://es.tradingview.com" rel="noopener" target="_blank"><span class="blue-text">Datos del mercado</span></a> por TradingView</div>
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
  {
  "colorTheme": "dark",
  "showChart": true,
  "locale": "es",
  "largeChartUrl": "",
  "isTransparent": true,
  "width": "400",
  "height": "660",
  "plotLineColorGrowing": "rgba(12, 52, 61, 1)",
  "plotLineColorFalling": "rgba(91, 15, 0, 1)",
  "gridLineColor": "rgba(42, 46, 57, 1)",
  "scaleFontColor": "rgba(120, 123, 134, 1)",
  "belowLineFillColorGrowing": "rgba(208, 224, 227, 0.12)",
  "belowLineFillColorFalling": "rgba(230, 184, 175, 0.12)",
  "symbolActiveColor": "rgba(33, 150, 243, 0.12)",
  "tabs": [
    {
      "title": "Índices",
      "symbols": [
        {
          "s": "OANDA:SPX500USD",
          "d": "S&P 500"
        },
        {
          "s": "INDEX:XLY0",
          "d": "Shanghai Composite"
        },
        {
          "s": "FOREXCOM:DJI",
          "d": "Dow 30"
        },
        {
          "s": "INDEX:NKY",
          "d": "Nikkei 225"
        },
        {
          "s": "INDEX:DAX",
          "d": "DAX Index"
        },
        {
          "s": "OANDA:UK100GBP",
          "d": "FTSE 100"
        }
      ],
      "originalTitle": "Indices"
    },
    {
      "title": "Materias primas",
      "symbols": [
        {
          "s": "CME_MINI:ES1!",
          "d": "E-Mini S&P"
        },
        {
          "s": "CME:E61!",
          "d": "Euro"
        },
        {
          "s": "COMEX:GC1!",
          "d": "Gold"
        },
        {
          "s": "NYMEX:CL1!",
          "d": "Crude Oil"
        },
        {
          "s": "NYMEX:NG1!",
          "d": "Natural Gas"
        },
        {
          "s": "CBOT:ZC1!",
          "d": "Corn"
        }
      ],
      "originalTitle": "Commodities"
    },
    {
      "title": "Bonos",
      "symbols": [
        {
          "s": "CME:GE1!",
          "d": "Eurodollar"
        },
        {
          "s": "CBOT:ZB1!",
          "d": "T-Bond"
        },
        {
          "s": "CBOT:UD1!",
          "d": "Ultra T-Bond"
        },
        {
          "s": "EUREX:GG1!",
          "d": "Euro Bund"
        },
        {
          "s": "EUREX:II1!",
          "d": "Euro BTP"
        },
        {
          "s": "EUREX:HR1!",
          "d": "Euro BOBL"
        }
      ],
      "originalTitle": "Bonds"
    },
    {
      "title": "Forex",
      "symbols": [
        {
          "s": "FX:EURUSD"
        },
        {
          "s": "FX:GBPUSD"
        },
        {
          "s": "FX:USDJPY"
        },
        {
          "s": "FX:USDCHF"
        },
        {
          "s": "FX:AUDUSD"
        },
        {
          "s": "FX:USDCAD"
        }
      ],
      "originalTitle": "Forex"
    }
  ]
}
  </script>
</div>
<!-- TradingView Widget END -->
           </div>
           <div class="col-md-6">
               
           </div>
        </div>
    </div>
    <!-- jQuery-->
    <script src="../Libs/js/jquery-3.3.1.js"></script>
    <!-- Popper.JS -->
    <script src="../Libs/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../Libs/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../Libs/js/mainfunction.js"> </script>
    <script src="../Reportes/js/operaciones.js"></script>
</body>

</html>