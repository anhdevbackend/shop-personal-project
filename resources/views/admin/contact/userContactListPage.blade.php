@extends('../admin.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="table-data__tool col-12">
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">User Feedback</h2>
                    </div>
                </div>
                <p class="text-primary fs-5 me-4">
                    Total Feedbacks - {{$userFeedback->total()}}
                </p>
            </div>
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-responsive table-responsive-data2">

                    @if ($userFeedback->total() != 0)
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>MESSAGE</th>
                                    <th>DATE</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($userFeedback as $Feedback)
                                    <tr class="tr-shadow">
                                        <td class="align-middle">
                                            {{$Feedback->name}}
                                        </td>

                                        <td class="align-middle">
                                            {{$Feedback->email}}
                                        </td>

                                        <td class="align-middle">
                                            {{$Feedback->message}}
                                        </td>

                                        <td class="align-middle">
                                            {{$Feedback->created_at->format('d/m/Y')}}
                                        </td>

                                        <td class="align-middle">
                                            <div class="table-data-feature">
                                                <a href="{{route('feedbacks#userFeedbackDelete',$Feedback->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi text-danger zmdi-delete"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="spacer"></tr>

                                @endforeach
                            </tbody>
                        </table>

                    @else
                        <div class="col-12 d-flex align-items-center justify-content-center" style="height: 300px">
                            <p class="text-danger">There is no one user feedback !</p>
                        </div>
                    @endif

                    <div class="mt-2">
                        {{ $userFeedback->links() }}
                    </div>

                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection
