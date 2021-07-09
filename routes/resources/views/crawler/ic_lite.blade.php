@extends('layouts.default')
@section('content')
<!-- page specific plugin styles -->
<link rel="stylesheet" href="assets/css/select2.min.css" />
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="#">Bảng điều khiển</a>
        </li>

        <li>
            <a href="#">IC Lite</a>
        </li>
        <li class="active">Wizard</li>
    </ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
    <div class="page-header">
        <h1>
            IC Lite
        </h1>
    </div><!-- /.page-header -->
    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box">
                <div class="widget-header widget-header-blue widget-header-flat">
                    <h4 class="widget-title lighter">Truy hồi thông tin</h4>
                    <div class="widget-toolbar">
                        <label>
                            <small class="red">
                                <b>Điền đầy đủ thông tin vào form</b>
                            </small>
                        </label>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div id="wizard-container">
                            <form class="form-horizontal" id="sample-form" method="post">
                            {!! csrf_field() !!}
                            <div class="pos-rel">
                                <div class="step-pane" data-step="1">
                                    <h5 class="lighter block green" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif">11. Viết chương trình đánh chỉ mục (không kèm theo vị trí xuất hiện trong trang web)
                                                                    cho các trang web tiếng Anh theo giải thuật được trình bày ở mục 3.5, trong đó có
                                                                    các module: tách nội dung chính từ trang web, tách từ tố, chuẩn hóa từ tố (biến
                                                                    tất cả thành chữ thường)</h5>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Chọn website cần crawl</label>
                                        <div class="col-xs-12 col-sm-9">
                                            <select id="website_id" name="website_id" class="select2" data-placeholder="Click to Choose...">
                                                <option value="" disabled>&nbsp;</option>
                                                @foreach($website as $web)
                                                    <option value="{{ $web['_id'] }}">{{ $web['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="phone">Nhập URL cần crawl</label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="ace-icon fa fa-link"></i>
                                                </span>
                                                <input type="text" id="url_crawler" name="url_crawler" class="width-100" placeholder="Ví dụ: http://edition.cnn.com/2016/11/12/politics/hillary-clinton-james-comey-fbi/index.html" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr />
                            <div class="wizard-actions">
                                <button type="reset" class="btn btn-prev">
                                    <i class="ace-icon fa fa-arrow-left"></i>
                                    Nhập lại
                                </button>

                                <button type="submit" class="btn btn-success btn-next" data-last="Finish">
                                    Đánh chỉ mục
                                    <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                </button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page specific plugin scripts -->
<script src="assets/js/wizard.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/select2.min.js"></script>
<!-- inline scripts related to this page -->
<script type="text/javascript">
jQuery(function($) {

    $('.select2').css('width','200px').select2({allowClear:true})
    				.on('change', function(){
    					$(this).closest('form').validate().element($(this));
    				});

    var $validation = false;
    $('#fuelux-wizard-container')
    .ace_wizard({
        //step: 2 //optional argument. wizard will jump to step "2" at first
        //buttons: '.wizard-actions:eq(0)'
    })
    .on('actionclicked.fu.wizard' , function(e, info){
        if(info.step == 1 && $validation) {
            if(!$('#validation-form').valid()) e.preventDefault();
        }
    })
    //.on('changed.fu.wizard', function() {
    //})
    .on('finished.fu.wizard', function(e) {
        bootbox.dialog({
            message: "Thank you! Your information was successfully saved!",
            buttons: {
                "success" : {
                    "label" : "OK",
                    "className" : "btn-sm btn-primary"
                }
            }
        });
    }).on('stepclick.fu.wizard', function(e){
        //e.preventDefault();//this will prevent clicking and selecting steps
    });
});
</script>
@endsection