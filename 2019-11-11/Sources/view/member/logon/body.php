<h3>로그온(Logon)</h3>
<hr>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

<input type="hidden" name="login_ok" value="1">

<table class="tbl" style="width:100%; border:1px">
	<tr>
		<td style="padding:10px 0 0 10px; vertical-align:top;">
			<!-- 로그인 영역 -->
			<table class="tbl">
				<tr>
					<td>
                        <a href="logout" class="button">로그아웃<br>(Logout)</a>
					</td>
					<td>
                        <a href="myinfo" class="button">내 정보<br>(My info)</a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>