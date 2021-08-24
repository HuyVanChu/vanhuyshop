<?php

use App\Models\Customers;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('tesst', function () {
    echo "1";
 });
Route::get('clear-cache', function () {
    $exitcode = Artisan::call('cache:clear');
});
Route::get('authenticate', 'Backend\Authentication\LoginController@SignIn')->name('admin_get_sigin')->middleware('CheckLogout');
Route::post('authenticate', 'Backend\Authentication\LoginController@SignInPost')->name('admin_post_sigin');

Route::group(['prefix' => 'admin', 'namespace' => 'Backend', 'middleware' => 'CheckLogin'], function () {
    Route::get('', 'AdminController@index')->name('admin.index');
    Route::get('404', 'AdminController@error404')->name('admin.404');
    Route::get('500', 'AdminController@error500')->name('admin.500');

    Route::group(['prefix' => '', 'namespace' => 'Product'], function () {
        // view
        Route::group(['prefix' => '', 'middleware' => 'can:view_product'], function () {
            Route::get('danh-sach-san-pham.html', 'ProductController@List')->name('admin_prd_list');
            Route::get('tim-kiem-san-pham',  'ProductController@SearchProduct')->name('admin_prd_se');
            Route::get('chi-tiet/{slug}',  'ProductController@DetailProduct')->name('admin_prd_detail');
            Route::get('danh-sach-thuoc-tinh-theo-danh-muc',  'ProductController@ListAttr')->name('admin_prd_listattr');
        });
        // add
        Route::group(['prefix' => '', 'middleware' => 'can:add_product'], function () {
            Route::get('them-san-pham', 'ProductController@CreateProduct')->name('admin_prd_create');
            Route::post('them-san-pham-post', 'ProductController@CreateProductPost')->name('admin_prd_createpost');
            Route::get('them-san-pham/chon-danh-muc',  'ProductController@Choose')->name('admin_prd_choose');
            Route::post('them-san-pham',  'ProductController@ChoosePost')->name('admin_prd_choosepost');
            // value
            Route::post('them-gia-tri-thuoc-tinh-san-pham',  'ProductController@AddValuePost')->name('admin_prd_valuepost');
            // attr
            Route::post('them-thuoc-tinh-san-pham',  'ProductController@AddAttrPost')->name('admin_prd_attrpost');
            Route::get('them-gia-bien-the/{slug}',  'ProductController@AddPriceAttr')->name('admin_prd_addpriceattr');
            Route::post('them-gia-bien-the/{slug}',  'ProductController@AddPriceAttrPost');
        });
        // edit
        Route::group(['prefix' => '', 'middleware' => 'can:edit_product'], function () {
            Route::get('sua-san-pham/{slug}',  'ProductController@EditProduct')->name('admin_prd_edit');
            Route::post('sua-san-pham/{id}',  'ProductController@EditProductPost')->name('admin_prd_editPost');
            Route::post('sua-anh-chi-tiet-san-pham/{id}', 'ProductController@EditImageDetailProductPost')->name('admin_prd_editimagedetailpost');
            Route::post('sua-gia-tri-thuoc-tinh-danh-muc',  'ProductController@EditValuePost')->name('admin_prd_editpost');
            Route::get('sua-thuoc-tinh-theo-danh-muc/{slug}',  'ProductController@EditAttribute')->name('admin_prd_editattr');
            Route::post('sua-thuoc-tinh-theo-danh-muc-post/{id}',  'ProductController@EditAttributePost')->name('admin_prd_editattrpost');
        });
        // delete
        Route::group(['prefix' => '', 'middleware' => 'can:delete_product'], function () {
            Route::get('xoa-anh-chi-tiet-san-pham/{id}', 'ProductController@DeleteImageDetailProductPost')->name('admin_prd_delete_imagedetail');
            Route::get('xoa/{id}',  'ProductController@DeleteProduct')->name('admin_prd_delete');
            Route::get('xoa-gia-tri-thuoc-tinh-danh-muc/{id}',  'ProductController@DeleteValuePost')->name('admin_prd_delvalue');
            Route::get('xoa-thuoc-tinh-theo-danh-muc/{slug}',  'ProductController@DelAttr')->name('admin_prd_delattr');
            Route::get('xoa-bien-the/{id}',  'ProductController@DeleteAttr')->name('admin_prd_deleteattr');
        });
        // comment
        Route::group(['prefix' => '', 'middleware' => 'can:view_comment_product'], function () {
            Route::get('binh-luan-san-pham.html',  'ProductController@Comment')->name('admin_cmt_product');
            Route::get('binh-luan-san-pham-da-xu-ly.html',  'ProductController@DaXuLy')->name('admin_cmt_ok');
        });
        Route::group(['prefix' => '', 'middleware' => 'can:add_comment_product'], function () {
            Route::post('binh-luan-san-pham.html',  'ProductController@CommentPost')->name('admin_cmt_productpost')->middleware('can:add_comment_product');
            Route::post('binh-luan-san-pham-da-xu-ly.html',  'ProductController@DaXuLyPost')->middleware('can:add_comment_product');
        });
        Route::get('xoa-binh-luan-san-pham/{id}',  'ProductController@remove')->name('admin_cmt_remove')->middleware('can:delete_comment_product');
    });
    Route::group(['prefix' => '', 'namespace' => 'Category'], function () {
        Route::group(['prefix' => '', 'middleware' => 'can:view_category'], function () {
            Route::get('danh-sach-danh-muc.html', 'CategoryController@List')->name('admin_cat_list');
            Route::get('cau-truc-danh-muc.html', 'CategoryController@Structure')->name('admin_cat_structure');
        });
        Route::group(['prefix' => '', 'middleware' => 'can:add_category'], function () {
            Route::get('chon-danh-muc', 'CategoryController@Chose')->name('admin_cat_chose');
            Route::post('chon-danh-muc-post', 'CategoryController@ChosePost')->name('admin_cat_chosepost');
            Route::get('chon-cap-danh-muc/{slug_cat}', 'CategoryController@ChoseLevel')->name('admin_cat_choselevel');
            Route::post('chon-cap-danh-muc', 'CategoryController@ChoseLevelPost')->name('admin_cat_choselevelpost');
            Route::get('them-danh-muc/{slug}', 'CategoryController@Create')->name('admin_cat_create');
            Route::post('them-danh-muc', 'CategoryController@CreatePost')->name('admin_cat_createpost2');
            // thuộc tính
            Route::post('them-thuoc-tinh', 'CategoryController@AddAttrPost')->name('admin_attr_addttrpost');
            Route::get('danh-sach-thuoc-tinh/{slug}', 'CategoryController@ListAttr')->name('admin_attr_listattr');
        });
        Route::group(['prefix' => '', 'middleware' => 'can:edit_category'], function () {
            Route::get('sua-danh-muc/{slug}', 'CategoryController@Edit')->name('admin_cat_edit');
            Route::post('sua-danh-muc/{id}', 'CategoryController@EditPost')->name('admin_cat_editpost');
            // thuộc tính
            Route::get('sua-thuoc-tinh/{name}', 'CategoryController@EditAttr')->name('admin_attr_editattr');
            Route::post('sua-thuoc-tinh/{name}', 'CategoryController@EditAttrPost')->name('admin_attr_editattrpost');
            Route::get('danh-sach-thuoc-tinh/{slug}', 'CategoryController@ListAttr')->name('admin_attr_listattr');
        });
        Route::group(['prefix' => '', 'middleware' => 'can:delete_category'], function () {
            Route::get('xoa-danh-muc', 'CategoryController@Delete')->name('admin_cat_delete');
            Route::get('xoa-thuoc-tinh/{id}', 'CategoryController@DelAttr')->name('admin_attr_delattr');
        });
    });
    Route::group(['prefix' => '', 'namespace' => 'Order'], function () {
        Route::group(['prefix' => '', 'middleware' => 'can:view_order'], function () {
            Route::get('hoa-don-moi-nhat.html', 'OrderController@List')->name('admin_order_list');
            Route::get('chi-tiet-hoa-don/{id}', 'OrderController@Detail')->name('admin_order_detail');
            Route::get('hoa-don-chua-hoan-thanh.html', 'OrderController@No')->name('admin_order_no');
            Route::get('hoa-don-da-hoan-thanh.html', 'OrderController@Yes')->name('admin_order_yes');

            Route::get('tim-kiem', 'OrderController@Search')->name('admin_order_search');
        });
        Route::get('hoan-thanh-hoa-don/{id}', 'OrderController@OrderSuccess')->name('admin_order_success')->middleware('can:edit_order');
        Route::get('xoa-don-da-hoan/{id}', 'OrderController@Delete')->name('admin_order_delete')->middleware('can:delete_order');
    });
    Route::group(['prefix' => '', 'namespace' => 'User', 'middleware' => ['role:super-admin']], function () {
        Route::group(['prefix' => '', 'middleware' => 'can:view_user'], function () {
            Route::get('danh-sach-quan-tri.html', 'UserController@List')->name('admin_user_list');
            Route::get('chi-tiet-quan-tri/{slug}', 'UserController@Detail')->name('admin_user_detail');
        });
        Route::group(['prefix' => '', 'middleware' => 'can:add_user'], function () {
            Route::get('them-quan-tri', 'UserController@Add')->name('admin_user_add');
            Route::post('them-quan-tri', 'UserController@AddPost')->name('admin_user_addpost');
        });
        Route::group(['prefix' => '', 'middleware' => 'can:edit_user'], function () {
            Route::get('sua-quan-tri/{slug}', 'UserController@Edit')->name('admin_user_edit');
            Route::post('sua-quan-tri/{id}', 'UserController@EditPost')->name('admin_user_edit_post');
            Route::post('sua-quan-tri-post/{id}', 'UserController@EditDetailPost')->name('admin_user_editDetailpost');
        });
        Route::get('xoa-quan-tri/{id}', 'UserController@Delete')->name('admin_user_delete')->middleware('can:delete_user');
    });
    Route::group(['prefix' => '', 'namespace' => 'Blog'], function () {
        Route::group(['prefix' => '', 'middleware' => 'can:view_comment_blog'], function () {
            Route::get('binh-luan-blog-chua-xu-ly.html', 'BLogController@CommentBlogNo')->name('admin.cmtblogno');
            Route::get('binh-luan-blog-da-xu-ly.html', 'BLogController@CommentBlogYes')->name('admin.cmtblogyes');
        });
        Route::group(['prefix' => '', 'middleware' => 'can:add_comment_blog'], function () {
            Route::post('binh-luan-blog-chua-xu-ly.html', 'BLogController@CommentBlogNoPost');
            Route::post('binh-luan-blog-da-xu-ly.html', 'BLogController@CommentBlogYesPost');
        });
        Route::group(['prefix' => '', 'middleware' => 'can:view_blog'], function () {
            Route::get('danh-sach-bai-viet.html', 'BLogController@List')->name('admin.bloglist');
            Route::get('search', 'BLogController@Search')->name('admin.blogsearch');
        });
        Route::group(['prefix' => '', 'middleware' => 'can:add_blog'], function () {
            Route::get('them-bai-viet', 'BLogController@AddBlog')->name('admin.blogadd');
            Route::post('them-bai-viet', 'BLogController@AddBlogPost')->name('admin.blogaddpost');
        });
        Route::group(['prefix' => '', 'middleware' => 'can:edit_blog'], function () {
            Route::get('sua-bai-viet/{id}/{slug}', 'BLogController@EditBlog')->name('admineditblog');
            Route::post('sua-bai-viet/{id}/{slug}', 'BLogController@EditPostBlog')->name('admin.editpostblog');
        });
        Route::get('remove/{id}', 'BLogController@RemoveBlog')->name('admin.removeblog')->middleware('can:delete_blog');
        Route::get('remove-cmt/{id}', 'BLogController@Remove')->name('admin.removecmt')->middleware('can:delete_comment_blog');
    });
    Route::group(['prefix' => '', 'namespace' => 'Trademark'], function () {
        Route::group(['prefix' => '', 'middleware' => 'can:add_trademark'], function () {
            Route::get('them-thuong-hieu', 'TrademarkController@Create')->name('admin_trademark_create');
            Route::post('them-thuong-hieu', 'TrademarkController@CreatePost')->name('admin_trademark_createPost');
        });
        Route::group(['prefix' => '', 'middleware' => 'can:edit_trademark'], function () {
            Route::get('sua-thuong-hieu/{slug}', 'TrademarkController@Edit')->name('admin_trademark_edit');
            Route::post('sua-thuong-hieu/{id}', 'TrademarkController@EditPost')->name('admin_trademark_editPost');
        });
        Route::get('thuong-hieu.html', 'TrademarkController@List')->name('admin_trademark_list')->middleware('can:view_trademark');
        Route::get('xoa-trademark/{slug}', 'TrademarkController@Delete')->name('admin_trademark_delete')->middleware('can:delete_trademark');
    });
    Route::group(['prefix' => '', 'namespace' => 'Authentication'], function () {
        Route::get('logout', 'LoginController@Logout')->name('logout');
    });
    Route::group(['prefix' => 'setting', 'namespace' => 'Setting'], function () {
        Route::get('table-setting', 'SettingController@TableSetting')->name('admin.setting');
        // logo
        Route::post('logo-post/{id}', 'SettingController@logopost')->name('admin.logopost')->middleware('can:edit_logo');
        Route::get('logo-post/{id}', 'SettingController@getlogopost')->middleware('can:view_logo');
        // slogan
        Route::post('setting-slogan/{id}', 'SettingController@settingslogan')->name('admin.slogan')->middleware('can:edit_slogan');
        Route::get('setting-slogan/{id}', 'SettingController@getsettingslogan')->middleware('can:view_slogan');
        // image polyci
        Route::group(['prefix' => '', 'middleware' => 'can:edit_image_polyci'], function () {
            // edit image polyci
            Route::post('setting-edit-image-policy/{id}', 'SettingController@settingeditspolict')->name('admin.edit.image.policy');
            Route::get('setting-edit-image-policy/{id}', 'SettingController@getsettingeditspolict');
        });
        Route::post('setting-add-image-policy', 'SettingController@settingaddspolict')->name('admin.add.image.policy')->middleware('can:add_image_polyci');
        Route::get('setting-add-image-policy', 'SettingController@getsettingaddspolict');
        // remove image polyci
        Route::get('setting-delete-image-policy/{id}', 'SettingController@SettingDeleteSpolict')->name('admin.delete.image.policy')->middleware('can:delete_image_polyci');
        // footer
        Route::post('setting-addfooter', 'SettingController@addfooter')->name('admin.addfooter')->middleware('can:add_footer');
        Route::get('setting-addfooter', 'SettingController@getaddfooter');
        Route::group(['prefix' => '', 'middleware' => 'can:edit_footer'], function () {
            Route::post('setting-editfooter/{id}', 'SettingController@editfooter')->name('admin.editfooter');
            Route::get('setting-editfooter/{id}', 'SettingController@geteditfooter');
        });
        Route::group(['prefix' => '', 'middleware' => 'can:edit_detail_footer'], function () {
            Route::post('setting-editdetailfooter/{id}', 'SettingController@editdetailfooter')->name('admin.editdetailfooter');
            Route::get('setting-editdetailfooter/{id}', 'SettingController@geteditdetailfooter');
        });

        // remove dtail footer
        Route::get('setting-deldetailfooter/{id}', 'SettingController@deldetailfooter')->name('admin.deldetailfooter')->middleware('can:delete_detail_footer');
        Route::group(['prefix' => '', 'middleware' => 'can:add_detail_footer'], function () {
            Route::post('setting-adddetailfooter', 'SettingController@adddetailfooter')->name('admin.adddetailfooter');
            Route::get('setting-adddetailfooter', 'SettingController@getadddetailfooter');
        });

        // slide
        Route::get('setting-slide', 'SettingController@Slide')->name('admin.slide')->middleware('can:view_slide');
        Route::group(['prefix' => '', 'middleware' => 'can:add_detail_footer'], function () {
            Route::post('setting-add-slide', 'SettingController@AddSlide')->name('admin.addslide');
            Route::get('setting-add-slide', 'SettingController@getAddSlide');
        });
        Route::group(['prefix' => '', 'middleware' => 'can:edit_slide'], function () {
            Route::post('setting-edit-slide/{id}', 'SettingController@EditSlide')->name('admin.editslide');
            Route::get('setting-edit-slide/{id}', 'SettingController@getEditSlide');
        });
        Route::get('setting-del-slide/{id}', 'SettingController@delSlide')->name('admin.delslide')->middleware('can:delete_slide');
        // lien he
        Route::get('cau-hinh-trang-lien-he.html', 'SettingController@settingcontact')->name('admin.settingcontact')->middleware('can:view_contact');
        Route::group(['prefix' => '', 'middleware' => 'can:edit_contact'], function () {
            Route::get('sua-lien-he/{id}', 'SettingController@editcontact')->name('editcontact');
            Route::post('sua-lien-he/{id}', 'SettingController@editcontactpost');
        });
    });
});
Route::group(['prefix' => '', 'namespace' => 'Site'], function () {
    Route::get('', 'SiteController@index')->name('index');
    Route::get('dang-ki', 'SiteController@SignUp')->name('site_signup')->middleware('CheckLogoutSite');
    Route::post('dang-ki', 'SiteController@SignUpPost')->middleware('CheckLogoutSite');
    Route::get('dang-nhap', 'SiteController@SignIn')->name('sigin_site')->middleware('CheckLogoutSite');
    Route::post('dang-nhap', 'SiteController@SignInPost')->middleware('CheckLogoutSite');
    Route::post('lay-lai-mat-khau', 'SiteController@ResetPassword')->name('resetpassword');
    Route::get('lay-lai-mat-khau', 'SiteController@GetResetPassword')->name('resetpasswordpost');
    Route::post('checkemail', 'SiteController@CheckEmail')->name('checkemail');
    Route::get('dang-xuat', 'SiteController@Logout')->name('logoutsite');
    Route::get('lien-he.html', 'SiteController@Contact')->name('contact');
    Route::get('trang-khong-ton-tai.html', 'SiteController@Error404')->name('404');
    Route::get('loi-500', 'SiteController@error500')->name('500');
    // blog
    Route::group(['prefix' => ''], function () {
        Route::get('danh-sach-bai-viet.html', 'SiteController@BlogList')->name('blogList');
        Route::post('them-binh-luan/{id}', 'SiteController@AddComment')->name('AddCommentBLog');
        Route::get('them-binh-luan/{id}', 'SiteController@GetAddComment');
        Route::get('phan-hoi', 'SiteController@SendReview')->name('sendreview');
        Route::post('phan-hoi', 'SiteController@SendReviewPost');
        Route::get('noi-dung/{slug}.html', 'SiteController@ContentBlog')->name('contentblog');
    });
    // cart
    Route::group(['prefix' => '', 'namespace' => 'Cart'], function () {
        //Route::get('gio-hang', 'CartController@Cart')->name('cart');
        Route::get('them-gio-hang/{slug}', 'CartController@AddCartShop')->name('addcartshop');
        Route::get('gio-hang', 'CartController@AddCart')->name('cart.add');
        Route::post('gio-hang', 'CartController@AddNumber');
        Route::get('thanh-toan', 'CartController@CheckOut')->name('checkOut');
        Route::get('xoa-don-hang/{id}', 'CartController@RemoveCart')->name('removecart');
        Route::post('giam-gia', 'CartController@DiscountCode')->name('discountcode');
        Route::get('giam-gia', 'CartController@GetDiscountCode');
        Route::post('mua-hang-thanh-cong', 'CartController@CheckoutSuccess')->name('checkoutsuccess');
        Route::get('mua-hang-thanh-cong', 'CartController@CheckoutSuccessGet');
    });
    Route::group(['prefix' => '', 'namespace' => 'Category'], function () {
        Route::get('cua-hang.html', 'CategoryController@ProductShop')->name('category');
    });
    Route::group(['prefix' => '', 'namespace' => 'Product'], function () {
        Route::get('{slug}.html', 'ProductController@ProductDetail')->name('productDetail');
        Route::post('{slug}.html', 'ProductController@AddComment')->name('addcmtprd');
        Route::get('xem-gia/{slug}.html', 'ProductController@showprice')->name('showprice');
        Route::get('updatecart/{rowId}/{qty}', 'ProductController@UpdateCart');
        Route::get('cua-hang', 'ProductController@Shop')->name('shop');
        //Route::get('{attribute}.html', 'ProductController@AttributeShop')->name('catattr');
        Route::get('search', 'ProductController@Search')->name('search');
    });
    // Login FB
    Route::get('login/facebook', 'LoginController@redirectToProvider')->name('site.fb');
    Route::get('login/facebook/callback', 'LoginController@handleProviderCallback');
    // Login Google
    Route::get('login/google', 'LoginController@redirect_social')->name('site.google');
    Route::get('login/google/callback', 'LoginController@callback_social');
});
