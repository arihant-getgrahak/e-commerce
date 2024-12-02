@extends('layout.index')

@section('setting')
<main>
    <h1>Admin Store Settings</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-store">
        Add Store
    </button>

    <div class="card mt-3">
        <div class="card-body">
            <h1>All Stores</h1>
            <div id="table-default" class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><button class="table-sort">Id</button></th>
                            <th><button class="table-sort">Store Name</button></th>
                            <th><button class="table-sort">Store Address</button></th>
                            <th><button class="table-sort">Store Phone</button></th>
                            <th><button class="table-sort">Store GST</button></th>
                            <th><button class="table-sort">Store Tax Value</button></th>
                            <th><button class="table-sort">Store Tax Type</button></th>
                            <th><button class="table-sort">Action</button></th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach ($store as $s)
                            <tr>
                                <td>{{$s->id}}</td>
                                <td>{{$s->name}}</td>
                                <td>{{$s->address}}, {{$s->city}}, {{$s->state}}, {{$s->pincode}}</td>
                                <td>{{$s->phone}}</td>
                                <td>{{$s->gst}}</td>
                                <td>{{$s->tax_value}}%</td>
                                <td>{{Str::ucfirst($s->tax_type)}}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm btn-update" data-bs-toggle="modal"
                                        data-bs-target="#modal-tax-update" data-id="{{ $s->id }}" data-name="{{ $s->name }}"
                                        data-address="{{ $s->address }}" data-phone="{{ $s->phone }}"
                                        data-country="{{ $s->country }}" data-gst="{{ $s->gst }}" data-city="{{ $s->city }}"
                                        data-state="{{ $s->state }}" data-pincode="{{ $s->pincode }}"
                                        data-value="{{ $s->tax_value }}" data-type="{{ $s->tax_type }}">Edit</button>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal modal-blur fade" id="modal-tax-update" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="taxForm" class="bg-white p-6 rounded-lg shadow-lg" method="post" action="">
                        @method('PUT')
                        @csrf

                        <div class="mb-3">
                            <label class="form-label required">Store Name</label>
                            <input type="text" class="form-control" id="name_update" name="name"
                                value="{{old('value')}}" placeholder="Enter Store Nameq" required>
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Store Address</label>
                            <input type="text" class="form-control" id="address_update" name="address"
                                value="{{old('value')}}" placeholder="Enter Store Address" required>
                            @error('address')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Store City</label>
                            <input type="text" class="form-control" id="city_update" name="city"
                                value="{{old('value')}}" placeholder="Enter Store City" required>
                            @error('city')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Store State</label>
                            <input type="text" class="form-control" id="state_update" name="state"
                                value="{{old('value')}}" placeholder="Enter Store State" required>
                            @error('state')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Store Country</label>
                            <input type="text" class="form-control" id="country_update" name="country"
                                value="{{old('value')}}" placeholder="Enter Store Country" required>
                            @error('country')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Store Pincode</label>
                            <input type="text" class="form-control" id="pincode_update" name="pincode"
                                value="{{old('value')}}" placeholder="Enter Store pincode" required>
                            @error('pincode')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Store Phone Number</label>
                            <input type="text" class="form-control" id="phone_update" name="phone"
                                value="{{old('value')}}" placeholder="Enter Store phone number" required>
                            @error('phone')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Store GST</label>
                            <input type="text" class="form-control" id="gst_update" name="gst" value="{{old('value')}}"
                                placeholder="Enter Store gst number" required>
                            @error('gst')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Tax Value(%)</label>
                            <input type="text" class="form-control" id="tax_value_update" name="tax_value"
                                value="{{old('value')}}" placeholder="Enter Store tax value" required>
                            @error('tax_value')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Tax Type</label>
                            <select class="form-select" id="tax_type_update" name="tax_type" required>
                                <option value="inclusive"> Inclusive</option>
                                <option value="exclusive"> Exclusive</option>
                            </select>
                            @error('tax_type')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ms-auto">Update Tax Value</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Store Modal -->
    <div class="modal modal-blur fade" id="modal-store" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Store</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="bg-white p-6 rounded-lg shadow-lg" action="{{ route('admin.setting.store.create') }}"
                        method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label required">Store Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('value')}}"
                                placeholder="Enter Store Nameq" required>
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Store Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{old('value')}}"
                                placeholder="Enter Store Address" required>
                            @error('address')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Store City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{old('value')}}"
                                placeholder="Enter Store City" required>
                            @error('city')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Store State</label>
                            <input type="text" class="form-control" id="state" name="state" value="{{old('value')}}"
                                placeholder="Enter Store State" required>
                            @error('state')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Store Country</label>
                            <input type="text" class="form-control" id="country" name="country" value="{{old('value')}}"
                                placeholder="Enter Store Country" required>
                            @error('country')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Store Pincode</label>
                            <input type="text" class="form-control" id="pincode" name="pincode" value="{{old('value')}}"
                                placeholder="Enter Store pincode" required>
                            @error('pincode')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Store Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{old('value')}}"
                                placeholder="Enter Store phone number" required>
                            @error('phone')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Store GST</label>
                            <input type="text" class="form-control" id="gst" name="gst" value="{{old('value')}}"
                                placeholder="Enter Store gst number" required>
                            @error('gst')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Tax Value(%)</label>
                            <input type="text" class="form-control" id="tax_value" name="tax_value"
                                value="{{old('value')}}" placeholder="Enter Store tax value" required>
                            @error('tax_value')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Tax Type</label>
                            <select class="form-select" id="tax_type" name="tax_type" required>
                                <option value="inclusive"> Inclusive</option>
                                <option value="exclusive"> Exclusive</option>
                            </select>
                            @error('tax_type')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ms-auto">Create Store</button>
                </div>
                </form>
            </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateButtons = document.querySelectorAll('.btn-update');
        const updateForm = document.getElementById("taxForm");

        updateButtons.forEach(button => {
            button.addEventListener('click', function () {
                const taxId = this.getAttribute('data-id');
                const value = this.getAttribute('data-value');
                const type = this.getAttribute('data-type');
                const name = this.getAttribute('data-name');
                const address = this.getAttribute('data-address');
                const city = this.getAttribute('data-city');
                const state = this.getAttribute('data-state');
                const country = this.getAttribute('data-country');
                const pincode = this.getAttribute('data-pincode');
                const phone = this.getAttribute('data-phone');
                const gst = this.getAttribute('data-gst');

                updateForm.action = "{{ route('admin.setting.store.update', ':id') }}".replace(':id', taxId);

                document.getElementById('name_update').value = name;
                document.getElementById('address_update').value = address;
                document.getElementById('city_update').value = city;
                document.getElementById('state_update').value = state;
                document.getElementById('country_update').value = country;
                document.getElementById('pincode_update').value = pincode;
                document.getElementById('phone_update').value = phone;
                document.getElementById('gst_update').value = gst;
                document.getElementById('tax_value_update').value = value;
                document.getElementById('tax_type_update').value = type;
            });
        });
    });

</script>
@endsection