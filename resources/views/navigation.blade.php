@extends('layout.index')

@section('navigation')

<div class="page-wrapper">
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Datatables
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div id="table-default" class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><button class="table-sort" data-sort="sort-name">Name</button></th>
                                    <th><button class="table-sort" data-sort="sort-name">Links</button></th>
                                </tr>
                            </thead>
                            <tbody class="table-tbody">
                                @foreach ($navigation as $n)
                                    <tr>
                                        <td class="sort-name">{{ $n->name }}</td>
                                        <td>
                                            @if($n->menus->isNotEmpty())
                                                <ul>
                                                    @foreach ($n->menus as $menu)
                                                        <li class="sort-name">{{ $menu->name }}(<a
                                                                href="{{$menu->link}}">{{$menu->link}}</a>)</li>
                                                        @if($menu->children->isNotEmpty())
                                                            <ul>
                                                                @foreach ($menu->children as $child)
                                                                    <li class="sort-name">{{ $child->name }}(
                                                                        <a href="{{$child->link}}">{{$child->link}}</a>
                                                                        )
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @else
                                                No Children
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection