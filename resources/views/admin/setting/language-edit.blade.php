@extends('layout.index')
@section('setting')

<h1>{{$lang->name}} Language Translation Change</h1>
<table class="table">
    <thead>
        <tr>
            <th>
                Key
            </th>
            <th>
                Value
            </th>
            <th>
                Action
            </th>
        </tr>
    </thead>
    <tbody class="table-tbody">
        @foreach ($content as $key => $value)
            <form action="" method="GET">
                <tr>
                    <td>
                        <input type="text" name="key" id="key" value="{{ $key }}" disabled>
                    </td>
                    <td>
                        <input type="text" name="value" id="value" value="{{ $value }}">
                    </td>
                    <td>
                        <button class="btn btn-primary btn-update" type="submit" data-key="{{ $key }}">Update</button>
                    </td>
                </tr>
            </form>
        @endforeach
    </tbody>
</table>

<script>
    if ("{{Session::has('error')}}") {
        alert("{{Session::get('error')}}");
    }
</script>
@endsection