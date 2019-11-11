
<h3>글 보호글(Protected Post)</h3>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

<input type="hidden" name="memberId" value="-1">
<input type="hidden" name="protectedMode" value="1">

<table class="tg_general" style="width:100%;">
  <tr>
    <td class="tg-nknw" style="background-color:#E2E2E2; width:10%;">
      <span style="font-weight:bold;">비밀번호 입력해주세요.(Input the Password)</span>
    </td>
  </tr>
  <tr>
    <td style="text-align:left;">
      <input type="password" name="passwd" class="input_box" value="<?php echo $passwd;?>">
      <span class="error">* <?php echo $passwdErr;?></span>
    </td>
  </tr>
</table>
<!-- 하단 -->
<table style="width:100%">
  <tr>
    <td>
  		<input type="submit" name="submit" value="확인(OK)" class="button" style="color:#000;">  
      	<?php
            echo "<a href=\"$homeDir/index.php/board/$boardName/list\" class=\"button\">목록(List)</a>";
        ?>
    </td>
  </tr>
</table>
</form>

