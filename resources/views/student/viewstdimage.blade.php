@extends('layouts.app')
@section('css')
    <style>
        .loading {
            background: lightgrey;
            padding: 15px;
            position: fixed;
            border-radius: 4px;
            left: 50%;
            top: 50%;
            text-align: center;
            margin: -40px 0 0 -50px;
            z-index: 2000;
            display: none;
        }



        .form-group.required label:after {
            content: " *";
            color: red;
            font-weight: bold;
        }
    </style>
@endsection
@section('content')

        <div class="container">

        <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="modal_content"></div>
            </div>
        </div>
        <div class="loading" style="display: none">
            <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i><br/>
            <span>Loading</span>
        </div>


        <?php
        $put=array('test'=>'button','title'=>'بحث ص');

        ?>
        @include('layouts.searchinput',$put)



            <h4> <span id="spnrown"></span>   </h4>
                 <div id="row">







                  </div>







        <div id="wait" style="margin: 0;display: block" >
            <span id="scrollmore" style="display: none" >Scroll To Load More</span>
            <img id="spinner"   style="width:20px;height:20px;display: none" src="Images/FhHRx.gif" />
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

        $(document).ready(function ($) {//called after load the page
            var rownumberindex ;
            var total  ;
            var urlrequest='viewstdsjsonpost';
            var current_page;
            var last_page;
            var from;
            var to;
            var per_page;
            var next_page_url;
            var imgbase64="";
            var divspinner;
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            $('body').on('focus',".datepicker", function(){
                $(this).datepicker();
            });
                   // $('.datepicker').datepicker({
            //     dateFormat: "yy-mm-dd"
            // });
            //


            var setCookie = function(name, value, expiracy) {
                var exdate = new Date();
                exdate.setTime(exdate.getTime() + expiracy * 1000);
                var c_value = escape(value) + ((expiracy == null) ? "" : "; expires=" + exdate.toUTCString());
                document.cookie = name + "=" + c_value + '; path=/';
            };

            var getCookie = function(name) {
                var i, x, y, ARRcookies = document.cookie.split(";");
                for (i = 0; i < ARRcookies.length; i++) {
                    x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
                    y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
                    x = x.replace(/^\s+|\s+$/g, "");
                    if (x == name) {
                        return y ? decodeURI(unescape(y.replace(/\+/g, ' '))) : y; //;//unescape(decodeURI(y));
                    }
                }
            };

            $(document).on("click", ".downloadLink", function(){

                $('.divspinnerclass').hide();//if user click to download link and before it has been finished the user click another link
               divspinner= $(this).parent('p').next('div').show();
               // $('#fader').css('display', 'block');

                setCookie('downloadStarted', 0, 100); //Expiration could be anything... As long as we reset the value
                setTimeout(checkDownloadCookie, 1000); //Initiate the loop to check the cookie.
            });

            var downloadTimeout;
            var checkDownloadCookie = function() {
                if (getCookie("downloadStarted") == 1) {
                    setCookie("downloadStarted", "false", 100); //Expiration could be anything... As long as we reset the value
                   // $('#fader').css('display', 'none');
                    divspinner.hide();
                } else {
                    downloadTimeout = setTimeout(checkDownloadCookie, 1000); //Re-run this function in 1 second.
                }
            };




          ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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


                $('#row').html("");
                $('#spnrown').html('');

                urlrequest='viewstdsjsonpost';
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

                var divrow = $('#row');


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

                $.ajax({

                    //data:"{'stdid':'"+$('#stdid').val().trim()+"','_token':'{{ csrf_token() }}'" +"}",
                    url: urlrequest,


                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    data:{stdid:stdid, buildidlist:buildidlist, fname:fname,roomtypelist:roomtypelist,collegelist:collegelist,roomno:roomno,nationalityidlist:nationalityidlist,semlist:semlist,mobile:mobile,extension:extension},

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



                           //getimagestd(std.semid,std.stdid,function(imgbase64) {


                            if(rownumberindex==1)
                                divrow.html('');//for test remove when finish
                            divrow.append(' ' +
                         '<div class="list-group-item clearfix">' +
                            '<div class="col-lg-7" >' +
                                ' <h4><span class="badge">'+ rownumberindex+'</span> ' + std.fname +'</h4> <p>' + std.stdid +'</p> ' +
                                '<p>'+std.tblbuilds.build+ ' '+ std.tblroomtypes.roomtype +  '  '+ std.roomno +' </p> <p>'+std.country+'     '+std.tblnationalitys.nationalityname +' </p>'+
                                '<p>'+ std.tblcolleges.collegename+  ' '+std.donor+' '  +std.mobile+'</p> ' +
                                '<p>'+ '<a href=addlate/'+std.semid+'/'+std.stdid+'>late</a>'+
                                '|\n' +
                                '<a href=leavefilepdf/'+std.id+'> file</a>'+
                                '  </p> ' +
                                '' +
                                '<p>'+
                                '<a href="#modalForm" data-toggle="modal" data-href="lateform/'+std.semid+'/'+std.stdid+'" class="link">Late</a>'+
                            '|'+
                                '<a class="downloadLink"  href=dormfilepdf/'+std.id+'>dorm</a>'+
                                '|'+
                                '<a class="downloadLink" href=leavefilepdf/'+std.id+'>Leave  </a>'+
                                ' </p>\n' +
                                '\n' +
                                '\n' +

                                '       <div id="div'+std.id+'" class="divspinnerclass list-group-item-text"  style="display: none" >\n' +
                                '            <i class="fa fa-spinner fa-spin " style="font-size:24px;color:red"></i>\n' +
                                '            <span class="btn btn-danger">loading file</span>\n' +
                                '        </div>\n' +
                                '\n' +
                         '   </div>\n' +
                                '\n' +
                                '\n' +
                                '   <div  class="col-lg-5"   >\n' +
                                '\n' +
                                '       <img class="img-responsive img-rounded" style="max-height: 300px;" src="'+std.snote+'" width="400" />\n' +
                                '\n' +
                                '   </div>\n' +
                         '</div>');

//

                            rownumberindex++;



                        });//$(data.d.data).each(function (index, std) {
                      //  '       <img class="img-responsive img-rounded" id="img"'+rownumberindex+'" style="max-height: 300px;" src="'+imgbase64+'" width="400" />\n' +

                     //   '       <img class="img-responsive img-rounded" style="max-height: 300px;" src="DownloadImage/'+std.semid+ '/'+std.stdid+'" width="400" />\n' +
                      //  '       <img class="img-responsive img-rounded" style="max-height: 300px;" src="'+std.snote+'" width="400" />\n' +




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
            function getimagestd(semid,satdid,callback) {

                $.ajax({
                    type: "get",
                    url: 'getstdimagebase64/'+semid+'/'+satdid,
                    //data2: dataString2,
                    dataType: "text",
                    success: function(data2) {
                        callback(data2);
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        //XMLHttpRequest.status =404
                        //textStatus =error
                        //errorThrown =Not Found



                        console.log( XMLHttpRequest.status+" "+errorThrown+" "+ textStatus);
                        callback("");
                    }
                });


                //To call it inside the main ajaex
                // getimagestd(std.semid,std.stdid,function(imgbase64) {
                //
                //  if(rownumberindex==1)
              //  divrow.html('');//for test remove when finish
               // divrow.append(' ' +
                    //'<div class="list-group-item clearfix">' +
                // });
            }



            function ajaxLoad(filename, content) {
                content = typeof content !== 'undefined' ? content : 'content';
                $("#" + content).html('');
                $('.loading').show();
                $.ajax({
                    type: "GET",
                    url: filename,
                    contentType: false,
                    success: function (data) {
                        $("#" + content).html(data);
                        $('.loading').hide();
                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            }


            // when New link clicked
            $('#modalForm').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                ajaxLoad(button.data('href'), 'modal_content');
            });

            $('#modalForm').on('shown.bs.modal', function () {
                $('#focus').trigger('focus')
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



    <script src="https://use.fontawesome.com/2c7a93b259.js"></script>

@endsection


