$(document).ready(function(){
 
   			
  $("#submitcomment").on('click', function(e) {
	var kategori = $("#kategori").val();	
    // prevent default action
  	var tanggal = 	$("#tanggal").val();	
	var jam_mulai = $("#jam_mulai").val();
	var jam_selesai = $("#jam_selesai").val();	
	var deskripsi_kerja = $("#deskripsi_kerja").val();	

	if(){
		
	}
		
	
    // send ajax request
    $.ajax({
							 url:"validationComment.php",
							 method: "GET",
							 data: "comment="+commented+"&"+"post_id="+post_id,
							 dataType: "text",
							 
							 success: function(data) {
								
								 if(data.error){
									 alert("server reported error"); 
								 }else{
									
									document.getElementById("commentpage").innerHTML += data;
									 
								 }
							 },
							 error: function(xhr){
								alert(xhr.status);
							}
						});
  });
  
   $("#submitpost").on('click', function(e) {
	  var title = $("#title").val();	
	var content = $("#post").val();	
    // prevent default action
  	
		
	
    // send ajax request
    $.ajax({
							 url:"posting.php",
							 method: "GET",
							 data: "content="+content+"&"+"title="+title+"&",
							 dataType: "text",
							 
							 success: function(data) {
								
								 if(data.error){
									 alert("server reported error"); 
								 }else{
									
									document.getElementById("page-content-wrapper").innerHTML += "<div class=\"alert alert-success fade in\">"+
								"<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>"+
								"<p><strong>Success: </strong>Your post have been submitted, redirecting to your new post in a few sec</p></div>";
									setTimeout(function(){ window.location = 'pagepost.php?postid='+data;  }, 3000);
								 }
							 },
							 error: function(xhr){
								alert(xhr.status);
							}
						});
  });
  
  function go_to_you_page(data){
  alert("masuk");
	{  
		window.location.replace = 'pagepost.php?postid='+data;     
	} 
  }
  
  
});

	
	
	
		
		
		
	
	
		

	
		
	
	





	