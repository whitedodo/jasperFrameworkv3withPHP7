<h3>회원가입(Join)</h3>
<hr>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<input type="hidden" name="member_ok" value="1" />
<table class="tg_general">
	<tr>
		<td style="width:25%; vertical-align:top;">
			이메일(E-mail)
		</td>
		<td style="vertical-align:middle;">
			<input type="text" name="email" value="<?php echo $email; ?>" />
			* <?php echo $emailErr; ?>
		</td>
	</tr>
	<tr>
		<td style="vertical-align:top;">
			비밀번호(Password)
		</td>
		<td style="vertical-align:middle;">
			<input type="password" name="passwd1" />
			* <?php echo $passwdErr; ?>
		</td>
	</tr>
	<tr>
		<td style="vertical-align:top;">
			비밀번호 확인(Password Check)
		</td>
		<td style="vertical-align:middle;">
			<input type="password" name="passwd2" />
			* <?php echo $passwdChkErr; ?>
		</td>
	</tr>
	<tr>
		<td style="vertical-align:top;">
			이름(Name)
		</td>
		<td style="vertical-align:middle;">
			<input type="text" name="name" value="<?php echo $name; ?>" />
			* <?php echo $nameErr; ?>
		</td>
	</tr>
	<tr>
		<td style="vertical-align:top;">
			닉네임(Nickname)
		</td>
		<td style="vertical-align:middle;">
			<input type="text" name="nickname" value="<?php echo $nickname; ?>" />
			* <?php echo $nicknameErr; ?>
		</td>
	</tr>
	<tr>
		<td style="vertical-align:top;">
			성별(Sex)
		</td>
		<td style="vertical-align:middle;">
			<select name="sex">
				<option>남(Man)</option>
				<option>여(Woman)</option>
			</select>
			* <?php echo $sexErr; ?>
		</td>
	</tr>
	<tr>
		<td style="vertical-align:top;">
			생년월일(Birthdate)
		</td>
		<td style="vertical-align:middle;">
			<input type="text" name="birthdate" value="<?php echo $birthdate; ?>" />
			* <?php echo $birthdateErr; ?>
		</td>
	</tr>
</table>
<!-- 버튼 기능 -->
<input type="submit" class="button" value="회원가입(Memberjoin)" />
<a href="login" class="button">로그인(Login)</a>

</form>