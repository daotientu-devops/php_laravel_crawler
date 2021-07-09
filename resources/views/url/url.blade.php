@extends('layouts.default')
@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="{{ URL::to('/') }}">Bảng điều khiển</a>
            </li>
            <li>
                <a href="{{ URL::to('/url') }}">URL</a>
            </li>
            <li class="active">Lọc URL</li>
        </ul><!-- /.breadcrumb -->
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                Danh sách URL
            </h1>
        </div><!-- /.page-header -->
        <div class="rơw">
            <div class="col-xs-5">
                <!-- PAGE CONTENT BEGINS -->
                <?php if (isset($database)) { ?>
                <h5>Tên database: <?php echo $database; ?></h5>
                <h5>Tên collection: <?php echo $collection; ?></h5>
                <a class="btn btn-sm btn-success" type="submit" href="{{ URL::to('/filter_url/' . $database . '/' . $collection . '/' . $type . '/' . $domain) }}">
                    >> Thực thi
                </a>
                <?php } ?>
            </div>
            <div class="col-xs-7">
                <table id="simple-table" class="table table-hover">
                    <?php if (isset($page)) { ?>
                        <thead>
                        <tr>
                            <th>URL</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item['url'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    <?php } else { ?>
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Danh mục</th>
                            <th>Website</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody> <?php $i = 0; ?>
                        @foreach ($data as $item) <?php $i++; ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td>{{ $item['type'] }}</td>
                                <td>{{ $item['url'] }}</td>
                                <td>
                                    <p>
                                        <a class="btn btn-sm btn-grey" type="submit" href="{{ URL::to('/url/' . $item['database'] . '/maytinh/' . $item['type'] . '/' . $item['name'] . '/1') }}">
                                            <i class="ace-icon fa fa-filter bigger-110"></i>
                                            Lọc url máy tính
                                        </a>
                                    </p>
                                    <p>
                                        <a class="btn btn-sm btn-yellow" type="submit" href="{{ URL::to('/url/' . $item['database'] . '/dienthoai/' . $item['type'] . '/' . $item['name'] . '/1') }}">
                                            <i class="ace-icon fa fa-filter bigger-110"></i>
                                            Lọc url điện thoại
                                        </a>
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    <?php } ?>
                </table>
                <?php
                if (isset($page)) {
                    // Phân trang v2 có next và previous
                    if ($page > 1) {
                        echo '<a href="' . $url . '/' .  $prev . '">Previous</a>&nbsp;';
                        if ($page * $limit < $total) {
                            echo '<a href="' . $url . '/' .  $next . '">Next</a>&nbsp;';
                        }
                    } else {
                        if ($page * $limit < $total) {
                            echo '<a href="' . $url . '/' .  $next . '">Next</a>&nbsp;';
                        }
                    }
                }
                ?>
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection