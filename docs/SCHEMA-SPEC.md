# JSON-LD Schema Rules

**ก่อนแก้หรือเพิ่ม schema ใด ๆ ต้องอ่าน `docs/SCHEMA-SPEC.md` ก่อนเสมอ** — ไฟล์นี้เป็นเพียงสรุปกฎหลัก รายละเอียด field mapping, template และ QA checklist อยู่ในสเปกเต็ม

## แหล่งอ้างอิง (บังคับ)

- Vocabulary / `@type` / property ทุกตัวต้องมาจาก [schema.org](https://schema.org/) เท่านั้น
- `@context` ใช้ `https://schema.org` เสมอ
- ตรวจชื่อ property และ expected type จากหน้า type นั้นโดยตรง เช่น
  - [GeneralContractor](https://schema.org/GeneralContractor)
  - [PostalAddress](https://schema.org/PostalAddress)
  - [OpeningHoursSpecification](https://schema.org/OpeningHoursSpecification)
  - [OfferCatalog](https://schema.org/OfferCatalog) / [Offer](https://schema.org/Offer) / [Service](https://schema.org/Service)
  - [WebSite](https://schema.org/WebSite) / [WebPage](https://schema.org/WebPage)
  - [FAQPage](https://schema.org/FAQPage) / [Question](https://schema.org/Question) / [Answer](https://schema.org/Answer)
  - [BreadcrumbList](https://schema.org/BreadcrumbList) / [ListItem](https://schema.org/ListItem)
- ห้ามคิดชื่อฟิลด์เอง หรือใช้รูปแบบที่ไม่อยู่ใน schema.org

## Mapping องค์กร (จาก `config/company.php`)

| schema.org property | expected type | แหล่งข้อมูล | เงื่อนไข |
|---|---|---|---|
| `@type` | Text | `business_type` | เช่น `GeneralContractor` |
| `name` | Text | `brand_name` | แสดงบนหน้า |
| `legalName` | Text | `legal_name` | แสดงบนหน้า |
| `url` | URL | `site_url` | absolute https |
| `logo` | [ImageObject](https://schema.org/ImageObject) | `logo_url` | `{ "@type": "ImageObject", "url": "..." }` |
| `description` | Text | `description` | แสดงบนหน้า |
| `telephone` | Text | `phone` | E.164 |
| `email` | Text | `email` | แสดงบนหน้า |
| `taxID` | Text | `tax_id` | แสดงใน footer |
| `address` | [PostalAddress](https://schema.org/PostalAddress) | `address.*` | แสดงบนหน้า |
| `openingHours` | Text | `hours.*` | รูปแบบ `Mo-Sa 08:00-18:00` |
| `openingHoursSpecification` | [OpeningHoursSpecification](https://schema.org/OpeningHoursSpecification) | `hours.*` | `dayOfWeek` / `opens` / `closes` |
| `sameAs` | URL[] | `social.*` | เฉพาะ URL ที่ไม่ว่าง |
| `areaServed` | Place | เนื้อหาหน้า | เฉพาะหน้าที่มีแสดงพื้นที่ |
| `hasOfferCatalog` | OfferCatalog | เนื้อหาหน้า | เฉพาะบริการที่แสดงจริง |

`PostalAddress` ใช้ property ตาม schema.org เท่านั้น: `streetAddress`, `addressLocality`, `addressRegion`, `postalCode`, `addressCountry`

## กฎที่ห้ามละเมิด

1. Schema ต้องตรงกับเนื้อหาที่ render จริงบนหน้า — ฟิลด์ที่ไม่แสดงผล ห้ามใส่
2. 1 หน้า = 1 `<script type="application/ld+json">` ใช้ `@graph` รวม ห้ามกระจายหลาย block
3. ฟิลด์ว่าง (`""`, `null`, `[]`) ต้องถูกตัดออกก่อน encode — ใช้ helper `filterEmpty()` เสมอ
4. ห้ามใส่ `aggregateRating` / `review` ของธุรกิจตัวเอง ถ้าไม่มีรีวิวจริงแสดงบนหน้า
5. ห้ามสร้างตาราง `seo_schema` แยก — ดึงจากฟิลด์เดียวกับที่หน้าเว็บใช้แสดงผล
6. ห้ามใส่ property นอก vocabulary ของ schema.org

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
| `dayOfWeek` | ชื่อวัน schema.org → `Monday` … `Sunday` |
| `addressCountry` | ISO 3166-1 alpha-2 → `TH` |

## Encoding

- ใช้ JSON encoder ของภาษา ห้าม concat string เอง
- ต้องเปิด `UNESCAPED_UNICODE` (ภาษาไทยจะได้ไม่กลายเป็น `\u0e01`)
- escape `</` เป็น `<\/` ก่อน render ใน `<script>`

## ก่อน commit

- [ ] ผ่าน Rich Results Test — 0 error
- [ ] ผ่าน [validator.schema.org](https://validator.schema.org/) — 0 error
- [ ] property / `@type` ตรงกับหน้า schema.org ที่อ้างอิง
- [ ] `headline` ตรงกับ `<h1>` เป๊ะ (หน้า Article)
- [ ] คำถาม/คำตอบใน FAQPage ตรงกับที่แสดงบนหน้าทุกตัวอักษร
- [ ] ไม่ generate ให้เนื้อหาที่ `is_published = false`
