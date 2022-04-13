function ajax_adapter($param){
	$.ajax({
            type:$param.type,
            url:$param.url,
            data:$param.data,
            dataType:$param.dataType,
            async:true,
            success:$param.callback
    });
}

$(document).ready(function(){
	delete_product_order();

	$('#search-product').keyup(function(){
		var productName = $(this).val();
		if(productName==''){
			$('#result-product-drop').css('display','none');
		}
		else{
			$param = {
			type:'POST',
			url:'backend/search_product.php',
			dataType:'html',
			data:
			{
				productName:productName
			},
			callback: function(data){
					$('#result-product-drop').html(data);
					$('#result-product-drop').css('display','block');
				}
			}
			ajax_adapter($param);
		}
	});

	$('.ft-tabs .tabs-list li a').click(function(){ // init table or product
		$('.ft-tabs .tabs-list li a').removeClass('active');
		$(this).addClass('active');
		var tab = $(this).attr('data'); //lấy giá trị của phần tử click pos or list-table
		if(tab=='listtable'){
			$('#table-list').attr('hidden',false); // bàn hiện
			$('#table-list').load('backend/table.php'); // load dữ liệu
			$('#pos').attr('hidden',true); // ẩn product
		}else{
			$('#table-list').attr('hidden',true); // bàn ẩn
			$('#pos').attr('hidden',false); //product hiện
		}
	});

	$('#DangXuat').click(function(){
		var check=confirm("Bạn muốn đăng xuất tài khoản ?");
		if(check==true)
		{
			$param = {
				type:'POST',
				url:'../configs/destroy_session.php',
				dataType:'html',
				callback: function(data){
					if(data==1)
					{
						window.location.replace("../login.php");
					}
					else{
						$('.alert-login').html('<h3>Thông báo !</h3><p>lỗi đăng xuất</p>').fadeIn().delay(1000).fadeOut('slow');
					}
					}
				}
				ajax_adapter($param);

		}
	});
	// thanh toán
	$('.customer-pay').keyup(function(){
		var customer_pay;
		if($(this).val()==''){
			customer_pay=0;
		}else{
			customer_pay = decode_currency_format($(this).val());
		}
		var total_pay = decode_currency_format($('.total-pay').val());
		var debt = customer_pay - total_pay;
		$(this).val(encode_currency_format(customer_pay));
		$('.excess-cash').html(encode_currency_format(debt));
	});
	// search customer
	$('#customer-infor').keyup(function(){
		var customer = $(this).val();
		if(customer==''){
			$('#result-customer').css('display','none');
		}else{
			$param = {
			type:'POST',
			url:'backend/search_customer.php',
			dataType:'html',
			data:
			{
				customer:customer
			},
			callback: function(data){
				$('#result-customer').html(data);
				$('#result-customer').css('display','block');
				}
			}
			ajax_adapter($param);
		}
	});

		$(document).on('click', '#history_order', function () {
			//alert("ok");
			 $('#content_history').load('backend/modal_history_load.php');
			 $('#ModalOrders').modal('show');
		})
});

// note 1
function select_customer(id){
	var id_table= $('#table_id').attr('data-id');
	//alert(id+id_table);
	var $param={
		type:'POST',
		url:'backend/insert_customer.php',
		dataType:'html',
		data:
			{
				id:id,
				id_table:id_table
			},
			callback: function(result){
				if(result==1)
				{
					$('.alert-login').html("<h3>Thông báo</h3><p>Thêm khách hàng thành công"+result+"!</p>").fadeIn().delay(1000).fadeOut('slow').css('background','#599130');
					$('#result-customer').css('display','none');
					$('#customer-infor').val("");
					refesh_price_order();
				}
				else{
					$('.alert-login').html("<h3>Thông báo</h3><p>Thêm khách hàng không thành công mã lồi : "+result+"!</p>").fadeIn().delay(1000).fadeOut('slow').css('background','#FF2424');
					$('#result-customer').css('display','none');
					$('#customer-infor').val("");
				}
			}
		}
		ajax_adapter($param);
}
function cate_product_load($id_cate){ // load title cate
	var $param={
		type:'POST',
		url:'backend/cate_product_load.php',
		dataType:'html',
		data:
			{
				id_cate:$id_cate
			},
			callback: function(data){
				$('.product-list-content').html(data);
			}
		}
		ajax_adapter($param);
}
function cate_table_load(id_cate)
{
	var $param={
		type:'POST',
		url:'backend/cate_table_load.php',
		dataType:'html',
		data:
			{
				id_cate:id_cate
			},
			callback: function(data){
				$('.table-list-content').html(data);
			}
		}
		ajax_adapter($param);
}
function add_order($maSanPham){ // add order

	//alert (table_id);
    // đã order
	  var table_id = $('#table_id').attr('data-id'); // lấy id ở title bàn +
	if($('#pro_search_append tr').length > 0){
		var flag= 0;
        // gộp tăng(chỉ để tăng số lượng và load lại của sản phẩm nếu trùng)
		$('#pro_search_append tr').each(function(){
			var id_temp = $(this).attr('data-id'); // data id ở thẻ tr (lấy mã sản phẩm)
			 if($maSanPham==id_temp){ // so sánh
				var soLuong = $(this).find('input.quantity-product-oders'); // lấy số lượng trong bản ghi ở table
			 	soLuong.val(parseInt(soLuong.val()) + 1); // tăng
				flag = 1; // check = true kết thúc luôn
				// load_infor_order(); // add sản phẩm vào table
				var $param={
					type:'POST',
					url:'backend/append_product.php',
					dataType:'html',
						data:
							{
								maSanPham:$maSanPham,
								table_id:table_id
							},
							callback: function(data){
								 $('#pro_search_append').append(data);
								load_infor_order();
							}
					}
				ajax_adapter($param);
			}
		});
        //thêm mới (thêm mới một <tr> và load )
		if(flag==0){
			var $param={
				type:'POST',
				url:'backend/append_product.php',
				dataType:'html',
					data:
						{
							maSanPham:$maSanPham,
							table_id:table_id
						},
						callback: function(data){
							$('#pro_search_append').append(data);
							load_infor_order();
						}
				}
			ajax_adapter($param);
		}
	}else{
        // chưa order
		var $param={
		type:'POST',
		url:'backend/append_product.php',
		dataType:'html',
		data:
			{
				maSanPham:$maSanPham,
				table_id:table_id
			},
			callback: function(data){
				$('#pro_search_append').append(data); // id pro_search là của tbody append ra <tr> của bảng
				//$('.alert-login').html(data).fadeIn().delay(1000).fadeOut('slow').css('background','#599130');
				load_infor_order();
			}
		}
		ajax_adapter($param);
	}
}
function load_infor_order(){ // load số lượng,giá trong bảng order
	var $total_money=0;
	$('tbody#pro_search_append tr').each(function () { // vòng lặp xuyên suốt các phần tử tr có trong thẻ có id trong pro_search_append
        $quantity = $(this).find('input.quantity-product-oders').val(); // lấy value của input số lượng
        $price = decode_currency_format($(this).find('input.price-order').val()); // lấy giá ra và format lại
        $total = $price * $quantity;
        $total_money += $total;
        $(this).find('td.total-money').html(encode_currency_format($total)); // tổng tiền của sản phẩm đó trong bảng order
        $('input.total-pay').val(encode_currency_format($total_money)); // tổng tiền của toàn order
    });
}
function refesh_price_order(){ // load số lượng,giá trong bảng order sau khi đã thêm mã khách hàng
	var $total_money=0;
	$('tbody#pro_search_append tr').each(function () { // vòng lặp xuyên suốt các phần tử tr có trong thẻ có id trong pro_search_append
        $quantity = $(this).find('input.quantity-product-oders').val(); // lấy value của input số lượng
        $price = decode_currency_format($(this).find('input.price-order').val()); // lấy giá ra và format lại
		$price= $price-(($price*20)/100); // giảm đi 20%
        $total = $price * $quantity; // tính tiền theo số lượng
        $total_money += $total; // tính lại tổng tiền.
		$(this).find('input.price-order').val(encode_currency_format($price));
        $(this).find('td.total-money').html(encode_currency_format($total)); // tổng tiền của sản phẩm đó trong bảng order
        $('input.total-pay').val(encode_currency_format($total_money)); // tổng tiền của toàn order
    });
}
function decode_currency_format(obs) {
    if (obs == '')
        return 0;
    else
        return parseInt(obs.replace(/,/g, ''));
}
function encode_currency_format(obs) {
    return obs.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function order_table_load($id_table){ // click in table to load table's order (hiện thị order trong bảng)
	$param={
		type:'POST',
		url:'backend/order_table_load.php',
		dataType:'html',
		data:
		{
			id_table:$id_table
		},
		callback: function(data){
			$('#pro_search_append').html(data);
			load_infor_order();
		}
	}
	ajax_adapter($param);
	$('#table-list').attr('hidden',true); // khi bấm vào bàn thì ẩn table đi để hiện product
	$('#pos').attr('hidden',false);
	title_table($id_table); // gán mã bàn vào title
	// $('.table-infor').html('<strong data-id="'+$id_table+'" id="table_id">Bàn '+$id_table+'</strong>');
}

function title_table(id)
{
	$param={
		type:'POST',
		url:'backend/title_table.php',
		dataType:'html',
		data:
		{
			id_table:id
		},
		callback: function(data){
			$('.table-infor').html('<strong data-id="'+id+'" id="table_id"> '+data+'</strong>');
		}
	}
	ajax_adapter($param);
}

function save_orders(uid){
	// alert(uid);
	if($('tbody#pro_search_append tr').length !=0){
		//var customer_id = $('#customer-infor').attr('data-id');
		//var customer_id = typeof $('#customer-infor').attr('data-id') === 'undefined' ? 0 : $('#customer-infor').attr('data-id');
		var customer_id=0;
		 var user_id=uid;
		var table_id = $('#table_id').attr('data-id'); // lấy id ở title bàn +
		//var customer_pay = decode_currency_format($('input.total-pay').val());
		// run once to receive data infor

		// run to add detail
		var detail = []; // khởi tạo mảng để lưu object
        $('tbody#pro_search_append tr').each(function () { // chạy từng dòng trong table
            var id = $(this).attr('data-id'); // mã sản phẩm
            var quantity = $(this).find('input.quantity-product-oders').val();
            var price = decode_currency_format($(this).find('input.price-order').val());
            detail.push(
                {id: id, quantity: quantity, price: price} // tạo thành phần tử object và đẩy vào mảng. js object
            );
        });
        var $data ={
        	'data':{
	        	'table_id':table_id,
	        	'customer_id':customer_id,
	        	'detail_order':detail, // mảng phần tử
				'user_id':user_id
        	}
        }
        var $param={
		type:'POST',
		url:'backend/save_orders.php',
		dataType:'html',
		data:$data,
		callback: function(data){
				$('.alert-login').html(data).fadeIn().delay(1000).fadeOut('slow').css('background','#599130');
			}
		}
		ajax_adapter($param);

	}else{
		$('.alert-login').html('<h3>Thông báo !</h3><p>Vui lòng chọn ít nhất 1 sản phẩm trước khi lưu</p>').fadeIn().delay(1000).fadeOut('slow');
	}
}
function btn_back() // hàm reset các control
{
	$('#table-list').attr('hidden',false); // khi bấm vào bàn thì ẩn table đi để hiện product
	$('#pos').attr('hidden',true);
	$('#table_id').attr('data-id','0');
	$('#table_id').html("");
	$('tbody#pro_search_append tr').each(function () { // chạy từng dòng trong table
		$(this).remove();
	});
	$('#table-list').load('backend/table.php'); // load trạng thái bàn
	// load lại chỗ thông tin tiền
	$('#table_id').attr('data-id');
	 $('input.total-pay').val(0);
	 $('input.customer-pay').val(0);
	 $('.excess-cash').html('0');
	// $('input.total-pay').attr('value','0');
	// $('input.customer-pay').attr('value','0');
	// $('.exess-cash').attr('value','0');
}
function delete_product_order(){
    $('body').on('click', '.delete-product-order', function () {
		var maSanPham= $(this).parents('tr').attr('data-id');
		var table_id = $('#table_id').attr('data-id');
        $param={
			type:'POST',
			url:'backend/delete_product.php',
			dataType:'html',
			data:
			{
				maSanPham:maSanPham,
				table_id:table_id
			},
			callback: function(result){
				//$('.alert-login').html("<h3>Thông báo</h3><p>Xóa thành công!"+result+"</p>").fadeIn().delay(1000).fadeOut('slow').css('background','#599130');

				if(result==0)
				{
					$('.alert-login').html("<h3>Thông báo</h3><p>Xóa không thành công!</p>").fadeIn().delay(1000).fadeOut('slow').css('background','#FF2424');
				}
				else{
					$('.alert-login').html("<h3>Thông báo</h3><p>Xóa thành công!</p>").fadeIn().delay(1000).fadeOut('slow').css('background','#599130');
				}

			}
		}
		ajax_adapter($param);
		$(this).parents('tr').remove();
         load_infor_order();
    });
}
function detail_payment_load (){
	var id_table=$('#table_id').attr('data-id');
	$param={
		type:'POST',
		url:'backend/detail_payment_load.php',
		dataType:'html',
		data:
		{
			id_table:id_table
		},
		callback: function(data){
			$('#pro_search_append_payment').html(data);
		}
	}
	ajax_adapter($param);
}
function payment()
{
	var id_table=$('#table_id').attr('data-id');
	// mã khách hàng nữa.
	$param={
		type:'POST',
		url:'backend/payment.php',
		dataType:'html',
		data:
		{
			id_table:id_table
		},
		callback: function(result){
			if(result==1)
			{
				btn_back();
				$('.alert-login').html("<h3>Thông báo</h3><p>Thanh toán thành công!</p>").fadeIn().delay(1000).fadeOut('slow').css('background','#599130');
			}
			//$('#pro_search_append_payment').html(data);
		}
	}
	ajax_adapter($param);
}