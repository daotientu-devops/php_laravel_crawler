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
        <li class="active">Phân loại trạng thái sản phẩm</li>
    </ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
    <div class="page-header">
        <h1>
            Phân loại trạng thái sản phẩm
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Theo sản phẩm
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="rơw">
        <div class="col-xs-5">
            <!-- PAGE CONTENT BEGINS -->
            <form class="form-horizontal" role="form" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Trạng thái</label>
                    <div class="col-sm-9">
                        <input type="text" name="state" id="form-field-1" placeholder="Ví dụ: mới | cũ" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Từ viết tắt</label>
                    <div class="col-sm-9">
                        <input type="text" name="acronym" id="form-field-1" placeholder="Ví dụ: new | old" class="form-control"/>
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
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection