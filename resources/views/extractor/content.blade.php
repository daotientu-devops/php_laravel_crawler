@extends('layouts.default')
@section('content')
<?php
$content_tag = isset($content_tag) ? $content_tag : '';
?>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="{{ URL::to('/') }}">Bảng điều khiển</a>
        </li>
        <li>
            <a>Crawler</a>
        </li>
        <li class="active">Extract content</li>
    </ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
    <div class="page-header">
        <h1>
            Extract content
        </h1>
    </div><!-- /.page-header -->
    <div class="rơw">
        <div class="col-xs-4">
            <!-- PAGE CONTENT BEGINS -->
            <form class="form-horizontal" role="form" method="post" action="<?php echo URL::to('/extract_content' . (isset($content_tag) && $content_tag != '' ? '/edit/' . $content_tag['_id']  : '')); ?>">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-select-1">Loại website</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="form-field-select-1" name="website_type">
                            <option value="shop" <?php echo isset($content_tag['website_type']) && $content_tag['website_type']=='shop' ? 'selected' : ''; ?>>Shop</option>
                            <option value="forum" <?php echo isset($content_tag['website_type']) && $content_tag['website_type']=='forum' ? 'selected' : ''; ?>>Forum</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Website (Domain)</label>
                    <div class="col-sm-9">
                        <input type="text" id="form-field-1" class="form-control" placeholder="Ví dụ: thamhue.com" name="domain"
                               value="<?php echo isset($content_tag['website_domain']) ? $content_tag['website_domain'] : ''; ?>"
                        >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-select-1">Loại sản phẩm</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="form-field-select-1" name="product_type">
                            <option value="0">Chung</option>
                            <?php foreach ($product_type as $item) { ?>
                            <option value="<?php echo $item['_id']; ?>" <?php echo isset($content_tag['product_type']) && $content_tag['product_type']==$item['_id'] ? 'selected' : ''; ?>>{{ $item['product_category'] }}</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Giới thiệu</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="form-field-2" placeholder="Thăm huế kênh mua bán rao vặt uy tín Huế miền trung" name="intro">
                            <?php echo isset($content_tag['intro']) ? $content_tag['intro'] : ''; ?>
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-3">Tên database</label>
                    <div class="col-sm-9">
                        <input type="text" id="form-field-3" class="form-control" placeholder="Ví dụ: db_thamhuecom" name="database_name"
                               value="<?php echo isset($content_tag['database_name']) ? $content_tag['database_name'] : ''; ?>"
                        <?php echo isset($content_tag['database_name']) ? 'disabled' : ''; ?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-4">Thẻ tiêu đề</label>
                    <div class="col-sm-9">
                        <input type="text" id="form-field-4" class="form-control" placeholder="Ví dụ: .threadtitle" name="title_tag"
                               value="<?php echo isset($content_tag['title_tag']) ? $content_tag['title_tag'] : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-5">Thẻ nội dung</label>
                    <div class="col-sm-9">
                        <input type="text" id="form-field-5" class="form-control" placeholder="Ví dụ: .content" name="content_tag"
                               value="<?php echo isset($content_tag['content_tag']) ? $content_tag['content_tag'] : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-6">Thẻ định giá (sp)</label>
                    <div class="col-sm-9">
                        <input type="text" id="form-field-6" class="form-control" placeholder="Ví dụ: (empty)" name="price_tag"
                               value="<?php echo isset($content_tag['price_tag']) ? $content_tag['price_tag'] : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-7">Thẻ số điện thoại liên hệ</label>
                    <div class="col-sm-9">
                        <input type="text" id="form-field-7" class="form-control" placeholder="Ví dụ: (empty)" name="telephone_tag"
                               value="<?php echo isset($content_tag['telephone_tag']) ? $content_tag['telephone_tag'] : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-8">Thẻ người liên hệ</label>
                    <div class="col-sm-9">
                        <input type="text" id="form-field-8" class="form-control" placeholder="Ví dụ: .username strong" name="info_tag"
                               value="<?php echo isset($content_tag['info_tag']) ? $content_tag['info_tag'] : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-9">Thẻ địa chỉ liên hệ</label>
                    <div class="col-sm-9">
                        <input type="text" id="form-field-9" class="form-control" placeholder="Ví dụ: (empty)" name="contact_tag"
                               value="<?php echo isset($content_tag['contact_tag']) ? $content_tag['contact_tag'] : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-10">Thẻ thời gian đăng tin</label>
                    <div class="col-sm-9">
                        <input type="text" id="form-field-10" class="form-control" placeholder="Ví dụ: .lastedited .date" name="publish_time_tag"
                               value="<?php echo isset($content_tag['publish_time_tag']) ? $content_tag['publish_time_tag'] : ''; ?>">
                    </div>
                </div>
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-sm btn-success" type="submit">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            <?php echo isset($content_tag) && $content_tag != '' ? 'Sửa' : 'Thêm'; ?>
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
            <table id="simple-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên database</th>
                        <th>Loại sản phẩm</th>
                        <th>Loại website</th>
                        <th>Thẻ tiêu đề</th>
                        <th>Thẻ nội dung</th>
                        <th>Thẻ định giá (sp)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = ($currentpage == 1) ? 0 : ($currentpage - 1) * 10;  ?>
                    @foreach ($dataSet['dataset'] as $item)
                        <?php $i++; ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item['database_name'] }}</td>
                            <td>
                                <?php foreach ($product_type as $pro) {
                                    if (isset($item['product_type']) && $pro['_id'] == $item['product_type']) { ?>
                                        <?php echo $pro['product_category']; ?>
                                    <?php } else { ?>
                                <?php } }
                                    if (!isset($item['product_type'])) {
                                        echo 'Chung';
                                    }
                                ?>
                            </td>
                            <td>
                            <span class="label {{ ($item['website_type']!='shop')?'label-success':'label-danger' }} middle">
                                {{ ($item['website_type']=='forum') ? 'rao vặt' : $item['website_type'] }}
                            </span>
                            </td>
                            <td>{{ $item['title_tag'] }}</td>
                            <td>{{ $item['content_tag'] }}</td>
                            <td>{{ $item['price_tag'] }}</td>
                            <td><a href="{{ URL::to('/extract_content/' . $currentpage . '/edit/' . $item['_id']) }}">Sửa</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <?php echo isset($page_links) ? $page_links : ''; ?>
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
@endsection