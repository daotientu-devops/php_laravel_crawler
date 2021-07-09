@extends('layouts.default')
@section('content')
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="">Bảng điều khiển</a>
        </li>
        <li>
            <a href="">Data Extractor</a>
        </li>
        <li class="active">Thẻ lấy nội dung</li>
    </ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
    <div class="page-header">
        <h1>
            Data Extractor
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Thẻ lấy nội dung
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="rơw">
        <div class="col-xs-5">
            <!-- PAGE CONTENT BEGINS -->
            <form class="form-horizontal" role="form" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-select-1">Website</label>
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
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Thẻ tiêu đề</label>
                    <div class="col-sm-9">
                        <input type="text" name="title_tag" id="form-field-1" placeholder="Ví dụ: h1.title_post" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Thẻ tóm tắt</label>
                    <div class="col-sm-9">
                        <input type="text" name="summary_tag" id="form-field-1" placeholder="Ví dụ: h2.lead_post_detail row" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Thẻ nội dung</label>
                    <div class="col-sm-9">
                        <input type="text" name="content_tag" id="form-field-1" placeholder="Ví dụ: div.main_fck_detail" class="form-control"/>
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
                        <th>Website</th>
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