<?php

/**
 * เนื้อหาหน้าบริการรับซื้อแอร์เก่า (TH + EN)
 * แหล่ง: old-air SEO package — เติม LINE/โทร/แผนที่จาก config ตอน seeder
 *
 * @return array{
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
    string $mapsUrl,
    string $imageBase,
): array {
    $lineLabel = $lineId !== '' ? $lineId : 'LINE OA';
    $img = static fn (string $file): string => rtrim($imageBase, '/').'/'.$file;

    $imgPickup = $img('S__17326092_0.webp');
    $imgParts = $img('S__17326093_0.webp');
    $imgLoading = $img('S__17326094_0.webp');

    $altPickupTh = "รถกระบะบรรทุกแอร์เก่าที่ถอดจากหน้างาน — ร้านรับซื้อแอร์เก่า {$brand}";
    $altPartsTh = "ชิ้นส่วนแอร์เก่า คอยล์ และสายไฟหลังถอดรับซื้อหน้างาน — {$brand}";
    $altLoadingTh = "ทีมช่าง {$brand} ขนแอร์เก่าขึ้นรถกระบะหลังถอดถึงที่";

    $altPickupEn = "Pickup truck loaded with used air conditioners removed on-site — {$brand} buyback";
    $altPartsEn = "Dismantled used AC parts, coils, and wiring after on-site buyback — {$brand}";
    $altLoadingEn = "{$brand} crew loading used air conditioners onto a pickup after on-site removal";

    $figureLoadingTh = <<<HTML
<figure>
<img src="{$imgLoading}" alt="{$altLoadingTh}" width="960" height="1280" loading="lazy" decoding="async">
</figure>
HTML;

    $figureLoadingEn = <<<HTML
<figure>
<img src="{$imgLoading}" alt="{$altLoadingEn}" width="960" height="1280" loading="lazy" decoding="async">
</figure>
HTML;

    $galleryTh = <<<HTML
<div class="content-gallery content-gallery--2">
<figure>
<img src="{$imgParts}" alt="{$altPartsTh}" width="960" height="720" loading="lazy" decoding="async">
</figure>
<figure>
<img src="{$imgPickup}" alt="{$altPickupTh}" width="960" height="720" loading="lazy" decoding="async">
</figure>
</div>
HTML;

    $galleryEn = <<<HTML
<div class="content-gallery content-gallery--2">
<figure>
<img src="{$imgParts}" alt="{$altPartsEn}" width="960" height="720" loading="lazy" decoding="async">
</figure>
<figure>
<img src="{$imgPickup}" alt="{$altPickupEn}" width="960" height="720" loading="lazy" decoding="async">
</figure>
</div>
HTML;

    $contentTh = <<<HTML
<p><em>เขียนโดย ทีมช่าง {$brand} · อัปเดตล่าสุด 12 พฤศจิกายน 2569</em></p>
<p><a href="{$lineUrl}" target="_blank" rel="noopener noreferrer">ส่งรูปแอร์ทาง LINE ({$lineLabel})</a> · <a href="tel:{$phoneTel}">โทร {$phoneDisplay}</a> · <a href="{$mapsUrl}" target="_blank" rel="noopener noreferrer">ดูแผนที่ร้าน</a></p>

<h2>ร้านรับซื้อแอร์เก่าใกล้ฉัน ไปถอดถึงที่ไหนบ้าง?</h2>
<p>เราไปถอดแอร์ถึงที่ทั้งปทุมธานี นนทบุรี และกรุงเทพฯ ฝั่งเหนือ ถ้าคุณอยู่ในพื้นที่ตามตาราง เราคือร้านรับซื้อแอร์ใกล้ฉันที่มาถอดให้ได้ ไม่ต้องขนแอร์ไปขายเอง รับตั้งแต่ 1 เครื่อง</p>
{$figureLoadingTh}
<div>
<table>
<thead>
<tr><th>จังหวัด</th><th>พื้นที่</th></tr>
</thead>
<tbody>
<tr><td>ปทุมธานี</td><td>ธัญบุรี (รังสิต) ลำลูกกา คลองหลวง เมืองปทุมธานี สามโคก ลาดหลุมแก้ว หนองเสือ</td></tr>
<tr><td>นนทบุรี</td><td>เมืองนนทบุรี ปากเกร็ด บางบัวทอง บางใหญ่ บางกรวย ไทรน้อย</td></tr>
<tr><td>กรุงเทพฯ</td><td>ดอนเมือง สายไหม หลักสี่ บางเขน</td></tr>
</tbody>
</table>
</div>
<p>อยู่นอกพื้นที่นี้แต่มีแอร์หลายเครื่อง เช่น หอพัก สำนักงาน หรือโรงงาน ส่งรายละเอียดมาทาง LINE เราจะแจ้งว่าไปได้ไหม</p>

<h2>รับซื้อแอร์เก่า ราคาเท่าไร? ตารางราคา 2569</h2>
<p>แอร์เก่าครบชุด (ตัวในห้อง + ตัวนอกบ้าน) รับซื้อ 700–5,400 บาท ตามขนาด BTU และวัสดุคอยล์ คอยล์ทองแดงให้ราคาสูงสุด ส่วนอินเวอร์เตอร์คิดที่ 60% ของราคาปกติ</p>
<div>
<table>
<thead>
<tr><th>BTU</th><th>คอยล์ทองแดง (บาท)</th><th>คอยล์อลูมิเนียม (บาท)</th><th>อินเวอร์เตอร์ คอยล์ทองแดง (บาท)</th></tr>
</thead>
<tbody>
<tr><td>9,000</td><td>1,400</td><td>700</td><td>840</td></tr>
<tr><td>12,000</td><td>1,700</td><td>900</td><td>1,020</td></tr>
<tr><td>13,000</td><td>1,800</td><td>สอบถาม</td><td>1,080</td></tr>
<tr><td>15,000</td><td>2,000</td><td>สอบถาม</td><td>1,200</td></tr>
<tr><td>18,000</td><td>2,500</td><td>1,100</td><td>1,500</td></tr>
<tr><td>24,000</td><td>2,900</td><td>1,400</td><td>1,740</td></tr>
<tr><td>30,000</td><td>3,400</td><td>สอบถาม</td><td>2,040</td></tr>
<tr><td>33,000</td><td>3,700</td><td>สอบถาม</td><td>2,220</td></tr>
<tr><td>36,000</td><td>4,000</td><td>สอบถาม</td><td>2,400</td></tr>
<tr><td>40,000</td><td>4,400</td><td>สอบถาม</td><td>2,640</td></tr>
<tr><td>48,000</td><td>5,000</td><td>สอบถาม</td><td>3,000</td></tr>
<tr><td>56,000</td><td>5,400</td><td>สอบถาม</td><td>3,240</td></tr>
</tbody>
</table>
</div>
<p>บวกเพิ่มจากตาราง: คอยล์ทองแดงตั้งแต่ 3 ชุดขึ้นไป +100 บาทต่อชุด และแอร์แขวนใต้ฝ้า +200 บาทต่อเครื่อง ราคาปรับตามตลาดทองแดงและอลูมิเนียม ช่างยืนยันอีกครั้งเมื่อเห็นเครื่องจริง</p>

<h3>ทำไมคอยล์ทองแดงให้ราคาสูงกว่า ดูเองได้ไหม?</h3>
<p>ทองแดงมีมูลค่าต่อกิโลสูงกว่าอลูมิเนียมมาก แอร์ขนาดเดียวกันจึงต่างกันเกือบ 2 เท่า ดูเองได้ที่ท่อโค้งรูปตัว U ปลายคอยล์ตัวนอกบ้าน: สีส้มแดงคือทองแดง สีเงินคืออลูมิเนียม อย่าดูที่ครีบบาง ๆ เพราะเกือบทุกรุ่นเป็นอลูมิเนียม ส่วนอินเวอร์เตอร์ราคาต่ำกว่าเพราะแผงวงจรมีมูลค่าซากต่ำ และโลหะต่อเครื่องมักน้อยกว่า</p>

<h2>รับซื้อแอร์เก่าทุกชนิด รับแอร์แบบไหนบ้าง?</h2>
<p>รับทุกชนิดที่ใช้ในบ้าน ร้านค้า และสำนักงาน แอร์ติดผนังและแขวนใต้ฝ้าใช้ตารางด้านบน ชนิดอื่นประเมินจากรูปก่อนนัด</p>
<div>
<table>
<thead>
<tr><th>ชนิดแอร์</th><th>วิธีคิดราคา</th></tr>
</thead>
<tbody>
<tr><td>แอร์ติดผนัง</td><td>ตามตาราง BTU</td></tr>
<tr><td>แอร์แขวนใต้ฝ้า</td><td>ตามตาราง BTU +200 บาท</td></tr>
<tr><td>แอร์ฝังฝ้า (Cassette)</td><td>ประเมินจากรูป</td></tr>
<tr><td>แอร์ตั้งพื้น</td><td>ประเมินจากรูป</td></tr>
<tr><td>แอร์หน้าต่าง / แอร์เคลื่อนที่</td><td>ประเมินจากรูป</td></tr>
</tbody>
</table>
</div>

<h3>แอร์สมัยเก่ายังขายได้ไหม?</h3>
<p>ขายได้ และมักได้ราคาดีกว่าที่คิด เพราะแอร์รุ่นเก่าส่วนใหญ่เป็นคอยล์ทองแดงและไม่ใช่อินเวอร์เตอร์ จึงเข้าคอลัมน์ราคาสูงสุดของตาราง ถ้าป้ายสเปกซีดจนอ่านไม่ออก ให้ถ่ายรูปตัวเครื่องทั้งตัวและขนาดห้อง ช่างประเมิน BTU ให้ได้</p>

<h2>รับซื้อแอร์เก่า แอร์เสีย ได้ราคาเท่าไร?</h2>
<p>แอร์เสียที่ชิ้นส่วนหลักครบได้ราคาเท่ากับแอร์ที่ยังใช้งานได้ เพราะเราคิดราคาจากโลหะและคอมเพรสเซอร์ ไม่ได้คิดจากความเย็น เปิดไม่ติด น้ำยาหมด หรือแผงวงจรเสียก็เข้าตารางเดิม ราคาลดก็ต่อเมื่อมีชิ้นส่วนหาย เช่น คอมเพรสเซอร์ถูกถอดไปแล้ว ซึ่งช่างจะแจ้งราคาใหม่ก่อนลงมือถอด</p>

<h3>แอร์ที่เคยโดนน้ำท่วม ยังขายได้ไหม?</h3>
<p>ขายได้ คอมเพรสเซอร์ที่จมน้ำมักใช้งานต่อไม่ได้ แต่ทองแดง อลูมิเนียม และเหล็กยังมีมูลค่า พื้นที่ลุ่มในปทุมธานีและนนทบุรี เช่นบางโซนของรังสิต คลองหลวง และบางบัวทอง มักมีแอร์ที่เคยจมน้ำเก็บทิ้งไว้ เรารับซื้อตามชิ้นส่วนที่เหลือและแจ้งราคาจากรูปก่อนนัด</p>

<h2>ราคารับซื้อคอมเพรสเซอร์เก่าเท่าไร?</h2>
<p>คอมเพรสเซอร์เก่าที่ถอดออกมาแล้ว เรารับซื้อแยกตามขนาด เพราะขดลวดทองแดงและเสื้อเหล็กด้านในยังมีมูลค่า แต่ถ้าคอมยังติดอยู่กับแอร์ ขายทั้งชุดจะได้เงินรวมมากกว่าแยกขาย อย่าเพิ่งตัดคอมออกเอง</p>
<div>
<table>
<thead>
<tr><th>ขนาดคอม (ตามแอร์)</th><th>ราคารับซื้อ (บาท)</th></tr>
</thead>
<tbody>
<tr><td>9,000–13,000 BTU</td><td>สอบถามทาง LINE</td></tr>
<tr><td>15,000–24,000 BTU</td><td>สอบถามทาง LINE</td></tr>
<tr><td>30,000 BTU ขึ้นไป</td><td>สอบถามทาง LINE</td></tr>
</tbody>
</table>
</div>

<h2>ขายเป็นซาก หรือขายเป็นแอร์มือสอง แบบไหนคุ้มกว่า?</h2>
<p>แอร์ที่ยังใหม่และเย็นดี ขายเป็นแอร์มือสองกับผู้ซื้อโดยตรงมักได้มากกว่าตารางนี้ แต่ต้องลงประกาศ รอคนมาดู และหาช่างถอดเอง เราบอกตรง ๆ เพื่อให้เลือกถูก</p>
<div>
<table>
<thead>
<tr><th>สถานการณ์</th><th>ทางที่คุ้มกว่า</th></tr>
</thead>
<tbody>
<tr><td>แอร์เสีย แอร์สมัยเก่า หรือเคยจมน้ำ</td><td>ขายให้ {$brand} ตามตาราง</td></tr>
<tr><td>ต้องถอดให้จบในวันเดียว เช่น ก่อนรีโนเวทหรือคืนห้องเช่า</td><td>ขายให้ {$brand} ตามตาราง</td></tr>
<tr><td>มีหลายเครื่องจากหอพัก/สำนักงาน</td><td>ขายรวมได้เพิ่มชุดละ 100 บาท</td></tr>
<tr><td>แอร์ยังใหม่ เย็นดี ไม่รีบขาย</td><td>ลองประกาศขายแอร์มือสองก่อน</td></tr>
</tbody>
</table>
</div>

<h2>ขายแอร์เก่ากับ {$brand} มีขั้นตอนอย่างไร?</h2>
<p>มี 5 ขั้น เริ่มจากส่งรูปทาง LINE จบที่ได้เงินหน้างาน</p>
<ol>
<li>ถ่ายรูป 3 จุด: ป้ายสเปกตัวนอกบ้าน ตัวในห้อง และตำแหน่งติดตั้ง ส่งทาง LINE พร้อมบอกอำเภอ/เขต</li>
<li>รับราคาตามตาราง พร้อมค่าใช้จ่ายพิเศษ (ถ้ามี) เช่น ตัวนอกบ้านอยู่สูงต้องใช้นั่งร้าน</li>
<li>นัดวันเวลาถอด</li>
<li>ช่างตรวจเครื่องให้ตรงกับรูป ตัดเบรกเกอร์แอร์ แล้วถอด</li>
<li>จ่ายเงินสดหรือโอนทันทีหลังถอดเสร็จ</li>
</ol>

<h2>จะเปลี่ยนแอร์ใหม่ด้วย ทำพร้อมกันได้ไหม?</h2>
<p>ได้ ถอดแอร์เก่า รับซื้อตามตาราง แล้วติดตั้งเครื่องใหม่ในการนัดเดียว เงินจากแอร์เก่านำไปหักค่าติดตั้งได้ตามเงื่อนไขที่ตกลง ช่างจะเช็กสายไฟและเบรกเกอร์เดิมว่ารองรับเครื่องใหม่ได้หรือไม่ ส่งรายละเอียดเครื่องใหม่ทาง LINE เพื่อประเมินพร้อมกัน</p>

<h2>ผลงานถอดและรับซื้อแอร์จริง</h2>
<p>ภาพจากงานถอดและรับซื้อแอร์เก่าของ {$brand} — ถอดถึงที่ ชิ้นส่วนที่รับซื้อ และขนขึ้นรถหน้างาน</p>
{$galleryTh}

<h2>หาร้านรับซื้อแอร์ใกล้ฉันอยู่? ส่งรูปมาได้เลย</h2>
<p>ถ่ายรูปป้ายสเปกและตัวนอกบ้านส่งมาที่ LINE ({$lineLabel}) หรือโทร {$phoneDisplay} {$brand} รับซื้อแอร์เก่าทุกชนิดทั่วกรุงเทพฯ นนทบุรี และปทุมธานี คนที่อยากขายแอร์เก่าใกล้บ้าน ไม่ต้องขนแอร์ไปที่ร้านเอง</p>
HTML;

    $contentEn = <<<HTML
<p><em>Written by the {$brand} technician team · Last updated 12 November 2026</em></p>
<p><a href="{$lineUrl}" target="_blank" rel="noopener noreferrer">Send AC photos via LINE ({$lineLabel})</a> · <a href="tel:{$phoneTel}">Call {$phoneDisplay}</a> · <a href="{$mapsUrl}" target="_blank" rel="noopener noreferrer">View shop map</a></p>

<h2>Where do we remove used air conditioners near you?</h2>
<p>We remove units on-site across Pathum Thani, Nonthaburi, and northern Bangkok. If you are in the areas below, we are the nearby used-AC buyer that comes to you — no need to haul the unit yourself. We accept from 1 unit.</p>
{$figureLoadingEn}
<div>
<table>
<thead>
<tr><th>Province</th><th>Areas</th></tr>
</thead>
<tbody>
<tr><td>Pathum Thani</td><td>Thanyaburi (Rangsit), Lam Luk Ka, Khlong Luang, Mueang Pathum Thani, Sam Khok, Lat Lum Kaeo, Nong Suea</td></tr>
<tr><td>Nonthaburi</td><td>Mueang Nonthaburi, Pak Kret, Bang Bua Thong, Bang Yai, Bang Kruai, Sai Noi</td></tr>
<tr><td>Bangkok</td><td>Don Mueang, Sai Mai, Lak Si, Bang Khen</td></tr>
</tbody>
</table>
</div>
<p>Outside these areas but with many units — dormitories, offices, or factories — send details via LINE and we will confirm whether we can come.</p>

<h2>How much do we pay for used air conditioners? 2026 price table</h2>
<p>Complete used sets (indoor + outdoor) are bought for 700–5,400 THB by BTU size and coil material. Copper coils pay the highest; inverter units are priced at 60% of the standard rate.</p>
<div>
<table>
<thead>
<tr><th>BTU</th><th>Copper coil (THB)</th><th>Aluminium coil (THB)</th><th>Inverter copper coil (THB)</th></tr>
</thead>
<tbody>
<tr><td>9,000</td><td>1,400</td><td>700</td><td>840</td></tr>
<tr><td>12,000</td><td>1,700</td><td>900</td><td>1,020</td></tr>
<tr><td>13,000</td><td>1,800</td><td>Ask</td><td>1,080</td></tr>
<tr><td>15,000</td><td>2,000</td><td>Ask</td><td>1,200</td></tr>
<tr><td>18,000</td><td>2,500</td><td>1,100</td><td>1,500</td></tr>
<tr><td>24,000</td><td>2,900</td><td>1,400</td><td>1,740</td></tr>
<tr><td>30,000</td><td>3,400</td><td>Ask</td><td>2,040</td></tr>
<tr><td>33,000</td><td>3,700</td><td>Ask</td><td>2,220</td></tr>
<tr><td>36,000</td><td>4,000</td><td>Ask</td><td>2,400</td></tr>
<tr><td>40,000</td><td>4,400</td><td>Ask</td><td>2,640</td></tr>
<tr><td>48,000</td><td>5,000</td><td>Ask</td><td>3,000</td></tr>
<tr><td>56,000</td><td>5,400</td><td>Ask</td><td>3,240</td></tr>
</tbody>
</table>
</div>
<p>Add-ons from the table: copper-coil sets from 3 units up get +100 THB per set, and ceiling-hung units get +200 THB each. Prices track copper and aluminium markets; the technician confirms again on seeing the unit.</p>

<h3>Why do copper coils pay more, and can I check myself?</h3>
<p>Copper is worth far more per kilo than aluminium, so the same size can differ by nearly 2×. Check the U-bend tubes at the end of the outdoor coil: orange-red is copper, silver is aluminium. Do not judge by the thin fins — almost every model uses aluminium fins. Inverters pay less because the circuit board has low scrap value and metal per unit is often less.</p>

<h2>Which types of used air conditioners do we buy?</h2>
<p>We buy every type used in homes, shops, and offices. Wall-mounted and ceiling-hung units use the table above; other types are quoted from photos before booking.</p>
<div>
<table>
<thead>
<tr><th>Type</th><th>Pricing</th></tr>
</thead>
<tbody>
<tr><td>Wall-mounted</td><td>Per BTU table</td></tr>
<tr><td>Ceiling-hung</td><td>Per BTU table +200 THB</td></tr>
<tr><td>Cassette (ceiling recessed)</td><td>Quoted from photos</td></tr>
<tr><td>Floor-standing</td><td>Quoted from photos</td></tr>
<tr><td>Window / portable</td><td>Quoted from photos</td></tr>
</tbody>
</table>
</div>

<h3>Can older vintage air conditioners still be sold?</h3>
<p>Yes — and they often pay better than expected because older units usually have copper coils and are not inverters, so they land in the highest table column. If the spec label is faded, photograph the whole outdoor unit and room size; the technician can estimate BTU.</p>

<h2>How much for broken used air conditioners?</h2>
<p>Broken units with main parts intact pay the same as working ones because we price metal and the compressor, not cooling performance. Units that will not start, are out of refrigerant, or have a failed board still use the same table. Price drops only when parts are missing — for example a removed compressor — and the technician states the new price before removal.</p>

<h3>Can flood-damaged air conditioners still be sold?</h3>
<p>Yes. A submerged compressor is often unusable, but copper, aluminium, and steel still have value. Low-lying Pathum Thani and Nonthaburi areas — such as parts of Rangsit, Khlong Luang, and Bang Bua Thong — often have flood-damaged units left aside. We buy by remaining parts and quote from photos before booking.</p>

<h2>How much for used compressors alone?</h2>
<p>Removed compressors are bought by size because the copper windings and steel shell still have value. If the compressor is still on the unit, selling the full set usually pays more than parting it out — do not cut the compressor off yourself.</p>
<div>
<table>
<thead>
<tr><th>Compressor size (by AC)</th><th>Buyback (THB)</th></tr>
</thead>
<tbody>
<tr><td>9,000–13,000 BTU</td><td>Ask via LINE</td></tr>
<tr><td>15,000–24,000 BTU</td><td>Ask via LINE</td></tr>
<tr><td>30,000 BTU and up</td><td>Ask via LINE</td></tr>
</tbody>
</table>
</div>

<h2>Scrap sale or second-hand sale — which pays better?</h2>
<p>Newer units that still cool well often fetch more as second-hand units sold directly to a buyer — but you must list them, wait for viewers, and arrange removal yourself. We say this plainly so you can choose correctly.</p>
<div>
<table>
<thead>
<tr><th>Situation</th><th>Better path</th></tr>
</thead>
<tbody>
<tr><td>Broken, vintage, or flood-damaged</td><td>Sell to {$brand} at table rates</td></tr>
<tr><td>Must finish removal in one day (renovation or move-out)</td><td>Sell to {$brand} at table rates</td></tr>
<tr><td>Many units from a dorm/office</td><td>Bulk sale +100 THB per set</td></tr>
<tr><td>Still new, cools well, not urgent</td><td>Try a second-hand listing first</td></tr>
</tbody>
</table>
</div>

<h2>How does selling a used AC to {$brand} work?</h2>
<p>Five steps — from LINE photos to payment on site.</p>
<ol>
<li>Photograph 3 spots: outdoor spec label, indoor unit, and install location. Send via LINE with your district.</li>
<li>Receive a table quote plus any special costs (e.g. scaffolding if the outdoor unit is high).</li>
<li>Book a removal date and time.</li>
<li>Technician matches the unit to the photos, switches off the AC breaker, then removes it.</li>
<li>Cash or transfer paid immediately after removal.</li>
</ol>

<h2>Can we replace with a new AC in the same visit?</h2>
<p>Yes — remove the old unit, buy it back at table rates, and install the new one in one appointment. Credit from the old unit can offset install cost under agreed terms. The technician checks whether existing wiring and breakers support the new unit. Send new-unit details via LINE for a combined quote.</p>

<h2>Real removal and buyback jobs</h2>
<p>Photos from {$brand} used-AC removal and buyback jobs — on-site removal, parts collected, and loading onto the truck.</p>
{$galleryEn}

<h2>Looking for a used-AC buyer near you? Send photos now</h2>
<p>Photograph the spec label and outdoor unit and send them to LINE ({$lineLabel}) or call {$phoneDisplay}. {$brand} buys all types of used air conditioners across Bangkok, Nonthaburi, and Pathum Thani — no need to haul units to a shop.</p>
HTML;

    return [
        'cover_image' => $imgPickup,
        'th' => [
            'name' => 'รับซื้อแอร์เก่า',
            'headline' => 'ร้านรับซื้อแอร์เก่าใกล้ฉัน รับแอร์เสียทุกชนิด ถอดถึงที่ กรุงเทพฯ นนทบุรี ปทุมธานี',
            'description' => "{$brand} คือร้านรับซื้อแอร์เก่าที่มีฐานอยู่ปทุมธานี ส่งช่างไปถอดถึงบ้านในปทุมธานี นนทบุรี และกรุงเทพฯ ฝั่งเหนือ รับซื้อแอร์เก่าทุกชนิด ทั้งแอร์เสีย แอร์สมัยเก่า และคอมเพรสเซอร์เก่า ราคาประกาศไว้บนหน้านี้ เช่น แอร์ 12000 BTU คอยล์ทองแดง 1,700 บาท ถ่ายรูปส่ง LINE แล้วรู้ราคาก่อนนัดช่าง",
            'excerpt' => 'ร้านรับซื้อแอร์เก่าใกล้ฉัน ถอดถึงที่ กรุงเทพฯ นนทบุรี ปทุมธานี รับแอร์เสีย แอร์สมัยเก่า คอมเพรสเซอร์ ตารางราคา 9,000–56,000 BTU',
            'service_type' => 'รับซื้อแอร์เก่า',
            'meta_title' => 'ร้านรับซื้อแอร์เก่าใกล้ฉัน ให้ราคาสูง แอร์เสียทุกชนิด ถอดถึงที่',
            'meta_description' => 'ร้านรับซื้อแอร์เก่าใกล้ฉัน รับแอร์เสีย แอร์สมัยเก่า คอมเพรสเซอร์ 12000 BTU 1,700 บาท ถอดถึงที่ กรุงเทพ นนทบุรี ปทุมธานี ส่งรูป LINE รู้ราคาก่อน',
            'content' => $contentTh,
        ],
        'en' => [
            'name_en' => 'Buy Used Air Conditioners',
            'headline_en' => 'Used air conditioner buyback near you — broken units of every type, on-site removal in Bangkok, Nonthaburi & Pathum Thani',
            'description_en' => "{$brand} is a used air conditioner buyer based in Pathum Thani. Technicians remove units on-site in Pathum Thani, Nonthaburi, and northern Bangkok. We buy every type — broken units, vintage units, and used compressors. Prices are listed on this page, e.g. 12,000 BTU copper-coil sets at 1,700 THB. Send photos via LINE for a quote before booking.",
            'excerpt_en' => 'Used AC buyback near you with on-site removal in Bangkok, Nonthaburi, and Pathum Thani — broken, vintage, and compressors. Price table 9,000–56,000 BTU',
            'service_type_en' => 'Used air conditioner buyback',
            'meta_title_en' => 'Used AC Buyback Near You — High Prices, Broken Units, On-site Removal',
            'meta_description_en' => 'Used AC buyback near you — broken, vintage, compressors. 12,000 BTU copper 1,700 THB. On-site removal in Bangkok, Nonthaburi, Pathum Thani. Send LINE photos first.',
            'content_en' => $contentEn,
        ],
        'faqs' => [
            [
                'question' => 'ร้านรับซื้อแอร์เก่าใกล้ฉัน มาถอดถึงบ้านไหม?',
                'answer' => "มาถอดถึงบ้าน {$brand} เป็นร้านรับซื้อแอร์เก่าที่มีฐานอยู่ปทุมธานี ให้บริการทั่วปทุมธานี นนทบุรี และกรุงเทพฯ ฝั่งเหนือ เช่น รังสิต ลำลูกกา ปากเกร็ด บางบัวทอง ดอนเมือง และสายไหม ส่งรูปแอร์พร้อมบอกพื้นที่ทาง LINE เพื่อรับราคาและนัดวันถอด",
                'question_en' => 'Will a used-AC buyer near me come remove it at home?',
                'answer_en' => "Yes. {$brand} is a used air conditioner buyer based in Pathum Thani, serving Pathum Thani, Nonthaburi, and northern Bangkok — including Rangsit, Lam Luk Ka, Pak Kret, Bang Bua Thong, Don Mueang, and Sai Mai. Send AC photos with your area via LINE for a quote and removal booking.",
                'sort_order' => 1,
            ],
            [
                'question' => 'รับซื้อแอร์เก่า ราคาเท่าไร?',
                'answer' => 'แอร์เก่าครบชุดรับซื้อ 700–5,400 บาท ตามขนาด BTU และวัสดุคอยล์ เช่น 12000 BTU คอยล์ทองแดง 1,700 บาท และ 18000 BTU คอยล์ทองแดง 2,500 บาท คอยล์อลูมิเนียมได้ราคาต่ำกว่า ส่วนแอร์อินเวอร์เตอร์คิดที่ 60% ของราคาปกติ',
                'question_en' => 'How much do you pay for used air conditioners?',
                'answer_en' => 'Complete used sets are bought for 700–5,400 THB by BTU size and coil material — e.g. 12,000 BTU copper coil 1,700 THB and 18,000 BTU copper coil 2,500 THB. Aluminium coils pay less; inverter units are priced at 60% of the standard rate.',
                'sort_order' => 2,
            ],
            [
                'question' => 'รับซื้อแอร์เก่า แอร์เสีย ได้ไหม?',
                'answer' => 'ได้ แอร์เสียที่ชิ้นส่วนหลักครบได้ราคาเท่ากับตารางรับซื้อปกติ เพราะคิดราคาจากทองแดง อลูมิเนียม เหล็ก และคอมเพรสเซอร์ ไม่ได้คิดจากความเย็น ถ้าคอมเพรสเซอร์ถูกถอดไปแล้วหรือคอยล์ถูกตัด ราคาจะลดตามส่วนที่ขาด และแจ้งก่อนถอดเสมอ',
                'question_en' => 'Do you buy broken used air conditioners?',
                'answer_en' => 'Yes. Broken units with main parts intact pay the same table rates because we price copper, aluminium, steel, and the compressor — not cooling performance. If the compressor was removed or the coil cut, the price drops for missing parts and is always stated before removal.',
                'sort_order' => 3,
            ],
            [
                'question' => 'แอร์สมัยเก่ายังขายได้ไหม?',
                'answer' => 'ขายได้ และมักได้ราคาดี เพราะแอร์รุ่นเก่าส่วนใหญ่เป็นคอยล์ทองแดงและไม่ใช่อินเวอร์เตอร์ จึงเข้าคอลัมน์ราคาสูงสุดของตาราง ถ้าป้ายสเปกซีดจนอ่านไม่ออก ถ่ายรูปตัวเครื่องทั้งตัวและบอกขนาดห้อง ช่างประเมิน BTU ให้ได้',
                'question_en' => 'Can older vintage air conditioners still be sold?',
                'answer_en' => 'Yes — and they often pay well because older units usually have copper coils and are not inverters, so they land in the highest table column. If the spec label is faded, photograph the whole unit and room size; the technician can estimate BTU.',
                'sort_order' => 4,
            ],
            [
                'question' => 'ราคารับซื้อคอมเพรสเซอร์เก่าเท่าไร?',
                'answer' => 'คอมเพรสเซอร์เก่าที่ถอดออกมาแล้วรับซื้อแยกตามขนาด เพราะขดลวดทองแดงและเสื้อเหล็กด้านในยังมีมูลค่า ถ่ายรูปป้ายบนตัวคอมส่งทาง LINE เพื่อรับราคา ถ้าคอมยังติดอยู่กับแอร์ ขายทั้งชุดจะได้เงินรวมมากกว่าแยกขาย',
                'question_en' => 'How much do you pay for used compressors?',
                'answer_en' => 'Removed compressors are bought by size because the copper windings and steel shell still have value. Photograph the label on the compressor and send it via LINE for a quote. If the compressor is still on the unit, selling the full set usually pays more than parting it out.',
                'sort_order' => 5,
            ],
            [
                'question' => 'แอร์ที่เคยโดนน้ำท่วมขายได้ไหม?',
                'answer' => "ขายได้ แม้คอมเพรสเซอร์ที่จมน้ำมักใช้งานต่อไม่ได้ แต่ทองแดง อลูมิเนียม และเหล็กยังมีมูลค่า {$brand} รับซื้อตามชิ้นส่วนที่เหลือ ถ้าคอยล์ผุกร่อนมาก ส่งรูปทาง LINE แล้วเราแจ้งราคาให้ก่อนนัดถอด",
                'question_en' => 'Can flood-damaged air conditioners be sold?',
                'answer_en' => "Yes. Even when a submerged compressor is unusable, copper, aluminium, and steel still have value. {$brand} buys by remaining parts. If the coil is heavily corroded, send photos via LINE and we will quote before booking removal.",
                'sort_order' => 6,
            ],
            [
                'question' => 'ขายแอร์เก่าพร้อมติดตั้งแอร์ใหม่ได้ไหม?',
                'answer' => 'ได้ ถอดแอร์เก่ารับซื้อตามตาราง แล้วติดตั้งเครื่องใหม่ในการนัดเดียว ช่างจะเช็กสายไฟและเบรกเกอร์เดิมว่ารองรับเครื่องใหม่ได้หรือไม่ ช่วยลดค่าเดินทางช่างและไม่ต้องลางานรอ 2 วัน',
                'question_en' => 'Can I sell the old AC and install a new one together?',
                'answer_en' => 'Yes — remove and buy back the old unit at table rates, then install the new one in one appointment. The technician checks whether existing wiring and breakers support the new unit, which cuts travel cost and avoids taking two days off.',
                'sort_order' => 7,
            ],
        ],
    ];
};
