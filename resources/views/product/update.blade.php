@extends('app')
@section('content')
    <h1 class="text-3xl font-bold">Create Product</h1>
    <form class="flex flex-col gap-2 mt-10" method="POST" action="{{ route('product.update', $data['product_id']) }}">
        @csrf
        @method('PUT')
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
            <label for="idproduct">ID Product</label>
            <input required type="text" id="idproduct" name="idproduct" readonly
                class="border border-black rounded px-2 read-only:bg-gray-200" disabled value="{{ $data['product_id'] }}">
            @error('nameproduct')
                <p class="text-red-400 font-bold">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-col w-56">
            <label for="nameproduct">Name Product</label>
            <input required type="text" id="nameproduct" name="nameproduct" class="border border-black rounded px-2"
                value="{{ $data['name'] }}">
            @error('nameproduct')
                <p class="text-red-400 font-bold">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-col w-56">
            <label for="stockproduct">Stock Product</label>
            <input onkeypress="return onlyNumbers(event)" type="text" id="stockproduct" name="stockproduct"
                class="border border-black rounded px-2" required value="{{ $data['stock'] }}">
            @error('stockproduct')
                <p class="text-red-400 font-bold">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-col w-56">
            <label for="Price">Price Product</label>
            <input type="text" onchange="return replaceOnlyNumber(event)" onkeypress="return onlyNumbers(event)"
                id="Price" name="priceproduct" class="border border-black rounded px-2" required
                value="{{ $data['price'] }}">
            @error('priceproduct')
                <p class="text-red-400 font-bold">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex gap-2">
            <button class="py-2 px-3 text-white rounded-lg font-semibold bg-blue-500 w-fit  mt-10 mb-5">Update
                Product
            </button>
            <a href={{ route('product.index') }}
                class="py-2 px-3 text-black rounded-lg font-semibold bg-white border w-fit  mt-10 mb-5">
                Cancel
            </a>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        const onlyNumbers = (event) => {
            return !isNaN(event.key);
        }

        const replaceOnlyNumber = () => {
            console.log()
        }
    </script>
@endsection
