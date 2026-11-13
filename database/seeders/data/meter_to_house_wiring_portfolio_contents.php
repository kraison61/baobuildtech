<?php

/**
 * เนื้อหาผลงานเดินสายไฟจากมิเตอร์เข้าบ้าน พหลโยธิน (TH + EN)
 * แหล่ง: main-electric SEO package — แบรนด์/โทร/LINE จาก config ตอน seeder
 *
 * @return array{
 *   slug: string,
 *   cover_image: string,
 *   completed_at: string,
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
    string $wiringPath,
): array {
    $lineLabel = $lineId !== '' ? $lineId : 'LINE OA';
    $img = static fn (string $file): string => rtrim($imageBase, '/').'/'.$file;

    $imgPole = $img('S__17309733_0.webp');
    $imgMeter = $img('S__17309738_0.webp');

    $altPoleTh = "ช่าง{$brand} ปีนเสาไฟฟ้าติดตั้งสายเมนเบอร์ 16 เดินสายไฟจากมิเตอร์เข้าบ้าน ซอยพหลโยธิน 24";
    $altMeterTh = "ช่างทำงานบนเสาไฟฟ้า ต่อสายเมนเบอร์ 16 ที่มิเตอร์ งานเดินสายไฟจากมิเตอร์เข้าบ้าน ซอยพหลโยธิน 24";
    $altPoleEn = "{$brand} technician climbing a utility pole to install 16 sq.mm main cable from meter to house — Soi Phahonyothin 24";
    $altMeterEn = "Technician working on a utility pole connecting 16 sq.mm main cable at the meter — Soi Phahonyothin 24";

    $contentTh = <<<HTML
<p><em>เขียนโดย ทีมช่างไฟฟ้า {$brand} • อัปเดตล่าสุด 13 พฤศจิกายน 2569</em></p>
<p><a href="{$lineUrl}" target="_blank" rel="noopener noreferrer">ส่งรูปมิเตอร์ทาง LINE ({$lineLabel})</a> · <a href="tel:{$phoneTel}">โทร {$phoneDisplay}</a></p>

<p>เดินสายไฟจากมิเตอร์เข้าบ้าน ราคาเริ่มต้นเมตรละ 125 บาท บวกค่าปีนเสาไฟฟ้า 2,850 บาทต่อรอบ คิดระยะตามหน้างานจริง นี่คือผลงานของ {$brand} ที่เดินสายเมน THW ขนาด 16 ตร.มม. จากมิเตอร์บนเสาไฟฟ้าเข้าตัวบ้าน 2 หลัง ในซอยพหลโยธิน 24 กรุงเทพฯ เราแยกราคาให้เห็นทุกบรรทัดก่อนเริ่มงาน และเลือกขนาดสายตามมาตรฐานการติดตั้งทางไฟฟ้าสำหรับประเทศไทย พ.ศ. 2564 (วสท.)</p>
<p>ดูขอบเขตบริการหลักที่ <a href="{$wiringPath}">บริการเดินสายไฟบ้านและอาคาร</a></p>

<h2>รายละเอียดผลงาน — เดินสายเมนเบอร์ 16 เข้าบ้าน ซอยพหลโยธิน 24</h2>
<div>
<table>
<thead>
<tr><th>หัวข้อ</th><th>รายละเอียด</th></tr>
</thead>
<tbody>
<tr><td>พื้นที่</td><td>ซอยพหลโยธิน 24 กรุงเทพฯ (เขต กฟน.)</td></tr>
<tr><td>ประเภทงาน</td><td>เดินสายเมนจากมิเตอร์ที่เสาไฟฟ้า เข้าตู้ไฟในบ้าน 2 หลัง</td></tr>
<tr><td>สายที่ใช้</td><td>THW (IEC01) ขนาด 16 ตร.มม. สายเฟส + นิวทรัล</td></tr>
<tr><td>ขนาดมิเตอร์</td><td>15(45)A 1 เฟส</td></tr>
<tr><td>หลังที่ 1</td><td>ระยะเดินสาย 9 เมตร · ใช้สายไฟ 18 เมตร</td></tr>
<tr><td>หลังที่ 2</td><td>ระยะเดินสาย 20 เมตร · ใช้สายไฟ 40 เมตร</td></tr>
<tr><td>ปีนเสา</td><td>คิดต่อรอบ (2,850 บาท/รอบ)</td></tr>
</tbody>
</table>
</div>
<p>หน้างานนี้เป็นบ้าน 2 หลังในซอยพหลโยธิน 24 มีมิเตอร์ติดบนเสาไฟฟ้า ทีมงานวัดระยะจริงต่อหน้าเจ้าของบ้าน จากขั้วมิเตอร์จนถึงเมนเบรกเกอร์ในตู้ของแต่ละหลัง แล้วเสนอราคาตามระยะนั้น ไม่เหมารวม หลังที่ 1 ระยะ 9 เมตร ใช้สายเฟส+นิวทรัลรวม 18 เมตร หลังที่ 2 ระยะ 20 เมตร ใช้สายรวม 40 เมตร เราใช้สาย 16 ตร.มม. เพราะรองรับมิเตอร์ 15(45)A ได้ทั้งแบบเดินลอยและร้อยท่อ และเผื่อกำลังไฟเมื่อบ้านติดแอร์หลายเครื่อง</p>
<figure>
<img src="{$imgPole}" alt="{$altPoleTh}" width="1200" height="1600" fetchpriority="high" decoding="async">
<figcaption>ช่างปีนเสาไฟฟ้าติดตั้งสายเมน THW 16 ตร.มม. หน้างานจริงซอยพหลโยธิน 24</figcaption>
</figure>

<h2>เดินสายไฟจากมิเตอร์เข้าบ้าน ราคาเท่าไหร่ คิดยังไง?</h2>
<p>ราคาเดินสายไฟจากมิเตอร์เข้าบ้านคิดจาก 2 ส่วน: ค่าเดินสายเมนเบอร์ 16 เริ่มต้นเมตรละ 125 บาท คูณระยะจริงที่วัดได้หน้างาน บวกค่าปีนเสาไฟฟ้า 2,850 บาทต่อรอบ ตัวอย่างจากงานซอยพหลโยธิน 24 — หลังที่ 1 ระยะ 9 เมตร ค่าเดินสายประมาณ 1,125 บาท หลังที่ 2 ระยะ 20 เมตร ประมาณ 2,500 บาท (ยังไม่รวมค่าปีนเสา)</p>
<p>สูตร: <strong>ราคา = (ระยะจริง × 125 บาท) + 2,850 บาท × จำนวนรอบที่ปีนเสา</strong></p>
<div>
<table>
<thead>
<tr><th>รายการ</th><th>ระยะ (ม.)</th><th>สายที่ใช้ (ม.)</th><th>ค่าเดินสาย (บาท)</th><th>ค่าปีนเสา 1 รอบ (บาท)</th><th>รวมประมาณ (บาท)</th></tr>
</thead>
<tbody>
<tr><td>ซอยพหลโยธิน 24 หลังที่ 1</td><td>9</td><td>18</td><td>1,125</td><td>2,850</td><td>3,975</td></tr>
<tr><td>ซอยพหลโยธิน 24 หลังที่ 2</td><td>20</td><td>40</td><td>2,500</td><td>2,850</td><td>5,350</td></tr>
<tr><td>ตัวอย่าง 30 ม.</td><td>30</td><td>—</td><td>3,750</td><td>2,850</td><td>6,600</td></tr>
<tr><td>ตัวอย่าง 50 ม.</td><td>50</td><td>—</td><td>6,250</td><td>2,850</td><td>9,100</td></tr>
</tbody>
</table>
</div>
<p>ตัวเลขนี้คือราคาเริ่มต้น สิ่งที่ทำให้ราคาจริงต่างกัน ได้แก่ เดินลอยหรือร้อยท่อ ต้องตั้งเสาพักสายเพิ่มไหม และต้องปีนเสามากกว่า 1 รอบหรือไม่ เราแจ้งทุกรายการไว้ในใบเสนอราคาก่อนลงมือ ไม่มีค่าใช้จ่ายงอกหน้างาน</p>

<h2>ค่าแรงดึงสายเมน เบอร์ 16 เมตรละกี่บาท?</h2>
<p>ค่าดึงสายเมนเบอร์ 16 ของ {$brand} เริ่มต้นเมตรละ 125 บาท คิดตามระยะจริง ไม่ปัดเศษเป็นเหมา ส่วนค่าปีนเสาไฟฟ้า 2,850 บาทต่อรอบแยกออกมา เพราะต้องใช้ช่างที่ผ่านงานบนที่สูง อุปกรณ์กันตก และเวลาเตรียมความปลอดภัยทุกครั้งที่ขึ้นเสา</p>
<p>ที่แยกราคาแบบนี้เพราะบ้านแต่ละหลังมีระยะต่างกันมาก งานซอยพหลโยธิน 24 เองก็มีทั้งหลังระยะ 9 เมตร และหลังระยะ 20 เมตร การคิดต่อเมตรทำให้เจ้าของบ้านตรวจสอบได้เองว่าจ่ายตามงานจริง ไม่ใช่ราคาเหมาที่บวกเผื่อไว้</p>
<figure>
<img src="{$imgMeter}" alt="{$altMeterTh}" width="1200" height="1600" loading="lazy" decoding="async">
<figcaption>ค่าปีนเสาไฟฟ้า 2,850 บาท/รอบ คือค่างานบนที่สูงแบบในภาพ</figcaption>
</figure>

<h2>สายไฟเมนเข้าบ้าน ใช้ขนาดเท่าไหร่?</h2>
<p>ขนาดสายเมนขึ้นกับขนาดมิเตอร์และโหลดของบ้าน มาตรฐานการติดตั้งทางไฟฟ้าสำหรับประเทศไทย พ.ศ. 2564 กำหนดให้ตัวนำประธานรับโหลดทั้งหมดได้ บ้านที่ใช้มิเตอร์ 15(45)A รองรับโหลดสูงสุด 30A และใช้เมนเบรกเกอร์ได้สูงสุด 50A ทีมเราจึงใช้สาย THW 16 ตร.มม. ซึ่งพอทั้งแบบเดินลอยและร้อยท่อ</p>
<div>
<table>
<thead>
<tr><th>ขนาดมิเตอร์ (1 เฟส)</th><th>โหลดสูงสุด</th><th>เมนเบรกเกอร์สูงสุด</th><th>สายเมนทองแดงที่ใช้ทั่วไป (ตร.มม.)</th><th>สายต่อหลักดินต่ำสุด</th></tr>
</thead>
<tbody>
<tr><td>5(15)A</td><td>10A</td><td>16A</td><td>4</td><td>10 ตร.มม.</td></tr>
<tr><td>15(45)A</td><td>30A</td><td>50A</td><td>10 เดินลอย / 16 ร้อยท่อ</td><td>10 ตร.มม.</td></tr>
<tr><td>30(100)A</td><td>75A</td><td>100A</td><td>25 เดินลอย / 50 ร้อยท่อ</td><td>10–16 ตร.มม.</td></tr>
</tbody>
</table>
</div>
<p>อ้างอิง: มาตรฐานการติดตั้งทางไฟฟ้าสำหรับประเทศไทย พ.ศ. 2564 (วสท. 022001-22) ข้อ 3.4 ตัวนำประธาน ตารางที่ 3-4 (เขต กฟน.) และตารางที่ 4-1 สายต่อหลักดิน ขนาดจริงต้องเลือกจากพิกัดกระแสตามวิธีติดตั้งและแรงดันตก</p>

<h2>มาตรฐานการเดินสายไฟเข้าบ้าน มีอะไรบ้าง?</h2>
<p>มาตรฐานการเดินสายไฟเข้าบ้านที่ใช้อ้างอิงในไทยคือ มาตรฐานการติดตั้งทางไฟฟ้าสำหรับประเทศไทย พ.ศ. 2564 ของวิศวกรรมสถานแห่งประเทศไทย (วสท.) หลักของงานสายเมนคือ สายต้องรับโหลดทั้งบ้านได้ เบรกเกอร์ต้องไม่เกินพิกัดตามขนาดมิเตอร์ และต้องต่อลงดินถูกต้อง ทีมเราทำตามข้อเหล่านี้:</p>
<ul>
<li><strong>ข้อ 3.4 ตัวนำประธาน</strong>: สายเมนต้องมีขนาดพอรับโหลดทั้งหมด และบ้านหนึ่งหลังมีตัวนำประธานได้ชุดเดียว (มีข้อยกเว้นตามมาตรฐาน)</li>
<li><strong>ตารางที่ 3-4 (เขต กฟน.)</strong>: เมนเบรกเกอร์ไม่เกินพิกัดตามขนาดมิเตอร์ เช่น ไม่เกิน 50A สำหรับมิเตอร์ 15(45)A</li>
<li><strong>ตารางที่ 4-1</strong>: สายต่อหลักดินไม่เล็กกว่าขนาดที่กำหนดตามขนาดสายเมน เช่น 10 ตร.มม. เมื่อสายเมนไม่เกิน 35 ตร.มม.</li>
<li><strong>ข้อ 5.1.11 สีสาย</strong>: สายเฟสสีน้ำตาล นิวทรัลสีฟ้า สายดินสีเขียวแถบเหลือง</li>
<li><strong>ชนิดสาย</strong>: เดินลอยใช้ IEC01 (THW) ยึดบนลูกถ้วย ส่วนฝังดินหรือเดินต่ำใช้สายมีเปลือก เช่น NYY ร้อยท่อ</li>
<li><strong>ขั้วต่อ</strong>: ใช้หางปลาแบบบีบหรือขันแน่นด้วยหมุดเกลียว สายใหญ่กว่า 6 ตร.มม. อย่างสายเบอร์ 16 ห้ามพันรอบหมุด</li>
</ul>

<h2>ขั้นตอนการเดินสายเมนจากเสาไฟฟ้าเข้าบ้าน</h2>
<p>งานเดินสายเมนบ้านทั่วไปมักเสร็จภายใน 1 วัน และมีช่วงต้องดับไฟเฉพาะตอนต่อสายที่มิเตอร์และตู้ไฟ ขั้นตอนที่เราทำที่ซอยพหลโยธิน 24:</p>
<ol>
<li>สำรวจหน้างาน ตรวจขนาดมิเตอร์ และวัดระยะจริงต่อหน้าเจ้าของบ้าน</li>
<li>ส่งใบเสนอราคาแยกบรรทัด: ค่าเดินสายต่อเมตร + ค่าปีนเสา + อุปกรณ์อื่น (ถ้ามี)</li>
<li>นัดวันทำงาน แจ้งช่วงดับไฟ และประสานการไฟฟ้าเมื่องานต้องปลดหรือต่อที่มิเตอร์</li>
<li>ปีนเสาพร้อมอุปกรณ์กันตก ต่อสายเข้าขั้วด้านโหลดของมิเตอร์ ยึดสายบนลูกถ้วย/แร็ค</li>
<li>ดึงสายเบอร์ 16 ตามแนว เดินลอยหรือร้อยท่อเข้าตัวบ้าน ต่อเข้าเมนเบรกเกอร์ในตู้</li>
<li>ตรวจขั้วต่อ วัดแรงดัน จ่ายไฟคืน และส่งมอบงานพร้อมรูปก่อน-หลัง</li>
</ol>

<h2>สัญญาณแบบไหน บอกว่าสายเมนเข้าบ้านควรเปลี่ยน?</h2>
<p>สายเมนควรเปลี่ยนเมื่อฉนวนเสื่อม มีไฟตกบ่อย หรือบ้านใช้ไฟมากขึ้นกว่าตอนเดินสายครั้งแรก สัญญาณที่ทีมเจอบ่อย:</p>
<ul>
<li>ฉนวนสายกรอบ แตก หรือลอกจนเห็นทองแดง</li>
<li>ไฟกระพริบหรือหรี่เวลาเปิดแอร์/เครื่องทำน้ำอุ่นพร้อมกัน</li>
<li>ขั้วต่อหรือเมนเบรกเกอร์ร้อน มีรอยไหม้ดำ</li>
<li>ขอเพิ่มขนาดมิเตอร์ เช่น จาก 5(15)A เป็น 15(45)A สายเดิมเล็กเกิน</li>
<li>สายหย่อนต่ำ พาดกิ่งไม้ หรือเกะกะรถสูง</li>
</ul>

<h2>ทำไมเจ้าของบ้านซอยพหลโยธิน 24 เลือก{$brand}</h2>
<ul>
<li><strong>ราคาโปร่งใส</strong>: แยกค่าเดินสาย 125 บาท/เมตร กับค่าปีนเสา 2,850 บาท/รอบ ให้เห็นชัด คิดตามระยะที่วัดต่อหน้าคุณ</li>
<li><strong>งานตามมาตรฐาน</strong>: เลือกขนาดสายและเบรกเกอร์ตามมาตรฐาน วสท. 2564 พร้อมส่งรูปก่อน-หลังทุกขั้น</li>
<li><strong>ไม่ทิ้งงาน</strong>: บริษัทจดทะเบียน มีหน้าร้านออนไลน์และเบอร์ติดต่อจริง รับประกันงานติดตั้ง</li>
</ul>
<p>นอกจากงานสายเมน เรารับงานเดินสายไฟภายใน สาย LAN ไฟเบอร์ออปติก และกล้องวงจรปิดในกรุงเทพฯ และปริมณฑล ดู<a href="/works">ผลงานเดินสายไฟอื่น ๆ</a></p>

<h2>ขอใบเสนอราคาเดินสายเมนเข้าบ้าน ประเมินหน้างานฟรี</h2>
<p>ส่งรูปมิเตอร์ รูปแนวสายจากเสาถึงบ้าน และระยะโดยประมาณมาทาง LINE เราตีราคาเบื้องต้นให้ก่อน แล้วนัดวัดระยะจริงที่หน้างาน</p>
<p><strong>{$brand}</strong> · โทร <a href="tel:{$phoneTel}">{$phoneDisplay}</a> · LINE <a href="{$lineUrl}" target="_blank" rel="noopener noreferrer">{$lineLabel}</a></p>
HTML;

    $contentEn = <<<HTML
<p><em>Written by the {$brand} electrical team • Last updated 13 November 2026</em></p>
<p><a href="{$lineUrl}" target="_blank" rel="noopener noreferrer">Send meter photos via LINE ({$lineLabel})</a> · <a href="tel:{$phoneTel}">Call {$phoneDisplay}</a></p>

<p>Meter-to-house main wiring starts at 125 THB per meter, plus 2,850 THB per pole-climb round, priced on the actual measured run. This is a {$brand} case study installing THW 16 sq.mm main cable from a pole-mounted meter into two homes in Soi Phahonyothin 24, Bangkok. We itemize every line before work starts and size cable to Thailand’s 2021 Electrical Installation Standard (EIT).</p>
<p>See the pillar page: <a href="{$wiringPath}">home and building electrical wiring</a>.</p>

<h2>Project details — 16 sq.mm main cable, Soi Phahonyothin 24</h2>
<div>
<table>
<thead>
<tr><th>Item</th><th>Detail</th></tr>
</thead>
<tbody>
<tr><td>Area</td><td>Soi Phahonyothin 24, Bangkok (MEA area)</td></tr>
<tr><td>Scope</td><td>Main cable from pole meter into house panels — 2 homes</td></tr>
<tr><td>Cable</td><td>THW (IEC01) 16 sq.mm phase + neutral</td></tr>
<tr><td>Meter</td><td>15(45)A single-phase</td></tr>
<tr><td>House 1</td><td>9 m run · 18 m cable used</td></tr>
<tr><td>House 2</td><td>20 m run · 40 m cable used</td></tr>
<tr><td>Pole climb</td><td>Per round (2,850 THB/round)</td></tr>
</tbody>
</table>
</div>
<p>Two homes in Soi Phahonyothin 24 share pole-mounted meters. We measured each run with the owner from the meter terminals to the main breaker, then quoted that distance — no lump-sum padding. House 1: 9 m run, 18 m of phase+neutral cable. House 2: 20 m run, 40 m of cable. We used 16 sq.mm because it supports a 15(45)A meter for both open and conduit runs and leaves headroom when several air conditioners are on.</p>
<figure>
<img src="{$imgPole}" alt="{$altPoleEn}" width="1200" height="1600" fetchpriority="high" decoding="async">
<figcaption>Technician installing THW 16 sq.mm main cable on the Soi Phahonyothin 24 job site</figcaption>
</figure>

<h2>How much does meter-to-house wiring cost?</h2>
<p>Pricing has two parts: 16 sq.mm main cable from 125 THB per measured meter, plus 2,850 THB per pole-climb round. From this job — house 1 (9 m) is about 1,125 THB for the run; house 2 (20 m) about 2,500 THB (climb fee separate).</p>
<p>Formula: <strong>price = (actual meters × 125 THB) + 2,850 THB × climb rounds</strong></p>
<div>
<table>
<thead>
<tr><th>Item</th><th>Run (m)</th><th>Cable used (m)</th><th>Cable fee (THB)</th><th>1 climb (THB)</th><th>Approx. total (THB)</th></tr>
</thead>
<tbody>
<tr><td>Soi Phahonyothin 24 — house 1</td><td>9</td><td>18</td><td>1,125</td><td>2,850</td><td>3,975</td></tr>
<tr><td>Soi Phahonyothin 24 — house 2</td><td>20</td><td>40</td><td>2,500</td><td>2,850</td><td>5,350</td></tr>
<tr><td>Example 30 m</td><td>30</td><td>—</td><td>3,750</td><td>2,850</td><td>6,600</td></tr>
<tr><td>Example 50 m</td><td>50</td><td>—</td><td>6,250</td><td>2,850</td><td>9,100</td></tr>
</tbody>
</table>
</div>
<p>These are starting rates. Open vs conduit, extra support poles, and extra climbs change the quote. Every line appears on the quotation before work begins.</p>

<h2>How much per meter for 16 sq.mm main cable labor?</h2>
<p>{$brand} prices 16 sq.mm main runs from 125 THB per measured meter — not a padded lump sum. Pole climb is separate at 2,850 THB per round for height work, fall protection, and safety setup. This Soi Phahonyothin 24 job had both a 9 m and a 20 m run, so per-meter pricing stays transparent.</p>
<figure>
<img src="{$imgMeter}" alt="{$altMeterEn}" width="1200" height="1600" loading="lazy" decoding="async">
<figcaption>The 2,850 THB/round pole-climb fee covers height work like this</figcaption>
</figure>

<h2>What main cable size should a house use?</h2>
<p>Size follows the meter and load. Under the 2021 Thai installation standard, a 15(45)A meter allows up to 30A load and a main breaker up to 50A. We use THW 16 sq.mm for both open and conduit installs.</p>
<div>
<table>
<thead>
<tr><th>Meter (1φ)</th><th>Max load</th><th>Max main breaker</th><th>Typical Cu main (sq.mm)</th><th>Min earth</th></tr>
</thead>
<tbody>
<tr><td>5(15)A</td><td>10A</td><td>16A</td><td>4</td><td>10 sq.mm</td></tr>
<tr><td>15(45)A</td><td>30A</td><td>50A</td><td>10 open / 16 conduit</td><td>10 sq.mm</td></tr>
<tr><td>30(100)A</td><td>75A</td><td>100A</td><td>25 open / 50 conduit</td><td>10–16 sq.mm</td></tr>
</tbody>
</table>
</div>

<h2>What standards apply to house main wiring?</h2>
<ul>
<li><strong>Clause 3.4 service conductors</strong>: sized for the full load; one service set per dwelling (with listed exceptions)</li>
<li><strong>Table 3-4 (MEA)</strong>: main breaker not above meter rating — e.g. 50A max for 15(45)A</li>
<li><strong>Table 4-1</strong>: earth conductor not smaller than required for the main size</li>
<li><strong>Clause 5.1.11 colors</strong>: brown phase, blue neutral, green/yellow earth</li>
<li><strong>Cable type</strong>: IEC01 (THW) on insulators for open runs; sheathed cable (e.g. NYY) in conduit for buried/low runs</li>
<li><strong>Terminators</strong>: crimped or bolted lugs — conductors over 6 sq.mm must not be wrapped around studs</li>
</ul>

<h2>Main cable installation steps</h2>
<ol>
<li>Survey the site, check meter size, measure the run with the owner</li>
<li>Issue a line-item quote: per-meter cable + pole climb + extras</li>
<li>Schedule work, notify outage window, coordinate with the utility when meter terminals are involved</li>
<li>Climb with fall protection, terminate on the load side of the meter, secure on insulators/rack</li>
<li>Pull 16 sq.mm cable open or in conduit into the house main breaker</li>
<li>Check terminations, measure voltage, restore power, hand over with before/after photos</li>
</ol>

<h2>Signs the house main cable should be replaced</h2>
<ul>
<li>Cracked, brittle, or peeling insulation exposing copper</li>
<li>Lights flicker or dim when AC and water heater run together</li>
<li>Hot terminals or main breaker with burn marks</li>
<li>Meter upgrade (e.g. 5(15)A → 15(45)A) with undersized existing cable</li>
<li>Sagging cable in trees or across vehicle clearance</li>
</ul>

<h2>Why Soi Phahonyothin 24 homeowners choose {$brand}</h2>
<ul>
<li><strong>Transparent pricing</strong>: 125 THB/m cable + 2,850 THB/round climb, measured with you</li>
<li><strong>Standards-based</strong>: cable and breaker sized to EIT 2021, with photo records</li>
<li><strong>Accountable crew</strong>: registered company, real contact channels, installation warranty</li>
</ul>

<h2>Request a main-cable quote — free site estimate</h2>
<p>Send meter photos, the pole-to-house route, and an approximate distance via LINE for a preliminary figure, then we measure on site.</p>
<p><strong>{$brand}</strong> · Call <a href="tel:{$phoneTel}">{$phoneDisplay}</a> · LINE <a href="{$lineUrl}" target="_blank" rel="noopener noreferrer">{$lineLabel}</a></p>
HTML;

    return [
        'slug' => 'meter-to-house-wiring-phahonyothin',
        'cover_image' => $imgPole,
        'completed_at' => '2024-11-13',
        'images' => [
            [
                'image_url' => $imgPole,
                'alt_text' => $altPoleTh,
                'width' => 1200,
                'height' => 1600,
                'sort_order' => 1,
            ],
            [
                'image_url' => $imgMeter,
                'alt_text' => $altMeterTh,
                'width' => 1200,
                'height' => 1600,
                'sort_order' => 2,
            ],
        ],
        'th' => [
            'title' => 'เดินสายไฟจากมิเตอร์เข้าบ้าน ราคาเริ่มเมตรละ 125 บาท — ผลงานสายเมนเบอร์ 16 ซอยพหลโยธิน 24',
            'description' => 'เดินสายเมน THW 16 ตร.มม. เข้าบ้าน 2 หลัง ซอยพหลโยธิน 24 — หลังที่ 1 ระยะ 9 ม. ใช้สาย 18 ม. · หลังที่ 2 ระยะ 20 ม. ใช้สาย 40 ม. ราคาเริ่มเมตรละ 125 บาท',
            'meta_title' => 'เดินสายไฟจากมิเตอร์เข้าบ้าน ราคาเมตรละ 125 บาท | ซอยพหลโยธิน 24',
            'meta_description' => 'เดินสายไฟจากมิเตอร์เข้าบ้าน ราคาเมตรละ 125 บาท สายเมน 16 ตร.มม. งานซอยพหลโยธิน 24 บ้าน 2 หลัง (9 ม./18 ม. และ 20 ม./40 ม.) ประเมินฟรี โทร '.$phoneDisplay,
            'content' => $contentTh,
        ],
        'en' => [
            'title_en' => 'Meter-to-house wiring from 125 THB/m — 16 sq.mm main, Soi Phahonyothin 24',
            'description_en' => 'THW 16 sq.mm main cable into two homes in Soi Phahonyothin 24 — house 1: 9 m run / 18 m cable; house 2: 20 m run / 40 m cable. From 125 THB/m plus pole climb.',
            'meta_title_en' => 'Meter-to-house wiring from 125 THB/m | Soi Phahonyothin 24',
            'meta_description_en' => 'Meter-to-house main wiring from 125 THB/m, 16 sq.mm THW. Soi Phahonyothin 24 — two homes (9 m/18 m and 20 m/40 m). Free estimate. Call '.$phoneDisplay,
            'content_en' => $contentEn,
        ],
        'faqs' => [
            [
                'question' => 'เดินสายไฟจากมิเตอร์เข้าบ้าน ราคาเท่าไหร่?',
                'answer' => 'ราคาเริ่มต้นเมตรละ 125 บาท คิดตามระยะจริงที่วัดหน้างาน บวกค่าปีนเสาไฟฟ้า 2,850 บาทต่อรอบ ตัวอย่างเช่น ระยะ 20 เมตร ปีนเสา 1 รอบ รวมประมาณ 5,350 บาท ราคาจริงขึ้นกับวิธีเดินสาย เดินลอยหรือร้อยท่อ และจำนวนรอบที่ต้องปีนเสา',
                'question_en' => 'How much does meter-to-house wiring cost?',
                'answer_en' => 'From 125 THB per measured meter, plus 2,850 THB per pole-climb round. Example: 20 m with one climb is about 5,350 THB. Open vs conduit and extra climbs change the final price.',
                'sort_order' => 1,
            ],
            [
                'question' => 'ค่าแรงเดินสายเมนไฟฟ้า เมตรละกี่บาท?',
                'answer' => $brand.' คิดค่าเดินสายเมนเบอร์ 16 เริ่มต้นเมตรละ 125 บาท โดยวัดระยะจริงจากขั้วมิเตอร์ถึงเมนเบรกเกอร์ในตู้ไฟ ไม่คิดแบบเหมารวม ค่าปีนเสาไฟฟ้าแยกต่างหาก 2,850 บาทต่อรอบ ทุกรายการแสดงในใบเสนอราคาก่อนเริ่มงาน',
                'question_en' => 'How much per meter for main cable labor?',
                'answer_en' => $brand.' prices 16 sq.mm main runs from 125 THB per measured meter from the meter terminals to the main breaker — not a lump sum. Pole climb is separate at 2,850 THB per round, all listed on the quote before work starts.',
                'sort_order' => 2,
            ],
            [
                'question' => 'ทำไมต้องจ่ายค่าปีนเสาไฟฟ้าแยก?',
                'answer' => 'เพราะมิเตอร์ติดอยู่บนเสาไฟฟ้า การต่อสายที่ขั้วมิเตอร์ต้องทำงานบนที่สูง ใช้ช่างที่ชำนาญงานบนเสา อุปกรณ์กันตก และเวลาเตรียมความปลอดภัย ค่าปีนเสา 2,850 บาทคิดต่อรอบ ถ้างานจบในการขึ้นเสาครั้งเดียว จะจ่ายเพียงรอบเดียว',
                'question_en' => 'Why is pole-climb charged separately?',
                'answer_en' => 'Because the meter is on the utility pole. Terminating at the meter requires height work, fall protection, and safety setup. Pole climb is 2,850 THB per round — one climb if the job finishes in a single ascent.',
                'sort_order' => 3,
            ],
            [
                'question' => 'สายไฟเมนเข้าบ้าน ใช้ขนาดเท่าไหร่?',
                'answer' => 'ตามมาตรฐานการติดตั้งทางไฟฟ้าสำหรับประเทศไทย พ.ศ. 2564 สายเมนต้องรับโหลดทั้งหมดของบ้านได้ บ้านที่ใช้มิเตอร์ 15(45)A รองรับโหลดสูงสุด 30A และใช้เมนเบรกเกอร์ได้สูงสุด 50A ทีมเราจึงใช้สาย THW 16 ตร.มม. คู่กับเมนเบรกเกอร์ 50A ซึ่งพอทั้งแบบเดินลอยและร้อยท่อ',
                'question_en' => 'What main cable size should a house use?',
                'answer_en' => 'Per Thailand’s 2021 Electrical Installation Standard, the main must carry the full house load. A 15(45)A meter allows up to 30A load and a 50A main breaker. We use THW 16 sq.mm with a 50A main breaker for both open and conduit runs.',
                'sort_order' => 4,
            ],
            [
                'question' => 'เดินสายเมนเข้าบ้าน ต้องดับไฟนานไหม?',
                'answer' => 'ต้องดับไฟเฉพาะช่วงต่อสายที่มิเตอร์และตู้ไฟเท่านั้น งานส่วนอื่น เช่น ดึงสายและยึดลูกถ้วย ทำได้ก่อนโดยไม่ต้องดับไฟ ทีมงานจะแจ้งช่วงเวลาดับไฟล่วงหน้า เพื่อให้เจ้าของบ้านเตรียมตัวได้',
                'question_en' => 'How long is the power outage for main cable work?',
                'answer_en' => 'Power is off only while terminating at the meter and panel. Pulling cable and fixing insulators can be done beforehand. We notify the outage window in advance so the household can prepare.',
                'sort_order' => 5,
            ],
        ],
    ];
};
