@extends('layouts.default')
@section('content')
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="">Bảng điều khiển</a>
        </li>
        <li>
            <a href="">Thu thập dữ liệu</a>
        </li>
        <li class="active">Tách nội dung trang đơn</li>
    </ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
    <div class="page-header">
        <h1>
            Thu thập dữ liệu
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Tách nội dung trang đơn
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="rơw">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <form class="form-horizontal" role="form" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-select-1">Website hỗ trợ</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="website_id" id="form-field-select-1">
                            <option value="" disabled selected>Lựa chọn</option>
                            @foreach($website as $web)
                                <option value="{{ $web['_id'] }}">{{ $web['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> URL </label>
                    <div class="col-sm-9">
                        <input type="text" name="url" id="form-field-1" placeholder="Nhập vào url ..." class="form-control"/>
                    </div>
                </div>
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Crawl
                        </button>
                        &nbsp;&nbsp;&nbsp;
                        <button class="btn" type="reset">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            Nhập lại
                        </button>
                        &nbsp;&nbsp;&nbsp;
                        <button class="btn btn-success" type="button">
                            Xem kết quả
                            <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
