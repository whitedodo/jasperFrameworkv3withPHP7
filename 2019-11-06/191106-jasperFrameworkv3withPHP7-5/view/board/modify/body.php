<!-- Article -->
<body>
<h3>게시물 수정(Modify post)</h3>

<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

<input type="hidden" name="modifyMode" value="1">
<input type="hidden" name="memberId" value="<?php echo $memberId; ?>">
<input type="hidden" name="category" value="<?php echo $category; ?>">
<table class="tg_general" style="width:100%;">
  <tr>
    <td class="tg-nknw" style="background-color:#E2E2E2; width:10%;">
      <span style="font-weight:bold;">제목(Subject)</span>
    </td>
    <td style="text-align:left;">
      <input type="text" name="subject" class="input_box" value="<?php echo $subject; ?>">
      <span class="error">* <?php echo $subjectErr;?></span>
    </td>
  </tr>
  <tr>
    <td class="tg-nknw" style="background-color:#E2E2E2; width:10%">
      <span style="font-weight:bold;">작성자(Author)</span>
    </td>
    <td style="text-align:left;">
      <input type="text" name="author" class="input_box" value="<?php echo $author; ?>">
      <span class="error">* <?php echo $authorErr;?></span>
    </td>
  </tr>
  <tr>
    <td class="tg-nknw" style="background-color:#E2E2E2; width:10%">
      <span style="font-weight:bold;">비밀번호(Password)</span>
    </td>
    <td style="text-align:left;">
      <input type="password" name="passwd1" class="input_box" value="">
      <span class="error">* <?php echo $passwdErr;?></span>
    </td>
  </tr>
  <tr>
    <td class="tg-nknw" style="background-color:#E2E2E2; width:10%">
      <span style="font-weight:bold;">비밀번호 확인(Password Check)</span>
    </td>
    <td style="text-align:left;">
      <input type="password" name="passwd2" class="input_box" value="">
      <span class="error">* <?php echo $passwdChkErr;?></span>
    </td>
  </tr>
  
  <tr>
    <td class="tg-nknw" style="background-color:#E2E2E2; width:10%">
		<span style="font-weight:bold;">양식(Mode)</span>
    </td>
    <td style="text-align:left;">
		<?php $boardFn->printMode($mode); ?>
    </td>
  </tr>
  
  <tr>
    <td class="tg-nknw" style="background-color:#E2E2E2;" colspan="2">
      <span style="font-weight:bold;">내용(Memo)</span>
    </td>
  <tr>
    <td colspan="2" style="height:200px;text-align:left;">
      <br>
      <textarea class="ckeditor" name="memo" rows="5" cols="40"><?php echo $memo; ?></textarea>
      <span class="error">* <?php echo $memoErr;?></span>
      <br>
    </td>
  </tr>
  <tr>
  	<td class="tg-nknw" style="background-color:#E2E2E2;">
      <span style="font-weight:bold;">파일(File)</span>
    </td>
    <td>
      <span style="font-weight:bold;">
      		<input type="file" name="myfile[]" multiple='multiple'><br>
      		<input type="file" name="myfile[]" multiple='multiple'><br>
      		<input type="file" name="myfile[]" multiple='multiple'><br>
      		<input type="file" name="myfile[]" multiple='multiple'><br>
      		<input type="file" name="myfile[]" multiple='multiple'><br>
      </span>
    </td>
  <tr>
  <tr>
  	<td class="tg-nknw" style="background-color:#E2E2E2;" colspan="2">
  		<span style="font-weight:bold;">현재 파일 목록 삭제 여부(Delete current file list)</span>
      <select name="IsfileRemove">
            <option value="no">아니오(No)</option>
            <option value="yes">네(Yes)</option>
      </select> 
  	</td>
  </tr>
  <tr>
    <td colspan="2" style="text-align:left;">
      <span style="font-weight:bold;">지원가능한 확장자(Supported Extensions)</span><br>
      jpg, jpeg, png, gif, hwp, doc, docx, xls, xlsx, ppt, pptx, zip, tar.gz
	</td>  
  </tr>
  
</table>

<!-- 하단 -->
<table style="width:100%">
  <tr>
    <td>
  		<input type="submit" name="submit" value="수정(Modify)" class="button" style="color:#000;">  
      	<?php
            echo "<a href=\"$homeDir/index.php/board/$boardName/list\" class=\"button\">목록(List)</a>";
        ?>
    </td>
  </tr>
</table>
</form>
