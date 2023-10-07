<style>
    #tbl1 {
        border-collapse: separate;
    }
</style>

<h1>Invoice Simple Product</h1>

<div>
    <table id="tbl1" cellspacing='0' style="float: left">
        <tr>
            <td>No Invoice</td>
            <td>:</td>
            <td>{{ $data->invoice_id }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ $data->invoice_date }}</td>
        </tr>
    </table>

    <table id="tbl2" cellspacing='0' style="float: right">
        <tr>
            <td>ID Pasien</td>
            <td>:</td>
            <td>{{ $data->detailPatient->patient_id }}</td>
        </tr>
        <tr>
            <td>Nama Pasien</td>
            <td>:</td>
            <td>{{ $data->detailPatient->name }}</td>
        </tr>
    </table>
</div>

<div>
    <table style="margin-top:100px;width:100%;" cellspacing='0' border="1">
        <thead>
            <tr>
                <th>Item yang dibeli</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->detailInvoice as $item)
                <tr>
                    <td style="text-align: center">
                        {{ $item->detailProduct->name }}
                    </td>
                    <td style="text-align: center">
                        {{ number_format($item->detailProduct->price, 2) }}
                    </td>
                    <td style="text-align: center">
                        {{ $item->buy_amount }}
                    </td>
                    <td style="text-align: center">
                        {{ number_format($item->price_amount, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"></td>
                <td style="text-align: center">Total</td>
                <td style="text-align: center">{{ number_format($data->total_price, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</div>
