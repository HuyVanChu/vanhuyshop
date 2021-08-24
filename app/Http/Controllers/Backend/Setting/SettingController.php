<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\AddImagePolicyRequest;
use App\Http\Requests\Admin\Setting\EditFooterRequest;
use App\Http\Requests\Admin\Setting\EditImagePolicyRequest;
use App\Http\Requests\Admin\Setting\SettingRequest;
use App\Http\Requests\Admin\Setting\SloganRequest;
use App\Http\Requests\Admin\Slide\AddSlideRequest;
use App\Http\Requests\Admin\Slide\EditSlideRequest;
use App\Models\Banner;
use App\Models\FooterDetail;
use App\Models\Footers;
use App\Models\Image_policy;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\{Comment_Product, CommentBlog, Contact, Customers};
use Carbon\Carbon;

class SettingController extends Controller
{
    public function TableSetting()
    {
        $data['setting'] = Setting::where('state', 1)->first();
        $data['image_policy'] = Image_policy::all();
        $data['footer'] = Footers::where('state', '1')->first();
        $data['footer_2'] = Footers::where('state', '2')->first();
        $data['footer_3'] = Footers::where('state', '3')->first();
        return view('backend.eCommeerce.setting.setting', $data);
    }
    public function logopost(SettingRequest $request, $id)
    {
        $setting = Setting::find($id);
        if ($request->image != null) {
            $file_old = public_path('\slogan\\') . $setting->logo;
            if (file_exists($file_old) != null && $setting->image != 'no-img.jpg') {
                unlink($file_old);
            }
            $file = $request->file('image');
            $nameImageValue = 'virgin7.' . $file->extension();
            $destinationPath = public_path('slogan\\');
            $file->move($destinationPath, $nameImageValue);
            $setting->logo = $nameImageValue;
            $setting->state = 1;
            $setting->save();
            return redirect()->back()->with('thong-bao-thanh-cong', 'Cập nhật thành công Logo');
        } else {
            $setting->logo = 'no-img.jpg';
            $setting->state = 1;
            $setting->save();
            return redirect()->back()->with('thong-bao-thanh-cong', 'Cập nhật thành công Logo');
        }
    }
    public function settingslogan(SloganRequest $request, $id)
    {
        $setting = Setting::find($id);
        $setting->slogan = $request->slogan;
        $setting->state = 1;
        $setting->save();
        return redirect()->back()->with('thong-bao-thanh-cong', 'Cập nhật thành công Slogan');
    }
    public function settingaddspolict(AddImagePolicyRequest $request)
    {
        $image_policy = new Image_policy();
        $image_policy->icon = $request->icon;
        $image_policy->content = $request->content;
        $image_policy->save();
        return redirect()->back()->with('thong-bao-thanh-cong', 'Thêm thành công ảnh chính sách');
    }
    public function settingeditspolict(EditImagePolicyRequest $request, $id)
    {
        $image_policy = Image_policy::find($id);
        $image_policy->icon = $request->icon;
        $image_policy->content = $request->content;
        $image_policy->save();
        return redirect()->back()->with('thong-bao-thanh-cong', 'Cập nhật thành công ảnh chính sách');
    }
    public function SettingDeleteSpolict($id)
    {
        $image_policy = Image_policy::find($id);
        $image_policy->delete();
        return redirect()->back()->with('thong-bao-thanh-cong', 'Xóa thành công ảnh chính sách');
    }
    public function addfooter(Request $request)
    {
        //dd($request->all());
    }
    public function editfooter(EditFooterRequest $request, $id)
    {
        $footer = Footers::find($id);
        $footer->title = $request->title;
        $footer->content = $request->content;
        $footer->save();
        return redirect()->back()->with('thong-bao-thanh-cong', 'Cập nhật thành công chân trang 1');
    }
    public function editdetailfooter(Request $request, $id)
    {
        $footerDetail = FooterDetail::find($id);
        $footerDetail->content = $request->title;
        $footerDetail->footer_id = $request->footer_id;
        $footerDetail->save();
        return redirect()->back()->with('thong-bao-thanh-cong', 'Cập nhật thành công chân trang 1');
    }
    public function deldetailfooter($id)
    {
        $footerDetail = FooterDetail::find($id);
        $footerDetail->delete();
        return redirect()->back()->with('thong-bao-thanh-cong', 'Xóa thành công 1 chi tiết chân trang');
    }
    public function adddetailfooter(Request $request)
    {
        $footerDetail = new FooterDetail();
        $footerDetail->content = $request->content;
        $footerDetail->footer_id = $request->footer_2;
        $footerDetail->save();
        return redirect()->back()->with('thong-bao-thanh-cong', 'Thêm thành công 1 chi tiết chân trang 2');
    }
    public function Slide()
    {
        $data['slides'] = Banner::paginate(15);
        return view('backend.eCommeerce.setting.slide', $data);
    }
    public function AddSlide(AddSlideRequest $request)
    {
        $banner = new Banner();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $nameValue = Str::slug($request->name);
            $nameImageValue = $nameValue . '.' . $image->extension();
            $file_old = public_path('slides\\') . $nameImageValue;
            if (file_exists($file_old) != null) {
                $name = $nameValue . Str::random(2);
                $nameImageValue = $name . '.' . $image->extension();
                $destinationPath = public_path('slides\\');
                $image->move($destinationPath, $nameImageValue);
                $banner->image = $nameImageValue;
            } else {
                $destinationPath = public_path('slides\\');
                $image->move($destinationPath, $nameImageValue);
                $banner->image = $nameImageValue;
            }
            $banner->name = $request->name;
            $banner->slug = Str::slug($request->name);;
            $banner->save();
        }
        return redirect()->back()->with('thong-bao', 'Đã thêm thành công Slide Website');
    }
    public function EditSlide(Request $request, $id)
    {
        $banner = Banner::find($id);
        if ($request->image != null) {
            $file_old = public_path('slides\\') . $banner->image;
            if (file_exists($file_old) != null && $banner->image != 'no-img.jpg') {
                unlink($file_old);
            }
            $file = $request->file('image');
            $nameValue = Str::slug($request->name);
            $nameImageValue = $nameValue . Str::random(2) . '.' . $file->extension();
            $destinationPath = public_path('slides\\');
            $file->move($destinationPath, $nameImageValue);
            $banner->image = $nameImageValue;
            $banner->name = $request->name;
            $banner->slug = $nameValue;
            $banner->save();
            return redirect()->back();
        } else {
            $banner->image = $banner->image;
            $banner->name = $request->name;
            $banner->slug = Str::slug($request->name);
            $banner->save();
            return redirect()->back();
        }
    }
    public function delSlide($id)
    {
        $banner = Banner::find($id);
        $file_old = public_path('slides\\') . $banner->image;
        if (file_exists($file_old) != null && $banner->image != 'no-img.jpg') {
            unlink($file_old);
        }
        $banner->delete();
        return redirect()->back()->with('thong-bao', 'Đã xóa thành công Slide Website');
    }
    public function settingcontact()
    {
        $data['contact'] = Contact::find(1);
        return view('backend.contact.contact', $data);
    }
    public function editcontact(Request $request, $id)
    {
        $data['contact'] = Contact::find($id);
        if ($request->subtitle1) {
            $data['subtitle1'] = 1;
        } elseif ($request->subtitle2) {
            $data['subtitle2'] = 1;
        } elseif ($request->subtitle3) {
            $data['subtitle3'] = 1;
        }
        return view('backend.contact.edit_contact', $data);
    }
    public function editcontactpost(Request $request)
    {
        if ($request->subtitle1) {
            $contact = Contact::find($request->subtitle1);
            $contact->title1 = $request->title1;
            $contact->save();
            return redirect()->route('admin.settingcontact')->with('thong-bao-thanh-cong', 'Đã cập nhật thành công title 1');
        } elseif ($request->subtitle2) {
            $contact = Contact::find($request->subtitle2);
            $contact->title2 = $request->title2;
            $contact->save();
            return redirect()->route('admin.settingcontact')->with('thong-bao-thanh-cong', 'Đã cập nhật thành công title 2');
        } elseif ($request->subtitle3) {
            $contact = Contact::find($request->subtitle3);
            $contact->title3 = $request->title3;
            $contact->save();
            return redirect()->route('admin.settingcontact')->with('thong-bao-thanh-cong', 'Đã cập nhật thành công title 3');
        }
    }
    public function getlogopost()
    {
        return redirect()->back();
    }
    public function getsettingslogan()
    {
        return redirect()->back();
    }
    public function getsettingaddspolict()
    {
        return redirect()->back();
    }
    public function getsettingeditspolict($id)
    {
        return redirect()->back();
    }
    public function getaddfooter()
    {
        return redirect()->back();
    }
    public function geteditfooter($id)
    {
        return redirect()->back();
    }
    public function geteditdetailfooter($id)
    {
        return redirect()->back();
    }
    public function getadddetailfooter()
    {
        return redirect()->back();
    }
    public function getAddSlide()
    {
        return redirect()->back();
    }
    public function getEditSlide()
    {
        return redirect()->back();
    }
}
