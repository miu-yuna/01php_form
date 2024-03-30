<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $furigana = $_POST["furigana"];
    $mail = $_POST["email"];
    $tel = $_POST["tel"];
    $sex = $_POST["sex"];
    $item = $_POST["item"];
    $content = $_POST["content"];
}
?>

<form action="" method="post">
    <input type="hidden" name="name" value="<?php echo $name; ?>">
    <input type="hidden" name="furigana" value="<?php echo $furigana; ?>">
    <input type="hidden" name="email" value="<?php echo $mail; ?>">
    <input type="hidden" name="tel" value="<?php echo $tel; ?>">
    <input type="hidden" name="sex" value="<?php echo $sex; ?>">
    <input type="hidden" name="item" value="<?php echo $item; ?>">
    <input type="hidden" name="content" value="<?php echo $content; ?>">
    <h2 class="contact-title">お問い合わせ 内容確認</h2>
    <p>お問い合わせ内容はこちらで宜しいでしょうか？<br>よろしければ「送信する」ボタンを押して下さい。</p>
    <div>
        <label>お名前</label>
        <p><?php echo $name; ?></p>
    </div>
    <div>
        <label>ふりがな</label>
        <p><?php echo $furigana; ?></p>
    </div>
    <div>
        <label>メールアドレス</label>
        <p><?php echo $mail; ?></p>
    </div>
    <div>
        <label>電話番号</label>
        <p><?php echo $tel; ?></p>
    </div>
    <div>
        <label>性別</label>
        <p><?php echo $sex ?></p>
    </div>
    <div>
        <label>お問い合わせ項目</label>
        <p><?php echo $item; ?></p>
    </div>
    <div>
        <label>お問い合わせ内容</label>
        <p><?php echo nl2br($content); ?></p>
    </div>
    <input class="btn" type="button" value="内容を修正する" onclick="history.back(-1)">
    <button class="btn" type="submit" name="submit">送信する</button>
</form>

<?php
if (isset($_POST["submit"])) {
    mb_language("ja");
    mb_internal_encoding("UTF-8");
    $subject = "［自動送信］お問い合わせ内容の確認";
    $body = <<< EOM
{$name} 様お問い合わせありがとうございます。
以下のお問い合わせ内容を、メールにて確認させていただきました。
===================================================
【 お名前 】
{$name}
【 ふりがな 】
{$furigana}
【 メール 】
{$mail}
【 電話番号 】
{$tel}
【 性別 】
{$sex}
【 項目 】
{$item}
【 内容 】
{$content}
===================================================
内容を確認のうえ、回答させて頂きます。
しばらくお待ちください。
EOM;

    $fromEmail = "送信元のメールアドレス";
    $fromName = "送信元の名前";
    $header = "From: " . mb_encode_mimeheader($fromName) . "<{$fromEmail}>";
    mb_send_mail($mail, $subject, $body, $header);
    mb_send_mail($fromEmail, $subject, $body, $header);
    header("Location: mailto.php");
    exit;
}
?>