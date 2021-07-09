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
                                <th style="text-align:center">Trạng thái</th>
                                <th>/</th>
                                <th>Số data chưa crawl content</th>
                                <th>Số đã crawl</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($database as $data)
                                <tr>
                                    <td rowspan="2" style="vertical-align: middle">{{ $data['database'] }}</td>
                                    <td>dienthoai</td>
                                    <td rowspan="2" style="vertical-align:middle;text-align:center">
                                        <?php
                                        if (isset($data['status'])) {
                                            switch ($data['status']) {
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
                                    </td>
                                    <td>
                                        <div class="hidden-sm hidden-xs btn-group">
                                            <a href="/icrawler/public/crawler_data/{{ $data['database'] }}/dienthoai" title="Lấy thông tin">
                                                <button class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-download bigger-120"></i> Lấy thông tin
                                                </button>
                                            </a>
                                            <a href="/icrawler/public/evaluate_data/{{ $data['database'] }}/dienthoai" title="Đánh giá collection">
                                                <button class="btn btn-xs btn-primary">
                                                    <i class="ace-icon fa fa-check-square-o bigger-120"></i> Đánh giá collection
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                            $conn = \App\Http\Controllers\Controller::connectOthers();
                                            $db = $conn->$data['database'];
                                            $collection = $db->dienthoai;
                                            $count_nodt = $collection->find(array('status' => 0))->count();
                                            echo '<b style="color:red">'.$count_nodt.'</b>';
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $count_dt = $collection->find(array('status' => 1))->count();
                                            echo '<b style="color:green">'.$count_dt.'</b>';
                                        ?>
                                    </td>
                               </tr>
                               <tr>
                                    <td>maytinh</td>
                                    <td>
                                        <div class="hidden-sm hidden-xs btn-group">
                                            <a href="/icrawler/public/crawler_data/{{ $data['database'] }}/maytinh" title="Lấy thông tin">
                                                <button class="btn btn-xs btn-success">
                                                    <i class="ace-icon fa fa-download bigger-120"></i> Lấy thông tin
                                                </button>
                                            </a>
                                            <a href="/icrawler/public/evaluate_data/{{ $data['database'] }}/maytinh" title="Đánh giá collection">
                                                <button class="btn btn-xs btn-primary">
                                                    <i class="ace-icon fa fa-check-square-o bigger-120"></i> Đánh giá collection
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                   <td>
                                       <?php
                                       $collection = $db->maytinh;
                                       $count_nodt = $collection->find(array('status' => 0))->count();
                                       echo '<b style="color:red">'.$count_nodt.'</b>';
                                       ?>
                                   </td>
                                   <td>
                                       <?php
                                       $count_dt = $collection->find(array('status' => 1))->count();
                                       echo '<b style="color:green">'.$count_dt.'</b>';
                                       ?>
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