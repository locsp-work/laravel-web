<?php
if(isset($_POST['reply'])){
    $comments = trim($_POST['reply']);
?>
<table >
    <tr>
        <td colspan="2">Đăng nhập thành công</td>
    </tr>
    <tr>
        <td><strong>Xin chào:</strong> </td>
        <td><?php echo $comments ?></td>
    </tr>
</table>