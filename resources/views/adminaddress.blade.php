@extends('layout.index')

@section('address')
<h1>Address</h1>

<div class="row">
    <div class="mb-3 col">
        <form action="{{route("country.update")}}" method="post">
            @csrf
            <div>
                <label class="form-label required">Country Name</label>
                <select class="form-select" id="country" name="country">
                    @foreach ($country as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3">
                <label class="form-label required">IsActive</label>
                @foreach ($country as $c)
                    <input type="radio" name="status" id="status-yes" value="1" {{ $c->status == 1 ? 'checked' : '' }}>
                    <label for="status-yes">Yes</label>
                    <input type="radio" name="status" id="status-no" value="0" {{ $c->status == 0 ? 'checked' : '' }}>
                    <label for="status-no">No</label>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
    <div class="mb-3 col">
        <form action="{{route("state.update")}}" method="post">
            @csrf
            <div>
                <label class="form-label required">State Name</label>
                <select class="form-select" id="state" name="state">
                </select>
            </div>
            <div class="mt-3">
                <label class="form-label required">IsActive</label>
                <input type="radio" name="status" id="status-state" value="1"> Yes
                <input type="radio" name="status" id="status-state" value="0"> No
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>

    <div class="mb-3 col">
        <div>
            <label class="form-label required">City Name</label>
            <select class="form-select" id="city" name="city">
                <option value="">Select City</option>
            </select>
        </div>
        <button class="btn btn-primary mt-3" id="updateBtn" data-bs-toggle="modal"
            data-bs-target="#modal-team">Update</button>
        <button class="btn btn-danger mt-3" id="deleteBtn">Delete</button>
    </div>
</div>

<div class="mb-3 mt-3 col">
    <h2>Add new city</h2>
    <form action="{{route("city.add")}}" method="post" id="orderForm" class="d-flex align-items-center row p-4"
        style="gap:10px">
        @csrf
        <div>
            <label class="form-label required">Country Name</label>
            <select class="form-select" id="country" name="country" required>
                @foreach ($country as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
            @error('country')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="form-label required">Country Name</label>
            <select class="form-select" id="state_id" name="state_id" required>
                @foreach ($state as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
            @error('state_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="form-label required">Enter City Name</label>
            <input type="text" class="form-control" placeholder="Enter City" name="name" id="name" required />
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</div>

<div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update City</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productForm" class="bg-white p-6 rounded-lg shadow-lg" method="post" action="">
                    @csrf
                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">City Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md"
                            placeholder="Enter product name">
                    </div>
                    <div class="mt-3">
                        <label class="form-label required">IsActive</label>
                        <input type="radio" name="status" id="status-city" value="1"> Yes
                        <input type="radio" name="status" id="status-city" value="0"> No
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ms-auto">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- fetch State -->
<script>
    document.addEventListener('DOMContentLoaded', async function () {
        const countrySelect = document.getElementById('country');
        const stateSelect = document.getElementById('state');
        let countryId = countrySelect.value;

        async function fetchStates(countryId) {
            const res = await fetch("{{ route('admin.state', ':id') }}".replace(':id', countryId), {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            stateSelect.innerHTML = '<option value="">Select State</option>';

            const data = await res.json();
            data.forEach(option => {
                const html = `<option data-status="${option.status}" value="${option.id}">${option.name}</option>`;
                stateSelect.insertAdjacentHTML('beforeend', html);
            });

            stateSelect.addEventListener('change', function () {
                const selectedCity = this.options[this.selectedIndex];
                const status = selectedCity.getAttribute('data-status');
                if (status === '1') {
                    document.querySelector('input[id="status-state"][value="1"]').checked = true;
                } else {
                    document.querySelector('input[id="status-state"][value="0"]').checked = true;
                }
            });
        }



        if (countryId) {
            await fetchStates(countryId);
        }
        countrySelect.addEventListener('change', function () {
            countryId = this.value;
            if (countryId) {
                fetchStates(countryId);
            }
        });
    });
</script>

<!-- fetch City -->
<script>
    document.addEventListener('DOMContentLoaded', async function () {
        const stateSelect = document.getElementById('state');
        let stateid = stateSelect.value;
        const city = document.getElementById('city');

        async function fetchCity(stateid) {
            const res = await fetch("{{ route('admin.city', ':id') }}".replace(':id', stateid), {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            city.innerHTML = '<option value="">Select City</option>';

            const data = await res.json();
            data.forEach(option => {
                const html = `<option data-status-city="${option.status}" value="${option.id}">${option.name}</option>`;
                city.insertAdjacentHTML('beforeend', html);
            });
        }

        if (stateid) {
            await fetchCity(stateid);
        }

        stateSelect.addEventListener('change', function () {
            stateid = this.value;
            if (stateid) {
                fetchCity(stateid);
            }
        });
    });
</script>

<script>
    if ("{{ session('success') }}") {
        alert("{{ session('success') }}");
    }


</script>

<script>
    const deleteBtn = document.getElementById('deleteBtn');
    const city = document.getElementById('city');
    deleteBtn.addEventListener('click', async function (e) {
        e.preventDefault();
        const id = city.value;

        const res = await fetch("{{ route('city.delete.js', ':id') }}".replace(':id', id), {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        })

        const data = await res.json();
        if (data.status) {
            alert(data.message);
        }
        else {
            console.log(data);
        }
    })
</script>

<script>
    const updateBtn = document.querySelectorAll('#updateBtn');
    const updateForm = document.getElementById("productForm");
    // const city = document.getElementById('city');

    updateBtn.forEach(btn => {
        btn.addEventListener('click', async function (e) {
            e.preventDefault();
            const id = city.value;

            const getCity = await fetch("{{ route('city.get', ':id') }}".replace(':id', id), {
                method: 'GET',
            });

            const data = await getCity.json();

            updateForm.action = "{{ route('city.update', ':id') }}".replace(':id', id);

            updateForm.querySelector('#name').value = data.data.name;

            if (data.data.status) {
                document.querySelector('input[id="status-city"][value="1"]').checked = true;
            } else {
                document.querySelector('input[id="status-city"][value="0"]').checked = true;
            }
        });
    })
</script>

@endsection