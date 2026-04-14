<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entities;
use App\Models\Approver;
use App\Models\Department;

class SettingController extends Controller
{
    public function index()
    {
        $entities = Entities::with('stamps')->get();
        $approvers = Approver::with('entity')->get();
        $departments = Department::all();

        //dd($entities);

        return view('admin.setting.index', compact('entities', 'approvers', 'departments'));
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.setting.index')->with('success', 'Setting updated successfully');
    }

    public function edit()
    {
        return view('admin.setting.edit');
    }

    public function update(Request $request)
    {
        return redirect()->route('admin.setting.index')->with('success', 'Setting updated successfully');
    }

    #Edit Entity
    public function editEntity($id)
    {
        $entity = Entities::find($id);
        return view('admin.setting.edit', compact('entity'));
    }

    #Edit Department
    public function editDepartment($id)
    {
        $department = Department::find($id);
        return view('admin.setting.edit', compact('department'));
    }

    #Edit Approver
    public function editApprover($id)
    {
        $approver = Approver::find($id);
        return view('admin.setting.edit', compact('approver'));
    }
}
