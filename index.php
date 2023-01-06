<?php
//* @Cristal_team
/*
کریستال تیم ❄️
ربات های متفاوت و شیک ✨
سورس و کد هاے بدون باگ🔥
آموزشات حرفه ای ! 💎
جوین بدید ♥️👇
@Cristal_Team
*/
require 'config.php'; 
require 'jdf.php';
//-----------------//
if(!file_exists("data/$from_id.json")){
	touch("data/$from_id.json");
}
if(preg_match('/^\/start$/i',$text)){
	$answer = 'سلام به ربات ما خوش اومدی';
	$bot->SendMessage($chat_id, $answer, $message_id, 'HTML', true, $keyHome);
}
elseif($bot->join('@'.$channel, $from_id) == 'left'){
    $answer = "ابتدا در کانال @$channel عضو شوید و بعد مجدد /start را وارد کنید";
	$bot->SendMessage($chat_id, $answer, $message_id, 'HTML', true, $keyRemove);
}
elseif($text == 'عکس'){
    $ex = explode(",",$pics);
	$rand = rand(1, count($ex)-1) - 1;
	$send = $ex[$rand];
    $bot->SendPhoto($chat_id, $send, "Caption: <b>Test</b>", 'HTML', true);
}
elseif($text == 'فیلم'){
	$ex = explode(",",$vid);
	$rand = rand(1, count($ex)-1) - 1;
	$send = $ex[$rand];
    $bot->SendVideo($chat_id, $send, "Caption: <b>Test</b>", 'HTML', true);
}
elseif($text == 'گیف'){
	$ex = explode(",",$gif);
	$rand = rand(1, count($ex)-1) - 1;
	$send = $ex[$rand];
    $bot->SendDocument($chat_id, $send, "Caption: <b>Test</b>", 'HTML', true);
}
//--------------------//
elseif(preg_match('/^[\/]?(panel|بازگشت)$/ui',$text) && $bot->is_admin($from_id)){
	$answer = '<pre>سلام ادمین جان به پنل مدیریت خوش اومدی</pre>';
	$bot->SendMessage($chat_id, $answer, $message_id, 'HTML', true, $keyPanel);
	$bot->set('Off');
}
elseif($text == 'آمار' && $bot->is_admin($from_id)){
    $counts = count(scandir('data/')) - 2;
    $picc = count(explode(",", $pics)) - 1;
    $vidd = count(explode(",", $vid)) - 1;
    $giff = count(explode(",", $gif)) - 1;
    $time = jdate('آخرین بروزرسانی در ساعت H:i:s روز l انجام شد.');   
	$answer = "آمار کاربران ربات <b>$counts</b> نفر میباشد".PHP_EOL."تعداد $picc عکس و $vidd فیلم و $giff گیف موجود است.".PHP_EOL."$time";
	$bot->SendMessage($chat_id, $answer, $message_id, 'HTML', true);
}
elseif($text == 'تنظیم کانال' && $bot->is_admin($from_id)){
    $answer = 'لطفا آیدی کانال خود را بدون @ وارد کنید.';
    $bot->SendMessage($chat_id, $answer, $message_id, 'HTML', true, $keyBack);
    $bot->set('SetCh');
}
elseif($bot->get() == 'SetCh'){
	if(preg_match('/^@/',$text)){
		$answer = 'لطفا آیدی کانال را بدون @ وارد فرمایید';
	}else{
		$answer = 'کانال شما تنظیم شد';
		$bot->set('Off');
		$bot->channel($text);
    }
        $bot->SendMessage($chat_id, $answer, $message_id, 'HTML', true, $keyPanel);
}
elseif($text == 'افزودن مدیا +' && $bot->is_admin($from_id)){
	$answer = "لطفا نوع مدیا خود را انتخاب کنید :";
	$bot->SendMessage($chat_id, $answer, $message_id, 'HTML', true, $keyMedia);
}
elseif($text == '+ گیف' or $text == '+ عکس' or $text == '+ فیلم' && $bot->is_admin($from_id)){
    $fa = ["+ گیف","+ فیلم","+ عکس"];
    $en = ['gif','film','photo'];
    $str = str_replace($fa,$en,$text);
    $bot->set($str);
    $answer = "لطفا $text های خود را ارسال کنید و در آخر گزینه بازگشت را بزنید";
    $bot->SendMessage($chat_id, $answer, $message_id, 'HTML', true, $keyBack);
}
elseif($bot->get() == 'film' && isset($video)){
    $bot->save($video_id,"vid.txt");
    $answer = "فیلم شما ذخیره شد فیلم های دیگر هم دارید ارسال کنید در غیر این صورت بازگشت را بزنید";
    $bot->SendMessage($chat_id, $answer, $message_id, 'HTML', true, $keyBack);
}
elseif($bot->get() == 'photo' && isset($photo)){
    $bot->save($photo_id,"pic.txt");
    $answer = "عکس شما ذخیره شد عکس های دیگر هم دارید ارسال کنید در غیر این صورت بازگشت را بزنید";
    $bot->SendMessage($chat_id, $answer, $message_id, 'HTML', true, $keyBack);
}
elseif($bot->get() == 'gif' && isset($doc)){
    $bot->save($doc_id,"gif.txt");
    $answer = "گیف شما ذخیره شد گیف های دیگر هم دارید ارسال کنید در غیر این صورت بازگشت را بزنید";
    $bot->SendMessage($chat_id, $answer, $message_id, 'HTML', true, $keyBack);
}
elseif($text == 'پیام' && $bot->is_admin($from_id)){
    $answer = 'لطفا پیام خود را وارد کنید تا برای کاربران ارسال گردد';
    $bot->SendMessage($chat_id, $answer, $message_id, 'HTML', true, $keyBack);
    $bot->set('SendUser');
}
elseif($bot->get() == 'SendUser' && isset($text)){
    foreach(glob('data/*') as $value){
       $user = pathinfo($value)['filename'];
       $bot->SendMessage($user, $text,null, 'HTML', true);
    }
   $answer = "پیام شما ارسال شد.";
   $bot->SendMessage($chat_id, $answer, $message_id, 'HTML', true, $keyPanel);    
   $bot->set('Off');
}
elseif($text == 'فروارد' && $bot->is_admin($from_id)){
    $answer = 'لطفا پیام خود را فروارد یا ارسال کنید تا برای کاربران ارسال گردد';
    $bot->SendMessage($chat_id, $answer, $message_id, 'HTML', true, $keyBack);
    $bot->set('ForUser');
}
elseif($bot->get() == 'ForUser'){
    foreach(glob('data/*') as $value){
       $user = pathinfo($value)['filename'];
       $bot->forwardMessage($user, $chat_id,$message_id);
    }
   $answer = "پیام شما ارسال شد.";
   $bot->SendMessage($chat_id, $answer, $message_id, 'HTML', true, $keyPanel);    
   $bot->set('Off');
}
/*
کریستال تیم ❄️
ربات های متفاوت و شیک ✨
سورس و کد هاے بدون باگ🔥
آموزشات حرفه ای ! 💎
جوین بدید ♥️👇
@Cristal_Team
توسط مملے
/*
?>