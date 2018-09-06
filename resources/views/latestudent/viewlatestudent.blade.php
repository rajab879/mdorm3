@extends('layouts.app')

@section('content')
    <div class="container">





        <?php
        $put=array('test'=>'button','title'=>'المتأخرون');

        ?>
            <form action="student" method="get">
            {{csrf_field()}}
            <input   type=hidden ID="getrequest" name="getrequest" value="1"   />

            <fieldset class="well the-fieldset">
                <legend class="the-legend">
                    {{$put['title']}}
                </legend>

                <div class="row">

                    <div class="col-md-3 col-sm-6">

                        <div class="form-group">
                            <label class="col-md-4 control-label"> الرقم  </label>
                            <div class="col-md-8">
                                <input type="text" ID="stdid" name="stdid" value="{{ old('stdid') }}" class="form-control" placeholder="ادخل الرقم الجامعي" />

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label">اسم الطالب  </label>
                            <div class="col-md-8">
                                <input type="text" ID="fname" name="fname"  value="{{ old('fname')}}" class="form-control" />

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label">المبنى</label>
                            <div class="col-md-8">
                                <select id="buildidlist" name="buildidlist"   class="form-control">
                                    <option  value=''>المبنى</option>
                                    @foreach($tblbuilds as $building)
                                        <option <?php if(old('buildidlist')==$building->id) echo 'selected' ?> value={{$building->id}}>{{$building->build}}</option>

                                    @endforeach
                                </select>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label"> الجنسية </label>
                            <div class="col-md-8">
                                <select ID="nationalityidlist" name="nationalityidlist" class="form-control">
                                    <option   value=''>الجنسية</option>
                                    @foreach($tblnationalitys as $nation)
                                        <option  <?php if(old('nationalityidlist')==$nation->id) echo 'selected' ?> value={{$nation->id}} >{{$nation->nationalityname}}</option>

                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-6">

                        <div class="form-group">
                            <label class="col-md-4 control-label">  الغرفة</label>
                            <div class="col-md-8">
                                <input type="text" ID="roomno" name="roomno" value="{{ old('roomno')}}" class="form-control" />

                            </div>
                        </div>
                    </div>


                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label">الهاتف   </label>
                            <div class="col-md-8">
                                <input type="text" ID="mobile" name='mobile' value="{{ old('mobile')}}" class="form-control" />

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label">الكلية</label>
                            <div class="col-md-8">
                                <select id="collegelist" name="collegelist"  class="form-control">
                                    <option selected value=''>الكلية</option>
                                    @foreach($tblcolleges as $college)
                                        <option  <?php if(old('collegelist')==$college->id) echo 'selected' ?> value={{$college->id}} >{{$college->collegename}}</option>

                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label"> التحويلة </label>
                            <div class="col-md-8">
                                <input type="text" ID="extension" name="extension" value="{{ old('extension')}}" class="form-control" />

                            </div>
                        </div>
                    </div>

                </div>



                <div class="row">



                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label">نوع الغرفة</label>
                            <div class="col-md-8">
                                <select id="roomtypelist" name="roomtypelist" class="form-control">
                                    <option  value=''>نوع الغرفة</option>
                                    @foreach($tblroomtypes as $roomtype)

                                        <option    <?php if(old('roomtypelist')==$roomtype->id) echo 'selected' ?> value={{$roomtype->id}} >{{$roomtype->roomtype}}</option>

                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="control-label"> الفصل</label>
                                <input id="chk" name="chk" type="checkbox"   />
                            </div>

                            <div class="col-md-8">
                                <select ID="semlist" name="semlist"  disabled="true" Font-Bold="True" ForeColor="Red" Font-Size="8pt" class="form-control">
                                    @foreach($tblsems as $tblsem)

                                        <option   <?php
                                                  if(old('semlist')!=null) {

                                                      if(old('semlist')==$tblsem->id) echo 'selected';}else echo 'selected' ?>   value={{$tblsem->id}} >{{$tblsem->semalias}}</option>

                                    @endforeach
                                </select>


                            </div>
                        </div>
                    </div>




                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="control-label">                                 التأخير أكبر من
                                </label>

                            </div>

                            <div class="col-md-8">
                                <input type="text" ID="lategreaterthan" name="lategreaterthan" value="" class="form-control" />


                            </div>
                        </div>
                    </div>




                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="control-label"> عدد التأخير
                                </label>

                            </div>

                            <div class="col-md-8">
                                <input type="checkbox" ID="latearrage"   name="latearrange"  value="1"  class="" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">

                            <div class="col-md-8">


                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <div class="col-md-4">

                            </div>

                            <div class="col-md-8">

                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">

                        <div class="form-group">
                            <div class="col-md-8">
                                <input type="{{$put['test']}}" ID="btnsed" value="بحث" class="btn btn-info btn-ls" />

                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">

                        <div class="form-group">
                            <div class="col-md-8">
                                <button id="btnreset" name='btnreset' Class="btn btn-info btn-ls" type="reset" value="Reset" onclick="Reset(this)">Reset</button>
                            </div>
                        </div>
                    </div>

                </div>



                <div class="row">
                    <div class="col-md-6 col-sm-6">

                        <div class="form-group">

                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                     </div>
                    </div>
                </div>
            </fieldset>
            </form>

<!--   var studenttableTHead = $('#stdtableTemp thead');-->
            <table id="stdtableTemp"  border="1" class="hidden" >
                <thead>
                <tr style='background-color:Highlight;'>
                    <th style="text-align:center"> ت</th>
                    <th style="text-align:center"> ر الجامعي</th>
                    <th style="text-align:center"> الاسم</th>
                    <th style="text-align:center"> المبنى</th>
                    <th style="text-align:center"> الهاتف</th>
                    <th style="text-align:center"> الكلية</th>
                    <th style="text-align:center"> ن الغرفة</th>
                    <th style="text-align:center"> رقم الغرفة</th>
                    <th style="text-align:center"> الجنسية</th>
                    <th style="text-align:center"> المنطقة</th>
                    <th style="text-align:center">  المانح</th>
                    <th style="text-align:center"> التحويلة</th>
                    <th style="text-align:center"> التأخير</th>
                </tr>
                </thead>
            </table>

        <table id="stdtable"  border="1" style="border-collapse:collapse" class="table">
            <thead>
            <tr style='background-color:Highlight;'>
                <th style="text-align:center"> ت</th>

                <th style="text-align:center"> ر الجامعي</th>
                <th style="text-align:center"> الاسم</th>
                <th style="text-align:center"> المبنى</th>
                <th style="text-align:center"> الهاتف</th>
                <th style="text-align:center"> الكلية</th>
                <th style="text-align:center"> ن الغرفة</th>
                <th style="text-align:center"> رقم الغرفة</th>
                <th style="text-align:center"> الجنسية</th>
                <th style="text-align:center"> المنطقة</th>
                <th style="text-align:center">  المانح</th>
                <th style="text-align:center"> التحويلة</th>
                <th style="text-align:center"> التأخير</th>

            </tr>

            </thead>

            <tbody style="text-align:center">



                <h4> <span id="spnrown"></span>   </h4>


            </tbody>

        </table>



        <div id="wait" style="margin: 0;display: block" >
            <span id="scrollmore" style="display: none" >Scroll To Load More</span>
            <img id="spinner"   style="width:20px;height:20px;display: none" src="/Images/FhHRx.gif" />
        </div>
        <br>
        <br>
        <br>
        <br>



        <div class="modal fade in" id="myModal" role="dialog"  >
            <div class="modal-dialog" style="width: 420px;  ">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <div class="row" style="text-align:center">

                            <h1><span id="stdname"> </span></h1>

                        </div>
                    </div>

                    <div class="modal-body">

                        <img class="img-responsive img-rounded" id="imgstd"  style="width: 400px;  " />

                    </div>

                </div>

            </div>
        </div>

        <a href="#" class="scrollToTop">      </a>
         </div>
@endsection
@section('scriptcontent')
    <script type="text/javascript">

        $(document).ready(function () {//called after load the page
            var rownumberindex ;
            var total  ;
            var urlrequest='viewlatejson';
            var current_page;
            var last_page;
            var from;
            var to;
            var per_page;
            var next_page_url;

            var studenttableTHead = $('#stdtableTemp thead');


            $(document).on("click", ".pop", function(){
                var imagepath=$(this).parent('td').next('td').children('a').attr('href');

               // use href="#responsive" instead of href="#" to prevent model from scroll up when show
                var studentname=$(this).parent('td').next('td').children('a').text();
                $('#stdname').text(studentname);
                $('#imgstd').attr('src', imagepath);
                $('#imgstd').attr('alt', $('#stdname').text());
                $('#myModal').modal('show');
            });

            $('#chk').change(function() {
                $( "#semlist" ).prop( "disabled", !this.checked );
            });


            $(window).scroll(function () {
                //$(document).height() fixed for example 2000px
                //$(window).height() fixed   for example 1200px
                //$(window).scrollTop() when at top is 0 when scroll goes down, the value starts increasing

                if ($(window).scrollTop() == $(document).height() - $(window).height())
                {

                    if (current_page == last_page)//do not call funtion if all data loaded
                     return;

                    if (total == rownumberindex-1)//do not call funtion if all data loaded
                        return;


                    loadData();

                }
            });

            $('#btnsed').click(function () {


                $('#stdtable tbody').html("");
                $('#spnrown').html('');

                urlrequest='viewlatejson';
                rownumberindex=0;
                total = 0;
                current_page=0;
                last_page=0;
                from=0;
                to=0;
                per_page=0;
                next_page_url=null;
                loadData();

            });


            function loadData() {


                var studenttable = $('#stdtable tbody');

                var stdid = $("input[name=stdid]").val();

                var buildidlist =  $('#buildidlist').val() ;

                var fname = $("input[name=fname]").val();

                var roomtypelist = $('#roomtypelist').val() ;

                var collegelist =  $('#collegelist').val() ;

                var roomno = $("input[name=roomno]").val();

                var nationalityidlist = $('#nationalityidlist').val() ;

                var semlist =  $('#semlist').val() ;

                var mobile = $("input[name=mobile]").val();

                var extension = $("input[name=extension]").val();
                var lategreaterthan= $("#lategreaterthan").val();

                var latearrage= $("#latearrage").is(':checked') ? "1" : "";
                $.ajax({
                    //data:"{'stdid':'"+$('#stdid').val().trim()+"','_token':'{{ csrf_token() }}'" +"}",
                    url: urlrequest,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data:{stdid:stdid, buildidlist:buildidlist, fname:fname,roomtypelist:roomtypelist,collegelist:collegelist,roomno:roomno,nationalityidlist:nationalityidlist,semlist:semlist,mobile:mobile,extension:extension,latearrage:latearrage,lategreaterthan:lategreaterthan},

                    type: "Post",

                    beforeSend: function() { $('#spinner').show();$('#scrollmore').hide(); },
                    complete: function() { $('#spinner').hide(); },

                    success: function (data) {

                        if (data.d.total == 0){
                            $('#spnrown').html('*No of records 0 *');
                            return;
                        }
                        current_page=data.d.current_page;
                        last_page=data.d.last_page;

                        urlrequest=data.d.next_page_url;
                        total=data.d.total;
                        from=data.d.from;
                        to=data.d.to;
                        rownumberindex=from;
                        per_page=data.d.per_page;
                        next_page_url=data.d.next_page_url;
                        if(next_page_url==null)
                            $('#scrollmore').hide();
                        else
                            $('#scrollmore').show();


                            $('#spnrown').html(' عدد السجلات '+data.d.total);


                        $(data.d.data).each(function (index, std) {

                           // aquamarine lightblue whitesmoke

                            if (rownumberindex % 2 == 0) {

                                if (rownumberindex % per_page == 0)

                                color='aquamarine';
                            else
                                    color='lightblue';
                                     }
                            else {
                                color='whitesmoke';
                            }

                            if($("#latearrage").is(':checked')){

                                if(rownumberindex==1){

                                    //  $('#stdtable thead').html(' <tr style="background-color:Highlight;"> <th style="text-align:center"> ت</th><th style=\"text-align:center\"> ر الجامعي</th> <th style=\"text-align:center\"> الاسم</th> <th style=\"text-align:center\"> المبنى</th> <th style=\"text-align:center\"> الهاتف</th> <th style=\"text-align:center\"> الكلية</th> <th style=\"text-align:center\"> ن الغرفة</th> <th style=\"text-align:center\"> رقم الغرفة</th> <th style=\"text-align:center\"> الجنسية</th> <th style="text-align:center"> المنطقة</th> <th style="text-align:center"> المانح</th> <th style="text-align:center"> التحويلة</th> <th style=\"text-align:center\"> التأخير</th> </tr>');
                                    $('#stdtable thead').html(studenttableTHead.html());
                                    studenttable.html('');//tbody
                                    console.log(studenttableTHead.html());
                                }
                            studenttable.append('<tr style=background-color:'+color+' ><td>' + rownumberindex +
                                '</td><td><a href="#responsive" class="pop">' + std.stdid +
                                '</a></td> <td> '  + std.tblstudents.fname +
                                '</td> '+ '</td> <td>' + std.tblstudents.tblbuilds.build + '</td><td>' + std.tblstudents.mobile + '</td> <td>' +
                                std.tblstudents.tblcolleges.collegename + '</td>' +'<td>' + std.tblstudents.tblroomtypes.roomtype  + '</td><td>' +
                                std.tblstudents.roomno + '</td>   <td>' + std.tblstudents.tblnationalitys.nationalityname + '</td>' +'<td>' + std.tblstudents.country  +
                                '</td><td>' + std.tblstudents.donor + '</td> <td>' + std.tblstudents.extension + '</td>' +
                                '<td>' + std.total + '</td>'  +
                                '<tr>');
                            }
                            else {
                                if(rownumberindex==1){
                                    $('#stdtable thead').html(' <tr style="background-color:Highlight;"> <th style="text-align:center"> ت</th><th style=\"text-align:center\"> ر الجامعي</th> <th style=\"text-align:center\"> الاسم</th> <th style=\"text-align:center\"> المبنى</th> <th style=\"text-align:center\"> الهاتف</th> <th style=\"text-align:center\"> الكلية</th> <th style=\"text-align:center\"> ن الغرفة</th> <th style=\"text-align:center\"> رقم الغرفة</th> <th style=\"text-align:center\"> الجنسية</th> <th style="text-align:center"> التاريخ</th> <th style=\"text-align:center\"> التأخير</th> </tr>');
                                    studenttable.html('');
                                }

                                studenttable.append('<tr style=background-color:'+color+' ><td>' + rownumberindex +
                                    '</td><td><a href="#responsive" class="pop">' + std.stdid +
                                    '</a></td> <td> '  + std.tblstudents.fname +
                                    ' </td> '+ '</td> <td>' + std.tblstudents.tblbuilds.build + '</td><td>' + std.tblstudents.mobile + '</td> <td>' +
                                    std.tblstudents.tblcolleges.collegename + '</td>' +'<td>' + std.tblstudents.tblroomtypes.roomtype  + '</td><td>' +
                                    std.tblstudents.roomno + '</td>   <td>' + std.tblstudents.tblnationalitys.nationalityname + '</td>' +

                                    ' <td>' + std.latedate + '</td>' +
                                    '<td>' + std.latenote + '</td>'  +
                                    '<tr>');

                            }


                            rownumberindex++;
                        });



                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        //XMLHttpRequest.status =404
                        //textStatus =error
                        //errorThrown =Not Found


                        $('#wait').hide();
                        alert( XMLHttpRequest.status+" "+errorThrown+" "+ textStatus);
                    }
                });

            }


            //Check to see if the window is top if not then display button
            $(window).scroll(function(){
                if ($(this).scrollTop() > 100) {
                    $('.scrollToTop').fadeIn();
                } else {
                    $('.scrollToTop').fadeOut();
                }
            });

            //Click event to scroll to top
            $('.scrollToTop').click(function(){
                $('html, body').animate({scrollTop : 0},800);
                return false;
            });

        });//document.ready





    </script>
<script>

    function Reset(btnreset){


        var items = $("#semlist option").length;
        $("#semlist")[0].selectedIndex=items-1;
        $( "#semlist" ).prop( "disabled", true );
        $( "#chk").prop( "checked", false );

     }


</script>
@endsection


