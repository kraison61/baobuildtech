<?php

/**
 * เนื้อหาผลงานหัวแย็กแม็คโคร PC30 สยามสแควร์ (TH + EN)
 * Keyword TH: หัวแย็กแม็คโคร PC30, เช่ารถแบคโฮหัวเจาะ, สกัดพื้นปูน
 * Keyword EN: PC30 excavator with breaker, mini excavator breaker Bangkok, concrete breaking
 *
 * @return array{
 *   slug: string,
 *   cover_image: string,
 *   completed_at: string,
 *   client_name: string|null,
 *   client_name_en: string|null,
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
    string $interiorPath,
    string $wastePath,
    string $debrisPath,
): array {
    $lineLabel = $lineId !== '' ? $lineId : 'LINE OA';
    $img = static fn (string $file): string => rtrim($imageBase, '/').'/'.$file;

    $imgHero = $img('583042_0.webp');
    $imgSite = $img('583236_0.webp');
    $imgBreak = $img('583237_0.webp');
    $imgLoad = $img('583238_0.webp');
    $imgAfter = $img('583240_0.webp');

    $altHeroTh = 'รถแบคโฮ PC30 ติดหัวแย็กกำลังสกัดพื้นปูน หน้างานสยามสแควร์ ปทุมวัน กรุงเทพ';
    $altSiteTh = 'สภาพหน้างานสยามสแควร์ก่อนสกัดพื้นปูน พื้นที่ทำงานจำกัดกลางย่านการค้า';
    $altBreakTh = 'หัวแย็กแม็คโคร PC30 สกัดพื้นคอนกรีตเป็นแนว คุมแรงสกัดไม่ให้กระทบโครงสร้าง';
    $altLoadTh = 'ตักเศษปูนจากงานแย็กพื้นขึ้นรถเพื่อขนไปทิ้ง สยามสแควร์ กรุงเทพ';
    $altAfterTh = 'พื้นที่หลังสกัดพื้นปูนและเคลียร์เศษเสร็จ งานหัวแย็กแม็คโคร PC30 สยามสแควร์';

    $altHeroEn = 'PC30 mini excavator with hydraulic breaker breaking a concrete floor at Siam Square, Bangkok';
    $altSiteEn = 'Site condition before concrete breaking at Siam Square, a tight work area in a busy retail district';
    $altBreakEn = 'Mini excavator breaker breaking a concrete slab in strips without damaging the structure';
    $altLoadEn = 'Loading broken concrete onto a truck for debris removal at Siam Square, Bangkok';
    $altAfterEn = 'Cleared site after concrete floor breaking with a PC30 excavator with breaker at Siam Square';

    $contentTh = <<<HTML
<p><em>โดย ทีมงาน {$brand} • เผยแพร่ 21 พฤศจิกายน 2569 • อัปเดตล่าสุด 21 พฤศจิกายน 2569</em></p>
<p><a href="{$lineUrl}" target="_blank" rel="noopener noreferrer">ส่งรูปร้านและทางเข้าทาง LINE ({$lineLabel})</a> · <a href="tel:{$phoneTel}">โทร {$phoneDisplay}</a></p>

<p>{$brand} ใช้รถแบคโฮ <strong>PC30 ติดหัวแย็ก</strong> (หัวเจาะไฮดรอลิก) สกัดพื้นคอนกรีตเดิมในย่าน<strong>สยามสแควร์</strong> เขตปทุมวัน กรุงเทพฯ แล้วขนเศษปูนไปทิ้งยังจุดรับทิ้งที่ได้รับอนุญาตในงานเดียวกัน PC30 เป็นแม็คโครเล็กที่เข้าพื้นที่แคบได้ จึงเหมาะกับงานสกัดพื้นร้านค้าใจกลางเมืองที่รถใหญ่เข้าไม่ได้</p>
<p>ดูขอบเขตบริการที่เกี่ยวข้อง: <a href="{$interiorPath}">รับรื้อถอนภายใน</a> · <a href="{$wastePath}">รับขนขยะก่อสร้าง เศษปูน</a></p>

<h2>สรุปงานสกัดพื้นปูน สยามสแควร์</h2>
<div>
<table>
<thead>
<tr><th>รายการ</th><th>รายละเอียด</th></tr>
</thead>
<tbody>
<tr><td>สถานที่</td><td>ย่านสยามสแควร์ แขวงปทุมวัน เขตปทุมวัน กรุงเทพฯ</td></tr>
<tr><td>ขอบเขตงาน</td><td>สกัดพื้นคอนกรีตเดิม + ขนเศษปูนไปทิ้ง</td></tr>
<tr><td>เครื่องจักร</td><td>รถแบคโฮ PC30 + หัวแย็ก (หัวเจาะไฮดรอลิก)</td></tr>
<tr><td>จุดเด่นหน้างาน</td><td>พื้นที่จำกัดกลางย่านการค้า — ต้องคุมฝุ่น เสียง และเวลาเข้าออกรถ</td></tr>
<tr><td>ขนเศษ</td><td>ตักเศษด้วยบุ้งกี๋ PC30 ขึ้นรถขนเศษ ทิ้งจุดรับทิ้งที่ได้รับอนุญาต</td></tr>
</tbody>
</table>
</div>
<figure>
<img src="{$imgHero}" alt="{$altHeroTh}" width="1600" height="1200" fetchpriority="high" decoding="async">
<figcaption>แม็คโครเล็ก PC30 ติดหัวแย็ก สกัดพื้นคอนกรีตเดิม ย่านสยามสแควร์</figcaption>
</figure>

<h2>หัวแย็กแม็คโคร PC30 เหมาะกับงานแบบไหน</h2>
<p><strong>หัวแย็กแม็คโคร PC30 เหมาะกับงานสกัดพื้นคอนกรีต ลานจอดรถ ทางเท้า และฐานรากขนาดเล็ก ในพื้นที่ที่รถใหญ่เข้าไม่ได้</strong> PC30 เป็นแม็คโครเล็กน้ำหนักประมาณ 3 ตัน ตัวรถแคบ หมุนตัวในพื้นที่จำกัดได้ และขนย้ายด้วยรถเทรลเลอร์เล็กหรือรถหกล้อได้ จึงเป็นขนาดที่นิยมใช้กับงานในเมือง</p>
<p>งานที่ใช้หัวเจาะแม็คโครเล็กอย่าง PC30 ได้ดี:</p>
<ul>
<li>สกัดพื้นคอนกรีตภายในร้านค้า โกดัง โรงงาน</li>
<li>รื้อพื้นลานจอดรถ ทางเข้าบ้าน ทางเท้า</li>
<li>สกัดพื้นเพื่อวางท่อระบายน้ำหรือท่อร้อยสาย</li>
<li>ทุบฐานรากหรือตอม่อขนาดเล็ก</li>
<li>งานรื้อถอนภายในอาคารที่ต้องคุมแรงสั่นสะเทือน</li>
</ul>

<h2>PC30 กับแบคโฮใหญ่ และเครื่องสกัดมือ ต่างกันยังไง</h2>
<p><strong>PC30 ติดหัวแย็กเร็วกว่าเครื่องสกัดมือหลายเท่า และเข้าพื้นที่ได้ดีกว่าแบคโฮใหญ่</strong> จึงคุ้มที่สุดกับงานพื้นขนาดกลางในเมือง ส่วนงานรื้อพื้นที่กว้างมาก หรือคอนกรีตหนามาก ควรใช้เครื่องขนาดใหญ่ขึ้น</p>
<div>
<table>
<thead>
<tr><th>วิธีสกัด</th><th>เหมาะกับ</th><th>ข้อดี</th><th>ข้อจำกัด</th></tr>
</thead>
<tbody>
<tr><td>เครื่องสกัดมือ (แย็กไฟฟ้า/ลม)</td><td>พื้นเล็ก ห้องน้ำ จุดที่เครื่องจักรเข้าไม่ได้</td><td>เข้าได้ทุกที่</td><td>ช้า ใช้แรงงานมาก ใช้หลายวัน</td></tr>
<tr><td><strong>แบคโฮ PC30 + หัวแย็ก</strong></td><td>พื้นร้านค้า ลานจอดรถ งานในเมือง</td><td>เร็ว เข้าที่แคบได้ คุมแรงสกัดได้</td><td>คอนกรีตหนามากอาจช้ากว่ารถใหญ่</td></tr>
<tr><td>แบคโฮขนาดใหญ่ + หัวแย็ก</td><td>พื้นโรงงาน ถนน ฐานรากใหญ่</td><td>กำลังสูง งานใหญ่เสร็จเร็ว</td><td>ต้องมีพื้นที่และทางเข้ากว้าง</td></tr>
</tbody>
</table>
</div>

<h2>ค่าเช่ารถแบคโฮ PC30 พร้อมหัวเจาะ ราคาเท่าไร</h2>
<p><strong>ค่าเช่ารถแบคโฮ PC30 พร้อมหัวเจาะคิดจากจำนวนวัน ค่าขนย้ายเครื่องจักรเข้าออกหน้างาน และว่าทำงานกลางวันหรือกลางคืน</strong> ถ้ารวมขนเศษปูนไปทิ้ง จะบวกค่ารถขนเศษตามจำนวนเที่ยว {$brand} แจ้งราคาเหมาให้ก่อนเริ่มงานทุกครั้ง ส่งรูปพื้นที่และทางเข้ามาทาง LINE ได้ฟรี</p>
<div>
<table>
<thead>
<tr><th>รายการ</th><th>คิดยังไง</th></tr>
</thead>
<tbody>
<tr><td>PC30 + หัวแย็ก + คนขับ</td><td>ต่อวัน (ประมาณ 8 ชม.) หรือเหมางาน</td></tr>
<tr><td>ค่าขนย้ายเครื่องจักร</td><td>ต่อเที่ยว ไป–กลับ ตามระยะทาง</td></tr>
<tr><td>ทำงานกลางคืน / นอกเวลา</td><td>บวกเพิ่มจากราคาปกติ</td></tr>
<tr><td>ขนเศษปูนไปทิ้ง</td><td>ต่อเที่ยว ตามขนาดรถ</td></tr>
</tbody>
</table>
</div>
<p>ปัจจัยที่ทำให้ราคาสูงขึ้น: คอนกรีตหนาหรือมีเหล็กเสริมแน่น · ต้องทำงานกลางคืนตามเวลาที่อาคารอนุญาต · ทางเข้าแคบต้องขนเศษออกด้วยมือก่อน · ต้องกั้นพื้นที่และคุมฝุ่นตลอดเวลา</p>

<h2>โจทย์ของงานสยามสแควร์คืออะไร</h2>
<p>งานนี้ยากเพราะ<strong>ทำงานกลางย่านการค้าที่คนเดินเยอะที่สุดย่านหนึ่งของกรุงเทพฯ</strong> ร้านข้างเคียงยังเปิดขาย ถนนรอบ ๆ รถแน่นเกือบทั้งวัน และรถบรรทุกเข้าพื้นที่ชั้นในได้เฉพาะบางช่วงเวลา</p>
<p>ข้อจำกัดที่ทีมวางแผนรับมือ:</p>
<ul>
<li><strong>เวลาทำงาน</strong> — ประสานฝ่ายอาคารเรื่องช่วงที่อนุญาตให้มีเสียงดัง</li>
<li><strong>ทางเข้าเครื่องจักร</strong> — ใช้ PC30 เพราะเป็นแม็คโครเล็กเข้าพื้นที่แคบได้</li>
<li><strong>ฝุ่นและเสียง</strong> — ต้องไม่รบกวนร้านข้างเคียงและคนเดินผ่าน</li>
<li><strong>ที่จอดรถขนเศษ</strong> — จัดรอบตักเศษและออกจากพื้นที่ให้เร็ว</li>
</ul>
<figure>
<img src="{$imgSite}" alt="{$altSiteTh}" width="1600" height="1200" loading="lazy" decoding="async">
<figcaption>สภาพหน้างานก่อนเริ่ม พื้นที่จำกัด ต้องวางแผนทางเข้าเครื่องจักร</figcaption>
</figure>

<h2>สกัดพื้นปูนกลางเมือง คุมฝุ่น เสียง และเวลาทำงานยังไง</h2>
<p><strong>งานสกัดพื้นปูนในเมืองต้องวางแผนเรื่องฝุ่น เสียง และเวลาเข้าออกของรถก่อนเริ่มงาน</strong> เพราะกรุงเทพฯ ตรวจไซต์ก่อสร้างเข้มขึ้นในช่วงฝุ่น PM 2.5 และกฎกระทรวงฉบับที่ 67 (พ.ศ. 2563) ตาม พ.ร.บ.ควบคุมอาคาร กำหนดให้งานก่อสร้างต้องป้องกันฝุ่น</p>
<p>สิ่งที่เราทำในงานนี้:</p>
<ol>
<li><strong>กั้นพื้นที่</strong> ไม่ให้ฝุ่นและเศษกระเด็นออกนอกพื้นที่</li>
<li><strong>ฉีดน้ำระหว่างสกัด</strong> เพื่อลดฝุ่น</li>
<li><strong>ทำงานในช่วงเวลาที่อาคารอนุญาต</strong> และแจ้งร้านข้างเคียงล่วงหน้า</li>
<li><strong>คลุมผ้าใบรถขนเศษทุกคัน</strong> ก่อนออกจากพื้นที่</li>
<li><strong>ล้างหรือกวาดพื้นถนนหน้าไซต์</strong> หลังเลิกงานแต่ละรอบ</li>
</ol>

<h2>ขั้นตอนการทำงานแย็กพื้นปูนและขนทิ้ง</h2>
<ol>
<li><strong>ดูหน้างานหรือรูปถ่าย</strong> — ประเมินพื้นที่ ความหนา เหล็กเสริม และทางเข้าเครื่องจักร</li>
<li><strong>แจ้งราคาเหมาและวางแผนเวลา</strong> — ประสานนิติบุคคลหรือฝ่ายอาคารเรื่องเวลาทำงานและที่จอดรถ</li>
<li><strong>ขนย้าย PC30 เข้าหน้างาน</strong> — ตามช่วงเวลาที่อนุญาต</li>
<li><strong>สกัดพื้นคอนกรีต</strong> — คนขับคุมแรงสกัดไม่ให้กระทบโครงสร้างที่ต้องเก็บไว้</li>
<li><strong>ตักเศษขึ้นรถขนเศษ</strong> — PC30 เปลี่ยนเป็นบุ้งกี๋ตักเศษขึ้นรถได้ในงานเดียว</li>
<li><strong>ขนเศษปูนไปทิ้ง</strong> — ทิ้งยังจุดรับทิ้งที่ได้รับอนุญาตเท่านั้น</li>
<li><strong>ทำความสะอาดและส่งมอบพื้นที่</strong> — พร้อมให้ช่างเข้าเทพื้นใหม่หรือวางระบบต่อ</li>
</ol>
<div>
<figure>
<img src="{$imgBreak}" alt="{$altBreakTh}" width="1600" height="1200" loading="lazy" decoding="async">
<figcaption>สกัดพื้นเป็นแนว คุมแรงไม่ให้กระทบโครงสร้างที่ต้องเก็บไว้</figcaption>
</figure>
<figure>
<img src="{$imgLoad}" alt="{$altLoadTh}" width="1600" height="1200" loading="lazy" decoding="async">
<figcaption>ตักเศษปูนขึ้นรถขนไปทิ้งในงานเดียวกัน</figcaption>
</figure>
</div>

<h2>สกัดเสร็จแล้ว เศษปูนขนไปทิ้งที่ไหน</h2>
<p><strong>เศษปูนจากงานสกัดพื้นต้องขนไปทิ้งยังจุดรับทิ้งเศษวัสดุก่อสร้างที่ได้รับอนุญาต</strong> ห้ามทิ้งในที่รกร้างหรือริมคลอง งานนี้เราจัดรถขนเศษมาพร้อมงานสกัด และใช้ PC30 ตักเศษขึ้นรถทันที เพื่อไม่ให้มีกองเศษค้างหน้าร้าน</p>
<p>ถ้าคุณมีแค่เศษปูนที่ต้องขนทิ้ง ไม่ต้องสกัดพื้น ดูตัวอย่างงานได้ที่ <a href="{$debrisPath}">ผลงานขนเศษปูน สุขุมวิท 24</a> หรือหน้าบริการ <a href="{$wastePath}">ขนเศษปูน กรุงเทพ</a></p>

<h2>ผลลัพธ์ของงาน</h2>
<ul>
<li>สกัดพื้นคอนกรีตด้วยหัวแย็กแม็คโคร PC30 ในพื้นที่แคบใจกลางสยามสแควร์</li>
<li>ขนเศษปูนไปทิ้งครบ ไม่มีกองเศษค้างหน้างาน</li>
<li>คุมฝุ่นและเสียงตามแผนที่ตกลงกับฝ่ายอาคาร</li>
<li>ช่างของลูกค้าเข้าทำงานต่อได้หลังส่งมอบพื้นที่</li>
<li>ราคาจบตามที่แจ้งไว้ ไม่มีค่าใช้จ่ายเพิ่ม</li>
</ul>
<figure>
<img src="{$imgAfter}" alt="{$altAfterTh}" width="1600" height="1200" loading="lazy" decoding="async">
<figcaption>หลังสกัดและเคลียร์เศษเสร็จ พร้อมให้ช่างเข้าทำงานต่อ</figcaption>
</figure>

<h2>บทเรียนจากหน้างานสยามสแควร์</h2>
<p>งานสกัดพื้นในย่านการค้า<strong>ถ้าวางแผนเวลาไม่ดีจะเสียเวลามากกว่าตัวงานสกัดเอง</strong> การตกลงเวลาเข้าออกรถกับฝ่ายอาคารให้ชัดตั้งแต่แรก และการจัดรถขนเศษให้มารอทันทีที่สกัดเสร็จแต่ละช่วง ช่วยให้งานจบเร็วขึ้นและไม่มีเศษค้างหน้าร้าน</p>

<h2>เช่ารถแบคโฮหัวเจาะ PC30 พร้อมขนเศษทิ้ง ส่งรูปหน้างานมาได้เลย</h2>
<p>มีพื้นปูน ลานคอนกรีต หรือฐานรากที่ต้องสกัด ถ่ายรูปพื้นที่และทางเข้าส่งมาทาง LINE เราแนะนำขนาดเครื่องจักรที่เหมาะสม และแจ้งราคาเหมารวมค่าขนเศษทิ้งให้ก่อนเริ่มงาน</p>
<p><strong>{$brand}</strong> · โทร <a href="tel:{$phoneTel}">{$phoneDisplay}</a> · LINE <a href="{$lineUrl}" target="_blank" rel="noopener noreferrer">{$lineLabel}</a></p>
<p>👉 <a href="{$interiorPath}">รับรื้อถอนภายใน</a> · <a href="{$wastePath}">ขนเศษปูน กรุงเทพ</a> · <a href="/works">ดูผลงานอื่น ๆ</a></p>
HTML;

    $contentEn = <<<HTML
<p><em>By the {$brand} site team • Published 21 November 2026 • Last updated 21 November 2026</em></p>
<p><a href="{$lineUrl}" target="_blank" rel="noopener noreferrer">Send site photos via LINE ({$lineLabel})</a> · <a href="tel:{$phoneTel}">Call {$phoneDisplay}</a></p>

<p>{$brand} used a <strong>PC30 mini excavator with a hydraulic breaker</strong> to remove an existing concrete floor at <strong>Siam Square</strong>, Pathum Wan, central Bangkok, then hauled the broken concrete to a licensed disposal site in the same job. The PC30 fits tight urban sites where larger machines cannot enter — ideal for shop fit-out strip-outs in the city centre.</p>
<p>Related services: <a href="{$interiorPath}">interior demolition</a> · <a href="{$wastePath}">construction debris removal Bangkok</a>.</p>

<h2>Project summary</h2>
<div>
<table>
<thead>
<tr><th>Item</th><th>Detail</th></tr>
</thead>
<tbody>
<tr><td>Location</td><td>Siam Square area, Pathum Wan, Bangkok</td></tr>
<tr><td>Scope</td><td>Concrete floor breaking + construction debris removal</td></tr>
<tr><td>Machine</td><td>PC30 mini excavator + hydraulic breaker</td></tr>
<tr><td>Site constraint</td><td>Tight retail district — dust, noise, and truck access windows</td></tr>
<tr><td>Debris</td><td>PC30 bucket-loaded onto trucks; licensed disposal only</td></tr>
</tbody>
</table>
</div>
<figure>
<img src="{$imgHero}" alt="{$altHeroEn}" width="1600" height="1200" fetchpriority="high" decoding="async">
<figcaption>PC30 mini excavator with breaker removing the existing concrete floor at Siam Square</figcaption>
</figure>

<h2>What is a PC30 excavator with breaker used for?</h2>
<p><strong>A PC30 excavator with breaker is used to break concrete floors, driveways, car parks, sidewalks and small footings where large machines cannot fit.</strong> The PC30 is a mini excavator in the ~3-tonne class — narrow, turns in tight spaces, and easy to transport — a common choice for concrete breaking in Bangkok's dense neighbourhoods.</p>
<ul>
<li>Removing concrete floors in shops, restaurants, warehouses and factories</li>
<li>Breaking up driveways, car parks and sidewalks</li>
<li>Cutting trenches through concrete for drainage pipes or conduits</li>
<li>Breaking small footings and pile caps</li>
<li>Interior strip-outs where vibration must stay controlled</li>
</ul>

<h2>Jackhammer vs mini excavator breaker vs large excavator</h2>
<p><strong>For a medium-sized concrete floor in the city, a PC30 with a breaker is usually the best value</strong> — much faster than hand-held jackhammers, and it fits where larger excavators cannot. For very large areas or very thick concrete, a larger machine is more efficient.</p>
<div>
<table>
<thead>
<tr><th>Method</th><th>Best for</th><th>Pros</th><th>Limits</th></tr>
</thead>
<tbody>
<tr><td>Hand-held jackhammer</td><td>Bathrooms, small spots machines can't reach</td><td>Goes anywhere</td><td>Slow, labour-intensive, takes days</td></tr>
<tr><td><strong>PC30 + breaker</strong></td><td>Shop floors, car parks, urban sites</td><td>Fast, tight access, controlled breaking</td><td>Slower than large machines on very thick slabs</td></tr>
<tr><td>Large excavator + breaker</td><td>Factory floors, roads, large foundations</td><td>High power, big jobs finish fast</td><td>Needs wide access and space</td></tr>
</tbody>
</table>
</div>

<h2>How much does it cost to rent an excavator with breaker in Bangkok?</h2>
<p><strong>PC30 excavator-with-breaker rental depends on the number of days, machine delivery, and whether work is daytime or night.</strong> Debris truck trips are added if you need rubble removed. {$brand} always gives a fixed quote before work starts — send area and access photos on LINE for a free estimate.</p>
<div>
<table>
<thead>
<tr><th>Item</th><th>How it is charged</th></tr>
</thead>
<tbody>
<tr><td>PC30 + breaker + operator</td><td>Per day (~8 hours) or fixed-price job</td></tr>
<tr><td>Machine delivery (mobilisation)</td><td>Per round trip, by distance</td></tr>
<tr><td>Night / after-hours work</td><td>Surcharge on the day rate</td></tr>
<tr><td>Debris removal</td><td>Per truck trip, by truck size</td></tr>
</tbody>
</table>
</div>
<p>What raises cost: thick concrete or dense rebar · night shifts to match building rules · narrow access that forces hand-carry before loading · continuous dust screens and water spray.</p>

<h2>What made the Siam Square job challenging?</h2>
<p>The difficulty was <strong>working in one of Bangkok's busiest shopping districts</strong>. Neighbouring shops were still trading, surrounding roads stay congested most of the day, and trucks may only enter central Bangkok at certain times.</p>
<ul>
<li><strong>Work hours</strong> — align noisy work with building management windows</li>
<li><strong>Machine access</strong> — PC30 mini excavator for tight retail entrances</li>
<li><strong>Dust and noise</strong> — must not disturb neighbours or pedestrians</li>
<li><strong>Truck parking</strong> — short loading cycles, leave the curb quickly</li>
</ul>
<figure>
<img src="{$imgSite}" alt="{$altSiteEn}" width="1600" height="1200" loading="lazy" decoding="async">
<figcaption>The site before work: limited space and narrow machine access</figcaption>
</figure>

<h2>Dust, noise and work hours for concrete breaking in central Bangkok</h2>
<p><strong>Concrete breaking in central Bangkok needs a dust, noise and truck-access plan before work starts.</strong> Bangkok inspects sites more strictly in PM 2.5 season, and Ministerial Regulation No. 67 (B.E. 2563 / 2020) under the Building Control Act requires construction dust control.</p>
<ol>
<li><strong>Screened work area</strong> to keep dust and debris inside</li>
<li><strong>Water spray while breaking</strong> to suppress dust</li>
<li><strong>Work only in permitted hours</strong> and notify neighbouring shops in advance</li>
<li><strong>Tarped every debris truck</strong> before leaving the site</li>
<li><strong>Swept or washed the curb</strong> after each shift</li>
</ol>

<h2>Our concrete breaking and removal process</h2>
<ol>
<li><strong>Site survey or photo assessment</strong> — area, thickness, reinforcement, machine access</li>
<li><strong>Fixed quote and schedule</strong> — agree hours and truck parking with building management</li>
<li><strong>Machine delivery</strong> — PC30 delivered in the approved window</li>
<li><strong>Concrete breaking</strong> — operator controls the breaker so remaining structure stays intact</li>
<li><strong>Loading debris</strong> — switch to bucket and load trucks in the same job</li>
<li><strong>Licensed disposal</strong> — all broken concrete goes to an authorised dump</li>
<li><strong>Clean-up and handover</strong> — ready for the next trade to pour or install services</li>
</ol>
<div>
<figure>
<img src="{$imgBreak}" alt="{$altBreakEn}" width="1600" height="1200" loading="lazy" decoding="async">
<figcaption>Breaking the slab in strips to protect the structure that stays</figcaption>
</figure>
<figure>
<img src="{$imgLoad}" alt="{$altLoadEn}" width="1600" height="1200" loading="lazy" decoding="async">
<figcaption>Debris loaded and hauled away in the same job</figcaption>
</figure>
</div>

<h2>Where does the broken concrete go?</h2>
<p><strong>Broken concrete must go to a licensed construction-waste disposal site</strong> — never vacant land or canals. On this job we brought debris trucks with the breaker and loaded with the PC30 so no rubble sat outside the shop.</p>
<p>Only need haul-away with no breaking? See our <a href="{$debrisPath}">construction debris removal project at Sukhumvit 24</a> or the <a href="{$wastePath}">construction debris removal service in Bangkok</a>.</p>

<h2>Results</h2>
<ul>
<li>Broke the concrete floor with a PC30 excavator breaker in a tight Siam Square retail site</li>
<li>Removed debris completely — nothing left on the curb</li>
<li>Dust and noise managed per the building plan</li>
<li>Client trades could resume after handover</li>
<li>Final price matched the quote — no surprise add-ons</li>
</ul>
<figure>
<img src="{$imgAfter}" alt="{$altAfterEn}" width="1600" height="1200" loading="lazy" decoding="async">
<figcaption>Site cleared and ready for the next trade</figcaption>
</figure>

<h2>Lessons from the Siam Square site</h2>
<p>In a retail district, <strong>bad scheduling costs more time than the breaking itself</strong>. Agreeing truck access with building management up front, and having debris trucks waiting as each section is broken, finishes the job faster with no rubble left outside the shop.</p>

<h2>Rent an excavator with breaker in Bangkok — debris removal included</h2>
<p>Have a concrete floor, slab or footing to break? Send photos of the area and access via LINE. We'll recommend the right machine and give a fixed quote, debris removal included, before work starts.</p>
<p><strong>{$brand}</strong> · Call <a href="tel:{$phoneTel}">{$phoneDisplay}</a> · LINE <a href="{$lineUrl}" target="_blank" rel="noopener noreferrer">{$lineLabel}</a></p>
<p>👉 <a href="{$interiorPath}">interior demolition</a> · <a href="{$wastePath}">construction debris removal Bangkok</a> · <a href="/en/works">more project case studies</a></p>
HTML;

    return [
        'slug' => 'excavator-breaker-pc30-siam-square',
        'cover_image' => $imgHero,
        'completed_at' => '2026-11-21',
        'client_name' => null,
        'client_name_en' => null,
        'lat' => 13.74655,
        'lng' => 100.53470,
        'images' => [
            [
                'image_url' => $imgHero,
                'alt_text' => $altHeroTh,
                'width' => 1600,
                'height' => 1200,
                'sort_order' => 1,
            ],
            [
                'image_url' => $imgSite,
                'alt_text' => $altSiteTh,
                'width' => 1600,
                'height' => 1200,
                'sort_order' => 2,
            ],
            [
                'image_url' => $imgBreak,
                'alt_text' => $altBreakTh,
                'width' => 1600,
                'height' => 1200,
                'sort_order' => 3,
            ],
            [
                'image_url' => $imgLoad,
                'alt_text' => $altLoadTh,
                'width' => 1600,
                'height' => 1200,
                'sort_order' => 4,
            ],
            [
                'image_url' => $imgAfter,
                'alt_text' => $altAfterTh,
                'width' => 1600,
                'height' => 1200,
                'sort_order' => 5,
            ],
        ],
        'th' => [
            'title' => 'หัวแย็กแม็คโคร PC30 — ผลงานสกัดพื้นปูน สยามสแควร์ พร้อมขนเศษทิ้ง',
            'description' => 'ผลงานหัวแย็กแม็คโคร PC30 สกัดพื้นปูนใจกลางสยามสแควร์ พร้อมขนเศษปูนไปทิ้งในงานเดียว เข้าพื้นที่แคบได้ คุมฝุ่นและเสียง แจ้งราคาเหมาก่อนเริ่มงาน',
            'meta_title' => 'หัวแย็กแม็คโคร PC30 ผลงานสกัดพื้นปูน สยามสแควร์ | BOA',
            'meta_description' => 'ผลงานหัวแย็กแม็คโคร PC30 สกัดพื้นปูนใจกลางสยามสแควร์ พร้อมขนเศษปูนไปทิ้งในงานเดียว เข้าพื้นที่แคบได้ คุมฝุ่นและเสียง แจ้งค่าเช่าแบคโฮก่อนเริ่มงาน ทัก LINE',
            'content' => $contentTh,
        ],
        'en' => [
            'title_en' => 'PC30 Excavator with Breaker — Concrete Floor Breaking at Siam Square, Bangkok',
            'description_en' => 'Case study: PC30 mini excavator with breaker removing a concrete floor at Siam Square, Bangkok, debris removal included. Tight urban access, dust and noise control, fixed quote before work.',
            'meta_title_en' => 'PC30 Excavator with Breaker | Siam Square, Bangkok',
            'meta_description_en' => 'How we used a PC30 mini excavator with breaker to remove a concrete floor at Siam Square, Bangkok, debris removal included. See process and get a LINE quote.',
            'content_en' => $contentEn,
        ],
        'faqs' => [
            [
                'question' => 'หัวแย็กแม็คโคร PC30 สกัดพื้นได้หนาแค่ไหน?',
                'answer' => 'หัวแย็กแม็คโคร PC30 เหมาะกับพื้นคอนกรีตทั่วไปของร้านค้า บ้าน ลานจอดรถ และทางเท้า ถ้าพื้นหนามาก มีเหล็กเสริมหลายชั้น หรือเป็นพื้นโรงงานรับน้ำหนักสูง เราจะแนะนำแบคโฮขนาดใหญ่ขึ้นเพื่อให้งานเร็วและคุ้มกว่า ส่งรูปและขนาดพื้นมาให้ประเมินได้ฟรี',
                'question_en' => 'How thick a concrete floor can a PC30 excavator with breaker handle?',
                'answer_en' => 'A PC30 excavator with breaker handles typical concrete floors in shops, homes, car parks and sidewalks. If the slab is very thick, has several layers of reinforcement or is an industrial floor, we recommend a larger excavator for faster, more cost-effective work. Send us photos and floor dimensions for a free assessment.',
                'sort_order' => 1,
            ],
            [
                'question' => 'ค่าเช่ารถแบคโฮ PC30 พร้อมหัวเจาะ คิดยังไง?',
                'answer' => 'ค่าเช่ารถแบคโฮ PC30 พร้อมหัวเจาะคิดจากจำนวนวัน ค่าขนย้ายเครื่องจักรเข้าออกหน้างาน และว่าทำงานกลางวันหรือกลางคืน ถ้ารวมขนเศษปูนไปทิ้ง จะบวกค่ารถขนเศษตามจำนวนเที่ยว '.$brand.' แจ้งราคาเหมาให้ก่อนเริ่มงานทุกครั้ง',
                'question_en' => 'How is the rental price for a PC30 excavator with breaker calculated?',
                'answer_en' => 'The rental price depends on the number of days, machine delivery to and from the site, and whether the work is done during the day or at night. If you also need debris removal, truck trips are added. '.$brand.' always gives a fixed quote before work starts.',
                'sort_order' => 2,
            ],
            [
                'question' => 'แม็คโครเล็ก PC30 เข้าพื้นที่แคบหรือในอาคารได้ไหม?',
                'answer' => 'ได้ PC30 เป็นแม็คโครเล็กน้ำหนักประมาณ 3 ตัน ตัวรถแคบและหมุนตัวในพื้นที่จำกัดได้ จึงเข้าร้านค้า โกดัง หรือซอยแคบได้ดีกว่าแบคโฮใหญ่ ควรวัดความกว้างประตูหรือทางเข้า และเช็คว่าพื้นทางผ่านรับน้ำหนักรถได้ก่อนนัดงาน',
                'question_en' => 'Can a PC30 mini excavator work in narrow spaces or indoors?',
                'answer_en' => 'Yes. The PC30 is a mini excavator of about 3 tonnes. It is narrow and turns in tight spaces, so it fits into shops, warehouses and narrow sois better than larger machines. Measure the door or access width, and check that the floor along the access route can carry the machine before booking.',
                'sort_order' => 3,
            ],
            [
                'question' => 'สกัดพื้นปูนด้วย PC30 ใช้เวลากี่วัน?',
                'answer' => 'ระยะเวลาขึ้นกับขนาดพื้นที่ ความหนาคอนกรีต เหล็กเสริม และเวลาที่อาคารอนุญาตให้ทำงาน งานพื้นร้านค้าขนาดกลางส่วนใหญ่เสร็จภายใน 1–3 วัน ซึ่งเร็วกว่าการใช้คนงานสกัดด้วยมือหลายเท่า',
                'question_en' => 'How long does it take to break a concrete floor with a PC30?',
                'answer_en' => 'It depends on the area, slab thickness, reinforcement and the hours the building allows work. Most medium-sized shop floors are finished within 1 to 3 days, many times faster than breaking by hand with jackhammers.',
                'sort_order' => 4,
            ],
            [
                'question' => 'สกัดพื้นแล้วรับขนเศษปูนไปทิ้งด้วยไหม?',
                'answer' => 'รับ เราจัดรถขนเศษมาพร้อมกับงานสกัด แล้วใช้ PC30 ตักเศษขึ้นรถได้ทันที เศษปูนทั้งหมดนำไปทิ้งยังจุดรับทิ้งที่ได้รับอนุญาต ลูกค้าจ้างงานเดียวจบ ไม่ต้องหารถขนขยะเอง',
                'question_en' => 'Do you remove the broken concrete as well?',
                'answer_en' => 'Yes. We bring debris trucks together with the breaker, and the PC30 loads the debris directly onto them. All broken concrete goes to a licensed disposal site, so you hire one team for the whole job and do not need a separate rubble removal company.',
                'sort_order' => 5,
            ],
            [
                'question' => 'ทำงานกลางคืนได้ไหม?',
                'answer' => 'ได้ งานในย่านการค้าหรืออาคารที่เปิดให้บริการกลางวัน เราทำงานกลางคืนตามเวลาที่ฝ่ายอาคารอนุญาต และวางแผนเวลาเข้าออกของรถให้สอดคล้องกับข้อจำกัดการเดินรถบรรทุกในกรุงเทพฯ ค่าเช่ากลางคืนอาจสูงกว่าช่วงกลางวัน',
                'question_en' => 'Can you work at night?',
                'answer_en' => 'Yes. For retail areas and buildings that are open during the day, we work at night within the hours building management allows, and plan truck access around Bangkok truck traffic restrictions. Night work may cost more than daytime work.',
                'sort_order' => 6,
            ],
        ],
    ];
};
