<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\AddSettingRequest;
use Illuminate\Support\Facades\DB;
use App\Traits\DeleteModelTrait;
use Storage;

class SettingAdminController extends Controller
{
    use DeleteModelTrait;
    private $setting;
    public function __construct(Setting $setting){
        $this->setting = $setting;
    }
    public function index(){
        $settings = $this->setting->latest()->paginate(5); 
        return view('admin.setting.index',compact('settings'));
    }

    public function create(){
        return view('admin.setting.add');
    }
    public function store(AddSettingRequest $request){
        $this->setting->create([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
            'type'=> $request->type
        ]);
        return redirect()->route('setting.index');
    }
    public function edit($id){
        $setting = $this->setting->find($id);
        return view('admin.setting.edit',compact('setting'));
    }
    public function update(Request $request){
        $this->setting->find($request->id)->update([
            'config_key'=> $request->config_key,
            'config_value' => $request->config_value
        ]);
        return redirect()->route('setting.index');
    }
    public function delete($id){
        return $this->deleteModelTrait($id,$this->setting);
    }
}
