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
			<h2 class="text-center">~ Gi???i thi???u ~</h2>
		</div>
	</div>
	<div class="row bg-light">
		<div class="col-md-6">
			<h3>Nh?? h??ng</h3>
			<p>C??m ??n v?? gh?? qua. Ch??ng t??i l?? nh?? h??ng Vi???t Nam mang phong c??ch ?? duy nh???t ??? Tri???u Kh??c, ph???c v??? c??c m??n ??n ngon c???a ?? do c??c ?????u b???p gi???i nh???t n???u. Ch??? m???t v??i ph??t ????? duy???t qua trang web c???a ch??ng t??i v?? xem menu c???a ch??ng t??i. Ch??ng t??i hy v???ng b???n s??? s???m tham gia v???i ch??ng t??i ????? c?? tr???i nghi???m ???m th???c ?? tuy???t v???i.</p>
			<h5>M???t tr???i nghi???m ?????c ????o</h5>
			<p>Tinh t??y t???i t??? s??? ????n gi???n nh??ng l???i r???t kh??c bi???t. Kh??ng gian qu??n pha tr???n gi???a c??? ??i???n v?? hi???n ?????i mang l???i cho b???n c???m gi??c tho???i m??i v?? kh??ng nh??m ch??n. T???i L????ng S??n Qu??n, kh??ng gian b???p lu??n l?? m???t kh??ng gian m???. ??? ???? c??c kh??ch h??ng c?? th??? t???n m???t ch???ng ki???n qu?? tr??nh l??m ra m??n ??n c???a ng?????i ?????u b???p.</p>
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
			<h3>M??n ??n</h3>
			<p>C??c m??n ??n ?? lu??n ?????m b???o ch???t l?????ng v??? m???i m???t: ch???t l?????ng c???a c??c th??nh ph???n, ch???t l?????ng trong qu?? tr??nh n???u n?????ng, ch???t l?????ng trong vi???c tr??nh b??y m??n ??n.</p>
			<h5>Nguy??n li???u</h5>
			<p>Th???c ph???m ??? ????y, t??? c??c lo???i rau, tr??i c??y, ng?? c???c, d???u ??n,??? ?????u ???????c qu???n l?? theo quy tr??nh an to??n v??? sinh nghi??m ng???t.</p>
			<p>H????ng v??? m??n ??n say ?????m c??ng nh???ng tr???i nghi???m ?????c bi???t khi th?????ng th???c ch???c ch???n s??? ??em ?????n nh???ng ???n t?????ng kh?? phai trong th???c kh??ch. H??y c??ng ch??ng t??i chia s??? ni???m y??u m???n v???i ???m th???c ?? t???i khu ???m th???c - nh?? h??ng L????ng S??n Qu??n nh??!</p>
		</div>
	</div>
	<!--- End of Restaurant -->
	<!--- Start of Menu-->

	<div class="container">
		<div class="col-md-12" id="Menu">
			<div class="mu-restaurant-menu-area">

				<div class="col navMenu">
					<h2 class="text-center">~ Th???c ????n ~</h2>
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
										<img width="100%" height="171px" src="<?= 'admin/uploads/' . $row['image'] ?>" style="border-radius: 10px;" width="100%" alt="???nh">

										<h5 class="card-title text-center"><?= $row['foodName'] ?></h5>
										<p class="card-text text-center"><?= number_format($row['price'], 0, '', '.') . '???'; ?></p>
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
		<a href="menu.php" class="btn btn-outline-secondary w-25" style="border: 1px solid lightgray">Xem th??m</a>
	</div>

	<!--- End of Menu -->
	<!--- Start of Reservation-->
	<div class="row" id="Reservation">
		<div class="col navMenu">
			<h2 class="text-center">~ ?????t b??n ~</h2>
		</div>
	</div>
	<div class="row">
		<div class=" col-lg-12 reserve-container" data-aos="fade-up">
			<img class="img-fluid image-reserve" src="images/reserve.jpg">
			<div class="reserve-text col-lg-12 ">
				<h1 class="text-center">Th???i gian bi???u</h1>
				<div class="row">
					<div class="col-6">
						<h2 class="text-center">Tr??a</h2>
						<h5 class="text-center">11:00 - 15:00</h5>
					</div>
					<div class="col-6">
						<h2 class="text-center">T???i</h2>
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
						<h4>Th??ng tin ?????t b??n</h4>
						<label for="inputDate"> Ng??y</label>
						<input type="date" class="form-control" value="<?= isset($_POST['datebook']) ? $_POST['datebook'] : '' ?>" name="datebook" id="inputDate" placeholder="Ng??y gg/mm/aaaa" required>
					</div>
					<div class="form-group col-6">
						<h4>Th??ng tin c?? nh??n</h4>
						<label for="inputName"> H??? t??n</label>
						<input type="text" class="form-control" value="<?= isset($_POST['namebook']) ? $_POST['namebook'] : '' ?>" name="namebook" id="inputName" placeholder="H??? t??n" style="padding: 6px 12px;margin:0;" required>
					</div>
					<div class="form-group col-6">
						<label for="inputTime"> Th???i gian</label>
						<input type="time" class="form-control" value="<?= isset($_POST['timebook']) ? $_POST['timebook'] : '' ?>" name="timebook" id="inputTime" placeholder="Th???i gian" required>
					</div>
					<div class="form-group col-6">
						<label for="inputEmail"> Email</label>
						<input type="email" class="form-control" value="<?= isset($_POST['emailbook']) ? $_POST['emailbook'] : '' ?>" name="emailbook" id="inputEmail" placeholder="Email" required>
					</div>
					<div class="form-group col-6">
						<label for="inputNumber"> S??? l?????ng kh??ch</label>
						<input type="number" class="form-control" value="<?= isset($_POST['quantitybook']) ? $_POST['quantitybook'] : '' ?>" name="quantitybook" id="inputNumber" placeholder="S??? l?????ng kh??ch" required>
					</div>
					<div class="form-group col-6">
						<label for="inputCel"> S??? ??i???n tho???i</label>
						<input type="tel" class="form-control" value="<?= isset($_POST['phonebook']) ? $_POST['phonebook'] : '' ?>" name="phonebook" id="inputCel" placeholder="S??? ??i???n tho???i" required>
					</div>
					<div class="form-group col-12">
						<label for="inputComment"> Y??u c???u kh??c</label>
						<textarea maxlength="250" class="form-control" rows="4" value="<?= isset($_POST['requestbook']) ? $_POST['requestbook'] : '' ?>" name="requestbook" id="inputComment" placeholder="Y??u c???u kh??c"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<button type="submit" name="book" class="btn btn-secondary btn-block">?????t b??n</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!--- End of Reserve -->

	<!-- Tin t???c blog -->
	<div class="container">
		<div class="col-md-12" id="Menu">
			<div class="mu-restaurant-menu-area">

				<div class="col navMenu">
					<h2 class="text-center">~ Tin t???c ~</h2>
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

	<!-- H???t tin t???c -->

	<!-- Start Gallery -->
	<section id="Gallery">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="mu-gallery-area">

						<div class="col navMenu">
							<h2 class="text-center">~ B??? s??u t???p ~</h2>
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
										<img width="100%" height="258px" src="<?= 'admin/uploads/' . $row['image'] ?>" style="border-radius: 10px;" width="100%" alt="???nh">
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
						<h2 class="text-center">~ Li??n h??? ~</h2>
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
											<label for="name">H??? t??n</label>
											<input type="text" class="form-control" id="name" name="namecontact" placeholder="T??n" required>
										</div>
										<div class="form-group">
											<label for="email">?????a ch??? Email</label>
											<input type="email" class="form-control" style="margin: 8px 0; padding: 12px 20px" id="email" name="emailcontact" placeholder="Email" required>
										</div>
										<div class="form-group">
											<label for="subject">Ch??? ?????</label>
											<input type="text" class="form-control" id="subject" name="titlecontact" placeholder="Ch??? ?????" required>
										</div>
										<div class="form-group">
											<label for="message">N???i dung</label>
											<textarea maxlength="500" class="form-control" id="message" name="contentcontact" cols="30" rows="10" placeholder="Nh???p n???i dung" required style="resize: none;"></textarea>
										</div>
										<button type="submit" name="contact" class="btn btn-secondary w-50">G???i tin</button>
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
												<h4>Gi??? m??? c???a</h4>
												<address>
													<p><span>C??c ng??y trong tu???n</span></p>
													<p><span>Tr??a</span> 11h00 - 15h00</p>
													<p><span>T???i</span> 18h30 - 23h30</p>
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
		<h2 class="text-center">~ V??? tr?? ~</h2>
	</div>
	<iframe style="height: 450px;" src="<?= $map ?>" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>
</section>
<!-- End Map section -->

<?php
include("inc/footer.php");
?>