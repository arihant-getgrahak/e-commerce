@extends('layout.index')

@section('setting')
<main class="space-y-6">
    <h1>Admin Tax Settings</h1>
    @php
        echo $tax;
    @endphp

    <div>
        <h2 class="text-3xl font-bold mb-4">Add Tax</h2>
        <form class="bg-white p-6 rounded-lg shadow-lg" action="{{ route('admin.setting.tax.update') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label required">Tax Value (in %)</label>
                <input type="text" class="form-control" id="value" name="value" value="{{old('value')}}"
                    placeholder="Enter Tax Value" required>
                @error('value')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label required">Tax Type</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="inclusive"> Inclusive</option>
                    <option value="exclusive"> Exclusive</option>
                </select>
                @error('type')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary ms-auto">
                Add Tax
            </button>
        </form>
    </div>
</main>
@endsection