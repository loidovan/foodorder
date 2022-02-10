-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 28, 2021 lúc 03:20 PM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `food`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(150) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `level` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminEmail`, `adminUser`, `adminPass`, `level`) VALUES
(1, 'Đỗ Lợi', 'loidv17821@gmail.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 0),
(3, 'Bình Minh', 'abc@gmail.com', 'b', '92eb5ffee6ae2fec3ad71c777531578f', 1),
(7, 'Anh', 'a@gmail.com', 'a', '0cc175b9c0f1b6a831c399e269772661', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_blog`
--

CREATE TABLE `tbl_blog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(510) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_blog`
--

INSERT INTO `tbl_blog` (`id`, `title`, `description`, `content`, `image`, `datetime`) VALUES
(2, 'Cách tăng cường sức khỏe từ hồng sâm Hàn Quốc', 'Hồng sâm Hàn Quốc với hàm lượng ginsenoside và saponin cao, giúp tăng cường sức đề kháng, kích thích hệ miễn dịch, giảm stress trong thời dịch.', '<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Hồng s&acirc;m H&agrave;n Quốc với h&agrave;m lượng ginsenoside v&agrave; saponin cao, gi&uacute;p tăng cường sức đề kh&aacute;ng, k&iacute;ch th&iacute;ch hệ miễn dịch, giảm stress trong thời dịch.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Nh&acirc;n s&acirc;m l&agrave; một trong những thảo dược c&oacute; lợi cho sức khỏe, để tận dụng c&ocirc;ng dụng tối ưu của nh&acirc;n s&acirc;m, người H&agrave;n Quốc đ&atilde; ph&aacute;t triển c&ocirc;ng nghệ chế biến v&agrave; bảo quản nh&acirc;n s&acirc;m tươi th&agrave;nh hồng s&acirc;m (red ginseng).</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Hồng s&acirc;m l&agrave; nh&acirc;n s&acirc;m tươi được sấy kh&ocirc; theo quy tr&igrave;nh c&ocirc;ng nghệ hiện đại. Những củ nh&acirc;n s&acirc;m đủ 6 năm tuổi, được tỉa bỏ rễ phụ rồi cho v&agrave;o l&ograve; hấp sấy 3-6 lần đến khi tỷ lệ nước chỉ c&ograve;n dưới 14%.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Theo nghi&ecirc;n cứu về hồng s&acirc;m đăng tải tr&ecirc;n Trung t&acirc;m Th&ocirc;ng tin C&ocirc;ng nghệ sinh học Quốc gia Mỹ (NCBI) v&agrave;o năm 2018, nh&acirc;n s&acirc;m chứa 43 loại ginsenoside bao gồm ginsenoside loại protopanaxadiol, Rb1, Rb2, RC v&agrave; Rd; ginsenoside loại protopanaxatriol, Re, Rf v&agrave; Rg1; ginsenoside loại oleanane, Ro.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Quy tr&igrave;nh sản xuất hồng s&acirc;m tạo ra c&aacute;c chất như ginsenoside, arginine - fructose - glucose (AFG), maltol v&agrave; panaxytriol... Sau khi được sấy kh&ocirc;, h&agrave;m lượng ginsenoside trong hồng s&acirc;m tăng l&ecirc;n so với nh&acirc;n s&acirc;m th&ocirc;.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Hồng s&acirc;m c&oacute; c&ocirc;ng dụng hỗ trợ tăng sức đề kh&aacute;ng nhờ khả năng k&iacute;ch th&iacute;ch hệ thống miễn dịch của hoạt chất Rg1, Rg3. C&aacute;c nghi&ecirc;n cứu được tr&iacute;ch dẫn tr&ecirc;n tạp ch&iacute; Nghi&ecirc;n cứu Nh&acirc;n s&acirc;m, tạp ch&iacute; Khoa học v&agrave; Chăm s&oacute;c sức khỏe Dược phẩm Nhật Bản ph&aacute;t hiện ra, hồng s&acirc;m H&agrave;n Quốc c&oacute; thể gi&uacute;p điều chỉnh huyết &aacute;p, lượng đường trong m&aacute;u v&agrave; mức cholesterol.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Theo t&agrave;i liệu &quot;Thuật ngữ Thực phẩm chức năng v&agrave; An to&agrave;n thực phẩm&quot; do Hiệp hội Thực phẩm chức năng Việt Nam kết hợp với Nh&agrave; Xuất bản Y học xuất bản năm 2012, c&aacute;c saponin trong hồng s&acirc;m c&oacute; lợi &iacute;ch với hệ thống thần kinh trung ương, hệ thống nội tiết, trao đổi chất.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><img alt=\"Tùy thuộc vào số lần hấp sấy, củ hồng sâm sẽ có phần da và ruột màu đỏ, vàng hoặc nâu sẫm. Ảnh: Adobe Stock.\" src=\"https://i1-suckhoe.vnecdn.net/2021/11/19/image001-6024-1637323807.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=NbBVptzZ5HLi2T7kvVewEQ\" style=\"width:100%\" /></span></p>\r\n\r\n<p><span style=\"font-size:14px\">T&ugrave;y thuộc v&agrave;o số lần hấp sấy, củ hồng s&acirc;m sẽ c&oacute; phần da v&agrave; ruột m&agrave;u đỏ, v&agrave;ng hoặc n&acirc;u sẫm. Ảnh:&nbsp;<em>Adobe Stock.</em></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Một nghi&ecirc;n cứu kh&aacute;c đăng tải tr&ecirc;n NCBI cho thấy, nh&acirc;n s&acirc;m cũng g&oacute;p phần điều tiết hormone, giảm nồng độ acid lactic, gi&uacute;p cơ thể tỉnh t&aacute;o, giảm căng thẳng mệt mỏi. Ngo&agrave;i ra, n&oacute; c&ograve;n gi&uacute;p chống oxy h&oacute;a, l&agrave;m đẹp.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Đại diện Welson cho biết, nước uống nh&acirc;n s&acirc;m nguy&ecirc;n củ Welson Ginseng Root Drink được ra mắt v&agrave;o th&aacute;ng 11. Sản phẩm c&oacute; chiết xuất 0,75% hồng s&acirc;m 6 năm tuổi H&agrave;n Quốc v&agrave; chứa 10mg h&agrave;m lượng ginsenoside (Rg1, Rb1, Rg3) được kiểm nghiệm bởi Korea Advanced Food Research Institute.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Ngo&agrave;i ra, n&oacute; c&ograve;n c&oacute; c&aacute;c th&agrave;nh phần kh&aacute;c như nh&acirc;n s&acirc;m tươi nguy&ecirc;n củ, đương quy H&agrave;n Quốc c&ocirc; đặc, c&acirc;u kỷ tử c&ocirc; đặc, vitamin B3, vitamin B6... Hiện, Welson Ginseng Root Drink được sản xuất ở nh&agrave; m&aacute;y đạt chứng nhận an to&agrave;n thực phẩm của H&agrave;n Quốc.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"Nhà máy sản xuất Welson Ginseng Root Drink đạt chuẩn chứng nhận an toàn thực phẩm của Hàn Quốc. Ảnh: Welson.\" src=\"https://i1-suckhoe.vnecdn.net/2021/11/19/image001-2595-1637323807.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=8rjK1ul4EzVmw_SB--Cdbg\" style=\"width:100%\" /></span></span></p>\r\n\r\n<p><span style=\"font-size:14px\">Nh&agrave; m&aacute;y sản xuất Welson Ginseng Root Drink đạt chuẩn chứng nhận an to&agrave;n thực phẩm của H&agrave;n Quốc. Ảnh:&nbsp;<em>Welson.</em></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Đại diện Welson cho biết, nước uống nh&acirc;n s&acirc;m nguy&ecirc;n củ ph&ugrave; hợp với nhiều đối tượng, gồm: người lớn, người cao tuổi, người bệnh đang cần phục hồi sức khỏe. Ngo&agrave;i nước uống, củ nh&acirc;n s&acirc;m trong Welson Ginseng Root Drink c&ograve;n c&oacute; thể d&ugrave;ng trực tiếp hoặc cắt l&aacute;t để pha tr&agrave; hoặc c&aacute;c loại nước uống kh&aacute;c.</span></span></p>\r\n', 'fafbf02caf.jpg', '2021-11-24 11:09:34'),
(3, 'Biện pháp kiểm soát để ăn vặt không bị tăng cân', 'Nhiều chuyên gia cho rằng, ăn vặt sai cách có thể dẫn đến nguy cao mức chứng béo phì, nhưng nếu áp dụng khoa học sẽ giúp bổ sung dinh dưỡng hợp lý cho cơ thể.', '<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Tổ chức Y tế thế giới (WHO) cho rằng, người trưởng th&agrave;nh, trừ những trường hợp c&oacute; thai, nếu chỉ số khối cơ thể BMI từ 25 đến 29,9 được cho l&agrave; thừa c&acirc;n. Nếu chỉ số BMI lớn hơn hoặc bằng 30 th&igrave; được gọi l&agrave; b&eacute;o ph&igrave;. Theo Tổng điều tra dinh dưỡng to&agrave;n quốc 2019-2020 từ Viện Dinh dưỡng quốc gia, tỷ lệ người Việt Nam bị thừa c&acirc;n b&eacute;o ph&igrave; đ&atilde; tăng từ 8.5% (2010) l&ecirc;n 19% (2020).</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Kh&ocirc;ng chỉ l&agrave; t&aacute;c nh&acirc;n dễn đến nhiều bệnh m&atilde;n t&iacute;nh nguy hiểm như tiểu đường v&agrave; tim mạch, b&eacute;o ph&igrave; c&ograve;n l&agrave; một trong những bệnh nền tạo điều kiện cho sự x&acirc;m nhập dễ d&agrave;ng của virus, l&agrave;m suy giảm hệ miễn dịch, tăng nguy cơ v&agrave; mức độ nghi&ecirc;m trọng khi người bệnh nhiễm Covid-19.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Người &iacute;t vận động nhưng lại nạp c&aacute;c đồ ăn vặt chứa nhiều dầu mỡ, đường hoặc muối, thực phẩm chế biến sẵn, đồ ăn nhanh hoặc đồ uống c&oacute; gas... sẽ c&oacute; nguy cơ cao bị thừa c&acirc;n, b&eacute;o ph&igrave; cao hơn.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"Các thức ăn vặt chứ nhiều dầu mỡ, muối, đường có thể là nguyên nhân gây béo phì. Nguồn: Genetica\" src=\"https://i1-suckhoe.vnecdn.net/2021/11/18/Image-ExtractWord-0-Out-8623-1637202966.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=p5bdaJCHsCmJe2EtJkYeMA\" style=\"width:100%\" /></span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Để c&oacute; thể ăn vặt một c&aacute;ch an to&agrave;n, tr&aacute;nh hiện tượng thừa c&acirc;n b&eacute;o ph&igrave;, c&aacute;c chuy&ecirc;n gia cho rằng chế độ ăn uống hợp l&yacute; kết hợp với lối sống khoa học v&agrave; c&aacute;c hoạt động thể dục thể thao l&agrave; c&aacute;ch tối ưu để đốt ch&aacute;y c&aacute;c loại mỡ thừa t&iacute;ch tụ khắp nơi tr&ecirc;n cơ thể.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Muốn duy tr&igrave; một chế độ dinh dưỡng vừa c&acirc;n bằng vừa l&agrave;nh mạnh đối với sức khỏe, bạn n&ecirc;n c&acirc;n nhắc khẩu phần bữa ăn nhẹ của m&igrave;nh, tr&aacute;nh ăn qu&aacute; nhiều c&ugrave;ng một l&uacute;c m&agrave; n&ecirc;n chia ch&uacute;ng th&agrave;nh c&aacute;c phần nhỏ, bảo đảm nguồn năng lượng nạp v&agrave;o của bạn kh&ocirc;ng qu&aacute; cao so với nhu cầu hoạt động.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Cụ thể, bạn n&ecirc;n lựa chọn những m&oacute;n ăn nhẹ &iacute;t chất b&eacute;o b&atilde;o h&ograve;a, &iacute;t đường v&agrave; muối, nhưng lại cung cấp nhiều vitamin, chất xơ v&agrave; kho&aacute;ng chất quan trọng, chẳng hạn như salad rau xanh, sữa chua, mứt hoa quả kh&ocirc;ng đường, c&aacute;c loại thanh hạt dinh dưỡng được l&agrave;m từ &oacute;c ch&oacute;, hạnh nh&acirc;n, hạt điều...</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Thanh hạt dinh dưỡng những năm gần đ&acirc;y đ&atilde; trở th&agrave;nh một m&oacute;n ăn quen thuộc với những người muốn giảm c&acirc;n, ăn ki&ecirc;ng hay ăn theo phương ph&aacute;p eatclean, bởi ch&uacute;ng thường &iacute;t đường, &iacute;t muối, &iacute;t dầu mỡ nhưng lại chứa nhiều c&aacute;c dưỡng chất thiết yếu cho cơ thể.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Một trong những thương hiệu thanh hạt dinh dưỡng đang được nhiều bạn trẻ Việt y&ecirc;u th&iacute;ch l&agrave; Thanh hạt dinh dưỡng Natural &amp; Healthy, với hai hương vị l&agrave; nam việt quất hạt điều (c&oacute; vị ngọt nhẹ từ tr&aacute;i c&acirc;y sấy) v&agrave; rong biển hạt điều (vị mặn).</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"Thanh hạt dinh dưỡng Natural &amp; Healthy.\" src=\"https://i1-suckhoe.vnecdn.net/2021/11/18/Image-154092579-ExtractWord-2-7794-4319-1637202966.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=OuobwbJQe_aEvUgltGY-7w\" style=\"width:100%\" />Với th&agrave;nh phần ch&iacute;nh từ gạo lứt, yến mạch, hạt điều, hạt dưa, hạt b&iacute;, nam việt quất, rong biển v&agrave; chỉ số năng lượng từ 127kcal trong mỗi khẩu phần ăn, đ&acirc;y l&agrave; một trong những loại &quot;snack&quot; l&agrave;nh mạnh kh&ocirc;ng g&acirc;y thừa mỡ, b&eacute;o ph&igrave;. Thanh hạt dinh dưỡng Natural &amp; Healthy cung cấp chất xơ, protein v&agrave; nhiều loại vitamin, kho&aacute;ng chất ph&ugrave; hợp cho mọi đối tượng (trừ những người bị dị ứng c&aacute;c loại hạt), kể cả trẻ em v&agrave; người ăn thuần chay. Sản phẩm được lựa chọn để gửi tặng c&aacute;c y b&aacute;c sĩ tuyến đầu chống dịch Covid-19 nhằm hỗ trợ bổ sung dinh dưỡng cho c&aacute;c chiến sĩ &aacute;o trắng trong những ng&agrave;y l&agrave;m việc căng thẳng.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"Thanh hạt dinh dưỡng Natural &amp; Healthy được gửi tặng đến các y bác sĩ.\" src=\"https://i1-suckhoe.vnecdn.net/2021/11/18/thumbnail-Hinh-4-3-7822-1637202967.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=CYqfGHftxNgqX3uI7ilaqw\" style=\"width:100%\" /></span></span></p>\r\n', '5c073ef504.png', '2021-11-25 13:35:28'),
(4, 'Món ăn làm ấm cơ thể mùa lạnh', 'Trà gừng, khoa lang, bí ngô, tỏi... giúp làm ấm cơ thể, nâng cao sức đề kháng, thích hợp khi trời lạnh.', '<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Theo khoa học, v&agrave;o m&ugrave;a đ&ocirc;ng, nhiệt độ thấp khiến qu&aacute; tr&igrave;nh trao đổi chất trong cơ thể bị chậm lại. Do đ&oacute;, nhiều người ăn đồ cay để giữ ấm, tăng cường trao đổi chất, gi&uacute;p điều h&ograve;a, c&acirc;n bằng cơ thể.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Dưới đ&acirc;y l&agrave; một số m&oacute;n ăn gi&uacute;p l&agrave;m ấm cơ thể:</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Tr&agrave; gừng</strong></span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Lương y B&ugrave;i Đắc S&aacute;ng, Viện H&agrave;n l&acirc;m Khoa học v&agrave; C&ocirc;ng nghệ, cho biết trước C&ocirc;ng nguy&ecirc;n, con người đ&atilde; d&ugrave;ng gừng ăn k&egrave;m thịt chim, c&aacute;, ba ba cho đỡ lạnh, dễ ti&ecirc;u. Trong gừng chứa tinh dầu 2-3%, nhựa dầu 5%, dầu mỡ 3,7%, tinh bột, chất cay (zingeron, zingerol, sogal). Gừng sống (sinh khương) c&oacute; vị cay, t&iacute;nh hơi ấm, t&aacute;c dụng chống lạnh, ti&ecirc;u đờm, chặn n&ocirc;n, gi&uacute;p ti&ecirc;u h&oacute;a. Gừng nướng ch&aacute;y (th&aacute;n khương) trị đau bụng lạnh dạ đi ngo&agrave;i. Gừng kh&ocirc; (can khương) t&aacute;c dụng t&aacute;n h&agrave;n, trị cảm lạnh, thổ tả. Vỏ gừng (khương b&igrave;) t&aacute;c dụng ti&ecirc;u ph&ugrave; thũng (lợi tiểu).</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">C&oacute; thể pha tr&agrave; gừng theo hai c&aacute;ch. Thứ nhất l&agrave; tr&agrave; gừng chanh: Cho g&oacute;i tr&agrave; lọc v&agrave;o một chiếc cốc to, tiếp theo th&ecirc;m gừng v&agrave; v&agrave;i l&aacute;t chanh tươi. Sau đ&oacute; đổ nước s&ocirc;i, ng&acirc;m trong v&ograve;ng 5 ph&uacute;t, cuối c&ugrave;ng th&ecirc;m một th&igrave;a mật ong. Thứ hai l&agrave; tr&agrave; gừng quế: Cho t&uacute;i tr&agrave; lọc, gừng, quế (bẻ đ&ocirc;i) v&agrave; l&aacute;t chanh v&agrave;o một chiếc cốc to, sau đ&oacute; đổ nước s&ocirc;i v&agrave;o cốc. Sau khoảng 5 ph&uacute;t, lọc hết phần b&atilde; để lấy nguy&ecirc;n nước tr&agrave;, cho th&ecirc;m &iacute;t mật ong v&agrave; khuấy đều.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>B&iacute; ng&ocirc;</strong></span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">B&iacute; ng&ocirc; vừa l&agrave; thực phẩm nhiều dinh dưỡng, vừa l&agrave; một c&acirc;y thuốc qu&yacute;. Trong y học cổ truyền, b&iacute; ng&ocirc; vị ngọt, t&iacute;nh hơi &ocirc;n, t&aacute;c dụng bổ trung &iacute;ch kh&iacute;, thanh nhiệt, nhuận phế, sinh t&acirc;n dịch, thường chữa đau đầu ch&oacute;ng mặt, mắt k&eacute;m, vi&ecirc;m gan, thận yếu. Hoa b&iacute;, ngọn b&iacute;, l&aacute; b&iacute; t&aacute;c dụng thanh nhiệt, m&aacute;t phế, kiện tỳ, ti&ecirc;u đ&agrave;m, liễm mồ h&ocirc;i, sử dụng tốt với chứng ho đ&agrave;m, t&aacute;o b&oacute;n, vi&ecirc;m mật, kiết lỵ, kh&oacute; ngủ, tiểu đường, tim mạch, huyết &aacute;p.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Trời lạnh, ăn một canh b&iacute; ng&ocirc; gi&uacute;p l&agrave;m ấm cơ thể. Đặc biệt, 3 dưỡng chất ch&iacute;nh trong b&iacute; ng&ocirc; l&agrave; chất xơ, vitamin A v&agrave; vitamin C. Vitamin C chống lại c&aacute;c gốc tự do trong cơ thể, ngăn ngừa dấu hiệu l&atilde;o h&oacute;a như nếp nhăn, c&aacute;c đốm n&acirc;u, bảo vệ l&agrave;n da chống lại c&aacute;c t&aacute;c hại của &aacute;nh nắng mặt trời v&agrave; ngăn ngừa t&igrave;nh trạng mất nước, kh&ocirc; da, nhất l&agrave; v&agrave;o m&ugrave;a lạnh.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Khoai lang</strong></span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Củ khoai lang tươi chứa 24,6% tinh bột, 1,3% protein, 0,1% chất b&eacute;o, c&aacute;c men ti&ecirc;u h&oacute;a, vitamin B, C v&agrave; tiền sinh tố A (c&oacute; nhiều trong khoai lang nghệ), c&ugrave;ng c&aacute;c kho&aacute;ng chất, gi&uacute;p bổ sung chất dinh dưỡng, chống lạnh. D&acirc;y khoai v&agrave; củ khoai chứa lượng nhỏ c&aacute;c chất như insulin, trị bệnh đ&aacute;i đường. Củ khoai hoặc l&aacute; khoai luộc ăn c&oacute; t&aacute;c dụng nhuận tr&agrave;ng, trị t&aacute;o b&oacute;n.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">C&aacute;ch chế biến dễ v&agrave; ngon nhất l&agrave; nướng ch&iacute;n, b&oacute;c vỏ ăn n&oacute;ng. Theo lương y S&aacute;ng, để bổ dưỡng n&ecirc;n ăn khoai vỏ đỏ ruột v&agrave;ng, c&ograve;n muốn giải cảm, chữa t&aacute;o b&oacute;n phải d&ugrave;ng khoai vỏ trắng ruột trắng. N&ecirc;n ăn k&egrave;m khoai lang với đạm động vật, thực vật để c&acirc;n bằng th&agrave;nh phần dưỡng chất.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"Củ khoai lang nướng chín, bóc vỏ ăn nóng thích hợp mùa đông. Ảnh: Furusato.\" src=\"https://i1-suckhoe.vnecdn.net/2021/11/08/pdfd-4a7a4fb628385c515f23cb2e9-8893-2009-1636337885.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=k1F-5f_rLE7XPY_tohyC6g\" style=\"width:100%\" /></span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Tỏi</strong></span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Tỏi c&oacute; gi&aacute; trị sử dụng v&agrave; gi&aacute; trị sinh học cao, tăng nhiệt cho cơ thể. T&iacute;nh s&aacute;t tr&ugrave;ng của tỏi gi&uacute;p tăng cường hệ thống miễn dịch, ngăn ngừa bệnh cảm lạnh, cảm c&uacute;m v&agrave; ho. Tỏi c&ograve;n chứa một hợp chất gọi l&agrave; allicin hiệu quả trong điều trị cảm lạnh.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Trong tỏi c&oacute; glucosid lưu huỳnh, một chất dầu bay hơi hỗn hợp của sunlfua v&agrave; oxyt allyl gần như nguy&ecirc;n chất, hai hoạt chất kh&aacute;ng khuẩn l&agrave; alixin v&agrave; garlixin. Alixin t&aacute;c dụng ức chế c&aacute;c vi khuẩn gram (+) v&agrave; gram (-) (vi khuẩn đường ruột) v&agrave; chống nấm g&acirc;y bệnh. C&aacute;c chế phẩm từ tỏi gồm tương tỏi, rượu tỏi, cao tỏi, thuốc tỏi để x&ocirc;ng... c&oacute; thể sử dụng trong bối cảnh dịch Covid-19 để tăng sức đề kh&aacute;ng. C&oacute; thể ăn tỏi sống, hoặc l&agrave;m gia vị cho v&agrave;o c&aacute;c m&oacute;n ăn.</span></span></p>\r\n', 'ff023e8403.jpg', '2021-11-26 13:41:10'),
(5, '\'Ăn lành, sống xanh\' cùng chai dầu ăn sử dụng hàng ngày', 'Nhiều người tiêu dùng Việt theo đuổi lối sống khỏe mạnh qua những bữa ăn xanh, thực phẩm sạch, trong đó ưu tiên dầu ăn nguồn gốc tự nhiên.', '<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Những năm gần đ&acirc;y, lối sống xanh được nhiều người Việt lẫn quốc tế ưa chuộng. Nhất l&agrave; khi trạng th&aacute;i &quot;b&igrave;nh thường mới&quot; dần trở lại, nhu cầu &quot;ăn l&agrave;nh, sống xanh&quot; c&agrave;ng được đề cao. Nhiều gia đ&igrave;nh chăm ch&uacute;t sức khỏe bằng nhiều c&aacute;ch, trong đ&oacute; ưu ti&ecirc;n h&agrave;ng đầu l&agrave; chế độ ăn uống l&agrave;nh mạnh.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">B&aacute;o c&aacute;o gần đ&acirc;y của Nielsen cho biết, 44% người được khảo s&aacute;t cho biết sức khỏe l&agrave; yếu tố họ quan t&acirc;m h&agrave;ng đầu. Theo đ&oacute;, xu hướng &quot;ăn l&agrave;nh, sống xanh&quot; bắt đầu từ việc chọn thực phẩm hữu cơ v&agrave; c&aacute;c sản phẩm c&oacute; nguồn gốc thi&ecirc;n nhi&ecirc;n, kh&ocirc;ng chất bảo quản,...</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"Người tiêu dùng ưu tiên chọn những thực phẩm xanh, sạch và thuần tự nhiên.\" src=\"https://i1-giadinh.vnecdn.net/2021/11/05/Hi-nh-1-5430-1636101849.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=QGiD_mF-DAs0nvjq6bjSXw\" style=\"width:100%\" /></span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Lối sống xanh cũng k&eacute;o theo sự gia tăng nhu cầu về sản phẩm ho&agrave;n to&agrave;n từ tự nhi&ecirc;n v&agrave; r&otilde; nguồn gốc, xuất xứ. Cũng theo Nielsen, một bộ phận người ti&ecirc;u d&ugrave;ng Việt dần thay đổi th&oacute;i quen, y&ecirc;u cầu cao hơn về chất lượng, độ tươi sạch của thực phẩm. Họ chủ động mua sắm những nguy&ecirc;n liệu an to&agrave;n cho sức khỏe hay dự trữ nhu yếu phẩm.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Để x&acirc;y dựng những bữa ăn xanh, sạch, l&agrave;nh, người ti&ecirc;u d&ugrave;ng cần tu&acirc;n theo ba yếu tố: duy tr&igrave; chế độ ăn nhiều rau quả mỗi ng&agrave;y; đảm bảo nguy&ecirc;n tắc cầu vồng (kết hợp loạt tr&aacute;i c&acirc;y, rau củ với nhiều m&agrave;u sắc kh&aacute;c nhau); tăng cường protein v&agrave; chất b&eacute;o l&agrave;nh mạnh v&agrave;o thực đơn.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"Thực đơn nhiều rau xanh, tăng cường protein và chất béo lành mạnh, tốt cho sức khỏe.\" src=\"https://i1-giadinh.vnecdn.net/2021/11/05/Hi-nh-2-7702-1636101849.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=uyRFXv8JEcZoUaHMslMlZw\" style=\"width:100%\" /></span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Hiểu r&otilde; nhu cầu chăm lo sức khỏe của người ti&ecirc;u d&ugrave;ng, c&ocirc;ng ty Tường An ra mắt nhiều sản phẩm chất lượng, mang đến bữa ăn ngon cho mọi gia đ&igrave;nh. Trong đ&oacute;, d&ograve;ng sản phẩm thế hệ mới - Tường An Marvela - theo đuổi lối sống xanh v&agrave; c&acirc;n bằng dinh dưỡng với ti&ecirc;u ch&iacute; ba kh&ocirc;ng: kh&ocirc;ng chất bảo quản, kh&ocirc;ng cholesterol v&agrave; kh&ocirc;ng chất b&eacute;o trans (theo khuyến nghị của FDA).</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Doanh nghiệp giới thiệu người ti&ecirc;u d&ugrave;ng hai lựa chọn gồm: dầu ăn dinh dưỡng Tường An Marvela c&oacute; nguồn gốc thực vật, 100% nguy&ecirc;n liệu dầu tự nhi&ecirc;n, được tăng cường vi chất dinh dưỡng, bổ sung Vitamin A, E tự nhi&ecirc;n (tốt cho mắt v&agrave; da). Sản phẩm th&iacute;ch hợp với c&aacute;c m&oacute;n chi&ecirc;n r&aacute;n, nướng hay c&aacute;c m&oacute;n cần gia nhiệt cao.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Dầu đậu n&agrave;nh Tường An Marvela từ 100% hạt đậu n&agrave;nh tự nhi&ecirc;n, gi&agrave;u omega 3-6-9 tốt cho tim mạch, th&iacute;ch hợp cho c&aacute;c m&oacute;n chi&ecirc;n, x&agrave;o, &aacute;p chảo, trộn salad v&agrave; l&agrave;m nước sốt.</span></span></p>\r\n', 'b112e051e1.jpg', '2021-11-26 13:43:35'),
(6, 'Bí quyết duy trì bữa ăn lành mạnh, dinh dưỡng', 'Một chế độ ăn lành mạnh là tiền đề để cơ thể khỏe mạnh, tăng sức đề kháng cao, phòng tránh bệnh tật, đặc biệt là Covid-19.', '<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Thời điểm giao m&ugrave;a hiện tại l&agrave; điều kiện ph&aacute;t triển của c&aacute;c bệnh truyền nhiễm. B&ecirc;n cạnh đ&oacute;, với t&igrave;nh trạng Covid-19 l&acirc;y lan nhanh như hiện nay, việc n&acirc;ng cao sức đề kh&aacute;ng để cơ thể c&oacute; thể tự chống chọi với bệnh tật rất cần thiết.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Những người khỏe mạnh, c&oacute; sức đề kh&aacute;ng tốt sẽ &iacute;t bị l&acirc;y nhiễm bệnh hơn. B&ecirc;n cạnh đ&oacute;, nếu c&oacute; nhiễm virus th&igrave; biểu hiện bệnh thường nhẹ hơn, nhanh hồi phục hơn những người c&oacute; sức khỏe yếu, đề kh&aacute;ng k&eacute;m. Một chế độ ăn đa dạng thực phẩm, cung cấp dinh dưỡng ph&ugrave; hợp cho từng đối tượng sẽ l&agrave; ch&igrave;a kh&oacute;a gi&uacute;p gia đ&igrave;nh khỏe mạnh, tăng cường miễn dịch.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Thế n&agrave;o l&agrave; một bữa ăn l&agrave;nh mạnh?</strong></span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Bữa ăn l&agrave;nh mạnh l&agrave; bữa ăn chế biến từ c&aacute;c loại thực phẩm l&agrave;nh mạnh, cung cấp đầy đủ năng lượng. C&aacute;c chất dinh dưỡng đa lượng, vi chất dinh dưỡng đ&aacute;p ứng nhu cầu cơ thể ở mức hợp l&yacute;, đảm bảo vệ sinh an to&agrave;n thực phẩm.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Bữa ăn đa dạng c&aacute;c loại thực phẩm, giảm ăn muối, đường v&agrave; chất b&eacute;o no l&agrave; yếu tố cần thiết. Chế độ ăn l&agrave;nh mạnh gi&uacute;p ph&ograve;ng chống bệnh mạn t&iacute;nh kh&ocirc;ng l&acirc;y như tiểu đường, tim mạch, huyết &aacute;p... Nh&oacute;m c&oacute; bệnh l&yacute; nền m&atilde;n t&iacute;nh n&agrave;y l&agrave; những đối tượng thường c&oacute; diễn tiến nặng, nguy kịch khi mắc Covid-19.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Để cơ thể c&oacute; sức đề kh&aacute;ng tốt với c&aacute;c loại vius, bạn n&ecirc;n ch&uacute; &yacute; tăng cường những loại thực phẩm c&oacute; chứa c&aacute;c chất dinh dưỡng quan trọng gi&uacute;p cải thiện, n&acirc;ng cao hệ miễn dịch: Protein, omega-3, vitamin A, C, E, D, sắt, kẽm.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>C&aacute;ch chuẩn bị bữa ăn l&agrave;nh mạnh cho cả gia đ&igrave;nh</strong></span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Để c&oacute; một bữa ăn l&agrave;nh mạnh cho cả gia đ&igrave;nh, ch&uacute;ng ta cần nắm những nguy&ecirc;n tắc cơ bản sau:</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><em>L&ecirc;n thực đơn l&agrave;nh mạnh:</em>&nbsp;Một thực đơn l&agrave;nh mạnh cho cả gia đ&igrave;nh cần đảm bảo cung cấp đủ 4 nh&oacute;m thực phẩm gồm nh&oacute;m bột đường, nh&oacute;m chất đạm, nh&oacute;m chất b&eacute;o, nh&oacute;m vitamin, chất kho&aacute;ng. Năm 2018, Tổ chức Y tế thế giới khuyến nghị một chế độ ăn l&agrave;nh mạnh cần c&oacute; nhiều quả ch&iacute;n, rau xanh, ngũ cốc nguy&ecirc;n hạt, c&aacute;c loại đậu đỗ, chất xơ, thức ăn nguồn động vật (thịt, c&aacute;, trứng, v&agrave; sữa). Mỗi người hạn chế ăn muối, đường tự do, chất b&eacute;o b&atilde;o h&ograve;a, c&aacute;c thực phẩm chế biến sẵn, nước ngọt c&oacute; đường.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><em>Lựa chọn thực phẩm l&agrave;nh mạnh</em>: Thực phẩm l&agrave;nh mạnh l&agrave; những thực phẩm c&oacute; &iacute;t chất b&eacute;o b&atilde;o h&ograve;a, chất b&eacute;o chuyển h&oacute;a, đường, muối, đảm bảo vệ sinh an to&agrave;n thực phẩm. Thực phẩm n&ecirc;n chọn loại tươi mới, lựa chọn theo m&ugrave;a, hạn chế những loại rau củ quả tr&aacute;i m&ugrave;a.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"Chế độ dinh dưỡng đúng giúp cơ thể khỏe mạnh.\" src=\"https://i1-suckhoe.vnecdn.net/2021/11/04/Image-ExtractWord-1-Out-8646-1636019913.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=C6ys9TWLia4Iks1FRY7htw\" style=\"width:100%\" /></span></span></p>\r\n', 'd6be4189af.png', '2021-11-27 13:47:45'),
(7, 'Chuyên gia tiết lộ những điều chưa biết về bơ thực vật', 'Chuyên gia dinh dưỡng, bác sĩ CKII Đỗ Thị Ngọc Diệp chia sẻ nhiều thông tin hữu ích về bơ thực vật (margarine) và cách dùng.', '<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Bơ thực vật ng&agrave;y c&agrave;ng giữ vai tr&ograve; quan trọng trong bữa ăn gia đ&igrave;nh Việt nhưng nhiều người chưa nắm r&otilde; nguồn gốc v&agrave; c&aacute;ch sử dụng đ&uacute;ng chuẩn. Theo Chuy&ecirc;n gia CKII Ngọc Diệp - Ph&oacute; Chủ tịch Hội Dinh dưỡng Việt Nam, vị bơ thực vật vừa b&eacute;o, vừa thơm, được nhiều thế hệ y&ecirc;u th&iacute;ch v&igrave; gi&uacute;p tăng độ hấp dẫn cho c&aacute;c m&oacute;n ăn quen thuộc như: bắp x&agrave;o bơ, b&aacute;nh m&igrave; bơ đường, bắp rang bơ, b&iacute;t-tết bơ tỏi...</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">&quot;Tuy nhi&ecirc;n, kh&ocirc;ng &iacute;t người ti&ecirc;u d&ugrave;ng c&ograve;n quan ngại, thắc mắc về nguồn gốc xuất xứ, h&agrave;m lượng - tần suất, c&aacute;ch sử dụng v&agrave; quy tr&igrave;nh sản xuất của bơ thực vật&quot;, b&aacute;c sĩ n&oacute;i.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"Bơ thực vật có vị béo thơm, giúp bữa ăn của gia đình Việt đậm đà hơn.\" src=\"https://i1-suckhoe.vnecdn.net/2021/10/09/1-4074-1633784312.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=DZf7FI57P5kOmuEYJNAHGw\" style=\"width:100%\" /></span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Bơ thực vật (margarine) c&oacute; nguồn gốc từ một số dầu thực vật v&agrave; được sản xuất qua qu&aacute; tr&igrave;nh hydro h&oacute;a để chuyển từ dạng lỏng th&agrave;nh dạng cứng hoặc dẻo v&agrave; c&oacute; thể đ&oacute;ng th&agrave;nh b&aacute;nh. Hiểu đơn giản l&agrave; thực phẩm n&agrave;y kh&ocirc;ng l&agrave;m từ sữa m&agrave; c&oacute; th&agrave;nh phần l&agrave; dầu thực vật, chứa nhiều ax&iacute;t b&eacute;o chưa b&atilde;o h&ograve;a v&agrave; kh&ocirc;ng chứa cholesterol.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Theo Hiệp hội Tim mạch Mỹ (American Heart Association/AHA) chất b&eacute;o kh&ocirc;ng b&atilde;o h&ograve;a nhiều nối đ&ocirc;i c&oacute; thể l&agrave;m giảm nồng độ cholesterol xấu trong m&aacute;u, giảm nguy cơ bệnh tim mạch v&agrave; đột quỵ. Sự ph&aacute;t triển của c&ocirc;ng nghệ hiện đại gi&uacute;p c&aacute;c nh&agrave; sản xuất loại bỏ chất b&eacute;o chuyển h&oacute;a trans fat trong bơ thực vật về 0% theo ti&ecirc;u chuẩn FDA. Thực phẩm n&agrave;y c&ograve;n chứa vitamin A v&agrave; E tự nhi&ecirc;n, gi&uacute;p chống oxy h&oacute;a, tăng cường khả năng đề kh&aacute;ng cho cơ thể.</span></span></p>\r\n', '990da224b5.jpg', '2021-11-27 13:49:07'),
(8, 'Trà lên men Star Kombucha đạt chứng nhận chất lượng từ FDA Mỹ', 'Sau khi chinh phục thị trường Việt, sản phẩm trà lên men Star Kombucha của Công ty CP Goody Group đã đạt chứng nhận của FDA - Cục Quản lý thực phẩm và Dược phẩm Mỹ.', '<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">L&agrave; thương hiệu Kombucha đầu ti&ecirc;n tại Việt Nam được sản xuất theo ti&ecirc;u chuẩn v&agrave; c&ocirc;ng thức Mỹ, Star Kombucha đ&atilde; nhận được chứng nhận của FDA - tấm &quot;hộ chiếu thương mại&quot; để tiến v&agrave;o thị trường Mỹ tiềm năng nhưng cũng rất kh&oacute; t&iacute;nh.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">FDA Mỹ chịu tr&aacute;ch nhiệm bảo vệ quyền v&agrave; lợi &iacute;ch về mặt sức khỏe cho người ti&ecirc;u d&ugrave;ng Mỹ, th&ocirc;ng qua c&aacute;c quy định v&agrave; gi&aacute;m s&aacute;t an to&agrave;n thực phẩm. C&aacute;c sản phẩm nhập khẩu v&agrave;o Mỹ phải đ&aacute;p ứng được ti&ecirc;u chuẩn về nguồn nguy&ecirc;n liệu, c&ocirc;ng thức, quy tr&igrave;nh sản xuất, đ&oacute;ng g&oacute;i, ph&acirc;n phối... của FDA. FDA sẽ x&aacute;c định xem c&aacute;c sản phẩm c&oacute; đảm bảo chất lượng, hiệu quả v&agrave; an to&agrave;n cho người ti&ecirc;u d&ugrave;ng hay kh&ocirc;ng.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"Star Kombucha là thương hiệu Kombucha tiên phong tại Việt Nam đạt được chứng nhận FDA. Ảnh: Goody Group\" src=\"https://i1-suckhoe.vnecdn.net/2021/11/11/1-5774-1636593029.png?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=XNUyqmTleMi72F5xYtMiVQ\" style=\"width:100%\" /></span></span></p>\r\n', 'be613836cf.jpg', '2021-11-27 13:51:26'),
(9, 'Các món ăn dân tộc nổi tiếng ở Hà Giang', 'Ngoài mèn mén, bánh chưng gù, thắng cố... vùng đất nơi địa đầu tổ quốc còn gây ấn tượng với đặc sản thịt gác bếp, hoa chuối hấp, măng nứa...', '<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"\" src=\"https://i1-dulich.vnecdn.net/2021/11/16/1-9060-1635524149-4682-1637038193.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=1U0iRl9UH9X2hctbE_wcRQ\" style=\"width:100%\" /></span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Một trong những c&aacute;i t&ecirc;n lu&ocirc;n được nhắc đến đầu ti&ecirc;n của v&ugrave;ng đất n&agrave;y l&agrave;&nbsp;<a href=\"https://vnexpress.net/men-men-mon-an-doc-dao-cua-nguoi-mong-3096479.html\" rel=\"dofollow\"><strong>m&egrave;n m&eacute;n</strong></a>, được l&agrave;m từ những hạt ng&ocirc; tẻ địa phương v&agrave; l&agrave; thực phẩm h&agrave;ng ng&agrave;y của người M&ocirc;ng. Cứ sau mỗi m&ugrave;a thu hoạch, ng&ocirc; lại được người d&acirc;n bản địa phơi tr&ecirc;n những hi&ecirc;n nh&agrave; hay g&aacute;c bếp, chờ khi thật kh&ocirc; mới đem đi l&agrave;m m&egrave;n m&eacute;n. V&agrave; c&ugrave;ng với ch&aacute;o ấu tẩu, m&egrave;n m&egrave;n l&agrave; hai m&oacute;n ăn của H&agrave; Giang được Hội đồng x&aacute;c lập kỷ lục Việt Nam (2020-2021), nhắc đến trong 100 đặc sản Việt Nam. Lu&ocirc;n lu&ocirc;n đi k&egrave;m với m&egrave;n m&eacute;n l&agrave;&nbsp;<strong>tẩu ch&uacute;a&nbsp;</strong>(tẩu ch&oacute;a - tẩu chua). Đ&oacute; l&agrave; m&oacute;n canh đậu phụ trắng nấu c&ugrave;ng rau cải m&egrave;o ngọt v&agrave; tươi. Người d&acirc;n thường chan m&oacute;n canh n&agrave;y v&agrave;o m&egrave;n m&eacute;n để ăn.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"\" src=\"https://i1-dulich.vnecdn.net/2021/11/16/lap-4877-1635741127-2091-1637038193.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=I2kL_1ipfqiifON6XN1atw\" style=\"width:100%\" /></span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">Kh&aacute;c với lạp xưởng ngọt miền T&acirc;y,&nbsp;<strong>lạp xưởng g&aacute;c bếp</strong>&nbsp;c&oacute; vị mặn v&agrave; thường được x&agrave;o c&ugrave;ng ớt, gừng v&agrave; c&aacute;c loại gia vị địa phương. Người d&acirc;n thường ăn k&egrave;m cơm n&oacute;ng v&agrave; đ&acirc;y cũng l&agrave; m&oacute;n ăn. M&oacute;n ăn n&agrave;y được l&agrave;m từ thịt lợn, nhưng l&agrave; loại lợn m&aacute;n cắp n&aacute;ch nhỏ, thịt săn chắc, ăn rất thơm ngon. Loại thịt d&ugrave;ng để l&agrave;m lạp xưởng l&agrave; loại nửa nạc nửa mỡ, bỏ b&igrave; rồi băm rối ướp c&ugrave;ng gia vị, rượu trắng, nước gừng... Người d&acirc;n thường mang những miếng lạp xưởng để l&ecirc;n g&aacute;c bếp cho kh&ocirc;, v&agrave; m&oacute;n ăn đượm m&ugrave;i kh&oacute;i bếp, thoang thoảng vị rượu v&agrave; gia vị thơm nồng. Gi&aacute; mỗi c&acirc;n lạp xưởng khoảng 400.000 đồng</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"\" src=\"https://i1-dulich.vnecdn.net/2021/11/16/gacbep-4748-1635741127-6384-1637038194.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=GXU0njrybgjlrkjUAXkEtg\" style=\"width:100%\" /></span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\">C&ugrave;ng với lạp xưởng,&nbsp;<strong>thịt tr&acirc;u b&ograve; g&aacute;c bếp</strong>&nbsp;l&agrave; những m&oacute;n ăn thường được du kh&aacute;ch khắp nơi mua về l&agrave;m qu&agrave; khi gh&eacute; thăm H&agrave; Giang. M&oacute;n ăn c&oacute; thể chi&ecirc;n, x&agrave;o để ăn k&egrave;m cơm hoặc l&agrave;m đồ ăn vặt. Gi&aacute; của mỗi kg thịt tr&acirc;u, b&ograve; l&agrave; từ 600.000 đồng.</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><img alt=\"\" src=\"https://i1-dulich.vnecdn.net/2021/11/16/246780182-909980139635795-5007-8829-3463-1637038194.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=kK1MR6ks66r_sssSutU9qQ\" style=\"width:100%\" /></span></span></p>\r\n\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>Thịt ba chỉ g&aacute;c bếp</strong>&nbsp;được tẩm ướp với muối, thảo quả, gừng, mắc kh&eacute;n... v&agrave; rượu trắng. Những miếng thịt được mang đi muối to khoảng 2-3 đốt ng&oacute;n tay, d&agrave;i 20-30 cm, để qua đ&ecirc;m cho ngấm gia vị rồi xi&ecirc;n v&agrave;o que v&agrave; treo l&ecirc;n g&aacute;c bếp. Mỗi khi người d&acirc;n nấu ăn, bếp đỏ lửa v&agrave; sức n&oacute;ng của lửa, của c&aacute;c loại gia vị, thịt ch&iacute;n dần. Miếng thịt lợn chuyển dần sang m&agrave;u đỏ, c&ograve;n mỡ c&oacute; m&agrave;u trong. Đ&acirc;y cũng l&agrave; một trong những m&oacute;n ăn rất đưa cơm, được nhiều thực kh&aacute;ch y&ecirc;u th&iacute;ch v&agrave; lựa chọn.</span></span></p>\r\n', 'be2d9bfdbb.jpg', '2021-11-27 14:01:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_book`
--

CREATE TABLE `tbl_book` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `quantity` int(11) NOT NULL,
  `request` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_book`
--

INSERT INTO `tbl_book` (`id`, `name`, `email`, `phone`, `date`, `time`, `quantity`, `request`, `status`) VALUES
(2, 'Lý Tú', 'lytu@gmail.com', '0389897221', '2021-11-02', '17:57:00', 2, '', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `foodId` int(11) NOT NULL,
  `sId` varchar(255) NOT NULL,
  `foodName` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartId`, `foodId`, `sId`, `foodName`, `price`, `quantity`, `image`) VALUES
(6, 20, '354e70324e0nfh2te51m9s7d9v', 'Cơm cuộn', '50000', 1, '8d3659fb14.jpg'),
(7, 20, '7mcn697rhb7cchrdendpgjrv83', 'Cơm cuộn', '50000', 1, '8d3659fb14.jpg'),
(9, 20, 'v7ufvsn8fdplmpqatphgb44ejh', 'Cơm cuộn', '50000', 1, '8d3659fb14.jpg'),
(11, 15, '04sua9lvm27ackmdk6m4f8mpd1', 'a', '45000', 1, 'ddb5bcc53c.jpg'),
(13, 20, '85qj76lfpjre7nd5njnf3rm7f5', 'Cơm cuộn', '50000', 1, '8d3659fb14.jpg'),
(14, 17, '85qj76lfpjre7nd5njnf3rm7f5', 'Bánh', '45000', 1, 'fb2270c712.jpeg'),
(17, 20, 'abrppii7reuh7atdhg31nd814r', 'Cơm cuộn', '50000', 1, '8d3659fb14.jpg'),
(18, 12, 'abrppii7reuh7atdhg31nd814r', 'Bánh', '100000', 2, '4a114d85c6.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cateId` int(11) NOT NULL,
  `cateName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`cateId`, `cateName`) VALUES
(1, 'Tráng miệng'),
(5, 'Đồ uống'),
(6, 'Món chính'),
(7, 'Khai vị'),
(10, 'Món phụ'),
(24, 'Rượu'),
(25, 'Đồ ăn nhanh'),
(26, 'Mì Ý (Pasta)');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `cmtId` int(11) NOT NULL,
  `cmtName` varchar(255) NOT NULL,
  `cmtContent` varchar(510) NOT NULL,
  `foodId` int(11) NOT NULL,
  `quantitylike` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_comment`
--

INSERT INTO `tbl_comment` (`cmtId`, `cmtName`, `cmtContent`, `foodId`, `quantitylike`, `datetime`, `status`) VALUES
(3, 'Bảo', 'Được phết', 20, 0, '2021-10-31 10:25:51', 0),
(4, 'Bảo', 'Được phết', 20, 0, '2021-10-31 10:29:10', 1),
(5, 'Bảo', 'Ngon lắm', 20, 5, '2021-10-31 14:36:21', 1),
(6, 'Túc Anh Đài', 'Cũng bình thường', 20, 0, '2021-10-31 15:45:37', 1),
(7, 'Túc Anh Đài', 'Món này chấm với muối ớt thì đúng bài', 20, 6, '2021-10-31 15:45:59', 1),
(8, 'Túc Anh Đài', 'Được đấy', 20, 1, '2021-10-31 15:46:44', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_config`
--

CREATE TABLE `tbl_config` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL,
  `map` longtext NOT NULL,
  `discount` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_config`
--

INSERT INTO `tbl_config` (`id`, `logo`, `name`, `phone`, `email`, `address`, `map`, `discount`) VALUES
(1, 'logo.png', 'Lương Sơn Quán/Nơi tinh hoa ẩm thực hội tụ/Sự quan tâm, động viên, góp ý của Quý vị luôn là nguồn động viên, cổ vũ lớn lao, giúp chúng tôi nỗ lực phấn đấu hơn nữa trong quá trình hoàn thiện và phát triển Nhà hàng.', '(84) 968686868', 'contact@gmail.com', '54, Triều Khúc, Thanh Xuân, Hà Nội', 'https://maps.google.com/maps?q=54%20tri%E1%BB%81u%20kh%C3%BAc%20thanh%20xu%C3%A2n%20nam&t=&z=13&ie=UTF8&iwloc=&output=embed', 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(510) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `name`, `email`, `title`, `content`, `datetime`, `status`) VALUES
(1, 'Sa la hê', 'sala@gmail.com', 'Món ăn', 'Món ở quán rất ngon, trình bày đẹp mắt. Tiếp tục phát huy nhé.', '2021-11-01 14:20:26', 1),
(2, 'Sa la hê', 'sala@gmail.com', 'Món ăn', 'Món ở quán rất ngon, trình bày đẹp mắt. Tiếp tục phát huy nhé.', '2021-11-01 14:20:26', 1),
(4, 'Sa la hê', 'sala@gmail.com', 'Món ăn', 'Món ở quán rất ngon, trình bày đẹp mắt. Tiếp tục phát huy nhé.', '2021-11-01 14:20:26', 0),
(5, 'Sa la hê', 'sala@gmail.com', 'Món ăn', 'Món ở quán rất ngon, trình bày đẹp mắt. Tiếp tục phát huy nhé.', '2021-11-01 14:20:26', 1),
(6, 'Túc Anh Đài', 'abc@gmail.com', 'Món ăn', 'dư', '2021-11-01 14:20:26', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zipcode` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `zipcode`, `phone`, `email`, `password`) VALUES
(15, 'Bảo', '2', '2', '', '0983727382', 'a2@a.com', 'c4ca4238a0b923820dcc509a6f75849b'),
(20, 'Túc Anh Đài', '54, Triều Khúc, Thanh Xuân', 'Hà Nội', '', '083982222', 'abc@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_food`
--

CREATE TABLE `tbl_food` (
  `foodId` int(11) NOT NULL,
  `foodName` varchar(150) NOT NULL,
  `foodIdCategory` int(11) NOT NULL,
  `description` text NOT NULL,
  `type` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_food`
--

INSERT INTO `tbl_food` (`foodId`, `foodName`, `foodIdCategory`, `description`, `type`, `price`, `image`) VALUES
(11, 'Gà', 10, 'Gà', 1, '100000', '94c896bf93.jpeg'),
(12, 'Bánh', 10, 'Bánh', 0, '100000', '4a114d85c6.jpg'),
(13, 'Mì Ý', 10, 'Đồ ăn', 1, '45000', 'a243e35c96.jpeg'),
(14, 'Súp cà rốt', 10, 'Đồ ăn', 0, '100000', '3a3e589ce2.jpg'),
(15, 'Phô mai', 10, 'Tokbokki (Tteokbokki) là món bánh gạo truyền thống của Hàn Quốc, ngoài ra còn là một món ăn nhanh bình dân thường bán ở các quầy hàng ven đường (pojangmacha). Nó có nguồn gốc từ món tteok jjim (một món ăn cung đình làm từ bánh dày thái mỏng, thịt, trứng và gia vị rồi nướng lên)', 1, '45000', 'ddb5bcc53c.jpg'),
(16, 'Gà', 10, 'Bánh ', 0, '100000', '5f8b9856bc.jpeg'),
(17, 'Bánh', 10, 'Đồ ngọt', 1, '45000', 'fb2270c712.jpeg'),
(20, 'Cơm cuộn', 26, 'Cơm ', 0, '50000', '8d3659fb14.jpg'),
(21, 'Thịt', 6, 'Làm từ thịt nguyên chất 100%', 1, '125000', '57859ffdb1.jpeg'),
(22, 'Bánh canh', 6, 'Được làm từ bột gạo, bột mì, hoặc bột sắn hoặc bột gạo pha bột sắn cán thành tấm và cắt ra thành sợi to và ngắn với nước dùng được nấu từ tôm, cá, giò heo... thêm gia vị tùy theo từng loạ', 1, '30000', '163b3a207f.jpg'),
(23, 'Bánh đa cua', 6, 'Bánh đa với nước dùng riêu cua', 0, '40000', '66242e61d7.jpg'),
(24, 'Bún bò Huế', 6, 'Bún nấu với sườn lợn và dọc mùng', 0, '65000', '8d4a001625.jpg'),
(25, 'Bún cá', 26, 'Bún và chả cá nướng trộn nước mắm, rau sống', 1, '35000', '652984bb65.jpg'),
(26, 'Bún thịt nướng', 10, 'Bún ăn với thịt nướng cùng nước mắm và rau sống kiểu Huế', 0, '60000', '39a074c84e.jpg'),
(27, 'Cơm bụi', 6, 'Cơm bình dân với nhiều món ăn đa dạng, phong phú. Thông thường thực đơn sẽ bao gồm một dĩa cơm và một phần thức ăn theo lựa chọn, một bát canh', 0, '25000', 'c38e3d6c86.jpg'),
(28, 'Lòng non', 7, 'Lòng lợn non luộc chín hoặc xào', 1, '45000', 'fc848c0864.jpg'),
(29, 'Thịt kho tàu', 25, 'Thịt lợn (có mỡ) kho với trứng và nước dừa', 0, '36000', '657272b212.jpg'),
(30, 'Xôi chiên', 10, 'Xôi trắng ấn dẹt thành từng bánh rồi chiên ngập dầu, hoặc có thể chiên phồng thành dạng tròn xoay như hình cầu.', 0, '15000', '79ca16eb12.jpg'),
(31, 'Xôi ngũ sắc', 1, 'Xôi được nấu kết hợp với các loại nước sắc của lá cơm xanh, cơm đỏ, cơm vàng để tạo màu. Thịnh hành với các dân tộc thiểu số (Mường, Tày, Thái). 5 màu xôi tượng trưng cho ngũ hành', 1, '62000', 'b6b864876a.jpg'),
(32, 'Cháo lòng', 26, 'Cháo kết hợp với nước dùng ngọt làm từ xương lợn hay nước luộc lòng lợn, và nguyên liệu chính cho bát cháo không thể thiếu các món phủ tạng lợn luộc', 0, '30000', 'bf995193a0.jpg'),
(33, 'Súp cua', 25, 'Món súp với thịt cua, trứng gà hoặc trứng cút ngoài ra còn có xương gà để làm súp thêm vị ngọt và bỗ dưỡng hoặc hạt bắp', 0, '70000', 'cf6596bb9c.jpeg'),
(34, 'Bánh cuốn', 24, 'Bột gạo hấp tráng mỏng, để ăn khi còn ướt, bên trong cuốn nhân. Bánh thường ăn với một loại nước chấm pha nhạt từ nước mắm', 0, '45000', '05fbc7823f.jpg'),
(35, 'Gỏi cá', 10, 'Thịt cá sống cuốn trong bánh đa nem cùng rau thơm ăn với nước chấm', 0, '32000', 'cb2a938666.jpg'),
(36, 'Nem chua', 7, 'Sử dụng thịt lợn, lợi dụng men của lá và thính gạo để ủ chín, có vị chua ngậy. Đặc sản nổi tiếng ở Việt Nam', 0, '20000', '1ac98c30d2.jpg'),
(37, 'Giả cầy', 6, 'Chân giò lợn đem thui lửa cho vàng rồi đem ninh với giềng, mẻ, mắm tôm, tạo ra hương vị gần giống như thịt chó', 0, '55000', '6f2825b3db.jpg'),
(38, 'Mực khô', 1, 'Mực được sấy khô hoặc phơi nắng rồi đem nướng hoặc rim chua ngọt để dùng kèm với bia', 0, '120000', '7f7281240e.jpg'),
(39, 'Chả cá Lã Vọng', 6, 'Món cá tẩm ướp, nướng trên than rồi rán lại trong chảo mỡ, do gia đình họ Đoàn ở phố Chả Cá trong khu phố cổ Hà Nội giữ bí quyết kinh doanh và đặt tên', 0, '80000', '4756561a80.jpg'),
(40, 'Chè đậu xanh', 5, 'Chè đậu (đỗ) xanh nấu với đường và bột năng (hoặc bột sắn dây), có thể cho thêm dừa nạo và nước cốt dừa.', 0, '15000', 'b18c94e5a0.jpg'),
(41, 'Chè bánh lọt', 5, 'Món tráng miệng làm từ nước cốt dừa, thạch làm từ bột gạo màu xanh lá cây (thường do lá dứa thôi ra), đá bào và đường thốt nốt', 0, '15000', '1c02186893.jpg'),
(42, 'Bia hơi', 24, 'Bia tươi', 0, '10000', '7c36848d7f.jpg'),
(43, 'Phở', 25, 'Là một trong những món ăn đặc trưng nhất cho ẩm thực Việt Nam. Thành phần chính của phở là bánh phở và nước dùng (hay nước lèo theo cách gọi miền Nam) cùng với thịt bò hoặc gà cắt lát mỏng. Ngoài ra còn kèm theo các gia vị như: tương, tiêu, chanh, nước mắm, ớt,...', 0, '30000', 'f5e9d51bfc.jpg'),
(44, 'Mì xào giòn', 6, 'Mì trứng chiên giòn, phủ hải sản, rau và nước sốt', 0, '30000', 'ae5b7b74b9.jpg'),
(45, 'Cơm rượu', 10, 'Món ăn có cồn không qua chưng cất, được chế biến từ gạo nếp đồ chín thành xôi, để nguội và ủ với men rượu cho lên men', 0, '12000', '35b9f863e8.png'),
(46, 'Sữa trân châu', 10, 'Được làm từ sữa tươi nguyên chất', 0, '30000', '7d27c824c9.jpg'),
(47, 'Hoa quả', 10, 'Hoa quả', 0, '22000', '22c39caa7d.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_material`
--

CREATE TABLE `tbl_material` (
  `matId` int(11) NOT NULL,
  `matName` varchar(150) NOT NULL,
  `matIdSupplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_material`
--

INSERT INTO `tbl_material` (`matId`, `matName`, `matIdSupplier`) VALUES
(2, 'Cà rốt', 1),
(3, 'Trứng', 2),
(4, 'Thịt', 1),
(6, 'Sữa', 1),
(7, 'Cà chua', 2),
(10, 'Bột mì', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `foodId` int(11) NOT NULL,
  `foodName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `paymethod` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`orderId`, `customerId`, `foodId`, `foodName`, `quantity`, `price`, `image`, `paymethod`, `address`, `datetime`, `status`) VALUES
(2, 15, 20, 'Cơm cuộn', 1, '50000', '8d3659fb14.jpg', 'Thanh toán điện tử', 'Bảo, 0983727382, Thanh Xuân, Hà Nội', '2021-10-31 03:57:29', 2),
(3, 15, 17, 'Bánh', 1, '45000', 'fb2270c712.jpeg', 'Thanh toán tiền mặt', 'Bảo, 0983727382, 2, 2', '2021-10-31 03:57:28', 2),
(5, 15, 17, 'Bánh', 1, '45000', 'fb2270c712.jpeg', 'Thanh toán tiền mặt', 'Bảo, 0983727382, 2, 2', '2021-10-31 03:57:27', 2),
(6, 15, 17, 'Bánh', 1, '45000', 'fb2270c712.jpeg', 'Thanh toán tiền mặt', 'Bảo, 0983727382, 2, 2', '2021-10-31 03:57:26', 2),
(11, 15, 20, 'Cơm cuộn', 2, '100000', '8d3659fb14.jpg', 'Thanh toán điện tử', 'Bảo, 0983727382, 2, 2', '2021-10-31 14:49:06', 1),
(12, 15, 28, 'Lòng non', 1, '45000', 'fc848c0864.jpg', 'Thanh toán tiền mặt', 'Bảo, 0983727382, 2, 2', '2021-11-25 15:12:39', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_revenue`
--

CREATE TABLE `tbl_revenue` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `foodId` int(11) NOT NULL,
  `foodName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `paymethod` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_revenue`
--

INSERT INTO `tbl_revenue` (`id`, `customerId`, `foodId`, `foodName`, `quantity`, `price`, `image`, `paymethod`, `address`, `datetime`) VALUES
(1, 15, 17, 'Bánh', 1, '45000', 'fb2270c712.jpeg', 'Thanh toán điện tử', 'Bảo, 0983727382, 2, 2', '2016-08-31 03:33:43'),
(2, 15, 17, 'Bánh', 1, '45000', 'fb2270c712.jpeg', 'Thanh toán điện tử', 'Bảo, 0983727382, 2, 2', '2018-10-31 03:34:56'),
(3, 15, 17, 'Bánh', 1, '45000', 'fb2270c712.jpeg', 'Thanh toán điện tử', 'Bảo, 0983727382, 2, 2', '2019-08-31 03:36:23'),
(4, 15, 17, 'Bánh', 1, '45000', 'fb2270c712.jpeg', 'Thanh toán điện tử', 'Bảo, 0983727382, 2, 2', '2019-10-31 03:40:26'),
(5, 15, 17, 'Bánh', 1, '45000', 'fb2270c712.jpeg', 'Thanh toán điện tử', 'Bảo, 0983727382, 2, 2', '2019-03-31 03:41:12'),
(6, 15, 17, 'Bánh', 1, '45000', 'fb2270c712.jpeg', 'Thanh toán điện tử', 'Bảo, 0983727382, 2, 2', '2021-10-31 03:41:26'),
(7, 15, 17, 'Bánh', 1, '45000', 'fb2270c712.jpeg', 'Thanh toán điện tử', 'Bảo, 0983727382, 2, 2', '2021-03-31 03:41:43'),
(8, 15, 20, 'Cơm cuộn', 1, '50000', '8d3659fb14.jpg', 'Thanh toán điện tử', 'Bảo, 0983727382, Thanh Xuân, Hà Nội', '2021-10-31 03:41:47'),
(9, 15, 20, 'Cơm cuộn', 1, '50000', '8d3659fb14.jpg', 'Thanh toán điện tử', 'Bảo, 0983727382, Thanh Xuân, Hà Nội', '2021-05-31 03:44:10'),
(10, 15, 20, 'Cơm cuộn', 1, '50000', '8d3659fb14.jpg', 'Thanh toán điện tử', 'Bảo, 0983727382, Thanh Xuân, Hà Nội', '2021-10-31 03:45:43'),
(11, 15, 20, 'Cơm cuộn', 1, '50000', '8d3659fb14.jpg', 'Thanh toán điện tử', 'Bảo, 0983727382, Thanh Xuân, Hà Nội', '2021-05-31 03:45:49'),
(12, 15, 17, 'Bánh', 1, '45000', 'fb2270c712.jpeg', 'Thanh toán điện tử', 'Bảo, 0983727382, 2, 2', '2021-10-31 03:49:24'),
(13, 15, 17, 'Bánh', 1, '45000', 'fb2270c712.jpeg', 'Thanh toán điện tử', 'Bảo, 0983727382, 2, 2', '2021-05-31 03:56:20'),
(14, 15, 17, 'Bánh', 1, '45000', 'fb2270c712.jpeg', 'Thanh toán điện tử', 'Bảo, 0983727382, 2, 2', '2021-05-31 03:57:26'),
(15, 15, 17, 'Bánh', 1, '45000', 'fb2270c712.jpeg', 'Thanh toán điện tử', 'Bảo, 0983727382, 2, 2', '2021-10-31 03:57:27'),
(16, 15, 17, 'Bánh', 1, '45000', 'fb2270c712.jpeg', 'Thanh toán điện tử', 'Bảo, 0983727382, 2, 2', '2021-08-31 03:57:28'),
(18, 15, 20, 'Cơm cuộn', 1, '50000', '8d3659fb14.jpg', 'Thanh toán điện tử', 'Bảo, 0983727382, Thanh Xuân, Hà Nội', '2021-10-31 04:09:00'),
(19, 15, 20, 'Cơm cuộn', 1, '50000', '8d3659fb14.jpg', 'Thanh toán điện tử', 'Bảo, 0983727382, Thanh Xuân, Hà Nội', '2021-10-31 04:10:57'),
(20, 15, 20, 'Cơm cuộn', 1, '50000', '8d3659fb14.jpg', 'Thanh toán điện tử', 'Bảo, 0983727382, Thanh Xuân, Hà Nội', '2021-10-31 04:11:31'),
(21, 15, 20, 'Cơm cuộn', 1, '50000', '8d3659fb14.jpg', 'Thanh toán điện tử', 'Bảo, 0983727382, Thanh Xuân, Hà Nội', '2021-10-31 04:15:13'),
(22, 15, 20, 'Cơm cuộn', 2, '100000', '8d3659fb14.jpg', 'Thanh toán điện tử', 'Bảo, 0983727382, 2, 2', '2020-10-31 14:37:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `sliderId` int(11) NOT NULL,
  `sliderImage` mediumtext NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_slider`
--

INSERT INTO `tbl_slider` (`sliderId`, `sliderImage`, `description`) VALUES
(1, 'slider1.jpg', 'Xin chào!'),
(2, 'slider2.jpg', 'Ẩm Thực Ý Truyền Thống'),
(3, 'slider3.jpg', 'Nguyên liệu độc đáo'),
(6, '0e98ca659c.jpg', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplierId` int(11) NOT NULL,
  `supplierName` varchar(150) NOT NULL,
  `supplierPhone` char(11) NOT NULL,
  `supplierEmail` varchar(150) NOT NULL,
  `supplierAddress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplierId`, `supplierName`, `supplierPhone`, `supplierEmail`, `supplierAddress`) VALUES
(1, 'Lập Ánh', '0986843121', 'lapanh@gmail.com', 'Thanh Xuân, Hà Nội'),
(2, 'Minh Bảo', '0981843212', 'minhb@gmail.com', 'Sài Gòn'),
(6, 'Y Ta Li', '0765432122', 'italian@gmail.com', 'Hà Nội');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Chỉ mục cho bảng `tbl_blog`
--
ALTER TABLE `tbl_blog`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_book`
--
ALTER TABLE `tbl_book`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `foodId` (`foodId`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cateId`);

--
-- Chỉ mục cho bảng `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`cmtId`),
  ADD KEY `foodId` (`foodId`);

--
-- Chỉ mục cho bảng `tbl_config`
--
ALTER TABLE `tbl_config`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`foodId`),
  ADD KEY `tbl_food_ibfk_1` (`foodIdCategory`);

--
-- Chỉ mục cho bảng `tbl_material`
--
ALTER TABLE `tbl_material`
  ADD PRIMARY KEY (`matId`),
  ADD KEY `tbl_material_ibfk_1` (`matIdSupplier`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `foodId` (`foodId`);

--
-- Chỉ mục cho bảng `tbl_revenue`
--
ALTER TABLE `tbl_revenue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foodId` (`foodId`),
  ADD KEY `customerId` (`customerId`);

--
-- Chỉ mục cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`sliderId`);

--
-- Chỉ mục cho bảng `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplierId`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `tbl_blog`
--
ALTER TABLE `tbl_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_book`
--
ALTER TABLE `tbl_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `cmtId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tbl_config`
--
ALTER TABLE `tbl_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `foodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `tbl_material`
--
ALTER TABLE `tbl_material`
  MODIFY `matId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_revenue`
--
ALTER TABLE `tbl_revenue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `sliderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplierId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`foodId`) REFERENCES `tbl_food` (`foodId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD CONSTRAINT `tbl_comment_ibfk_1` FOREIGN KEY (`foodId`) REFERENCES `tbl_food` (`foodId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD CONSTRAINT `tbl_food_ibfk_1` FOREIGN KEY (`foodIdCategory`) REFERENCES `tbl_category` (`cateId`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_material`
--
ALTER TABLE `tbl_material`
  ADD CONSTRAINT `tbl_material_ibfk_1` FOREIGN KEY (`matIdSupplier`) REFERENCES `tbl_supplier` (`supplierId`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `tbl_customer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_order_ibfk_2` FOREIGN KEY (`foodId`) REFERENCES `tbl_food` (`foodId`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `tbl_revenue`
--
ALTER TABLE `tbl_revenue`
  ADD CONSTRAINT `tbl_revenue_ibfk_1` FOREIGN KEY (`foodId`) REFERENCES `tbl_food` (`foodId`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_revenue_ibfk_2` FOREIGN KEY (`customerId`) REFERENCES `tbl_customer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
