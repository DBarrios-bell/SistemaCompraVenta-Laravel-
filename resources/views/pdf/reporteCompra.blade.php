<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Ventas</title>
    <link rel="stylesheet" href="{{ public_path('css/custom_pdf.css') }}">
    <link rel="stylesheet" href="{{ public_path('css/custom_page.css') }}">
</head>

<body>
    <section class="header" style="top: -287px">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td colspan="2" class="text-center">
                    <span style="font-size: 25px; font-weight: bold">Sistema de Ventas</span>
                </td>
            </tr>
            <tr>
                <td width="30%" style="vertical-align: top; padding-top: 10px; position: relative">
                    <img src="{{ public_path('assets/img/add1.png') }}" alt="" class="invoice-logo">
                </td>
                <td width="70%" class="text-left text-company" style="vertical-align: top; padding-top: 10px">
                    @if ($reportType == 0)
                        <span style="font-size: 16px"><strong>Reporte de ventas del dia</strong></span>
                    @else
                        <span style="font-size: 16px"><strong>Reporte de ventas por Fechas</strong></span>
                    @endif
                    <br>
                    @if ($reportType != 0)
                        <span style="font-size: 16px"><strong>Fecha de Consulta: {{ $dateFrom }} al
                                {{ $dateTo }}</strong></span>
                    @else
                        <span style="font-size: 16px"><strong>Fecha de Consulta:
                                {{ \Carbon\Carbon::now()->format('d-M-Y') }}</strong></span>
                    @endif
                    <br>
                    <span style="font-size: 14px">Usuario: {{ $user }}</span>
                </td>
            </tr>
        </table>
    </section>

    <section style="margin-top: -110px">
        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <thead>
                <tr>
                    <th width="10%">FOLIO</th>
                    <th width="12%">IMPORTE</th>
                    <th width="10%">ITEMS</th>
                    <th width="12%">ESTATUS</th>
                    <th>USUARIO</th>
                    <th width="18%">FECHA</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($info as $in)
                    <tr>
                        <td align="center">{{ $in->id }}</td>
                        <td align="center">${{ number_format($in->total, 2) }}</td>
                        <td align="center">{{ $in->items }}</td>
                        <td align="center">{{ $in->status }}</td>
                        <td align="center">{{ $in->user }}</td>
                        <td align="center">{{ $in->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-center">
                        <span><b>TOTALES:</b></span>
                    </td>
                    <td colspan="1" class="text-center">
                        <span><strong>${{ number_format($info->sum('total'), 2) }}</strong></span>
                    </td>
                    <td class="text-center">
                        {{ $info->sum('items') }}
                    </td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
        </table>
    </section>

    <section class="footer">
        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <tr>
                <td width="20%">
                    <span>Sistemas LWPOS V2022.1</span>
                </td>
                <td width="60%" class="text-center">
                    MiPagina.com
                </td>
                <td class="text-center" width="20%">
                    Página <span class="pagenum"></span>
                </td>
            </tr>
        </table>
    </section>
</body>

</html>
