
$(document).ready(function() {
    var specialElementHandlers = {
        "#editor":function(element,renderner){
            return true;
        }
    };

    $("#cmd").click(function(){

        var doc = new jsPDF();

        doc.fromHTML($("#target").html(),15,15,{
            "elementHandlers":specialElementHandlers
        });

        doc.save("sample-file.php");

    });

});