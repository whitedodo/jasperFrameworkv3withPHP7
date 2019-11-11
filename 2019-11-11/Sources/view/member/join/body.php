<h3>회원가입(Join)</h3>
<hr>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

<input type="hidden" name="member_ok" value="1" />
<!-- 약관(Agreement) -->
<table class="tg_general">
	<tr>	
		<td>
			홈페이지 서비스를 이용하는데 필요한 약관은 하단 사이트에서 참고하십시오.<br>
			개인정보에 관한 사항도 하단 사이트에서 참고하십시오.<br>
			회원가입은 이의 사항에 동의한 것으로 간주합니다.<br>
			(Please refer to the site below for the terms and conditions for using the website service.)<br>
			(Please also refer to the following site for personal information.)<br>
			(Membership is regarded as having agreed to the objection.)
		</td>
	</tr>
</table>

<!-- 약관(Agreement) -->
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

<table class="tg_general" style="margin-top: 40px;">
	<tr>
		<td>
            <input type="submit" class="button" value="회원가입(Memberjoin)" />
            <a href="login" class="button">로그인(Login)</a>
        </td>
    </tr>
    <tr>
    	<td>
            <a href="agreement" target="_blank"><b>회원가입 약관(Membership Terms)</b></a>
            &nbsp;&nbsp;&nbsp;
            <a href="privacy" target="_blank"><b>개인정보정책(Privacy policy)</b></a>
    	</td>
   	</tr>
</table>
    
</form>