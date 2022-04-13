<?php
	include('../../configs/dbConfig.php');
    ?>
<div class="row customer-act act">
    <div class="row col-md-12">
        <h2>Báo cáo thống kê doanh thu</h2>
    </div>
    <div class=" row col-md-8 text-right action">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupPrepend">Từ ngày</span>
            </div>
            <input type="date" class="form-control" id="tuNgay">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupPrepend">Đến</span>
            </div>
            <input type="date" class="form-control" aria-describedby="inputGroupPrepend" id="denNgay">
            <div style="max-height: 30px;" class="col-md-1 form-group">
                <button class="btn btn-primary" style="border-radius:7px" id="btn-search" onclick="search_statistical()"><i class="fa fa-search" aria-hidden="true"></i> Tìm</button>
            </div>
        </div>
    </div>
    <div class="row col-md-12" style=" height:590px; max-height:800px;" id="chart">

    </div>
</div>
