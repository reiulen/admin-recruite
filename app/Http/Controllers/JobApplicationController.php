<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'full_name' => 'required',
            'address' => 'required',
            'poscode' => 'required',
            'country' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'cv' => 'required|mimes:pdf,jpg,jpeg,png|max:5048',
        ]);

        $emailRegex = '/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/';
        $email = $request->email;
        if (!preg_match($emailRegex, $email))
            return response()->json([
                'status' => false,
                'message' => 'Email is not valid.'
            ], 405);

        if($validasi->fails())
            return response()->json([
                'status' => false,
                'message' => $validasi->errors()->first()
            ], 405);

        try {
            if($request->hasFile('cv'))
            $file = upload_file($request->file('cv'), 'curriculum_vitae', 'cv_'. str_replace(' ', '_', $request->full_name));

            JobApplication::create([
                'name' => $request->full_name,
                'address' => $request->address,
                'detail_address' => $request->detail_address,
                'poscode' => $request->poscode,
                'country' => $request->country,
                'email' => $request->email,
                'phone' => $request->phone,
                'document' => $file,
                'hear_about_us' => $request->hear_about_us,
                'message' => $request->additional_comment,
                'extension_file' => $request->file('cv')->getClientOriginalExtension(),
            ]);
        }catch(\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data saved successfully.'
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = JobApplication::find($id);
        if(!$data)
            return response()->json([
                'status' => false,
                'message' => 'Data not found.'
            ], 404);
        return view('detailModalBody', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = JobApplication::find($id);
        if(!$data)
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan.'
            ], 404);

        try {
            if($data->document)
                File::delete($data->document);
            $data->delete();

            return response()->json([
                'status' => true,
                'message' => 'data deleted successfully.'
            ], 200);

        }catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function dataTable(Request $request)
    {
        $data = JobApplication::select('id', 'name', 'address', 'detail_address', 'poscode', 'country', 'email', 'phone', 'document', 'hear_about_us', 'message', 'created_at')
                            ->latest()
                            ->filter($request);

        return DataTables::of($data)
                            ->addindexColumn()
                            ->addColumn('action', function($data) {
                                $action = "<div class='d-flex align-items-center' style='gap: 10px'>
                                            <div role='button' class='btn btn-primary btn-sm detail-data' data-title='".$data->name."' data-id='$data->id'>
                                                <i class='fas fa-eye'></i>
                                            </div>
                                            <div role='button' class='btn btn-danger btn-sm btn-hapus' data-title='".$data->name."' data-id='$data->id'>
                                                <i class='fas fa-trash-alt'></i>
                                            </div>
                                         </div>";
                                return $action;
                            })->addColumn('submitted_at', function($data) {
                                return date('d F Y H:i:s', strtotime($data->created_at));
                            })->rawColumns(['submitted_at', 'action'])
                           ->smart(true)
                           ->make(true);

    }
}
