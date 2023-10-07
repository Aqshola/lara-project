@extends('components.layout')
@section('content')
    <h1 class="text-3xl font-bold">Patient</h1>
    <a href="{{ route('patient.create') }}"
        class="py-2 px-3 text-white rounded-lg font-semibold bg-blue-500 w-fit  mt-10 mb-5">Add patient</a>
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
                <th class="text-left">ID Patient</th>
                <th class="text-left">Name</th>
                <th class="text-left">Phone</th>
                <th class="text-left">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white ">
            @foreach ($listPatient as $patient)
                <tr>
                    <td class="border-b border-slate-100 py-4  ">
                        {{ $loop->index + 1 }}</td>
                    <td class="border-b border-slate-100 py-4   ">
                        {{ $patient->patient_id }}</td>
                    <td class="border-b border-slate-100 py-4   ">
                        {{ $patient->name }}</td>
                    <td class="border-b border-slate-100 py-4   ">
                        {{ $patient->phone }}</td>
                    <td class="border-b border-slate-100 py-4">
                        <div class="flex gap-1">
                            {{-- UPDATE --}}
                            <a href="{{ route('patient.edit', $patient->patient_id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>

                            </a>
                            {{-- DELETE --}}
                            <form method="POST" action="{{ route('patient.destroy', $patient->patient_id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </form>
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
            const timeout = setTimeout(() => {
                alertElemen.style.display = 'none'
            }, 3000);
        }
    </script>
@endsection
