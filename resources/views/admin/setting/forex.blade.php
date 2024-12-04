@extends('layout.index')

@section('setting')
<main>
    <h1>Admin Forex Settings</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-currency">
        Add Currency
    </button>

    <!-- All Currencies Table -->
    <div class="card mt-3">
        <div class="card-body">
            <h1>All Currencies</h1>
            <div id="table-default" class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><button class="table-sort">Id</button></th>
                            <th><button class="table-sort">Currency Name</button></th>
                            <th><button class="table-sort">Currency Symbol</button></th>
                            <th><button class="table-sort">Currency Code</button></th>
                            <th><button class="table-sort">Currency Exchange Rate (1 INR = ?)</button></th>
                            <th><button class="table-sort">Currency Status</button></th>
                            <th><button class="table-sort">Action</button></th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        {{--@foreach ($store as $s)
                        <tr>
                            <td>{{$s->id}}</td>
                            <td>{{$s->name}}</td>
                            <td>{{$s->address}}, {{$s->city}}, {{$s->state}}, {{$s->pincode}}</td>
                            <td>{{$s->phone}}</td>
                            <td>{{$s->gst}}</td>
                            <td>{{Str::ucfirst($s->tax_type)}}</td>
                            <td>
                                <button class="btn btn-primary btn-sm btn-update" data-bs-toggle="modal"
                                    data-bs-target="#modal-tax-update" data-id="{{ $s->id }}" data-name="{{ $s->name }}"
                                    data-address="{{ $s->address }}" data-phone="{{ $s->phone }}"
                                    data-country="{{ $s->country }}" data-gst="{{ $s->gst }}" data-city="{{ $s->city }}"
                                    data-state="{{ $s->state }}" data-pincode="{{ $s->pincode }}"
                                    data-type="{{ $s->tax_type }}">Edit</button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modal-delete-{{$s->id}}">Delete</button>
                            </td>
                        </tr>

                        <!-- Delete Modal -->
                        <div class="modal modal-blur fade" id="modal-delete-{{$s->id}}" tabindex="-1" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                    <div class="modal-status bg-danger"></div>
                                    <div class="modal-body text-center py-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                                            <path d="M12 9v4" />
                                            <path d="M12 17h.01" />
                                        </svg>
                                        <h3>Are you sure?</h3>
                                        <div class="text-secondary">Do you really want to delete this Store? This
                                            action cannot be undone.</div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="w-100">
                                            <div class="row">
                                                <div class="col"><a href="#" class="btn w-100"
                                                        data-bs-dismiss="modal">Cancel</a></div>
                                                <div class="col">
                                                    <form id="delete-form-{{$s->id}}"
                                                        action="{{ route('admin.setting.store.delete', $s->id) }}"
                                                        method="POST" class="w-100">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger w-100">Delete
                                                            Store</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Currency Modal -->
    <div class="modal modal-blur fade" id="modal-currency" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Currency</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="bg-white p-6 rounded-lg shadow-lg" action="{{ route('admin.setting.store.create') }}"
                        method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label required">Currency Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}"
                                placeholder="Enter Currency Name" required>
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Currency Symbol</label>
                            <input type="text" class="form-control" id="symbol" name="symbol" value="{{old('symbol')}}"
                                placeholder="Enter Currency Symbol" required>
                            @error('symbol')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Currency Code</label>
                            <input type="text" class="form-control" id="code" name="code" value="{{old(key: 'code')}}"
                                placeholder="Enter Currency Code" required>
                            @error('code')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Currency Exchange Rate (1INR = ?)</label>
                            <input type="text" class="form-control" id="exchange" name="exchange"
                                value="{{old('exchange')}}" placeholder="Enter Currency Exchange Rate (1INR = ?)"
                                required>
                            @error('exchange')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Currency Status</label>
                            <label class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status" name="status" />
                            </label>
                            @error('status')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ms-auto">Add Currency</button>
                </div>
                </form>
            </div>
        </div>
</main>


<script>
    if ("{{Session::has('success')}}") {
        alert("{{Session::get('success')}}");
    }
    if ("{{Session::has('error')}}") {
        alert("{{Session::get('error')}}");
    }
</script>
@endsection