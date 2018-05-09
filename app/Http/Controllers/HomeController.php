<?php

namespace App\Http\Controllers;
use App\CandidateInfo;
use App\PostJob;
use App\Job;
use Auth;
use App\User;
use App\Skills;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
      {
        if(\Auth::user())
        {
            if(\Auth::user()->type=='employer')
                return $this->employerDashboard();
            else

               return $this->CanadatiesDashboard();
        }
        else
            return view('home');
     }
    public function CanadatiesDashboard()
    {
       
        $CandidateInfo=\Auth::user()->CanInfo()->first();
        $jobName=Job::where('id',$CandidateInfo->job_id)->first();
        $age=\Auth::user()->getAge(\Auth::user()->Birthday);
        $SKills_Can=\Auth::user()->getUserSkill()->get();
        
        //Recomanded jobs  accoriding to 
        $RecommandJobs = PostJob::where('job_id',$CandidateInfo->job_id)
                          ->orwhere('country_id',$CandidateInfo->country_id)
                          ->get();

                         // dd($RecommandJobs);
                         //Skills ->orwhere('country_id',$CandidateInfo->country_id) 
        //Candidates Looking For The Same Job
        $Candidates=CandidateInfo::where('job_id',$CandidateInfo->job_id)
                                   ->where('user_id','!=',\Auth::user()->id)
                                   ->get();                  

        //Matching job 
      $MatchingJobs = PostJob::where('job_id',$CandidateInfo->job_id)
                       ->get(); 

        //Prefered Country

            return view('Arabic.Candadties.CandadtiesDashboard',compact('age','MatchingJobs','Candidates','RecommandJobs','jobName','CandidateInfo'));
    }


    public function getjobsbycountry()
    {
        $CandidateInfo=\Auth::user()->CanInfo()->first(); 
        $RecommandJobs = PostJob::where('country_id',$CandidateInfo->country_id)
                          ->get(); 
                          return json_encode(['jobs'=>$RecommandJobs]);
                          
    }

    public function employerDashboard()
    {
        $employerJobs = \Auth::user()->postJobs;

        return view('employer.dashboard',compact('employerJobs'));
    }
    public function getNextTopCandidates(Request $request)
    {
        $topCandidates = collect();
        $job = \App\PostJob::find($request['jobId']);
        $candidates = \App\CandidateInfo::where('id','>',$request['last_candidate_id'])->get();
        foreach ($candidates as $key => $candidate) {
            if($candidate->job_id == $job->job_id && $candidate->nationality == $job->nationality && $candidate->country_id == $job->country_id)
            {
                $candidate['order']=1;
                $topCandidates->push($candidate);
            }
            // 2 in common
            elseif ($candidate->job_id == $job->job_id && $candidate->country_id == $job->country_id && $candidate->nationality != $job->nationality)
            {
                # code...
                $candidate['order']=3;
                $topCandidates->push($candidate);   
            }
            elseif ($candidate->job_id == $job->job_id && $candidate->nationality == $job->nationality && $candidate->country_id != $job->country_id)
            {
                # code...
                $candidate['order']=3;
                $topCandidates->push($candidate);   
            }
            if(count($topCandidates)>5)
                break;
        }
        $html = view('employer.load_more_c',compact('topCandidates'))->render();
        return ['html'=>$html,'new_last_id'=>$topCandidates->last()->id];
    }

    public function getNextJobCandidates(Request $request)
    {
        $jobId= $request['jobId'];
        $similarJobs =\App\PostJob::where('job_id',$request['jobId'])->where('id','>',$request['post_job_id'])->get();
        $similarJobs->take(6);
        $html = view('employer.load_more_j_c',compact('similarJobs'))->render();
        return ['html'=>$html,'new_last_id'=>$similarJobs->last()->id];
    }
}