@extends('layout.index')
@section('navigation')

<div class="d-flex justify-content-between mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-menu">
        Add Menu
    </button>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-link">
        Add Link
    </button>
</div>

<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs">
            @foreach ($navigation as $index => $nav)
                <li class="nav-item">
                    <a href="#tabs-{{$nav->id}}" class="nav-link {{ $index === 0 ? 'active' : '' }}" data-bs-toggle="tab">
                        {{ $nav->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            @foreach ($navigation as $index => $nav)
                <div class="tab-pane {{ $index === 0 ? 'active show' : '' }}" id="tabs-{{$nav->id}}">
                    @foreach ($nav->menus as $menu)
                        <ul>
                            <li>
                                {{ $menu->name }}
                                (<a href="{{ $menu->link }}">{{ $menu->link }}</a>)
                            </li>
                            @if ($menu->children->isNotEmpty())
                                <ul id="menu-children-{{$menu->id}}">
                                    @foreach ($menu->children as $child)
                                        <li class="sort-name" data-id="{{ $child->id }}">
                                            {{ $child->name }}
                                            (<a href="{{ $child->link }}">{{ $child->link }}</a>)
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </ul>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>



<!-- add link modal -->
<div class="modal modal-blur fade" id="modal-link" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Links Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productForm" class="bg-white p-6 rounded-lg shadow-lg" method="post"
                    action="{{route("link.add")}}" enctype="multipart/form-data">
                    @csrf

                    <!-- menu_id -->
                    <div class="mb-3">
                        <label class="form-label required">Menu</label>
                        <select class="form-select" id="navigation_id" name="navigation_id" required>
                            <option value="">Select Parent Menu</option>
                            @foreach ($navigation as $m)
                                <option value="{{ $m->id }}">{{ $m->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- parent_id -->
                    <div class="mb-3">
                        <label class="form-label">Parent (Optional)</label>
                        <select class="form-select" id="parent_id" name="parent_id">
                        </select>
                    </div>

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Enter name"
                            required>
                    </div>

                    <!-- link -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">Link</label>
                        <input type="text" id="link" name="link"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Enter link"
                            required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ms-auto">Add Link</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- add menu modal -->
<div class="modal modal-blur fade" id="modal-menu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Menu Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productForm" class="bg-white p-6 rounded-lg shadow-lg" method="post"
                    action="{{route("menu.add")}}" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="col-form-label required">Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md" placeholder="Enter name"
                            required>

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ms-auto">Add Menu</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[id^="menu-children-"]').forEach(list => {
            Sortable.create(list, {
                animation: 150,
                onStart: function (evt) {
                },
                onEnd: function (evt) {
                    document.body.style.cursor = 'default';
                    const orderedIds = Array.from(evt.to.children).map(item => item.dataset.id);
                    fetch('{{route("menu.sort")}}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ orderedIds })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Order updated successfully!');
                            } else {
                                console.error('Error updating order:', data.message);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuId = document.getElementById("navigation_id");
        let tempId = menuId.value;

        menuId.addEventListener("change", async function () {
            const parentIdSelect = document.getElementById("parent_id");
            const res = await fetch("{{route("links", ":id")}}".replace(":id", menuId.value));
            const data = await res.json();
            parentIdSelect.innerHTML = "";
            parentIdSelect.innerHTML = `<option value="">Select Parent Menu</option>`;

            data.links.forEach(option => {
                const HTML = `<option value="${option.id}">${option.name}</option>`;
                parentIdSelect.insertAdjacentHTML("beforeend", HTML);
            });
        });

    })
</script>

@endsection