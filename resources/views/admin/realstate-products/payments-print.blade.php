<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Print ( {{ $realstate->opu_ip }} )</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
        }

        .container {
            width: 700px;
            padding: 20px;
        }

        .top-section {
            display: flex;
            margin-bottom: 30px;
        }

        .top-section .company-info {
            margin-inline-start: 10px;
        }

        .company-info {
            font-weight: bold;
            line-height: 1.4;
        }

        .name-div {
            border: 4px double #9d9d9d;
            display: inline-block;
            padding: 25px 15px 25px 10px;
        }

        .d-flex {
            display: flex;
        }

        .coupon-info>div {
            margin-bottom: 20px;
        }

        .coupon-info>div>span {
            width: 120px;
            display: inline-block;
            text-align: end;
        }

        .products {
            margin-top: 25px;
        }

        .products table th {
            background-color: #fcfbfb;
        }

        .products table th,
        .products table td {
            vertical-align: middle;
            text-align: center;
        }

        .products table .name-txt {
            font-size: 14px;
        }

        .coupon-num {
            width: 65px;
            text-align: end;
            border: none;
            font-weight: bold;
        }

        .year-input {
            width: 40px;
            text-align: start;
            border: none;
            color: red;
            font-weight: bold;
        }

        .coupon-type-select {
            border: none;
            font-weight: bold;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="top-section mt-5">
            <img src="{{ asset('assets/images/print-logo.jpg') }}" width="230px" height="120px" />
            <div class="company-info">
                <div>BOSNA U OČIMA GULFA DOO Sarajevo</div>
                <div>Butmirska cesta 18, 71210 Ilidža</div>
                <div>ID BROJ 4202429650000</div>
                <div>Žiro račun BBI Bank dd Sarajevo 1413065320219104</div>
                <div>Mob: 062/444-413, Tel: 033/943-551</div>
                <div>e-mail: bosna.uocimagulfa@gmail.com</div>
            </div>
        </div>
        <div class="d-flex" style="justify-content: space-between;">
            <div class="company-info name-div">
                <div>{{ $realstate->client->name }}</div>
                <div>OPU-IP: {{ $realstate->opu_ip }}</div>
                <div>KO. {{ $realstate->address }}</div>
                <div style="color: red"><input class="year-input" value="{{ $year }}">. GODINA</div>
            </div>
            <div class="coupon-info">
                <div>Ilidža, {{ date('d/m/Y') }}</div>
                <div class="d-flex" style="font-weight: bold; justify-content: space-between;">
                    <select class="coupon-type-select">
                        <option value="RAČUN BR:">RAČUN BR:</option>
                        <option value="PREDRAČUN BR:">PREDRAČUN BR:</option>
                        <option value="PONUDA BR:">PONUDA BR:</option>
                    </select>
                    <input class="coupon-num coupon-num1" value="3/1/1" />
                </div>
                {{-- <div class="d-flex" style="font-weight: bold; justify-content: space-between;">RAČUN BR: <input class="coupon-num coupon-num1" value="3/1/1" /></div> --}}
                {{-- <div style="font-weight: bold;">PREDRAČUN BR: <span>3/1/1</span></div> --}}
                {{-- <div style="font-weight: bold;">PONUDA BR: <span>3 /1/1</span></div> --}}
                <div class="d-flex" style="justify-content: space-between;">Datum isporuke:
                    <span>{{ $from_date }}</span>
                </div>
                <div class="d-flex" style="justify-content: space-between;">Datum valute:
                    <span>{{ $to_date }}</span>
                </div>
                {{-- <div>Vrijeme izdavanja: 18:36</div> --}}
            </div>
        </div>
        <div class="products">
            <table class="table table-bordered">
                <thead>
                    <th>R. br.</th>
                    <th style="width: 200px;">Naziv</th>
                    <th>Jed. mjere</th>
                    <th>Količina</th>
                    <th>Jed. cijena</th>
                    <th>Rabat %</th>
                    <th>Ukupno</th>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($products as $index => $prod)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="text-start name-txt">{{ $prod->name }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ decorate_numbers($prod->total) }}</td>
                        </tr>
                        @php
                            $total += decorate_numbers($prod->total);
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <td colspan="5"></td>
                    <td><b>Sveukupno:</b></td>
                    <td>{{ $total }}</td>
                </tfoot>
            </table>
        </div>
        <div class="row" style="font-size: 14px;">
            <div class="col-md-4">Način plaćanja: Gotovinski</div>
            <div class="col-md text-end">Bosna u Očima Gulfa d.o.o. Sarajevo nije u sistemu PDV-a.</div>
        </div>
        <div class="row mt-5">
            <div class="col-md">Poziv na broj: <input class="coupon-num coupon-num2" value="3/1/1" /></div>
            <div class="col-md-5">
                <div class="text-start"><b>Dokument izradio:</b></div>
                <div class="text-start mt-5">
                    M.P. _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _
                    <div style="font-size: 10px; margin-inline-start: 80px;">Potpis</div>
                </div>
            </div>
        </div>
        <div class="mt-5 mb-2" style="border-top: 1px dashed #8d8d8d; width: 100%; height: 1px; display: inline-block;">
        </div>
        <div class="text-center my-2">Općinski sud u Sarajevu</div>
    </div>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(function() {
            $('.coupon-num1').change(function(e) {
                $('.coupon-num2').val($(this).val());
            });
            $('.coupon-num2').change(function(e) {
                $('.coupon-num1').val($(this).val());
            });
        })
    </script>
</body>

</html>
