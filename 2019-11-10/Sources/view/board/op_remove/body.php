
<h3>글 삭제(Remove Post)</h3>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

<input type="hidden" name="memberId" value="-1">
<input type="hidden" name="removeMode" value="1">

<table class="tg_general" style="width:100%;">
  <tr>
    <td class="tg-nknw" style="background-color:#E2E2E2; width:10%;">
      <span style="font-weight:bold;">관리자 계정으로 삭제하기 전입니다. 삭제가 되면 영구적으로 복구되지 않습니다.<br></span>
      <span style="font-weight:bold;">이점 알려드립니다.<br></span>
      <span style="font-weight:bold;">Before deleting with an administrator account. Once deleted, it is not permanently recovered.<br></span>
      <span style="font-weight:bold;">Please let me know your benefits.<br></span>
    </td>
  </tr>
</table>
<!-- 하단 -->
<table style="width:100%">
  <tr>
    <td>
  		<input type="submit" name="submit" value="삭제(Remove)" class="button" style="color:#000;">  
      	<?php
            echo "<a href=\"$homeDir/index.php/board/$boardName/list\" class=\"button\">목록(List)</a>";
        ?>
    </td>
  </tr>
</table>
</form>

