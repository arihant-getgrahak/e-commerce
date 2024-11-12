@extends('layout.index')
@section('bulk')
<main class="space-y-6">

    <div>
        <h2 class="text-3xl font-bold mb-4">Upload file</h2>
        <form class="bg-white p-6 rounded-lg shadow-lg" action="{{ route('admin.bulk.import') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="file" class="form-control" id="file" name="file" placeholder="Upload file" accept=".csv">
                @error("file")
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary ms-auto">
                Upload CSV
            </button>
        </form>
    </div>
</main>
@endsection