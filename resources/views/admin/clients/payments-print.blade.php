<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clients Payments Print</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Cairo, Arial, Helvetica, sans-serif;
            font-size: 16px;
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

        .products table th {
            background-color: #fcfbfb;
        }

        .products table th,
        .products table td {
            vertical-align: middle;
            text-align: center;
        }

        .products table .tfoot td, .products table .tfoot th {
            background-color: #fcfbfb;
        }

    </style>
</head>

<body>
    <div class="containera">
        <div class="products">
            <h2 class="text-center mb-3 mt-2"><b>تقرير جميع العملاء</b></h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 70px;">الرقم</th>
                        <th>الإسم</th>
                        <th>المساحة</th>
                        <th>العقار</th>
                        <th>المبلغ المحول للبناء</th>
                        <th>المبلغ الإجمالي للبناء مارك</th>
                        <th>متبقي بالمارك</th>
                        <th>نسبة الدفع %</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_amount_km = 0;
                        $total_paid_percentage = 0;
                    @endphp
                    @foreach ($items as $index => $prod)
                        @php
                            $amount_sum = $prod->construction_payments->whereNotNull('paid_at')->sum('amount');
                            $amount_km_sum = $prod->construction_payments->whereNotNull('paid_at')->sum('amount_km');
                            $paid_percentage = ($amount_km_sum / ($prod->construction_total > 0 ? $prod->construction_total : 1)) * 100;
                            $percentage_color = 'danger';
                            if ($paid_percentage > 50) $percentage_color = 'warning';
                            if ($paid_percentage >= 70) $percentage_color = 'info';
                            if ($paid_percentage >= 85) $percentage_color = 'dark';
                            if ($paid_percentage >= 100) $percentage_color = 'success';
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $prod->client->name }}</td>
                            <td>{{ $prod->opu_ip }}</td>
                            <td>{{ $prod->area }}</td>
                            <td><span dir="ltr">{{ decorate_numbers($amount_sum, 0) }}</span> {{$prod->client->currency}}</td>
                            <td dir="ltr">{{ decorate_numbers($prod->construction_total, 0) }}</td>
                            <td dir="ltr">{{ decorate_numbers($prod->construction_total - $amount_km_sum, 0) }}</td>
                            <td dir="ltr">
                                <div class="text-{{$percentage_color}}">
                                    {{ decorate_numbers($paid_percentage, 1) }}%
                                </div>
                            </td>
                        </tr>
                        @php
                            $total_amount_km += $amount_km_sum;
                            $total_paid_percentage += $paid_percentage;
                        @endphp
                    @endforeach
                </tbody>
                <tr class="tfoot">
                    <td colspan="4">المجموع</td>
                    <td><b dir="ltr">{{ decorate_numbers($items->sum('construction_total'), 0) }}</b> مارك</td>
                    <td><b dir="ltr">{{ decorate_numbers($total_amount_km, 0) }}</b> مارك</td>
                    <td><b dir="ltr">{{ decorate_numbers($total_paid_percentage / $items->count(), 1) }}%</b></td>
                </tr>
            </table>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
