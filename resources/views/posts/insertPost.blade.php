<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Laravel Blog</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<h1><a href="/">Laravel Blog</a></h1>
					<p id="user_id" hidden="hidden">{{ Auth::id() }}</p>
				</header>

			<!-- Main -->
				<section id="main" class="container medium">
					<header>
						<h3>新增文章</h3>
					</header>
					<div class="box">
						<form method="post" action="insert">
							<div class="row gtr-50 gtr-uniform">
								<div class="col-12">
									<input type="text" name="title" id="title" value="" placeholder="標題" />
								</div>
								<div class="col-12">
									<textarea name="content" id="content" value="" placeholder="內容"></textarea>
								</div>
								<div class="col-6 col-12-mobilep">
									<select name="catagory" id="catagory">
										<option value="">- 文章分類 -</option>
									</select>
								</div>
								<div class="col-6 col-12-mobilep">
									<input type="button" value="新增分類" id="newCategory" class="button alt" onclick="insertCatagory()" />
								</div>
								<div class="col-12">
									<ul class="actions special">
										<li><input type="button" value="發布" onclick="insert(1);" /></li>
										<li><input type="button" value="存為草稿" onclick="insert(0);" /></li>
									</ul>
								</div>
							</div>
						</form>
					</div>
				</section>

			<!-- Footer -->
				<footer id="footer">
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
			<script>
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});

				// 取得user_id
				function getUserId(){
					return $("#user_id").text();
				}
				
				// 新增一篇文章
				function insert(status_type){
					var params = {
							'title':$("#title").val(),
							'content':$("#content").val(),
							'catagory_id':$("#catagory").val(),
							'status': status_type == 1 ? "published" : "draft",
							'user_id': getUserId()};
					$.ajax({
						url:"http://localhost:8002/api/posts",
						type:"post",
						dataType:"json",
                    	contentType:"application/json; charset=utf-8",
						data:JSON.stringify(params),
						success: function(data) {
							window.location.href = "/";
						},
						error: function(data){
							console.log(data);
						}
					});
				}
				
				// 取得文章類別放到下拉式選單中
				function getCatagory(){
					$.ajax({
						url:"http://localhost:8002/api/catagories?user_id="+getUserId(),
						type:"get",
						dataType:"json",
						contentType:"application/json; charset=UTF-8",
						success: function(data){
							for(i=0;i<data.data.length;i++){
								$("#catagory").append($('<option></option>').val(data.data[i]['id']).text(data.data[i]['name']));
							}
						}
					});
				}				

				// 新增文章分類類別
				function insertCatagory(){
					// SweetAlert 的 alert 功能 https://w3c.hexschool.com/blog/13ef5369
					swal("新增文章分類", {content: "input",}).then((value) => {
						if (value !== "" && value !== null){
							var params = {
								'name':value,
								'user_id':getUserId()
							};
							$.ajax({
								url:"http://localhost:8002/api/catagories",
								type:"post",
								dataType:"json",
								contentType:"application/json; charset=utf-8",
								data:JSON.stringify(params),
								success: function(data) {
									// 防止下拉式選單選項出現重複
									$("#catagory").empty();
									$("#catagory").append($('<option></option>').text('- 文章分類 -'));
									getCatagory();
								},
								error: function(data){
									console.log(data);
								}
							});
						}
  					});
				}

				// 初始化下拉式選單
				getCatagory();
			</script>

	</body>
</html>