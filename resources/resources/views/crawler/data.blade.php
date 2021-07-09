@extends('layouts.default')
@section('content')
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="">Bảng điều khiển</a>
        </li>
        <li>
            <a href="">Thu thập dữ liệu</a>
        </li>
        <li class="active">Bước 2: Crawler dữ liệu</li>
    </ul><!-- /.breadcrumb -->
</div>
<div class="page-content">
    <div class="page-header">
        <h1>
            Bước 2: Crawler dữ liệu
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Lấy dữ liệu theo site
            </small>
        </h1>
    </div><!-- /.page-header -->
    <div class="rơw">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
                <div class="col-zs-12">
                    <table id="simple-table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Database</th>
                                <th>Collection</th>
                                <th>Đã crawl</th>
                                <th>Chưa crawl</th>
                                <th>/</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($database as $data)
                                <tr>
                                    <td rowspan="2" style="vertical-align: middle">{{ $data }}</td>
                                    <td>dienthoai</td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="hidden-sm hidden-xs btn-group">
                                            <a href="/icrawler/public/crawler_data/{{ $data }}/dienthoai" title="Lấy thông tin">
                                                <button class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-download bigger-120"></i> Lấy thông tin
                                                </button>
                                            </a>
                                            <a href="/icrawler/public/evaluate_data/{{ $data }}/dienthoai" title="Đánh giá collection">
                                                <button class="btn btn-xs btn-primary">
                                                    <i class="ace-icon fa fa-check-square-o bigger-120"></i> Đánh giá collection
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                               </tr>
                               <tr>
                                    <td>maytinhxachtay</td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="hidden-sm hidden-xs btn-group">
                                            <a href="/icrawler/public/crawler_data/{{ $data }}/maytinhxachtay" title="Lấy thông tin">
                                                <button class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-download bigger-120"></i> Lấy thông tin
                                                </button>
                                            </a>
                                            <a href="/icrawler/public/evaluate_data/{{ $data }}/maytinhxachtay" title="Đánh giá collection">
                                                <button class="btn btn-xs btn-primary">
                                                    <i class="ace-icon fa fa-check-square-o bigger-120"></i> Đánh giá collection
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                               </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection