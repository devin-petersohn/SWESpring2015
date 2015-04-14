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


    //reset progress bar
    $('#progress').css('width','0');
    $('#progress_text').html('0% Complete');

    //first_step
    $('form').submit(function(){ return false; });
    $('#submit_first').click(function(){
        //remove classes
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
            
            //slide steps
            $('#first_step').slideUp();
            $('#second_step').slideDown();     
            
                         
        } 

        else return false;
         
    });


    $('#submit_second').click(function(){
        //remove classes
        $('#second_step input').removeClass('error').removeClass('valid');

        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
        var fields = $('#second_step input[type=text]');
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
                $('#progress_text').html('32% Complete');
                $('#progress').css('width','108px');
                
                //slide steps
                $('#second_step').slideUp();
                $('#third_step').slideDown();     
        } else return false;

    });


    $('#submit_third').click(function(){
        //update progress bar
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
                $('#fifth_step').slideDown();       
        } else return false;
    });

    $('#submit_fifth').click(function(){
        //send information to server
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

});