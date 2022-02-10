<?php
include 'inc/header.php';
?>

<?php

include_once './lib/database.php';
include_once './helpers/format.php';

spl_autoload_register(function ($className) {
	include_once 'classes/' . $className . '.php';
});

$db = new Database();
$fm = new Format();
$contact = new contact();
$book = new book();
$blog = new blog();

?>

<?php
if (isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['book'])) {
	$book_check = $book->insert_book($_POST);
	if ($book_check) {
?>
		<script>
			if (window.history.replaceState) {
				window.history.replaceState(null, null, window.location.href);
			}
		</script>
	<?php
	}
}
if (isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_POST['contact'])) {
	$contact_check = $contact->insert_contact($_POST);
	if ($contact_check) {
	?>
		<script>
			if (window.history.replaceState) {
				window.history.replaceState(null, null, window.location.href);
			}
		</script>
<?php
	}
}
?>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<?php
		$show_slider = $slider->show_slider();
		if ($show_slider) {
			$count = 0;
			while ($row = $show_slider->fetch_assoc()) {
				if ($count == 0) {
		?>
					<li data-target="#carouselExampleIndicators" data-slide-to="<?= $count ?>" class="active"></li>
				<?php
				} else {
				?>
					<li data-target="#carouselExampleIndicators" data-slide-to="<?= $count ?>"></li>
		<?php
				}
			}
		}
		?>
	</ol>

	<div class="carousel-inner">
		<?php
		$show_slider = $slider->show_slider();
		if ($show_slider) {
			$count = 1;
			while ($row = $show_slider->fetch_assoc()) {
				if ($count == 1) {

		?>
					<div class="carousel-item active">
						<img class="d-block w-100 img-fluid img-slider" src="<?= 'admin/uploads/slider/' . $row['sliderImage'] ?>" alt="First slide">
						<div class="carousel-caption">
							<h2><?= $row['description'] ?></h2>
							<p>...</p>
						</div>
					</div>
				<?php
				} else {
				?>
					<div class="carousel-item">
						<img class="d-block w-100 img-fluid img-slider" src="<?= 'admin/uploads/slider/' . $row['sliderImage'] ?>" alt="First slide">
						<div class="carousel-caption">
							<h2><?= $row['description'] ?></h2>
							<p>...</p>
						</div>
					</div>
		<?php
				}
				$count++;
			}
		}
		?>
	</div>

	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
</div>
<!--- End of Carousel -->
<!--- Restaurant-->
<div class="container">
	<div class="row" id="Restaurant">
		<div class="col navMenu">
			<h2 class="text-center">~ Giới thiệu ~</h2>
		</div>
	</div>
	<div class="row bg-light">
		<div class="col-md-6">
			<h3>Nhà hàng</h3>
			<p>Cám ơn vì ghé qua. Chúng tôi là nhà hàng Việt Nam mang phong cách Ý duy nhất ở Triều Khúc, phục vụ các món ăn ngon của Ý do các đầu bếp giỏi nhất nấu. Chỉ mất vài phút để duyệt qua trang web của chúng tôi và xem menu của chúng tôi. Chúng tôi hy vọng bạn sẽ sớm tham gia với chúng tôi để có trải nghiệm ẩm thực Ý tuyệt vời.</p>
			<h5>Một trải nghiệm độc đáo</h5>
			<p>Tinh túy tới từ sự đơn giản nhưng lại rất khác biệt. Không gian quán pha trộn giữa cổ điển và hiện đại mang lại cho bạn cảm giác thoải mái và không nhàm chán. Tại Lương Sơn Quán, không gian bếp luôn là một không gian mở. Ở đó các khách hàng có thể tận mắt chứng kiến quá trình làm ra món ăn của người đầu bếp.</p>
		</div>
		<div class="col-md-6" data-aos="fade-up">
			<img class="img-fluid" src="images/location.jpg">
		</div>
	</div>
	<div class="row bg-light"><br></div>
	<div class="row bg-light">
		<div class="col-md-6 order-md-1 order-2" data-aos="fade-up">
			<img class="img-fluid " src="images/cuisine.jpg">
		</div>
		<div class="col-md-6 order-md-12 order-1">
			<h3>Món ăn</h3>
			<p>Các món ăn Ý luôn đảm bảo chất lượng về mọi mặt: chất lượng của các thành phần, chất lượng trong quá trình nấu nướng, chất lượng trong việc trình bày món ăn.</p>
			<h5>Nguyên liệu</h5>
			<p>Thực phẩm ở đây, từ các loại rau, trái cây, ngũ cốc, dầu ăn,… đều được quản lý theo quy trình an toàn vệ sinh nghiêm ngặt.</p>
			<p>Hương vị món ăn say đắm cùng những trải nghiệm đặc biệt khi thưởng thức chắc chắn sẽ đem đến những ấn tượng khó phai trong thực khách. Hãy cùng chúng tôi chia sẻ niềm yêu mến với ẩm thực Ý tại khu ẩm thực - nhà hàng Lương Sơn Quán nhé!</p>
		</div>
	</div>
	<!--- End of Restaurant -->
	<!--- Start of Menu-->

	<div class="container">
		<div class="col-md-12" id="Menu">
			<div class="mu-restaurant-menu-area">

				<div class="col navMenu">
					<h2 class="text-center">~ Thực đơn ~</h2>
				</div>

			</div>
		</div>
		<div class="row">
			<?php
			$show_food = $food->show_food_index();
			if ($show_food) {
				$count = 1;
				while ($row = $show_food->fetch_assoc()) {
					if ($count < 9) {
			?>
						<div class="col-md-3 mb-3">
							<div class="card ml-2 mr-2" style="border:none;">
								<a href="details.php?foodId=<?= $row['foodId'] ?>" style="text-decoration: none;color:black">
									<div class="card-body" style="padding:0;border: 1px solid lightgray; border-radius:10px">
										<img width="100%" height="171px" src="<?= 'admin/uploads/' . $row['image'] ?>" style="border-radius: 10px;" width="100%" alt="Ảnh">

										<h5 class="card-title text-center"><?= $row['foodName'] ?></h5>
										<p class="card-text text-center"><?= number_format($row['price'], 0, '', '.') . '₫'; ?></p>
									</div>
								</a>
							</div>
						</div>
			<?php
					}
					$count++;
				}
			}
			?>




		</div>
	</div>



	<div style="text-align: center;padding: 15">
		<a href="menu.php" class="btn btn-outline-secondary w-25" style="border: 1px solid lightgray">Xem thêm</a>
	</div>

	<!--- End of Menu -->
	<!--- Start of Reservation-->
	<div class="row" id="Reservation">
		<div class="col navMenu">
			<h2 class="text-center">~ Đặt bàn ~</h2>
		</div>
	</div>
	<div class="row">
		<div class=" col-lg-12 reserve-container" data-aos="fade-up">
			<img class="img-fluid image-reserve" src="images/reserve.jpg">
			<div class="reserve-text col-lg-12 ">
				<h1 class="text-center">Thời gian biểu</h1>
				<div class="row">
					<div class="col-6">
						<h2 class="text-center">Trưa</h2>
						<h5 class="text-center">11:00 - 15:00</h5>
					</div>
					<div class="col-6">
						<h2 class="text-center">Tối</h2>
						<h5 class="text-center">18:30 - 23:30</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col">
			<form action="" method="post">
				<div class="form-group col-12">
					<?php
					if (isset($book_check)) {
						echo $book_check;
					}
					?>
				</div>
				<div class="form-row">
					<div class="form-group col-6">
						<h4>Thông tin đặt bàn</h4>
						<label for="inputDate"> Ngày</label>
						<input type="date" class="form-control" value="<?= isset($_POST['datebook']) ? $_POST['datebook'] : '' ?>" name="datebook" id="inputDate" placeholder="Ngày gg/mm/aaaa" required>
					</div>
					<div class="form-group col-6">
						<h4>Thông tin cá nhân</h4>
						<label for="inputName"> Họ tên</label>
						<input type="text" class="form-control" value="<?= isset($_POST['namebook']) ? $_POST['namebook'] : '' ?>" name="namebook" id="inputName" placeholder="Họ tên" style="padding: 6px 12px;margin:0;" required>
					</div>
					<div class="form-group col-6">
						<label for="inputTime"> Thời gian</label>
						<input type="time" class="form-control" value="<?= isset($_POST['timebook']) ? $_POST['timebook'] : '' ?>" name="timebook" id="inputTime" placeholder="Thời gian" required>
					</div>
					<div class="form-group col-6">
						<label for="inputEmail"> Email</label>
						<input type="email" class="form-control" value="<?= isset($_POST['emailbook']) ? $_POST['emailbook'] : '' ?>" name="emailbook" id="inputEmail" placeholder="Email" required>
					</div>
					<div class="form-group col-6">
						<label for="inputNumber"> Số lượng khách</label>
						<input type="number" class="form-control" value="<?= isset($_POST['quantitybook']) ? $_POST['quantitybook'] : '' ?>" name="quantitybook" id="inputNumber" placeholder="Số lượng khách" required>
					</div>
					<div class="form-group col-6">
						<label for="inputCel"> Số điện thoại</label>
						<input type="tel" class="form-control" value="<?= isset($_POST['phonebook']) ? $_POST['phonebook'] : '' ?>" name="phonebook" id="inputCel" placeholder="Số điện thoại" required>
					</div>
					<div class="form-group col-12">
						<label for="inputComment"> Yêu cầu khác</label>
						<textarea maxlength="250" class="form-control" rows="4" value="<?= isset($_POST['requestbook']) ? $_POST['requestbook'] : '' ?>" name="requestbook" id="inputComment" placeholder="Yêu cầu khác"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<button type="submit" name="book" class="btn btn-secondary btn-block">Đặt bàn</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!--- End of Reserve -->

	<!-- Tin tức blog -->
	<div class="container">
		<div class="col-md-12" id="Menu">
			<div class="mu-restaurant-menu-area">

				<div class="col navMenu">
					<h2 class="text-center">~ Tin tức ~</h2>
				</div>

			</div>
		</div>
		<div class="row">

			<?php
			$count = 0;
			$show_blog = $blog->show_blog();
			if ($show_blog) {
				while ($row = $show_blog->fetch_assoc()) {
					if ($count < 3) {
			?>
						<div class="col-md-4">
							<div class="card ml-2 mr-2 h-100" style="border:none;">
								<div class="card-body" style="padding:0;border: 1px solid lightgray; border-radius:10px">
									<a style="text-decoration: none;color:#2C2C2C;" href="blog.php?blogId=<?= $row['id'] ?>">

										<img height="200px" width="100%" style="border-radius:5px" src="admin/uploads/<?= $row['image'] ?>" alt="">
										<div class="pl-3 pr-3 mt-1">
											<h5><?= $row['title'] ?></h5>
											<p style="width: 290px;
										overflow: hidden;
										text-overflow: ellipsis;
										line-height: 25px;
										-webkit-line-clamp: 3;
										height: 75px;
										display: -webkit-box;
										-webkit-box-orient: vertical;"><?= $row['description'] ?></p>
										</div>
									</a>

								</div>
							</div>
						</div>
			<?php
					}
					$count++;
				}
			}
			?>

		</div>
	</div>

	<!-- Hết tin tức -->

	<!-- Start Gallery -->
	<section id="Gallery">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="mu-gallery-area">

						<div class="col navMenu">
							<h2 class="text-center">~ Bộ sưu tập ~</h2>
						</div>

					</div>
				</div>
			</div>

			<div class="row">
				<?php
				$show_food = $food->show_food();
				$count = 1;
				if ($show_food) {
					while ($row = $show_food->fetch_assoc()) {
						if ($count < 10) {
				?>
							<div class="col-md-4 mb-5">
								<div class="card ml-2 mr-2" style="border:none;">
									<div class="card-body" style="padding:0;border: 1px solid lightgray; border-radius:10px">
										<img width="100%" height="258px" src="<?= 'admin/uploads/' . $row['image'] ?>" style="border-radius: 10px;" width="100%" alt="Ảnh">
									</div>
								</div>
							</div>
				<?php
						}
						$count++;
					}
				}
				?>




			</div>
		</div>
	</section>
	<!-- End Gallery -->
</div>


<!-- Start Contact section -->
<section id="Contact">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="mu-contact-area">

					<div class="col navMenu">
						<h2 class="text-center">~ Liên hệ ~</h2>
					</div>

					<div class="mu-contact-content">
						<div class="row">

							<div class="col-md-6">
								<div class="mu-contact-left">
									<!-- Email message div -->
									<div id="form-messages"></div>
									<!-- Start contact form -->
									<form id="ajax-contact" method="post" action="" class="mu-contact-form">
										<?php
										if (isset($contact_check)) {
											echo $contact_check;
										}
										?>
										<div class="form-group">
											<label for="name">Họ tên</label>
											<input type="text" class="form-control" id="name" name="namecontact" placeholder="Tên" required>
										</div>
										<div class="form-group">
											<label for="email">Địa chỉ Email</label>
											<input type="email" class="form-control" style="margin: 8px 0; padding: 12px 20px" id="email" name="emailcontact" placeholder="Email" required>
										</div>
										<div class="form-group">
											<label for="subject">Chủ đề</label>
											<input type="text" class="form-control" id="subject" name="titlecontact" placeholder="Chủ đề" required>
										</div>
										<div class="form-group">
											<label for="message">Nội dung</label>
											<textarea maxlength="500" class="form-control" id="message" name="contentcontact" cols="30" rows="10" placeholder="Nhập nội dung" required style="resize: none;"></textarea>
										</div>
										<button type="submit" name="contact" class="btn btn-secondary w-50">Gửi tin</button>
									</form>
								</div>
							</div>

							<div class="col-md-6">
								<div class="mu-contact-right">
									<?php
									$show_info = $config->show_config();
									if ($show_info) {
										while ($row = $show_info->fetch_assoc()) {
											$name_and_slogan = explode('/', $row['name']);
											$name = $name_and_slogan[0];
											$slogan = $name_and_slogan[1];
											$thanks = $name_and_slogan[2];

											$map = $row['map'];
									?>
											<div class="mu-contact-widget mb-4" style="margin-bottom: 4px;">
												<h4><img src="<?= 'admin/uploads/logo/' . $row['logo'] ?>" style="width:30px" alt=""> <?= $name ?></h4>
												<h5><?= $slogan ?></h5>
												<p><?= $thanks ?></p>
												<address>
													<p><i class="fa fa-phone"></i> <?= $row['phone'] ?></p>
													<p><i class="fas fa-envelope"></i> <?= $row['email'] ?></p>
													<p><i class="fa fa-map-marker"></i> <?= $row['address'] ?></p>
												</address>
											</div>
											<div class="mu-contact-widget">
												<h4>Giờ mở cửa</h4>
												<address>
													<p><span>Các ngày trong tuần</span></p>
													<p><span>Trưa</span> 11h00 - 15h00</p>
													<p><span>Tối</span> 18h30 - 23h30</p>
												</address>
											</div>
									<?php
										}
									}
									?>

								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Contact section -->

<!-- Start Map section -->
<section id="OurLocation">
	<div class="col navMenu">
		<h2 class="text-center">~ Vị trí ~</h2>
	</div>
	<iframe style="height: 450px;" src="<?= $map ?>" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
</section>
<!-- End Map section -->

<?php
include("inc/footer.php");
?>