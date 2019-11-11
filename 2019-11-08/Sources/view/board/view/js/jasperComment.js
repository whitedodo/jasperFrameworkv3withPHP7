
    function jasper_comment(boardName, pageId, commentId, type){

      var frmName = "comment_frm_" + commentId;
  //    alert ( id + "-" + type );
  //    alert ( document.forms[frmName].elements("choose").value );
  //    alert ( frmName );
      var myForm = document.forms[frmName];
      var startID = 1;
      var lastID = 4;

      while ( startID <= lastID ){
        
        var hiddenField = document.createElement("input");
        
        hiddenField.setAttribute("type", "hidden");
        
        switch ( startID )
        {
          case 1:    
            hiddenField.setAttribute("name", "boardName");
            hiddenField.setAttribute("value", boardName);   
            break;
            
          case 2:
            hiddenField.setAttribute("name", "pageId");
            hiddenField.setAttribute("value", pageId);
            break;
      
          case 3:
            hiddenField.setAttribute("name", "commentId");
            hiddenField.setAttribute("value", commentId);
            break;
            
          case 4:
            hiddenField.setAttribute("name", "typeMode");
            hiddenField.setAttribute("value", type);
            break;
        }

        myForm.appendChild(hiddenField);
        
        startID++;
      }
      
      myForm.submit();
    }