<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tbllate extends Model
{
    public $table="tbllates";
    function tblshifts(){

        return $this->belongsTo(Tblshift::class,'shiftid');
    }

    function tblstudents(){
       // $table->foreign(['semid', 'stdid'])->references(['semid', 'stdid'])->on('tblstudents');

      //return $this->belongsTo(Tblstudent::class, 'semid,stdid','semid,stdid');
      //  return $this->belongsTo(Tblstudent::class, 'semid,stdid');

           return $this->belongsTo(Tblstudent::class, 'serid');

    }


//
    function users(){

        //return $this->belongsTo('App\User',userid);
        return $this->belongsTo(User::class, 'userid');
    }

    public static function ApplyFilter(\Illuminate\Http\Request  $request)
    {
        //$query = new Tbllate() ;//then apply paginate without call all()
        $query = Tbllate::query();
       // $query = Tbllate::select ('stdid','semid','id');



            $query = $query->with('tblshifts');
            $query = $query->with('tblstudents','tblstudents.tblbuilds','tblstudents.tblroomtypes','tblstudents.tblcolleges','tblstudents.tblnationalitys','tblstudents.tblsems');




        if ($request->filled('stdid')) {
            $query->where('stdid', $request->stdid);
        }


        if ($request->filled('semlist')) {//exists direct in tbllate
            $query->where('semid', $request->semlist);
        }




        if ($request->filled('roomno')) {
            $query->whereHas('tblstudents', function ($query2) use($request)  {
                $query2->where('roomno',  $request->roomno);
            }) ;
        }


        if ($request->filled('fname')) {

            $query->whereHas('tblstudents', function ($query2) use($request)  {
                $query2->where('fname', 'like', '%' . $request->fname . '%');
            }) ;
        }

        if ($request->filled('mobile')) {

            $query->whereHas('tblstudents', function ($query2) use($request)  {
                $query2->where('mobile', 'like', '%' . $request->mobile . '%');
            }) ;
        }


        if ($request->filled('extension')) {
            $query->whereHas('tblstudents', function ($query2) use($request)  {
                $query2->where('extension', $request->extension);
            }) ;
        }


        if ($request->filled('buildidlist')) {
            $query->whereHas('tblstudents.tblbuilds', function ($query2) use($request)  {
                $query2->where('tblbuilds.id',  $request->buildidlist);
            }) ;
        }

        if ($request->filled('roomtypelist')) {
            $query->whereHas('tblstudents.tblroomtypes', function ($query2) use($request)  {
                $query2->where('tblroomtypes.id',  $request->roomtypelist);
            }) ;
        }

        if ($request->filled('collegelist')) {
            $query->whereHas('tblstudents.tblcolleges', function ($query2) use($request)  {
                $query2->where('tblcolleges.id',  $request->collegelist);
            }) ;
        }

        if ($request->filled('nationalityidlist')) {
            $query->whereHas('tblstudents.tblnationalitys', function ($query2) use($request)  {
                $query2->where('tblnationalitys.id',  $request->nationalityidlist);
            }) ;
        }

        if ($request->filled('latearrage')) {

            if ($request->filled('lategreaterthan')) {
                $query = $query->selectRaw('*, COUNT(*) as total')->havingRaw("COUNT(*) >=" . $request->lategreaterthan);
            } else
                $query = $query->selectRaw('*, COUNT(*) as total');


            $query = $query->groupBy('stdid', 'semid')->orderBy('total', 'desc');;// in config/database.php   'strict' => false,

        }

        return  $query  ;
        //  ->groupBy('stdid','id','semid','shiftid','latedate','latenote','userid','hostname','serid','created_at','updated_at');

    }



}
