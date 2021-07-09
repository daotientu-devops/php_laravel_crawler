@foreach($website_data as $web)
<div id="modal-table-{{ $web['_id'] }}" class="modal fade" tabindex="-1">
    <div class="modal-dialog" style="width: 60%; overflow: hidden">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <div class="table-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="white">&times;</span>
                    </button>
                    Tách nội dung chính từ trang web
                </div>
            </div>
            <div class="modal-body">
                <p><strong>URL:</strong> {{ $web['url'] }}</p>
                <p><strong>Tiêu đề:</strong> {{ $web['title'] }}</p>
                <p><strong>Nội dung:</strong>
                    <?php echo html_entity_decode($web['content']); ?>
                </p>
                <p><strong>Văn bản thuần túy (lấy một phần nội dung):</strong> {{ $web['str_content'] }}</p>
            </div>
        </div>
    </div>
</div>
@endforeach