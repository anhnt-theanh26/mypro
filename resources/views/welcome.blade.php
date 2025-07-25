<?php

$subject = 'Learn /PHP/ with Regex PHPPHP';
// $pattern = '/PHP/';
// $pattern = '/\/PHP\//';
$pattern = '#/PHP/#';

if (preg_match_all($pattern, $subject, $matches) > 0) {
    echo 'Match found!';
} else {
    echo 'No match found.';
}
echo '<pre>';
print_r($matches);
echo '</pre>';

echo preg_match_all($pattern, $subject, $matches);

/*

^                   tìm giá trị ở đầu chuỗi
$                   tìm giá trị ở cuối chuỗi
\                   nếu tìm ký tự đặc biệt mà regex sử dụng thì cần phải thêm \ trước ký tự đó
.                   đại diện cho bất kỳ ký tự nào
[abc]               tìm bất kỳ ký tự nào trong dấu ngoặc vuông
[^abc]              tìm bất kỳ ký tự nào không có trong dấu ngoặc vuông
[123][123]          tìm bất kỳ ký tự nào trong dấu ngoặc theo kiểu 11 12 13, 21 22 23, 31 32 33
[a-y]               tìm bất kỳ ký tự nào trong khoảng từ a đến y
[a-zA-Z]            tìm bất kỳ ký tự nào trong khoảng từ a đến z hoặc A
(Mon|Fri)           tìm những chuỗi có trong ngoặc 
..(id|esd|nd)ay     tìm chuỗi bất kỳ có ..iday, ..esday, ..nday
a*b                 a* nghĩa là 0 hoặc nhiều ký tự 'a' (có thể không có ký tự 'a' nào).
                    b là ký tự 'b' (phải xuất hiện đúng một lần, ngay sau chuỗi các 'a').
a+b                 a* nghĩa là 0 hoặc nhiều ký tự 'a' (có thể không có ký tự 'a' nào).
                    b là ký tự 'b' (phải xuất hiện đúng một lần, ngay sau chuỗi các 'a').
a?b                 a? nghĩa là có thể có 0 hoặc 1 ký tự 'a' (tùy chọn, không bắt buộc).
                    b là ký tự 'b' (bắt buộc, phải có và đứng sau 'a' nếu có).
*                   lặp lại 0 hoặc nhiều lần ký tự (hoặc nhóm) đứng trước nó.
[-a]*               tìm bất kỳ ký tự nào [-a] và gộp lại thành [-a].... nếu số lần xuất hiện lớn hơn 0
                    [-a] -> tìm - và a
                    [-a][-a] tìm --, -a, a-, aa


*/
// '^(?P<article_slug>[\w-]+)-a(?P<article_id>\d+)\.html$'