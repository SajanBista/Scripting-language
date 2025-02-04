<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        $(document).ready(function(){
            $("#click1").click(function(){
               $.ajax({url:"message.php",
                success : function(result){
                   $("#p1").html(result);
                }
               });

            });
        });
    </script>

</head>
<body>
    <p id="p1">...</p>
    <button id="click1" value="click">Click</button>
</body>
</html>