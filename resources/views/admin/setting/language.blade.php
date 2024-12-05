@extends('layout.index')

@section('setting')
<main>
    <h1>Admin Language Settings</h1>
    
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
                                        data-bs-target="#modal-lang-update" data-id="{{ $language->id }}"
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
    <div class="modal modal-blur fade" id="modal-lang-update" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="langForm" class="bg-white p-6 rounded-lg shadow-lg" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label required" for="update_name">Name</label>
                            <input type="text" class="form-control" id="update_name" name="name"
                                value="{{ old('name') }}" placeholder="Enter Name" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required" for="update_code">Code</label>
                            <input type="text" class="form-control" id="update_code" name="code"
                                value="{{ old('code') }}" placeholder="Enter Code" required>
                            @error('code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">RTL</label>
                            <label class="form-check form-switch">
                                <input type="hidden" name="rtl" id="update_rtl_hidden" value="0">
                                <input class="form-check-input" type="checkbox" id="update_rtl" name="rtl" value="1">
                            </label>
                            @error('rtl')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Status</label>
                            <label class="form-check form-switch">
                                <input type="hidden" name="status" id="update_status_hidden" value="0">
                                <input class="form-check-input" type="checkbox" id="update_status" name="status"
                                    value="1">
                            </label>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label required">Is Default?</label>
                            <label class="form-check form-switch">
                                <input type="hidden" name="default" id="update_default_hidden" value="0">
                                <input class="form-check-input" type="checkbox" id="update_default" name="default"
                                    value="1">
                            </label>
                            @error('default')
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
        const updateForm = document.getElementById('langForm');

        const setFormField = (fieldId, value, isCheckbox = false) => {
            const field = document.getElementById(fieldId);
            if (isCheckbox) {
                field.checked = !!value;
                document.getElementById(`${fieldId}_hidden`).value = value ? '1' : '0';
            } else {
                field.value = value;
            }
        };

        updateButtons.forEach(button => {
            button.addEventListener('click', function () {
                const { id: langId, name, code, rtl, default: isDefault, status } = this.dataset;

                updateForm.action = `{{ route('admin.setting.language.update', ':id') }}`.replace(':id', langId);

                setFormField('update_name', name);
                setFormField('update_code', code);
                setFormField('update_status', status === '1', true);
                setFormField('update_rtl', rtl === '1', true);
                setFormField('update_default', isDefault === '1', true);
            });
        });
    });
</script>

@endsection