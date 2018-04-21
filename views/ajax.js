            

            $(document).ready (function() {
            
            $("#done").bind("click", function () {
               $.ajax({
                url: "../controllers/ajax.php",
                type: "POST",
                
                data: ({name: $("#name").val(), login: $("#login").val(),done: $("#done").val(),doneLog: $("#doneLog").val(),password: $("#password").val(),password2: $("#password2").val(),email: $("#email").val()}),
                

                success: function(data){

data=JSON.parse(data);

for(var id in data)
{   
         if([id] == "hidden"){
                        $(".reg").html("<p>Вы зарегестрировались!</p>");
                        $("#information").text(data[id]);
                    }else{
                        $("#information").text(data);}
  
}
                }
               });
            });
            });