@extends('layout.index')

@section('setting')
<main>
    <h1>Admin Language Settings</h1>
    <!-- admin.setting.forex.lamguage.default -->

    <div class="col-md-6">
        <form action="{{route("admin.setting.forex.language.default")}}" method="POST">
            @csrf
            <label class="form-label required">Default Language</label>
            <select class="form-select" id="lang" name="lang" required>
                @foreach ($languages as $language)
                    <option value="{{$language->id}}" {{ $language->default ? 'selected' : '' }}>
                        {{ $language->name }}
                    </option>
                @endforeach
            </select>
            @error('lang')
                <span class="text-danger">{{$message}}</span>
            @enderror

            <button class="btn btn-primary mt-2" type="submit">Update</button>
        </form>
    </div>
    <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modal-language">
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
                                <td class="d-flex" style="gap: 5px;">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <button class="dropdown-item btn-update" data-bs-toggle="modal"
                                                data-bs-target="#modal-lang-update" data-id="{{ $language->id }}"
                                                data-name="{{ $language->name }}" data-code="{{ $language->code }}"
                                                data-rtl="{{ $language->rtl }}" data-status="{{ $language->status }}">
                                                Edit
                                            </button>
                                            <button onclick="changeLanguageKeys({{$language->id}})" class="dropdown-item">
                                                Change Language Keys
                                            </button>
                                        </div>
                                    </div>
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
    <div class="modal modal-blur fade" id="modal-lang-update" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="langForm" class="p-6 rounded-lg shadow-lg" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Name Field -->
                        <div class="mb-3">
                            <label for="update_name" class="form-label required">Name</label>
                            <input type="text" class="form-control" id="update_name" name="name"
                                value="{{ old('name') }}" placeholder="Enter Name" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Code Field -->
                        <div class="mb-3">
                            <label for="update_code" class="form-label required">Code</label>
                            <input type="text" class="form-control" id="update_code" name="code"
                                value="{{ old('code') }}" placeholder="Enter Code" required>
                            @error('code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- RTL Switch -->
                        <div class="mb-3">
                            <label class="form-label required">RTL</label>
                            <div class="form-check form-switch">
                                <input type="hidden" name="rtl" id="update_rtl_hidden" value="0">
                                <input class="form-check-input" type="checkbox" id="update_rtl" name="rtl" value="1" />
                            </div>
                            @error('rtl')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Status Switch -->
                        <div class="mb-3">
                            <label class="form-label required">Status</label>
                            <div class="form-check form-switch">
                                <input type="hidden" name="status" id="update_status_hidden" value="0">
                                <input class="form-check-input" type="checkbox" id="update_status" name="status"
                                    value="1" />
                            </div>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ms-auto" form="langForm">Update Language</button>
                </div>
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
        const updateForm = document.getElementById("langForm");

        const updateStatusCheckbox = document.getElementById('update_status');
        const updateStatusHidden = document.getElementById('update_status_hidden');

        const updateRtlCheckbox = document.getElementById('update_rtl');
        const updateRtlHidden = document.getElementById('update_rtl_hidden');

        updateStatusCheckbox.addEventListener('change', function () {
            updateStatusHidden.value = this.checked ? '1' : '0';
        });

        updateRtlCheckbox.addEventListener('change', function () {
            updateRtlHidden.value = this.checked ? '1' : '0';
        });

        updateButtons.forEach(button => {
            button.addEventListener('click', function () {
                const langId = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const code = this.getAttribute('data-code');
                const status = this.getAttribute('data-status') === '1';
                const rtl = this.getAttribute('data-rtl') === '1';

                updateForm.action = "{{ route('admin.setting.language.update', ':id') }}".replace(':id', langId);

                document.getElementById('update_name').value = name;
                document.getElementById('update_code').value = code;

                updateStatusCheckbox.checked = status;
                updateStatusHidden.value = status ? '1' : '0';

                updateRtlCheckbox.checked = rtl;
                updateRtlHidden.value = rtl ? '1' : '0';
            });
        });
    });
</script>

<script>
    function changeLanguageKeys(id) {
        window.location.href = "{{ route('admin.setting.language.get', ':id') }}".replace(':id', id);
    }
</script>

@endsection