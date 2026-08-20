---
paths:
  - "src/seo/**/*"
  - "**/schema/**/*"
  - "**/*schema*.{ts,js,php,py}"
  - "**/*structured-data*.{ts,js,php,py}"
  - "docs/SCHEMA-SPEC.md"
---

# JSON-LD Schema Rules

**ก่อนแก้หรือเพิ่ม schema ใด ๆ ต้องอ่าน `docs/SCHEMA-SPEC.md` ก่อนเสมอ** — ไฟล์นี้เป็นเพียงสรุปกฎหลัก รายละเอียด field mapping, template และ QA checklist อยู่ในสเปกเต็ม

## กฎที่ห้ามละเมิด

1. Schema ต้องตรงกับเนื้อหาที่ render จริงบนหน้า — ฟิลด์ที่ไม่แสดงผล ห้ามใส่
2. 1 หน้า = 1 `<script type="application/ld+json">` ใช้ `@graph` รวม ห้ามกระจายหลาย block
3. ฟิลด์ว่าง (`""`, `null`, `[]`) ต้องถูกตัดออกก่อน encode — ใช้ helper `filter_empty()` เสมอ
4. ห้ามใส่ `aggregateRating` / `review` ของธุรกิจตัวเอง ถ้าไม่มีรีวิวจริงแสดงบนหน้า
5. ห้ามสร้างตาราง `seo_schema` แยก — ดึงจากฟิลด์เดียวกับที่หน้าเว็บใช้แสดงผล

## Convention ของ `@id`

| Entity | รูปแบบ |
|---|---|
| Organization | `{site_url}#organization` |
| WebSite | `{site_url}#website` |
| WebPage | `{page_url}#webpage` |
| BreadcrumbList | `{page_url}#breadcrumb` |
| Service | `{page_url}#service` |
| Article | `{page_url}#article` |
| FAQPage | `{page_url}#faq` |
| Person | `{site_url}author/{slug}#person` |

Organization / WebSite / Person ประกาศเต็มครั้งเดียว ที่เหลืออ้างด้วย `{"@id": "..."}` เท่านั้น

## Data format ที่บังคับ

| ข้อมูล | รูปแบบ |
|---|---|
| วันที่ | ISO 8601 + timezone → `2026-01-15T09:00:00+07:00` |
| เบอร์โทร | E.164 → `+66810000000` |
| URL | absolute + https เสมอ |
| lat / lng / price / wordCount | ส่งเป็น **number** ไม่ใช่ string |
| ข้อความทุกฟิลด์ | `strip_tags()` + decode entity ก่อนใส่ |

## Encoding

- ใช้ JSON encoder ของภาษา ห้าม concat string เอง
- ต้องเปิด `UNESCAPED_UNICODE` (ภาษาไทยจะได้ไม่กลายเป็น `\u0e01`)
- escape `</` เป็น `<\/` ก่อน render ใน `<script>`

## ก่อน commit

- [ ] ผ่าน Rich Results Test — 0 error
- [ ] ผ่าน validator.schema.org — 0 error
- [ ] `headline` ตรงกับ `<h1>` เป๊ะ (หน้า Article)
- [ ] คำถาม/คำตอบใน FAQPage ตรงกับที่แสดงบนหน้าทุกตัวอักษร
- [ ] ไม่ generate ให้เนื้อหาที่ `is_published = false`