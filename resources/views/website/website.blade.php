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
            <form class="form-horizontal" role="form" method="post"<?php if (isset($web)) {
                echo ' action="' .BASE_URL.'/website/update/' . $web['_id'] . '""';
            } ?>>
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-select-1">Loại website</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="type" id="form-field-select-1">
                            <option value="" disabled selected>Lựa chọn</option>
                            <option value="shop"<?php echo isset($web['type']) && $web['type'] == 'shop' ? ' selected' : ''; ?>>Shop</option>
                            <option value="forum"<?php echo isset($web['type']) && $web['type'] == 'forum' ? ' selected' : ''; ?>>Forum</option>
                            {{--<option value="bh">Bán hàng</option>--}}
                            {{--<option value="rv">Rao vặt</option>--}}
                            {{--<option value="tt">Tin tức</option>--}}
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-select-1">Trạng thái</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="status" id="form-field-select-1">
                            <option value="1"<?php echo isset($web['status']) && $web['status'] == '1' ? ' selected' : ''; ?>>URL Seed</option>
                            <option value="2"<?php echo isset($web['status']) && $web['status'] == '2' ? ' selected' : ''; ?>>Frontier</option>
                            <option value="3"<?php echo isset($web['status']) && $web['status'] == '3' ? ' selected' : ''; ?>>Pattern Recognition</option>
                            <option value="4"<?php echo isset($web['status']) && $web['status'] == '4' ? ' selected' : ''; ?>>Extract Content</option>
                            <option value="5"<?php echo isset($web['status']) && $web['status'] == '5' ? ' selected' : ''; ?>>Recall & Precision</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-select-1">Ngôn ngữ</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="language" id="form-field-select-1">
                            <option value="" disabled selected>Lựa chọn</option>
                            <option value="vi"<?php echo isset($web['language']) && $web['language'] == 'vi' ? ' selected' : ''; ?>>Tiếng Việt</option>
                            <option value="en"<?php echo isset($web['language']) && $web['language'] == 'en' ? ' selected' : ''; ?>>Tiếng Anh</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tên website</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="form-field-1" placeholder="Ví dụ: FPT Shop" class="form-control"
                        value="<?php echo isset($web['name']) ? $web['name'] : ''; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Website URL</label>
                    <div class="col-sm-9">
                        <input type="text" name="url" id="form-field-1" placeholder="Ví dụ: http://fptshop.com.vn" class="form-control"
                               value="<?php echo isset($web['url']) ? $web['url'] : ''; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tên database tương ứng</label>
                    <div class="col-sm-9">
                        <input type="text" name="database" id="form-field-1" placeholder="Ví dụ: fptshopcomvn" class="form-control"
                               value="<?php echo isset($web['database']) ? $web['database'] : ''; ?>"/>
                    </div>
                </div>
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <?php if (isset($web)) { ?>
                        <button class="btn btn-yellow" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Sửa
                        </button>
                        <?php } else { ?>
                        <button class="btn btn-success" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Thêm
                        </button>
                        <?php } ?>
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
                        {{--<th class="center">Tên website</th>--}}
                        <th>URL</th>
                        <th>Tên database</th>
                        {{--<th><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i> Cập nhật lúc</th>--}}
                        <th>Trạng thái</th>
                        <th>Hot fix</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($website as $item)
                    <tr>
                        {{--<th class="center">{{ $item['name'] }}</th>--}}
                        <th>{{ $item['url'] }}</th>
                        <th>{{ $item['database'] }}</th>
                        {{--<th>{{ date('d/m/Y H:i A', $item['created_at']) }}</th>--}}
                        <th>
                            <?php
                            if (isset($item['status'])) {
                                switch ($item['status']) {
                                    case 1:
                                        echo '<span class="label label-success arrowed">URL Seed</span>';
                                        break;
                                    case 2:
                                        echo '<span class="label label-warning arrowed">Frontier</span>';
                                        break;
                                    case 3:
                                        echo '<span class="label label-danger arrowed">Pattern Recognition</span>';
                                        break;
                                    case 4:
                                        echo '<span class="label label-info arrowed">Extract Content</span>';
                                        break;
                                    case 5:
                                        echo '<span class="label label-purple arrowed">Recall & Precision</span>';
                                        break;
                                    default:
                                        echo '<span class="label label-success arrowed">URL Seed</span>';
                                        break;
                                }
                            } else {
                                echo '<span class="label label-success arrowed">URL Seed</span>';
                            }
                            ?>
                        </th>
                        <th>
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="green" href="{{ URL::to('/website/edit/' . $item['_id']) }}">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                                <a class="red" href="{{ URL::to('/website/delete/' . $item['_id']) }}">
                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </a>
                            </div>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection