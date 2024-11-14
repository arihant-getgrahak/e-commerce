@extends('layout.index')

@section('address')
<h1>Address</h1>

<div class="row">
    <div class="mb-3 col">
        <div>
            <label class="form-label required">Country Name</label>
            <select class="form-select" id="country" name="country">
                @foreach ($country as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="form-label required">IsActive</label>
            <input type="radio" name="status" id="status" value="1"> Yes
            <input type="radio" name="status" id="status" value="0"> No
        </div>
    </div>
    <div class="mb-3 col">
        <div>
            <label class="form-label required">State Name</label>
            <select class="form-select" id="state" name="state">
            </select>
        </div>
        <div>
            <label class="form-label required">IsActive</label>
            <input type="radio" name="status" id="status" value="1"> Yes
            <input type="radio" name="status" id="status" value="0"> No
        </div>
    </div>

    <div class="mb-3 col">
        <div>
            <label class="form-label required">City Name</label>
            <select class="form-select" id="city" name="city">
            </select>
        </div>
        <div>
            <label class="form-label required">IsActive</label>
            <input type="radio" name="status" id="status" value="1"> Yes
            <input type="radio" name="status" id="status" value="0"> No
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
                const html = `<option value="${option.id}">${option.name}</option>`;
                stateSelect.insertAdjacentHTML('beforeend', html);
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
                const html = `<option value="${option.id}">${option.name}</option>`;
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


@endsection