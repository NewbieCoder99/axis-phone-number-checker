@extends('dashboard.layout')

@section('pageName')
    <h1 class="mb-0 text-white">{{ @$pageName }}</h1>
    <div class="small"></div>
@endsection

@section('contents')
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">

                <div class="d-flex align-items-center mb-4">
                    <div class="ml-auto">
                        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                            <i class="fa fa-filter"></i>&nbsp;Filter
                        </button>
                    </div>
                </div>

                @include('dashboard.phone-numbers.includes.filter')

                <div class="table-responsive">
                    <table class="table table-condensed table-striped" id="phone-number-dt" style="width:100%;">
                        <thead class="bg-gradient-primary-to-secondary text-white">
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Number</th>
                                <th class="text-center">Message Status</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        /*
        * Get Admins Table
        */
        function phoneNumbers(route) {
            jQuery('#phone-number-dt').dataTable({
                language: {
                    paginate: {
                        previous: '‹',
                        next:     '›'
                    }
                },
                processing: false,
                serverSide: true,
                searching: false,
                destroy: true,
                scrollX: true,
                lengthChange : false,
                ordering : false,
                ajax: route,
                columns: [
                    {
                        data : 'start_row',
                        name : 'start_row',
                        className : 'text-center'
                    },
                    {
                        data : 'number',
                        name : 'number',
                        className : 'text-center'
                    },
                    {
                        data : 'status_message',
                        name : 'status_message',
                        className : 'text-left'
                    },
                    {
                        data : 'status',
                        name : 'status',
                        className : 'text-center'
                    },
                    {
                        data : function(data) {
                            return '-';
                        },
                        name : 'action',
                        className : 'text-center'
                    },
                ]
            });
        }

        function refreshDatatable() {
            filterTable();
        }

        function filterTable() {
            let _url = '{{ url()->current() }}?' + jQuery('.formFilter').serialize()+'&start=0&length=1';
            phoneNumbers(_url);
        }

        function clearForm() {
            jQuery('.formFilter').trigger('reset');
            filterTable();
        }

        filterTable();
    </script>
@endsection