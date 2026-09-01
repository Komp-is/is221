-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 01 2026 г., 17:33
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `is221`
--

-- --------------------------------------------------------

--
-- Структура таблицы `home_slides`
--

CREATE TABLE `home_slides` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_url` varchar(500) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `home_slides`
--

INSERT INTO `home_slides` (`id`, `title`, `image_url`, `sort_order`, `is_active`, `created_at`) VALUES
(1, 'Набор автозапчастей', './assets/images/image1.png', 1, 1, '2026-05-11 09:49:40'),
(2, 'Детали двигателя', './assets/images/image2.png', 2, 1, '2026-05-11 09:49:40'),
(3, 'Набор ', 'https://avatars.mds.yandex.net/i?id=4a0cebd2a8f9cd3fc8ad43b526fb4b1c9a890e6d-5889050-images-thumbs&n=13', 3, 1, '2026-05-11 09:49:40'),
(4, 'Детали', 'https://avatars.mds.yandex.net/i?id=2126ddac38af917f68a5300544e2f9191afead46-3560974-images-thumbs&n=13', 4, 1, '2026-05-11 09:49:40'),
(5, 'Набор на выбор', 'https://avatars.mds.yandex.net/i?id=0f41c3436c6e98f1574d55611eb3a0415d19275b-5283200-images-thumbs&n=13', 5, 1, '2026-05-11 09:49:40'),
(6, 'Автозапчасти для тормазной системы', 'https://avatars.mds.yandex.net/i?id=0eea206643df8e942ec2ed7f0ac409bd2e4abe74-10667780-images-thumbs&n=13', 6, 1, '2026-05-11 09:49:40'),
(7, 'Автокомпоненты крупным планом', './assets/images/image3.png', 7, 1, '2026-05-11 09:49:40');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'pending',
  `fio` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `all_sum` decimal(10,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `order_date`, `status`, `fio`, `address`, `phone`, `email`, `all_sum`, `user_id`, `created_at`) VALUES
(8, '2026-05-13 19:09:28', '1', 'Влад', 'город Кемерово', '+79047656453', 'denis.kupriyanov.2021@gmail.com', 38440.00, 6, '2026-05-13 19:09:28');

-- --------------------------------------------------------

--
-- Структура таблицы `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `count_item` int(11) NOT NULL DEFAULT 1,
  `price_item` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sum_item` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `count_item`, `price_item`, `sum_item`) VALUES
(9, 8, 2, 1, 12540.00, 12540.00),
(10, 8, 3, 1, 8720.00, 8720.00),
(11, 8, 6, 2, 8590.00, 17180.00);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `created_at`, `image`, `username`) VALUES
(1, 'Фильтр масляный', 1200.00, 'Ма́сляный фи́льтр — устройство, предназначенное для удаления загрязнений из моторных, компрессорных, турбинных, трансмиссионных, смазочных масел, гидравлических жидкостей (жидкость для автоматической коробки перемены передач, жидкость для гидравлического усилителя рулевого управления) и др.\r\n\r\nОчень похоже устроены и топливные фильтры (очистка бензина, керосина или дизельного топлива), но у масляных фильтров как правило есть перепускной клапан.', '0000-00-00 00:00:00', 'https://localhost/pizza221/assets/images/i.png', NULL),
(2, 'Коленвал', 12540.00, 'Коленчатый вал (коленвал) — деталь (или узел деталей в случае составного вала) сложной формы, имеющая шейки для крепления шатунов, от которых воспринимает усилия и преобразует их в крутящий момент. Составная часть кривошипно-шатунного механизма (КШМ).', '0000-00-00 00:00:00', 'https://localhost/pizza221/assets/images/i2.png', NULL),
(3, 'Фара', 8720.00, 'Фа́ра (по названию греческого острова «Фарос», знаменитого в древности своим маяком[1]) — источник направленного света с отражателем, установленный в передней части транспортного средства и предназначенный для освещения дороги и окружающей местности.\r\nКоличество фар может колебаться от одной (мотоцикл, мопед, велосипед), до нескольких десятков (крупный авиалайнер). Её мощность может колебаться от единиц ватт (фара велосипеда) до нескольких киловатт (на локомотивах и речных судах)', '0000-00-00 00:00:00', 'https://localhost/pizza221/assets/images/i3.png', NULL),
(4, 'Аккамулятор', 4900.00, 'аккумулятор (АКБ) — это источник электроэнергии, который используется для запуска двигателя, питания электронных систем автомобиля и стабилизации напряжения в бортовой сети. Он накапливает энергию при работающем двигателе (от генератора) и отдаёт её при запуске мотора или при выключенном двигателе.', '2026-05-11 10:04:50', 'https://avatars.mds.yandex.net/i?id=d5747fbc6081982add9e6d54e4a770376741d519-4055743-images-thumbs&n=13', NULL),
(5, 'Генератор', 3500.00, 'Автомобильный генератор «ASG» - основной источник электроэнергии автомобиля, представляет собой устройство, которое преобразует механическую энергию в электрическую. Генератор обеспечивает зарядку АКБ и через него питает все электросистемы в авто после запуска ДВС.Преимущества генераторов ASG:• полная идентичность штатным изделиям по габаритным размерам и выходным характеристикам;• многоступенчатый контроль каждого генератора для автомобиля на специализированном стенде проверки перед выпуском в продажу;• в комплект каждого генератора входит индивидуальный технический паспорт, отражающий все реальные выходные характеристики каждого генератора;• взаимозаменяемость с оригиналом.', '2026-05-11 10:04:50', 'https://avatars.mds.yandex.net/i?id=df83355fd916b2ad3109fe84c9017a919c0b0899-5695679-images-thumbs&n=13', NULL),
(6, 'Тормозные диски', 8590.00, 'ТОрмозные диски -  из качественного металла выдерживают высокие температуры, прослужат вам долго. Комплект из двух штук.', '2026-05-11 10:04:50', 'https://avatars.mds.yandex.net/i?id=bd74eb9f7f138e270f2ff8ba0d26650a561c6c60-11406357-images-thumbs&n=13', NULL),
(7, 'Колодки', 3590.00, 'Универсальное решение для владельцев Hyundai Solaris, Kia Rio и Geely Atlas: обеспечивает надёжную работу системы тормозов благодаря усиленной конструкции и современным материалам. Высокий уровень износостойкости гарантирует долгий срок службы даже при активной эксплуатации автомобиля.\r\n\r\nПрочный корпус и оптимальная форма обеспечивают равномерное распределение давления, снижают риск перегрева и повышают безопасность движения. Простота монтажа позволяет легко произвести замену самостоятельно, сохранив комфорт и экономию времени.', '2026-05-11 10:04:50', 'https://avatars.mds.yandex.net/i?id=a39db27e09de7f0e426f04d62227a2aa95713105-11375516-images-thumbs&n=13', NULL),
(8, 'Моторное масло', 3600.00, 'Преимущества:\r\n- Снижение расхода топлива;\r\n- Высокая защита двигателя от износа;\r\n- Отличные низкотемпературные свойства;\r\n- Устойчивость к старению и образованию отложений;\r\n- Низкий угар благодаря наличию алкилированных нафталинов(AN);\r\n- Совместимо с новейшими системами нейтрализации выхлопных газов;\r\n- Совместимо с маслами других производителей с аналогичными допусками.', '2026-05-11 10:15:46', 'https://avatars.mds.yandex.net/i?id=d6b962467a19d2bbc3325784daf2fd99cb01747c-8873941-images-thumbs&n=13', NULL),
(9, 'Свеча зажигания', 250.00, 'Японская компания Just Drive Co., уже 20 лет выпускает автозапчасти под своим собственным брендом JUST DRIVE.Свечи зажигания изготовлены в соответствии с технологией и конструктивными особенностями свечей зажигания, лидера рынка компании NGK.Соответствуют следующим характеристикам:\r\nгеометрический размер;\r\nкалильное число;\r\nколичество электродов;\r\nматериал изготовления;\r\nналичие защитного сопротивления.', '2026-05-11 10:15:46', 'https://avatars.mds.yandex.net/i?id=9119f1dbf031297f3b723569e30703ba737c7942-5214226-images-thumbs&n=13', NULL),
(10, 'Коробка передач', 32950.00, '5-ступенчатая коробка переключения передач (КПП) для автомобиля ВАЗ 2123 «Нива Шевроле» предназначена для передачи крутящего момента от двигателя на ведущую пару колёс, изменения скорости движения автомобиля, разъединения и соединения ДВС и трансмиссии, а также корректировки направления движения машины.', '2026-05-11 10:15:46', 'https://avatars.mds.yandex.net/i?id=2ba9714a0c72244a5e85dd0efcdac30190283966-4292030-images-thumbs&n=13', NULL),
(11, 'Стартер', 7600.00, 'Ста́ртер (Электростартер) — электрический двигатель, служащий для пуска двигателя внутреннего сгорания или газотурбиного двигателя', '2026-05-11 10:15:46', 'https://avatars.mds.yandex.net/i?id=cfc7e5056e2eec02c8333b1e365c70ba0f908cfc-4485565-images-thumbs&n=13', NULL),
(12, 'Незамерзайка', 800.00, 'Незамерзающая жидкость для стекол автомобиля –30°C, 5 л — это эффективная и надежная незамерзающая жидкость, разработанная специально для использования в суровых зимних условиях. Благодаря сбалансированной формуле, она обеспечивает чистоту лобового стекла и безопасность вождения даже при сильных морозах до –30°C.', '2026-05-11 10:15:46', 'https://avatars.mds.yandex.net/i?id=eb5301e59cfe15a2fc5e1ed1e3b6b19ae693bc56-4285578-images-thumbs&n=13', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `token`, `is_verified`, `address`, `phone`) VALUES
(5, '1234', 'matzau2@bk.ru', '$2y$10$09TzUzAlOCf9HrFvlqMHG.mdUnpT6J3oANoUSWC78YdyHO70z/IUq', '', 1, NULL, NULL),
(6, 'Влад', 'denis.kupriyanov.2021@gmail.com', '$2y$10$SvhVadv3cD1wkV.H0XxI8eMoO07ft9wKz4lZ5apyLS/O8QRFlyl9O', '', 1, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `home_slides`
--
ALTER TABLE `home_slides`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `home_slides`
--
ALTER TABLE `home_slides`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
