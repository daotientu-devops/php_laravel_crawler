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
        <div class="col-xs-5">
            <!-- PAGE CONTENT BEGINS -->
            <form class="form-horizontal" role="form" method="post" action="{{ URL::to('website/create') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Website</label>
                    <div class="col-sm-9">
                        <input type="text" id="form-field-1" name="website_name" placeholder="Ví dụ: VnExpress" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">URL</label>
                    <div class="col-sm-9">
                        <input type="text" name="website_url" id="form-field-1" placeholder="Ví dụ: http://vnexpress.net" class="form-control"/>
                    </div>
                </div>
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-success" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Thêm
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
        <div class="col-xs-7">
            <table id="dynamic-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tên website</th>
                        <th>Url</th>
                        <th><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i> Cập nhật lúc</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($website as $web)
                    <tr>
                        <td>{{ $web['name'] }}</td>
                        <td>{{ $web['url'] }}</td>
                        <td><?php $created_at = isset($web['created_at']) ? date('d/m/Y H:i', $web['created_at']) : ''; ?>{{ $created_at }}</td>
                        <td>
                            <div class="hidden-sm hidden-xs btn-group">
                                <a href="{{ URL::to('website/delete/' . $web['_id']) }}"><button class="btn btn-xs btn-danger">
                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                </button></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-block alert-success">
                <p>
                    <strong>
                        <i class="ace-icon fa fa-check"></i>
                        B1: Lấy danh sách url từ các trang web
                    </strong>
                </p>
                <p>
                    <a href="{{ URL::to('/crawl_data') }}"><button class="btn btn-sm btn-success" style="margin-right: 10px">Crawl Data</button></a>
                    <a href="{{ URL::to('/crawl_data/result') }}"><button class="btn btn-sm btn-success">Xem kết quả<i class="ace-icon fa fa-arrow-right icon-on-right"></i></button></a>
                </p>
            </div>
            <div class="alert alert-block alert-info">
                <p>
                    <strong>
                        <i class="ace-icon fa fa-check"></i>
                        B2: Tách nội dung chính từ trang web
                    </strong>
                </p>
                <p>
                    <a href="{{ URL::to('/extract_data') }}"><button class="btn btn-sm btn-info" style="margin-right: 10px">Extract Data</button></a>
                    <a href="{{ URL::to('/extract_data/result') }}"><button class="btn btn-sm btn-info">Xem kết quả<i class="ace-icon fa fa-arrow-right icon-on-right"></i></button></a>
                </p>
            </div>
            <div class="alert alert-block alert-info">
                <p>
                    <strong>
                        <i class="ace-icon fa fa-check"></i>
                        B3: Tách từ tố
                    </strong>
                </p>
                <p>
                    <a href="{{ URL::to('/extract_term') }}"><button class="btn btn-sm btn-info" style="margin-right: 10px">Extract Term</button></a>
                    <a href="{{ URL::to('/extract_term/result') }}"><button class="btn btn-sm btn-info">Xem kết quả<i class="ace-icon fa fa-arrow-right icon-on-right"></i></button></a>
                </p>
            </div>
            <div class="alert alert-block alert-info">
                <p>
                    <strong>
                        <i class="ace-icon fa fa-check"></i>
                        B4: Chuẩn hóa từ tố
                    </strong>
                </p>
                <p>
                    <a href="{{ URL::to('/term_standard') }}"><button class="btn btn-sm btn-info" style="margin-right: 10px">Term Standard</button></a>
                    <a href="{{ URL::to('/term_standard/result') }}"><button class="btn btn-sm btn-info">Xem kết quả<i class="ace-icon fa fa-arrow-right icon-on-right"></i></button></a>
                </p>
            </div>
            <div class="alert alert-block alert-warning">
                <p>
                    <strong>
                        <i class="ace-icon fa fa-check"></i>
                        B5: Đánh chỉ mục
                    </strong>
                </p>
                <p>
                    <a href="{{ URL::to('/indexed') }}"><button class="btn btn-sm btn-warning" style="margin-right: 10px">Đánh chỉ mục</button></a>
                    <a href="{{ URL::to('/indexed/result') }}"><button class="btn btn-sm btn-warning">Xem kết quả<i class="ace-icon fa fa-arrow-right icon-on-right"></i></button></a>
                </p>
            </div>
            <div class="alert alert-block alert-danger">
                <p>
                    <strong>
                        <i class="ace-icon fa fa-check"></i>
                        B6: Tìm kiếm
                    </strong>
                </p>
                <p>
                    <a href="{{ URL::to('/search') }}"><button class="btn btn-sm btn-danger">Tìm kiếm<i class="ace-icon fa fa-arrow-right icon-on-right"></i></button></a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection