$(function(){
    // jQuery methods go here...
    $("#searchButton").click(function(event) {
        event.preventDefault();
        let responseJSON;
        $.get('getcards.php?name=' + $("#searchInput").val(), function(response){
            responseJSON = JSON.parse(response);
            console.log(responseJSON.status);
            if(responseJSON.success) {
                const rows = responseJSON.data.rows;
                $("#table tbody").empty();
                rows.forEach((row,index) => {
                    $("#table tbody").append(
                        "<tr id='row"+index+"'>"+
                            "<td><img class='materialboxed' src='"+row.imageUrl+"'></img></td>"+
                            "<td>"+row.name+"</td>"+
                            "<td>"+row.type+"</td>"+
                            "<td>"+row.multiverseid+"</td>"+
                        "</tr>"
                    );
                });
            }
        });
    }); 
 });
