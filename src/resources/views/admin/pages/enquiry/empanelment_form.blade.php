@extends('admin.layouts.dashboard')



@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Empanelment Form Enquiry', 'page_link'=>route('enquiry.empanelment_form.paginate.get'), 'list'=>['List']])
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Empanelment Form Enquiry</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <a href="{{route('enquiry.empanelment_form.excel.get')}}" download type="button" class="btn btn-info add-btn" id="create-btn"><i class="ri-file-excel-fill align-bottom me-1"></i> Excel Download</a>
                                </div>
                                <div class="col-sm">
                                    @include('admin.includes.search_list', ['link'=>route('enquiry.empanelment_form.paginate.get'), 'search'=>$search])
                                </div>
                            </div>
                            <div class="table-responsive table-card mt-3 mb-1">
                                @if($data->total() > 0)
                                <table class="table align-middle table-nowrap" id="customerTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="sort" data-sort="date">Scope of Work</th>
                                            <th class="sort" data-sort="date">Name of Channel Partner</th>
                                            <th class="sort" data-sort="date">Phone</th>
                                            <th class="sort" data-sort="date">Telephone</th>
                                            <th class="sort" data-sort="date">Email</th>
                                            <th class="sort" data-sort="date">RERA No.</th>
                                            <th class="sort" data-sort="date">Contact Person Name</th>
                                            <th class="sort" data-sort="date">Designation</th>
                                            <th class="sort" data-sort="date">PAN No.</th>
                                            <th class="sort" data-sort="date">GSTIN</th>
                                            <th class="sort" data-sort="date">SAC / HSN Code</th>
                                            <th class="sort" data-sort="date">Tax Applicable</th>
                                            <th class="sort" data-sort="date">Bank Name</th>
                                            <th class="sort" data-sort="date">Bank Address</th>
                                            <th class="sort" data-sort="date">Bank Branch</th>
                                            <th class="sort" data-sort="date">Bank Account Number</th>
                                            <th class="sort" data-sort="date">IFSC Code</th>
                                            <th class="sort" data-sort="date">Address</th>
                                            <th class="sort" data-sort="date">MSME Registered</th>
                                            <th class="sort" data-sort="date">ESI Registered</th>
                                            <th class="sort" data-sort="date">EPF Registered</th>
                                            <th class="sort" data-sort="date">Created On</th>
                                            <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($data->items() as $item)
                                        <tr>
                                            <td class="customer_name">{{$item->scope}}</td>
                                            <td class="customer_name">{{$item->channel_partner}}</td>
                                            <td class="customer_name">{{$item->phone}}</td>
                                            <td class="customer_name">{{$item->telephone}}</td>
                                            <td class="customer_name">{{$item->email}}</td>
                                            <td class="customer_name">{{$item->rera}}</td>
                                            <td class="customer_name">{{$item->contact_person_name}}</td>
                                            <td class="customer_name">{{$item->designation}}</td>
                                            <td class="customer_name">{{$item->pan}}</td>
                                            <td class="customer_name">{{$item->gst}}</td>
                                            <td class="customer_name">{{$item->sac}}</td>
                                            <td class="customer_name">{{$item->tax}}</td>
                                            <td class="customer_name">{{$item->bank_name}}</td>
                                            <td class="customer_name">{{$item->bank_address}}</td>
                                            <td class="customer_name">{{$item->bank_branch}}</td>
                                            <td class="customer_name">{{$item->bank_account_number}}</td>
                                            <td class="customer_name">{{$item->ifsc}}</td>
                                            <td class="customer_name">{{$item->address}}</td>
                                            <td class="customer_name">{{$item->msme ? 'Yes' : 'No'}}</td>
                                            <td class="customer_name">{{$item->esi ? 'Yes' : 'No'}}</td>
                                            <td class="customer_name">{{$item->epf ? 'Yes' : 'No'}}</td>
                                            <td class="date">{{$item->created_at->diffForHumans()}}</td>
                                            <td>
                                                <div class="d-flex gap-2">

                                                    @if($item->msme)
                                                    <div class="remove">
                                                        <a href="{{$item->msme_image_link}}" download class="btn btn-sm btn-primary">Download MSME Copy</a>
                                                    </div>
                                                    @endif
                                                    <div class="remove">
                                                        <a href="{{$item->pan_image_link}}" download class="btn btn-sm btn-primary">Download PAN Copy</a>
                                                    </div>
                                                    <div class="remove">
                                                        <a href="{{$item->gst_image_link}}" download class="btn btn-sm btn-primary">Download GST Copy</a>
                                                    </div>
                                                    <div class="remove">
                                                        <a href="{{$item->rera_image_link}}" download class="btn btn-sm btn-primary">Download RERA Copy</a>
                                                    </div>
                                                    <div class="remove">
                                                        <a href="{{$item->cheque_image_link}}" download class="btn btn-sm btn-primary">Download Cheque/Passbook Copy</a>
                                                    </div>
                                                    <div class="remove">
                                                        <a href="{{$item->seal_image_link}}" download class="btn btn-sm btn-primary">Download Seal/Signature Copy</a>
                                                    </div>

                                                    @can('delete enquiries')
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn" data-link="{{route('enquiry.empanelment_form.delete.get', $item->id)}}">Delete</button>
                                                    </div>
                                                    @endcan
                                                </div>
                                            </td>
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

@stop
