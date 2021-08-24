<?php
function alert_success($alert_success)
{
    if ($alert_success) {
        echo '
        <div style="background: rgb(5, 201, 31)" class="alert border-0 alert-dismissible fade show py-2">
									<div class="d-flex align-items-center">
										<div class="font-35 text-white"><i class="bx bxs-check-circle"></i>
										</div>
										<div class="ms-3">
											<h6 class="mb-0 text-white">Thành công</h6>
											<div class="text-white">' . $alert_success . '</div>
										</div>
									</div>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
        ';
    }
}
function alert_successSite($alert_success)
{
    if ($alert_success) {
        echo '
        <div style="background: rgb(5, 201, 31)" class="alert border-0 alert-dismissible fade show py-2">
									<div class="d-flex align-items-center">
										<div class="font-35 text-white"><i class="bx bxs-check-circle"></i>
										</div>
										<div class="ms-3">
											<p><h6 class="mb-0 text-white">Đăng kí thành công</h6></p>
                                            <p><a href="'.route('sigin_site').'">Bám vào đây để đăng nhập</a></p>
										</div>
									</div>
								</div>
        ';
    }
}
function alert_success_del($alert_success)
{
    if ($alert_success) {
        echo '
        <div style="background: #17a00e" class="alert border-0 alert-dismissible fade show py-2">
									<div class="d-flex align-items-center">
										<div class="font-35 text-white"><i class="bx bx-check-circle mr-1"></i>
										</div>
										<div class="ms-3">
											<h6 class="mb-0 text-white">Thành công</h6>
											<div class="text-white">' . $alert_success . '</div>
										</div>
									</div>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
        ';
    }
}
function alert_success_del1($alert_success)
{
    if ($alert_success) {
        echo '
        <div style="background: #17a00e" class="alert border-0 alert-dismissible fade show py-2">
									<div class="d-flex align-items-center">
										<div class="font-35 text-white"><i class="bx bx-check-circle mr-1"></i>
										</div>
										<div class="ms-3">
											<h6 class="mb-0 text-white">Lỗi</h6>
											<div class="text-white">' . $alert_success . '</div>
										</div>
									</div>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
        ';
    }
}
function show_errors_request($errors, $name)
{
    if ($errors->has($name)) {
        echo '
        <div style="background: #f41127" class="alert border-0 border-start border-5 border-white alert-dismissible fade show py-2">
									<div class="d-flex align-items-center">
										<div class="font-35 text-white"><i class="bx bx-info-circle"></i>
										</div>
										<div class="ms-3">
											<h6 class="mb-0 text-white">Cảnh báo lỗi</h6>
											<div>' . $errors->first($name) . '</div>
										</div>
									</div>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>

        ';
    }
}
function show_errors_request_site($errors, $name)
{
    if ($errors->has($name)) {
        echo '
        <div style="background: #f41127" class="alert border-0 border-start border-5 border-white alert-dismissible fade show py-2">
									<div class="d-flex align-items-center">
										<div class="font-35 text-white"><i class="bx bx-info-circle"></i>
										</div>
										<div class="ms-3">
											<h6 class="mb-0 text-white">Cảnh báo lỗi</h6>
											<div>' . $errors->first($name) . '</div>
										</div>
									</div>

								</div>

        ';
    }
}
function alert_warning($alert_warning)
{
    if ($alert_warning) {
        echo '
    <div style="background: #FFC107" class="alert border-0 alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
        <div class="font-35 text-white"><i class="bx bx-info-circle"></i>
        </div>
        <div class="ms-3">
            <h6 class="mb-0 text-white">Cảnh báo lỗi</h6>
            <div class="text-white">' . $alert_warning . '</div>
        </div>
    </div>
    </div>
    ';
    }
}
function category_child($categories, $id, $char)
{
    foreach ($categories as $category_item) {
        if ($category_item['id'] == $id) {
            echo '<option value="' . $category_item['id'] . '" >' . $char . $category_item['name'] . '</option>';
            $val = $category_item['id'];
            foreach ($categories as $category_value) {
                if ($category_value['parent'] == $val) {
                    $val1 = $category_value['id'];
                    category_child($categories, $val1, $char . '--|');
                }
            }
        }
    }
}
// Chọn danh mục cha, list tất cả danh mục con
// Chỉnh sửa danh mục, khi chọn danh mục con. Hiển thị toàn bộ danh mục của cha

function category_child1($categories, $id, $char, $cat_id_choose)
{

    foreach ($categories as $category_item) {
        if ($category_item['id'] == $id) {
            if ($category_item['id'] == $cat_id_choose) {
                echo '<option value="' . $category_item['id'] . '" selected >' . $char . $category_item['name'] . '</option>';
            } else {
                echo '<option value="' . $category_item['id'] . '" >' . $char . $category_item['name'] . '</option>';
            }
            $val = $category_item['id'];
            foreach ($categories as $category_value) {
                if ($category_value['parent'] == $val) {
                    $val1 = $category_value['id'];
                    category_child1($categories, $val1, $char . '--|', $cat_id_choose);
                }
            }
        }
    }
}
function category_child2($categories, $id, $char, $cat_id_choose,$name,$id_CategoryChild2)
{
    foreach ($categories as $category_item) {
        if ($category_item['id'] == $id) {
            if ($category_item['id'] == $cat_id_choose) {
                echo '<option value="' . $category_item['id'] . '" selected >' . $char . $category_item['name'] . '</option>';
            } else {
                echo '<option value="' . $category_item['id'] . '" >' . $char . $category_item['name'] . '</option>';
            }
            $val = $category_item['id'];
            foreach ($categories as $category_value) {
                if ($category_value['parent'] == $val) {
                    $val1 = $category_value['id'];
                    category_child2($categories, $val1, $char . '--|', $cat_id_choose, $name,$id_CategoryChild2);
                }
            }
        }else{
            return '<option value="'.$id_CategoryChild2.'" selected >' . $name . '</option>';
        }
    }
}
function list_category($category, $parentId, $char)
{
    foreach ($category as $value) {
        if ($value['parent'] == $parentId) {
            echo '<option value="' . $value['id'] . '">' . $char . $value['name'] . '</option>';
            $new_parent = $value['id'];
            list_category($category, $new_parent, $char . "--|");
        }
    }
}
function get_categories($array, $parentId, $char, $isParent)
{
    foreach ($array as $value) {
        if ($value['parent'] == $parentId) {
            if ($value['id'] == $isParent) {
                echo '<option selected value="' . $value['id'] . '">' . $char . $value['name'] . '</option>';
            } else {
                echo '<option value="' . $value['id'] . '">' . $char . $value['name'] . '</option>';
            }
            $new_parent = $value['id'];
            get_categories($array, $new_parent, $char . "--|", $isParent);
        }
    }
}
// thêm biến thể
function get_combinations($arrays) {
	$result = array(array());
	foreach ($arrays as $property => $property_values) {
		$tmp = array();
		foreach ($result as $result_item) {
			foreach ($property_values as $property_value) {
				$tmp[] = array_merge($result_item, array($property => $property_value));
			}
		}
		$result = $tmp;
	}
	return $result;
}
// check value edit product
function check_value($product, $value_check)
{
    foreach ($product->values as $value) {
        if($value->id ==$value_check){
            return true;
        }
    }
    return false;

}
function check_var($product,$array)
{
	foreach($product->variant as $row)
	{
		$mang=array();
		foreach ($row->values as $value) {
			$mang[]=$value->id;
		}
		if(array_diff($mang,$array)==NULL)
		{
			return false;
		}
	}
	return true;
}
//input $mang=$product->values   output: array('size'=>array(s,m),'color'=>array('Đỏ',Xanh))
function attr_values($mang)
{
    $result=array();
    foreach($mang as $value)
    {
        $attr=$value->attribute->name;
        // $value->value gán giá trị của cột value vào trong []
        $result[$attr][]=$value->value;
    }
    return $result;
}
// cart
function getprice($product,$array)
{
    foreach ($product->variant as $row) {
        $mang=array();
        foreach ($row->values as $value) {
            $mang[]=$value->value;
        }
        if(array_diff($mang,$array)==null){
            if($row->price==0){
                return $product->price;
            }
            return $row->price;
        }
    }
    return $product->price;
}
function getprice2($product,$array)
{
    foreach ($product->variant as $row) {
        $mang=array();
        foreach ($row->values as $value) {
            $mang[]=$value->value;
        }
        if(array_diff($mang,$array)==null){
            if($row->price==0){
                return $product->price;
            }
            return $row->price;
        }
    }
    return $product->price;
}
function getprice3($product,$array)
{
    foreach ($product->variant as $row) {
        $mang=array();
        foreach ($row->values as $value) {
            $mang[]=$value->value;
        }
        if(array_diff($mang,$array)==null){
            if($row->price==0){
                return $product->price;
            }
            return $row->id;
        }
    }
    return $product->id;
}
function show_ruler($variant,$roler)
{
    if ($variant->hasAnyRole(['super-admin'])){
        echo"checked disabled";
    }
    elseif ($variant->hasPermissionTo(''.$roler.'')){
        echo"checked";
    }
}
