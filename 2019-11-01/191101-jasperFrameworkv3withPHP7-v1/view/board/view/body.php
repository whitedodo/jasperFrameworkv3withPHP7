<!-- Article -->
<body>
<h3>게시물 보기(View post)</h3>

<table class="tg_general" style="width:100%;">
  <tr> 
    <td class="tg-nknw" style="background-color:#E2E2E2; width:10%;">
			<span style="font-weight:bold;">번호(num)</span></td>
		<td class="tg-nknw"><?php echo $element->getID(); ?></td>
	</tr>
  <tr> 
    <td class="tg-nknw" style="background-color:#E2E2E2; width:10%;">
			<span style="font-weight:bold;">제목(subject)</span></td>
		<td class="tg-nknw"><?php echo $element->getSubject(); ?></td>
	</tr>
  <tr> 
    <td class="tg-nknw" style="background-color:#E2E2E2; width:10%;">
			<span style="font-weight:bold;">작성자(author)</span></td>
		<td class="tg-nknw"><?php echo $element->getAuthor(); ?></td>
	</tr>	
  <tr> 
    <td class="tg-nknw" style="background-color:#E2E2E2; width:10%;">
			<span style="font-weight:bold;">양식(Mode)</span></td>
		<td class="tg-nknw">
		<?php 
		$targetKeywordIndex = $boardFn->convertTochooseMode( $element->getMode() );
		  echo $boardFn->titleMode($targetKeywordIndex); 
		?>
		</td>
	</tr>	
  <tr> 
    <td class="tg-nknw" style="background-color:#E2E2E2; width:10%;">
			<span style="font-weight:bold;">내용(Memo)</span></td>
		<td class="tg-nknw">
		  <?php echo $element->getMemo(); ?>
		</td>
	</tr>	
  <tr> 
    <td class="tg-nknw" style="background-color:#E2E2E2; width:10%;">
			<span style="font-weight:bold;">등록일자(Regidate)</span></td>
		<td class="tg-nknw"><?php echo $element->getRegidate(); ?></td>
	</tr>	
  <tr> 
    <td class="tg-nknw" style="background-color:#E2E2E2; width:10%;">
			<span style="font-weight:bold;">조회수(Count)</span></td>
		<td class="tg-nknw"><?php echo $element->getCnt(); ?></td>
	</tr>
  <tr> 
    <td class="tg-nknw" style="background-color:#E2E2E2; width:10%;">
			<span style="font-weight:bold;">IP주소(IP Addr)</span></td>
		<td class="tg-nknw"><?php echo substr($element->getIP(), 0, 6); ?></td>
	</tr>
</table>

<!-- 이전 -->
<table style="width:100%">
  <tr>
    <td>
    	<?php echo "<a href=\"../write\" class=\"button\">글쓰기(Write)</a>"; ?>
    	<?php echo "<a href=\"../list\" class=\"button\">목록(List)</a>"; ?>
    	<?php echo "<a href=\"../modify/$pageId\" class=\"button\">수정(Modify)</a>"; ?>
    	<?php echo "<a href=\"../remove/$pageId\" class=\"button\">삭제(Remove)</a>"; ?>
    </td>
  </tr>
</table>

<!-- 댓글 목록 -->
<!-- Comment -->
<h4>댓글(Comment)</h4>

<form name="comment_frm_<?php echo ''; ?>" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	<table class="tg_general" style="width:100%; margin-top:10px;">
	<tr>
		<td class="tg-031e" style="width:8%;">		1</td>
		<td class="tg-031e" style="width:42%;">확인~~~!!!
		</td>
		<td class="tg-031e" style="width:10%;">		도도2(Dodo)</td>
		<td class="tg-031e" style="width:15%;">		2019-08-17 00:52:24		
<br>31.201</td>
		<td class="tg-031e"><input type="password" name="passwd" class="input_box">
			<span class="error">* </span></td>
		<td class="tg-031e" style="width:20%;">
			<input type="button" onclick="jasper_comment('story', '2', '1', '1', 'm')" value="수정(Modify)" class="comment_handle_btn" style="color:#000;">
			<input type="button" onclick="jasper_comment('story', '2', '1', '1', 'd')" value="삭제(Remove)" class="comment_handle_btn" style="color:#000;">
		</td>
	</tr>
	</table>
</form>

<!-- 댓글 달기 -->
<br><br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

<input type="hidden" name="writeMode" value="1">
<input type="hidden" name="memberId" value="-1">
<input type="hidden" name="articleId" value="<?php echo $pageId; ?>">

<table class="tg_general" style="width:100%; margin-top:10px;">
  <tr>
    <td class="tg-nknw" style="background-color:#E2E2E2; width:15%">
      <span style="font-weight:bold;">작성자(Author)</span>
    </td>
    <td style="text-align:left;">
      <input type="text" name="author" class="input_box" value="<?php echo $author; ?>">
      <span class="error">* <?php echo $authorErr; ?></span>
    </td>
  </tr>
  <tr>
    <td class="tg-nknw" style="background-color:#E2E2E2; width:15%">
      <span style="font-weight:bold;">비밀번호(Password)</span>
    </td>
    <td style="text-align:left;">
      <input type="password" name="passwd1" class="input_box" value="<?php echo $passwd1; ?>">
      <span class="error">* <?php echo $passwdErr; ?></span>
    </td>
  </tr>
  <tr>
    <td class="tg-nknw" style="background-color:#E2E2E2; width:15%">
      <span style="font-weight:bold;">비밀번호 확인<br>(Password Check)</span>
    </td>
    <td style="text-align:left;">
      <input type="password" name="passwd2" class="input_box" value="<?php echo $passwd2; ?>">
      <span class="error">* <?php echo $passwdChkErr; ?></span>
    </td>
  </tr>  
  <tr>
    <td colspan="2" style="height:25px;text-align:left;">
      <br>
      <textarea class="comment_box" name="memo" rows="3" cols="20"><?php echo $memo; ?></textarea>
      <span class="error">* <?php echo $memoErr; ?></span>
      <br>
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <input type="submit" name="submit" value="댓글 달기(Write)" class="comment_button" style="color:#000;">  
    </td>
  </tr>
</table>
</form>