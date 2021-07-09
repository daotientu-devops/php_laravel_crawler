@extends('layouts.default')
@section('content')
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="">Bảng điều khiển</a>
        </li>
        <li>
            <a href="">Danh sách website hỗ trợ crawler</a>
        </li>
        <li class="active">Từ khóa đặc trưng sản phẩm</li>
    </ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
    <div class="page-header">
        <h1>
            Từ khóa đặc trưng
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Theo sản phẩm (mt: máy tính, đt: điện thoại)
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="rơw">
        <div class="col-xs-5">
            <!-- PAGE CONTENT BEGINS -->
            <form class="form-horizontal" role="form" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tên sản phẩm</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="product_type" id="form-field-select-1">
                            <option value="" disabled selected>Lựa chọn</option>
                            <option value="mt">Máy tính - Laptop</option>
                            <option value="đt">Điện thoại - Smartphone</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Lấy danh sách từ khóa qua URL</label>
                    <div class="col-sm-9">
                        <input type="text" name="tag_url" id="form-field-1" placeholder="Ví dụ: https://nhattao.com/t/" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tên từ khóa</label>
                    <div class="col-sm-9">
                        <input type="text" name="keyword_name" id="form-field-1" placeholder="Ví dụ: iphone X" class="form-control"/>
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
                        <th>Tên từ khóa</th>
                        <th>Sản phẩm</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product_keyword as $item)
                        <tr>
                            <th>{{ $item['keyword_name'] }}</th>
                            <th>{{ $item['product_type'] }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection