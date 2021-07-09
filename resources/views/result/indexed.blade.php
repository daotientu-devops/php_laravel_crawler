@extends('layouts.default')
@section('content')
<!-- page specific plugin scripts -->
<script src="{{ URL::to('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::to('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::to('assets/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::to('assets/js/buttons.flash.min.js') }}"></script>
<script src="{{ URL::to('assets/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::to('assets/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::to('assets/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::to('assets/js/dataTables.select.min.js') }}"></script>
<script type="text/javascript">
    jQuery(function($) {
        $('#dynamic-table').DataTable();
    });
</script>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="">Bảng điều khiển</a>
        </li>
        <li class="active">Truy hồi thông tin</li>
    </ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
    <div class="page-header">
        <h1>
            IC Lite Advance
        </h1>
    </div><!-- /.page-header -->
    <div class="rơw">
        <div class="col-xs-12">
            <table id="dynamic-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>term_id</th>
                        <th>doc_id</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($indexed as $index)
                    <tr>
                        <td>{{ $index['term_id'] }}</td>
                        <td><?php $doc_id = isset($index['doc_id']) ? $index['doc_id'] : ''; ?>{{ $doc_id }}</td>
                        <td>
                            <div class="hidden-sm hidden-xs btn-group">
                                <button class="btn btn-xs btn-info">
                                    <a href="#modal-table-{{ $index['_id'] }}" role="button" data-toggle="modal"><i class="ace-icon fa fa-search-plus bigger-120"></i></a>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <div id="modal-table-{{ $index['_id'] }}" class="modal fade" tabindex="-1">
                        <div class="modal-dialog" style="width: 60%; overflow: hidden">
                            <div class="modal-content">
                                <div class="modal-header no-padding">
                                    <div class="table-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            <span class="white">&times;</span>
                                        </button>
                                        Đánh chỉ mục
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <p><strong>term_id</strong> {{ $index['term_id'] }}</p>
                                    <p><strong>doc_id</strong> {{ $index['doc_id'] }}</p>
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
@endsection