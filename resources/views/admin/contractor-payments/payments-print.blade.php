<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Construction Payments Print ( {{ $realstate->opu_ip }} )</title>
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
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    @if (app()->getLocale() == 'ar')
        <a class="btn btn-dark no-print" style="position: absolute; top: 20px; left: 20px;" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">EN</a>
    @else
        <a class="btn btn-dark no-print" style="position: absolute; top: 20px; left: 20px;" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">AR</a>
    @endif
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
        <h2 style="text-align: center; font-weight: bold;" class="mb-3">{{__('common.contractor_report_title')}}</h2>
        <div class="user-info">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>{{__('common.name')}}</th>
                        <td>{{$realstate->client->name}}</td>
                        <th>{{__('common.realestate')}}</th>
                        <td>{{$realstate->opu_ip}}</td>
                    </tr>
                    <tr>
                        <th>{{__('common.address')}}</th>
                        <td>{{$realstate->address}}</td>
                        <th>{{__('common.area')}}</th>
                        <td>{{$realstate->area}} {{__('common.meter')}}</td>
                    </tr>
                    <tr>
                        <th>{{__('common.meter_price')}}</th>
                        <td><span dir="ltr">{{decorate_numbers($realstate->meter_price, 0)}}</span> {{__('common.bam')}}</td>
                        <th>{{__('common.total')}}</th>
                        <td><span dir="ltr">{{decorate_numbers($realstate->contractor_total, 0)}}</span> {{__('common.bam')}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="products">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="4">{{__('common.payments_')}}</th>
                    </tr>
                    <tr>
                        <th style="width: 70px;">{{__('common.number')}}</th>
                        <th>{{__('common.amount')}}</th>
                        <th>{{__('common.paid_at')}}</th>
                        <th>{{__('common.reason')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($items as $index => $prod)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td dir="ltr">{{ decorate_numbers($prod->amount, 0) }}</td>
                            <td dir="ltr">{{ $prod->paid_at->format('Y-m-d') }}</td>
                            <td>{{ $prod->reason }}</td>
                        </tr>
                        @php
                            $total += $prod->amount;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"><b>{{__('common.sum')}}</b></td>
                    </tr>
                    <tr>
                        <td colspan="2">{{__('common.paid')}}</td>
                        <td colspan="2"><b dir="ltr">{{ decorate_numbers($total, 0) }}</b> {{__('common.bih_mark')}}</td>
                    </tr>
                        <td colspan="2">{{__('common.remain')}}</td>
                        <td colspan="2"><b dir="ltr">{{ decorate_numbers($realstate->contractor_total - $total, 0) }}</b> {{__('common.bih_mark')}}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
