@extends('../admin.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="table-data__tool col-12">
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">Category List</h2>
                    </div>
                </div>
                <div class="table-data__tool-right">

                    <a href="{{ route('category#createPage') }}">
                        <button class="btn btn-primary">
                            <i class="zmdi zmdi-plus me-1"></i>add category
                        </button>
                    </a>

                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-2">
                <form action="{{ route('category#listPage') }}" class="input-group col-6" method="get">
                    @csrf
                    <input type="text" name='searchKey' class="form-control" placeholder="Search category name . . ." value="{{ request('searchKey') }}">
                    <button class="btn btn-outline-danger" type="submit" >Search</button>
                </form>

                <p class="text-primary fs-5 me-4">
                    Total Categories - {{ $categories->total() }}
                </p>
            </div>

            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-responsive table-responsive-data2">

                    @if ($categories->total() != 0)
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CATEGORY NAME</th>
                                    <th>CREATED DATE</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $category)
                                    <tr class="tr-shadow">
                                        <td>{{ $category->id }}</td>

                                        <td>
                                            <span>{{ $category->name }}</span>
                                        </td>

                                        <td class="desc">{{ $category->created_at->format('j-F-Y') }}</td>

                                        <td>
                                            <div class="table-data-feature">

                                                <a href="{{ route('category#editPage',$category->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>

                                                &nbsp;&nbsp;

                                                <a href="{{ route('category#delete',$category->id) }}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi text-danger zmdi-delete"></i>
                                                </a>

                                                {{-- &nbsp;&nbsp;

                                                <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                    <i class="zmdi zmdi-more"></i>
                                                </button> --}}
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="spacer"></tr>

                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="col-12 d-flex align-items-center justify-content-center" style="height: 300px">
                            <p class="text-danger">There is no categories !</p>
                        </div>
                    @endif

                    <div class="mt-2">
                        {{ $categories->links() }}
                    </div>

                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
