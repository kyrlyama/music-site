<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

// Проверяем, что параметры переданы
$year = isset($_GET['year']) ? trim($_GET['year']) : null;
$genre = isset($_GET['genre']) ? trim(strtolower($_GET['genre'])) : null;
$country = isset($_GET['country']) ? trim(strtolower($_GET['country'])) : null;

if (!$year || !$genre || !$country) {
    echo json_encode(["error" => "Некорректные параметры!", "received" => $_GET]);
    exit();
}

// Логируем полученные данные
file_put_contents("log.txt", "Полученные параметры: " . json_encode($_GET) . "\n", FILE_APPEND);


// Полная база данных исполнителей (15 артистов)
$artists = [
    // Blues/Jazz (Америка)

    [
        "name" => "B.B. King",
        "year" => "2000",
        "genre" => "Blues/Jazz",
        "country" => "America",
        "album" => "Riding with the King",
        "top_song" => "The Thrill Is Gone",
        "awards" => "15 Grammy Awards, введен в Зал славы рок-н-ролла",
        "impact" => "Развил блюзовый стиль игры на гитаре, который повлиял на поколения музыкантов.",
        "biography" => "B.B. King — легендарный блюзовый музыкант и певец, известный своим эмоциональным исполнением и 
                        культовыми гитарными соло.",
        "image" => "images/bbking.jpg"
    ],
    [
        "name" => "Norah Jones",
        "year" => "2005",
        "genre" => "Blues/Jazz",
        "country" => "America",
        "album" => "Come Away with Me",
        "top_song" => "Don't Know Why",
        "awards" => "9 Grammy Awards, один из самых продаваемых дебютных альбомов",
        "impact" => "Смешала джаз, блюз и поп, привнеся новые мелодические решения в традиционные жанры.",
        "biography" => "Norah Jones — американская певица, пианистка и автор песен, известная своим мягким и чувственным стилем исполнения.",
        "image" => "images/norah.jpg"
    ],
    [
        "name" => "Jamie Cullum",
        "year" => "2010",
        "genre" => "Blues/Jazz",
        "country" => "America",
        "album" => "The Pursuit",
        "top_song" => "Don't Stop the Music",
        "awards" => "BBC Jazz Awards, номинация на Grammy",
        "impact" => "Популяризировал джаз среди нового поколения, добавив современные элементы.",
        "biography" => "Jamie Cullum — британский певец, пианист и композитор, который привнес поп-влияние в джазовую музыку.",
        "image" => "images/jamie.jpg"
    ],
    [
        "name" => "Gregory Porter",
        "year" => "2015",
        "genre" => "Blues/Jazz",
        "country" => "America",
        "album" => "Liquid Spirit",
        "top_song" => "Hey Laura",
        "awards" => "2 Grammy Awards, признание критиков",
        "impact" => "Вернул интерес к традиционному джазу и блюзу, сочетая их с элементами соул-музыки.",
        "biography" => "Gregory Porter — один из ведущих джазовых вокалистов современности, известный своим глубоким бархатистым голосом.",
        "image" => "images/gregory.jpg"
    ],
    [
        "name" => "Jon Batiste",
        "year" => "2020",
        "genre" => "Blues/Jazz",
        "country" => "America",
        "album" => "We Are",
        "top_song" => "Freedom",
        "awards" => "5 Grammy Awards, в том числе 'Альбом года'",
        "impact" => "Объединил джаз, блюз, госпел и современную поп-музыку, создав уникальный стиль.",
        "biography" => "Jon Batiste — американский пианист, певец и композитор, работающий в широком музыкальном спектре от джаза до фанк-музыки.",
        "image" => "images/jon.jpg"
    ],

    // Hip-hop (Америка)
    [
        "name" => "Eminem",
        "year" => "2000",
        "genre" => "Hip-hop",
        "country" => "America",
        "album" => "The Marshall Mathers LP",
        "top_song" => "Stan",
        "awards" => "15 Grammy Awards, Academy Award for Best Original Song",
        "impact" => "Популяризировал быстрый рэп и привнес в жанр глубокую лирику.",
        "biography" => "Eminem — американский рэпер, продюсер и актер, 
                        известный своими агрессивными текстами и глубокими историями.",
        "image" => "images/eminem.jpg"
    ],
    [
        "name" => "Kanye West",
        "year" => "2005",
        "genre" => "Hip-hop",
        "country" => "America",
        "album" => "Late Registration",
        "top_song" => "Gold Digger",
        "awards" => "22 Grammy Awards",
        "impact" => "Революционизировал хип-хоп, вводя элементы соула и симфонической музыки.",
        "biography" => "Канье Уэст — один из самых влиятельных рэперов, продюсер и дизайнер, 
                        изменивший музыкальную индустрию.",
        "image" => "images/kanye.jpg"
    ],
    [
        "name" => "Drake",
        "year" => "2010",
        "genre" => "Hip-hop",
        "country" => "America",
        "album" => "Take Care",
        "top_song" => "Marvins Room",
        "awards" => "4 Grammy Awards, самый стриминговый артист Spotify",
        "impact" => "Смешал рэп и R&B, создав уникальный мелодичный стиль.",
        "biography" => "Drake — канадский рэпер, певец и продюсер, который изменил индустрию хип-хопа.",
        "image" => "images/drake.jpg"
    ],
    [
        "name" => "Travis Scott",
        "year" => "2015",
        "genre" => "Hip-hop",
        "country" => "America",
        "album" => "Rodeo",
        "top_song" => "Sicko Mode",
        "awards" => "Billboard Music Awards, BET Awards",
        "impact" => "Стал королем автотюна и создал уникальное звучание trap-музыки.",
        "biography" => "Travis Scott — рэпер и продюсер, известный своими психоделическими битами и лайв-шоу.",
        "image" => "images/travis.jpg"
    ],
    [
        "name" => "Lil Nas X",
        "year" => "2020",
        "genre" => "Hip-hop",
        "country" => "America",
        "album" => "Montero",
        "top_song" => "Old Town Road",
        "awards" => "2 Grammy Awards",
        "impact" => "Смешал хип-хоп и кантри, сломав музыкальные границы.",
        "biography" => "Lil Nas X — рэпер, который прославился вирусными хитами и провокационным стилем.",
        "image" => "images/lilnasx.jpg"
    ],

    // Electronic music (Европа)
    [
        "name" => "Daft Punk",
        "year" => "2000",
        "genre" => "Electronic music",
        "country" => "Europe",
        "album" => "Discovery",
        "top_song" => "One More Time",
        "awards" => "6 Grammy Awards",
        "impact" => "Создали легендарный французский хаус и повлияли на всю электронику.",
        "biography" => "Daft Punk — французский дуэт, ставший культовым благодаря своим шлемам и футуристическому звучанию.",
        "image" => "images/daftpunk.jpg"
    ],
    [
        "name" => "Tiesto",
        "year" => "2005",
        "genre" => "Electronic music",
        "country" => "Europe",
        "album" => "Just Be",
        "top_song" => "Adagio for Strings",
        "awards" => "Grammy Award",
        "impact" => "Один из первых диджеев, сделавший EDM мейнстримом.",
        "biography" => "Tiesto — легендарный голландский диджей, считающийся пионером современной танцевальной музыки.",
        "image" => "images/tiesto.jpg"
    ],
    [
        "name" => "David Guetta",
        "year" => "2010",
        "genre" => "Electronic music",
        "country" => "Europe",
        "album" => "Nothing but the Beat",
        "top_song" => "Titanium",
        "awards" => "2 Grammy Awards",
        "impact" => "Объединил EDM и поп, сделав жанр мировым феноменом.",
        "biography" => "David Guetta — французский диджей, который привнес EDM в чарты по всему миру.",
        "image" => "images/guetta.jpg"
    ],
    [
        "name" => "B.B. King",
        "year" => "2000",
        "genre" => "Blues/Jazz",
        "country" => "America",
        "album" => "Riding with the King",
        "top_song" => "The Thrill Is Gone",
        "awards" => "15 Grammy Awards",
        "impact" => "Один из самых влиятельных блюзовых гитаристов в истории.",
        "biography" => "B.B. King — икона блюза, известный своими эмоциональными гитарными соло.",
        "image" => "images/bbking.jpg"
    ],
    [
        "name" => "Norah Jones",
        "year" => "2005",
        "genre" => "Blues/Jazz",
        "country" => "America",
        "album" => "Come Away with Me",
        "top_song" => "Don't Know Why",
        "awards" => "9 Grammy Awards",
        "impact" => "Смешала джаз и поп, сделав джаз снова популярным.",
        "biography" => "Norah Jones — американская певица, которая привнесла новый стиль в джаз.",
        "image" => "images/norah.jpg"
    ]
];

// Поиск артиста
$foundArtist = null;
foreach ($artists as $artist) {
    if (
        trim(strtolower($artist["year"])) == $year &&
        trim(strtolower($artist["genre"])) == $genre &&
        trim(strtolower($artist["country"])) == $country
    ) {
        $foundArtist = $artist;
        break;
    }
}

// Отправляем JSON-ответ
if ($foundArtist) {
    echo json_encode($foundArtist);
} else {
    echo json_encode(["error" => "Артист не найден"]);
}
exit();