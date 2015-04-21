$(function(){
    //original field values
    var field_values = {
            //id        :  value
            'selection' : 'selection',
            'name'  : 'name',
            'gpa'  : 'gpa',
            'ID' : 'stu ID',
            'source' : 'enter the full info',
            'email'  : 'email address',
            'phoneNum' : 'phone number',
            'gradDate' : 'graduate date',
            'currCourses' : 'current teaching courses',
            'precourse' : 'Previously Taught',
            'courseLike' : 'Course you would like and grade',
            'otherPlace' : 'other place',
            'speakScore' : 'speak score',
            'semesterLast' : 'enter the semster'

    };


    //inputfocus

    $('input#name').inputfocus({ value: field_values['name'] });
    $('input#gpa').inputfocus({ value: field_values['gpa'] });
    $('input#ID').inputfocus({ value: field_values['ID'] }); 
    $('input#source').inputfocus({ value: field_values['source'] }); 

   // $('input#lastname').inputfocus({ value: field_values['lastname'] });
    $('input#email').inputfocus({ value: field_values['email'] }); 
    $('input#phoneNum').inputfocus({ value: field_values['phoneNum'] }); 
    $('input#gradDate').inputfocus({ value: field_values['gradDate'] }); 
    $('input#currCourses').inputfocus({ value: field_values['currCourses'] }); 
    $('input#precourse').inputfocus({ value: field_values['precourse'] }); 
    $('input#courseLike').inputfocus({ value: field_values['courseLike'] }); 
    $('input#otherPlace').inputfocus({ value: field_values['otherPlace'] }); 
    $('input#speakScore').inputfocus({ value: field_values['speakScore'] }); 
    $('input#semesterLast').inputfocus({ value: field_values['semesterLast'] }); 



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

        


            //reset progress bar
    $('#progress').css('width','0');
    $('#progress_text').html('0% Complete');

    //first_step
    $('form').submit(function(){ return false; });
    $('#submit_first').click(function(){
        //remove classes
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
            /*
            if( $('#password').val() != $('#cpassword').val() ) {
                    $('#first_step input[type=password]').each(function(){
                        $(this).removeClass('valid').addClass('error');
                        $(this).effect("shake", { times:3 }, 50);
                    });
                    
                    return false;
            } else*/ 
               
                //update progress bar
            $('#progress_text').html('16% Complete');
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
        $("#container").css("height", "370px");
        $('#second_step input').removeClass('error').removeClass('valid');

        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
        var fields = $('#second_step input[type=text]');
        var error = 0;
        fields.each(function(){
            var value = $(this).val();
            if( value.length<1 || value==field_values[$(this).attr('id')] ||  (($(this).attr('id')=='email')&&(!emailPattern.test(value))) ) {
                $(this).addClass('error');
                $(this).effect("shake", { times:3 }, 50);
                
                error++;
            } else {
                $(this).addClass('valid');
            }
        });

        if(!error) {
                //update progress bar
                $('#progress_text').html('32% Complete');
                $('#progress').css('width','108px');
                
                //slide steps
                $('#second_step').slideUp();
                $('#third_step').slideDown();     
        } else return false;

    });


    $('#submit_third').click(function(){
        //update progress bar
        $("#container").css("height", "370px");
        $('#third_step input').removeClass('error').removeClass('valid');
        var fields = $('#third_step input[type=text]');
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
                $('#progress_text').html('48% Complete');
                $('#progress').css('width','162px');
                
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


    $('#submit_fourth').click(function(){
        //send information to server
        $("#container").css("height", "370px");
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

        if(!error) {
                //update progress bar
                $('#progress_text').html('64% Complete');
                $('#progress').css('width','216px');
                
                //slide steps
                $('#fourth_step').slideUp();
                $('#sixth_step').slideDown();       
        } else return false;
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
        $("#container").css("height", "630px");
        $('#sixth_step input').removeClass('error').removeClass('valid');
        var fields = $('#sixth_step input[type=text]');
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
                $('#progress').css('width','288px');
                
                //slide steps
                console.log($('#selectionifinternational').val());
                if($('#selectionifinternational').val()=="yes")
                {
                    console.log("I select yes");
                    $('#sixth_step').slideUp();
                    $('#senventh_step').slideDown(); 
                }
                else
                {
                    $('#selectionthree').hide();
                    $('#speakScore').hide();
                    $('#semesterLast').hide();
                    $('label').hide();
                    
                    $("#container").css("height", "430px");
                    $('#sixth_step').slideUp();
                    $('#senventh_step').slideDown(); 
                    
                }
                
                      
        } else return false;
    });


    $('#submit_seventh').click(function(){
        //send information to server
        $("#container").css("height", "530px");

        var fields = $('#seventh_step input[type=text]');
        var error = 0;
        if($('#selectionifinternational').val()=="yes")
        {
            $('#seventh_step input').removeClass('error').removeClass('valid');
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

        }

        if(!error) {
                //update progress bar
                $('#progress_text').html('86% Complete');
                $('#progress').css('width','309.6px');
                
                //slide steps
                $('#seventh_step').slideUp();
                $('#eighth_step').slideDown();       
        } else return false;
    });

    $('#submit_eighth').click(function(){
        //send information to server
        $("#container").css("height", "550px");
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
                //update progress bar
                
                $('#progress_text').html('100% Complete');
                $('#progress').css('width','339px');
                //slide steps
                $('#eighth_step').slideUp();
                $('#ninth_step').slideDown();       
        } else return false;
    });

});