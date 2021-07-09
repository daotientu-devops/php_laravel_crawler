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
<script src="{{ URL::to('assets/js/duplicateFields.min.js') }}"></script>
<script type="text/javascript">
    jQuery(function($) {
        $('#dynamic-table').DataTable({
            "order": [[ 2, "desc" ]]
        });
        $('#additional-field-model').duplicateElement({
            "class_remove": ".remove-this-field",
            "class_create": ".create-new-field"
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
                        <a data-toggle="tab" href="#mobile">
                            <i class="blue ace-icon fa fa-home bugger-120"></i>
                            Mobile
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#pc">
                            <i class="blue ace-icon fa fa-home bugger-120"></i>
                            PC
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
                    <div id="mobile" class="tab-pane fade in active">
                        <form class="form-horizontal" role="form" method="post" style="position: relative;">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            {{--<div class="form-group">--}}
                                {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-select-1">Website</label>--}}
                                {{--<div class="col-sm-9">--}}
                                    {{--<select class="form-control" name="website_id" id="form-field-select-1">--}}
                                        {{--<option value="" disabled selected>Lựa chọn</option>--}}
                                        {{--@foreach($website as $web)--}}
                                            {{--<option value="{{ $web['_id'] }}">{{ $web['name'] }}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label class="col-sm-3 control-label no-padding-right" for="form-field-select-1">Loại sản phẩm</label>--}}
                                {{--<div class="col-sm-9">--}}
                                    {{--<select class="form-control" name="cate_slug" id="form-field-select-1">--}}
                                        {{--<option value="" disabled selected>Lựa chọn</option>--}}
                                        {{--<option value="maytinhxachtay">Máy tính xách tay</option>--}}
                                        {{--<option value="dienthoai">Điện thoại</option>--}}
                                        {{--<option value="maytinhbang">Máy tính bảng</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <!--
                                Thông số kỹ thuật sản phẩm: Điện thoại
                            -->
<!-- Màn hình -->
                            <div class="control-group">
                                <label class="control-label bolder blue">Màn hình</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Công nghệ màn hình</label>
                                <div class="col-sm-8">
                                    <input type="text" name="screen_tech" id="form-field-1" placeholder="Ví dụ: PLS LCD" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Độ phân giải</label>
                                <div class="col-sm-8">
                                    <input type="text" name="resolution" id="form-field-1" placeholder="Ví dụ: 1080 x 1920 pixels" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Màn hình rộng</label>
                                <div class="col-sm-8">
                                    <input type="text" name="screen_width" id="form-field-1" placeholder="Ví dụ: 5.5'" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Cảm ứng</label>
                                <div class="col-sm-8">
                                    <input type="text" name="touch" id="form-field-1" placeholder="Ví dụ: Cảm ứng điện dung đa điểm" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Cảm ứng</label>
                                <div class="col-sm-8">
                                    <input type="text" name="touch" id="form-field-1" placeholder="Ví dụ: Cảm ứng điện dung đa điểm" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Mặt kính cảm ứng</label>
                                <div class="col-sm-8">
                                    <input type="text" name="touch_glass" id="form-field-1" placeholder="Ví dụ: Kính cường lực Gorilla Glass 4" class="form-control"/>
                                </div>
                            </div>
<!-- Camera sau -->
                            <div class="control-group">
                                <label class="control-label bolder blue">Camera sau</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Độ phân giải</label>
                                <div class="col-sm-8">
                                    <input type="text" name="camera_s" id="form-field-1" placeholder="Ví dụ: 13 MP" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Quay phim</label>
                                <div class="col-sm-8">
                                    <input type="text" name="film_s" id="form-field-1" placeholder="Ví dụ: Quay phim FullHD 1080p@30fps" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Chụp ảnh nâng cao</label>
                                <div class="col-sm-8">
                                    <input type="text" name="capture_advance" id="form-field-1" placeholder="Ví dụ: Gắn thẻ địa lý, Tự động lấy nét, Chạm lấy nét, Nhận diện khuôn mặt, HDR, Panorama, Chế độ chụp chuyên nghiệp" class="form-control"/>
                                </div>
                            </div>
<!-- Camera trước -->
                            <div class="control-group">
                                <label class="control-label bolder blue">Camera trước</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Độ phân giải</label>
                                <div class="col-sm-8">
                                    <input type="text" name="camera_t" id="form-field-1" placeholder="Ví dụ: 8 MP" class="form-control"/>
                                </div>
                            </div>
<!-- Hệ điều hành - CPU -->
                            <div class="control-group">
                                <label class="control-label bolder blue">Hệ điều hành - CPU</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Hệ điều hành</label>
                                <div class="col-sm-8">
                                    <input type="text" name="os" id="form-field-1" placeholder="Ví dụ: Android 6.0 (Marshmallow)" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Chipset (hãng SX CPU)</label>
                                <div class="col-sm-8">
                                    <input type="text" name="chipset" id="form-field-1" placeholder="Ví dụ: Exynos 7870 8 nhân 64-bit" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Tốc độ CPU</label>
                                <div class="col-sm-8">
                                    <input type="text" name="cpu_speed" id="form-field-1" placeholder="Ví dụ: 1.6 GHz" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Chip đồ họa (GPU)</label>
                                <div class="col-sm-8">
                                    <input type="text" name="gpu" id="form-field-1" placeholder="Ví dụ: Mali-T830" class="form-control"/>
                                </div>
                            </div>
<!-- Bộ nhớ & Lưu trữ -->
                            <div class="control-group">
                                <label class="control-label bolder blue">Bộ nhớ & Lưu trữ</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">RAM</label>
                                <div class="col-sm-8">
                                    <input type="text" name="ram" id="form-field-1" placeholder="Ví dụ: 3 GB" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Bộ nhớ trong (ROM)</label>
                                <div class="col-sm-8">
                                    <input type="text" name="rom" id="form-field-1" placeholder="Ví dụ: 32 GB" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Thẻ nhớ ngoài</label>
                                <div class="col-sm-8">
                                    <input type="text" name="card" id="form-field-1" placeholder="Ví dụ: MicroSD" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Hỗ trợ thẻ tối đa</label>
                                <div class="col-sm-8">
                                    <input type="text" name="card_memory" id="form-field-1" placeholder="Ví dụ: 256 GB" class="form-control"/>
                                </div>
                            </div>
<!-- Kết nối -->
                            <div class="control-group">
                                <label class="control-label bolder blue">Kết nối</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Băng tần 2G</label>
                                <div class="col-sm-8">
                                    <input type="text" name="2G" id="form-field-1" placeholder="Ví dụ: GSM 850/900/1800/1900" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Băng tần 3G</label>
                                <div class="col-sm-8">
                                    <input type="text" name="3G" id="form-field-1" placeholder="Ví dụ: HSDPA" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Số khe sim</label>
                                <div class="col-sm-8">
                                    <input type="text" name="sim_slot" id="form-field-1" placeholder="Ví dụ: 2 SIM" class="form-control"/>
                                </div>
                            </div>
<!-- Thiết kế & Trọng lượng -->
                            <div class="control-group">
                                <label class="control-label bolder blue">Thiết kế & Trọng lượng</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Chất liệu</label>
                                <div class="col-sm-8">
                                    <input type="text" name="metal" id="form-field-1" placeholder="Ví dụ: Hợp kim nhôm" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Dài</label>
                                <div class="col-sm-8">
                                    <input type="text" name="length" id="form-field-1" placeholder="Ví dụ: 151.5 mm" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Ngang</label>
                                <div class="col-sm-8">
                                    <input type="text" name="width" id="form-field-1" placeholder="Ví dụ: 74.9 mm" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Dày</label>
                                <div class="col-sm-8">
                                    <input type="text" name="height" id="form-field-1" placeholder="Ví dụ: 8.1 mm" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Trọng lượng</label>
                                <div class="col-sm-8">
                                    <input type="text" name="weight" id="form-field-1" placeholder="Ví dụ: 167 g" class="form-control"/>
                                </div>
                            </div>
<!-- Thông tin pin -->
                            <div class="control-group">
                                <label class="control-label bolder blue">Thiết kế & Trọng lượng</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Dung lượng pin</label>
                                <div class="col-sm-8">
                                    <input type="text" name="battery_capacity" id="form-field-1" placeholder="Ví dụ: 3300 mAh" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Loại pin</label>
                                <div class="col-sm-8">
                                    <input type="text" name="battery_type" id="form-field-1" placeholder="Ví dụ: Pin chuẩn Li-Ion" class="form-control"/>
                                </div>
                            </div>
<!-- to be continued ... -->
                            <div id="additional-field-model" class="form-group">
                                <div class="col-md-4 text-left">
                                    <label class="col-md-12 control-label" for="field-a" style="text-align: left; padding-left: 0">Thuộc tính</label>
                                    <div class="input-group">
                                        <input id="attr[]" name="attr[]" type="text" placeholder="" class="form-control input-md" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-5 text-left">
                                    <label class="col-md-12 control-label" for="field-b" style="text-align: left; padding-left: 0">Giá trị</label>
                                    <div class="input-group">
                                        <input id="val[]" name="val[]" type="text" placeholder="" class="form-control input-md" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-3 text-right">
                                    <label class="col-xs-12 control-label" for="field-c"><br /></label>
                                    <a href="javascript:void(0);"  class="btn btn-danger remove-this-field">
                                        <i class="fa fa-remove"></i>
                                        <span class="hidden-xs"> Xóa </span>
                                    </a>
                                    <a href="javascript:void(0);"  class="btn btn-success create-new-field">
                                        <i class="fa fa-plus"></i>
                                        <span class="hidden-xs"> Thêm </span>
                                    </a>
                                </div>
                            </div>

                            <div class="form-group clearfix form-actions" style="position: fixed; bottom: -20px; z-index: 111; width:35%">
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
                    <!--
                        Máy tính
                    -->
                    <div id="pc" class="tab-pane fade">
                        <form class="form-horizontal" role="form" method="post" style="position: relative;">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
<!-- Bộ xử lý -->
                            <div class="control-group">
                                <label class="control-label bolder blue">Bộ xử lý</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Hãng CPU</label>
                                <div class="col-sm-9">
                                    <input type="text" name="cpu_company" id="form-field-1" placeholder="Ví dụ: Intel" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Công nghệ CPU</label>
                                <div class="col-sm-9">
                                    <input type="text" name="cpu_technology" id="form-field-1" placeholder="Ví dụ: Core i7 Haswell" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Loại CPU</label>
                                <div class="col-sm-9">
                                    <input type="text" name="cpu_type" id="form-field-1" placeholder="Ví dụ: 4770HQ" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tốc độ CPU</label>
                                <div class="col-sm-9">
                                    <input type="text" name="cpu_speed" id="form-field-1" placeholder="Ví dụ:  2.20 GHz" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bộ nhớ đệm</label>
                                <div class="col-sm-9">
                                    <input type="text" name="cache_memory" id="form-field-1" placeholder="Ví dụ: Intel® Smart Cache, 6 MB" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tốc độ tối đa</label>
                                <div class="col-sm-9">
                                    <input type="text" name="max_speed" id="form-field-1" placeholder="Ví dụ: Turbo Boost 3.4 GHz" class="form-control"/>
                                </div>
                            </div>
<!-- Bo mạch -->
                            <div class="control-group">
                                <label class="control-label bolder blue">Bo mạch</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Chipset</label>
                                <div class="col-sm-9">
                                    <input type="text" name="chipset" id="form-field-1" placeholder="Ví dụ: Intel® HM 8 series Express Chipset" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tốc độ Bus</label>
                                <div class="col-sm-9">
                                    <input type="text" name="bus_speed" id="form-field-1" placeholder="Ví dụ: 1600 MHz" class="form-control"/>
                                </div>
                            </div>
<!-- Bộ nhớ -->
                            <div class="control-group">
                                <label class="control-label bolder blue">Bộ nhớ</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">RAM</label>
                                <div class="col-sm-9">
                                    <input type="text" name="ram" id="form-field-1" placeholder="Ví dụ: 16 GB" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Loại RAM</label>
                                <div class="col-sm-9">
                                    <input type="text" name="ram_type" id="form-field-1" placeholder="Ví dụ: DDR3L(On board)" class="form-control"/>
                                </div>
                            </div>
<!-- Đĩa cứng -->
                            <div class="control-group">
                                <label class="control-label bolder blue">Đĩa cứng</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Loại ổ đĩa</label>
                                <div class="col-sm-9">
                                    <input type="text" name="disk_type" id="form-field-1" placeholder="Ví dụ: SSD" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Ổ cứng</label>
                                <div class="col-sm-9">
                                    <input type="text" name="disk_memory" id="form-field-1" placeholder="Ví dụ: 256 GB" class="form-control"/>
                                </div>
                            </div>
<!-- Màn hình -->
                            <div class="control-group">
                                <label class="control-label bolder blue">Màn hình</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Kích thước màn hình</label>
                                <div class="col-sm-8">
                                    <input type="text" name="screen_size" id="form-field-1" placeholder="Ví dụ: 15.4 inch" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Độ phân giải (W x H)</label>
                                <div class="col-sm-8">
                                    <input type="text" name="resolution" id="form-field-1" placeholder="Ví dụ: Retina (2880 x 1800 pixels)" class="col-xs-10 col-sm-9"/>
                                    <span class="help-inline col-xs-12 col-sm-3">
                                        <span class="middle">pixels</span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Kích thước màn hình</label>
                                <div class="col-sm-8">
                                    <input type="text" name="screen_size" id="form-field-1" placeholder="Ví dụ: 15.4 inch" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Độ phân giải (W x H)</label>
                                <div class="col-sm-8">
                                    <input type="text" name="resolution" id="form-field-1" placeholder="Ví dụ: Retina (2880 x 1800 pixels)" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Công nghệ màn hình</label>
                                <div class="col-sm-8">
                                    <input type="text" name="screen_technology" id="form-field-1" placeholder="Ví dụ: Công nghệ IPS, LED Backlit" class="form-control"/>
                                </div>
                            </div>
<!-- Đồ họa -->
                            <div class="control-group">
                                <label class="control-label bolder blue">Đồ họa</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Chipset đồ họa</label>
                                <div class="col-sm-9">
                                    <input type="text" name="graphic_chipset" id="form-field-1" placeholder="Ví dụ: Intel® Iris™ Pro Graphics 5200" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bộ nhớ đồ họa</label>
                                <div class="col-sm-9">
                                    <input type="text" name="graphic_memory" id="form-field-1" placeholder="Ví dụ: Share (Dùng chung bộ nhớ với RAM)" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Thiết kế card</label>
                                <div class="col-sm-9">
                                    <input type="text" name="graphic_card" id="form-field-1" placeholder="Ví dụ: Card đồ họa tích hợp" class="form-control"/>
                                </div>
                            </div>
<!-- PIN/Battery -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Dung lượng pin</label>
                                <div class="col-sm-9">
                                    <input type="text" name="battery_duration" id="form-field-1" placeholder="Ví dụ: Khoảng 9 tiếng" class="form-control"/>
                                </div>
                            </div>
<!-- Hệ điều hành, phần mềm sẵn có/OS -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Hệ điều hành</label>
                                <div class="col-sm-9">
                                    <input type="text" name="os" id="form-field-1" placeholder="Ví dụ: Mac OS" class="form-control"/>
                                </div>
                            </div>
<!-- Thiết kế & Trọng lượng -->
                            <div class="control-group">
                                <label class="control-label bolder blue">Thiết kế & Trọng lượng</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Chất liệu</label>
                                <div class="col-sm-8">
                                    <input type="text" name="material" id="form-field-1" placeholder="Ví dụ: Vỏ kim loại nguyên khối" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Dài</label>
                                <div class="col-sm-8">
                                    <input type="text" name="length" id="form-field-1" placeholder="Ví dụ: 358.9 mm" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Ngang</label>
                                <div class="col-sm-8">
                                    <input type="text" name="width" id="form-field-1" placeholder="Ví dụ: 247.1 mm" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Dày</label>
                                <div class="col-sm-8">
                                    <input type="text" name="height" id="form-field-1" placeholder="Ví dụ: 18 mm" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Trọng lượng</label>
                                <div class="col-sm-8">
                                    <input type="text" name="weight" id="form-field-1" placeholder="Ví dụ: 2.04 kg" class="form-control"/>
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