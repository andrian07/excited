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
                            <img src="<?php echo base_url(); ?>/assets/logo.png" style="width:70%;">
                        </div>

                        <div class="col-md-4">
                            <p style="text-align:left; font-size: 15px; line-height: 20px; margin-top:15px;">PGMTA <br />LT. 5 / Blok B No.7 - 10 <br />(021) 3003 6167 / 0813-1514-3814</p>
                        </div>
                        <div class="col-md-6" style="margin-top: 10px;">
                            
                            <div class="row header-row">
                                <div class="col-md-2">No.Invoice</div><div class="col-md-8">: <b>J/ADR001/09/09/2025/000001</b></div>
                            </div>
                            <div class="row header-row">
                                <div class="col-md-2">Tanggal</div><div class="col-md-8">: Jakarta, 28-Aug-2025</div>
                            </div>
                            
                            <div class="row header-row">
                                <div class="col-md-2">Tuan/Toko</div><div class="col-md-8">: Budi</div>
                            </div>
                            <div class="row header-row">
                                <div class="col-md-2">No HP</div><div class="col-md-8">: 085454245454</div>
                            </div>
                            <div class="row header-row">
                                <div class="col-md-2">Alamat</div><div class="col-md-8">: Jl. Prof Dr. Hamka Ds.Timur Kec. Mandau Kab. Bengkalis Riau</div>
                            </div>
                        </div>
                    </div>

                </div>




            </div>

            <table width="100%" class="header-table-title" style="border-top:1px #000 solid; border-collapse: collapse; width: 100%; margin-top: 20px;">
                <tbody style="min-height: 250px;display: block;">
                    <tr>

                        <td width="5%" style="border-bottom: 1px #000 solid;">No</td>
                        <td width="10%" style="border-bottom: 1px #000 solid;">Qty</td>
                        <td width="51%" style="border-bottom: 1px #000 solid;">Nama Produk</td>
                        <td width="15%" style="border-bottom: 1px #000 solid; text-align: center;">Harga</td>
                        <td width="50%" style="border-bottom: 1px #000 solid; text-align: center;">Jumlah</td>
                        <td width="1%"></td>
                    </tr>
                    <tr style="height:5px;">
                        <td class="no-border">1</td>
                        <td class="no-border">10</td>
                        <td class="no-border">Pe.M Rame 5</td>
                        <td class="no-border" style="text-align: center">Rp. 165.000</td>
                        <td class="no-border"  style="text-align: center">Rp. 1.650.000</td>
                    </tr>

                    <tr style="height:5px;">
                        <td class="no-border">2</td>
                        <td class="no-border">15</td>
                        <td class="no-border">L embos 5</td>
                        <td class="no-border" style="text-align: center">Rp. 190.000</td>
                        <td class="no-border"  style="text-align: center">Rp. 2.850.000</td>
                    </tr>

                    <tr style="height:5px;">
                        <td class="no-border">3</td>
                        <td class="no-border">20</td>
                        <td class="no-border">XL embos 5, rame 5</td>
                        <td class="no-border" style="text-align: center">Rp. 210.000</td>
                        <td class="no-border"  style="text-align: center">Rp. 4.200.000</td>
                    </tr>

                    <tr style="height:5px;">
                        <td class="no-border">3</td>
                        <td class="no-border">10</td>
                        <td class="no-border">XXL Simple</td>
                        <td class="no-border" style="text-align: center">Rp. 225.000</td>
                        <td class="no-border"  style="text-align: center">Rp. 2.250.000</td>
                    </tr>
                </tbody>
            </table>

            <div class="row" style="border-top:2px double #000;">
                <p style="margin-bottom: 55px;"> Tolong Sertakan Nama Dan Bukti Transfer </p>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4" style="font-size:12px;">
                            No Rek:  <br />
                            BCA 6920-886-688 <br />
                            a/n. Novilia
                        </div>
                        <div class="col-md-4" style="font-size:12px;">
                            No Rek:  <br />
                            Mandiri 121-003-886688-9 <br />
                            a/n. Novilia
                        </div>
                        <div class="col-md-4" style="font-size:12px;">
                            No Rek:  <br />
                            BRI 0338-01-131190-567 <br />
                            a/n. Novilia
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <table width="100%" class="footer-table-inv" style="margin-top:-50px;">
                        <tr>
                            <td style="text-align:right; font-weight: 600;">Total</td>
                            <td>:</td>
                            <td style="text-align:center;">Rp. 170.000</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div style="clear:both;"></div>
    </div>
</body>
</html>

