@extends('app')
@section('content')
    <h1 class="text-3xl font-bold">Create Patient</h1>
    <form class="flex flex-col gap-2 mt-10" method="POST" action="{{ route('patient.store') }}">
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
            <label for="idpatient">ID Patient</label>
            <input required type="text" id="idpatient" name="idpatient" readonly
                class="border border-black rounded px-2 read-only:bg-gray-200" value="{{ $generateId }}">
            @error('idpatient')
                <p class="text-red-400 font-bold">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-col w-56">
            <label for="namepatient">Name</label>
            <input required type="text" id="namepatient" name="namepatient" class="border border-black rounded px-2"
                value="{{ old('namepatient') }}">
            @error('namepatient')
                <p class="text-red-400 font-bold">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-col w-56">
            <label for="phonepatient">Phone</label>
            <input onkeypress="return onlyNumbers(event)" type="text" id="phonepatient" name="phonepatient"
                class="border border-black rounded px-2" required value="{{ old('phonepatient') }}">
            @error('phonepatient')
                <p class="text-red-400 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-2">
            <button class="py-2 px-3 text-white rounded-lg font-semibold bg-blue-500 w-fit  mt-10 mb-5">Add
                Patient
            </button>
            <a href="{{ route('patient.index') }}"
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
