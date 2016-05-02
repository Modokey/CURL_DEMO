

<?php
       
	$url = "http://jwgl.szpt.edu.cn/SzptJwBsII/Secure/login.aspx";
	$cookie_file = dirname(__FILE__) . '/cookie.txt'; 

	/*
	 *	第一步，获取 __VIEWSTATE 隐藏域的值
	 *
	 */
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url); //设置访问的URL。
	curl_setopt($ch, CURLOPT_HEADER, 1); //是否输出 HTTP 头部信息。 1 输出 / 0 不输出
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //是否把返回的值存储进变量。 1 存进变量 / 0 直接输出
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);//将 cookie 存在指定的目录。

	$result = curl_exec($ch);
	curl_close($ch);
	
	preg_match('/name="__VIEWSTATE" value="(.*)"/',$result,$str);

	$str = $str['1'];
	
	$post = array(

		'__EVENTTARGET'  => 'btnLogin',
		'__EVENTARGUMENT'=> '',
		'__VIEWSTATE'    => $str,
		'__VIEWSTATEGENERATOR' => '210E3F16',
		'ddlUserType' => '0',
		'txtLogin' => '账号',
		'txtPwd' => '密码'

		);

	/*
	 *	第二步，提交构建字段，并获取cookie
	 *
	 */
  
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 1); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch,CURLOPT_POST,1); //设置是否用 POST 提交。 1 POST / 0 GET
	curl_setopt($ch,CURLOPT_POSTFIELDS,$post);//设置 POST 提交的内容
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);//读取 COOKIE 并在访问时带上。
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file); //存储响应时的 COOKIE

	$result = curl_exec($ch);
	curl_close($ch);

	/*
	 *	第三步 ，带着cookie去登陆之后的页面
	 *
	 *
	 */
	
	$Second_url='http://jwgl.szpt.edu.cn/SzptJwBsII/default.aspx';  

	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $Second_url);
	curl_setopt($ch, CURLOPT_HEADER, 1);  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);  
	$result = curl_exec($ch);  
	curl_close($ch); 

 ?>
