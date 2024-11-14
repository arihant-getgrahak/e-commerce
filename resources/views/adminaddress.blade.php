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
        <form action="{{route("city.update")}}" method="post">
            @csrf
            <div>
                <label class="form-label required">City Name</label>
                <select class="form-select" id="city" name="city">
                    <option value="">Select City</option>
                </select>
            </div>
            <div class="mt-3">
                <label class="form-label required">IsActive</label>
                <input type="radio" name="status" id="status-city" value="1"> Yes
                <input type="radio" name="status" id="status-city" value="0"> No
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
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

            city.addEventListener('change', function () {
                const selectedCity = this.options[this.selectedIndex];
                const status = selectedCity.getAttribute('data-status-city');
                if (status === '1') {
                    document.querySelector('input[id="status-city"][value="1"]').checked = true;
                } else {
                    document.querySelector('input[id="status-city"][value="0"]').checked = true;
                }
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

@endsection