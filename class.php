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
class TelBot{
    public function __construct($api_key){
        $this->token = $api_key;
    }
    public function Bot($method,$args=[]){
        $url = 'https://api.telegram.org/bot'.$this->token.'/'.$method;
        $ch = curl_init();
        curl_setopt($ch , CURLOPT_URL , $url);
        curl_setopt($ch , CURLOPT_POST , 1);
        curl_setopt($ch , CURLOPT_POSTFIELDS , $args);
        curl_setopt($ch , CURLOPT_RETURNTRANSFER , 1);
        return json_decode(curl_exec($ch),1);
        curl_close($ch);
    }
    public function SendMessage($chat_id, $text, $message_id, $parse='HTML', $dis=true, $keyboard=null){
    	$this->Bot('SendMessage',[
        'chat_id'=> $chat_id,
        'text'=> $text,
        'reply_to_message_id'=> $message_id,
        'parse_mode'=> $parse,
        'disable_web_page_preview'=> $dis,
        'reply_markup'=> $keyboard
        ]);
    }
    public function forwardMessage($chat_id, $from, $message_id){
    	$this->Bot('forwardMessage',[
        'chat_id'=> $chat_id,
        'from_chat_id'=> $from,
        'message_id'=> $message_id
        ]);
    }
    public function SendVideo($chat_id, $video, $caption=null, $parse='HTML', $dis=true){
    	$this->Bot('SendVideo',[
        'chat_id'=> $chat_id,
        'video'=> $video,
        'caption'=> $caption,
        'parse_mode'=> $parse,
        'disable_web_page_preview'=> $dis
        ]);
    }
    public function SendPhoto($chat_id, $photo, $caption=null, $parse='HTML', $dis=true){
    	$this->Bot('SendPhoto',[
        'chat_id'=> $chat_id,
        'photo'=> $photo,
        'caption'=> $caption,
        'parse_mode'=> $parse,
        'disable_web_page_preview'=> $dis
        ]);
    }
    public function SendDocument($chat_id, $document, $caption=null, $parse='HTML', $dis=true){
    	$this->Bot('SendDocument',[
        'chat_id'=> $chat_id,
        'document'=> $document,
        'caption'=> $caption,
        'parse_mode'=> $parse,
        'disable_web_page_preview'=> $dis
        ]);
    }
    public function is_admin($from_id){
    	global $sudo;
        return in_array($from_id, $sudo);
    }
    public function set($data){
    	global $from_id;
    	$get = json_decode(file_get_contents("data/$from_id.json"),true);
        $get['set'] = $data;
        file_put_contents("data/$from_id.json", json_encode($get));
        return true;
   }
   public function get(){
       global $from_id;
       $get = json_decode(file_get_contents("data/$from_id.json"),true);
       return $get['set'];
   }
   public function channel($str){
       file_put_contents("channel.txt",$str);
       return true;
   }
  public function save($data, $dir){
       $f = fopen("media/$dir","a") or die("Error to open file!");
       fwrite($f, "$data,");
       fclose($f);
  }
  public function join($ch, $from){
       $api = $this->Bot('GetChatMember',[
       'chat_id'=> $ch,
       'user_id'=> $from
       ]);
       return $api['result']['status'];
  }
}
/*
کریستال تیم ❄️
ربات های متفاوت و شیک ✨
سورس و کد هاے بدون باگ🔥
آموزشات حرفه ای ! 💎
جوین بدید ♥️👇
@Cristal_Team
*/
?>