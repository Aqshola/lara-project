@extends('components.layout')
@section('content')
    <h1 class="text-3xl font-bold">Invoice</h1>
    <div class="flex gap-2">
        <a href="{{ route('invoice.create') }}"
            class="py-2 px-3 text-white rounded-lg font-semibold bg-blue-500 w-fit  mt-10 mb-5">Add
            Invoice
        </a>

    </div>
    @if (session('success'))
        <div class="bg-green-500 p-2 rounded mb-2 font-bold text-white" id="alert">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="mb">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="p-2 bg-red-200 rounded font-bold text-red-500">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <table class="border-collapse table-auto w-full text-sm">
        <thead>
            <tr>
                <th class="text-left">No</th>
                <th class="text-left">No Invoice</th>
                <th class="text-left">Tanggal</th>
                <th class="text-left">Jumlah Barang</th>
                <th class="text-left">Total Harga</th>
                <th class="text-left">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white ">
            @foreach ($listInvoice as $invoice)
                <tr>
                    <td class="border-b border-slate-100 py-4">
                        {{ $loop->index + 1 }}</td>
                    <td class="border-b border-slate-100 py-4">
                        {{ $invoice->invoice_id }}</td>
                    <td class="border-b border-slate-100 py-4   ">
                        {{ $invoice->invoice_date }}</td>
                    <td class="border-b border-slate-100 py-4   ">
                        {{ $invoice->total_buy }}</td>
                    <td class="border-b border-slate-100 py-4   ">
                        Rp {{ number_format($invoice->total_price, 2) }}</td>
                    <td class="border-b border-slate-100 py-4">
                        <div class="flex gap-1">
                            {{-- DETAIL --}}
                            <a href="{{ route('invoice.print', $invoice->invoice_id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
@endsection
@section('scripts')
    <script>
        const alertElemen = document.querySelector("#alert")
        if (alertElemen) {
            console.log(alertElemen)
            const timeout = setTimeout(() => {
                alertElemen.style.display = 'none'
            }, 3000);
        }
    </script>
@endsection
