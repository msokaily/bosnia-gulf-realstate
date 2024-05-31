<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Initial Payments Print ( {{ $realstate->opu_ip }} )</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Cairo, Arial, Helvetica, sans-serif;
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

        .products table tfoot td, .products table tfoot th {
            background-color: #fcfbfb;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="top-section mt-5" dir="ltr">
            <img src="{{ asset('assets/images/print-logo.jpg') }}" width="230px" height="120px" />
            <div class="company-info">
                <div>BOSNA U OČIMA GULFA DOO Sarajevo</div>
                <div>Butmirska cesta 18, 71210 Ilidža</div>
                <div>ID BROJ 4202429650000</div>
                <div>Žiro račun BBI Bank dd Sarajevo 1413065320219104</div>
                <div>Mob: 061/100-066, Tel: 033/943-551</div>
                <div>e-mail: bosna.uocimagulfa@gmail.com</div>
            </div>
        </div>
        <h2 style="text-align: center; font-weight: bold;" class="mb-3">تقرير دفعات بناء ما قبل البناء</h2>
        <div class="user-info">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>الإسم</th>
                        <td>{{$realstate->client->name}}</td>
                        <th>العقار</th>
                        <td>{{$realstate->opu_ip}}</td>
                    </tr>
                    <tr>
                        <th>عنوان العقار</th>
                        <td>{{$realstate->address}}</td>
                        <th>المساحة</th>
                        <td>{{$realstate->area}} م</td>
                    </tr>
                    <tr>
                        <th>سعر المتر</th>
                        <td><span dir="ltr">{{decorate_numbers($realstate->meter_price, 0)}}</span> مارك</td>
                        <th>التكلفة الكلية</th>
                        <td><span dir="ltr">{{decorate_numbers($realstate->initial_cost_total, 0)}}</span> مارك</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="products">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="4">الدفعات</th>
                    </tr>
                    <tr>
                        <th style="width: 70px;">الرقم</th>
                        <th>القيمة</th>
                        <th>سبب الدفع</th>
                        <th>ملاحظات</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                        $total_not_paid = 0;
                    @endphp
                    @foreach ($items as $index => $prod)
                        <tr>
                            <td style="{{!$prod->paid_at ? 'color: red;' : ''}}">{{ $index + 1 }}</td>
                            <td dir="ltr" style="{{!$prod->paid_at ? 'color: red;' : ''}}">{{ decorate_numbers($prod->amount, 0) }}</td>
                            <td style="text-align: start; {{!$prod->paid_at ? 'color: red;' : ''}}">{{ $prod->name }}</td>
                            <td>{{ $prod->note }}</td>
                        </tr>
                        @php
                        if ($prod->paid_at) {
                            $total += $prod->amount;
                        } else {
                            $total_not_paid += $prod->amount;
                        }
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"><b>المجموع</b></td>
                    </tr>
                    <tr>
                        <td colspan="2">مدفوع</td>
                        <td colspan="2"><b dir="ltr">{{ decorate_numbers($total, 0) }}</b> مارك بوسني</td>
                    </tr>
                        <td colspan="2">متبقي</td>
                        <td colspan="2"><b dir="ltr" style="color: red;">{{ decorate_numbers($total_not_paid, 0) }}</b> مارك بوسني</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
