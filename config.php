<?PHP
/*
کریستال تیم ❄️
ربات های متفاوت و شیک ✨
سورس و کد هاے بدون باگ🔥
آموزشات حرفه ای ! 💎
جوین بدید ♥️👇
@Cristal_Team
توسط مملے
*/
error_reporting(0);
require 'class.php';
$args = '5594605180:AAFpOkyk-ctzAbd8CP4Du4DsJNaKP28pyfY';
$bot = new TelBot($args);
$update = json_decode(file_get_contents('php://input'),true);
if(isset($update['message'])){
    $message = $update['message'];
    $chat_id = $message['chat']['id'];
    $message_id = $message['message_id'];
    $text = $message['text'];
    $from_id = $message['from']['id'];
    $firstname = $message['from']['first_name'];
    $lastname = isset($message['from']['last_name']) ? null:null;
    $username = isset($message['from']['username']) ?'@'.null:null;
    $video = $message['video'];
    $video_id = $message['video']['file_id'];
    $photo = $message['photo'];
    $photo_id = $message['photo'][0]['file_id'];
    $doc = $message['document'];
    $doc_id = $message['document']['file_id'];
}
$db = file_get_contents(json_decode('data.json',true));
$gif = file_get_contents("media/gif.txt");
$vid = file_get_contents("media/vid.txt");
$pics = file_get_contents("media/pic.txt");
$channel = file_get_contents("channel.txt");
$sudo = [2090609131]; //آیدی عددی ادمین
$keyHome = json_encode([
      'keyboard'=> [
      [['text'=> 'گیف'],['text'=> 'فیلم']],
      [['text'=> 'عکس']]
      ],'resize_keyboard'=> true
]);
$keyPanel = json_encode([
      'keyboard'=> [
      [['text'=> 'تنظیم کانال'],['text'=> 'آمار']],
      [['text'=> 'افزودن مدیا +']],
      [['text'=> 'فروارد'],['text'=> 'پیام']]
      ],'resize_keyboard'=> true
]);
$keyBack = json_encode([
      'keyboard'=> [
      [['text'=> 'بازگشت']]
      ],'resize_keyboard'=> true
]);
$keyMedia = json_encode([
      'keyboard'=> [
      [['text'=> '+ عکس'],['text'=> '+ فیلم']],
      [['text'=> '+ گیف']],
      [['text'=> 'بازگشت']]
      ],'resize_keyboard'=> true
]);
$keyRemove = json_encode([
      'ReplyKeyboardRemove'=>[
       []
      ],'remove_keyboard'=> true
]);
/*
کریستال تیم ❄️
ربات های متفاوت و شیک ✨
سورس و کد هاے بدون باگ🔥
آموزشات حرفه ای ! 💎
جوین بدید ♥️👇
@Cristal_Team
توسط مملے
*/
?>