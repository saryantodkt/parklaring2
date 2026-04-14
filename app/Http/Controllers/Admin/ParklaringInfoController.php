<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParklaringInfo;
use App\Models\Department;
use App\Models\Contracts;
use App\Models\Entities;
use App\Models\Template;
use App\Models\ProbationStatuses;
use App\Models\Approver;
use PDF;

class ParklaringInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parklarings = ParklaringInfo::orderBy('id', 'desc')->with('entity')->paginate(10);
        return view('admin.parklaring.index', compact('parklarings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $departments = Department::all();
        $entities = Entities::all();
        $templates = Template::all();
        $probation_status = ProbationStatuses::all();

        return view('admin.parklaring.create', compact('departments','entities','templates','probation_status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->toArray());

        $request->validate([
            'entity' => 'required',
            'employee_name' => 'required',
            //'last_position' => 'required',
            //'department_id' => 'required',
            //'join_date' => 'required|date',
            //'resignation_date' => 'required|date',
            'date_approved' => 'required|date',
        ]);

        $parklaring = new ParklaringInfo();
        $parklaring->entity_id = $request->entity;
        $parklaring->document_no = generateDocumentNo($request->nik,$request->entity,$request->date_approved);
        $parklaring->employee_name = $request->employee_name;
        $parklaring->nik = $request->nik;
        $parklaring->last_position = $request->last_position;

        if($request->template == 2){
            $parklaring->probation_status_id = $request->probation_status;
        }else{
            $parklaring->probation_status_id = null;
        }

        $parklaring->department_id = $request->department_id;
        $parklaring->date_approved = $request->date_approved;
        //Get Approver ID based on Entity_id
        $parklaring->approver_id = getApproverId($request->entity);

        if ($request->hasFile('exit_clearance_form')) {

            $directory = public_path('exit_clearance_form');
            if (!\Illuminate\Support\Facades\File::exists($directory)) {
                \Illuminate\Support\Facades\File::makeDirectory($directory, 0755, true);
            }
            $file = $request->file('exit_clearance_form');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('exit_clearance_form'), $filename);
            $parklaring->exit_clearance_form = $filename;
        }

        if ($request->hasFile('resignation_form')) {
            $directory = public_path('resignation_form');
            if (!\Illuminate\Support\Facades\File::exists($directory)) {
                \Illuminate\Support\Facades\File::makeDirectory($directory, 0755, true);
            }
            $file = $request->file('resignation_form');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('resignation_form'), $filename);
            $parklaring->resignation_form = $filename;
        }

        $parklaring->publish = $request->publish;
        
        // Generate unique code in format XXXX-XXXX-XXXX-XXXX
        $randomStr = \Illuminate\Support\Str::random(16);
        $parklaring->unique_code = substr($randomStr, 0, 4) . '-' . substr($randomStr, 4, 4) . '-' . substr($randomStr, 8, 4) . '-' . substr($randomStr, 12, 4);
        
        // Generate and save QR Code
        $qrUrl = config('app.url') . '/' . $parklaring->unique_code;

        $qrDirectory = public_path('QR');
        if (!\Illuminate\Support\Facades\File::exists($qrDirectory)) {
            \Illuminate\Support\Facades\File::makeDirectory($qrDirectory, 0755, true);
        }
        $svgSource = \Milon\Barcode\Facades\DNS2DFacade::getBarcodeSVG($qrUrl, 'QRCODE');
        \Illuminate\Support\Facades\File::put($qrDirectory . '/' . $parklaring->unique_code . '.svg', $svgSource);
        
        //dd($svgSource);
        //$parklaring->qr_image = $svgSource; 

        $parklaring->template_id = $request->template;
        #sign Position
        $parklaring->sign_position = getRandomLeft().','.getRandomBottom().',0,'.getRandomLeft().','.getRandomBottom().','.getRandDegree();

        #If template non Contract, join_date and resignation_date are required
        if ($request->template != 3) {
            $parklaring->join_date = $request->join_date;
            $parklaring->resignation_date = $request->resignation_date;

            $parklaring->save();

            
        }else{
            $parklaring->save();
            #If template is Contract, join_date and resignation_date are not required
            #Save array of contract name, start date, and end date to table contracts
            foreach ($request->contract_name as $key => $value) {
                $contract = new Contracts();
                $contract->parklaring_info_id = $parklaring->id;
                $contract->contract_name = $value;
                $contract->contract_start_date = $request->contract_start_date[$key];
                $contract->contract_end_date = $request->contract_end_date[$key];
                $contract->save();
            }
        }

        //$this->generatePDF($parklaring->id);

        return redirect('/admin/parklaring')->with('success', 'Record created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::all();
        $entities = Entities::all();
        $templates = Template::all();
        $probation_status = ProbationStatuses::all();

        $parklaring = ParklaringInfo::findOrFail($id);

        //dd(count($parklaring->contracts));
        return view('admin.parklaring.edit', compact('parklaring','departments','entities','templates','probation_status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'entity' => 'required|boolean',
            //'document_no' => 'required',
            'employee_name' => 'required|string',
            //'last_position' => 'required|string',
            //'department_id' => 'required',
            //'join_date' => 'required|date',
            //'resignation_date' => 'required|date',
            'date_approved' => 'required|date',
        ]);


        $parklaring = ParklaringInfo::findOrFail($id);
        $parklaring->entity_id = $request->entity;
        $parklaring->document_no = generateDocumentNo($request->nik,$request->entity,$request->date_approved);
        $parklaring->employee_name = $request->employee_name;
        $parklaring->nik = $request->nik;
        $parklaring->last_position = $request->last_position;
        $parklaring->department_id = $request->department_id;
        $parklaring->date_approved = $request->date_approved;
        $parklaring->template_id = $request->template;

        if ($request->hasFile('exit_clearance_form')) {

            #If current has file in database, remove existing and update with the new one
            if($parklaring->exit_clearance_form){

                $old_file = public_path('exit_clearance_form') . '/' . $parklaring->exit_clearance_form;
                if(file_exists($old_file)){
                    unlink($old_file);
                }
            }

            $directory = public_path('exit_clearance_form');
            if (!\Illuminate\Support\Facades\File::exists($directory)) {
                \Illuminate\Support\Facades\File::makeDirectory($directory, 0755, true);
            }

            $file = $request->file('exit_clearance_form');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('exit_clearance_form'), $filename);
            $parklaring->exit_clearance_form = $filename;
        }

        if ($request->hasFile('resignation_form')) {

            #If current has file in database, remove existing and update with the new one
            if($parklaring->resignation_form){

                $old_file = public_path('resignation_form') . '/' . $parklaring->resignation_form;
                if(file_exists($old_file)){
                    unlink($old_file);
                }
            }

            $directory = public_path('resignation_form');
            if (!\Illuminate\Support\Facades\File::exists($directory)) {
                \Illuminate\Support\Facades\File::makeDirectory($directory, 0755, true);
            }

            $file = $request->file('resignation_form');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('resignation_form'), $filename);
            $parklaring->resignation_form = $filename;
        }

        $parklaring->publish = $request->publish;

        if($request->template == 2){
            $parklaring->probation_status_id = $request->probation_status;
        }else{
            $parklaring->probation_status_id = null;
        }

        #If template non Contract, join_date and resignation_date are required
        if ($request->template != 3) {
            $parklaring->join_date = $request->join_date;
            $parklaring->resignation_date = $request->resignation_date;

            $parklaring->save();

            
        }else{
            $parklaring->save();
            #If template is Contract, join_date and resignation_date are not required
            #Save array of contract name, start date, and end date to table contracts

            #update existing contracts
            $contracts = Contracts::where('parklaring_info_id', $parklaring->id)->get();
            foreach ($contracts as $key => $contract) {
                $contract->contract_name = $request->contract_name[$key];
                $contract->contract_start_date = $request->contract_start_date[$key];
                $contract->contract_end_date = $request->contract_end_date[$key];
                $contract->save();
            }
        }

        return redirect('/admin/parklaring')->with('success', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parklaring = ParklaringInfo::findOrFail($id);
        $parklaring->delete();

        return redirect('/admin/parklaring')->with('success', 'Record deleted successfully.');
    }

    public function delete_exit_clearance_form($id)
    {

        $parklaring = ParklaringInfo::findOrFail($id);
        $parklaring->exit_clearance_form = null;
        $parklaring->save();

        return response()->json([
            'success' => true,
            'message' => 'File deleted successfully.'
        ]);
    }

    public function delete_resignation_form($id)
    {
        $parklaring = ParklaringInfo::findOrFail($id);
        $parklaring->resignation_form = null;
        $parklaring->save();

        return response()->json([
            'success' => true,
            'message' => 'File deleted successfully.'
        ]);

    }

    public function generatePDF($id)
    {
        $parklaring = ParklaringInfo::findOrFail($id);
        $template = Template::findOrFail($parklaring->template_id);
        $is_pdf = true;
        #create file pdf based on template and parklarin info data then save it to pdfs folder
        $pdf = PDF::loadView('admin.parklaring.pdf', compact('parklaring', 'template', 'is_pdf'))
                  ->setPaper('a4', 'portrait')
                  ->setOptions(['isRemoteEnabled' => true]);
        $pdf->save(public_path('pdfs') . '/' . $parklaring->nik . '.pdf');
        $parklaring->file_pdf = $parklaring->nik . '.pdf';
        $parklaring->save();
        return true;
    }

    public function getApprover($id)
    {
        $entity_id = $id;
        $approver = Approver::where('entity_id', $entity_id)->first();
        return response()->json([
            'approver_name' => $approver->approver_name,
            'approver_position' => $approver->approver_position,
        ]);
    }
}
