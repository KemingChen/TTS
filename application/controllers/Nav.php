<?

class Nav extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }
    
    public function email()
    {
        $this->load->library('email');
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'taipeitech2013@gmail.com';
        $config['smtp_pass']    = 'qq13579qq';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'text'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);

        $this->email->from('taipeitech2013@gmail.com', 'TaipeiTech');
        $this->email->to('taipeitech2013@gmail.com'); 
        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');  
        $this->email->send();
        echo $this->email->print_debugger();
    }
    
    public function category($category = "All")
    {
        $data["pageNum"] = $this->input->get("page");
        $data["category"] = "商業理財";
        $data["book"] = "快思慢想";
        
        $this->view($category, "Category", "CBooks", $data);
    }
    
    public function book($book)
    {
        $data["book"] = "初學者的料理教科書：2500張步驟圖解，新手必備史上最簡單！看這本，保證不失敗！";
        $data["ISBN"] = "9789570410976";
        $data["category"] = "商業理財";
        $data["author"] = "川上文代";
        $data["translator"] = "";
        $data["publisher"] = "大境";
        $data["date"] = "2012年12月05日";
        $data["language"] = "繁體中文";
        $data["price"] = "480";
        $data["description"] =
            "<P align=center><STRONG><FONT color=#ff0000>日本熱銷，新手必備！看這本，保證不失敗！&nbsp;&nbsp; </FONT></STRONG></P><P>　　里肌肉、洋蔥、大蒜、甜椒、豆腐…照著食譜買齊了所有材料，之後…該怎麼開始呢？</P><P>　　切成「一口大小」到底是多小？鹽「少許」、糖「一撮」差在哪？你知道洗米千萬不能用力搓？為什麼調味料要從鍋邊淋入？小份量使用太大的鍋子，可能是失敗的原因？紅燒魚、薑燒豬肉、親子丼、日式炸雞…有沒有保證好吃的關鍵調味比例？</P><P>　　如果您心中也有這樣的疑問，那麼，這一本日本熱銷、廣受讀者群歡迎的「初學者的料理教科書」包括了日式、西式、中式料理，能夠讓您從食材準備、使用道具、製作過程、料理…到掌握調味，毫無困惑的享受下廚烹調的樂趣與成就感！</P><P>　　超過2500張詳盡圖解，掌握調味方程式，新手也能端出美味！</P><P>　　「初學者的料理教科書」超過2500張詳盡圖解，分為4個單元，第1章 料理基本之鑰：哪些是便利的道具、器具的保養方法、測量工具的使用方法、食材的保存…初學者也能夠一目瞭然，輕鬆開始！第2章 料理的基本：傳授各種最基本的料理法---包括：燉煮、乾貨回春法、油炸、水煮、炊煮、蒸煮、煎烤、熱炒、涼拌…等，詳細的圖解與說明，第一次進廚房也能零失敗！</P><P>　　調味料的比例是決定味道的關鍵！第3章 調味的基本：詳細列出---和風、西式、中菜各種調味的方程式、調味醋的比例、日式高湯與調味料比例、學起來會很方便的醬汁、勾芡與香味的基本、高湯的方程式、歐式高湯的作法、了解日式調味料的效果…等，幫助您輕鬆掌握味道的關鍵！</P><P>　　從食材準備、料理到調味，解決每道菜的「疑難雜症！」 </P><P>　　本書是繼受到大家愛用的「糕點教科書」、「甜點教科書」之後，最新暢銷力作。在日本大受好評，讀者開心的回響不絕於耳！「初學者的料理教科書」傾聽了喜愛下廚讀者們的意見，邀請到知名的川上文代老師親自傳授，100%為初學的新手們量身打造！</P><P>　　在第4章 食材分類事典：收錄了蔬菜、肉、魚的切法與事前處理法。油炸、水煮、炊煮、蒸煮…等各種不同的料理法，更特別列出料理急救站：解決每道菜的「疑難雜症！」。再附上不可不知的調理用語辭典：收乾、撈去泡渣、澆淋煮汁、炸兩次、煮白、揉鹽、霜降…瞭解這些用語，就能料理所有食譜！</P><P>　　各個章節也各依顏色將其區別，因此不僅如同之前系列書籍一樣的親切，更是一本易學易懂的教科書。歡迎所有對下廚有興趣的朋友一起試試看，做菜一定會變成一件快樂的事情！</P><P><STRONG>　　第1章 料理基本之鑰：</STRONG>備齊工具、便利的道具、器具的保養方法、測量工具的使用方法、瞭解調整的方法、食材的保存…初學者也能夠一目瞭然，輕鬆開始！</P><P><STRONG>　　第2章 料理的基本：</STRONG>傳授各種最基本的料理法---包括：燉煮、乾貨回春法、油炸、水煮、炊煮、蒸煮、煎烤、熱炒、涼拌…等，詳細的圖解與說明，第一次進廚房也能零失敗！</P><P><STRONG>　　第3章 調味的基本：</STRONG>詳細列出---和風、西式、中菜各種調味的方程式、調味醋的比例、日式高湯與調味料比例、學起來會很方便的醬汁、勾芡與香味的基本、高湯的方程式、歐式高湯的作法、了解日式調味料的效果…等，幫助您輕鬆掌握味道的關鍵！</P><P>　　料理急救站：解決每道菜的「疑難雜症！」</P><P>　　不可不知的調理用語辭典：收乾、撈去泡渣、澆淋煮汁、炸兩次、煮白、揉鹽、霜降…瞭解用語就能料理所有食譜！</P><P><STRONG>　　第4章 食材分類事典：</STRONG>蔬菜、肉、魚的選購、切法、與事前處理</P><P><STRONG>作者簡介</STRONG></P><P><STRONG>川上文代&nbsp; FUMIYO KAWAKAMI</STRONG></P><P>　　大阪阿倍野□調理師專門學校畢業以後，曾任該校職員12年。</P><P>　　致力於□調理師專門學校的大阪分校、法國里昂 (法Lyon) 分校、TSUJI GROUP SCHOOL國立分校的專業料理人的培植之職務。</P><P>　　成為法國里昂分校的第一位女講師，並曾在法國3星餐廳Georges Blanc參與過研修。</P><P>　　自1996年起，她成為DELICE DE CUILLERES川上文代料理教室的負責人。</P><P>　　擔任□調理師專門學校的外聘講師。</P><P>　　在日本各地的演講會、雜誌、報紙等，都非常地活躍。</P><P>　　著有『糕點教科書』、『甜點教科書』及『義大利菜教科書』(大境文化出版)。</P><P>　　精選相關書目：法國藍帶糕點應用--20種素材41道糕點變化、基礎糕點大全---80種零失敗點心200種清楚易懂技巧圖解、名店麵包在家做：天然酵母、無人工添加物、100％健康、戚風+海綿輕蛋糕77種：健康材料☆低糖配方☆省錢美味☆百變輕蛋糕完整版</P>";
        
        $this->view($book, "Category", "BookInfo", $data);
    }

    public function shopCar()
    {
        $data = array();
        
        $this->view("ShopCar", "Member", "SCar", $data);
    }

    public function rePassword()
    {
        $data = array();
        $this->view("RePassword", "Member", "SCar", $data);
    }

    public function member()
    {
        $data = array();
        $this->view("Member", "Member", "SCar", $data);
    }

    public function record()
    {
        $data = array();
        $this->view("Record", "Member", "SCar", $data);
    }
    
    public function concern()
    {
        $data = array();
        $this->view("Concern", "Member", "SCar", $data);
    }
    
    private function view($activeID, $sliderBarName, $pageName, $data)
    {
        $header = $this->getHeader($sliderBarName);
        $sliderBar = $this->getSliderBar($activeID, $sliderBarName);
        $this->uSliderBar($header, $sliderBar, $pageName, $data);
    }
    
    private function getHeader($activeID)
    {
        $header = array();
        array_push($header, array("ID" => "Category", "Tag" => "瀏覽書籍"));
        array_push($header, array("ID" => "Member", "Tag" => "會員專區"));
        $this->setActive($activeID, $header);
        
        $info["isLogin"] = true;
        $info["header"] = $header;
        return $info;
    }
    
    private function getSliderBar($activeID, $sliderBarName)
    {
        $sliderBar = array();
        switch($sliderBarName)
        {
            case "Category":
                array_push($sliderBar, array("ID" => "C0", "Tag" => "商業理財"));
                array_push($sliderBar, array("ID" => "C1", "Tag" => "文學小說"));
                array_push($sliderBar, array("ID" => "C2", "Tag" => "藝術設計"));
                $this->setUrl($sliderBar, "Category/");
                break;
                
            case "Member":
                array_push($sliderBar, array("ID" => "Member", "Tag" => "會員資料"));
                array_push($sliderBar, array("ID" => "Record", "Tag" => "交易紀錄"));
                array_push($sliderBar, array("ID" => "Concern", "Tag" => "關注書單"));
                array_push($sliderBar, array("ID" => "ShopCar", "Tag" => "購物車"));
                array_push($sliderBar, array("ID" => "RePassword", "Tag" => "修改密碼"));
                $this->setUrl($sliderBar);
                break;
        }
        $this->setActive($activeID, $sliderBar);
        return $sliderBar;
    }
    
    private function setActive($activeID, &$data)
    {
        foreach($data as &$item)
        {
            $item["Active"] = $item["ID"] == $activeID ? "active" : "";
        }
    }
    
    private function setUrl(&$array, $baseUrl = "")
    {
        foreach($array as &$item)
        {
            $item["Url"] = $baseUrl . $item["ID"];
        }
    }
    
    private function uSliderBar($header, $sliderBar, $pageName, $data)
    {
        $return = false;
        $info = array();
        $info["data"] = $data;
        $info["pageName"] = $pageName;
        $info["menu"] = $sliderBar;

        $this->load->view('include/Header', $header);
        $this->load->view("include/SliderBar", $info, $return);
        $this->load->view('include/Footer');
    }
    
    private function debug($array)
    {
        print_r($array);
        exit;
    }
}

?>