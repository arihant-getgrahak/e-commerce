@extends('layout.index')

@section('pickupaddress')
<h1>Pickup Address</h1>
<div class="mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">Add Pickup Address</button>
</div>
<div class="col-12">
    <div class="card">
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-striped">
                <thead>
                    <tr>
                        <th>Address NickName</th>
                        <th>Address</th>
                        <th>Email to be contacted</th>
                        <th>Number to be contacted</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($addresses as $address)
                        <tr>
                            <td>{{$address->tag}}</td>
                            <td class="text-secondary">
                                {{$address->address}}, {{$address->city}}, {{$address->state}}, {{$address->pincode}}
                            </td>
                            <td class="text-secondary">
                                {{$address->phone}}
                            </td>
                            <td class="text-secondary"><a href="#" class="text-reset">{{$address->email}}</a></td>
                            <td class="d-flex" style="gap: 0.5rem;">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modal-update"
                                    id="btn-update" data-id="{{$address->id}}" data-tag="{{$address->tag}}"
                                    data-email="{{$address->email}}" data-phone="{{$address->phone}}"
                                    data-address="{{$address->address}}" data-pincode="{{$address->pincode}}"
                                    data-name="{{$address->name}}" data-city="{{$address->city}}"
                                    data-state="{{$address->state}}" data-country="{{$address->country}}">Edit</a>
                                <a href="javascript:void(0)" class="text-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- update model -->
<div class="modal modal-blur fade" id="modal-update" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addressForm" class="bg-white p-6 rounded-lg shadow-lg" method="post" action="">
                    @csrf

                    <!-- Address Tag -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">Address NickName</label>
                        <input type="text" id="tag" name="tag"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @error('tag')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Person to be contacted -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">Person Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @error('name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email to be contacted -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">Person Email</label>
                        <input type="text" id="email" name="email"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @error('email')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Phone -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">Phone</label>
                        <input type="tel" id="phone" name="phone"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @error('phone')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">Address</label>
                        <input type="text" id="address" name="address"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @error('address')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address City -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">City</label>
                        <input type="text" id="city" name="city"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @error('city')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- State -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">State</label>
                        <input type="text" id="state" name="state"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @error('state')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Country -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">Country</label>
                        <input type="text" id="country" name="country"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @error('country')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pincode -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">Pincode</label>
                        <input type="text" id="pincode" name="pincode"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @error('pincode')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ms-auto">Update Address</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Pickup Address model -->
<div class="modal modal-blur fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addrescreatesForm" class="bg-white p-6 rounded-lg shadow-lg" method="post"
                    action="{{route('pickupaddress.create')}}">
                    @csrf

                    <!-- Address Tag -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">Address NickName</label>
                        <input type="text" id="tag" name="tag"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @error('tag')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Person to be contacted -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">Person Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @error('name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email to be contacted -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">Person Email</label>
                        <input type="text" id="email" name="email"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @error('email')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>


                    <!-- Phone -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">Phone</label>
                        <input type="tel" id="phone" name="phone"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @error('phone')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">Address</label>
                        <input type="text" id="address" name="address"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @error('address')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address City -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">City</label>
                        <input type="text" id="city" name="city"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @error('city')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- State -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">State</label>
                        <input type="text" id="state" name="state"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @error('state')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Country -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">Country</label>
                        <input type="text" id="country" name="country"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @error('country')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pincode -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">Pincode</label>
                        <input type="text" id="pincode" name="pincode"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        @error('pincode')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- isDefault -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">IsDefault</label>
                        <input type="radio" name="is_default" id="is_default" value="1">Yes
                        <input type="radio" name="is_default" id="is_default" value="0">No
                        @error('is_default')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ms-auto">Create Address</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- pagination starts -->
<div class="mt-3 d-flex justify-content-between">
    <div class="mb-3 text-gray-600">
        Showing {{ $addresses->firstItem() }} to {{ $addresses->lastItem() }} out of {{ $addresses->total() }} results
    </div>
    <ul class="pagination">
        @if ($addresses->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link" aria-disabled="true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M15 6l-6 6l6 6" />
                    </svg>
                    Prev
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $addresses->previousPageUrl() }}" rel="prev">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M15 6l-6 6l6 6" />
                    </svg>
                    Prev
                </a>
            </li>
        @endif

        @foreach ($addresses->links()->elements[0] as $page => $url)
            @if ($page == $addresses->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        @if ($addresses->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $addresses->nextPageUrl() }}" rel="next">
                    Next
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 6l6 6l-6 6" />
                    </svg>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link" aria-disabled="true">
                    Next
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 6l6 6l-6 6" />
                    </svg>
                </span>
            </li>
        @endif
    </ul>
</div>

<script>
    if ("{{session('success')}}") {
        alert("{{session('success')}}");
    }
    if ("{{session('error')}}") {
        alert("{{session('error')}}");
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateButtons = document.querySelectorAll('#btn-update');
        const addressForm = document.getElementById("addressForm");

        updateButtons.forEach(button => {
            button.addEventListener('click', function () {
                const addressId = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const tag = this.getAttribute('data-tag');
                const email = this.getAttribute('data-email');
                const phone = this.getAttribute('data-phone');
                const address = this.getAttribute('data-address');
                const pincode = this.getAttribute('data-pincode');
                const city = this.getAttribute('data-city');
                const state = this.getAttribute('data-state');
                const country = this.getAttribute('data-country');

                addressForm.action = "{{route("pickupaddress.update", ":id")}}".replace(':id', addressId);

                addressForm.querySelector('#tag').value = tag;
                addressForm.querySelector('#name').value = name;
                addressForm.querySelector('#email').value = email;
                addressForm.querySelector('#phone').value = phone;
                addressForm.querySelector('#address').value = address;
                addressForm.querySelector('#pincode').value = pincode;
                addressForm.querySelector('#city').value = city;
                addressForm.querySelector('#state').value = state;
                addressForm.querySelector('#country').value = country;
            });
        });
    });

</script>

@endsection