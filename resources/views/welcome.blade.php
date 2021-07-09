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
        <li class="active">Bước 1: Crawler Url</li>
    </ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
    <div class="page-header">
        <h1>
            Bước 1: Crawler Url
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Lấy danh sách url theo site
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="rơw">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <form class="form-horizontal" role="form" method="post" action="{{ URL::to('/crawl_page') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-select-1"> Loại sản phẩm </label>
                    <div class="col-sm-3">
                        <select class="form-control" name="type_product" id="form-field-select-1">
                            <option value="dienthoai">Điện thoại</option>
                            <option value="maytinh">Máy tính</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> URL </label>
                    <div class="col-sm-9">
                        <input type="text" name="url" id="form-field-1" placeholder="Nhập vào url ..." class="form-control"/>
                    </div>
                </div>
                {{--<div class="form-group">--}}
                    {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Độ sâu </label>--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<input type="number" name="depth" id="form-field-2" class="col-sm-2" min="1"/>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-3"> Query phân trang </label>
                    <div class="col-sm-9">
                        <input type="text" name="page" id="form-field-3" placeholder="?p=" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Lọc theo đuôi url </label>
                    <div class="col-sm-9">
                        <input type="text" name="html_ext" id="form-field-2" class="form-control" placeholder=".html"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Số trang tối đa </label>
                    <div class="col-sm-9">
                        <input type="number" name="max_page" id="form-field-2" class="col-sm-2" min="1" value="1"/>
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
                        <a href="/icrawler/public/crawler_data" class="btn btn-success" type="button">
                            Xem kết quả
                            <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
