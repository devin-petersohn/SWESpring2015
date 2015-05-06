$(function(){
    //original field values
    var field_values = {
            //id        :  value
            'selection' : 'selection',
            'lname'  : 'lname',
            'fname'  : 'fname',
            'gpa'  : 'gpa',
            'ID' : 'stu ID',
            'source' : 'enter the full info',
            'email'  : 'email address',
            'advisorname' : 'advisor name',
            'phoneNum' : 'phone number',
            'gradDate' : 'graduate date',
            'currCourses' : 'current teaching courses',
            'precourse' : 'Previously Taught',
            'courseLike' : 'Course you would like and grade',
            'otherPlace' : 'other place',
            'speakScore' : 'speak score',
            'semesterLast' : 'enter the semster',
            'timetoregister' : 'enter the time',
            'phoneNum' : 'phone number',
            'presentDate' : 'Date'
    };


    //inputfocus

    $('input#fname').inputfocus({ value: field_values['fname'] });
    $('input#lname').inputfocus({ value: field_values['lname'] });
    
    $('input#gpa').inputfocus({ value: field_values['gpa'] });
    $('input#ID').inputfocus({ value: field_values['ID'] }); 
    $('input#source').inputfocus({ value: field_values['source'] }); 

   // $('input#lastname').inputfocus({ value: field_values['lastname'] });
    $('input#email').inputfocus({ value: field_values['email'] }); 
    $('input#advisorname').inputfocus({ value: field_values['advisorname'] }); 
    
    $('input#phoneNum').inputfocus({ value: field_values['phoneNum'] }); 
    $('input#gradDate').inputfocus({ value: field_values['gradDate'] }); 
    $('input#currCourses').inputfocus({ value: field_values['currCourses'] }); 
    $('input#precourse').inputfocus({ value: field_values['precourse'] }); 
    $('input#courseLike').inputfocus({ value: field_values['courseLike'] }); 
    $('input#otherPlace').inputfocus({ value: field_values['otherPlace'] }); 
    $('input#speakScore').inputfocus({ value: field_values['speakScore'] }); 
    $('input#semesterLast').inputfocus({ value: field_values['semesterLast'] }); 
    $('input#timetoregister').inputfocus({ value: field_values['timetoregister'] }); 
    $('input#phoneNum').inputfocus({ value: field_values['phoneNum'] }); 
    $('input#presentDate').inputfocus({ value: field_values['presentDate'] }); 




    document.onkeydown = function(event) {
            var target, code, tag;
            if (!event) {
                event = window.event; 
                target = event.srcElement;
                code = event.keyCode;
                if (code == 13) {
                    tag = target.tagName;
                    if (tag == "TEXTAREA") { return true; }
                    else { return false; }
                }
            }
            else {
                target = event.target; 
                code = event.keyCode;
                if (code == 13) {
                    tag = target.tagName;
                    if (tag == "INPUT") { return false; }
                    else { return true; }
                }
            }
        };


        $(function() {
            $( "#gradDate" ).datepicker();
            $.datepicker.formatDate( "mm-yy", new Date() );
            });


        $(function() {
            $("#semesterLast").datepicker();
            });
        $(function() {
            $("#timetoregister").datepicker();
            });

        $(function() {
            $("#presentDate").datepicker();
            });



        


            //reset progress bar
    $('#progress').css('width','0');





    $('.bt').css('padding','0px');
    $('.bt').css('width','130px');
    $('.bt').css('margin','0px');
    $('.bt').css('float','none');
  //  $('#container input').css('float','none');
    
    
    blog = {};
    blog.comments = blog.comments || {};
    blog.comments.debugMode = false;

    blog.isFirstLoad = function(namesp, jsFile) {
        var isFirst = namesp.firstLoad === undefined;
        namesp.firstLoad = false;
        
        if (!isFirst) {
            console.log(
                "Warning: Javascript file is included twice: " + 
                    jsFile);
        }

        return isFirst;
    };
    
    

    var iCnt = 0;
    $(document).ready(function() {
        $('.sigPad').signaturePad();
        if (!blog.isFirstLoad(blog.comments, "jquery-applicationForm.js")) {
            return;
        }
        
        var divnum=0;
        // CREATE A "DIV" ELEMENT AND DESIGN IT USING JQUERY ".css()" CLASS.
        if(!$('#container_curr').length)
            {
                
                

        // ADD TEXTBOX.
        //<select name="selection" id="selection" value="selection" >
            // <option value="TA">TA (grad student)</option>
            // <option value="PLA">PLA (undergrad student)!</option>

            // </select>
        
        // $(container).append('<select name="grade_course'+iCnt+'" id="grade_course'+iCnt+'" value="grade_course'+iCnt+'" > '+'<option value="default">Choose your GPA..</option>'+'<option value="A">A</option>'+'<option value="B">B</option>'+'<option value="C">C</option>'+'<option value="D">D</option>'+'</select>');



        // $('#btRemove').after(container, divSubmit);   // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
        // else {      // AFTER REACHING THE SPECIFIED LIMIT, DISABLE THE "ADD" BUTTON. (20 IS THE LIMIT WE HAVE SET)
                
        //         $(container).append('<label>Reached the limit</label>'); 
        //         $('#btAdd').attr('class', 'bt-disable'); 
        //         $('#btAdd').attr('disabled', 'disabled');

        //     }

        $('#btAdd').click(function() {
            {
            if (iCnt <= 19) {
                if(iCnt==0)
                {
                    $('#btAdd').val("Add a Course");
                }
                if(divnum==0)
                {
                    var container=$(document.createElement('div'));
                    $(container).attr('id','container_curr');
                    divnum++;
                }

                if(iCnt==0)
                    {$(container).append('<table><tbody id="myTable"></tbody></table>');}


                iCnt = iCnt + 1;
                // $.ajax({
                // type: "POST",
                // url: "gerCurrentCourses.php",
                // data: {
                //     iCnt: iCnt
                // },
                // success: function(data){
                //     $(container).append(data);   
                // }
                // });

                // ADD TEXTBOX.
                //<select name="selection" id="selection" value="selection" >
                    // <option value="TA">TA (grad student)</option>
                    // <option value="PLA">PLA (undergrad student)!</option>
      
                    // </select>
                $('#myTable').css('margin','0px');
                $.ajax({
                type: "POST",
                url: "../../getCurrentCourses.php",
                data: {
                    iCnt: iCnt
                },
                success: function(data){
                    $('#myTable').append('<tr id="tr'+iCnt+'">'+'<td>'+data+'</td><td><select name="grade_course'+iCnt+'" id="grade_course'+iCnt+'" value="grade_course'+iCnt+'" > '+'<option value="default">Choose your GPA..</option>'+'<option value="A">A</option>'+'<option value="B">B</option>'+'<option value="C">C</option>'+'<option value="D">D</option>'+'</select></td></tr>');
                }
                });console.log("icnt="+iCnt);
                // $(container).append('<select name="courseLike'+iCnt+'" id="courseLike'+iCnt+'" value="courseLike'+iCnt+'" > '+'<option value="default">Choose the current courses..</option>'+'</select>');

                // $(container).append('<select name="grade_course'+iCnt+'" id="grade_course'+iCnt+'" value="grade_course'+iCnt+'" > '+'<option value="default">Choose your GPA..</option>'+'<option value="A">A</option>'+'<option value="B">B</option>'+'<option value="C">C</option>'+'<option value="D">D</option>'+'</select>');
//                console.log("the count is "+ iCnt);
//                

                $height=$('#container').height();
                $height+=150;
                $("#container").css("height", $height);

                if (iCnt == 1) {        // SHOW SUBMIT BUTTON IF ATLEAST "1" ELEMENT HAS BEEN CREATED.

                    var divSubmit = $(document.createElement('div'));
           
                }

                $('#buttontable').after(divSubmit,container);  // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
            }
            else {      // AFTER REACHING THE SPECIFIED LIMIT, DISABLE THE "ADD" BUTTON. (20 IS THE LIMIT WE HAVE SET)
                
                $(container).append('<label>Reached the limit</label>'); 
                $('#btAdd').attr('class', 'bt-disable'); 
                $('#btAdd').attr('disabled', 'disabled');

            }
            }

        });

        $('#btRemove').click(function() {   // REMOVE ELEMENTS ONE PER CLICK.
            console.log(iCnt);
            if (iCnt != 1) { 
                $('#tr'+iCnt).remove(); 

                $height=$('#container').height();
                $height-=150;
                $("#container").css("height", $height);

                 iCnt = iCnt - 1;
             }
        
            if (iCnt == 1) { 
        
                $('#btAdd').removeAttr('disabled'); 
                $('#btAdd').attr('class', 'bt') 

            }
        });
        
            }

        
    });

    var divValue, values = '';

    function GetTextValue() {

        $(divValue).empty(); 
        $(divValue).remove(); values = '';

        $('.input').each(function() {
            divValue = $(document.createElement('div')).css({
                padding:'5px', width:'200px'
            });
            values += this.value + '<br />'
        });

        $(divValue).append('<p><b>Your selected values</b></p>' + values);
        $('body').append(divValue);

    }


    
    
    $('#progress_text').html('0% Complete');
     $("#container").css("height", "440px");
    $("#container label").css("line-height", "27px");
    
    //first_step
    $('form').submit(function(){ return false; });
    $('#submit_first').click(function(){
        //remove classes
        $first_height=$('#container').height();
        $("#container label").css("line-height", "14px");
    
        $("#container").css("height", "370px");
        $('#first_step input').removeClass('error').removeClass('valid');

        //ckeck if inputs aren't empty
        var fields = $('#first_step input[type=text]');
        var gpaPattern =/^-?\d+(\.\d{1,2})?$/;
        var error = 0;
        fields.each(function(){
            var value = $(this).val();
            if((value==field_values[$(this).attr('id')] ) || (($(this).attr('id')=='gpa')&&(!gpaPattern.test(value)))) {
                $(this).addClass('error');
                $(this).effect("shake", { times:3 }, 50);
                
                error++;
            } else {
                $(this).addClass('valid');
                
            }
        });        
        
        if(!error) {

            $.post("../../application.php",
                    {
                        selection: $("#selection").val(),
                        lname: $("#lname").val(),
                        fname: $("#fname").val(),
                        gpa: $("#gpa").val()
                    },
                    function(data){
                        
                        alert("This page has been sent to database!");
                    }
            );
            /*
            if( $('#password').val() != $('#cpassword').val() ) {
                    $('#first_step input[type=password]').each(function(){
                        $(this).removeClass('valid').addClass('error');
                        $(this).effect("shake", { times:3 }, 50);
                    });
                    
                    return false;
            } else*/ 
               
                //update progress bar
            
            if($("#selection").val()=="TA")
            {
                $('#advisorname').show();
                $('#selectionmajor').hide();
                $('#label_selectmajor').hide();
                $('#label_advisor').show();
                $('#masterphd').show();
                $("#container").css("height", "430px");
                    
            }

            else{
                $('#selectionmajor').show();
                $('#advisorname').hide();
                $('#label_selectmajor').show();
                $('#label_advisor').hide();
                $('#masterphd').hide();
                $("#container").css("height", "370px");

            }
            $('#progress_text').html('16% Complete');
            $('#submit_second').css('left','540px');
            $('#progress').css('width','54px');
            $('label').css('float','');
            //slide steps
            $('#first_step').slideUp();
            $('#second_step').slideDown();     
            
                         
        } 

        else return false;
         
    });
    
    $('#submit_temp').click(function(){
        //send information to server
        $("#container").css("height", "570px");
        $('#temp_step input').removeClass('error').removeClass('valid');
        var fields = $('#temp_step input[type=text]');
        var error = 0;
        fields.each(function(){
            var value = $(this).val();
            if( value.length<1 || value==field_values[$(this).attr('id')] ) {
                $(this).addClass('error');
                $(this).effect("shake", { times:3 }, 50);
                
                error++;
            } else {
                $(this).addClass('valid');
            }
        });

        if(!error) {
                //update progress bar
                $('#progress_text').html('20% Complete');
                $('#progress').css('width','76px');
                
                //slide steps
                $('#temp_step').slideUp();
                $('#second_step').slideDown();       
        } else return false;
    });
    
    


    $('#submit_second').click(function(){
        //remove classes
        
        $('#second_step input').removeClass('error').removeClass('valid');
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
        var fields1 = $('#second_step input[name=pub]','#second_step input[name=advisorname]');
        var fields2 = $('#second_step input[name=pub]','#second_step input[name=selectionmajor]');
        
        var error = 0;
        if($("#selection").val()=="TA")
        {
            
            
            fields1.each(function(){
            var value = $(this).val();
            if( value.length<1 || value==field_values[$(this).attr('id')] ) {
                $(this).addClass('error');
                $(this).effect("shake", { times:3 }, 50);
                
                error++;
            } else {
                $(this).addClass('valid');
            }
        });

            filedpub.each(function(){
            var value = $(this).val();
            if( value.length<1 || value==field_values[$(this).attr('id')] ||  (($(this).attr('id')=='email')&&(!emailPattern.test(value))) ) {
                $(this).addClass('error');
                $(this).effect("shake", { times:3 }, 50);
                
                error++;
            } else {
                $(this).addClass('valid');
            }
        });
            
        }
        else{
        
            
           
            fields2.each(function(){
            var value = $(this).val();
            if( value.length<1 || value==field_values[$(this).attr('id')] ) {
                $(this).addClass('error');
                $(this).effect("shake", { times:3 }, 50);
                
                error++;
            } else {
                $(this).addClass('valid');
            }
        });

            filedpub.each(function(){
            var value = $(this).val();
            if( value.length<1 || value==field_values[$(this).attr('id')] ||  (($(this).attr('id')=='email')&&(!emailPattern.test(value))) ) {
                $(this).addClass('error');
                $(this).effect("shake", { times:3 }, 50);
                
                error++;
            } else {
                $(this).addClass('valid');
            }
        });
        }
        
        

        if(!error) {
            $.post("../../application.php",
                        {
                            ID: $("#ID").val(),
                            advisorname: $("#advisorname").val(),
                            selectionmajor: $("#selectionmajor").val(),
                            selection: $("#selection").val(),
                            email: $("#email").val()
                        },
                        function(data){
                            
                            alert("This page has been sent to database!");
                        }
                );

                //update progress bar
                $("#container").css("height", "680px");
                $('#progress_text').html('32% Complete');
                $('#progress').css('width','108px');
                $('#submit_third').css('left','540px');
                //slide steps
                $('#second_step').slideUp();
                $('#third_step').slideDown();     
        } else return false;

    });


    $('#submit_second_back').click(function(){

                $('#progress_text').html('0% Complete');
                $('#progress').css('width','0px');
                $("#container").css("height", $first_height);
                $("#container label").css("line-height", "27px");
    
                //slide steps
                $('#second_step').slideUp();
                $('#first_step').slideDown(); 
    });


    $('#submit_third').click(function(){
        //update progress bar
        
        $('#third_step input').removeClass('error').removeClass('valid');
        var phonepattern=/^[(]{0,1}[0-9]{3}[)]{0,1}[-]{0,1}[0-9]{3}[-]{0,1}[0-9]{4}$/;
        var fields = $('#third_step input[type=text]');
        var error = 0;
        $third_height=$('#container').height();
        fields.each(function(){
            var value = $(this).val();
            if( value.length<1 || value==field_values[$(this).attr('id')] ||  (($(this).attr('id')=='phoneNum')&&(!phonepattern.test(value)))) {
                $(this).addClass('error');
                $(this).effect("shake", { times:3 }, 50);
                
                error++;
            } else {
                $(this).addClass('valid');
            }
        });

        if(!error) {
            $.post("../../application.php",
                    {
                        phoneNum: $("#phoneNum").val(),
                        gradDate: $("#gradDate").val(),
                        currCourses: $("#currCourses").val()
                    },
                    function(data){
                        
                        alert("This page has been sent to database!");
                    }
            );
                //update progress bar
                $("#container").css("height", "525px");
                $('#progress_text').html('48% Complete');
                $('#progress').css('width','162px');
                $('#submit_fourth').css('left','540px');
                //slide steps
                $('#third_step').slideUp();
                $('#fourth_step').slideDown();       
        } else return false;


        //prepare the fourth step
       /* var fields = new Array(
            $('#name').val(),
            $('#gpa').val(),
            $('#email').val(),
            $('#firstname').val() + ' ' + $('#lastname').val(),
            $('#age').val(),
            $('#gender').val(),
            $('#country').val()                       
        );
        var tr = $('#fourth_step tr');
        tr.each(function(){
            //alert( fields[$(this).index()] )
            $(this).children('td:nth-child(2)').html(fields[$(this).index()]);
        });
                */
        //slide steps
                
    });



    $('#submit_third_back').click(function(){

                if($("#selection").val()=="TA")
            {
                $('#advisorname').show();
                $('#selectionmajor').hide();
                $('#label_selectmajor').hide();
                $('#label_advisor').show();
                $('#masterphd').show();
                $("#container").css("height", "430px");
                    
            }

            else{
                $('#selectionmajor').show();
                $('#advisorname').hide();
                $('#label_selectmajor').show();
                $('#label_advisor').hide();
                $('#masterphd').hide();
                $("#container").css("height", "370px");

            }

                $('#progress_text').html('16% Complete');
                $('#progress').css('width','54px');
                //slide steps
                $('#third_step').slideUp();
                $('#second_step').slideDown(); 
    });


    $('#submit_fourth').click(function(){
        //send information to server
        $fourth_height=$('#container').height();
       
        
        $('#fourth_step input').removeClass('error').removeClass('valid');
        var fields = $('#fourth_step input[type=text]');
        var error = 0;
        fields.each(function(){
            var value = $(this).val();
            if( value.length<1 || value==field_values[$(this).attr('id')] ) {
                $(this).addClass('error');
                $(this).effect("shake", { times:3 }, 50);
                
                error++;
            } else {
                $(this).addClass('valid');
            }
        });
        var i=0;
        var courseLikearr=[];
        var gradearr=[];
        
        for(i=2;i<=iCnt;i++)
        {
            courseLikearr.push($('#'+'courseLike'+i).val());


            gradearr.push($('#'+'grade_course'+i).val());
        }
        if(!error) {
            $.post("../../application.php",
                    {
                        precourse: $("#precourse").val(),

                        courseLike: courseLikearr,
                        grade : gradearr,
                        otherPlace: $("#otherPlace").val()
                    },
                    function(data){
                        
                        alert("This page has been sent to database!");
                    }
            );
                //update progress bar
                $("#container").css("height", "420px");
                $('#progress_text').html('64% Complete');
                $('#progress').css('width','216px');
                $('#submit_sixth').css('left','540px');
                //slide steps
                $('#fourth_step').slideUp();
                $('#sixth_step').slideDown();       
        } else return false;
    });



    $('#submit_fourth_back').click(function(){

                $('#progress_text').html('32% Complete');
                $('#progress').css('width','108px');
                $("#container").css("height", $third_height);
                //slide steps
                $('#fourth_step').slideUp();
                $('#third_step').slideDown(); 
    });
    //it's delete now. submit_fifth
    $('#submit_fifth').click(function(){
        //send information to server
        $("#container").css("height", "370px");
        $('#fifth_step input').removeClass('error').removeClass('valid');
        var fields = $('#fifth_step input[type=text]');
        var error = 0;
        fields.each(function(){
            var value = $(this).val();
            if( value.length<1 || value==field_values[$(this).attr('id')] ) {
                $(this).addClass('error');
                $(this).effect("shake", { times:3 }, 50);
                
                error++;
            } else {
                $(this).addClass('valid');
            }
        });

        if(!error) {
                //update progress bar
                $('#progress_text').html('80% Complete');
                $('#progress').css('width','270px');
                
                //slide steps
                $('#fifth_step').slideUp();
                $('#sixth_step').slideDown();       
        } else return false;
    });

    $('#submit_sixth').click(function(){
        //send information to server
        
        $('#sixth_step input').removeClass('error').removeClass('valid');
        var fields = $('#sixth_step input[type=text]');
        var error = 0;
        $sixth_height=$('#container').height();
        fields.each(function(){
            var value = $(this).val();
            if( value.length<1 || value==field_values[$(this).attr('id')] || $('#selectionifinternational').val()=="default") {
                $(this).addClass('error');
                $(this).effect("shake", { times:3 }, 50);
                
                error++;
            } else {
                $(this).addClass('valid');
            }
        });

        if((!error)&&($('#selectionifinternational').val()!="default")) {

                $.post("../../application.php",
                    {
                        selectiontwo: $("#selectiontwo").val(),
                        selectionifinternational: $("#selectionifinternational").val(),
                        
                    },
                    function(data){
                        
                        alert("This page has been sent to database!");
                    }
            );
                //update progress bar

                if($("#selectionifinternational").val()=="yes")
                {
                    $('#progress_text').html('80% Complete');
                    $('#progress').css('width','288px');
                    //slide steps
                    console.log($('#selectionifinternational').val());
                    $('#submit_seventh').css('left','540px');
                    
                    $('#speakScore').hide();
                    $('#semesterLast').hide();
                    $('#seventh_step label').hide();
                    $('#timetoregister').hide();
                    
                    $("#container").css("height", "500px");
                    $('#sixth_step').slideUp();
                    $('#seventh_step').slideDown();
                } 
                else if($("#selectionifinternational").val()=="no")
                {
                    var fields = new Array(
                    $('#selection').val(),
                    $('#name').val(),
                    $('#gpa').val(),
                    $('#ID').val(),
                    $('#source').val(),
                    $('#email').val(),
                    $('#phoneNum').val(),
                    $('#gradDate').val(),
                    $('#currCourses').val(),
                    $('#precourse').val(),
                    $('#courseLike').val(),
                    $('#otherPlace').val(),
                    $('#speakScore').val(),
                    $('#semesterLast').val()
                    
                                             
                    );
                    var tr = $('#ninth_step tr');
                    tr.each(function(){
                        //alert( fields[$(this).index()] )
                        $(this).children('td:nth-child(2)').html(fields[$(this).index()]);
                    });

                    $('#progress_text').html('100% Complete');
                    $('#progress').css('width','360px');
                    $('#submit_ninth').css('left','540px');  
                    $("#container").css("height", "550px"); 
                    $('#sixth_step').slideUp();
                    $('#ninth_step').slideDown();
                }
                
                
                
                      
        } else return false;
    });

    $('#submit_sixth_back').click(function(){

                $('#progress_text').html('48% Complete');
                $('#progress').css('width','162px');
                $("#container").css("height", $fourth_height);
                //slide steps
                $('#sixth_step').slideUp();
                $('#fourth_step').slideDown(); 
    });
        
    $(function(){

        $("select#selectionthree").change(function(){
            if($("#selectionthree").val()=="rm")
            {
                $("#container").css("height", "630px");
                $('#speakScore').show();
                $('#semesterLast').show();
                $('#seventh_step label').show();
                $('#labelregister').hide();
                
                $('#timetoregister').hide();
                

            }
            else if($("#selectionthree").val()=="register")
            {
                $("#container").css("height", "550px");
                $('#speakScore').hide();
                $('#semesterLast').hide();
                $('#seventh_step label').hide();
                $('#timetoregister').show();
                $('#labelregister').show();
                                

            }
        });
    });

    

    $('#submit_seventh').click(function(){
        //send information to server
        
        $seventh_height=$('#container').height();
        var fields1 = $('#seventh_step input[name=sub1]');
        var fields2 = $('#seventh_step input[name=sub2]');
        var error = 0;
        if($("#selectionthree").val()=="rm")
        {
        	$("#container").css("height", "630px");
            $('#speakScore').show();
            $('#semesterLast').show();
            $('#seventh_step label').show();
            $('#labelregister').hide();     
            $('#timetoregister').hide();
            
            $('#speakScore').removeClass('error').removeClass('valid');
            $('#semesterLast').removeClass('error').removeClass('valid');
            fields1.each(function(){
                var value = $(this).val();
                if( value.length<1 || value==field_values[$(this).attr('id')] ) {
                    $(this).addClass('error');
                    $(this).effect("shake", { times:3 }, 50);
                    
                    error++;
                } else {
                    $(this).addClass('valid');
                }
            });

        }
        else if($("#selectionthree").val()=="register")
        {
        	$("#container").css("height", "550px");
            $('#speakScore').hide();
            $('#semesterLast').hide();
            $('#seventh_step label').hide();
            $('#timetoregister').show();
            $('#labelregister').show();
            
            
            $('#timetoregister').removeClass('error').removeClass('valid');
            fields2.each(function(){
                var value = $(this).val();
                if( value.length<1 || value==field_values[$(this).attr('id')] ) {
                    $(this).addClass('error');
                    $(this).effect("shake", { times:3 }, 50);
                    
                    error++;
                } else {
                    $(this).addClass('valid');
                }
            });
        }

        

        if(!error) {
                $.post("../../application.php",
                    {
                        selectionthree: $("#selectionthree").val(),
                        speakScore: $("#speakScore").val(),
                        semesterLast: $("#semesterLast").val(),
                        timetoregister: $("#timetoregister").val()
                        
                    },
                    function(data){
                        
                        alert("This page has been sent to database!");
                    }
            );
                //update progress bar
                $('#progress_text').html('86% Complete');
                $('#progress').css('width','309.6px');
                $('#submit_eighth').css('left','540px');
                $("#container").css("height", "530px");
                //slide steps
                $('#seventh_step').slideUp();
                $('#eighth_step').slideDown();       
        } else return false;
    });


    $('#submit_seventh_back').click(function(){

                $('#progress_text').html('64% Complete');
                $('#progress').css('width','216px');
                $("#container").css("height", $sixth_height);
                //slide steps
                $('#seventh_step').slideUp();
                $('#sixth_step').slideDown(); 
    });

    $('#submit_eighth').click(function(){
        //send information to server
        $eighth_height=$('#container').height();
        $('#eighth_step input').removeClass('error').removeClass('valid');
        var fields = $('#eighth_step input[type=text]');
        var error = 0;
        fields.each(function(){
            var value = $(this).val();
            if( value.length<1 || value==field_values[$(this).attr('id')] ) {
                $(this).addClass('error');
                $(this).effect("shake", { times:3 }, 50);
                
                error++;
            } else {
                $(this).addClass('valid');
            }
        });
        
        //prepare the fourth step

            

        var fields = new Array(
            $('#selection').val(),
            $('#name').val(),
            $('#gpa').val(),
            $('#ID').val(),
            $('#source').val(),
            $('#email').val(),
            $('#phoneNum').val(),
            $('#gradDate').val(),
            $('#currCourses').val(),
            $('#precourse').val(),
            $('#courseLike').val(),
            $('#otherPlace').val(),
            $('#speakScore').val(),
            $('#semesterLast').val()
            
                                     
        );
        var tr = $('#ninth_step tr');
        tr.each(function(){
            //alert( fields[$(this).index()] )
            $(this).children('td:nth-child(2)').html(fields[$(this).index()]);
        });

        if(!error) {
                $.post("../../application.php",
                    {
                    selectionfour: $("#selectionfour").val(),
                    selectionfive: $("#selectionfive").val()
                        
                    },
                    function(data){
                        
                        alert("This page has been sent to database!");
                    }
            );
                //update progress bar
                $("#container").css("height", "550px");
                $('#progress_text').html('100% Complete');
                $('#progress').css('width','360px');
                $('#submit_ninth').css('left','540px');
                //slide steps
                $('#eighth_step').slideUp();
                $('#ninth_step').slideDown();       
        } else return false;
    });

    $('#submit_eighth_back').click(function(){

                if($('#selectionifinternational').val()=="yes")
                {
                    
                }
                else
                {
                    $('#selectionthree').hide();
                    $('#speakScore').hide();
                    $('#semesterLast').hide();
                    $('#seventh_step label').hide();
                    
                    $("#container").css("height", "430px");
                  
                    
                }

                $('#progress_text').html('80% Complete');
                $('#progress').css('width','288px');
                $("#container").css("height", $seventh_height);
        
                //slide steps
                $('#eighth_step').slideUp();
                $('#seventh_step').slideDown(); 
    });
    $('#submit_ninth_back').click(function(){
                if($("#selectionifinternational").val()=="yes")
                {
                    $('#progress_text').html('86% Complete');
                    $('#progress').css('width','309.6px');
                    $("#container").css("height", $eighth_height);
                    //slide steps
                    $('#ninth_step').slideUp();
                    $('#eighth_step').slideDown(); 
                }
                else
                {
                    $("#container").css("height", $sixth_height);
                    $('#progress_text').html('64% Complete');
                    $('#progress').css('width','216px');
                    $('#submit_sixth').css('left','540px');
                    $('#ninth_step').slideUp();
                    $('#sixth_step').slideDown(); 

                }

    });

    $('#submit_ninth').click(function(){
        //send information to server
        $ninth_height=$('#container').height();
        $('#ninth_step input').removeClass('error').removeClass('valid');
        var fields = $('#ninth_step input[type=text]');
        var error = 0;
        fields.each(function(){
            var value = $(this).val();
            if( value.length<1 || value==field_values[$(this).attr('id')] ) {
                $(this).addClass('error');
                $(this).effect("shake", { times:3 }, 50);
                
                error++;
            } else {
                $(this).addClass('valid');
            }
        });

        if(!error) {
                $("#container").css("height", "370px");
                //update progress bar
                $('#progress_text').html('100% Complete');
                $('#progress').css('width','360px');
                $('#submit_sign').css('left','540px');
                //slide steps
                $('#ninth_step').slideUp();
                $('#sign_step').slideDown();       
        } else return false;
    });


    $('#submit_sign_back').click(function(){
        //send information to server
                $('#progress_text').html('100% Complete');
                $('#progress').css('width','360px');
                $("#container").css("height", $ninth_height);
                //slide steps
                $('#sign_step').slideUp();
                $('#ninth_step').slideDown(); 

            });
    $('#submit_sign').click(function(){
        window.location.href='studentpage';
    });


});