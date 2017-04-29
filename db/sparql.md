## 世界遺産データを取得
```
PREFIX geo:  <http://www.w3.org/2003/01/geo/wgs84_pos#>
PREFIX foaf: <http://xmlns.com/foaf/0.1/>
PREFIX dbo: <http://dbpedia.org/ontology/>

select distinct ?lat ?long ?depict ?name ?abstract  where {
?s a <http://dbpedia.org/ontology/WorldHeritageSite>.
?s rdfs:label ?name.
?s geo:lat ?lat.  
?s geo:long ?long.

optional {
?s foaf:depiction ?depict.
?s dbo:abstract ?abstract.
}
FILTER ( lang(?name) = "en" )
FILTER ( lang(?abstract) = "en" )
}
```
