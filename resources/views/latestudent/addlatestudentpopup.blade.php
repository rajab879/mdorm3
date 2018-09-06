






            <form id="formaddlate"   method="post"  action="addlate"  >
            {{csrf_field()}}


            <input type="hidden" id="id" name="id" value="{{  $std["std"]->id  }}">
            <img id="spinner"   style="width:20px;height:20px;display: none" src="/Images/FhHRx.gif" />
            <fieldset class="well the-fieldset">
                <legend class="the-legend">
                  اضافة تأخير
                </legend>
                <div id="diverror" class="alert alert-danger hidden">

                    <ul id="uerror">

                    </ul>
                </div>




                            <div class="row">
                                <div class="col-xs-8 form-inline">

                                    <label for="stdid" class="col-xs-4">  رقم الطالب:  </label>

                                    <input type="text"   class="col-xs-8 form-control" placeholder="الرقم الجامعي" maxlength="9" id="stdid" name="stdid" value="{{  $std["std"]->stdid  }}"  />


                                </div>
                                <div class="col-xs-4">
                                    <span class="text-danger field-validation-valid" data-valmsg-for="stdid" data-valmsg-replace="true"></span>
                                </div>
                            </div>



                            <div class="row ">
                                <div class="col-xs-8 form-inline">
                                    <label for="fname" class="col-xs-4">  اسم الطالب:  </label>

                                    <input type="text" disabled="true" class="col-xs-8  form-control" placeholder="اسم الطالب " maxlength="50" id="fname" name="fname" value="{{  $std["std"]->fname  }}"  />


                                </div>
                                <div class="col-xs-4">
                                    <span class="text-danger field-validation-valid" data-valmsg-for="fname" data-valmsg-replace="true"></span>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-xs-8 form-inline">
                                    <label for="semlist" class="col-xs-4">     الفصل    </label>


                                    <select  style="text-overflow: ellipsis !important;"  ID="semlist" name="semlist"  Font-Bold="True" ForeColor="Red" Font-Size="8pt" class="col-xs-8 form-control">
                                        @foreach($tblsems as $tblsem)

                                            <option   <?php

                                                      if($std["std"]->semid ==null) echo 'selected';
                                                      else if($std["std"]->semid ==$tblsem->id) echo 'selected'; ?>
                                                      value={{$tblsem->id}} >{{$tblsem->semalias}}

                                            </option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-4">

                                    <span class="text-danger field-validation-valid" data-valmsg-for="" data-valmsg-replace="true"></span>
                                </div>
                            </div>



                            {{--<div class="row">--}}
                                {{--<div class="col-xs-8 form-inline">--}}

                                    {{--<label for="latereason" class="col-xs-4 ">  الصورة:  </label>--}}

                                    {{--@if($std["std"]->semid!=null)--}}
                                        {{--@if($std['std']->Col001==1)--}}

                                            {{--<img id="imgview" class="img-fluid " width="150px" src="/imagestd/{{$std["std"]->semid}}/{{$std["std"]->stdid}}.jpg" alt="your image"   />--}}
                                        {{--@endif--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-4">--}}
                                    {{--<div id="imgmessage"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}


                            <div class="row">
                                <div class="col-xs-8 form-inline">
                                    <label for="latereason" class="col-xs-4 ">  سبب التأخير:  </label>

                                    <input type="text" class="col-xs-8 form-control" placeholder="سبب التأخير" maxlength="500" id="latenote" name="latenote" value="{{ old('latereason') }}"  />


                                </div>
                                <div class="col-xs-4">
                                    <span class="text-danger field-validation-valid" data-valmsg-for="stdid" data-valmsg-replace="true"></span>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xs-8 form-inline">
                                    <label for="strDate" class="col-xs-4 ">       التاريخ:</label>


                                    <input autocomplete="off" type="text" id="latedate" name="latedate"   class="col-xs-8 datepicker form-control mydate  " placeholder="التاريخ" maxlength="10" />





                                </div>
                                <div class="col-xs-4">
                                    <span asp-validation-for="strDate" class="text-danger"></span>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-xs-8 form-inline">
                                    <label for="latereason" class="col-xs-4 ">   الساعة:    </label>

                                    <input type="text" class="col-xs-8 form-control" placeholder="الساعة " maxlength="2" id="latehour" name="latehour" value="{{ old('latereason') }}"  />


                                </div>
                                <div class="col-xs-4">
                                    <span class="text-danger field-validation-valid" data-valmsg-for="stdid" data-valmsg-replace="true"></span>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xs-8 form-inline">
                                    <label for="latereason" class="col-xs-4 ">   الدقيقة:    </label>

                                    <input type="text" class="col-xs-8 form-control" placeholder="الدقيقة " maxlength="2" id="latemin" name="latemin" value="{{ old('latereason') }}"  />


                                </div>
                                <div class="col-xs-4">
                                    <span class="text-danger field-validation-valid" data-valmsg-for="stdid" data-valmsg-replace="true"></span>
                                </div>
                            </div>











            </fieldset>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"> Close</button>

                    <input type="submit" name="btnsend" ID="btnsend" value="اضافة" class="btn btn-primary" />

                </div>

            </form>







    <script type="text/javascript">

        $(document).ready(function ($) {//must add $ for datepicker




            $("form#formaddlate").submit(function(e) {
                e.preventDefault();

                addlate(this);
            });






            function addlate(formdata) {

                console.log('test');

                var id = $("input[name=id]").val();
                var stdid = $("input[name=stdid]").val();


                var semlist =  $('#semlist').val() ;

                var latenote =  $('#latenote').val() ;
                var latedate =  $('#latedate').val() ;
                var latehour =  $('#latehour').val() ;
                var latemin =  $('#latemin').val() ;



                $.ajax({


                    url: '/addlatejson',
                   // cache: false,
                   // processData:false,
                    //contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                   data:{id:id,stdid:stdid,  semlist:semlist,latenote:latenote,latedate:latedate,latehour:latehour,latemin:latemin},

                    type: "Post",

                    beforeSend: function() { $('#btnsend').prop('disabled',true);$('#spinner').show();  },
                    complete: function() {   $('#btnsend').prop('disabled',false);$('#spinner').hide(); },

                    success: function (data) {
                        $('div').removeClass('has-error');

                        $('#spinner').hide();
                        $('#diverror').addClass('hidden');
                        $('#uerror').html('');
                        alert(data.d);

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        //XMLHttpRequest.status =404
                        //textStatus =error
                        //errorThrown =Not Found
                        ;$('#spinner').hide();
                        $('#diverror').addClass('hidden');//remove or add class hidden
                        $('#uerror').html('');
                        $('div').removeClass('has-error');



                        if(XMLHttpRequest.status ==422)//validation error
                        {
                            var errors = XMLHttpRequest.responseJSON;
                            var errorsHtml = '';
                            $.each(errors.errors, function( key, value ) {


                                errorsHtml += '<li>' + value  + '</li>';
                                  //console.log( key+'*>'+value );
                                var myId = '#' + key;
                                $(myId).parent('div').addClass('has-error');
                            });

                           $('#diverror').removeClass('hidden');//remove or add class hidden
                            //$('#diverror').show();//change style display:none to block
                            $('#uerror').html(errorsHtml);

                            $('html, body').animate({scrollTop : 0},800);


                        }
                        else
                            alert( XMLHttpRequest.status+" "+errorThrown+" "+ textStatus);
                    }
                });

            }








        });//document.ready





    </script>




