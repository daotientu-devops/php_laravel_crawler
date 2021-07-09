@extends('...layouts.default')
@section('content')
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="">Bảng điều khiển</a>
        </li>
        <li>
            <a href="">Crawler</a>
        </li>
        <li class="active">Danh sách website hỗ trợ crawler</li>
    </ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
    <div class="page-header">
        <h1>
            Crawler
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Danh sách website hỗ trợ crawler
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="rơw">
        <div class="col-xs-5">
            <!-- PAGE CONTENT BEGINS -->
            <form class="form-horizontal" role="form" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-select-1">Loại website</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="type" id="form-field-select-1">
                            <option value="" disabled selected>Lựa chọn</option>
                            <option value="bh">Bán hàng</option>
                            <option value="rv">Rao vặt</option>
                            <option value="tt">Tin tức</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-select-1">Ngôn ngữ</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="language" id="form-field-select-1">
                            <option value="" disabled selected>Lựa chọn</option>
                            <option value="vi">Tiếng Việt</option>
                            <option value="en">Tiếng Anh</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tên website</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="form-field-1" placeholder="Ví dụ: FPT Shop" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Website URL</label>
                    <div class="col-sm-9">
                        <input type="text" name="url" id="form-field-1" placeholder="Ví dụ: http://fptshop.com.vn" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tên database tương ứng</label>
                    <div class="col-sm-9">
                        <input type="text" name="database" id="form-field-1" placeholder="Ví dụ: fptshopcomvn" class="form-control"/>
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
            <table id="simple-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="center">Chi tiết</th>
                        <th>Tên miền</th>
                        <th>Tên collection</th>
                        <th><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i> Cập nhật lúc</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection