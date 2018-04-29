
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AJAX: Sign Up Page</title>

        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script>
        
            function validateForm() {
                
                return false;
           
            }
            
        </script>
        
        <script>
            /* global $*/
   function getCountyList_jQuery() {        
     $.ajax({
            type: "get",
            url: "http://hosting.csumb.edu/laramiguel/ajax/countyList.php",
            dataType: "json",
            data: { "state": $("#state").val() },
            success: function(data,status) {
                 $("#county").html("<option> Select One </option>");
                 for (var i=0; i< data['counties'].length; i++){
                     $("#county").append("<option>" + data["counties"][i].county + "</option>" );
                }
              },
              complete: function(data,status) { //optional, used for debugging purposes
                //  alert(status);
              }
         });
}


            
            $(document).ready( function(){
                
                $("#submit").click( function(){
            
                        
                });
                
                $("#username").change(function()
                {
                    $.ajax({

                        type: "GET",
                        url: "checkUsername.php",
                        dataType: "json",
                        data: { "username": $("#username").val() },
                        success: function(data,status) {
                        
                            //alert(data.password);
                            
                            if (!data) {  //data == false
                                
                                $("#confirmation").html("Username Available!");
                                $("#confirmation").css("color","green");
                            } else {
                                
                                $("#confirmation").html("Username Unavailable!");
                                $("#confirmation").css("color","red");
                            }
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                    });//ajax
                    
                    
                });
                
                $("#pass2").change(function(){
                    var password = $("#pass1").val();
                    var passwordCheck = $("#pass2").val();
                    if (password == passwordCheck){
                        $("#passwordOutput").html("passwords match");
                        $("#passwordOutput").css("color","green");
                    } else {
                        $("#passwordOutput").html("passwords doesn't match");
                        $("#passwordOutput").css("color","red");
                    }
                    
                });
                
                $("#state").change(function() {
                    //alert($("#state").val());
                    
                    $.ajax({

                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/countyList.php",
                        dataType: "json",
                        data: { "state": $("#state").val()},
                        success: function(data,status) {
                          
                        //   alert(data[0].county);
                        $("#county").html("<option> - Select One -</option>");
                        for(var i = 0; i < data.length; i++){
                             $("#county").append("<option>" + data[i].county + "</option>");
                        }
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                    
                    });//ajax
                    
                    
                    
                });
                
                $("#zipCode").change( function(){  
                    
                    //alert( $("#zipCode").val() );  
                    
                    $.ajax({

                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/cityInfoByZip.php",
                        dataType: "json",
                        data: { "zip": $("#zipCode").val()   },
                        success: function(data,status) {
                          
                          //alert(data.city);
                          $("#city").html(data.city);
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                    });//ajax
                    
                    
                    
                } );
                
            }   ); //documentReady
            
            
            
        </script>

    </head>

    <body>
    
       <h1> Sign Up Form </h1>
    
        <form onsubmit="return validateForm()">
            <fieldset>
               <legend>Sign Up</legend>
                First Name:  <input type="text"><br> 
                Last Name:   <input type="text"><br> 
                Email:       <input type="text"><br> 
                Phone Number:<input type="text"><br><br>
                Zip Code:    <input type="text" id="zipCode"><br>
                City:        <span id="city"></span>
                <br>
                Latitude: 
                <br>
                Longitude:
                <br><br>
                State: 
                <select id="state" onchange="getCountyList_jQuery()">
                    <option value="">Select One</option>
                    <option value="ca"> California</option>
                    <option value="ny"> New York</option>
                    <option value="tx"> Texas</option>
                    <option value="va"> Virginia</option>
                </select><br />
                Select a County: <select id="county"></select><br>
                
                
                Desired Username: <input type="text" id = "username">
                <span id="confirmation"></span><br/>
                
                Password: <input id="pass1" type="password"><br>
                
                Type Password Again: <input id="pass2" type="password"><span id = "passwordOutput"></span><br>
                
                <input id = "submit" type="submit" value="Sign up!">
                <br />
            </fieldset>
        </form>
    </body>
</html>