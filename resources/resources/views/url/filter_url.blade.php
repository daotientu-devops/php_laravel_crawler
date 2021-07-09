@extends('layouts.default')
@section('content')
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="{{ URL::to('/') }}">Bảng điều khiển</a>
        </li>
        <li>
            <a>Crawler</a>
        </li>
        <li class="active">Lọc URL</li>
    </ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
    <div class="page-header">
        <h1>
            Lọc URL
        </h1>
    </div><!-- /.page-header -->
    <div class="rơw">
        <div class="col-xs-5">
            <!-- PAGE CONTENT BEGINS -->
            <form class="form-horizontal" role="form" method="post" action="{{ URL::to('/filter_url') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Website</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="form-field-1" name="website">
                        @foreach ($database as $data)
                            <option value="{{ $data }}">{{ $data }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">URL lọc bỏ</label>
                    <div class="col-sm-9">
                        <input type="text" id="form-field-2" class="form-control" placeholder="Ví dụ: https://www.thegioididong.com/javascript:ShowMoreFooterSupportLink()" name="filter_url">
                    </div>
                </div>
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-sm btn-success" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Thêm
                        </button>
                        &nbsp;&nbsp;&nbsp;
                        <button class="btn btn-sm" type="reset">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            Nhập lại
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-xs-7">
            <table id="simple-table" class="table table-hover">
                <thead>
                    <tr>
                        <th>URL lọc bỏ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataSet['dataset'] as $item)
                        <tr>
                            <td>{{ $item['filter_url'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <?php echo isset($page_links) ? $page_links : ''; ?>
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
@endsection