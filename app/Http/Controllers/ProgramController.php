<?php

namespace App\Http\Controllers;

use Auth;
use App\Program;
use App\Payment;
use DB;
use App\Http\Requests\Program\NewRequest;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getProgramList()
    {   
        $privatePrograms = DB::table('programs')->leftJoin('permit_programs', 'programs.id', '=', 'permit_programs.program_id')
                    ->where('permit_programs.user_id', Auth::user()->id)
                    ->where('programs.active', true)
                    ->select('programs.*')
                   ->get();

        $publicPrograms = Program::active()->notprivate()->newest()->paginate(20);

        return view('program.list',[
            'publicPrograms' => $publicPrograms,
            'privatePrograms' => $privatePrograms,
        ]);
    }

    public function getProgramConfiguration()
    {   
        $getConfigurations = Auth::User()->Configuration()->Active()->By('program_id')->Newest()->paginate(20);

        return view('program.configuration',[
            'configurations' => $getConfigurations,
        ]);
    }

    public function getProgramNew($id){
        $getProgram = Program::where('id', $id)->active()->first();

        if (!$getProgram) return redirect()->route('program.list');

        
        if ($getProgram->private) {
            $permit = Auth::user()->permit_program()->where('program_id', $id)->first();

            if (!$permit) return redirect()->route('program.list');
        }

        $getConfigurations = Auth::user()->configuration()->active()->by('id')->get();

        $getPayments = Payment::adult($getProgram->adult)->active(true)->by('type')->by('rate', 'desc')->get();

        return view('program.new.'.$getProgram->form, [
            'program' => $getProgram,
            'configurations' => $getConfigurations,
            'payments' => $getPayments,
        ]);
    }

    public function postProgramNew(NewRequest $request, $id){

        $getProgram = Program::Active()->findOrFail($id);

        if ($getProgram->private) {
            if ($getProgram->private_user_id != Auth::user()->id) {
                return redirect()->route('program.list');
            }
        }

        var_dump($id);
        dd($request->get('payments'));
    }
}
