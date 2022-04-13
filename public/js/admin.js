function ajax_adapter($param) {
	$.ajax({
		type: $param.type,
		url: $param.url,
		data: $param.data,
		dataType: $param.dataType,
		async: true,
		success: $param.callback
	});
}

//active của index.
$(document).ready(function () {
	$('.result-content').load('admin/frontend/dashboard.php');
	$('#sidebar ul li a').click(function () {
		var url = $(this).attr('href');
		$('#sidebar ul li a').removeClass('active');
		$(this).addClass('active');
		$('.result-content').load(url +'.php');
		if(url=="pos/index")
		{
			window.location.replace('pos/');
		}
		return false;
	});

	$('#DangXuat').click(function(){ // đăng xuất
		var check=confirm("Bạn muốn đăng xuất tài khoản ?");
		if(check==true)
		{
			$param = {
				type:'POST',
				url:'configs/destroy_session.php',
				dataType:'html',
				callback: function(data){
					if(data==1)
					{
						window.location.replace("login.php");
					}
					else{
						$('.alert-login').html('<h3>Thông báo !</h3><p>lỗi đăng xuất</p>').fadeIn().delay(1000).fadeOut('slow');
					}
					}
				}
				ajax_adapter($param);
		}
	});
	$('#searchproduct').keyup(function () {
		var key = $(this).val();
		$param = {
			type: 'POST',
			url: 'backend/searchproduct.php',
			data: {
				key: key
			},
			dataType: 'html',
			callback: function (result) {
				alert(result);
			}
		}
		ajax_adapter($param);
	});
	$(document).on('click', '#edit_product', function () {
		var id = $(this).val();
		//alert(id);
		$('#ModalEditProduct').modal('show');
		$param = {
			type: 'POST',
			url: 'admin/backend/selectToEditProduct.php',
			data: {
				id:id
			},
			dataType: 'json',
			callback: function (result) {
				if (result == '0') {
					$('.alert-login').html('<h3>Thông báo !</h3><p>Hiển thị thông tin không thành công!</p>').fadeIn().delay(1000).fadeOut('slow');
				} else {
					//$('.alert-login').html('<h3>Thông báo !</h3><p>'+result+'</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');
					$('input[name="productID_edit"]').val(result[0]);
					$('input[name="productName_edit"]').val(result[1]);
					$('input[name="productPrice_edit"]').val(result[2]);
					$('select[name="productUnit_edit"]').val(result[3]);
					$('select[name="productCate_edit"]').val(result[4]);
				}
			}
		}
		ajax_adapter($param);
	})
});
function pagination($current_page){
	$param = {
			type:'POST',
			url:'admin/backend/pagination_table.php',
			data:{
				current_page:$current_page,
			},
			dataType:'html',
			callback:function(result){
				$('#load_pagination_table').html(result);
			}
		}
	ajax_adapter($param);
}
// $(document).ready(function () {
// 	$(document).on('click', '#edit_product', function () {
// 		var id = $(this).val();
// 		//alert(id);
// 		$('#ModalEditProduct').modal('show');
// 		$param = {
// 			type: 'POST',
// 			url: 'backend/selectToEditProduct.php',
// 			data: {
// 				id:id
// 			},
// 			dataType: 'json',
// 			callback: function (result) {
// 				if (result == '0') {
// 					$('.alert-login').html('<h3>Thông báo !</h3><p>Hiển thị thông tin không thành công!</p>').fadeIn().delay(1000).fadeOut('slow');
// 				} else {
// 					//$('.alert-login').html('<h3>Thông báo !</h3><p>'+result+'</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');
// 					$('input[name="productID_edit"]').val(result[0]);
// 					$('input[name="productName_edit"]').val(result[1]);
// 					$('input[name="productPrice_edit"]').val(result[2]);
// 					$('select[name="productUnit_edit"]').val(result[3]);
// 					$('select[name="productCate_edit"]').val(result[4]);
// 				}
// 			}
// 		}
// 		ajax_adapter($param);
// 	})

// })
// sort table name
function sortTable_name() {
	var table, rows, switching, i, x, y, shouldSwitch;
	table = document.getElementById("tables");
	switching = true;
	/*Make a loop that will continue until no switching has been done:*/
	while (switching) {
		//start by saying: no switching is done:
	  switching = false;
	  rows = table.rows;
	  /*Loop through all table rows (except the first, which contains table headers):*/
	  for (i = 1; i < (rows.length - 1); i++) {
			//start by saying there should be no switching:
			shouldSwitch = false;
			/*Get the two elements you want to compare, one from current row and one from the next:*/
			x = rows[i].getElementsByTagName("TD")[0];
			y = rows[i + 1].getElementsByTagName("TD")[0];
			//check if the two rows should switch place:
			if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
			//if so, mark as a switch and break the loop:
			shouldSwitch = true;
			break;
			}
	  	}
	  if (shouldSwitch) {
		/*If a switch has been marked, make the switch and mark that a switch has been done:*/
		rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		switching = true;
	  }
	}
  }

function sortTable_floor()
{
	var table, rows, switching, i, x, y, shouldSwitch;
	table = document.getElementById("tables");
	switching = true;
	/*Make a loop that will continue until no switching has been done:*/
	while (switching) {
		//start by saying: no switching is done:
	  switching = false;
	  rows = table.rows;
	  /*Loop through all table rows (except the first, which contains table headers):*/
	  for (i = 1; i < (rows.length - 1); i++) {
			//start by saying there should be no switching:
			shouldSwitch = false;
			/*Get the two elements you want to compare, one from current row and one from the next:*/
			x = rows[i].getElementsByTagName("TD")[1];
			y = rows[i + 1].getElementsByTagName("TD")[1];
			//check if the two rows should switch place:
			if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
			//if so, mark as a switch and break the loop:
			shouldSwitch = true;
			break;
			}
	  	}
	  if (shouldSwitch) {
		/*If a switch has been marked, make the switch and mark that a switch has been done:*/
		rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		switching = true;
	  }
	}
}
//  sort

// table
$(document).ready(function () {
	$(document).on('click', '#id_edit', function () {
		var id = $(this).val();
		// alert(id);
		$('#ModalEditTable').modal('show');
		$param = {
			type: 'POST',
			url: 'admin/backend/selectToEditTable.php',
			data: {
				id_edit:id
			},
			dataType: 'json',
			callback: function (result) {
				if (result == '0') {
					$('.alert-login').html('<h3>Thông báo !</h3><p>Không tìm thấy mã bàn này</p>').fadeIn().delay(1000).fadeOut('slow');
				} else {
					$('input[name="tablename_edit"]').val(result[1]);
					$('select[name="maTang_edit"]').val(result[4]);
					$('input[name="value_hidden"]').val(result[0]);
					$('select[name="status_edit"]').val(result[3]);
					$('textarea[name="ghichu_edit"]').val(result[2]);
				}
			}
		}
		ajax_adapter($param);
	})

})
function search_table(){
	var key=$('#txtTenMaBan').val();
	var tang=$('#tang').val();
	var trangThai=$('#trangThai').val();
	//alert(key+tang+trangThai);
	$param = {
		type:'POST',
		url:'backend/search_table.php',
		data:{
			key:key,
			tang:tang,
			trangThai:trangThai
		},
		dataType:'html',
		callback:function(result){
			if(result!=0)
			{
				$('#tables-place').html(result);
			}
		}
	}
	ajax_adapter($param);

}

function add_table() {
	var tablename = $('input[name="tablename"]').val();
	var idarea = $('select[name="areas-id"]').val();
	var statusTable = $('select[name="statusTable"]').val();
	var note = $('textarea[name="ghichu_add"]').val();

	// alert(tablename,idarea);
	if (tablename == '') {
		$('.alert-login').html('<h3>Thông báo !</h3><p>Tên bàn không để trống</p>').fadeIn().delay(1000).fadeOut('slow');
	} else {
		$param = {
			type: 'POST',
			url: 'admin/backend/add_table.php',
			data: {
				tablename: tablename,
				idarea: idarea,
				statusTable: statusTable,
				note:note
			},
			dataType: 'html',
			callback: function (result) {
				if (result == '0') {
					$('.alert-login').html('<h3>Thông báo !</h3><p>Tên bàn đã tồn tại</p>').fadeIn().delay(1000).fadeOut('slow');
				} else {
					$('.alert-login').html('<h3>Thông báo !</h3><p>Thêm thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');

					$('.result-content').load('admin/frontend/table.php');
					$('.modal-backdrop').hide();
				}
			}
		}
		ajax_adapter($param);
	}
}

function save_edit()
{
	var id = $('input[name="value_hidden"]').val();
	var tenBan= $('input[name="tablename_edit"]').val();
	var maTang= $('select[name="maTang_edit"]').val(); // value của select là mã của tầng
	var trangThai=$('select[name="status_edit"]').val();
	var ghiChu=$('textarea[name="ghichu_edit"]').val();
	if(id != "" && tenBan!= "" && maTang !="" && trangThai != "")
	{

		// alert( id);
		//  alert("id: "+ id+" tên bàn: "+ tenBan +" mã tầng: "+ maTang +" Trạng thái: "+ trangThai);
		$parameter = {
			type: 'POST',
			url: 'admin/backend/update_table.php',
			data: {
				id: id,
				tenBan: tenBan,
				ghiChu:ghiChu,
				maTang: maTang,
				trangThai: trangThai
			},
			dataType:'html',
			callback:function(result){
				if(result==0)
				{
					$('.alert-login').html('<h3>Thông báo !</h3><p>Tên bàn đã tồn tại! </p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');
				}
				else{
					$('.alert-login').html('<h3>Thông báo !</h3><p>Cập nhật thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');
					$('.result-content').load('admin/frontend/table.php');
					$('.modal-backdrop').hide();
				}
			}
		}
	ajax_adapter($parameter);
	}
	else{
		$('.alert-login').html('<h3>Thông báo !</h3><p>Hãy đảm bảo đã điền đủ thông tin !</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');

	}
}

function delete_table(id) {
	// alert(id);
	var check=confirm("Bạn muốn xóa bàn này?");
		if(check==true)
		{
			$param = {
				type: 'POST',
				url: 'admin/backend/delete_table.php',
				data: {
					delete_id:id
				},
				dataType: 'html',
				callback: function (result) {
					if (result == '0') {
						$('.alert-login').html('<h3>Thông báo !</h3><p>Đã xảy ra lỗi xóa bàn</p>').fadeIn().delay(1000).fadeOut('slow');
					} else {
						$('.alert-login').html('<h3>Thông báo !</h3><p>Xóa thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');
						$('.result-content').load('admin/frontend/table.php');
					}
				}
			}
			ajax_adapter($param);
		 }
}
// end table

// product
function add_product(){
	// alert('ok');
	var ID = $('input[name="productID"]').val();
	var name = $('input[name="productName"]').val();
	var price = $('input[name="productPrice"]').val();
	var unit = $('select[name="productUnit"]').val();
	var cate = $('select[name="productCate"]').val();
	var str_img = $('input[name="productImg"]').val(); // lấy path
	var index= str_img.lastIndexOf("\\");// lấy vị trí cuối
	var img = str_img.substring(index+1);  // cắt tên
	alert(ID+name+price+unit+cate);
	// alert(str_img + index + img) ;
	if (ID == '' || name==''  || price =='' || unit =='' ||cate=='') {
	 	$('.alert-login').html('<h3>Thông báo !</h3><p>Không được để trống thông tin sản phẩm! </p>').fadeIn().delay(1000).fadeOut('slow');
	 } else {
		$param = {
			type: 'POST',
			url: 'admin/backend/add_product.php',
			data: {
				ID:ID,
				name:name,
				price: price,
				unit: unit,
				cate:cate,
				img:img
			},
			dataType: 'html',
			callback: function (result) {
				if (result == '0') {
					$('.alert-login').html('<h3>Thông báo !</h3><p>Thêm không thành công !</br>Bạn đã nhập trùng tên hoặc trùng mã sản phẩm!</p>').fadeIn().delay(1000).fadeOut('slow');
				} else {
					$('.alert-login').html('<h3>Thông báo !</h3><p>Thêm thành công </p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');
					$('.result-content').load('admin/frontend/product.php');
					$('.modal-backdrop').hide();
				}
			}
		}
	 	ajax_adapter($param);
	}
}
function delete_product(id)
{
	if(confirm("Bạn muốn xóa sản phẩm này ?"))
	{
		 //alert(id);
		//  $('.result-content').load('product.php?delete_id='+'"'+id+'"' );
		 $param = {
			type: 'POST',
			url: 'admin/backend/delete_product.php',
			data: {
				id:id
			},
			dataType: 'html',
			callback: function (result) {
				if (result == '0') {
					$('.alert-login').html('<h3>Thông báo !</h3><p>Xóa không thành công</p>').fadeIn().delay(1000).fadeOut('slow');
				} else {
					$('.alert-login').html('<h3>Thông báo !</h3><p> Xóa thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');
					$('.result-content').load('admin/frontend/product.php');
				}
			}
		}
		ajax_adapter($param);
	}
}

function save_edit_product()
{
	var id=$('input[name="productID_edit"]').val();
	var name=$('input[name="productName_edit"]').val();
	var price=$('input[name="productPrice_edit"]').val();
	var unit=$('select[name="productUnit_edit"]').val();
	var cate=$('select[name="productCate_edit"]').val();
	//var img=$('input[name="productImg_edit"]').val();
	if(id != "" && name!= "" && price != "" && unit != ""&& cate !="")
	{
	//alert("id: "+ id+" tên bàn: "+ name +" mã tầng: "+ price +" Trạng thái: "+ unit+cate);
		$parameter = {
			type: 'POST',
			url: 'admin/backend/update_product.php',
			data: {
				id: id,
				name: name,
				price:price,
				unit: unit,
				cate: cate
			},
			dataType:'html',
			callback:function(result){
				if(result==0)
				{
					$('.alert-login').html('<h3>Thông báo !</h3><p>Tên sản phẩm đã tồn tại! </p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');
				}
				else{
					$('.alert-login').html('<h3>Thông báo !</h3><p>Cập nhật thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');
					$('.result-content').load('admin/frontend/product.php');
					$('.modal-backdrop').hide();
				}
			}
		}
	ajax_adapter($parameter);
	}
	else{
		$('.alert-login').html('<h3>Thông báo !</h3><p>Hãy đảm bảo đã điền đủ thông tin !</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');

	}
}
function sort_2() {
	var table, rows, switching, i, x, y, shouldSwitch;
	table = document.getElementById("table_sort");
	switching = true;
	/*Make a loop that will continue until no switching has been done:*/
	while (switching) {
		//start by saying: no switching is done:
	  switching = false;
	  rows = table.rows;
	  /*Loop through all table rows (except the first, which contains table headers):*/
	  for (i = 1; i < (rows.length - 1); i++) {
			//start by saying there should be no switching:
			shouldSwitch = false;
			/*Get the two elements you want to compare, one from current row and one from the next:*/
			x = rows[i].getElementsByTagName("TD")[2];
			y = rows[i + 1].getElementsByTagName("TD")[2];
			//check if the two rows should switch place:
			if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
			//if so, mark as a switch and break the loop:
			shouldSwitch = true;
			break;
			}
	  	}
	  if (shouldSwitch) {
		/*If a switch has been marked, make the switch and mark that a switch has been done:*/
		rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		switching = true;
	  }
	}
  }
  function sort_1() {
	var table, rows, switching, i, x, y, shouldSwitch;
	table = document.getElementById("table_sort");
	switching = true;
	/*Make a loop that will continue until no switching has been done:*/
	while (switching) {
		//start by saying: no switching is done:
	  switching = false;
	  rows = table.rows;
	  /*Loop through all table rows (except the first, which contains table headers):*/
	  for (i = 1; i < (rows.length - 1); i++) {
			//start by saying there should be no switching:
			shouldSwitch = false;
			/*Get the two elements you want to compare, one from current row and one from the next:*/
			x = rows[i].getElementsByTagName("TD")[1];
			y = rows[i + 1].getElementsByTagName("TD")[1];
			//check if the two rows should switch place:
			if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
			//if so, mark as a switch and break the loop:
			shouldSwitch = true;
			break;
			}
	  	}
	  if (shouldSwitch) {
		/*If a switch has been marked, make the switch and mark that a switch has been done:*/
		rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		switching = true;
	  }
	}
  }
  function sort_0() {
	var table, rows, switching, i, x, y, shouldSwitch;
	table = document.getElementById("table_sort");
	switching = true;
	/*Make a loop that will continue until no switching has been done:*/
	while (switching) {
		//start by saying: no switching is done:
	  switching = false;
	  rows = table.rows;
	  /*Loop through all table rows (except the first, which contains table headers):*/
	  for (i = 1; i < (rows.length - 1); i++) {
			//start by saying there should be no switching:
			shouldSwitch = false;
			/*Get the two elements you want to compare, one from current row and one from the next:*/
			x = rows[i].getElementsByTagName("TD")[0];
			y = rows[i + 1].getElementsByTagName("TD")[0];
			//check if the two rows should switch place:
			if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
			//if so, mark as a switch and break the loop:
			shouldSwitch = true;
			break;
			}
	  	}
	  if (shouldSwitch) {
		/*If a switch has been marked, make the switch and mark that a switch has been done:*/
		rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		switching = true;
	  }
	}
  }
  function sort_3() {
	var table, rows, switching, i, x, y, shouldSwitch;
	table = document.getElementById("table_sort");
	switching = true;
	/*Make a loop that will continue until no switching has been done:*/
	while (switching) {
		//start by saying: no switching is done:
	  switching = false;
	  rows = table.rows;
	  /*Loop through all table rows (except the first, which contains table headers):*/
	  for (i = 1; i < (rows.length - 1); i++) {
			//start by saying there should be no switching:
			shouldSwitch = false;
			/*Get the two elements you want to compare, one from current row and one from the next:*/
			x = rows[i].getElementsByTagName("TD")[3];
			y = rows[i + 1].getElementsByTagName("TD")[3];
			//check if the two rows should switch place:
			if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
			//if so, mark as a switch and break the loop:
			shouldSwitch = true;
			break;
			}
	  	}
	  if (shouldSwitch) {
		/*If a switch has been marked, make the switch and mark that a switch has been done:*/
		rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		switching = true;
	  }
	}
  }
  function sort_5() {
	var table, rows, switching, i, x, y, shouldSwitch;
	table = document.getElementById("table_sort");
	switching = true;
	/*Make a loop that will continue until no switching has been done:*/
	while (switching) {
		//start by saying: no switching is done:
	  switching = false;
	  rows = table.rows;
	  /*Loop through all table rows (except the first, which contains table headers):*/
	  for (i = 1; i < (rows.length - 1); i++) {
			//start by saying there should be no switching:
			shouldSwitch = false;
			/*Get the two elements you want to compare, one from current row and one from the next:*/
			x = rows[i].getElementsByTagName("TD")[5];
			y = rows[i + 1].getElementsByTagName("TD")[5];
			//check if the two rows should switch place:
			if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
			//if so, mark as a switch and break the loop:
			shouldSwitch = true;
			break;
			}
	  	}
	  if (shouldSwitch) {
		/*If a switch has been marked, make the switch and mark that a switch has been done:*/
		rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		switching = true;
	  }
	}
  }
  function search_product()
  {
	var key=$('#tenMaSanPham').val();
	var maLoai=$('#maLoai').val();

	//alert(key+tang+trangThai);
	$param = {
		type:'POST',
		url:'backend/search_product.php',
		data:{
			key:key,
			maLoai:maLoai,
		},
		dataType:'html',
		callback:function(result){
			if(result!=0)
			{
				$('#result-product').html(result);
			}
		}
	}
	ajax_adapter($param);
  }
//end product

//staff
function add_staff() {
	var TenNV = $('input[name="TenNV"]').val();
	var GioiTinh = $('select[name="GioiTinh"]').val();
	var SDT = $('input[name="SDT"]').val();
	var Email = $('input[name="Email"]').val();
	var DiaChi = $('input[name="DiaChi"]').val();
	// var HinhAnh = $('select[name="HinhAnh"]').val();
	// alert(TenNV);

	// alert(tablename,idarea);
	if (TenNV == '') {
		$('.alert-login').html('<h3>Thông báo !</h3><p>Tên nhân viên không thể để trống</p>').fadeIn().delay(1000).fadeOut('slow');
	} else {
		$param = {
			type: 'POST',
			url: 'admin/backend/add_staff.php',
			data: {
				TenNV: TenNV,
				GioiTinh: GioiTinh,
				SDT: SDT,
				Email: Email,
				DiaChi: DiaChi,
			},
			dataType: 'html',
			callback: function (result) {
				if (result == '0') {
					$('.alert-login').html('<h3>Thông báo !</h3><p>Thêm nhân viên không thành công</p>').fadeIn().delay(1000).fadeOut('slow');
				} else {
					$('.alert-login').html('<h3>Thông báo !</h3><p>Thêm thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');

					$('.result-content').load('admin/frontend/staff.php');
					$('.modal-backdrop').hide();
				}
			}
		}
		ajax_adapter($param);
	}
}

$(document).ready(function () {
	$(document).on('click', '#editStaff', function () {
		var id = $(this).val();
		$('#EditStaffModal').modal('show');
		$param = {
			type: 'POST',
			url: 'admin/backend/selectToEditStaff.php',
			data: {
				id: id
			},
			dataType: 'json',
			callback: function (result) {
				if (result == '0') {
					$('.alert-login').html('<h3>Thông báo !</h3><p>Không tìm thấy mã nhân viên này</p>').fadeIn().delay(1000).fadeOut('slow');
				} else {
					$('input[name="value_hidden_manv"]').val(result[0]);
					$('input[name="TenNV_edit"]').val(result[1]);
					$('select[name="GioiTinh_edit"]').val(result[2]);
					$('input[name="SDT_edit"]').val(result[3]);
					$('input[name="Email_edit"]').val(result[4]);
					$('input[name="DiaChi_edit"]').val(result[5]);
					$('input[name="value_hidden_matk"]').val(result[6]);
				}
			}
		}
		ajax_adapter($param);
	})

});



function save_edit_staff()
{
	var MaNV = $('input[name="value_hidden_manv"]').val();
	var TenNV= $('input[name="TenNV_edit"]').val();
	var GioiTinh= $('select[name="GioiTinh_edit"]').val(); // value của select giới tính
	var SDT= $('input[name="SDT_edit"]').val();
	var Email= $('input[name="Email_edit"]').val();
	var DiaChi= $('input[name="DiaChi_edit"]').val();
	// sửa
	var MaTK = $('select[name="maTK"]').val();
	//het
	if(MaNV != "" && TenNV!= "" && MaTK != "")
	{
		$parameter = {
			type: 'POST',
			url: 'admin/backend/update_staff.php',
			data: {
				MaNV: MaNV,
				TenNV: TenNV,
				GioiTinh:GioiTinh,
				SDT: SDT,
				Email: Email,
				DiaChi: DiaChi,
				MaTK: MaTK
			},
			dataType:'html',
			callback:function(result){
				if(result==0)
				{
					$('.alert-login').html('<h3>Thông báo !</h3><p>Sửa không thành công </p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#FF0000');
				}
				else{
					$('.alert-login').html('<h3>Thông báo !</h3><p>Cập nhật thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');
					$('.result-content').load('admin/frontend/staff.php');
					$('.modal-backdrop').hide();
				}
			}
		}
	ajax_adapter($parameter);
	}
	else{
		$('.alert-login').html('<h3>Thông báo !</h3><p>Hãy đảm bảo đã điền đủ thông tin !</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');

	}
}
function delete_staff_by_id(MaNV) {
	if (confirm("Bạn muốn xóa nhân viên này ?")) {

		$('.result-content').load('admin/frontend/staff.php?delete_id=' + MaNV);

	}
}
// end staff

//account
function add_account() {
	var TenDN = $('input[name="TenDN"]').val();
	var MatKhau = $('input[name="MatKhau"]').val();
	var VaiTro = $('select[name="VaiTro"]').val();


	alert(TenDN+MatKhau+VaiTro);
	if (TenDN == '' || MatKhau == '') {
		$('.alert-login').html('<h3>Thông báo !</h3><p>Mã nhân viên,Tên đăng nhập và mật khẩu không thể để trống</p>').fadeIn().delay(1000).fadeOut('slow');
	} else {
		$param = {
			type: 'POST',
			url: 'admin/backend/add_account.php',
			data: {
				TenDN: TenDN,
				MatKhau: MatKhau,
				VaiTro: VaiTro
			},
			dataType: 'html',
			callback: function (result) {
				if (result == '0') {
					$('.alert-login').html('<h3>Thông báo !</h3><p>Thêm tài khoản không thành công</p>').fadeIn().delay(1000).fadeOut('slow');
				} else {
					$('.alert-login').html('<h3>Thông báo !</h3><p>Thêm thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');
					$('.result-content').load('admin/frontend/account.php');
					$('.modal-backdrop').hide();
				}
			}
		}
		ajax_adapter($param);
	}
}

$(document).ready(function () {
	$(document).on('click', '#editAccount', function () {
		var id = $(this).val();
		$('#EditAccountModal').modal('show');
		$param = {
			type: 'POST',
			url: 'admin/backend/selectToEditAccount.php',
			data: {
				id: id
			},
			dataType: 'json',
			callback: function (result) {
				if (result == '0') {
					$('.alert-login').html('<h3>Thông báo !</h3><p>Không tìm thấy mã nhân viên này</p>').fadeIn().delay(1000).fadeOut('slow');
				} else {
					$('input[name="value_hidden_matk"]').val(result[0]);
					// $('input[name="value_hidden_manv"]').val(result[1]);
					$('input[name="TenDN_edit"]').val(result[1]);
					$('input[name="MK_edit"]').val(result[2]);
					$('select[name="VaiTro_edit"]').val(result[3]);
				}
			}
		}
		ajax_adapter($param);
	})

});


function save_edit_account()
{
	var MaTK = $('input[name="value_hidden_matk"]').val();
	var TenDN= $('input[name="TenDN_edit"]').val();
	var MatKhau= $('input[name="MK_edit"]').val();
	var VaiTro = $('select[name="VaiTro_edit"]').val();
	//alert (MaTK+MaNV+TenDN+MatKhau+VaiTro);
	if(TenDN != "" && MatKhau!= "" && VaiTro != "")
	{
		$parameter = {
			type: 'POST',
			url: 'admin/backend/update_account.php',
			data: {
				MaTK: MaTK,
				TenDN: TenDN,
				MatKhau:MatKhau,
				VaiTro: VaiTro
			},
			dataType:'html',
			callback:function(result){
				if(result==0)
				{
					$('.alert-login').html('<h3>Thông báo !</h3><p>Sửa không thành công </p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#FF0000');
				}
				else{
					$('.alert-login').html('<h3>Thông báo !</h3><p>Cập nhật thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');
					$('.result-content').load('admin/frontend/account.php');
					$('.modal-backdrop').hide();
				}
			}
		}
	ajax_adapter($parameter);
	}
	else{
		$('.alert-login').html('<h3>Thông báo !</h3><p>Hãy đảm bảo đã điền đủ thông tin !</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');

	}
}

function delete_id_Account(MaTK) {
	if (confirm("Bạn muốn xóa tài khoản này ?")) {

		$('.result-content').load('admin/frontend/account.php?delete_id_Account=' + MaTK);

	}
}
//end account

// customer
function search_customer(){
	var key = $('#key').val();
	// alert(key+"okmen");
	$param = {
		type:'POST',
		url:'backend/search_customer.php',
		data:{
			key:key,
		},
		dataType:'html',
		callback:function(result){
			if(result!=0)
			{
				$('#tbody-cus').html(result);
			}
		}
	}
	ajax_adapter($param);
}

function search_hoaDon(){
	var key=$('#search-hoaDon').val();
	var tuNgay=$('#tuNgay').val();
	var denNgay=$('#denNgay').val();
	//  alert(key+tuNgay+denNgay);
		$param = {
			type: 'POST',
			url: 'backend/search_bill.php',
			data: {
				key:key,
				tuNgay: tuNgay,
				denNgay: denNgay
			},
			dataType: 'html',
			callback: function (result) {
				$('#tbody-hoaDon').html(result);
			}
		}
		ajax_adapter($param);
}

function add_customer() {
	var TenKH = $('input[name="TenKH"]').val();
	var SDT = $('input[name="SDT"]').val();
	var DiaChi = $('input[name="DiaChi"]').val();

	//alert(TenKH+SDT+DiaChi);
	if (TenKH == '') {
		$('.alert-login').html('<h3>Thông báo !</h3><p>Tên khách hàng không thể để trống</p>').fadeIn().delay(1000).fadeOut('slow');
	} else {
		$param = {
			type: 'POST',
			url: 'admin/backend/add_customer.php',
			data: {
				TenKH: TenKH,
				SDT: SDT,
				DiaChi: DiaChi
			},
			dataType: 'html',
			callback: function (result) {
				if (result == '0') {
					$('.alert-login').html('<h3>Thông báo !</h3><p>Thêm khách hàng không thành công</p>').fadeIn().delay(1000).fadeOut('slow');
				} else {
					$('.alert-login').html('<h3>Thông báo !</h3><p>Thêm thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');
					$('.result-content').load('admin/frontend/customer.php');
					$('.modal-backdrop').hide();
					// alert(result);
					// $('#ModalAddTable').hide();
					// $('#ModalAddTable').modal('hide');
					// $('data-dismiss')="modal";
				}
			}
		}
		ajax_adapter($param);
	}
}

$(document).ready(function () {
	$(document).on('click', '#editCustomer', function () {
		var id = $(this).val();
		$('#EditCustomerModal').modal('show');
		$param = {
			type: 'POST',
			url: 'admin/backend/selectToEditCustomer.php',
			data: {
				id: id
			},
			dataType: 'json',
			callback: function (result) {
				if (result == '0') {
					$('.alert-login').html('<h3>Thông báo !</h3><p>Không tìm thấy mã khách hàng này</p>').fadeIn().delay(1000).fadeOut('slow');
				} else {
					$('input[name="value_hidden_makh"]').val(result[0]);
					$('input[name="TenKH_edit"]').val(result[1]);
					$('input[name="SDT_edit"]').val(result[2]);
					$('input[name="DiaChi_edit"]').val(result[3]);
				}
			}
		}
		ajax_adapter($param);
	})

});


function save_edit_customer()
{
	var MaKH = $('input[name="value_hidden_makh"]').val();
	var TenKH= $('input[name="TenKH_edit"]').val();
	var SDT= $('input[name="SDT_edit"]').val();
	var DiaChi= $('input[name="DiaChi_edit"]').val();
	if(MaKH != "" && TenKH!= "")
	{
		$parameter = {
			type: 'POST',
			url: 'admin/backend/update_customer.php',
			data: {
				MaKH: MaKH,
				TenKH: TenKH,
				SDT: SDT,
				DiaChi: DiaChi
			},
			dataType:'html',
			callback:function(result){
				if(result==0)
				{
					$('.alert-login').html('<h3>Thông báo !</h3><p>Sửa không thành công </p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#FF0000');
				}
				else{
					$('.alert-login').html('<h3>Thông báo !</h3><p>Cập nhật thành công</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');
					$('.result-content').load('admin/frontend/customer.php');
					$('.modal-backdrop').hide();
				}
			}
		}
	ajax_adapter($parameter);
	}
	else{
		$('.alert-login').html('<h3>Thông báo !</h3><p>Hãy đảm bảo đã điền đủ thông tin !</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37822A');

	}
}

function delete_id_Customer(MaKH) {
	if (confirm("Bạn muốn xóa khách hàng này ?")) {

		$('.result-content').load('admin/frontend/customer.php?delete_id=' + MaKH);

	}
}
// end customer
// statistical
function search_statistical()
{
	var tuNgay=$('#tuNgay').val();
	var denNgay=$('#denNgay').val();
	// alert(tuNgay+denNgay);
		$param = {
			type: 'POST',
			url: 'backend/statistical.php',
			data: {
				tuNgay: tuNgay,
				denNgay: denNgay
			},
			dataType: 'html',
			callback: function (result) {
				$('#chart').html(result);
				//  $('.alert-login').html('<h3>Thông báo !</h3><p>Thành công'+result+' !</p>').fadeIn().delay(1000).fadeOut('slow').css('background', '#37838B');

			}
		}
		ajax_adapter($param);
}
