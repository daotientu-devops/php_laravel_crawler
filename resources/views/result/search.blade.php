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
        <form class="form-horizontal" role="form" method="post" action="{{ URL::to('search') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tìm kiếm theo từ khóa</label>
                <div class="col-sm-9">
                    <input type="text" id="form-field-1" name="keyword" placeholder="Ví dụ: Asean" class="form-control"/>
                </div>
            </div>
            <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">
                    <button class="btn btn-success" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Tìm kiếm
                    </button>
                    &nbsp;&nbsp;&nbsp;
                    <button class="btn" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Nhập lại
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="rơw">
        @if (isset($data))
            @foreach ($data as $d)
                <p><strong>URL:</strong> <a href="{{ $d['url'] }}" target="_blank">{{ $d['url'] }}</a></p>
                <p><strong>Title:</strong> {{ $d['title'] }}</p>
                <p><strong>Created at:</strong> {{ $d['created_at'] }}</p><hr/>
            @endforeach
        @else

        @endif
    </div>
</div>
@endsection