 $(document).ready (function() {
            
            $("#doneLog").bind("click", function () {
               $.ajax({
                url: "../controllers/ajax.php",
                type: "POST",
                
                data: ({login: $("#login").val(),password: $("#password").val(),doneLog: $("#doneLog").val()}),
                

                success: function(data){

data=JSON.parse(data);

for(var id in data)
{   
         if([id] == "hidden"){
                        $(".reg").html("<p>Вы авторезировались!</p>");
                        $("#information").text(data[id]);
                    }else{
                        $("#information").text(data);}
  
}
                }
               });
            });
            });