CREATE TABLE `dang_ky` (
  `ma_dangky` int(11) NOT NULL,
  `ma_sv` varchar(50) NOT NULL,
  `ma_sukien` int(11) NOT NULL,
  `thoi_gian_dang_ky` timestamp NOT NULL DEFAULT current_timestamp(),
  `trang_thai` varchar(50) DEFAULT 'Đã đăng ký'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `dang_ky` (`ma_dangky`, `ma_sv`, `ma_sukien`, `thoi_gian_dang_ky`, `trang_thai`) VALUES
(1, 'SV001', 1, '2026-10-06 11:36:56', 'Đã đăng ký'),
(2, 'SV002', 2, '2026-10-06 11:36:56', 'Đã đăng ký');

-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `dia_diem`
--

CREATE TABLE `dia_diem` (
  `ma_diadiem` int(11) NOT NULL,
  `ten_diadiem` varchar(255) NOT NULL,
  `suc_chua` int(11) NOT NULL,
  `vi_tri` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dia_diem`
--

INSERT INTO `dia_diem` (`ma_diadiem`, `ten_diadiem`, `suc_chua`, `vi_tri`) VALUES
(1, 'Hội trường A', 500, 'Khu nhà trung tâm, Tầng 1'),
(2, 'Phòng Hội thảo B1', 100, 'Dãy nhà B, Tầng 2');

-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `sinh_vien`
--

CREATE TABLE `sinh_vien` (
  `ma_sv` varchar(50) NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `so_dien_thoai` varchar(15) DEFAULT NULL,
  `ngay_tao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sinh_vien`
--

INSERT INTO `sinh_vien` (`ma_sv`, `ho_ten`, `email`, `mat_khau`, `so_dien_thoai`, `ngay_tao`) VALUES
('SV001', 'Võ Khánh Băng', 'khanhbang@student.edu.vn', 'password_hash_1', '0912345678', '2026-10-06 11:36:56'),
('SV002', 'Châu Tiến Đạt', 'tiendat@student.edu.vn', 'password_hash_2', '0987654321', '2026-10-06 11:36:56');

-- Cấu trúc bảng cho bảng `su_kien`
CREATE TABLE `su_kien` (
  `ma_sukien` int(11) NOT NULL,
  `ten_sukien` varchar(255) NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `thoi_gian_bat_dau` datetime NOT NULL,
  `thoi_gian_ket_thuc` datetime NOT NULL,
  `ma_diadiem` int(11) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_path_key` varchar(500) DEFAULT NULL,
  `file_type` varchar(100) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `upload_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Đang đổ dữ liệu cho bảng `su_kien`

INSERT INTO `su_kien` (`ma_sukien`, `ten_sukien`, `mo_ta`, `thoi_gian_bat_dau`, `thoi_gian_ket_thuc`, `ma_diadiem`, `file_name`, `file_path_key`, `file_type`, `file_size`, `upload_time`) VALUES
(1, 'Chào tân sinh viên 2026', 'Sự kiện giao lưu đầu khóa.', '2026-10-15 08:00:00', '2026-10-15 11:30:00', 1, NULL, NULL, NULL, NULL, NULL),
(2, 'Workshop Kỹ năng mềm', 'Hướng dẫn viết CV và phỏng vấn.', '2026-10-20 14:00:00', '2026-10-20 16:30:00', 2, NULL, NULL, NULL, NULL, NULL);

-- Chỉ mục cho các bảng đã đổ
-- Chỉ mục cho bảng `dang_ky`

ALTER TABLE `dang_ky`
  ADD PRIMARY KEY (`ma_dangky`),
  ADD UNIQUE KEY `duy_nhat_dang_ky` (`ma_sv`,`ma_sukien`),
  ADD KEY `ma_sukien` (`ma_sukien`);

-- Chỉ mục cho bảng `dia_diem`
ALTER TABLE `dia_diem`
  ADD PRIMARY KEY (`ma_diadiem`);

--
-- Chỉ mục cho bảng `sinh_vien`
--
ALTER TABLE `sinh_vien`
  ADD PRIMARY KEY (`ma_sv`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `su_kien`
--
ALTER TABLE `su_kien`
  ADD PRIMARY KEY (`ma_sukien`),
  ADD KEY `ma_diadiem` (`ma_diadiem`);

--
-- AUTO_INCREMENT cho các bảng đã đổ

-- AUTO_INCREMENT cho bảng `dang_ky`
--
ALTER TABLE `dang_ky`
  MODIFY `ma_dangky` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `dia_diem`
--
ALTER TABLE `dia_diem`
  MODIFY `ma_diadiem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `su_kien`
--
ALTER TABLE `su_kien`
  MODIFY `ma_sukien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--
--
-- Các ràng buộc cho bảng `dang_ky`
--
ALTER TABLE `dang_ky`
  ADD CONSTRAINT `dang_ky_ibfk_1` FOREIGN KEY (`ma_sv`) REFERENCES `sinh_vien` (`ma_sv`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dang_ky_ibfk_2` FOREIGN KEY (`ma_sukien`) REFERENCES `su_kien` (`ma_sukien`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `su_kien`
--
ALTER TABLE `su_kien`
  ADD CONSTRAINT `su_kien_ibfk_1` FOREIGN KEY (`ma_diadiem`) REFERENCES `dia_diem` (`ma_diadiem`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;
