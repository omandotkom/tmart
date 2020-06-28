<html>

<head>
<title>Invoice</title>    
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        #invoice {
            padding: 30px;
        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #3989c6
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #3989c6
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }

        .invoice table td,
        .invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #3989c6;
            font-size: 1.2em
        }

        .invoice table .qty,
        .invoice table .total,
        .invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #3989c6
        }

        .invoice table .unit {
            background: #ddd
        }

        .invoice table .total {
            background: #3989c6;
            color: #fff
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .invoice table tfoot tr:last-child td {
            color: #3989c6;
            font-size: 1.4em;
            border-top: 1px solid #3989c6
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }

        @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

            .invoice>div:last-child {
                page-break-before: always
            }
        }
    </style>
    <script>
        $(document).ready(function() {
            $("#printInvoice").click(function() {
                Popup($('.invoice')[0].outerHTML);

                function Popup(data) {
                    document.body.outerHTML = data;
                    window.print();
                    return true;
                }
            });
            
        });
    </script>
</head>

<body>
    <div id="invoice">

        <div class="toolbar hidden-print">
            <div class="text-right">
                <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
        
            </div>
            <hr>
        </div>
        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <header>
                    <div class="row">
                        <div class="col">
                            <a target="_blank" href="https://lobianijs.com">
                                <img src="{{url('/images/logotoko.jpg')}}" data-holder-rendered="true" />
                            </a>
                        </div>
                        <div class="col company-details">
                            <h2 class="name">
                                <a target="_blank" href="https://lobianijs.com">
                                    T-MART
                                </a>
                            </h2>
                            <div>Jl. DI Panjaitan No.128,<br>Karangreja, Purwokerto Kidul,<br> Kec. Purwokerto Sel., Kabupaten Banyumas,<br> Jawa Tengah 53147</div>
                            <div>(0281) 641629</div>
                            <div>admin@tmartlocalhost.com</div>
                        </div>
                    </div>
                </header>
                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="text-gray-light">INVOICE TO: ({{Auth::user()->name}})</div>
                            <h2 class="to">{{$request->name}}</h2>
                            <div class="address">{{$request->address}},<br> {{$request->city}},<br> {{$request->province}}<br>({{$request->postalcode}})</div>
                            <div class="email">Tel : {{$request->phone}}</div>
                        </div>
                        <div class="col invoice-details">
                            <h1 class="invoice-id">INVOICE</h1>
                            <div class="date">Date of Invoice: @php echo date('D (d-M-Y)'); @endphp</div>

                        </div>
                    </div>
                    <div id="elementH"></div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">Item</th>
                                <th class="text-right">Price</th>
                                <th class="text-right">Quantity</th>
                                <th class="text-right">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $num = 1;
                            @endphp
                            @foreach($items as $item)
                            <tr>
                                <td class="no">{{$num}}</td>
                                <td class="text-left">
                                    <h3>{{$item->product->name}}</h3> Product ID : ({{$item->product->id}})
                                </td>
                                <td class="unit">{{$item->product->price}}</td>
                                <td class="qty">{{$item->product_quantity}}</td>
                                <td class="total">@php echo $item->product->price * $item->product_quantity; @endphp</td>
                            </tr>
                            @php $num++; @endphp
                            @endforeach
                            <tr>

                                @php
                                $delivery = $request->courier;
                                $delivery = explode(",", $delivery);

                                @endphp
                                <td class="no">{{$num}}</td>
                                <td class="text-left">
                                    <h3>Ongkos Kirim</h3> {{$delivery[0]}} {{$delivery[1]}}
                                </td>
                                <td class="unit">-</td>
                                <td class="qty">-</td>
                                <td class="total">{{$delivery[2]}}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">TOTAL</td>
                                <td>{{$request->grandtotal}}</td>
                            </tr>

                        </tfoot>
                    </table>
                    <div class="notices">
                        <div>NOTICE:</div>
                        <div class="notice">Invoice ini ditujukan untuk {{Auth::user()->name}}</div>
                    </div>
                </main>
                <footer>
                    Invoice was created on a computer and is valid without the signature and seal.
                </footer>
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
        </div>
    </div>
</body>

</html>