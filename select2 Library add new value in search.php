<select style="width: 200px;" id="continent">
      <option value="AL">Asia</option>
      <option value="AK">Europe</option>
</select>
<script>
	//var value = prompt("Do you have a state abbriviation for "+typed+"?");
	
  var typed = "";
	$('#continent').select2({
	  language: {
		noResults: function(term) {
            console.log(event.target.value);
			typed = event.target.value;
			if (typed.length>4){
				$("span.select2-container").addClass ('select2-container--focus');
				continentVal = prompt("Sorry ! Not found any continent do you want to add new continent"); 
				console.log(' === '+continentVal);				
				if (continentVal != ""){
					console.log('Here we go '+event.target.value+ continentVal);
					// Create a DOM Option and pre-select by default
					var newOption = new Option(continentVal,continentVal, true, true);
					// Append it to the select
					$('#continent').append(newOption).trigger('change');
				}
			}
		}
	  }
	});
	
</script>