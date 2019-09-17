drop database if exists shop;
create database shop default character set utf8 collate utf8_general_ci;
grant all on shop.* to 'staff'@'localhost' identified by 'password';
use shop;

create table product (
	id int auto_increment primary key, 
	name varchar(200) not null, 
	price int not null,
	description varchar(200) not null,
	degree varchar(100) not null,
	taste varchar(100) not null,
	genre varchar(100) not null
);

create table sale_product (
	id int auto_increment primary key,
	product_id int not null,
	name varchar(200) not null, 
	price int not null,
	description varchar(200) not null,
	degree varchar(100) not null,
	taste varchar(100) not null,
	genre varchar(100) not null
);

create table customer (
	id int auto_increment primary key, 
	name varchar(100) not null, 
	address varchar(200) not null, 
	login varchar(100) not null unique, 
	password varchar(100) not null
);

create table purchase (
	id int not null primary key,
	customer_id int not null,
	state tinyint(1) default 0 /* 0:not cansel, 1:cansel */ 

	
);
create table purchase_detail (
	purchase_id int not null, 
	product_id int not null, 
	count int not null,
	no_default timestamp, 
	primary key(purchase_id, product_id)
	 
	
);

create table favorite (
	customer_id int not null, 
	product_id int not null, 
	primary key(customer_id, product_id)
	
);
create table owner (
	id int auto_increment primary key,
	owner_login varchar(100) not null, 
	owner_password varchar(100) not null
	
);

insert into product values(null, '軽井沢高原ビール　ワイルドフォレスト 350ml', 220,'「ワイルドフォレスト」は高原の爽やかな気候に合わせ、しっかりとした風味と香りを持たせた軽井沢で最も飲まれているローカルビールです。','5度','ピルスナービール','ビール');
insert into product values(null, '軽井沢高原ビール　ナショナルトラスト 350ml', 220,'「ナショナルトラスト」はブラックモルトが醸し出す甘みとコク、まろやかな苦みとローストの香りが特徴','5度','黒ビール','ビール');
insert into product values(null, '軽井沢高原ビール　オーガニック 350ml', 220,'麦芽のコクと香ばしさ、ホップの爽やかな苦みが感じられるスッキリとした味わいのビールです。浅間山麓の醸造所は、アファス認証センターにより有機農産物加工酒類製造業者の認定を受け、有機栽培麦芽・ホップを100％使用したビールを醸造しています。','5度','ピルスナービール','ビール');
insert into product values(null, '完熟ワイン 巨峰 720ml', 1230,'フレッシュ＆フルーティーで地方色豊かなこの時期しか飲めない無添加新酒ワイン！
信州産巨峰を100%使用した、別名『葡萄の王様』！生食用のフルーティで風味豊かな信州産巨峰を100％使用したワインです。
あの巨峰の香気とジューシーな甘やかさを堪能できます。','７～９度予定','赤　やや甘口','ワイン');
insert into product values(null, '完熟ワイン　ナイアガラ　720ml', 1230,'信州は日照量が豊富で収穫時期における昼夜の温度差が大きいため高品質で美味しいぶどうが育ちます。
この信州産ナイアガラ種の完熟ぶどうを使用した、フレッシュ&フルーティーで地方色豊かなやや甘口白ワインです。
牡蠣とカブのシチュー、ポテトのチーズ焼き、きのこのクリームシチューなどの料理と合わせてどうぞ。','７～９度予定','白　甘口','ワイン');
insert into product values(null, '完熟ワイン　コンコード 720ml', 1230,'信州は日照量が豊富で収穫時期における昼夜の温度差が大きいため高品質で美味しいぶどうが育ちます。
このコンコード種を使用し、辛口に仕上げました。甘味を抑えた味わいはお食事との相性もよく人気上昇中です。','７～９度予定','赤　やや辛口','ワイン');
insert into product values(null, '知多ウイスキー　700ml', 4180,'「軽やかな風」をイメージしたグレーン原酒でつくられており、ほのかな甘さとなめらかな味わいが特長のウイスキーです。
','43度','グレーンウイスキー','ウイスキー');
insert into product values(null, '白州ウイスキー　700ml', 6980,'森の若葉のようなみずみずしくほのかなスモーキーフレーバーを備えた「ライトリーピーテッドモルト」と、「白州」らしい複雑さと奥行きを持つさまざまな原酒をヴァッティングしました。
それぞれの個性が重なり合うことで生まれた、フレッシュな香り、爽やかで軽快なキレの良い味わいが特長です。','43度','シングルモルトウイスキー','ウイスキー');
insert into product values(null, '山崎ウイスキー　700ml', 7880,'繊細で上品なテイスト。甘いバニラ香と熟した果実香、幾重にも押し寄せる香味が特長です。','43度','シングルモルトウイスキー','ウイスキー');
insert into product values(null, '角瓶　700ml', 1280,'角瓶は、山崎と白州蒸溜所のバーボン樽原酒をバランスよく配合し、甘やかな香りと厚みのあるコク、ドライな後口が特長のウイスキー。そのおいしさは、ハイボールにすることでいっそう引き立ちます。','40度','ブレンデッドウイスキー','ウイスキー');
insert into product values(null, '安曇野ワイナリー 雅木花 375ml', 2980,'上質のアイスワインを彷彿とさせる味わい！！極上のコンコードブドウから作る極上の氷結ワインです。','8度','赤　甘口','ワイン');
insert into product values(null, '安曇野ワイナリー 紅木花　375ml', 3000,'日本一と誉れ高い紅玉リンゴを1本に約50個使用した氷結ワイン。いままで味わったことのない、濃縮したリンゴの蜜だけを舐めるような未体験の甘酸っぱさです。','7度','ロゼ　甘口','ワイン');

insert into customer values(null, '熊木 和夫', '東京都新宿区西新宿2-8-1', 'kumaki', 'BearTree1');
insert into customer values(null, '鳥居 健二', '神奈川県横浜市中区日本大通1', 'torii', 'BirdStay2');
insert into customer values(null, '鷺沼 美子', '大阪府大阪市中央区大手前2', 'saginuma', 'EgretPond3');
insert into customer values(null, '鷲尾 史郎', '愛知県名古屋市中区三の丸3-1-2', 'washio', 'EagleTail4');
insert into customer values(null, '牛島 大悟', '埼玉県さいたま市浦和区高砂3-15-1', 'ushijima', 'CowIsland5');
insert into customer values(null, '相馬 助六', '千葉県地足中央区市場町1-1', 'souma', 'PhaseHorse6');
insert into customer values(null, '猿飛 菜々子', '兵庫県神戸市中央区下山手通5-10-1', 'sarutobi', 'MonkeyFly7');
insert into customer values(null, '犬山 陣八', '北海道札幌市中央区北3西6', 'inuyama', 'DogMountain8');
insert into customer values(null, '猪口 一休', '福岡県福岡市博多区東公園7-7', 'inokuchi', 'BoarMouse9');

insert into purchase values(1,1,0);

insert into purchase_detail values(1,1,3,null);

insert into owner values(null,'owner','ownerlo');
