<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SnnRajCorp - Campaign Form</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/images/logo.png') }}">
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="page-content">
    <div class="container-fluid">


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="card-title mb-0">Channel Partner Form Enquiry</h4>
                            <div class="col-auto">
                                <a href="{{route('channel_partner_form.get')}}" class="btn btn-secondary">Form</a>
                                <a href="{{route('channel_partner_form.excel')}}" download type="button" class="btn btn-info">Excel</a>
                                <a href="{{route('channel_partner_form.logout')}}" type="button" class="btn btn-danger">Logout</a>
                            </div>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            {{-- <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <a href="{{route('enquiry.channel_partner_form.excel.get')}}" download type="button" class="btn btn-info add-btn" id="create-btn"><i class="ri-file-excel-fill align-bottom me-1"></i> Excel Download</a>
                                </div>
                                <div class="col-sm">
                                    @include('admin.includes.search_list', ['link'=>route('enquiry.channel_partner_form.paginate.get'), 'search'=>$search])
                                </div>
                            </div> --}}
                            <div class="table-responsive table-card mb-1">
                                @if($data->total() > 0)
                                <table class="table align-middle table-nowrap" id="customerTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="sort" data-sort="customer_name">Name</th>
                                            <th class="sort" data-sort="customer_name">Email</th>
                                            <th class="sort" data-sort="customer_name">Phone</th>
                                            <th class="sort" data-sort="customer_name">IP Address</th>
                                            <th class="sort" data-sort="customer_name">Project</th>
                                            <th class="sort" data-sort="customer_name">Notes</th>
                                            <th class="sort" data-sort="customer_name">Channel Partner Phone</th>
                                            <th class="sort" data-sort="date">Created On</th>
                                            </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($data->items() as $item)
                                        <tr>
                                            <td class="customer_name">{{$item->name}}</td>
                                            <td class="customer_name">{{$item->email}}</td>
                                            <td class="customer_name">{{$item->phone}}</td>
                                            <td class="customer_name">{{$item->ip_address}}</td>
                                            <td class="customer_name">{{$item->project}}</td>
                                            <td class="customer_name">{{$item->notes}}</td>
                                            <td class="customer_name">{{$item->channel_partner_phone}}</td>
                                            <td class="date">{{$item->created_at->format('M d, Y h:i A')}}</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                @else
                                    @include('admin.includes.no_result')
                                @endif
                            </div>
                            {{$data->onEachSide(5)->links('admin.includes.pagination')}}
                        </div>
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
</div>

</body>

</html>
