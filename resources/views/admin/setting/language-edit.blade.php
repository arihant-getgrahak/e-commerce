@extends('layout.index')
@section('setting')

<h1>{{$lang->name}} Language Translation</h1>

<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-translation">
    Add Translation
</button>

<table class="table mt-3">
    <thead>
        <tr>
            <th><button class="table-sort">Key</button></th>
            <th><button class="table-sort">Value</button></th>
            <th><button class="table-sort">Action</button></th>
        </tr>
    </thead>
    <tbody class="table-tbody">
        @foreach ($content as $key => $value)
            <form action="{{route("admin.setting.language.edit")}}" method="POST">
                @csrf
                <input type="hidden" name="lang_code" value="{{$lang->code}}">
                <tr>
                    <td>
                        <input type="text" class="form-control" name="key" id="key" value="{{ $key }}">
                    </td>
                    <td>
                        <input type="text" class="form-control" name="value" id="value" value="{{ $value }}">
                    </td>
                    <td>
                        <button class="btn btn-primary btn-update" type="submit" data-key="{{ $key }}">Update</button>
                    </td>
                </tr>
            </form>
        @endforeach
    </tbody>
</table>

<div class="modal modal-blur fade" id="modal-translation" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Translation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <input type="hidden" name="lang_code" value="{{$lang->code}}">
                    <div class="mb-3">
                        <label class="form-label required">Translation Key</label>
                        <input type="text" class="form-control" name="key" id="key" value="{{ old('key') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Translation Value</label>
                        <input type="text" class="form-control" name="value" id="value" value="{{ old('value') }}">
                    </div>

                    <button class="btn btn-primary" type="submit">Add New Translation</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    if ("{{Session::has('success')}}") {
        alert("{{Session::get('success')}}");
    }

    if ("{{Session::has('error')}}") {
        alert("{{Session::get('error')}}");
    }
</script>
@endsection