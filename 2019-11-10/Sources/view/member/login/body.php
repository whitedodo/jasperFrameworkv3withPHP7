<h3>로그인(Login)</h3>
<hr>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

<input type="hidden" name="login_ok" value="1">

<table class="tbl" style="width:100%; border:1px">
	<tr>
		<td rowspan="2" style="width:10%; vertical-align:top;">
			<img src="<?php echo $skin_dir; ?>images/creative.jpg" alt="Creative Login">
		</td>
		<td style="padding:10px 0 0 10px; vertical-align:top;">
			<!-- 로그인 영역 -->
			<table class="tbl">
				<tr>
					<td>
						E-MAIL(이메일)
					</td>
					<td>
						<input type="text" name="email" value="<?php echo $email; ?>" />
					</td>
					<td>
						* <?php echo $emailErr; ?>
					</td>
				</tr>
				<tr>
					<td>
						PASSWORD(비밀번호)
					</td>
					<td>
						<input type="password" name="passwd" value="<?php echo $passwd; ?>" />
					</td>
					<td>
						* <?php echo $passwdErr; ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
            <input type="submit" class="button" value="로그인(LOGIN)" />
            <a href="join" class="button">회원가입(Join)</a>
		</td>
	</tr>
</table>
</form>