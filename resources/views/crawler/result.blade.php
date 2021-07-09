@extends('layouts.top-menu')
@section('content')
<style type="text/css">
    div.left > div > div {width: 100%}
</style>
<div class="page-content">
    <div class="row">
        <div class="col-xs-6">
            <h4 class="header smaller lighter blue"><i class="ace-icon fa fa-bullhorn"></i> Thành phần đã xử lý</h4>
            <!-- PAGE CONTENT BEGINS -->
            <div class="well well-sm">
                Top menu can become any of the 3 mobile view menu styles:
                <em>default</em>
,
                <em>collapsible</em>
                or
                <em>minimized</em>.
            </div>
            <div class="left">
                <?php
                    $nbsp_content = str_replace("nbsp", '', $str_content);
                    $result = preg_split('/\s+|\//', strtolower($nbsp_content));
                ?>
                <strong>- Kết quả tách từ tố:</strong><br/>
                <?php
                    foreach ($result as $re) {
                        $re = preg_replace('/[^A-Za-z0-9$.\-]/', '', $re);
                        if ($re != '') echo $re . '<br/>';
                    }
                ?>
            </div>
            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
        <div class="col-xs-6">
            <h4 class="header smaller lighter green"><i class="ace-icon fa fa-bell"></i> Nội dung được trích chọn</h4>
            <!-- PAGE CONTENT BEGINS -->
            <div class="well well-sm">
                Top menu can become any of the 3 mobile view menu styles:
                <em>default</em>
,
                <em>collapsible</em>
                or
                <em>minimized</em>.
            </div>
            <div class="left">
                <u>URL đã crawl:</u> <a href="{{ $url_crawler }}" target="_blank"><strong>{{ $url_crawler }}</strong></a> <br/>
                <strong>Nội dung:</strong><br/>
                <?php echo html_entity_decode($content); ?>
                <br/>
                <strong>Văn bản:</strong>
                {{ $str_content }}
                <br/><br/>
                Tổng số từ: <strong>{{ count($result) }}</strong>
            </div>
            <!-- PAGE CONTENT ENDS -->
        </div>
    </div><!-- /.row -->
</div><!-- /.page-content -->
@endsection