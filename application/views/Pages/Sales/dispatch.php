<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Faktur</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style type="text/css" media="all">
            body { color: #000; }

            .header-title p{
                font-size: 1em; 

            }

            .header-table-title td{
                font-size: 11px;
            }

            #container-footer p{
                font-size: 15px;
                margin: 0;
            }
            #wrapper { max-width: 1100px; margin: 0 auto;}
            .btn { border-radius: 0; margin-bottom: 5px;}

            .bootbox .modal-footer { border-top: 0; text-align: center; }

            h3 { margin: 5px 0; }

            .order_barcodes img { float: none !important; margin-top: 5px;}

            .center-store-name{
                text-align: center;
            }
            .center-store-name{
                text-align: left;
            }

            td.no-border.center-store-name {
                width: 260px;
            }   

            td.no-border.center-store-name.invoice-number {
                width: 200px;
            }

            #wrapper {
                max-width: 1100px;
                margin: 0 auto;
            }
            .table {
                width: 100%;
                max-width: 100%;
                margin-bottom: 20px;
            }
            .header-table{
                border-bottom: 1px solid ;
                border-top: 1px solid  !important;
            }
            .right{
                text-align: right;
            }
            .left{
                text-align: left;
            }
            .center{
                text-align: center;
            }

            td {
                font-size: 13px;
            }

            .total-table{
                border-top: 1px solid  !important;
            }
            .body-table{
                min-height: 50px;
                width: 100%;
            }
            .sign{
                padding-top: 70px !important;
            }
            .ttd p{
                display: inline;
            }
            .ttd_word{
                margin-right: 20%;
            }
            .ttd_word_titik{
                margin-right: 8%;
            }
            .ttd_word_supir{
                margin-right: 20%;
            }
            .ttd_word_supir_titik{
                margin-right: 8%;
            }
            .sign-border{
                padding-top: 25px !important;
            }
            .table{
                margin-bottom: 0px;
            }
            p{
                font-size: 13px;
            }
            h3{
                font-size: 20px;
            }
            h4{
                font-size: 24px;
            }
            .invoice-number p{
                margin-left: 28%;
            }
            .footer-table-inv td{
                font-size: 14px;
                line-height: 17px;
            }
            .header-row{
                font-size: 11px;
            }
            #container-footer{width:100%;}
            #left{float:left;width:25%;}
            #right{float:right;width:35%;}
            #center{margin:0 auto;width:35%;}

            hr.new2 {
              border-top: 1px dashed red;
          }

      </style>
  </head>

  <body>
    <div id="wrapper" style="padding:5px;">
        <div id="receiptData">
            <div class="no-print">
            </div>
            <div id="receipt-data">
                <div style="clear:both;"></div>
                <div class="row" style="height: 90px;">
                    <div class="col-md-2" style="text-align:center;">
                        <img src="<?php echo base_url(); ?>/assets/logo.png" style="width:80%;">
                    </div>

                    <div class="col-md-4">
                        <p style="text-align:left; font-size: 15px; line-height: 20px; margin-top:25px;">PGMTA <br />LT. 5 / Blok B No.7 - 10 <br />(021) 3003 6167 / 0813-1514-3814</p>
                    </div>

                    <div class="col-md-6">
                        <div class="row header-row">
                            <div class="col-md-12" style="font-size:13px; margin-top:25px;">Jakarta, 28-Aug-2025</div>
                        </div>
                        <div class="row header-row">
                            <div class="col-md-3" style="font-size:13px;">Tuan / Toko</div><div class="col-md-9" style="font-size:13px;">: Da Hen</div>
                            <div class="col-md-3" style="font-size:13px;">Alamat</div><div class="col-md-9" style="font-size:13px;">: Jl. Prof Dr. Hamka Ds.Timur Kec. Mandau Kab. Bengkalis Riau</div>
                        </div>

                    </div>
                </div>

            </div>

            <hr class="new1">

            <div class="row">
                <div class="col-md-3"><h2 style="font-size:18px;">SURAT JALAN</h2></div>
                <div class="col-md-3">No. <h2 style="font-size:18px; display: inline; text-decoration-line: underline;text-decoration-style: dotted;">04935</h2></div>
                <div class="col-md-3">Expedisi, <h2 style="font-size:18px; display: inline; text-decoration-line: underline;text-decoration-style: dotted;">Baraka</h2></div>
                <div class="col-md-3">Via, </div>
            </div>
            
            <table width="100%" class="header-table-title" style="border-top:1px #000 solid; border-collapse: collapse; width: 100%; margin-top: 5px;">
                    <tr>
                        <td style="border: 1px #000 solid;"><h2 style="font-size:18px; text-align:center;padding-top: 5px;">KETERANGAN</h2></td>
                    </tr>
                    <tr style="height:5px;">
                        <td style="border: 1px #000 solid; height:150px;"><h2 style="font-size:18px; text-align:center;padding-top: 5px;">1. 55 ( 1 BALL)</h2></td>
                    </tr>
            </table>

            <div class="row" style="padding-top: 10px;">
                <p style="margin-bottom: 18px; font-weight: 700;"> BARANG YANG DITERIMA DALAM KEADAAN BAIK DAN CUKUP OLEH: </p>
                <p style="margin-bottom: 15px; margin-top:-15px;"> (Yang bertanda tangan dan cap (stempel) toko/perusahaan) </p>
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-4" style="font-size:12px; text-align: center;">
                            <p>Penerima / Pembeli</p>

                            <p style="margin-top:50px; text-align: center;">...................................</p>
                        </div>
                        <div class="col-md-4" style="font-size:12px; text-align: center;">
                            <p>Bagian Pengiriman</p>

                            <p style="margin-top:50px; text-align: center;">...................................</p>
                        </div>
                        <div class="col-md-4" style="font-size:12px; text-align: center;">
                            <p>Petugas Gudang / Toko</p>

                            <p style="margin-top:50px; text-align: center;">...................................</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="clear:both;"></div>
    </div>
</body>
</html>

