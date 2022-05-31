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
                        <a href="{{ route('phone-numbers.create') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i>&nbsp;Add New
                        </a>

                        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                            <i class="fa fa-filter"></i>&nbsp;Filter
                        </button>
                    </div>
                </div>

                @include('dashboard.phone-numbers.includes.filter')

                <div class="table-responsive">
                    <table class="table table-condensed" id="phone-number-dt" style="width:100%;">
                        <thead class="bg-gradient-primary-to-secondary text-white">
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Number</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">NIK</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Expired Date</th>
                                <th class="text-center"></th>
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

        function edit() {
            jQuery('.modal-title').html(`Edit Data`);
            jQuery('.modal-body').html(`Edit Data`);
        }

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
                        data : function(data) {
                            if(data.name == null) {
                                return `-`;
                            }

                            return data.name;
                        },
                        name : 'name',
                        className : 'text-center'
                    },
                    {
                        data : function(data) {
                            if(data.nik == null) {
                                return `-`;
                            }

                            return data.nik;
                        },
                        name : 'nik',
                        className : 'text-center'
                    },
                    {
                        data : function(data) {
                            var _class, status;
                            if(data.status === 'unknown') {
                                _class = 'dark';
                                status = '<i class="fa fa-question"></i>';
                            } else if(data.status == 'inactive') {
                                _class = 'danger';
                                status = '<i class="fa fa-times"></i>';
                            } else {
                                var _class = 'success';
                                status = '<i class="fa fa-check"></i>';
                            }

                            return `
                                <span class="badge bg-${_class}">
                                    ${status}
                                </span>
                            `;
                        },
                        name : 'status',
                        className : 'text-center'
                    },
                    {
                        data : function(data) {
                            if(data.expired_date == null) {
                                return `-`;
                            }

                            return data.expired_date;
                        },
                        name : 'expired_date',
                        className : 'text-center'
                    },
                    {
                        data : function(data) {
                            var editUrl = '{{ route('phone-numbers.edit','ID') }}';
                            var delUrl = '{{ route('phone-numbers.show','ID') }}?option=delete_confirmation';
                            return `
                                <div class="flex">
                                    <button class="btn btn-primary btn-xs" onclick="openModal('Edit Data','${editUrl.replace('ID', data.id)}', {submit_button : true})">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-xs" onclick="openModal('Delete Confirmation','${delUrl.replace('ID', data.id)}', {submit_button : true})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            `;
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

        function exportData() {
            window.location = '{{ route('export-phone-number') }}?' + jQuery('.formFilter').serialize();
        }

        filterTable();
    </script>
@endsection