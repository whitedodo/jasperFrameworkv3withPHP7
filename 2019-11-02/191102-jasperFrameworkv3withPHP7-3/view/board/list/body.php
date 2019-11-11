<!-- Article -->
<body>
<table class="tbl">
	<tr class="tbl_header">
		<td style="width:7%;">번호<br>(Num)</td>
		<td style="width:7%;">분류<br>(Category)</td>
		<td style="width:7%;">모드<br>(Mode)</td>
		<td>글 제목<br>(Subject)</td>
		<td style="width:16%">댓글 갯수<br>(Comment Count)</td>
		<td style="width:5%">작성자<br>(Author)</td>
		<td style="width:5%">조회수<br>(Count)</td>
		<td style="width:15%">등록일자<br>(Regidate)</td>
	</tr>
	
	<?php
	
	$index = 1;
	# 게시물 출력
	foreach ($stack as $val){
	    
	    if ( $index % 2 === 0 ){
	    
	?>
	<tr class="tbl_rol">
		<td><?php echo $val->getId(); ?></td>
		<td><?php echo $val->getCategory(); ?></td>
		<td><?php 
		  $targetKeywordIndex = $boardFn->convertTochooseMode( $val->getMode() );
		  echo $boardFn->titleMode($targetKeywordIndex); 
		?>
		</td>
		<td>
			<a href="../view/<?php echo $val->getId(); ?>">
				<?php echo $val->getSubject(); ?>
			</a>
		</td>
		<td><?php echo $val->getCommentCnt(); ?></td>
		<td><?php echo $val->getAuthor(); ?></td>
		<td><?php echo $val->getCnt(); ?></td>
		<td><?php echo $val->getRegidate(); ?></td>
	</tr>
	
	<?php
	    }else{
	        
	?>
	
	<tr class="tbl_col">
		<td><?php echo $val->getId(); ?></td>
		<td><?php echo $val->getCategory(); ?></td>
		<td><?php 
		  $targetKeywordIndex = $boardFn->convertTochooseMode( $val->getMode() );
		  echo $boardFn->titleMode($targetKeywordIndex); 
		?>
		</td>
		<td>
			<a href="../view/<?php echo $val->getId(); ?>">
				<?php echo $val->getSubject(); ?>
			</a>
		</td>
		<td><?php echo $val->getCommentCnt(); ?></td>
		<td><?php echo $val->getAuthor(); ?></td>
		<td><?php echo $val->getCnt(); ?></td>
		<td><?php echo $val->getRegidate(); ?></td>
	</tr>
	
	<?php 
	    }
	    $index++;
	    
	}
	?>

</table>
						

<!-- Pager -->
<div id="wrapper">
  <div id="content">
    <?php
        $boardDB->pager( $boardName );
    ?>
    <br>
  </div>
</div>
<table style="width:100%">
  <tr>
    <td style="text-align:center;">
      <input type="hidden" value="<?php echo $boardName; ?>">
      <input type="text" id="keyword" class="input_box" value="<?php echo $subject;?>">
      <a href="javascript:keywordSearch('<?php echo $_SERVER['REQUEST_URI'];?>');" class="button" style="color:#000;">검색(Search)</a>
    </td>
  </tr>
  <tr>
    <td>
    	<?php echo "<a href=\"../write\" class=\"button\">글쓰기(Write)</a>"; ?>
    	<?php echo "<a href=\"../rss\" class=\"button\">RSS</a>"; ?>
    </td>
  </tr>
</table>