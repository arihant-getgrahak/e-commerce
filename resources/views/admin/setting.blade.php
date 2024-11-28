@extends('layout.index')

@section('setting')

<form action="{{route("admin.shiprocket.update")}}" method="post">
    @csrf

    <div class="mb-3">
        <label class="form-label required">Shiprocket Username</label>
        <input type="text" class="form-control" id="username" name="username" value="{{$data['username']}}">
    </div>

    <div class="mb-3">
        <label class="form-label required">Shiprocket Password</label>
        <input type="password" class="form-control" id="password" name="password" value="{{$data['password']}}">
    </div>

    <div class="mb-3">
        <label class="form-label required">Shiprocket ChannelId</label>
        <input type="text" class="form-control" id="channelId" name="channelId" value="{{$data['channelId']}}">
    </div>
    <button type="submit" class="btn btn-primary ms-auto">Update Credentials</button>
</form>

<script>
    if ("{{session('success')}}") {
        alert("{{session('success')}}");
    }
    if ("{{session('error')}}") {
        alert("{{session('error')}}");
    }
</script>
@endsection