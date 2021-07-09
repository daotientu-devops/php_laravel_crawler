@extends('...layouts.default')
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
        $('#dynamic-table').DataTable({
            "order": [[ 2, "desc" ]]
        });
    });
</script>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="">Bảng điều khiển</a>
        </li>
        <li>
            <a href="">Crtawler</a>
        </li>
        <li class="active">Danh sách sản phẩm</li>
    </ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
    <div class="page-header">
        <h1>
            Crawler
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Danh sách sản phẩm
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="rơw">
        <div class="col-xs-5">
            <!-- PAGE CONTENT BEGINS -->
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#banhang">
                            <i class="blue ace-icon fa fa-home bugger-120"></i>
                            Tự nhập
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#raovat">
                            <i class="red ace-icon fa fa-bullhorn bigger-120"></i>
                            Tag (hiện tại hỗ trợ trang nhật tảo)
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="banhang" class="tab-pane fade in active">
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
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-select-1">Loại sản phẩm</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="cate_slug" id="form-field-select-1">
                                        <option value="" disabled selected>Lựa chọn</option>
                                        <option value="maytinhxachtay">Máy tính xách tay</option>
                                        <option value="dienthoai">Điện thoại</option>
                                        <option value="maytinhbang">Máy tính bảng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tên hãng</label>
                                <div class="col-sm-9">
                                    <input type="text" name="store" id="form-field-1" placeholder="Ví dụ: Windows Phone" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tên sản phẩm</label>
                                <div class="col-sm-9">
                                    <input type="text" name="product_name" id="form-field-1" placeholder="Ví dụ: Nokia Lumia" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Slug</label>
                                <div class="col-sm-9">
                                    <input type="text" name="product_slug" id="form-field-1" placeholder="Ví dụ: nokia-lumia" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Phiên bản</label>
                                <div class="col-sm-9">
                                    <input type="text" name="version" id="form-field-1" placeholder="Ví dụ: 650" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Màu sắc</label>
                                <div class="col-sm-9">
                                    <input type="text" name="color" id="form-field-1" placeholder="Ví dụ: Bạc" class="form-control"/>
                                </div>
                            </div>
                            <div class="hr hr-16 hr-dashed"></div>
<!--
    Thông số kỹ thuật sản phẩm: Điện thoại
-->
                            <div class="control-group">
                                <label class="control-label bolder blue">Điện thoại</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Hệ điều hành</label>
                                <div class="col-sm-9">
                                    <input type="text" name="os" id="form-field-1" placeholder="Ví dụ: Windows 10" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bộ nhớ</label>
                                <div class="col-sm-9">
                                    <input type="text" name="memory" id="form-field-1" placeholder="Ví dụ: 32 GB" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Dung lượng pin</label>
                                <div class="col-sm-9">
                                    <input type="text" name="battery_capacity" id="form-field-1" placeholder="Ví dụ: 3600 mAh" class="form-control"/>
                                </div>
                            </div>
<!--
    Thông số kỹ thuật sản phẩm: Máy tính
-->
                            <div class="hr hr-16 hr-dashed"></div>
                            <div class="control-group">
                                <label class="control-label bolder blue">Máy tính</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Công nghệ CPU</label>
                                <div class="col-sm-9">
                                    <input type="text" name="cpu_technology" id="form-field-1" placeholder="Ví dụ: Core i3 Broadwell" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bộ nhớ RAM</label>
                                <div class="col-sm-9">
                                    <input type="text" name="ram" id="form-field-1" placeholder="Ví dụ: 4 GB" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Loại ổ cứng</label>
                                <div class="col-sm-9">
                                    <input type="text" name="disk_type" id="form-field-1" placeholder="Ví dụ: HDD" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Dung lượng ổ cứng</label>
                                <div class="col-sm-9">
                                    <input type="text" name="disk_capacity" id="form-field-1" placeholder="Ví dụ: 500 GB" class="form-control"/>
                                </div>
                            </div>
<!-- to be continued ... -->
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
                    <div id="raovat" class="tab-pane fade">
                        <!-- FORM CRAWL TAG -->
                        <form class="form-horizontal" role="form" method="post" action="{{ URL::to('/get_tag_product') }}">
                            {!! csrf_field() !!}
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
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">URL lấy tên sản phẩm</label>
                                <div class="col-sm-9">
                                    <input type="text" name="product_url" id="form-field-1" placeholder="Ví dụ: https://nhattao.com/t" class="form-control"/>
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
                </div>
            </div>
        </div>
        <div class="col-xs-7">
            <table id="dynamic-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Slug</th>
                        <th><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i> Cập nhật lúc</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                        <tr>
                            <td>{{ $d['product_name'] }}</td>
                            <td>{{ $d['product_slug'] }}</td>
                            <td>{{ date('d/m/Y H:i', $d['created_at']) }}</td>
                            <td>
                                <div class="hidden-sm hidden-xs btn-group">
                                    <a href="{{ URL::to('product/delete/' . $d['_id']) }}"><button class="btn btn-xs btn-danger">
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
</div>
@endsection