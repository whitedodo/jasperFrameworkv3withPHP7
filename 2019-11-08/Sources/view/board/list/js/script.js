

function keywordSearch(boardUrl){
	var keyword = "";
	keyword = document.getElementById("keyword").value;
	var url = boardUrl;
  
	if ( keyword.length < 0){
		alert('최소 0글자 이상 입력');
	}
	else{
		post_to_url(url, {"keyword":keyword}, "GET");
	}
}


function post_to_url(path, params, method) {

    method = method || "post"; // Set method to post by default, if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.

    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", key);
        hiddenField.setAttribute("value", params[key]);
        form.appendChild(hiddenField);
    }
    
    document.body.appendChild(form);
    form.submit();
    
}