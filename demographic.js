$.each( postcodes, function( key, value ) {

	//data object for submitting to server
	var data = {
      code: value,
      action: 'scrapeOnce'
    }

  $.ajax({
    type: "POST",
    url: 'ajax.php',
    data: data,
    dataType: "json",
    success: function(msg){

    	//total up the demographics in the global object
    	demographic.A.total = parseInt(msg.A) + parseInt(demographic.A.total);
    	demographic.B.total = parseInt(msg.B) + parseInt(demographic.B.total);
    	demographic.C1.total = parseInt(msg.C1) + parseInt(demographic.C1.total);
    	demographic.C2.total = parseInt(msg.C2) + parseInt(demographic.C2.total);
    	demographic.D.total = parseInt(msg.D) + parseInt(demographic.D.total);
    	demographic.E.total = parseInt(msg.E) + parseInt(demographic.E.total);
    	globalCounter++;
    	
    	$("#completed").html(globalCounter); //update the onscren progres counter

    	if(globalCounter == postcodesLength){
			  console.log(demographic);

			  //add in the totals for demo breakdown
			  $("#ATotal").html(demographic.A.total);
			  $("#BTotal").html(demographic.B.total);
			  $("#C1Total").html(demographic.C1.total);
			  $("#C2Total").html(demographic.C2.total);
			  $("#DTotal").html(demographic.D.total);
			  $("#ETotal").html(demographic.E.total);

			  //total everything up so we can workout a percentage
			  var total = demographic.A.total + demographic.B.total + demographic.C1.total + demographic.C2.total + demographic.D.total + demographic.E.total;

			  //calculate the percentages
			  demographic.A.percentage = ((demographic.A.total/total)*100).toFixed(1);
			  demographic.B.percentage = ((demographic.B.total/total)*100).toFixed(1);
			  demographic.C1.percentage = ((demographic.C1.total/total)*100).toFixed(1);
			  demographic.C2.percentage = ((demographic.C2.total/total)*100).toFixed(1);
			  demographic.D.percentage = ((demographic.D.total/total)*100).toFixed(1);
			  demographic.E.percentage = ((demographic.E.total/total)*100).toFixed(1);

			  //add in the percentage for demo breakdown
			  $("#APercentage").html(demographic.A.percentage);
			  $("#BPercentage").html(demographic.B.percentage);
			  $("#C1Percentage").html(demographic.C1.percentage);
			  $("#C2Percentage").html(demographic.C2.percentage);
			  $("#DPercentage").html(demographic.D.percentage);
			  $("#EPercentage").html(demographic.E.percentage);

				//Get chart context with jQuery - using jQuery's .get() method.
				var ctx = $("#demographicChart").get(0).getContext("2d");

				//This will get the first returned node in the jQuery collection.
				var myNewChart = new Chart(ctx);

				var data = {
				labels : ["A","B","C1","C2","D","E"],
				datasets : [
					{
						fillColor : "rgba(151,187,205,0.5)",
						strokeColor : "rgba(151,187,205,1)",
						data : [demographic.A.total,
										demographic.B.total,
										demographic.C1.total,
										demographic.C2.total,
										demographic.D.total,
										demographic.E.total
										]
							}
					]
				}

				var options;
				
				new Chart(ctx).Bar(data,options);

			}

    } //end AJAX success
  }); //end AJAX*/

});