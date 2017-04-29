dbのスキーマに必要なもの
- 名前
- lat, long
- 画像
- 地名にもどずく説明文
- カテゴリ

- スキーマ作成
```
create table poi (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  location GEOMETRY NOT NULL,
  image TEXT,
  PRIMARY KEY(id)
);
```

- 1レコード insert
```
insert into poi ( name, description, location, image)
  values ('hoge', 'aaaaaa',
     GeomFromText('POINT(135.1 35.13)'),
     'https://hoge.com');
```

- select
```
select name,X(location) as lon,Y(location) as lat from poi;
```


```
SELECT
  name,
  X(location) as lng,
  Y(location) as lat,
  (6371 * ACOS(
    COS(RADIANS(35.655363))
    * COS(RADIANS(Y(location)))
    * COS(RADIANS(X(location)) - RADIANS(139.757101))
    + SIN(RADIANS(35.655363))
    * SIN(RADIANS(Y(location)))
  )) AS distance
FROM
  poi
HAVING
  distance <= 1000.0
ORDER BY
  distance
;
```
