<?php
/**
 * Created by IntelliJ IDEA.
 * User: vova
 * Date: 07.01.14
 * Time: 19:59
 */

namespace GeekHub\BlogBundle\DataFixtures;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GeekHub\BlogBundle\Entity\Article;

class LoadArticleData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $articlesData = array
        (
            array(
                'tittle' => 'Домашний ЧПУ-фрезер как альтернатива 3D принтеру, часть первая — выбор станка',
                'content' => 'Последнее время на хабре все чаще появляются топики, посвященные 3D-печати вообще и домашним 3D-принтерам в частности. И почти в каждом в комментариях вспыхивает холивар между романтиками, в жизни не видевшими 3D отпечатков, и практиками, единожды потрогавшими и разочаровавшимися. При этом вторые почему-то не приводят адекватных альтернативных технологий, комментарии носят либо чисто критический характер, либо предлагают заведомо более дорогие альтернативы. Тем не менее, достойная альтернатива есть — домашний фрезерный станок с ЧПУ.

Звучит удивительно, да? Как-то само слово станок в народе ассоциируется с производством, с отдельными помещениями и специально обученным персоналом. В действительности, существует большой класс ЧПУ-станков, рассчитанных на настольное использование в офисе и на малых производствах, а при желании — и дома. При этом цена маленьких ЧПУ-фрезеров приближается (чтобы не сказать равна) к реальной цене 3D-принтеров.

Жизнь сложилась так, что последний год с гаком я занимаюсь изготовлением литьевых форм для полиуретановых изделий на ЧПУ-фрезере. Поскольку до этого 10 лет оттрубил в IT ритейле, а образование не имеет никакого отношения ни к инжинирингу, ни к ЧПУ, осваивать технологии пришлось с нуля. За прошедший год я подрос с должности оператора-фрезеровщика до инженера-конструктора, а затем и до замдиректора по технологиям, моими стараниями ЧПУ-парк предприятия вырос с одинокого старенького роланда до 5 разнокалиберных станков. В связи с чем еще свеж и актуален опыт выбора, покупки, пусконаладки, тюнинга, эксплуатации и ремонта различных ЧПУ-станков.

И вот — решил поделиться опытом с сообществом. Я осознаю сам, и прошу принимать во внимание читателей, что я — самоучка без базового инженерного образования, все нижеизложенное основано исключительно на личном опыте.

После долгих мук выбора, писать статью-противопоставление или статью-обзор технологии победил третий вариант: написать цикл статей, описывающий слегка абстрагированный опыт ЧПУшника — от выбора станка, пусконаладки и инструментов, через подбор материалов, ПО и режимов работы, до тюнинга и доводки.

Под катом первая статья цикла — краткое описание подсистем ЧПУ-фрезеров, с комментариями и рекомендациями по выбору.

Что купить и как выбрать

В первую очередь определяемся с задачами.
Поскольку мы смотрим на альтернативы 3D принтерам для домашнего/хоббийного использования, основными рабочим материалами у нас будут пластики, дерево, МДФ, ДСП, фанера, текстолит и немножко цветмета. Размеры — не менее домашние 20*30 см — размер листа А4.

Шпиндель

Шпиндель — рабочий инструмент станка, вращающий фрезу. Мощность шпинделя является производной от желаемой скорости съема материала: у меня есть вполне неплохой опыт фрезеровки алюминия 60Вт шпинделем, но с убого маленькими подачами и заглублением. В большинство китайских станков устанавливаются шпиндели 600-800 Вт, чего вполне достаточно для чистого съема пластика/дерева глубиной 1 мм со скоростью 2 метра в минуту.
Отдельно предостерегу от использования шпинделей Kress FHE/FE серии: по сравнению с китайцами они в разы более шумные и менее точные. Если продавец предлагает установку такого шпинделя, лучше закажите сами нормальный шпиндель на алиэкспрессе, а еще лучше — найдите другого продавца.

Рама

На хоббийных станках в лучшем случае рама будет представлена конструкционным профилем в основании и 10-15 мм алюминием на стойках портала и оси Z. В принципе, этого достаточно для домашних-хоббийных задач, главное — проследить, чтобы это было. На моей памяти есть один китаец безрамной конструкции, у которого самая длинная ось была безрамной — ее функция была переложена на стол. Естественно, станок был крайне слабым.

Направляющие

Для озвученных размеров подойдет станок на круглых направляющих 16-21 мм.
вообще, эмпирическое правило для заявленных целей «длина-направляющие»:
<15см — 12мм круглые
15-40 см — 16 мм круглые
40-90 см — 22 мм круглые с основанием

Механика

Поскольку мы заявили цветмет в целях использования, передача усилия с моторов на ось должна быть достаточно жесткой. Потому — долой ремни, да здравствуют ШВП и винты. ШВП — это шарико-винтовая передача, фактически — тот же винт, только канавки резьбы полированы и гайка представляет собой шариковый подшипник. ШВП имеет значительно более плавный ход, выше точность и надежность. Так что винт, пожалуй, допустим только на оси Z, которая по определению менее подвижная, чем остальные.
Передача усилия с моторов на винты для наших задач не критична — достаточную жесткость обеспечивает и ременная передача, и редуктор и муфты. Опять же главное — чтобы между мотором и винтом было что-то, компенсирующее биение оси и резкие усилия в начале движения, а то китайцы в целях экономии могут и напрямую шаговик прикрутить к винту, что отрицательно скажется на продолжительности жизни моторчика.

Моторы

В хоббийном сегменте однозначно рулят шаговые двигатели, они же шаговики. Причем для заявленных целей вполне достаточно фактически любого современного движка, начиная от 42/48 с усилием 5,5 кгсм. Из дополнительных плюшек, предлагаемых станкостроителями можно отметить рукоятки на оси, энкодеры, и прочее — в наших задачах это некритично.

Электроника

Поскольку мы рассматриваем покупку готового станка, предположим, что драйверы и блок питания соответствуют установленным двигателям. Имеет смысл разве что отметить наличие управления шпинделем с ЧПУ — некоторые китайцы экономят на частотнике.

Стол

Стол должен быть. Поскольку во многом точность детали определяется жесткостью крепления, стол должен быть жестким. А дальше — пошли вариации. Китайцы в свои станки любят ставить столы из конструкционного профиля с Т-образными пазами — достаточно удобно и универсально, но не очень жестко. Гораздо лучше — плита с сеткой отверстий с резьбой. Наиболее универсально, но дорого и замороченно в эксплуатации — вакуумный стол.

Плюшки и дополнения

Важным подспорьем являются концевые датчики на всех осях и датчик нуля оси Z.
Специфические дополнения — дополнительная (вращающаяся) ось, DSP контроллер, датчик положения, щуп, энкодеры, специальные зажимы и т.д., но все это, пожалуй, уже выходит за рамки статьи для начинающих.

Интерфейс и ПО

Поскольку мы говорим о фрезерах низшей ценовой категории на шаговых двигателях без энкодеров, штатный интерфейс будет в лучшем случае слегка кастомизированным PCI-LPT контроллером с опторазвязкой, в худшем — просто кабелем к LPT порту компьютера. По-моему, примерно один черт, по крайней мере я не заметил разницы в работе.
Программное обеспечение разнообразно, но функционально сводится либо к простому интерпретатору G-code в сигналы драйверов шаговых двигателей, либо к более продвинутому эмулятору стойки управления станка. В любом случае, если штатная программа не удовлетворяет, можно немножко помучиться и состыковать станок с LinuxCNC, который по функционалу и удобству не уступает продвинутым фирменным решениям.

Пожалуй, на этом статью можно и завершить, будут вопросы/пожелания/дополнения — велкам в комментарии и ЛС.

В следующей части — обзор режущего инструмента, крепеж, аспирация, СОЖ в домашних условиях.
',
                'category' => '3D-принтеры',
                'tags' => array('фрезерование', 'ЧПУ', 'CNC')

            ),
            array
            (

                'tittle' => 'Монолог инкогнито с одной айтишной конференции',
                'content' => 'Disclaimer. Монолог ниже является стенограммой выступления одного из докладчиков на одной из айтишных конференций. Автор поста всего лишь публикует его здесь с разрешения докладчика.

Всем привет!

В программе мероприятий вам обещали инкогнито долларового миллионера. Увы, он отбыл на воды в Баден-Баден лечить переговорную печень и пришлось затыкать дыру кем попало.

Меня зовут Сергей. Чтобы сказать про себя «я плохой докладчик», нужно хотя бы им, докладчиком, быть. Я вообще не оно. Свою первую и одну из последних презентаций я провел в 18 лет в Испании, перед аудиторией человек в 100. Мой весьма средний на тот момент английский синхронно переводили на испанский, народ зевал и почесывал репы, ожидая когда ЭТО недоразумение закончит блеять и объявится кофебрейк.

Сказать что мне было стыдно — это ничего не сказать, красный как рак, я свалил вторым выходом, забился в свой номер и боялся показаться на глаза. Всякие public professionals типа Карнеги сказали бы «позор!» и «never again!». Для себя я решил — все что угодно, хоть жигулевское пиво по пятницам, только не публичные экзекуции

К чему это я? Многие, глядя на ИТшников, путают скромность со стеснительностью. Да и фиг с ними. Главное — чтобы мы сами не путали. Я — стеснительный, поэтому буду смотреть в пол и читать по бумажке. Я бы выпил, конечно, для смелости, граммчиков сто (а лучше сто пятьдесят), но организаторы запретили. Ну что, пусть фигово, зато честно!

Я владелец компании П, в которой мы уже лет 13 или 14 занимаемся разработкой всякой фигни, про которую никто не слышал. Не имея таланта делать что-то красивое и эстетичное, мы довольствуемся подводной частью айсберга: софт-свитчи и клиенты для IP-телефонии, аппаратно-программные решения для высоконагруженных систем обработки контента, системы имперсонализации web и e-mail для виртуального присутствия, облачное видеонаблюдение, несколько справочных и торговых интернет-порталов, ну и еще пара проектов в стадии стартапа, говорить о которых рано, потому что стыдно

Все о чем собираюсь сказать, основано исключительно на личном опыте, относится к маленьким компаниям и совершенно не обязано работать в больших, хотя иногда бывает. За 25 лет, отданных айти-бизнесу, я умудрился побывать в разных шкурах, от техника, подносящего кофе джуниор девелоперам, до владельца компаний, которому не надо вставать в 8. Посредине между этими сомнительными гранями было, наверное, два главных увлечения — язык Си и темное ирландское пиво. Увы, и то и другое со временем пришлось сильно урезать.


Сначала — о количестве. Поработав в Microsoft и отказавшись после собеседования от довольно высоких должностей в российском офисе SAP и головном Google, я окончательно убедился, что работа в большим командах — это не мое. Я против сложных иерархических подчинений глубиной больше одного, я не люблю подковерные игры под девизом «хочешь место товарища — подсиди его», я хочу знать как зовут всех моих коллег и чем они живут. В общем, я хочу ходить на работу с удовольствием, ведь это большая часть моей жизни и провести ее нужно с комфортом. В нашей компании всего 10 человек, и, думаю, многие в зале ухмыльнутся — мелочь. Ну и фигня, нам хватает.

Мотивационные взаимоотношения программистов и начальников в новейшей истории закладывались до середины 90-х, когда мы были ботанами в очочках, примерно с такого анекдота:

Вызывает начальник зама:
— так! завтра переезд! не забудьте кроме столов и компьютеров собрать всякую фигню
— какую фигню?
— ну там, чайники, провода, программистов…

Особого недостатка в компьютерщиках не было, основные интересы потребителей лежали в рамках текстовых редакторов и игр, программистов воспринимали инопланетянами, причем в худшем смысле слова. И это время следует признать периодом упадка для айтизма. Мотивация — нулевая. Зато это было время, когда в ВУЗах еще учили этой профессии и довольно неплохо. Когда не было хелпов, гуглов и приходилось думать, пробовать и анализировать, чтобы решить проблему, проводя ночи на кофе с майонезом. А не уходить попить чайку, когда в офисе отключили интернет и вся база знаний стала недоступна.

В течение 90-х годов произошел очень примечательный процесс, благодаря которому вы все сейчас находитесь в топе наемных зарплат, покупаете себе импортное пиво и морские пляжи, а также снисходительно смотрите на офисный планктон, работающий за 10-ку в месяц. А тогда огромное количество талантливых программистов уехало в США, Израиль, Великобританию и Канаду. Кто не свалил — массово переходили в другие профессии, не имея возможности прокормить семью. В профессии осталось две категории людей: тупые, которые никому не нужны, и убежденные, которые на самом деле тоже тупые — валить надо было пока дыра в матрице открыта! Первые, да простят мне опять же терминологию и собственное субъективное мнение, впоследствии трудоустроились погромистами-онанистами в хлебном 1С-поле, да и вторые тоже не бедствуют.

Если вы родились позже 85-го года, вашей заслуги в этом IT-буме нет. Не надувайте щеки, не важничайте, просто получайте, растите и наслаждайтесь. И помните, что история циклична. Экономика и общество всегда, пусть и с запозданием, реагируют на подобные возмущения и восстанавливают статус-кво.

Я считаю, что прежде чем разглагольствовать о том, какие бывают мотивации и чем они плохи или хороши, нужно сказать почему они вообще нужны. С точки зрения экономики айти-бизнеса и его процессов люди — основной капитал. И вовсе не потому, что они уникальны и незаменимы, а потому что оплата их труда составляет до 90% всех затрат. Все остальное — мелочи. Избегая загаженного слова «команда», каждый владелец понимает, что сила его компании — в способности поддерживать и организовывать эффективную группу коллег.

Это процесс непростой, мы встречаемся каждый день в одном офисе не потому, что ходили в один садик и дружили в школе, а потому что делаем одну работу. Для того, чтобы все не переругались и не разбежались, а довольные работали максимально долго, применяются разнообразные схемы поощрения и социализации.

Самая популярная из них — премиальная. Как было у Высоцкого — «накрылась премия в квартал». Штука хорошая — плюсом к зарплате еще и добавку можно получить. Не важно — раз в месяц, квартал или год, суть схемы не меняется. Наиболее ярким примером является «13-я зарплата» — понятие, лишенное сути и смысла. Минус этой схемы один: а кто решает премировать или штрафовать, и на сколько? тут явно не будет справедливости, и на первый план встанет умение не выполнить свою работу, а продемонстрировать ее, не быть а слыть. В Москве это называют «добиться успеха». В этой схеме работают все крупные компании России, и думаю мы все неплохо наслышаны об уровне их эффективности.

Плавно вытекающая из предыдущей — мотивация «работа в большой компании». 80% опрошенных предпочтут работать в Лукойле, а не в маленьком эффективном ООО. Эти люди искренне считают, что работа в такой компании надежнее, оплачивается выше и смотрится престижнее. На поверку все это обычное заблуждение: нельзя отождествлять надежность самой компании со своим нахождением в ней. Зарплаты среднего звена разработчиков в крупняке уже давно не конкурентны, Отдельно хочется прогуляться по престижности: национальное советское чувство — круто! А если убрать дешевые понты, в чем крутость? Писать код на морально обедневших 4GL-языках? Участвовать в бесконечных и безумно полезных совещаниях? Носить костюм заданного цвета? Лишаться премии за 5-минутное опоздание? Знать и чувствовать, что за тобой наблюдают видеокамеры, даже в туалетах? Посещать прекрасные курсы какого-нибудь хаббардизма в корпоративном университете, где с помощью НЛП из вашего и без того нежного ботанического сознания сделают растениеводческое?

Самая главная беда крупных компаний для айтишников – либо ты, играя по корпоративным правилам «лизни – подсиди – похвались» вырастешь в ней до функционера, либо она тебя выплюнет и устроиться будет непросто. Коротко: из маленькой в большую можно, обратно – шиш. Как с 1С: программист может стать 1Сником, обратно – никогда.

Ладно, перейдем к более прогрессивным методам мотивации. Следующая схема вышла на лидирующий план с тех пор, как зарплаты айтишников перешли уровень здравого смысла. Избалованные новые небожители лениво проглядывают ленты хантеров: куда, и главное ЧЕМ еще заманивают? Для сдерживания гонки зарплат наиболее крупные столичные работодатели договариваются не переманивать спецов друг и друга, чтобы не загонять себя в угол с каждым новым витком зарплатной спирали.

Найм жилья, дисконт-программы по крупным ритейлерам, групповые походы в бассейн, достраивание этажа под тренажерный зал, путевки в санаторий, бесплатные пироженки под веселый треп отдыхающих коллег и прочие комплиментарные удовольствия. Совместный team building, делающий из вас стадо овец, с прекрасным «а что сегодня ты сделал для своей компании?». Ребята, это не ваша компания, компания принадлежит собственникам и ничего не делает бесплатно. А если вам больше 25 и вас все еще нужно за ручку водить в бассейн и в столовую, подбирая вам друзей на час и на день, то вам в пору задуматься, как в известном фильме: «раньше мне родители что-то запрещали, теперь жена. И когда же я вырасту?!». Вы айтишник и для уверенного пути в гору должны быть способны к самоорганизации, зная и трезво оценивая свои возможности.

Для более самостоятельных индивидов есть схема «будешь с нами акционером, друх!», при которой ключевым сотрудникам раздают небольшие пакетики акций. Пакетики эти напоминают пилюли «непиздина»: избранным друзьям вы будете доверительно сообщать, что вы не просто там хрен с горы, вы совладелец компании! Но тут, как водится, есть один нюанс, который американский писатель О’Генри поведал в рассказе о торговле земельными участками на дне озера. Если для принятия ключевых решений в компании необходимо 51% голосов, то счастливые и ключевые могут получить до 49%, теоретически владея почти половиной компании. Это один из самых весомых способов привязать человека к бизнесу. Однако следует помнить закон об обществах, по которому фактически вы не владеете ни чем. Активы общества могут быть выведены без вашего ведома (как недвижимые, так и договорные), решения о выплате дивидендов тоже принимаются без вас. Владелец не может рисковать потерять свою компанию, и предпримет меры предосторожности. Если же вы это прекрасно понимаете, то не пора ли самом стать работодателем?

Очевидно, что все эти схемы не есть эволюция от плохих к хорошим, они существуют параллельно и с разных успехом применяются в разных комбинациях в разных компаниях.

Возможно, кто-то обидится на терминологию, но стоит все же абстрагироваться (а вы это явно должны уметь) и воспринять суть. Вопрос взаимоотношений хозяев и рабов нужно максимально упростить. Что должен хозяин: платить в срок оговоренное вознаграждение и предоставлять приемлемые условия труда. Что должен раб: выполнять свою работу качественно и вовремя, а также четко появляться на рабочем месте в оговоренные временные окна. Что еще должны стороны друг другу — только одно и взаимное: не компостировать мозги. Больше никто никому ничего не должен, и не надо лукавить, все пресловутые социальные ответственности бизнеса есть плод фантазии безграмотных экономистов и управленцев невысокого роста, которые были опровергнуты товарищем Марксом еще в позапрошлом веке.

Ну и в конце хочу упомянуть наиболее симпатичный мне, но все еще не работающий метод мотивации: наемнику нужно просто платить адекватную фиксированную зарплату. Раз в год вместе с ним ее пересматривать: не тянет — снижать, блещет — увеличивать. Этот подход позволяет человеку четко представлять, сколько денег он получит и когда, чтобы вовремя платить по своим обязательствам и знать, какие обязательства он может себе позволить.

Почему так? Да потому, что нормальному, гармоничному человеку не надо ни навязывать, ни указывать с кем ходить в бассейн, не надо заставлять вязать узелки и кричать хором всякий бред на тренингах командного духа. Этот дух будет протухшим. Странно — мы доверяем современному девелоперу разработку сложных систем в линейных командах, но не считаем его достаточно самостоятельным, чтобы решить куда и как тратить заработанное. И продолжаем сами оплачивать ему талоны на обед и путевки в усть-качку. А доверять надо — без доверия коллегам бизнес не будет успешным.

У меня все. Спасибо за ваше время и внимание!',
                'category' => 'История ИТ',
                'tags' => array('история', 'люди')
            ),
            array
            (
                'tittle' => 'Встречайте Intel Edison — компьютер размером с SD-карту',
                'content' => 'Сегодня, на выставке CES 2014 Intel представил двухядерный компьютер размером с SD-карту со встроенным WiFi и Bluetooth на представленной ранее Quark SoC. Кроме того, компьютер работает на ОС Linux и может конектиться к специальному app store.
Предполагается, что компьютер будет использоваться для разработких новых носимых устройств, и Intel не был бы Intel если бы не создал поощрительное соревнование по разработке таких устройств — «Make it Wearable» с призовым фондом в $1,3млн и $500,000 за первое место был обьявлен сразу же на выставке.',
                'category' => 'Железо',
                'tags' => array('intel', 'innovations', 'future')
            )

        );
        foreach ($articlesData as $articleData) {
            $article = new Article();
            $article->setTittle($articleData['tittle']);
            $article->setContent($articleData['content']);
            $tags = new ArrayCollection($articleData['tags']);
            $article->setTags($tags);
            $article->setCategory($articleData['category']);
            $manager->persist($article);
            $this->setReference($articleData['tittle'], $article);
        }
        $manager->flush();
    }
} 