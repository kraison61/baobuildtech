<?php

/**
 * เนื้อหาผลงานขนเศษปูน สุขุมวิท 24 (TH + EN)
 * Keyword TH: ขนเศษปูน กรุงเทพ, รับขนขยะไปทิ้ง, รถขนขยะเอกชน
 * Keyword EN: construction debris removal Bangkok, renovation debris removal, construction waste disposal
 *
 * @return array{
 *   slug: string,
 *   cover_image: string,
 *   completed_at: string,
 *   client_name: string,
 *   client_name_en: string,
 *   lat: float|null,
 *   lng: float|null,
 *   images: list<array{image_url: string, alt_text: string, width: int|null, height: int|null, sort_order: int}>,
 *   th: array<string, mixed>,
 *   en: array<string, mixed>,
 *   faqs: list<array{question: string, answer: string, question_en: string, answer_en: string, sort_order: int}>
 * }
 */
return static function (
    string $brand,
    string $phoneDisplay,
    string $phoneTel,
    string $lineId,
    string $lineUrl,
    string $imageBase,
    string $wastePath,
    string $breakerPath = '/works/excavator-breaker-pc30-siam-square',
): array {
    $lineLabel = $lineId !== '' ? $lineId : 'LINE OA';
    $img = static fn (string $file): string => rtrim($imageBase, '/').'/'.$file;

    $imgBags = $img('2059838.webp');
    $imgTruck = $img('2059791_0.webp');

    $altBagsTh = 'กระสอบเศษปูน เศษสี และเศษฝ้าจากงานรีโนเวทรอขนทิ้ง ซอยสุขุมวิท 24 กรุงเทพ';
    $altTruckTh = 'รถหกล้อ 3 คิวบรรทุกเศษวัสดุก่อสร้างเต็มคัน งานขนเศษปูน สุขุมวิท 24 กรุงเทพ';
    $altBagsEn = 'Sacks of concrete rubble, painted debris, and ceiling board from a renovation awaiting haul-away — Soi Sukhumvit 24, Bangkok';
    $altTruckEn = '6-wheel 3 cu.m dump truck fully loaded with renovation debris — construction debris removal Bangkok, Sukhumvit 24';

    $contentTh = <<<HTML
<p><em>โดย ทีมงาน {$brand} • เผยแพร่ 20 พฤศจิกายน 2569 • อัปเดตล่าสุด 21 พฤศจิกายน 2569</em></p>
<p><a href="{$lineUrl}" target="_blank" rel="noopener noreferrer">ส่งรูปกองเศษทาง LINE ({$lineLabel})</a> · <a href="tel:{$phoneTel}">โทร {$phoneDisplay}</a></p>

<p>{$brand} รับงาน<strong>ขนเศษปูน กรุงเทพ</strong> ย่านสุขุมวิท 24 เขตคลองเตย เคลียร์เศษปูน เศษสี และเศษฝ้าจากงานปรับปรุง–รีโนเวทของลูกค้าชาวญี่ปุ่น ปริมาณหลายกระสอบเต็มรถหกล้อ 3 คิว 1 เที่ยว ทีมคนขับ 1 คน + คนงาน 1 คน เข้างาน 09:00 เสร็จ 10:30 รวมประมาณ 1.5 ชั่วโมง แล้วนำไปทิ้งบ่อขยะฝั่งตะวันออกที่รับเศษก่อสร้างได้</p>
<p>ดูขอบเขตบริการหลักที่ <a href="{$wastePath}">รับขนขยะก่อสร้าง เศษปูน</a></p>

<h2>สรุปงานขนเศษปูน สุขุมวิท 24</h2>
<div>
<table>
<thead>
<tr><th>รายการ</th><th>รายละเอียด</th></tr>
</thead>
<tbody>
<tr><td>สถานที่</td><td>ซอยสุขุมวิท 24 แขวงคลองตัน เขตคลองเตย กรุงเทพฯ (ใกล้ BTS พร้อมพงษ์)</td></tr>
<tr><td>ลูกค้า</td><td>ชาวญี่ปุ่น</td></tr>
<tr><td>ที่มาของเศษวัสดุ</td><td>เกิดจากการปรับปรุง รีโนเวท</td></tr>
<tr><td>ชนิดเศษ</td><td>เศษปูน · เศษสี · เศษฝ้า</td></tr>
<tr><td>ปริมาณ</td><td>หลายกระสอบ เต็ม 1 คันรถหกล้อ 3 คิว</td></tr>
<tr><td>รถที่ใช้</td><td>รถหกล้อ 3 คิว 1 เที่ยว</td></tr>
<tr><td>ทีมงาน</td><td>คนขับ 1 คน · คนงาน 1 คน</td></tr>
<tr><td>ระยะเวลา</td><td>1 วัน — เข้างาน 09:00 เสร็จ 10:30 (ประมาณ 1.5 ชั่วโมง)</td></tr>
<tr><td>ปลายทาง</td><td>บ่อขยะฝั่งตะวันออก ที่รับเศษวัสดุก่อสร้างได้</td></tr>
</tbody>
</table>
</div>
<figure>
<img src="{$imgBags}" alt="{$altBagsTh}" width="1600" height="1200" fetchpriority="high" decoding="async">
<figcaption>กระสอบเศษปูน เศษสี และเศษฝ้าจากงานรีโนเวท รอขนทิ้งที่ซอยสุขุมวิท 24</figcaption>
</figure>

<h2>โจทย์ของงานนี้คืออะไร</h2>
<p>งานนี้ยากเพราะ<strong>พื้นที่และการจราจร</strong>มากกว่าปริมาณเศษ ซอยสุขุมวิท 24 เป็นย่านที่พักอาศัยและคอนโดที่รถหนาแน่นทั้งวัน มีรถจอดริมทาง และเป็นทางผ่านไปห้าง ถ้าจอดรถขนขยะผิดจุดหรือผิดเวลา เพื่อนบ้านจะร้องเรียน และนิติบุคคลอาจสั่งหยุดงานได้</p>
<p>ข้อจำกัดที่ทีมวางแผนรับมือ:</p>
<ul>
<li><strong>หน้าบ้านจอดรถได้ไม่นาน</strong> — ต้องขนขึ้นรถให้เร็ว แล้วออกจากซอยทันที</li>
<li><strong>เศษบรรจุกระสอบไว้แล้ว</strong> — ช่วยลดเวลาและฝุ่น เหมาะกับทีมเล็กคนขับ 1 + คนงาน 1</li>
<li><strong>ฝุ่นและเสียง</strong> — ต้องไม่รบกวนบ้านข้างเคียงในช่วงเช้า</li>
<li><strong>ลูกค้าต้องการพื้นที่ว่างทันที</strong> — เพื่อให้ช่างเข้าทำงานรีโนเวทต่อได้ในวันเดียวกัน</li>
</ul>

<h2>ขนเศษปูนในซอยแคบย่านสุขุมวิท ใช้รถขนขยะขนาดไหน</h2>
<p>ซอยย่อยในสุขุมวิทส่วนใหญ่เหมาะกับ<strong>รถกระบะ 4 ล้อหรือรถหกล้อ</strong>มากกว่า 10 ล้อ เพราะกลับรถและจอดได้ง่ายกว่า งานนี้ใช้<strong>รถหกล้อ 3 คิว</strong> เพราะปริมาณหลายกระสอบพอดี 1 เที่ยว และซอยกว้างพอให้รถหกล้อจอดชิดขอบได้โดยไม่ต้องวิ่งหลายรอบ</p>
<div>
<table>
<thead>
<tr><th>ขนาดรถขนขยะ</th><th>เหมาะกับงาน</th><th>ข้อดี</th><th>ข้อจำกัด</th></tr>
</thead>
<tbody>
<tr><td>กระบะ 4 ล้อ</td><td>เศษจากห้องน้ำ 1 ห้อง / รีโนเวทห้องเล็ก</td><td>เข้าซอยแคบได้ จอดง่าย</td><td>ต้องวิ่งหลายเที่ยวถ้าเศษเยอะ</td></tr>
<tr><td>รถหกล้อ 3–7 คิว</td><td>รีโนเวททั้งชั้น / ทาวน์โฮม / ตึกแถว</td><td>ขนได้ทีละมาก คุ้มต่อเที่ยว</td><td>อาจติดข้อห้ามเวลาเดินรถในบางพื้นที่</td></tr>
<tr><td>รถ 10 ล้อ</td><td>งานรื้อถอนทั้งหลัง / ไซต์ก่อสร้างใหญ่</td><td>ต้นทุนต่อคิวต่ำสุด</td><td>เข้าซอยย่อยในเมืองได้ยาก</td></tr>
</tbody>
</table>
</div>

<h2>รถบรรทุกขนขยะวิ่งในกรุงเทพช่วงไหนได้บ้าง</h2>
<p><strong>รถบรรทุกหกล้อขึ้นไปมีข้อห้ามเดินรถบนถนนหลายสายในกรุงเทพฯ ตามช่วงเวลา</strong> และในฤดูฝุ่น PM 2.5 กทม. เคยประกาศเขตมลพิษต่ำที่ห้ามรถบรรทุกหกล้อเข้าพื้นที่ชั้นในด้วย ก่อนเข้างานทุกครั้งเราจึงเช็คประกาศล่าสุดแล้วจัดเวลาเข้าออกให้ไม่ผิดข้อห้าม</p>
<p>สำหรับงานสุขุมวิท 24 เราเข้าหน้างานเวลา <strong>09:00 น.</strong> เลี่ยงชั่วโมงเร่งด่วนเช้าสุด และเคลียร์ออกจากพื้นที่ภายใน <strong>10:30 น.</strong> รวมเวลาบนหน้างานประมาณ 1.5 ชั่วโมง — เศษบรรจุกระสอบไว้แล้วจึงขนขึ้นรถหกล้อ 3 คิวได้ครบในเที่ยวเดียว</p>

<h2>ขั้นตอนการทำงานขนเศษปูน สุขุมวิท 24</h2>
<ol>
<li><strong>ประเมินจากรูปทาง LINE</strong> — ลูกค้าส่งรูปกองกระสอบและหน้าซอยมา เราประเมินปริมาณ ขนาดรถ และแจ้งราคา</li>
<li><strong>ยืนยันราคาและนัดวันเวลา</strong> — แจ้งราคาตามเที่ยวรถหกล้อ 3 คิวพร้อมแรงงาน ไม่มีค่าใช้จ่ายเพิ่มถ้าปริมาณไม่เกินที่ตกลง</li>
<li><strong>เข้าขนและบรรทุก</strong> — คนขับ 1 + คนงาน 1 ยกกระสอบขึ้นรถ คลุมผ้าใบกันฝุ่นปลิว</li>
<li><strong>ทำความสะอาดหน้างาน</strong> — กวาดเศษที่ตกหล่นทั้งในบ้านและหน้าบ้าน</li>
<li><strong>ขนไปทิ้งบ่อขยะฝั่งตะวันออก</strong> — จุดรับทิ้งที่รับเศษวัสดุก่อสร้างได้ตามที่อนุญาต</li>
</ol>
<figure>
<img src="{$imgTruck}" alt="{$altTruckTh}" width="1600" height="1200" loading="lazy" decoding="async">
<figcaption>รถหกล้อ 3 คิวบรรทุกเศษปูน เศษสี และเศษฝ้าเต็มคัน ก่อนออกไปบ่อขยะฝั่งตะวันออก</figcaption>
</figure>

<h2>รับขนขยะไปทิ้ง ราคาเท่าไร คิดจากอะไร</h2>
<p><strong>ราคาขนเศษปูนในกรุงเทพคิดจาก 4 อย่างหลัก ได้แก่ ปริมาณเศษ ขนาดรถ จำนวนเที่ยว และความยากของหน้างาน</strong> เช่น ต้องแบกลงจากชั้นบน หรือซอยจอดรถได้จำกัด เราแจ้งราคาตามเที่ยวก่อนเริ่มงานทุกครั้ง ส่งรูปมาทาง LINE ได้ฟรี</p>
<div>
<table>
<thead>
<tr><th>ปัจจัย</th><th>ผลต่อราคา</th></tr>
</thead>
<tbody>
<tr><td>ปริมาณเศษ (ลบ.ม. / จำนวนกระสอบ)</td><td>ยิ่งมาก ยิ่งต้องใช้รถใหญ่หรือหลายเที่ยว</td></tr>
<tr><td>ขนาดรถขนขยะ</td><td>4 ล้อ / หกล้อ 3 คิว / หกล้อ 7 คิว ราคาต่อเที่ยวต่างกัน</td></tr>
<tr><td>ระยะไปจุดทิ้ง</td><td>ไกลขึ้น ค่าน้ำมันและเวลาเพิ่มขึ้น</td></tr>
<tr><td>แรงงานขนขึ้นรถ</td><td>ต้องแบกจากชั้นบน / เศษยังไม่บรรจุถุง = ค่าแรงเพิ่ม</td></tr>
<tr><td>ชนิดขยะปน</td><td>ถ้ามีเฟอร์นิเจอร์ ไม้ เหล็ก ปนมา อาจต้องแยกและคิดเพิ่ม</td></tr>
</tbody>
</table>
</div>
<p><strong>ราคาอ้างอิงรถหกล้อ 3 คิวของ {$brand}</strong> (ปรับตามค่าน้ำมัน — ยืนยันก่อนวันเข้าขน):</p>
<ul>
<li>รถหกล้อ 3 คิว: เริ่มต้น 800 บาท/เที่ยว</li>
<li>รถหกล้อ 3 คิว พร้อมแรงงาน: เริ่มต้น 1,400 บาท/เที่ยว</li>
<li>งานสุขุมวิท 24 นี้: ใช้รถหกล้อ 3 คิวพร้อมแรงงาน 1 เที่ยว — ส่งรูปมาทาง LINE เพื่อขอราคาหน้างานของคุณ</li>
</ul>

<h2>หารถเก็บขยะเอกชน รับขนขยะไปทิ้งใกล้ฉันในกรุงเทพ ต้องดูอะไรบ้าง</h2>
<p><strong>เลือกรถเก็บขยะเอกชนที่แจ้งราคาก่อนเริ่มงาน บอกได้ว่าเอาไปทิ้งที่ไหน และมีผลงานจริงในพื้นที่ใกล้คุณ</strong> เพราะเศษวัสดุก่อสร้างที่ถูกนำไปทิ้งในที่รกร้างหรือริมคลอง อาจทำให้เจ้าของงานมีปัญหาตามมาภายหลัง</p>
<p>เช็คลิสต์ก่อนจ้าง:</p>
<ul>
<li>แจ้งราคาตามเที่ยวเป็นลายลักษณ์อักษร (LINE หรือใบเสนอราคา)</li>
<li>บอกจุดทิ้งได้ชัดเจน — งานนี้ทิ้งบ่อขยะฝั่งตะวันออก</li>
<li>มีรูปหรือผลงานจริงในย่านเดียวกัน เช่น สุขุมวิท คลองเตย พร้อมพงษ์</li>
<li>มีทีมขนขึ้นรถให้ ไม่ใช่แค่ส่งรถมาจอด</li>
<li>ทำความสะอาดหน้างานหลังขนเสร็จ</li>
</ul>
<p>{$brand} ให้บริการรับขนขยะไปทิ้งทั่ว กทม. และปริมณฑล โดยเฉพาะย่านสุขุมวิท คลองเตย วัฒนา พระโขนง ปทุมธานี และนนทบุรี</p>

<h2>ผลลัพธ์ของงาน</h2>
<ul>
<li>เคลียร์เศษปูน เศษสี และเศษฝ้า ได้เต็มรถหกล้อ 3 คิว ภายในประมาณ 1.5 ชั่วโมง (09:00–10:30)</li>
<li>ช่างของลูกค้าเข้าทำงานรีโนเวทต่อได้ในวันเดียวกัน</li>
<li>จอดและขนเสร็จเร็ว ไม่ค้างซอยนาน — ลดโอกาสร้องเรียนจากเพื่อนบ้าน</li>
<li>นำไปทิ้งบ่อขยะฝั่งตะวันออกตามที่ตกลง ไม่มีค่าใช้จ่ายเพิ่มนอกใบเสนอราคา</li>
</ul>
<p>ถ้าพื้นเดิมเป็นคอนกรีตที่ต้องสกัดก่อนขนทิ้ง ดูตัวอย่างงาน <a href="{$breakerPath}">หัวแย็กแม็คโคร PC30 สกัดพื้นปูน สยามสแควร์</a></p>

<h2>บทเรียนจากหน้างานสุขุมวิท 24</h2>
<p>จากงานขนเศษปูนในย่านสุขุมวิทที่ผ่านมา เราพบว่าปัญหาที่ทำให้งานล่าช้าบ่อยที่สุดคือ<strong>เศษยังไม่ได้บรรจุถุง</strong> และ<strong>ไม่ได้แจ้งนิติบุคคลล่วงหน้า</strong> งานนี้ลูกค้าเตรียมกระสอบไว้ครบแล้ว ทีมเล็ก 2 คนจึงยกขึ้นรถหกล้อ 3 คิวได้ครบในเที่ยวเดียว และออกจากซอยภายใน 1.5 ชั่วโมง</p>
<p>ถ้าคุณกำลังรีโนเวทย่านสุขุมวิทหรือคลองเตย ให้ช่างใส่เศษในกระสอบไว้ และนัดเวลาจอดรถให้ชัด งานจะเร็วขึ้นและค่าแรงลดลงด้วย</p>

<h2>ส่งรูปกองเศษปูนมา รู้ราคาขนทิ้งเร็ว</h2>
<p>มีเศษปูน เศษฝ้า หรือขยะจากงานรีโนเวทในกรุงเทพที่ต้องการขนทิ้ง ถ่ายรูปกองเศษและหน้าซอยส่งมาทาง LINE เราประเมินขนาดรถและแจ้งราคาก่อนเริ่มงาน</p>
<p><strong>{$brand}</strong> · โทร <a href="tel:{$phoneTel}">{$phoneDisplay}</a> · LINE <a href="{$lineUrl}" target="_blank" rel="noopener noreferrer">{$lineLabel}</a></p>
<p>👉 ดูรายละเอียดบริการทั้งหมดที่หน้า <a href="{$wastePath}">ขนเศษปูน กรุงเทพ — รับขนขยะก่อสร้าง</a> · <a href="/works">ดูผลงานอื่น ๆ</a></p>
HTML;

    $contentEn = <<<HTML
<p><em>Written by the {$brand} hauling team • Published 20 November 2026 • Last updated 21 November 2026</em></p>
<p><a href="{$lineUrl}" target="_blank" rel="noopener noreferrer">Send debris photos via LINE ({$lineLabel})</a> · <a href="tel:{$phoneTel}">Call {$phoneDisplay}</a></p>

<p><strong>Construction debris removal in Bangkok</strong> — this {$brand} case study covers <strong>renovation debris removal</strong> on Soi Sukhumvit 24, Khlong Toei. For a Japanese client we cleared cement rubble, painted debris, and ceiling board packed in many sacks — a full load on one <strong>6-wheel 3 cu.m dump truck</strong>. Crew: 1 driver + 1 labourer. On site 09:00–10:30 (about 1.5 hours), then legal <strong>construction waste disposal</strong> at an eastern Bangkok dump that accepts construction debris.</p>
<p>Full service scope: <a href="{$wastePath}">construction waste hauling &amp; concrete debris removal</a>.</p>

<h2>Project summary — renovation debris removal, Sukhumvit 24</h2>
<div>
<table>
<thead>
<tr><th>Item</th><th>Detail</th></tr>
</thead>
<tbody>
<tr><td>Location</td><td>Soi Sukhumvit 24, Khlong Tan, Khlong Toei, Bangkok (near BTS Phrom Phong)</td></tr>
<tr><td>Client</td><td>Japanese client</td></tr>
<tr><td>Debris source</td><td>Home improvement / renovation</td></tr>
<tr><td>Debris types</td><td>Concrete rubble · painted debris · ceiling board / gypsum</td></tr>
<tr><td>Volume</td><td>Many sacks — full 6-wheel 3 cu.m truck (1 trip)</td></tr>
<tr><td>Truck</td><td>6-wheel dump truck, 3 cubic metres, 1 trip</td></tr>
<tr><td>Crew</td><td>1 driver · 1 labourer</td></tr>
<tr><td>Duration</td><td>1 day — 09:00 to 10:30 (≈ 1.5 hours on site)</td></tr>
<tr><td>Disposal</td><td>Licensed eastern Bangkok dump / landfill for construction waste</td></tr>
</tbody>
</table>
</div>
<figure>
<img src="{$imgBags}" alt="{$altBagsEn}" width="1600" height="1200" fetchpriority="high" decoding="async">
<figcaption>Sacks of concrete rubble and renovation debris ready for haul-away — Sukhumvit 24</figcaption>
</figure>

<h2>What made this job hard?</h2>
<p>The challenge was <strong>access and traffic</strong>, not sheer volume. Sukhumvit 24 is dense residential and condo traffic all day, with roadside parking and mall access. A waste truck parked too long — or at the wrong time — draws neighbour complaints and condo juristic office stop-work orders.</p>
<ul>
<li><strong>Short curb parking window</strong> — load fast, leave the soi quickly</li>
<li><strong>Debris already bagged</strong> — less dust, faster load for a 2-person crew</li>
<li><strong>Dust and noise control</strong> — morning window without disturbing neighbours</li>
<li><strong>Same-day clear space</strong> — so renovation trades could resume immediately</li>
</ul>

<h2>What size truck for construction debris removal in a narrow Sukhumvit soi?</h2>
<p>Most Sukhumvit side streets suit a <strong>pickup or 6-wheel dump truck</strong> better than a 10-wheeler. This job used a <strong>3 cu.m 6-wheel truck</strong>: one trip matched the sack volume, and the soi was wide enough to park at the curb without multiple runs.</p>
<div>
<table>
<thead>
<tr><th>Truck size</th><th>Best for</th><th>Pros</th><th>Limits</th></tr>
</thead>
<tbody>
<tr><td>4-wheel pickup</td><td>One bathroom / small room reno</td><td>Fits tight sois</td><td>Many trips if volume is high</td></tr>
<tr><td>6-wheel 3–7 cu.m</td><td>Floor reno / townhouse / shophouse</td><td>More load per trip</td><td>Time-of-day truck bans in some zones</td></tr>
<tr><td>10-wheel</td><td>Full demolition / large sites</td><td>Lowest cost per cu.m</td><td>Hard to enter inner-city sois</td></tr>
</tbody>
</table>
</div>

<h2>When can dump trucks run construction waste disposal in Bangkok?</h2>
<p><strong>Six-wheel and larger trucks face time-of-day restrictions on many Bangkok roads</strong>, and seasonal PM 2.5 low-emission zones have banned large trucks from inner districts. We check current notices before every job.</p>
<p>On Sukhumvit 24 we arrived at <strong>09:00</strong>, avoided the earliest rush, and cleared the curb by <strong>10:30</strong> — about 1.5 hours on site — because the renovation debris was already bagged for one full 3 cu.m load.</p>

<h2>How this construction debris removal job ran</h2>
<ol>
<li><strong>Photo quote on LINE</strong> — sacks + street access photos → truck size and trip estimate</li>
<li><strong>Confirm price and slot</strong> — per-trip rate for 6-wheel 3 cu.m with labour; no extras if volume matches the quote</li>
<li><strong>Load</strong> — driver + labourer lift sacks, tarp against dust</li>
<li><strong>Sweep the work area</strong> — indoor spill and curb cleanup</li>
<li><strong>Legal disposal</strong> — haul to an eastern Bangkok dump that accepts construction waste</li>
</ol>
<figure>
<img src="{$imgTruck}" alt="{$altTruckEn}" width="1600" height="1200" loading="lazy" decoding="async">
<figcaption>Full 3 cu.m load of concrete and renovation debris before disposal east of Bangkok</figcaption>
</figure>

<h2>Construction debris removal Bangkok price — what drives the quote?</h2>
<p><strong>Bangkok construction waste disposal pricing turns on volume, truck size, trips, and site difficulty</strong> (stairs, no lift, tight parking). We quote before work starts — send photos on LINE for a free estimate.</p>
<div>
<table>
<thead>
<tr><th>Factor</th><th>Effect on price</th></tr>
</thead>
<tbody>
<tr><td>Volume (cu.m / sack count)</td><td>More debris → larger truck or more trips</td></tr>
<tr><td>Truck size</td><td>Pickup vs 3 cu.m vs 7 cu.m 6-wheel rates differ</td></tr>
<tr><td>Haul distance to dump</td><td>Farther dumps raise fuel and time</td></tr>
<tr><td>Labour to load</td><td>Carry from upper floors / unbagged rubble costs more</td></tr>
<tr><td>Mixed waste</td><td>Furniture, timber, or steel may need sorting</td></tr>
</tbody>
</table>
</div>
<p><strong>{$brand} starting rates — 6-wheel 3 cu.m</strong> (fuel-adjusted; confirm before the haul day):</p>
<ul>
<li>6-wheel 3 cu.m truck only: from 800 THB/trip</li>
<li>6-wheel 3 cu.m with labour: from 1,400 THB/trip</li>
<li>This Sukhumvit 24 job: one 3 cu.m trip with labour — send your site photos for a quote</li>
</ul>

<h2>Hiring private junk removal / waste trucks near you in Bangkok</h2>
<p><strong>Pick a private waste truck that quotes in writing, names the dump, and shows real local jobs</strong>. Illegal roadside dumping of construction debris can create liability for the property owner.</p>
<ul>
<li>Written per-trip price (LINE or quotation)</li>
<li>Named disposal site — this job used an eastern Bangkok licensed dump</li>
<li>Proof of work in the same area (Sukhumvit, Khlong Toei, Phrom Phong)</li>
<li>Crew that loads — not just a parked truck</li>
<li>Site sweep after loading</li>
</ul>
<p>{$brand} provides construction debris removal and renovation waste haul-away across Bangkok and nearby provinces — especially Sukhumvit, Khlong Toei, Watthana, Phra Khanong, Pathum Thani, and Nonthaburi.</p>

<h2>Results</h2>
<ul>
<li>Cleared concrete rubble, painted debris, and ceiling board — full 3 cu.m load in ≈ 1.5 hours (09:00–10:30)</li>
<li>Renovation crew could resume the same day</li>
<li>Short curb time — lower neighbour-complaint risk</li>
<li>Legal eastern dump disposal; no surprise add-ons beyond the quote</li>
</ul>
<p>If the existing floor is concrete that must be broken before haul-away, see our <a href="{$breakerPath}">PC30 excavator with breaker case study at Siam Square</a>.</p>

<h2>Lesson from Sukhumvit 24</h2>
<p>On Sukhumvit debris jobs, the usual delays are <strong>unbagged rubble</strong> and <strong>no advance notice to the juristic office</strong>. Here the client had sacks ready, so a 2-person crew filled one 3 cu.m truck and left within 1.5 hours. Bag debris before haul day and lock a parking window — faster work, lower labour cost.</p>

<h2>Send photos — get a construction waste disposal quote fast</h2>
<p>Need construction debris removal or renovation junk removal in Bangkok? Photo the pile and the street access on LINE for a truck-size estimate and written quote.</p>
<p><strong>{$brand}</strong> · Call <a href="tel:{$phoneTel}">{$phoneDisplay}</a> · LINE <a href="{$lineUrl}" target="_blank" rel="noopener noreferrer">{$lineLabel}</a></p>
<p>👉 Full service: <a href="{$wastePath}">construction debris removal Bangkok</a> · <a href="/en/works">more project case studies</a></p>
HTML;

    return [
        'slug' => 'debris-removal-sukhumvit-24',
        'cover_image' => $imgBags,
        'completed_at' => '2026-11-20',
        'client_name' => 'ลูกค้าชาวญี่ปุ่น',
        'client_name_en' => 'Japanese client',
        'lat' => 13.73085,
        'lng' => 100.56965,
        'images' => [
            [
                'image_url' => $imgBags,
                'alt_text' => $altBagsTh,
                'width' => 1600,
                'height' => 1200,
                'sort_order' => 1,
            ],
            [
                'image_url' => $imgTruck,
                'alt_text' => $altTruckTh,
                'width' => 1600,
                'height' => 1200,
                'sort_order' => 2,
            ],
        ],
        'th' => [
            'title' => 'ขนเศษปูน กรุงเทพ — ผลงานสุขุมวิท 24 รถหกล้อ 3 คิว เคลียร์ใน 1.5 ชม.',
            'description' => 'ผลงานขนเศษปูน กรุงเทพ ย่านสุขุมวิท 24 เคลียร์เศษปูน เศษสี เศษฝ้าจากงานรีโนเวท ลูกค้าชาวญี่ปุ่น เต็มรถหกล้อ 3 คิว 1 เที่ยว เข้างาน 09:00 เสร็จ 10:30 ทิ้งบ่อขยะฝั่งตะวันออก',
            'meta_title' => 'ขนเศษปูน กรุงเทพ ผลงานสุขุมวิท 24 รถขนขยะเอกชน | BOA',
            'meta_description' => 'ผลงานขนเศษปูน กรุงเทพ ย่านสุขุมวิท 24 เคลียร์เศษปูน สี ฝ้า จากงานรีโนเวท ด้วยรถหกล้อ 3 คิว ทิ้งถูกที่ แจ้งราคาก่อนเริ่มงาน ส่งรูปทาง LINE รู้ราคาเร็ว',
            'content' => $contentTh,
        ],
        'en' => [
            'title_en' => 'Construction Debris Removal Bangkok — Sukhumvit 24 Renovation Waste Case Study',
            'description_en' => 'Construction debris removal in Bangkok: Sukhumvit 24 renovation cleared concrete rubble, painted debris, and ceiling board — full 6-wheel 3 cu.m truck, 09:00–10:30, legal eastern dump disposal. Japanese client.',
            'meta_title_en' => 'Construction Debris Removal Bangkok | Sukhumvit 24 Case Study',
            'meta_description_en' => 'Renovation debris removal Bangkok: Sukhumvit 24 job — concrete rubble, paint debris, ceiling board. One 6-wheel 3 cu.m trip, 1.5 hrs on site, legal dump. Free LINE quote. Call '.$phoneDisplay,
            'content_en' => $contentEn,
        ],
        'faqs' => [
            [
                'question' => 'ขนเศษปูน กรุงเทพ ราคาเท่าไร?',
                'answer' => 'ราคาขนเศษปูนในกรุงเทพขึ้นกับปริมาณเศษ ขนาดรถ จำนวนเที่ยว และความยากของหน้างาน เช่น ต้องแบกลงจากชั้นบนหรือซอยจอดรถได้จำกัด รถหกล้อ 3 คิวของ '.$brand.' เริ่มต้น 800 บาท/เที่ยว หรือ 1,400 บาท/เที่ยวพร้อมแรงงาน ส่งรูปกองเศษมาทาง LINE '.$lineLabel.' เพื่อขอราคาได้ฟรี',
                'question_en' => 'How much does construction debris removal cost in Bangkok?',
                'answer_en' => 'Construction debris removal Bangkok pricing depends on volume, truck size, trips, and site difficulty (stairs, tight parking). '.$brand.' 6-wheel 3 cu.m trucks start from 800 THB/trip, or 1,400 THB/trip with labour. Send debris photos on LINE '.$lineLabel.' for a free quote.',
                'sort_order' => 1,
            ],
            [
                'question' => 'รถขนขยะเข้าซอยแคบได้ไหม?',
                'answer' => 'ได้ สำหรับซอยแคบเราใช้รถกระบะ 4 ล้อหรือรถหกล้อที่จอดและกลับรถได้ง่าย แล้วเพิ่มจำนวนเที่ยวแทนการใช้รถใหญ่ งานสุขุมวิท 24 ใช้รถหกล้อ 3 คิวเพราะซอยกว้างพอและปริมาณเศษพอดี 1 เที่ยว',
                'question_en' => 'Can a waste truck enter a narrow Sukhumvit soi?',
                'answer_en' => 'Yes. For tight sois we use a pickup or a 6-wheel truck that can park and turn, adding trips instead of forcing a 10-wheeler. On Sukhumvit 24 a 3 cu.m 6-wheel truck fit the curb and cleared the load in one trip.',
                'sort_order' => 2,
            ],
            [
                'question' => 'กทม. เก็บเศษปูนจากงานรีโนเวทให้ฟรีไหม?',
                'answer' => 'โครงการเก็บขยะชิ้นใหญ่ฟรีของ กทม. มุ่งรับของอย่างเฟอร์นิเจอร์ ที่นอน และสุขภัณฑ์เก่า เศษปูนและเศษฝ้าจากงานก่อสร้างหรือรีโนเวทปริมาณมากจึงมักต้องจ้างรถเก็บขยะเอกชนขนไปทิ้งยังจุดรับทิ้งที่ได้รับอนุญาต ควรสอบถามสำนักงานเขตในพื้นที่เพื่อยืนยันอีกครั้ง',
                'question_en' => 'Does Bangkok collect renovation debris for free?',
                'answer_en' => 'BMA bulky-item programs mainly cover furniture, mattresses, and old fixtures. Large volumes of concrete rubble and renovation debris usually need a private waste truck for legal construction waste disposal. Confirm with your district office first.',
                'sort_order' => 3,
            ],
            [
                'question' => 'เศษปูนที่ขนไปเอาไปทิ้งที่ไหน?',
                'answer' => 'เรานำเศษปูน เศษสี และเศษฝ้าไปทิ้งยังจุดรับทิ้งที่ได้รับอนุญาตเท่านั้น งานสุขุมวิท 24 นี้ทิ้งที่บ่อขยะฝั่งตะวันออก ไม่ทิ้งในที่รกร้างหรือริมคลอง เพราะผิดกฎหมายและอาจทำให้เจ้าของงานมีปัญหาตามมา',
                'question_en' => 'Where does the construction debris go?',
                'answer_en' => 'We haul only to dumps that accept construction waste. This Sukhumvit 24 job went to a licensed eastern Bangkok dump — never vacant lots or canals, which is illegal and can create liability for the property owner.',
                'sort_order' => 4,
            ],
            [
                'question' => 'ขนเศษปูนใช้เวลานานไหม?',
                'answer' => 'งานรีโนเวทบ้านหรือทาวน์โฮมทั่วไปส่วนใหญ่ขนเสร็จภายใน 1 วัน งานสุขุมวิท 24 นี้เศษบรรจุกระสอบไว้แล้ว ใช้ทีมคนขับ 1 + คนงาน 1 ขนเต็มรถหกล้อ 3 คิวเสร็จในประมาณ 1.5 ชั่วโมง (09:00–10:30)',
                'question_en' => 'How long does renovation debris removal take?',
                'answer_en' => 'Most house or townhouse reno loads finish within one day. On this Sukhumvit 24 job, bagged debris let a 2-person crew fill one 3 cu.m truck in about 1.5 hours (09:00–10:30).',
                'sort_order' => 5,
            ],
            [
                'question' => 'ต้องเตรียมอะไรก่อนให้มาขนเศษปูน?',
                'answer' => 'ให้ช่างบรรจุเศษปูนในกระสอบ แยกขยะชนิดอื่นออก แจ้งนิติบุคคลหรือเพื่อนบ้านเรื่องเวลาจอดรถ และส่งรูปกองเศษกับหน้าซอยมาให้ประเมิน การเตรียมเหล่านี้ช่วยลดเวลาทำงานและค่าแรงขนได้',
                'question_en' => 'What should I prepare before construction debris removal?',
                'answer_en' => 'Bag rubble in sacks, separate other waste types, notify the juristic office or neighbours about parking time, and send photos of the pile and street access. Prep cuts on-site time and labour cost — as on this Sukhumvit job.',
                'sort_order' => 6,
            ],
        ],
    ];
};
