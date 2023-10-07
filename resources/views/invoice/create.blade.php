@extends('components.layout')
@section('content')
    <h1 class="text-3xl font-bold">Create Invoice</h1>
    <form class="flex flex-col gap-2 mt-10" method="POST" action="{{ route('invoice.store') }}">
        @csrf
        @method('POST')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="p-2 bg-red-200 rounded font-bold text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="flex flex-col w-56">
            <label for="idinvoice">ID Product</label>
            <input required type="text" id="idinvoice" name="idinvoice" readonly
                class="border border-black rounded px-2 read-only:bg-gray-200" value="{{ $generateId }}">
            @error('nameproduct')
                <p class="text-red-400 font-bold">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-col w-56">
            <label for="patient">Patient</label>
            <select name="patient" id="patient" class="border border-black rounded p-1">
                @foreach ($listPatient as $patient)
                    <option value="{{ $patient->patient_id }}">{{ $patient->patient_id }}-{{ $patient->name }}</option>
                @endforeach
            </select>

            @error('patient')
                <p class="text-red-400 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-5">
            <button onclick="handleTable()" type="button" class="py-1 px-2 bg-blue-400 text-sm rounded text-white">Add
                cart</button>
            <table id="tbl" class="border-collapse table-auto w-1/2 text-sm mt-2">
                <thead>
                    <tr>
                        <th class="text-left">Product</th>
                        <th class="text-left">Buy</th>
                        <th class="text-left">Price</th>
                        <th class="text-left">Total Price</th>
                        <th class="text-left">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <td colspan='3'></td>
                        <td>Total</td>
                        <td><input type="text" readonly id="total_all" value="0"></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="flex gap-2">
            <button class="py-2 px-3 text-white rounded-lg font-semibold bg-blue-500 w-fit  mt-10 mb-5">Add
                Invoice
            </button>
            <a href="{{ route('invoice.index') }}"
                class="py-2 px-3 text-black rounded-lg font-semibold bg-white border w-fit  mt-10 mb-5">
                Cancel
            </a>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        const optionProduct = {!! json_encode($listProduct) !!}

        function handleTable() {
            const tbl = document.querySelector("#tbl tbody")
            const currRow = tbl.rows.length

            const newRow = tbl.insertRow()
            newRow.innerHTML = generateRow(currRow + 1)
        }

        function generateRow(counter) {
            return `
                <tr id='row_${counter}' class='border-b'>
                    <td class='border-b border-slate-100 py-4'>
                        <select required onchange='handleCart(${counter})' class="border border-black rounded p-2" id='product_${counter}' name='product[]'>
                               ${mapOptionProduct()}
                        </select>
                        <td class='border-b border-slate-100 py-4'>
                            <input required class="border border-black rounded  p-2"   onkeypress="return onlyNumbers(event)" value='1' id='buy_${counter}' onchange='handleCart(${counter})' name='buy[]'>
                        </td>
                        <td class='border-b border-slate-100 py-4'>
                            <input required class="border border-black rounded p-2"   onkeypress="return onlyNumbers(event)" id='price_${counter}' readonly onchange='handleCart(${counter})' >
                        </td>
                        <td class='border-b border-slate-100 py-4'>
                            <input required class="total border border-black rounded p-2"   onkeypress="return onlyNumbers(event)" id='total_${counter}' readonly onchange='handleCart(${counter})'>
                        </td>
                        <td class='border-b border-slate-100 py-4'>
                            <button type="button" onclick="handleDelete(this)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </td>
                    </td>
                </tr>
            `
        }

        function handleCart(id) {
            const productEl = document.querySelector(`#product_${id}`)
            const buyEl = document.querySelector(`#buy_${id}`)
            const totalEl = document.querySelector(`#total_${id}`)
            const priceEl = document.querySelector(`#price_${id}`)


            const buyAmount = buyEl.value || 0
            const priceAmount = productEl.options[productEl.selectedIndex].dataset.price || 0


            totalEl.value = buyAmount * priceAmount
            priceEl.value = priceAmount

            countTotal()




        }

        function mapOptionProduct() {
            let str = '<option disabled selected></option>';
            optionProduct.forEach((item) => {
                str += `
                    <option value='${item.product_id}' data-price='${item.price}'>${item.name}</option>
                `
            })

            return str
        }

        function handleDelete(el) {
            var i = el.parentNode.parentNode.rowIndex;
            document.querySelector("#tbl").deleteRow(i)
            countTotal()
        }

        function countTotal() {
            const tbl = document.querySelector("#tbl tbody")
            const currRow = document.querySelectorAll(".total")
            let local_total = 0

            for (let i = 0; i < currRow.length; i++) {
                const id = currRow[i].id
                const total = document.querySelector(`#${id}`).value
                local_total += Number(total)
            }

            document.querySelector("#total_all").value = local_total
        }

        const onlyNumbers = (event) => {
            return !isNaN(event.key);
        }
    </script>
@endsection
