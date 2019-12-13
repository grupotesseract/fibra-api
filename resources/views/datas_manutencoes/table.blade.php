@section('css')
    @include('vendor.datatables.css')
@endsection


{!! $dataTable->table(['width' => '100%', 'class' => 'table table-striped table-bordered']) !!}

@section('scripts')
    @include('vendor.datatables.js')
    {!! $dataTable->scripts() !!}
@append