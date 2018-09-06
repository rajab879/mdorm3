<?php

namespace App\Http\Controllers;

use App\Tblstudent;
use App\Tbllate;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function AddLateIndex(){


        $stdobj= new Tblstudent();
        $std=array('std'=>$stdobj);
        $listarr= StudentController::LoadDataList();
        $listarr["std"]=$std;//add new element to array with key std and keep all previous key the same


        return view("latestudent.addlatestudent",$listarr);
    }



    public  function AddLate($semid,$stdid){

//        if($id!=null)
//
//        $stdobj= Tblstudent::find($id);//change it to include semid
        if($stdid!=null && $semid!=null){

            // $stdobj= Tblstudent::find($id);//change it to include semid
            $stdobj = Tblstudent::where('stdid', $stdid)->where('semid',$semid)->first();;//must use first
      //  dd($stdobj);
        }
        else
            $stdobj= new Tblstudent();


       if($stdobj->semid!=$semid)
           this.AddLateIndex();

        $std=array('std'=>$stdobj);

        $listarr= StudentController::LoadDataList();

        $imagefound=StudentController::CheckImageExist($stdobj->semid,$stdobj->stdid);
       // $listarr["imagefound"]=$imagefound;
        $stdobj->Col001=$imagefound?1:0;

        $listarr["std"]=$std;//add new element to array with key std and keep all previous key the same

        return view("latestudent.addlatestudent",$listarr);
    }

    public function AddLatejson(Request $request)
    {
        try {
            $rules = array(
                'stdid' => 'required|size:9',
                'semlist' => 'required|numeric',
                // 'shiftid'=>'required|numeric',
                'latenote' => 'required|min:3|max:500',
                'latedate' => 'required|date_format:"d/m/Y',
                'latehour' => 'required|integer|between:1,12',
                'latemin' => 'required|integer|between:0,59',
            );
            $validator = Validator::make($request->all(), $rules);

            // Validate the input and return correct response
            if ($validator->fails()) {
                $errors = $validator->getMessageBag()->toArray();
                return response()->json(array('errors' => $errors), 422);
            }

            $today = new DateTime("now");
            //        $date2 = new DateTime("tomorrow");
            //
            //        var_dump($date1 == $date2);
            //        var_dump($date1 < $date2);
            //        var_dump($date1 > $date2);
            //
            // $today = date("Y-m-d");//do not use it in comparison


            $dateFormat = 'd/m/Y';
            $stringDate = $request->latedate;
            $date = DateTime::createFromFormat($dateFormat, $stringDate);

            //$nowUtc = new \DateTime( 'now',  new \DateTimeZone( 'UTC' ) );
            // $nowUtc->setTimezone( new \DateTimeZone( 'asia/dubai' ) );

            //  echo date_format($date, 'Y-m-d H:i:s');


            if ($date > $today) {

                $errors = array('date' => 'error in date');
                return response()->json(array('errors' => $errors), 422);
            }

            $shiftid = session('shiftid');

            $query = Tblstudent::find($request->id);

            $querylate = new Tbllate();
            $querylate->shiftid = $shiftid;
            $querylate->userid = 1;

            $querylate->serid = $request->id;
            $querylate->stdid = $request->stdid;
            $querylate->semid = $request->semlist;
            $querylate->latenote = $request->latenote;
            $querylate->latedate = $request->latedate . ' ' . $request->latehour . ':' . $request->latemin;

            // $querylate->latehour=$request->latehour;
            //$querylate->latemin=$request->latemin;

            $querylate->save();
            return response()->json(array('d' => 'Created Successfully'), 200);
            } catch (\Exception $exception){
                   // return response()->json(array('errors' =>'Check input data'), 500);
            return response()->json(array('errors' =>$exception), 500);
            }
    }

    public function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public  function viewlate(){
        return view("latestudent.viewlatestudent",StudentController::LoadDataList());
    }



    public  function viewlatejson(Request $request){
        $tblstudents = Tbllate::ApplyFilter($request)->paginate(50);
        //$tblstudents = Tbllate::ApplyFilter($request);
        return response()->json( array('d'=>$tblstudents) , 200);
    }

    public  function lateform( $semid,$stdid){
       // sleep(2);
       // return view("latestudent.lateform");

        if($stdid!=null && $semid!=null)

           // $stdobj= Tblstudent::find($id);//change it to include semid
        $stdobj = Tblstudent::where('stdid', $stdid)->where('semid',$semid)->first();
        else
            $stdobj= new Tblstudent();




        $std=array('std'=>$stdobj);

        $listarr= StudentController::LoadDataList();


        $imagefound=StudentController::CheckImageExist($semid,$stdid);

        $stdobj->Col001=$imagefound?1:0;

        $listarr["std"]=$std;//add new element to array with key std and keep all previous key the same

        return view("latestudent.addlatestudentpopup",$listarr);
    }

        public function test(){

        }
}
