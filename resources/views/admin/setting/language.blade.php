@extends('layout.index')

@section('setting')
<main>
    <h1>Admin Language Settings</h1>

    {{--<div class="mb-4 d-flex" style="gap: 10px;">
        <div class="col-md-6">
            <form action="{{route(" admin.setting.forex.currency.default")}}" method="POST">
                @csrf
                <label class="form-label required">Default Currency</label>
                <select class="form-select" id="default_currency" name="default_currency" required>
                    @foreach ($languageorex as $language)
                    <option value="{{ $language->id }}" {{ $language->default ? 'selected' : '' }}>
                        {{ $language->name }}
                    </option>
                    @endforeach
                </select>


                @error('default_currency')
                <span class="text-danger">{{$message}}</span>
                @enderror

                <button class="btn btn-primary mt-2" type="submit">Update</button>
            </form>
        </div>
        <div class="col-md-6">
            <form action="{{route(" admin.setting.forex.option")}}" method="POST">
                @csrf
                <label class="form-label required">Forex Option</label>
                <select class="form-select" id="forex_option" name="forex_option" required>
                    <option value="manual" {{ $languageorex_option==="manual" ? 'selected' : '' }}>
                        Manual
                    </option>
                    <option value="api" {{ $languageorex_option==="api" ? 'selected' : '' }}>
                        API
                    </option>
                </select>
                @error('forex_option')
                <span class="text-danger">{{$message}}</span>
                @enderror

                <button class="btn btn-primary mt-2" type="submit">Update</button>
            </form>
        </div>
    </div>--}}
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-language">
        Add Language
    </button>

    <!-- All Languages Table -->
    <div class="card mt-3">
        <div class="card-body">
            <h1>All Languages</h1>
            <div id="table-default" class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><button class="table-sort">Id</button></th>
                            <th><button class="table-sort">Name</button></th>
                            <th><button class="table-sort">Code</button></th>
                            <th><button class="table-sort">RTL Status</button></th>
                            <th><button class="table-sort">Language Status</button></th>
                            <th><button class="table-sort">Default</button></th>
                            <th><button class="table-sort">Action</button></th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach ($languages as $language)
                            <tr>
                                <td>{{ $language->id }}</td>
                                <td>{{ $language->name }}</td>
                                <td>{{ $language->code }}</td>
                                <td>
                                    <span class="badge {{ $language->rtl ? 'bg-success' : 'bg-danger' }} text-white">
                                        {{ $language->rtl ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $language->status ? 'bg-success' : 'bg-danger' }} text-white">
                                        {{ $language->status ? 'True' : 'False' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $language->default ? 'bg-success' : 'bg-danger' }} text-white">
                                        {{ $language->default ? 'True' : 'False' }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm btn-update" data-bs-toggle="modal"
                                        data-bs-target="#modal-currency-update" data-id="{{ $language->id }}"
                                        data-name="{{ $language->name }}" data-code="{{ $language->code }}"
                                        data-rtl="{{ $language->rtl }}" data-status="{{ $language->status }}"
                                        data-default="{{ $language->default }}">
                                        Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modal-delete-{{ $language->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal modal-blur fade" id="modal-delete-{{ $language->id }}" tabindex="-1"
                                role="dialog" aria-hidden="true">
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
                                            <div class="text-secondary">Do you really want to delete this Language? This
                                                action cannot be undone.</div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="w-100">
                                                <div class="row">
                                                    <div class="col">
                                                        <a href="javascript:void(0)" class="btn w-100"
                                                            data-bs-dismiss="modal">Cancel</a>
                                                    </div>
                                                    <div class="col">
                                                        <form id="delete-form-{{ $language->id }}"
                                                            action="{{ route('admin.setting.language.delete', $language->id) }}"
                                                            method="POST" class="w-100">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger w-100">Delete</button>
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


    <!-- Add Language Modal -->
    <div class="modal modal-blur fade" id="modal-language" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Language</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="bg-white p-6 rounded-lg shadow-lg"
                        action="{{ route('admin.setting.language.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label required">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}"
                                placeholder="Enter Name" required>
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Code</label>
                            <input type="text" class="form-control" id="code" name="code" value="{{old(key: 'code')}}"
                                placeholder="Enter Code" required>
                            @error('code')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Status</label>
                            <label class="form-check form-switch">
                                <input type="hidden" name="status" value="0" />
                                <input class="form-check-input" type="checkbox" id="status" name="status" value="1" />
                            </label>
                            @error('status')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">RTL</label>
                            <label class="form-check form-switch">
                                <input type="hidden" name="rtl" value="0" />
                                <input class="form-check-input" type="checkbox" id="rtl" name="rtl" value="1" />
                            </label>
                            @error('rtl')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Is Default?</label>
                            <label class="form-check form-switch">
                                <input type="hidden" name="default" value="0" />
                                <input class="form-check-input" type="checkbox" id="default" name="default" value="1" />
                            </label>
                            @error('default')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ms-auto">Add Language</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    {{--<div class="modal modal-blur fade" id="modal-currency-update" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="currencyForm" class="bg-white p-6 rounded-lg shadow-lg" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label required">Currency Name</label>
                            <input type="text" class="form-control" id="update_name" name="name" value="{{old('name')}}"
                                placeholder="Enter Currency Name" required>
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Currency Symbol</label>
                            <input type="text" class="form-control" id="update_symbol" name="symbol"
                                value="{{old('symbol')}}" placeholder="Enter Currency Symbol" required>
                            @error('symbol')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Currency Code</label>
                            <input type="text" class="form-control" id="update_code" name="code"
                                value="{{old(key: 'code')}}" placeholder="Enter Currency Code" required>
                            @error('code')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Currency Exchange Rate (1INR = ?)</label>
                            <input type="text" class="form-control" id="update_exchange" name="exchange"
                                value="{{old('exchange')}}" placeholder="Enter Currency Exchange Rate (1INR = ?)"
                                required>
                            @error('exchange')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label required">Currency Status</label>
                            <label class="form-check form-switch">
                                <input type="hidden" name="status" id="update_status_hidden" value="0" />
                                <input class="form-check-input" type="checkbox" id="update_status" name="status"
                                    value="1" />
                            </label>
                            @error('status')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ms-auto">Update Forex Currency</button>
                </div>
                </form>
            </div>
        </div>
    </div>--}}
</main>


<script>
    if ("{{Session::has('success')}}") {
        alert("{{Session::get('success')}}");
    }
    if ("{{Session::has('error')}}") {
        alert("{{Session::get('error')}}");
    }
</script>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateButtons = document.querySelectorAll('.btn-update');
        const updateForm = document.getElementById("currencyForm");

        updateButtons.forEach(button => {
            button.addEventListener('click', function () {
                const forexId = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const code = this.getAttribute('data-code');
                const symbol = this.getAttribute('data-symbol');
                const exchange = this.getAttribute('data-exchange');
                const status = this.getAttribute('data-status');

                updateForm.action = "{{ route('admin.setting.forex.update', ':id') }}".replace(':id', forexId);

                document.getElementById('update_name').value = name;
                document.getElementById('update_code').value = code;
                document.getElementById('update_symbol').value = symbol;
                document.getElementById('update_exchange').value = exchange;
                document.getElementById('update_status_hidden').value = status ? '1' : '0';
                document.getElementById('update_status').checked = status;
            });
        });
    });
</script> -->
@endsection