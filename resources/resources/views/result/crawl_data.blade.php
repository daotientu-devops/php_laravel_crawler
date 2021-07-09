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
                        <th>Url</th>
                        <th><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i> Cập nhật lúc</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($website_data as $web)
                    <tr>
                        <td><a href="{{ $web['url'] }}" target="_blank">{{ $web['url'] }}</a></td>
                        <td><?php $created_at = isset($web['created_at']) ? date('d/m/Y H:i', $web['created_at']) : ''; ?>{{ $created_at }}</td>
                    </tr>
                    <div id="modal-table-{{ $web['_id'] }}" class="modal fade" tabindex="-1">
                        <div class="modal-dialog" style="width: 60%; overflow: hidden">
                            <div class="modal-content">
                                <div class="modal-header no-padding">
                                    <div class="table-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                            <span class="white">&times;</span>
                                        </button>
                                        Lấy danh sách url từ các trang web
                                    </div>
                                </div>
                                <div class="modal-body">

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