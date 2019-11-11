<h3><?php echo $title; ?></h3>
<table class="tbl">
	<tr class="tbl_header">
		<td style="width:5%;">번호<br>(Num)</td>
		<td>글 제목<br>(Subject)</td>
		<td style="width:30%">등록일자<br>(Regidate)</td>
	</tr>
	
	
	<?php 
	   $index = 1;
	   
	   foreach ($stack as $val){
	       if ( $index % 2 === 0 ){
	?>
	<tr class="tbl_rol">
		<td style="width:7%;text-align:center;"><?php echo $val->getId(); ?></td>
		<td>
			<a href="../view/<?php echo $val->getId(); ?>" target="_parent">
			<?php 
		          $targetKeywordIndex = $boardFn->convertTochooseMode( $val->getMode() );
		          echo $boardFn->titleMode($targetKeywordIndex);
		          echo " / ";
		    ?>
			<?php echo $val->getSubject(); ?><?php echo " / " . $val->getAuthor(); ?>
			</a>
		</td>
		<td style="width:15%"><?php echo $val->getRegidate(); ?></td>
	</tr>
	
	<?php
	       }else{
	           
    ?>
	  
	<tr class="tbl_col">
		<td style="width:7%;text-align:center;"><?php echo $val->getId(); ?></td>
		<td>
			<a href="../view/<?php echo $val->getId(); ?>" target="_parent">
			<?php 
		          $targetKeywordIndex = $boardFn->convertTochooseMode( $val->getMode() );
		          echo $boardFn->titleMode($targetKeywordIndex);
		          echo " / ";
		    ?>
			<?php echo $val->getSubject(); ?><?php echo " / " . $val->getAuthor(); ?>
			</a>
		</td>
		<td style="width:15%"><?php echo $val->getRegidate(); ?></td>
	</tr>
	  
	  
	<?php          
	           
	       }
	
	       $index++;
	
	   }
	?>

</table>