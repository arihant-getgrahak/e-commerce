@extends('layout.index')

@section('setting')
<main class="space-y-6">
    <h1>Admin Tax Settings</h1>
    @php
        echo $tax;
    @endphp

    <div>
        <h2 class="text-3xl font-bold mb-4">Add Tax</h2>
        <form class="bg-white p-6 rounded-lg shadow-lg" action="{{ route('admin.setting.tax.create') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label required">Tax Value (in %)</label>
                <input type="text" class="form-control" id="value" name="value" value="{{old('value')}}"
                    placeholder="Enter Tax Value" required>
                @error('value')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label required">Tax Type</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="inclusive"> Inclusive</option>
                    <option value="exclusive"> Exclusive</option>
                </select>
                @error('type')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary ms-auto">
                Add Tax
            </button>
        </form>
    </div>

    <div class="card">
        <div class="card-body">
            <h1>All Category</h1>
            <div id="table-default" class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><button class="table-sort" data-sort="sort-name">Id</button></th>
                            <th><button class="table-sort" data-sort="sort-city">Tax Value</button></th>
                            <th><button class="table-sort" data-sort="sort-city">Tax Type</button></th>
                            <th><button class="table-sort" data-sort="sort-type">Action</button></th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach ($tax as $t)
                            <tr>
                                <td class="sort-name">{{$t->id}}</td>
                                <td class="sort-city">{{$t->value}}%</td>
                                <td class="sort-city">{{Str::ucfirst($t->type)}}</td>
                                <td class="sort-type">
                                    {{--<button class="btn btn-primary btn-sm btn-update" data-bs-toggle="modal"
                                        data-bs-target="#modal-edit-{{$t->id}}" data-id="{{ $c['id'] }}"
                                        data-parent-id="{{ $c['parent_id'] ?? null }}"
                                        data-name="{{ $c['name'] }}">Edit</button>--}}
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modal-delete-{{$t->id}}">Delete</button>
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal modal-blur fade" id="modal-delete-{{$t->id}}" tabindex="-1" role="dialog"
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
                                            <div class="text-secondary">Do you really want to delete this Tax? This
                                                action cannot be undone.</div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="w-100">
                                                <div class="row">
                                                    <div class="col"><a href="#" class="btn w-100"
                                                            data-bs-dismiss="modal">Cancel</a></div>
                                                    <div class="col">
                                                        <form id="delete-form-{{$t->id}}"
                                                            action="{{ route('admin.setting.tax.delete', $t->id) }}"
                                                            method="POST" class="w-100">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger w-100">Delete
                                                                Tax</button>
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